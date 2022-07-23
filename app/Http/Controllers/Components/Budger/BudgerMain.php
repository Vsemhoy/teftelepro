<?php
namespace App\Http\Controllers\Components\Budger;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Objects\SidemenuItem;
use App\Http\Controllers\Base\Input;

class BudgerMain extends BaseController
{
  public $weekdays = ['MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN'];
  // need to set ICONPATH
  // $iconpath = "/components/com_teftelebudget/src/Media/icons/";

  public $get_groups;
  public $get_accounts;
  public $get_currency;
  public $defaultPage;

  // Month & Year
  public $today_MY;
  public $last_MY;

  public $DATE;

  public $get_startMonth;
  public $get_lastMonth;

  private $_GET_PARAMS;
  private $_params_startMonth = "";
  private $_params_endMonth = "";

  public $_btn_prev_month_date;
  public $_btn_next_month_date;
  public $_btn_go_prevMonth;
  public $_btn_go_nextMonth;
  public $_btn_expand_prevMonth;
  public $_btn_expand_nextMonth;
  public $get_startMonth_filter;
  public $get_lastMonth_filter;

  public $tableLength;
  public $currentCurr;

  public $Accounts;
  public $Template_Objects;
  public $Goods_Objects;
  public $Categories_Objects;

  //http://link/foo.php?id[]=1&id[]=2&id[]=3

  public function __construct($USER = '0')
  {
    $this->_GET_PARAMS = "";
    $this->_params_startMonth = "";
    $this->_params_endMonth = "";

    $this->input = new Input();
    $this->_buildSideMenu();

    $this->get_groups = $this->input->get('grp', '', 'STRING');
    $this->get_accounts = $this->input->get('grp', '', 'ARRAY');
    $this->get_currency = $this->input->get('grp', '', 'INT');

    if ($this->get_accounts == ""){
    $this->defaultPage = 1;
    }

    $this->today_MY = date("Y-m");
    $this->last_MY  =  date("Y-m", strtotime("-0 Months")); // Here we can set count of month loaded default

    $this->get_startMonth = $this->input->get('stm',$this->last_MY,'URL');   // date of start table (future)
    $this->get_lastMonth  = $this->input->get('enm',$this->today_MY,'URL');   // date of end table (past)
    if (empty($this->input->get('stm',"",'URL'))){
      $this->get_startMonth = $this->get_lastMonth;
    };
    if (empty($this->input->get('enm',"",'URL'))){
      $this->get_lastMonth = $this->get_startMonth;
    };
    if (strtotime($this->get_lastMonth) < strtotime($this->get_startMonth)){
      $this->get_lastMonth = $this->get_startMonth;
    }

      $this->_params_startMonth = $this->input->get('stm', '', 'URL');
      $this->_params_endMonth = $this->input->get('enm', '', 'URL');
      
      if (is_array($_GET)){
        foreach($_GET AS $param => $value){
            if (is_array($value)){
              $iter = 0;
              foreach ($value AS $eulav){
                $iter++;
                $this->_GET_PARAMS .= $param . "[]=" . $eulav . "&";
              }
            } else {
               $this->_GET_PARAMS .= $param . "=" . $value . "&";
            };
        }
      };
    
    if (empty($this->_params_startMonth)){
      $$his->_params_startMonth = $this->get_startMonth;
    };
    if (empty($this->_params_endMonth)){
      $this->_params_endMonth = $this->get_lastMonth;
    };
    
    $this->_btn_prev_month_date = date("Y-m", strtotime($this->_params_startMonth . " -1 month"));
    $this->_btn_next_month_date = date("Y-m", strtotime($this->_params_endMonth . " +1 month"));

    $this->_btn_go_prevMonth = $url . "?" . $this->_GET_PARAMS . "stm=" . $this->_btn_prev_month_date . "&enm=" . $this->_btn_prev_month_date;
    $this->_btn_go_nextMonth = $url . "?" . $this->_GET_PARAMS . "stm=" . $this->_btn_next_month_date . "&enm=" . $this->_btn_next_month_date;

    $this->_btn_expand_prevMonth = $url . "?" . $this->_GET_PARAMS . "stm=" . $this->_btn_prev_month_date . "&enm=" . $this->_params_endMonth;
    $this->_btn_expand_nextMonth = $url . "?" . $this->_GET_PARAMS . "stm=" . $this->_params_startMonth . "&enm=" . $this->_btn_next_month_date;

    $this->get_startMonth_filter = $this->get_startMonth;
    $this->get_lastMonth_filter = $this->get_lastMonth;

    $this->DATE = new DateTime($this->get_lastMonth . '-01');
    $this->DATE->modify('last day of this month');
    $this->get_startMonth .= "-01";   // date of start table
    $this->get_lastMonth = $this->DATE->format('Y-m-d'); // date of end table / - last day of the month
    
    // RESERVED
    $last_day_this_month = $this->DATE->format('Y-m-d');
    $total_start_date = date("Y-m-d", strtotime($this->get_startMonth . " -1 month"));
    $total_last_date = $this->DATE->format('Y-m');
    $total_last_date .= "-01";
    // END RESERVE

    $this->Accounts = self::LoadAccountList_keyId($USER, $defaultPage);
    $this->Template_Objects = self::LoadTemplateList($USER);
    $this->Goods_Objects = self::LoadGoodsList($USER);
    $this->Categories_Objects = self::LoadGroupList_keyId($USER);

    $this->tableLength = self::countDaysBetweenDates($this->get_startMonth, $this->get_lastMonth);
    $this->currentCurr = 1;

    // require_once( JPATH_SITE . "/components/com_teftelebudget/tmpl/_templates/tpl_events.php" );

  }


  /* ----------------------- get accounts ------------------------ */
  public static function LoadAccountList_keyId($user, $defaultPage = 0 ){
    //  FIRST HARVEST LANGUAGES to arrange items into Currency-groups
    $db = parent::getDbo();
    $query = $db->getQuery(true);
    $query->select('*');
    $query->from($db->quoteName('#__tf_budget_accounts'));
    $query->where($db->quoteName('user') . ' = ' . $db->quote($user));
    if ($defaultPage == 1){ 
      $query->where($db->quoteName('notshow') . ' = ' . $db->quote(0));
    };
    $query->where($db->quoteName('removed') . ' = ' . $db->quote(0));
    $query->order('ordered ASC');
    $db->setQuery($query);
    $result = $db->loadObjectList('id');
    return $result;
  }


  public static function LoadAccountList_ALL_keyId($user){
    //  FIRST HARVEST LANGUAGES to arrange items into Currency-groups
    $db = parent::getDbo();
    $query = $db->getQuery(true);
    $query->select('*');
    $query->from($db->quoteName('#__tf_budget_accounts'));
    $query->where($db->quoteName('user') . ' = ' . $db->quote($user));
    $query->order('ordered ASC');
    $db->setQuery($query);
    $result = $db->loadObjectList('id');
    return $result;
  }

/* ----------------------- get templates ------------------------ */
  public static function LoadTemplateList($user){
    $db = parent::getDbo();
    $query = $db->getQuery(true);
    $query->select('*');
    $query->from($db->quoteName('#__tf_budget_templates'));
    $query->where($db->quoteName('user') . ' = ' . $db->quote($user));
    $query->order('ordered ASC');
    $db->setQuery($query);
    $result = $db->loadObjectList(); 
    return $result;
  }

/* ----------------------- get goods ------------------------ */
  public static function LoadGoodsList($user){
    $db = parent::getDbo();
    $query = $db->getQuery(true);
    $query->select('*');
    $query->from($db->quoteName('#__tf_budget_goods'));
    $query->where($db->quoteName('user') . ' = ' . $db->quote($user));
    $query->order('ordered ASC');
    $db->setQuery($query);
    $result = $db->loadObjectList();
    return $result;
  }

  /* ----------------------- get Groups ------------------------ */
  public static function LoadGroupList_keyId($user){
    $db = parent::getDbo();
    $query = $db->getQuery(true);
    $query->select('*');
    $query->from($db->quoteName('#__tf_budget_groups'));
    $query->where($db->quoteName('user') . ' = ' . $db->quote($user));
    $query->order('ordered ASC');
    $db->setQuery($query);
    $result = $db->loadObjectList('id');
    return $result;
  }


/* ----------------------- get totals ------------------------ */
  public static function LoadAllTotals($user, $startmonth, $lastmonth, $accounts){
    $newstartmonth = date("Y-m-d", strtotime($startmonth . "-1 month"));
    $db = parent::getDbo();
    $query = $db->getQuery(true);
    $query->select('*');
    $query->from($db->quoteName('#__tf_budget_totals'));
    $query->where($db->quoteName('user') . ' = ' . $db->quote($user));
    $query->where($db->quoteName('account') . ' IN (' . $accounts . ')');
    $query->where($db->quoteName('setdate') . ' BETWEEN ' . $db->quote($newstartmonth) . ' AND ' . $db->quote($lastmonth));
    $query->order('setdate ASC');
    $db->setQuery($query);
    $result = $db->loadObjectList();
    $accArr = explode(",", $accounts);
    $falsecounter = count($accArr);
    foreach ($accArr AS $account){  // Looking for last month totals
      foreach ($result AS $object){
        if (isset($object->value)){ 
          $falsecounter--;
          break;
        };
      };
    };
    if ($falsecounter == 0){
      return $result;
    } else { // If totals not esist (it may be Gap), we get last amount value by each account and return it here
      $resultObjects = [];
      foreach ($accArr AS $account){
        $acc = trim($account);
        $db = parent::getDbo();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from($db->quoteName('#__tf_budget_totals'));
        $query->where($db->quoteName('user') . ' = ' . $db->quote($user));
        $query->where($db->quoteName('account') . ' = ' . $db->quote($acc));
        $query->where($db->quoteName('disabled') . ' = ' . $db->quote(0));
        $query->where($db->quoteName('setdate') . ' < ' . $db->quote($lastmonth));
        $query->order('setdate DESC');
        $db->setQuery($query);
        $result = $db->loadObject();
          /* We don't need to fill Gaps, because user can not set new events
          and we fill Gaps only if user will create an event */
        if (!empty($result)){ // If we found values in the past, we pack it into array
          $result->setdate = $newstartmonth;
          array_push($resultObjects, $result);
        } else {              // But if we don't find them, we create empty object and return it
          $cork = (object)[];
          $cork->setdate = $newstartmonth;
          $cork->value   = 0;
          $cork->account = $acc;
          $cork->user    = $user;
          array_push($resultObjects, $cork);
        };
    }
    return $resultObjects;
    };
  }


/* ----------------------- get items ------------------------ */
  public static function LoadItemsToChart($user, $accounts, $startmonth, $lastmonth){
    $db = parent::getDbo();
    $query = $db->getQuery(true);
    $query->select('*');
    $query->from($db->quoteName('#__tf_budget_items'));
    $query->where($db->quoteName('user') . ' = ' . $db->quote($user));
    $query->where($db->quoteName('account') . ' IN (' . $accounts . ')');
    $query->where($db->quoteName('datein') . ' BETWEEN ' . $db->quote($startmonth) . ' AND ' . $db->quote($lastmonth));
    $query->where($db->quoteName('removed') . ' = ' . $db->quote(0));
    $query->order('timec ASC');
    $db->setQuery($query);
    $result = $db->loadObjectList("id");
    return $result;
  }



/*--------------------S_E_R_V_I_C_E---------------------*/


/* ---------------- COUNT DAYS BETWEEN DATES (for Table length) -------- */
public static function countDaysBetweenDates($d1, $d2){
  $d1_ts = strtotime($d1);
  $d2_ts = strtotime($d2);
  $seconds = abs($d1_ts - $d2_ts);
  $d = floor($seconds / 86400);
  if ($d > 0){
    return $d + 1;
  } else {
    return 0;
  }
}

}