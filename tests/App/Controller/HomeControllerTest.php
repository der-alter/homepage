<?php

namespace App\Tests;

use Silex\WebTestCase;

class HomeControllerTest extends WebTestCase {
    public function createApplication()
    {
        $app = require __DIR__.'/../../../app/app.php';
        $app['debug'] = true;
        unset($app['exception_handler']);

        return $app;
    }

    public function testInitialPage()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/');

        $this->assertTrue($client->getResponse()->isOk());
    }

    /**
     * @expectedException Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function testNotFoundException()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/bidubidubidu');
    }

}
