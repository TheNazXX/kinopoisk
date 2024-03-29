<?php

namespace App;

use Kernel\Router\Router;
use Kernel\Http\Request;
use Kernel\Container\Container;

class App
{
  private Container $container;

  public function __construct(){
    $this->container = new Container();
  }

  public function run(){
    $this->container->router->dispatch($this->container->request->getUri(), $this->container->request->getMethod());
  }
}