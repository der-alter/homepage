<?php

namespace App\Controller;

use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\TemplateNameParser;
use Symfony\Component\Templating\Loader\FilesystemLoader;
use Symfony\Component\Asset\PathPackage;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;
use Symfony\Component\Templating\Helper\SlotsHelper;

class BaseController
{
    protected $templating;

    public function __construct()
    {
        $loader = new FilesystemLoader(__DIR__.'/../../views/%name%');

        $this->templating = new PhpEngine(new TemplateNameParser(), $loader);
        $this->templating->set(new SlotsHelper());

        $package = new PathPackage('/assets', new EmptyVersionStrategy());
        $this->templating->addGlobal('assets', $package);
    }
}
