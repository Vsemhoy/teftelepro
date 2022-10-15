<?php
namespace App\Http\Controllers\Components;
use App\Http\Controllers\Base\Input;

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

  public static function arrayToaArray($array)
  {
    if (is_array($array)){
      $iArray = [];
      foreach ($array AS $value){
        array_push($iArray, $value);
      }
      return $iArray;
    } else {
      $arr = [];
      return arr;
    }
  }


  public static function arrayToCommaSeparated($array){
    $result = "";
    if (!is_array($array)){ return "";};
    for ($i = 0; $i < count($array); $i++){
      $result .= $array[$i];
      if ($i < (count($array) - 1)){
        $result .= ",";
      }
    }
    return $result;
  }


  public function quoteName($name, $as = null)
	{
		if (\is_string($name))
		{
			$name = $this->quoteNameString($name);

			if ($as !== null)
			{
				$name .= ' AS ' . $this->quoteNameString($as, true);
			}

			return $name;
		}

		$fin = [];

		if ($as === null)
		{
			foreach ($name as $str)
			{
				$fin[] = $this->quoteName($str);
			}
		}
		elseif (\is_array($name) && (\count($name) === \count($as)))
		{
			$count = \count($name);

			for ($i = 0; $i < $count; $i++)
			{
				$fin[] = $this->quoteName($name[$i], $as[$i]);
			}
		}

		return $fin;
	}

  // Quote string coming from quoteName call.
  protected function quoteNameString($name, $asSinglePart = false)
	{
		$q = $this->nameQuote . $this->nameQuote;

		// Double quote reserved keyword
		$name = str_replace($q[1], $q[1] . $q[1], $name);

		if ($asSinglePart)
		{
			return $q[0] . $name . $q[1];
		}

		return $q[0] . str_replace('.', "$q[1].$q[0]", $name) . $q[1];
	}


  // Quote strings coming from quoteName call.
  protected function quoteNameStr($strArr)
	{
		$parts = [];
		$q     = $this->nameQuote;

		foreach ($strArr as $part)
		{
			if ($part === null)
			{
				continue;
			}

			if (\strlen($q) === 1)
			{
				$parts[] = $q . $part . $q;
			}
			else
			{
				$parts[] = $q[0] . $part . $q[1];
			}
		}

		return implode('.', $parts);
	}

  //Quotes and optionally escapes a string to database requirements for use in database queries.
  public function quote($text, $escape = true)
	{
		if (\is_array($text))
		{
			foreach ($text as $k => $v)
			{
				$text[$k] = $this->quote($v, $escape);
			}

			return $text;
		}

		return '\'' . ($escape ? Input::HTMLSPECIALCHARS($text) : $text) . '\'';
	}


  //Quotes a binary string to database requirements for use in database queries.
  public function quoteBinary($data)
	{
		// SQL standard syntax for hexadecimal literals
		return "X'" . bin2hex($data) . "'";
	}


}