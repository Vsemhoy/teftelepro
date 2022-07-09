<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Components\Home\HomeController;

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
    return view('welcome');
})->name('welcome');

Route::get('/home', function () {
  return view('home');
})->name('home');


Route::get('/budger', function () {
  return view('budger');
})->name('budger');

Route::get('/eventor', function () {
  return view('eventor');
})->name('eventor');

Route::get('/stuffer', function () {
  return view('stuffer');
})->name('stuffer');

Route::get('/warehouser', function () {
  return view('warehouser');
})->name('warehouser');