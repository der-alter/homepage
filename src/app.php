<?php

use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();

$routes->add('home', new Routing\Route('/', ['_controller' => 'App\Controller\HomeController::indexAction']));

return $routes;
