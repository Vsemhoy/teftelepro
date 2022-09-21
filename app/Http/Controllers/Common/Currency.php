<?php

namespace App\Http\Controllers\Common;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Objects\SidemenuItem;
use App\Http\Controllers\Base\Input;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Components\Utils;
use DateTime;

class Currency extends BaseController
{

  public static function getCurrencyList()
  {
    $result = DB::select('select * from ' . env('TB_COM_CURRENCY') . ' ORDER BY literals ASC');
    return Utils::arrayToIndexed($result);
  }
  /* ----------------------- Harvest Currencies from user accounts ------------------------ */
  public static function loadCurrencies($user){
    // $result = DB::select('select * from ' . env('TB_BUD_ACCOUNTS') . 
    // ' where user = :user AND notshow = 0 AND is_removed = 0 ORDER BY ordered ASC',
    //  ['user' => $user, ]);
    // return Utils::arrayToIndexed($result);

    // $db = parent::getDbo();
    // $query = $db->getQuery(true);
    // $query->select($db->quoteName('currency'));
    // $query->from($db->quoteName('#__tf_budget_accounts'));
    // $query->where($db->quoteName('user') . ' = ' . $db->quote($user));
    // $query->where($db->quoteName('removed') . ' = ' . $db->quote(0));
    // $query->order('ordered ASC');
    // $db->setQuery($query);
    // $currencies = $db->loadRowList(); // look here
    // $curs = [];
    // foreach ($currencies AS $curar){
    //   if (!in_array($curar[0], $curs)){
    //      array_push($curs, $curar[0]);
    //   };
    // };
    // unset($currencies);
    // return $curs;
  }
}