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

class BudgerMain extends BaseController
{
  public $weekdayNames = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];
  // need to set ICONPATH
  // $iconpath = "/components/com_teftelebudget/src/Media/icons/";


  const AGENTS = 'bud_agents';
  const BASKET  = 'bud_basket';
  const CATEGORIES = 'bud_categories';
  const EVENTS = 'bud_events';
  const TOTALS = 'bud_totals';
  const EVENT_TEMPLATES  = 'bud_event_templates';

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
  public $items;

  public $URL;
  

  //http://link/foo.php?id[]=1&id[]=2&id[]=3

  public function __construct($USER = '0')
  {
    $this->URL = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); //. rtrim($_SERVER['SERVER_NAME'] , '/') . 
    $this->_GET_PARAMS = "";
    $this->_params_startMonth = "";
    $this->_params_endMonth = "";

    $this->input = new Input();

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
              if ($param  != "stm" && $param != "enm"){

                $this->_GET_PARAMS .= $param . "=" . $value . "&";
              }
            };
        }
      };
    
    if (empty($this->_params_startMonth)){
      $this->_params_startMonth = $this->get_startMonth;
    };
    if (empty($this->_params_endMonth)){
      $this->_params_endMonth = $this->get_lastMonth;
    };
    
    $this->_btn_prev_month_date = date("Y-m", strtotime($this->_params_startMonth . " -1 month"));
    $this->_btn_next_month_date = date("Y-m", strtotime($this->_params_endMonth . " +1 month"));

    $this->_btn_go_prevMonth = $this->URL . "?" . $this->_GET_PARAMS . "stm=" . $this->_btn_prev_month_date . "&enm=" . $this->_btn_prev_month_date;
    $this->_btn_go_nextMonth = $this->URL . "?" . $this->_GET_PARAMS . "stm=" . $this->_btn_next_month_date . "&enm=" . $this->_btn_next_month_date;

    $this->_btn_expand_prevMonth = $this->URL . "?" . $this->_GET_PARAMS . "stm=" . $this->_btn_prev_month_date . "&enm=" . $this->_params_endMonth;
    $this->_btn_expand_nextMonth = $this->URL . "?" . $this->_GET_PARAMS . "stm=" . $this->_params_startMonth . "&enm=" . $this->_btn_next_month_date;

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

    $this->Accounts = self::LoadAccountList_keyId($USER, $this->defaultPage);
    $this->Template_Objects = self::LoadTemplateList_ALL_keyId($USER);
    $this->Goods_Objects = self::LoadGoodsList($USER);
    $this->Categories_Objects = self::LoadGroupList_ALL_keyId($USER);

    $this->tableLength = self::countDaysBetweenDates($this->get_startMonth, $this->get_lastMonth);
    $this->currentCurr = 1;


    $accounts = "";
    $counter = 0;
    foreach ($this->Accounts AS $acco)
    {
      $accounts .= $acco->id;
      if ($counter < count($this->Accounts) - 1){
        $accounts .= ",";
      }
      $counter++;
    }
    $this->items = self::LoadItemsToChart($USER, $accounts, $this->_params_startMonth, $this->_btn_next_month_date);
    // require_once( JPATH_SITE . "/components/com_teftelebudget/tmpl/_templates/tpl_events.php" );

  }


  /* ----------------------- get accounts ------------------------ */
  public static function LoadAccountList_keyId($user, $defaultPage = 0 ){
    //  FIRST HARVEST LANGUAGES to arrange items into Currency-groups
    // it was object list associated by id's
    $result = DB::select('select * from ' . env('TB_BUD_ACCOUNTS') . ' where user = :user AND notshow = 0 AND is_removed = 0 ORDER BY ordered ASC', ['user' => $user, ]);
    return Utils::arrayToIndexed($result);
  }


  public static function LoadAccountList_ALL_keyId($user){
    //  FIRST HARVEST LANGUAGES to arrange items into Currency-groups
    $result = DB::select('select * from ' . env('TB_BUD_ACCOUNTS') . ' where user = :user ORDER BY ordered ASC', ['user' => $user, ]);
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
  // public static function LoadGroupList_NotArchieved($user){
  //   $result = DB::select('select * from ' . env('TB_BUD_GROUPS') . ' where user = :user AND archieved = 0 ORDER BY ordered ASC', ['user' => $user, ]);
  //   return Utils::arrayToIndexed($result);
  // }
  // public static function LoadGroupList_Archieved($user){
  //   $result = DB::select('select * from ' . env('TB_BUD_GROUPS') . ' where user = :user AND archieved = 1 ORDER BY ordered ASC', ['user' => $user, ]);
  //   return Utils::arrayToIndexed($result);
  // }

/* ----------------------- get totals ------------------------ */
  public static function LoadAllTotals($user, $startmonth, $lastmonth, $accounts){
    // $newstartmonth = date("Y-m-d", strtotime($startmonth . "-1 month"));
    // $db = parent::getDbo();
    // $query = $db->getQuery(true);
    // $query->select('*');
    // $query->from($db->quoteName('#__tf_budget_totals'));
    // $query->where($db->quoteName('user') . ' = ' . $db->quote($user));
    // $query->where($db->quoteName('account') . ' IN (' . $accounts . ')');
    // $query->where($db->quoteName('setdate') . ' BETWEEN ' . $db->quote($newstartmonth) . ' AND ' . $db->quote($lastmonth));
    // $query->order('setdate ASC');
    // $db->setQuery($query);
    // $result = $db->loadObjectList();
    // $accArr = explode(",", $accounts);
    // $falsecounter = count($accArr);
    // foreach ($accArr AS $account){  // Looking for last month totals
    //   foreach ($result AS $object){
    //     if (isset($object->value)){ 
    //       $falsecounter--;
    //       break;
    //     };
    //   };
    // };
    // if ($falsecounter == 0){
    //   return $result;
    // } else { // If totals not esist (it may be Gap), we get last amount value by each account and return it here
    //   $resultObjects = [];
    //   foreach ($accArr AS $account){
    //     $acc = trim($account);
    //     $db = parent::getDbo();
    //     $query = $db->getQuery(true);
    //     $query->select('*');
    //     $query->from($db->quoteName('#__tf_budget_totals'));
    //     $query->where($db->quoteName('user') . ' = ' . $db->quote($user));
    //     $query->where($db->quoteName('account') . ' = ' . $db->quote($acc));
    //     $query->where($db->quoteName('disabled') . ' = ' . $db->quote(0));
    //     $query->where($db->quoteName('setdate') . ' < ' . $db->quote($lastmonth));
    //     $query->order('setdate DESC');
    //     $db->setQuery($query);
    //     $result = $db->loadObject();
    //       /* We don't need to fill Gaps, because user can not set new events
    //       and we fill Gaps only if user will create an event */
    //     if (!empty($result)){ // If we found values in the past, we pack it into array
    //       $result->setdate = $newstartmonth;
    //       array_push($resultObjects, $result);
    //     } else {              // But if we don't find them, we create empty object and return it
    //       $cork = (object)[];
    //       $cork->setdate = $newstartmonth;
    //       $cork->value   = 0;
    //       $cork->account = $acc;
    //       $cork->user    = $user;
    //       array_push($resultObjects, $cork);
    //     };
    // }
    // return $resultObjects;
    // };
  }


/* ----------------------- get items ------------------------ */
  public static function LoadItemsToChart($user, $accounts, $startmonth, $lastmonth){
    if (is_array($accounts)){
      $accounts = Utils::arrayToCommaSeparated($accounts);
    }
    $result = null;
    // $result = DB::select('select * from ' . env('TB_BUD_EVENTS') . ' where user = :user AND is_removed = 0 AND account IN (' . 
    // $accounts . ') AND date_in BETWEEN ' . $startmonth . ' AND ' . $lastmonth . ' ORDER BY ordered ASC', ['user' => $user, ]);
    //return Utils::arrayToIndexed($result);
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


public function renderNavigateButtons(){
  $result = "";
  $result .= "<div class='container'>";
  $result .= "<div class='btn-group mb-3 m-auto d-table' role='group' aria-label='Basic outlined example'>";
  $result .= "<a type='button' href='" . $this->_btn_go_prevMonth ."' class='btn btn-outline-secondary'><i class=' bi-chevron-left'></i></a>";
  $result .= "<a type='button' href='". $this->_btn_expand_prevMonth ."'  class='btn btn-outline-secondary'>";
  $result .= "<i class=' bi-chevron-left'></i>";
  $result .= "<i class=' bi-plus'></i>";
  $result .= "</a>";
  $result .= "<button type='button' id='f_showEmptyRows' class='btn btn-outline-secondary' title='COM_TFBUDGET_BUTTON_HIDEEMPTY'>";
  $result .= "<i class=' bi-distribute-vertical'></i>";
  $result .= "</button>";
  $result .= "<button  type='button' id='f_showTotalCols' class='btn btn-outline-secondary' title='COM_TFBUDGET_BUTTON_HIDETOTALS'>";
  $result .= "<i class=' bi-grip-vertical'></i>";
  $result .= "</button>";
  $result .= "<button type='button' onclick='databaseRecount();' class='d-none btn btn-outline-danger'>Update Database</button>";
  $result .= "<button type='button' onclick='recounttotals();' class='d-none btn btn-outline-secondary'>RECOUNT TOTALS</button>";
  $result .= "<button type='button' onclick='tf_create(1, 0);' class='btn btn-outline-secondary' title='COM_TFBUDGET_BUTTON_NEWEVENT'>";
  $result .= "<i class=' bi-journal-plus'></i>";
  $result .= "</button>";
  $result .= "<a type='button' href='". $this->_btn_expand_nextMonth ."' class='btn btn-outline-secondary'>";
  $result .= "<i class=' bi-plus'></i>";
  $result .= "<i class=' bi-chevron-right'></i>";
  $result .= "</a>";
  $result .= "<a type='button'href='". $this->_btn_go_nextMonth ."'  class='btn btn-outline-secondary'><i class=' bi-chevron-right'></i></a>";
  $result .= "</div>";
  $result .= "</div>";
  $result .= "<br>";
  return $result;
}


public function renderMonthTable(){
  return 0;
}

public function tableTotalSectton($date, $accountsToloadArr, $isEnd = false){
  $result = "";
  if ($isEnd == true){
    $date       = date('Y-m-d', strtotime($date . "-1 month"));
  };
  $datemonth_ = date('m', strtotime($date));
  $dateyear_  = date('Y', strtotime($date));
  $dateObj    = DateTime::createFromFormat('!m', $datemonth_);
  $monthname  = $dateObj->format('F');
  $date4total = $dateyear_ . "-" . $dateObj->format('m') . "-01";
  $result .= "<tr class='bg-subtotal subtotal'>
  <td class='' colspan='2'><b><span class='tf-table-monthname'>" . $monthname . "</span> <span class='stdtyr'>" . $dateyear_ . "</span></b></td>";
  foreach ($accountsToloadArr AS $account){
    $result .=  "<td class='mtotalio'><small>COM_TFBUDGET_COMMON_TYPE_INCOMS<span class='incoms'></span></small></br><small>COM_TFBUDGET_COMMON_TYPE_EXPENSES<span class='expences'></span></small></br><small>COM_TFBUDGET_TABLE_DIFFERENCE<span class='difference'></span></small></td>
    <td class='mtotals'>COM_TFBUDGET_COMMON_NAME_BALANCE<span class='subtotalbal' date='" . $date4total . "' foracc='" . trim($account->id) . "'>";
    $ttv = 0;
        foreach ($this->items AS $total){
          if ($total->setdate == $date4total && $total->account ==  $account->id){
              $ttv = $total->value;
          }
        }
        $result .=  $ttv;
    $result .=  "</span></td>";
  };
  if (count($accountsToloadArr) > 1){
    $result .=  "<td class='totalofrow_s'><small>COM_TFBUDGET_COMMON_NAME_BALANCE"  . 
    ": <span class='incoms'></span></small></br><small>COM_TFBUDGET_COMMON_TYPE_EXPENSES" . 
    ": <span class='expences'></span></small></br><small>COM_TFBUDGET_TABLE_DIFFERENCE<span class='difference'></span></small></td>";
  };
  $result .=  "</tr>";
  return $result;
}

public function renderWholeTable(){
  /* --------------------------- IF ACCOUNTS EXISTs, LOAD TABLE ------------------------------- */
  $result = "";

    $idconstructor   = "";
    $idconstructorrow = 0;
    $idconstructorcol = 0;
    $daytotal         = 0;
    $currentDate = date('Y-m-d', time());
    $cdate = date('m/d/Y', strtotime($this->get_lastMonth));
    $cdate_day = date('d', strtotime($this->get_lastMonth));
    $secondcounter = 0;

  
    $result .= "<p>" . count($this->Accounts) . "</p>";
    $result .= "<table class='uk-table uk-table-striped uk-table-hover uk-table-small budgetable'>
    <thead>
    <tr>
      <th scope='col' class='tthd'>_DATE</th>
      <th scope='col' class='tthd'>
      <span class='datetrigwrap'>
        <input class='headdate' type='month' id='dateflash' 
            name='flash_date' value='" . $this->get_startMonth_filter . "' />
            </span></th>";
    if (count($this->Accounts)){
      foreach ($this->Accounts AS $accid){
        $result .=  "<th scope='col' acc='" . trim($accid->id) . "' decimal='" . $accid->decimals . "'>" . $accid->name . "</th>
        <th class='daytotals' scope='col' accfor='" . trim($accid->id) . "'>" . "TOTAL" . "</th>";
      }
    }
    if (count($this->Accounts) > 1){
      $result .= '<th scope="col" class="headtotal ttfr">' . Text::_('COM_TFBUDGET_TABLE_HEAD_TOTALS') . '</th>';
    };
    $result .= "</tr>
    </thead>
    <tbody id='budgettable'>";

  if ($cdate_day != 1){
    for ($i = 0; $i < 32; $i++){
      $secondcounter = ($i * 60 * 60 * 24);
      $tmpdate_day = date('d', strtotime($this->get_lastMonth) + $secondcounter + (60 * 60 * 24));
      if ($tmpdate_day == 1){
        break;
      }
    }
  }
  
  
  /* LOOP */
  for ($x = 0; $x < $this->tableLength; $x++){
    $date = date('Y-m-d', strtotime($this->get_lastMonth) - ($x * 60 * 60 * 24) + $secondcounter);
    $shortDate = date('d', strtotime($this->get_lastMonth) - ($x * 60 * 60 * 24) + $secondcounter);
    $week = date('w', strtotime($this->get_lastMonth) - ($x * 60 * 60 * 24) + $secondcounter);
    $daynum = date('d', strtotime($this->get_lastMonth) - ($x * 60 * 60 * 24) + $secondcounter);
    $idconstructorrow = $x;
    if ($x == 0){
      //$result .= "HELLLO";
      $result .= $this->tableTotalSectton($date, $this->Accounts);
    };
  
    $cdateclass = "";
    $cdateIden = "";
    if ($date == $currentDate){
      $cdateclass = " currentdate";
      $empty = "";
    };
    if ($week == 0 || $week == 6){
      $cdateclass .= " weekend";
    }
   //$result .= $this->tableLength;
    $result .=  "<tr class='budrow {$cdateclass}' id='dragrow_{$idconstructorrow}' date='{$date}'>
    <td class='tf_datetd'  title='{$date}' scope='row'>{$shortDate}</td>
    <td  class='tf_daytd'>" . $this->weekdayNames[$week] . "</td>";
    $t = 0;
    foreach ($this->Accounts AS $account){
      $accountid = $account->id;
      $idconstructorcol = $t;
      $result .=  "<td id='dragarea_" . $idconstructorrow . "_" . $idconstructorcol . "' 
      class='droptabledata' ondrop='drop(event)' ondragover='allowDrop(event)'
      acc='{$accountid}' date='{$date}' ><span class='daytotal'>";
      if (empty($empty)) {
         // echo $randvalue[$t];
       };
  // onclick='tf_create(1, this);'
       $result .=  "</span><span  class='rect table-button-right event_trigger' uk-icon='icon: plus'>
       <i class='bi-plus-lg' title='Add new item' title='edit' data-bs-toggle='modal' data-bs-target='#EditorWindow'>
       </i></span>";
       foreach ($this->items AS $_object){
        if ($_object->datein == $date){
          if ($_object->account == $accountid){
            if (trim($_object->type) < 3){
  
              if (!empty($_object->groups)) {
                $_grpname      = $groups_Objects[$_object->groups]->name;
                $_gpricon      = $groups_Objects[$_object->groups]->icon;
                $_grpcolor     = $groups_Objects[$_object->groups]->color; 
                $_grpwhiteicon = $groups_Objects[$_object->groups]->whiteicon; 
              };
              if (empty($_object->groups) || !isset($_grpname)) {
                  $_grpname      = '';
                  $_gpricon      = '';
                  $_grpcolor     = '';
                  $_grpwhiteicon = '';
                };
  
              echo tpl_in_calendar_event( // $group, $groupname, $icon, $iconcolor, $iconpath, 
              $_object->id, 
              $_object->name, 
              $_object->text, 
              $_object->datein,
              $_object->account, 
              $_object->type, 
              $_object->value,
              $_object->groups,
              $_grpname, 
              $_gpricon,
              $_grpcolor, 
              $_grpwhiteicon,
              $iconpath,
              0, // frequency
              $_object->ordered,
              1,
              $_object->disabled,
              $_object->accented); // RENDERER
            } else {
              if (!isset($allAccounts)){
                $allAccounts = IndexModel::LoadAccountList_ALL_keyId(USERID);
              };
              echo tpl_in_calendar_event_transfer(
                $_object->id, 
                $_object->name, 
                $_object->text, 
                $_object->datein,
                $_object->transaccount,
                $_object->transferred,
                $allAccounts[$_object->transaccount]->name,
                $allAccounts[$_object->transaccount]->color,
                $allAccounts[$_object->transaccount]->currency,
                $_object->type,  
                $_object->value,
                $_object->ordered); // RENDERER */
            };
          }
        }
      }
      $result .=  "</td>";
      $result .=  "<td class='daytotals' for='{$accountid}' date='{$date}'></td>";
      $t++;
    };
    if (count($this->Accounts) > 1){
      $result .=  "<td class='totalofrow'></td>";
    };
    $result .=  "</tr>";
  if ($daynum == 1){
    $result .= $this->tableTotalSectton($date, $this->Accounts, true);
  };
  };

  $result .= "</tbody>
    </table>";
    // if NO ACCOUNTS, GO create account BUTTON
    return $result;
}

public function renderNoAccounts(){
  $result .=  "<h3>There is no accounts yet, please make one</h3>";
  $result .=  "<a href='/index.php/component/teftelebudget/?view=accounts&modal=open'>
<input type='button' class='btn btn-info' value='CREATE ACCOUNT'/>
</a>";
return $result;
}

}