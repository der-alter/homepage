<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel;

$cache_enabled = true;

$routes = include __DIR__.'/../src/app.php';
$sc = include __DIR__.'/../src/container.php';

$sc->setParameter('routes', include __DIR__.'/../src/app.php');
$sc->setParameter('charset', 'UTF-8');

$request = Request::createFromGlobals();

$framework = $sc->get('framework');

if (true === $cache_enabled) {
    $framework = new HttpKernel\HttpCache\HttpCache(
        $framework,
        new HttpKernel\HttpCache\Store(__DIR__.'/../cache')
    );
}

$response = $framework->handle($request);

$response->send();
