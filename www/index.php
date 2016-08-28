<?php

$app = require __DIR__ . '/../app/app.php';

if(!$app['debug']) {
    $app['http_cache']->run();
} else {
    $app->run();
}
