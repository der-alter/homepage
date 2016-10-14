<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\TemplateNameParser;
use Symfony\Component\Templating\Loader\FilesystemLoader;
use Symfony\Component\Asset\PathPackage;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;
use Symfony\Component\Templating\Helper\SlotsHelper;
use Monolog\Handler\RollbarHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$dotenv = new Dotenv\Dotenv(__DIR__.'/../');
$dotenv->load();

$app = new Silex\Application();

$app['templating'] = function() {
    $loader = new FilesystemLoader(__DIR__ . '/../src/views/%name%');

    $templating = new PhpEngine(new TemplateNameParser(), $loader);
    $templating->set(new SlotsHelper());

    $package = new PathPackage('/assets', new EmptyVersionStrategy());
    $templating->addGlobal('assets', $package);

    return $templating;
};

$app->register(new Silex\Provider\HttpCacheServiceProvider(), [
    'http_cache.cache_dir' => __DIR__.'/../cache/',
    'http_cache.esi'       => null,
]);


$app['debug'] = getenv('DEBUG');

$app->error(function (\Exception $e, Request $request, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    if (Response::HTTP_NOT_FOUND == $code) {
        $subRequest = Request::create('/not-found', 'GET');

        return $app->handle($subRequest, \Symfony\Component\HttpKernel\HttpKernelInterface::SUB_REQUEST);
    }

});

if($app['debug']) {
    $app->register(new Silex\Provider\MonologServiceProvider(), array(
        'monolog.logfile' => __DIR__.'/../logs/development.log',
    ));
} else {
    $app->register(new Silex\Provider\MonologServiceProvider());

    $app->extend('monolog', function($monolog, $app) {
        $config = array('access_token' => getenv('ROLLBAR_ACCESS_TOKEN'));
        Rollbar::init($config);

        $monolog->pushHandler(new RollbarHandler(Rollbar::$instance));

        return $monolog;
    });
}

include __DIR__ . '/routing.php';

return $app;
