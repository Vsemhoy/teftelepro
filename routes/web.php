<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Components\Home\HomeController;
use App\Http\Controllers\MainController;
use Illuminate\Http\Request;

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


Route::post('/auth.save', [MainController::class, 'save'])->name('auth.save');
Route::post('/auth.check', [MainController::class, 'check'])->name('auth.check');
Route::get('/logout', [MainController::class, 'logout'] )->name('logout');


Route::group(['middleware' => ['AuthCheck']], function(){
  
  Route::get('/login', [MainController::class, 'login'])->name('login');
  Route::get('/registration', [MainController::class, 'registration'] )->name('registration');
  
  Route::get('/settings', [MainController::class, 'settings'])->name('settings');
  Route::get('/profile', [MainController::class, 'profile'])->name('profile');
  Route::get('/staff', [MainController::class, 'staff'])->name('staff');

  Route::get('/home', function () {
    return view('home');
  })->name('home');

  Route::get('/budger', function () {
    return view('budger.budger');
  })->name('budger');

  Route::get('/warehouser', function () {
    return view('warehouser.warehouser');
  })->name('warehouser');
});






Route::get('/eventor', function () {
  return view('eventor.eventor');
})->name('eventor');

Route::get('/stuffer', function () {
  return view('stuffer.stuffer');
})->name('stuffer');

Route::get('/diary', function () {
  return view('diary.diary');
})->name('diary');