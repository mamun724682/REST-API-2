<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('/class', 'Api\SclassController');
Route::apiResource('/subject', 'Api\SubjectController');
Route::apiResource('/section', 'Api\SectionController');
