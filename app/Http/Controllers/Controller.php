<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Components\Home\HomeController;
use App\Http\Controllers\Components\Budger\BudgerController;
use App\Http\Controllers\Base\Input;
use Illuminate\Foundation\Auth\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



    public static function getComponent($compo)
    {
      $compo = strtolower($compo);
      switch ($compo)
      {
        case "home":
          $com = new HomeController();
          return $com;
          break;
        case "budger":
          $com = new BudgerController();
          return $com;
          break;
        default:
          $com = new HomeController();
          return $com;
          break;
      }
    }

    public static function getUser(){
      $user = User::where('id', '=', session('LoggedUser'))->first();
      return $user;
    }
}
