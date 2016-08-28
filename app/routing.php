<?php

$app->get('/', 'App\Controller\HomeController::index');
$app->get('/not-found', 'App\Controller\ErrorController::notFound');
