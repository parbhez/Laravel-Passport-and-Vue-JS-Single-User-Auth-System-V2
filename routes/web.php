<?php

use App\Http\Controllers\Api\BlogController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('app');
});

Route::get('/{pathName?}', function(){
    return view('app');
})->where('pathName', ".*");

