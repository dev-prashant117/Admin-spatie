<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('admin', function () {
    return view('admin.index');
});

require __DIR__.'/admin.php';
