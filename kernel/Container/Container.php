<?php 

namespace Kernel\Container;

use Kernel\Http\Request;
use Kernel\Router\Router;
use Kernel\View\View;
use Kernel\Validator\Validator;
use Kernel\Http\Redirect;

class Container
{
  public readonly Request $request;
  public readonly Router $router;
  public readonly View $view;
  public readonly Validator $validator;
  public readonly Redirect $redurect;

  public function __construct(){
    $this->registerServices();
  }

  private function registerServices(): void{
    $this->request = Request::createFromGlobals();
    $this->view = new View();
    $this->router = new Router($this->view, $this->request);
    $this->validator = new Validator();
    $this->request->setValidator($this->validator);

  }
}