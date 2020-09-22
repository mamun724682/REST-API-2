<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('/class', 'Api\SclassController');
Route::apiResource('/subject', 'Api\SubjectController');
Route::apiResource('/section', 'Api\SectionController');
Route::apiResource('/student', 'Api\StudentController');

Route::group([

    // 'middleware' => 'api',
    // 'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('register', 'AuthController@register');

});