<?php

namespace App\Controller;

use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\TemplateNameParser;
use Symfony\Component\Templating\Loader\FilesystemLoader;

class BaseController
{
    protected $templating;

    public function __construct()
    {
        $loader = new FilesystemLoader(__DIR__.'/../../views/%name%');

        $this->templating = new PhpEngine(new TemplateNameParser(), $loader);
    }
}
