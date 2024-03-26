<?php


namespace App\Router;

use App\Router\Route;

class Router {

  public function __construct(){
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
      call_user_func([new $controller, $method]);
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