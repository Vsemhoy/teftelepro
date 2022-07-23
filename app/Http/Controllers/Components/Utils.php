<?php
namespace App\Http\Controllers\Components;

class Utils
{
  public static function arrayToIndexed($array, $key = 'id')
  {
    if (is_array($array)){
      $indexedArray = [];
      foreach ($array AS $value){
        $indexedArray[$value->$key] = $value;
      }
      return $indexedArray;
    } else {
      $arr = [];
      return arr;
    }
  }
}