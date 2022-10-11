<?php 
namespace App\Http\Controllers\Components\Budger;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Objects\SidemenuItem;
use App\Http\Controllers\Base\Input;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Components\Utils;
use DateTime;

class BudgerData
{
    /* ----------------------- get accounts ------------------------ */
    public static function LoadAccountList_keyId($user, $defaultPage = 0 ){
      //  FIRST HARVEST LANGUAGES to arrange items into Currency-groups
      // it was object list associated by id's
      $result = DB::select('select * from ' . env('TB_BUD_ACCOUNTS') . 
      ' where user = :user AND notshow = 0 AND is_removed = 0 ORDER BY ordered ASC',
       ['user' => $user, ]);
       return Utils::arrayToIndexed($result);
      return $result;
    }
  
    public static function GetCurrencyOrder($user, $defaultPage = 0 ){
      //  FIRST HARVEST LANGUAGES to arrange items into Currency-groups
      // it was object list associated by id's
      $list = [];
      $result = DB::select('select `currency` from ' . env('TB_BUD_ACCOUNTS') . 
      ' where user = :user AND is_removed = 0 ' . 
      ' ORDER BY ordered ASC ',
       ['user' => $user, ]);
       foreach ($result AS $val){
        if (!in_array($val->currency, $list)){
          array_push($list, $val->currency);
        }
       }
       return $list;
    }


    public static function LoadAccountList($user, $defaultPage = 0 ){
      //  FIRST HARVEST LANGUAGES to arrange items into Currency-groups
      // it was object list associated by id's
      $result = DB::select('select * from ' . env('TB_BUD_ACCOUNTS') . 
      ' where user = :user AND is_removed = 0 ' . 
      ' ORDER BY ordered ASC ',
       ['user' => $user, ]);
      return $result;
    }


    public static function LoadAccountListNotShow($user, $defaultPage = 0 ){
      //  FIRST HARVEST LANGUAGES to arrange items into Currency-groups
      // it was object list associated by id's
      $result = DB::select('select * from ' . env('TB_BUD_ACCOUNTS') . 
      ' where user = :user AND notshow = 0 AND is_removed = 0 ' . 
      ' ORDER BY ordered ASC ',
       ['user' => $user, ]);
      return $result;
    }

    public static function getAccountNameById($id){
      $item = DB::table(env('TB_BUD_ACCOUNTS'))->where('id', $id )->first();
      if (isset($item->name)){
        return $item->name;
      }
      return "-???-";
    }
  
    public static function GetFirstCurrency($user){
      $row = DB::table( env('TB_BUD_ACCOUNTS') )
                ->orderBy('ordered')
                ->first();
      return $row->currency;
    }

    public static function LoadAccountList_Currency_keyId($user, $currency = 0){
      //  FIRST HARVEST LANGUAGES to arrange items into Currency-groups
      if ($currency == 0){ $currency = SELF::GetFirstCurrency($user);};
      $result = DB::select('select * from ' . env('TB_BUD_ACCOUNTS') . 
      ' where user = :user AND currency = :currency ORDER BY ordered ASC', ['user' => $user, 'currency' => $currency ]);
      return Utils::arrayToIndexed($result);
    }


    public static function LoadCurrencies_keyId($user){
      $result = DB::select('select * from ' . env('TB_COM_CURRENCY') . 
      ' where user = 0 OR user = :user AND is_removed = 0 ' .
      ' ORDER BY used ASC', ['user' => $user]);
      return Utils::arrayToIndexed($result);
    }
  
  /* ----------------------- get goods ------------------------ */
    public static function LoadAccountsByCurrency($user, $currency){
      $result = DB::select('select * from ' . env('TB_BUD_ACCOUNTS') . 
      ' where user = :user AND notshow = 0 AND is_removed = 0 AND currency = :curren ORDER BY ordered ASC', ['user' => $user, 'curren' => $currency]);
      return Utils::arrayToIndexed($result);
    }

  
  /* ----------------------- get templates ------------------------ */
    public static function LoadTemplateList_ALL_keyId($user){
      $result = DB::select('select * from ' . env('TB_BUD_EVENT_TEMPLATES') . ' where user = :user AND is_removed = 0 ORDER BY ordered ASC', ['user' => $user, ]);
      return Utils::arrayToIndexed($result);
    }
    public static function LoadTemplateList_NotArchieved($user){
      $result = DB::select('select * from ' . env('TB_BUD_EVENT_TEMPLATES') . ' where user = :user AND archieved = 0 AND is_removed = 0 ORDER BY ordered ASC', ['user' => $user, ]);
      return Utils::arrayToIndexed($result);
    }
    public static function LoadTemplateList_Archieved($user){
      $result = DB::select('select * from ' . env('TB_BUD_EVENT_TEMPLATES') . ' where user = :user AND  archieved = 1 AND is_removed = 0 ORDER BY ordered ASC', ['user' => $user, ]);
      return Utils::arrayToIndexed($result);
    }
  
    public static function LoadGroupedCategories($user){
      $groups = self::LoadGroupList_ALL_keyId($user);
      $categories = self::LoadCategoryList_ALL_keyId($user);
      $data = [];
      if (empty($categories)){return null;}
      foreach ($groups AS $k => $grp)
      {
          $inner = [];
          foreach ($categories AS $cat){
            if ($grp->id == $cat->grouper)
            {
              array_push($inner, $cat);
            }
          }
          $groups[$k]->data = $inner;
      }
      return $groups;
    }

  /* ----------------------- get goods ------------------------ */
    public static function LoadGoodsList($user){
      // $db = parent::getDbo();
      // $query = $db->getQuery(true);
      // $query->select('*');
      // $query->from($db->quoteName('#__tf_budget_goods'));
      // $query->where($db->quoteName('user') . ' = ' . $db->quote($user));
      // $query->order('ordered ASC');
      // $db->setQuery($query);
      // $result = $db->loadObjectList();
      // return $result;
    }
  
    /* ----------------------- get Groups ------------------------ */
    public static function LoadGroupList_ALL_keyId($user){
      $result = DB::select('select * from ' . env('TB_BUD_GROUPS') . ' where user = :user ORDER BY ordered ASC', ['user' => $user, ]);
      return Utils::arrayToIndexed($result);
    }
    public static function LoadGroupList_NotArchieved($user){
      $result = DB::select('select * from ' . env('TB_BUD_GROUPS') . ' where user = :user AND archieved = 0 ORDER BY ordered ASC', ['user' => $user, ]);
      return Utils::arrayToIndexed($result);
    }
    public static function LoadGroupList_Archieved($user){
      $result = DB::select('select * from ' . env('TB_BUD_GROUPS') . ' where user = :user AND archieved = 1 ORDER BY ordered ASC', ['user' => $user, ]);
      return Utils::arrayToIndexed($result);
    }
  
  
    public static function LoadCategoryList_ALL_keyId($user){
      $result = DB::select('select * from ' . env('TB_BUD_CATEGORIES') . ' where user = :user ORDER BY ordered ASC', ['user' => $user, ]);
      return Utils::arrayToIndexed($result);
    }

    public static function getCategoryNameById($id){
      $item = DB::table(env('TB_BUD_CATEGORIES'))->where('id', '=', $id )->first();
      if (isset($item->name)){
        return $item->name;
      }
      return "-Unnamed category-";
    }


    /* ----------------------- get items ------------------------ */
  public static function LoadItemsToChart($user, $accounts, $startmonth, $lastmonth){
    if (is_array($accounts)){
      $accounts = Utils::arrayToCommaSeparated($accounts);
    }
    $result = null;
    $result = DB::select('select * from ' . env('TB_BUD_EVENTS') . 
    ' where user = :user AND is_removed = 0  ORDER BY ordered ASC', ['user' => $user ]);

    return Utils::arrayToaArray($result);
    // $db = parent::getDbo();
    // $query = $db->getQuery(true);
    // $query->select('*');
    // $query->from($db->quoteName('#__tf_budget_items'));
    // $query->where($db->quoteName('user') . ' = ' . $db->quote($user));
    // $query->where($db->quoteName('account') . ' IN (' . $accounts . ')');
    // $query->where($db->quoteName('datein') . ' BETWEEN ' . $db->quote($startmonth) . ' AND ' . $db->quote($lastmonth));
    // $query->where($db->quoteName('removed') . ' = ' . $db->quote(0));
    // $query->order('timec ASC');
    // $db->setQuery($query);
    // $result = $db->loadObjectList("id");
    // return $result;
    // AND account IN ("' . 
    //$accounts . '") AND date_in BETWEEN "' . $startmonth . '" AND "' .
   // $lastmonth . '"
  }


}