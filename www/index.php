<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel;

$routes = include __DIR__.'/../src/app.php';
$sc = include __DIR__.'/../src/container.php';

$sc->setParameter('routes', include __DIR__.'/../src/app.php');
$sc->setParameter('charset', 'UTF-8');

$dotenv = new Dotenv\Dotenv(__DIR__.'/../');
$dotenv->load();

$request = Request::createFromGlobals();
$cache_enabled = (bool) $request->server->get('CACHE_ENABLED', false);

$framework = $sc->get('framework');

if (true === $cache_enabled) {
    $framework = new HttpKernel\HttpCache\HttpCache(
        $framework,
        new HttpKernel\HttpCache\Store(__DIR__.'/../cache')
    );
}

$response = $framework->handle($request);

$response->send();
