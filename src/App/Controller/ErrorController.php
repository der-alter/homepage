<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Debug\Exception\FlattenException;

class ErrorController extends BaseController
{
    public function exceptionAction(FlattenException $exception)
    {
        $msg = 'Something went wrong! ('.$exception->getMessage().')';
        $statusCode = $exception->getStatusCode();

        if (404 === $statusCode) {
            $tpl = $this->templating->render('pages/not-found.php');
        } else {
            $tpl = $this->templating->render('pages/internal-error.php', ['msg' => $msg]);
        }

        $response = new Response($tpl, $statusCode);

        return $response;
    }
}
