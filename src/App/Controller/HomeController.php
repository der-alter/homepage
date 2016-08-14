<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends BaseController
{
    public function indexAction(Request $request)
    {
        $response = new Response(
            $this->templating->render('pages/home.php')
        );

        $response->setTtl(3600);

        return $response;
    }
}
