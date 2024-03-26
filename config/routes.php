<?php

use App\Router\Route;

use App\Controllers\HomeController;
use App\Controllers\MoviesController;

return [
  Route::get('/', function(){
    include_once ROOT . '/views/pages/home.php'; 
  }),
  Route::get('/home', [HomeController::class, 'index']),
  Route::get('/movies', [MoviesController::class, 'index']),
];