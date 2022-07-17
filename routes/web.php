<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Components\Home\HomeController;
use App\Http\Controllers\MainController;

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


Route::get('/login', [MainController::class, 'login'])->name('login');
Route::get('/registration', [MainController::class, 'registration'] )->name('registration');
Route::post('/auth.save', [MainController::class, 'save'])->name('auth.save');
Route::post('/auth.check', [MainController::class, 'check'])->name('auth.check');
Route::get('/logout', [MainController::class, 'logout'] )->name('logout');



Route::get('/home', function () {
  return view('home');
})->name('home');


Route::get('/budger', function () {
  return view('budger.budger');
})->name('budger');

Route::get('/eventor', function () {
  return view('eventor.eventor');
})->name('eventor');

Route::get('/stuffer', function () {
  return view('stuffer.stuffer');
})->name('stuffer');

Route::get('/warehouser', function () {
  return view('warehouser.warehouser');
})->name('warehouser');


Route::get('/diary', function () {
  return view('diary.diary');
})->name('diary');