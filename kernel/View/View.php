<?php 

namespace Kernel\View;

class View 
{
  public function page(string $name): void
  {
    $viewPath =  VIEWS . "/pages/{$name}.php";

    if(!file_exists($viewPath)){
      throw new \Kernel\Exceptions\ViewNotFound("View $name not found");
    }

    extract([
      'view' => $this
    ]);


    include_once $viewPath;
  }

  public function component(string $name): void
  {
    $viewPath =   VIEWS . "/components/{$name}.php";
    
    if(!file_exists($viewPath)){
      throw new \Kernel\Exceptions\ViewNotFound("component $name not found");
    }

    extract([
      'view' => $this
    ]);


    include_once $viewPath;
  }
}