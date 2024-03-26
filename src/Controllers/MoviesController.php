<?php

namespace App\Controllers;

class MoviesController
{
  public function index(){
    include_once ROOT . '/views/pages/movies.php'; 
  }
}