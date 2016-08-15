<?php

namespace App\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class HomeController
{
    public function index(Request $request, Application $app)
    {
        $response = new Response(
            $app['templating']->render('pages/home.php')
        );

        $response->setTtl(3600);

        return $response;
    }
}
