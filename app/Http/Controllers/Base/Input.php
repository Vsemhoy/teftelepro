<?php

namespace App\Http\Controllers\Base;

class Input
{
  function get($param, $default = "", $FILTER = "STRING")
  {
    if (isset($_GET) && isset($_GET[$param]))
    { 
      $FILTER = strtoupper($FILTER);
      $result = $_GET[$param];
      $filternamelow  = strtolower($FILTER);

      
      if (isset(self::$$filternamelow))
      {
        $result = self::filterMe($FILTER, $result);
        //echo $result;
      }
      else 
      {
        $result = self::filterMe($FILTER, "");
        //echo $result;
      }
      return $result;
    }
    else
    {
      return $default;
    }
  }


  // const INT              = FILTER_SANITIZE_NUMBER_INT;
  // const STRING           = FILTER_SANITIZE_STRING;
  // const URL              = FILTER_SANITIZE_URL;
  // const EMAIL            = FILTER_SANITIZE_EMAIL;
  // const URLENCODE        = FILTER_SANITIZE_ENCODED;
  // const ADDSLASHES       = FILTER_SANITIZE_ADD_SLASHES;
  // const FLOAT            = FILTER_SANITIZE_NUMBER_FLOAT;
  // const ESCAPECHARS      = FILTER_SANITIZE_SPECIAL_CHARS; 
  // const HTMLSPECIALCHARS = FILTER_SANITIZE_FULL_SPECIAL_CHARS;
  //const RAW              = FILTER_UNSAFE_RAW;


  public static function filterMe($filter, $input, $length = 0)
  {
    $filter = strtoupper($filter);
    if ($filter == 'INT')
    {
      return self::INT($input);
    }
    elseif ($filter == 'STRING' || $filter == 'TEXT')
    {
      if ($length != 0){
        return substr( self::STRING($input), 0 , $length);
      }
      return self::STRING($input);
    }
    elseif ($filter == 'WORD')
    {
      return preg_replace( "/[^a-zA-Z0-9]/i", "", $input );
    }
    elseif ($filter == 'WORDS')
    {
      return preg_replace( "/[^a-zA-Z0-9 ]/i", "", $input );
    }
    elseif ($filter == 'RAW')
    {
      return self::RAW($input);
    }
    elseif ($filter == 'URL')
    {
      return self::URL($input);
    }
    elseif ($filter == 'EMAIL')
    {
      return self::EMAIL($input);
    }
    elseif ($filter == 'URLENCODE')
    {
      return self::URLENCODE($input);
    }
    elseif ($filter == 'ADDSLASHES')
    {
      return self::ADDSLASHES($input);
    }
    elseif ($filter == 'FLOAT')
    {
      if ($input == ""){ return 0; }
      return self::ESCAPECHARS($input);
    }
    elseif ($filter == 'HTMLSPECIALCHARS')
    {
      return self::HTMLSPECIALCHARS($input);
    }
    elseif ($filter == 'ARRAY')
    {
      return self::ARRAY($input);
    }
    elseif ($filter == 'INTARAY')
    {
      return self::INTARRAY($input);
    }
    elseif ($filter == 'DATE')
    {
      return self::DATE($input);
    }
    else 
    {
      return self::STRING($input);
    }
  }

  public static $raw = true;
  public static function RAW($value)
  {
    return filter_var($value, FILTER_UNSAFE_RAW);
  } 
  
  public static $int = true;
  public static function INT($value)
  {
    if ($value == ""){ $value = 0; };
    return filter_var($value, FILTER_SANITIZE_NUMBER_INT);
  } 

  public static $string = true;
  public static function STRING($value)
  {
    return filter_var($value, FILTER_SANITIZE_STRING);
  } 

  public static $url = true;
  public static function URL($value)
  {
    return filter_var($value, FILTER_SANITIZE_URL);
  } 

  public static $email = true;
  public static function EMAIL($value)
  {
    return filter_var($value, FILTER_SANITIZE_EMAIL);
  } 

  public static $urlencode = true;
  public static function URLENCODE($value)
  {
    return filter_var($value, FILTER_SANITIZE_ENCODED);
  } 

  public static $addslashes = true;
  public static function ADDSLASHES($value)
  {
    return filter_var($value, FILTER_SANITIZE_ADD_SLASHES);
  } 

  public static $float = true;
  public static function FLOAT($value)
  {
    return filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT);
  } 

  public static $escapechars = true;
  public static function ESCAPECHARS($value)
  {
    return filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
  } 

  public static $htmlspecialchars = true;
  public static function HTMLSPECIALCHARS($value)
  {
    //return htmlspecialchars($value, ENT_QUOTES);
    return filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }


  public static $date = true;
  public static function DATE($value)
  {
    // returns formatted date of current date if false
    $newformat = '';
    try {
      $time = strtotime($value);
      $newformat = date('Y-m-d', $time);
    }  finally {
      if ($newformat == '1970-01-01'){
        $newformat = date('Y-m-d', time());
      }
    }
    return $newformat;
  }

  public static $array = true;
  public static function ARRAY($value)
  {
    //return htmlspecialchars($value, ENT_QUOTES);
    if (is_array($value)){
      return $value;
    }
    return [];
  }

  public static $intarray = true;
  public static function INTARRAY($value)
  {
    //return htmlspecialchars($value, ENT_QUOTES);
    if (is_array($value)){
      $arr = [];
      foreach ($value AS $number){
        $num = self::INT($number);
        if (is_numeric($num)){
          array_push($arr, $num);
        }
      }
      return $arr;
    } else {
      if ($value == ""){
        return "";
      } else {
        return self::INT($value);
      }
    }
  } 

  
}