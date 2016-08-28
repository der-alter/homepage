<?php

namespace App\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ErrorController
{
    public function notFound(Request $request, Application $app)
    {
        $response = new Response(
            $app['templating']->render('pages/not-found.php')
        );

        return $response;
    }
}
