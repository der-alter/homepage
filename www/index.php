<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\TemplateNameParser;
use Symfony\Component\Templating\Loader\FilesystemLoader;
use Symfony\Component\Asset\PathPackage;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;
use Symfony\Component\Templating\Helper\SlotsHelper;

$app = new Silex\Application();

$app['templating'] = function() {
    $loader = new FilesystemLoader(__DIR__ . '/../src/views/%name%');

    $templating = new PhpEngine(new TemplateNameParser(), $loader);
    $templating->set(new SlotsHelper());

    $package = new PathPackage('/assets', new EmptyVersionStrategy());
    $templating->addGlobal('assets', $package);

    return $templating;
};

$app->register(new Silex\Provider\HttpCacheServiceProvider(), array(
    'http_cache.cache_dir' => __DIR__.'/../cache/',
    'http_cache.esi'       => null,
));

$app->get('/', 'App\Controller\HomeController::index');

$env = getenv('APP_ENV') ?: 'prod';
$app['debug'] = !('prod' == $env);

$app['http_cache']->run();
