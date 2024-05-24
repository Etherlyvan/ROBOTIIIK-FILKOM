<?php

use Illuminate\Support\Facades\Route;

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