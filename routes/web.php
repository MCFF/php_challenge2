<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    $response = HTTP::get('https://reqres.in/api/users');

    $json = json_decode($response->body());

    return view('list', [
        "contacts" => $json->data
    ]);
});

Route::get('details/{id}', function ($id){

    $response = HTTP::get('https://reqres.in/api/users/'.$id);

    $json = json_decode($response->body());

    return view('details',["contactInfo" => $json->data]);
});
