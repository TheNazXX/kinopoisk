<?php 

namespace Kernel\Controller;

use Kernel\View\View;
use Kernel\Http\Request;

abstract class Controller
{
  private View $view;
  private Request $request;

  public function view(string $name){
    $this->view->page($name);
  }

  public function setView(View $view){
    $this->view = $view;
  }

  public function getRequest(){
    return $this->request;
  }

  public function setRequest(Request $request){
    $this->request = $request;

  }
}