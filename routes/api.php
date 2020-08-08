<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/fibonacci', 'FibonacciController@show');
Route::post('/sort', 'SortController@show');

Route::get('/employee/show', 'EmployeeController@show');
Route::post('/employee', 'EmployeeController@store');
Route::put('/employee/{id}', 'EmployeeController@update');
Route::delete('/employee', 'EmployeeController@destroy');
