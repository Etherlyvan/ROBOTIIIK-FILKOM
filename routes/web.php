<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return view('home',["title"=>"Home"]);
});

Route::get('/division', function () {
    return view('division', ["title"=>"Division"]);
});

Route::get('/relation', function () {
    return view('relation', ["title"=>"Relation"]);
});

Route::get('/publication', function () {
    return view('publication', ["title"=>"Publication"]);
});

Route::get('/service', function () {
    return view('service', ["title"=>"Service"]);
});

Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'authenticate']);

Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);