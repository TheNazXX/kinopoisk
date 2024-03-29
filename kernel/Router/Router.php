<?php


namespace Kernel\Router;

use Kernel\Router\Route;
use Kernel\Http\Request;
use Kernel\View\View;

class Router {

  public function __construct(
    private View $view,
    private Request $request
  ){
    $this->initRoutes();
  }

  private array $routes=  [
    'GET' => [],
    'POST' => []
  ];

  public function initRoutes(){
    $routes = $this->getRoutes(); 

    foreach($routes as $route){
      $this->routes[$route->getMethod()][$route->getUri()] = $route;
    }
  }

  public function dispatch(string $uri, string $method): void{
    $route = $this->findRoute($uri, $method);

    if(!$route){
      echo '404 | Not found';
      return;
    }

    if(is_array($route->getAction())){
      [$controller, $method] = $route->getAction();

      $controller = new $controller();


      call_user_func([$controller, 'setRequest'], $this->request);
      call_user_func([$controller, 'setView'], $this->view);
      call_user_func([$controller, $method]);
      return;
    }

    call_user_func($route->getAction());

  }

  private function getRoutes(): array{
    return require ROOT . '/config/routes.php';
  }

  private function findRoute(string $uri, string $method): Route|false{
    if(!isset($this->routes[$method][$uri])){
      return false;
    }

    return $this->routes[$method][$uri];
  }
}