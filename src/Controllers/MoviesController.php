<?php

namespace App\Controllers;

use Kernel\Controller\Controller;
use Kernel\Validator\Validator;
use Kernel\Http\Redirect;

class MoviesController extends Controller
{
  public function index(){
    $this->view('movies');
  }
  
  public function add(){
    $this->view('admin/movies/add');
  }

  public function store(){
    $dataRules = ['name' => ['required', 'min:3', 'max:255']];

    if(!$this->getRequest()->validate($dataRules)){
      (new Redirect('/admin/movies/add'));
    };

    dump('success');
  }
}