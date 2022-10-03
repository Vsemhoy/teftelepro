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
use App\Http\Controllers\Components\Budger\BudgerData;
use App\Http\Controllers\Components\Budger\BudgerTemplates;
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
  public $currentCurrency;

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

  public $accounts;
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
    $this->currentCurrency = BudgerData::GetFirstCurrency($USER);
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

    $this->accounts = BudgerData::LoadAccountList_Currency_keyId($USER, $this->currentCurrency);
    $this->Template_Objects = BudgerData::LoadTemplateList_ALL_keyId($USER);
    $this->Goods_Objects = BudgerData::LoadGoodsList($USER);
    $this->Categories_Objects = BudgerData::LoadCategoryList_ALL_keyId($USER);

    $this->tableLength = self::countDaysBetweenDates($this->get_startMonth, $this->get_lastMonth);
    $this->currentCurr = 1;


    $accounts = "";
    $counter = 0;
    foreach ($this->accounts AS $acco)
    {
      $accounts .= $acco->id;
      if ($counter < count($this->accounts) - 1){
        $accounts .= ",";
      }
      $counter++;
    }
    $this->items = BudgerData::LoadItemsToChart($USER, $accounts, $this->_params_startMonth, $this->_btn_next_month_date);
    // require_once( JPATH_SITE . "/components/com_teftelebudget/tmpl/_templates/tpl_events.php" );

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
  $result .= "<div class='uk-container'>";
  $result .= "<div class='uk-button-group bud-navigation' >";
  $result .= "<a type='uk-button ' href='" . $this->_btn_go_prevMonth ."' class='uk-button uk-button-default'>
  <span uk-icon='chevron-left'></span></a>";
  $result .= "<a type='button' href='". $this->_btn_expand_prevMonth ."'  class='uk-button uk-button-default'>";
  $result .= "<span uk-icon='chevron-double-left'></span>";
  $result .= "</a>";
  $result .= "<button type='button' id='f_showEmptyRows' class='uk-button uk-button-default' title='HIDEEMPTY'>";
  $result .= "<span uk-icon='more'></span>";
  $result .= "</button>";
  $result .= "<button  type='button' id='f_showTotalCols' class='uk-button uk-button-default' title='HIDETOTALS'>";
  $result .= "<span uk-icon='more-vertical'></span>";
  $result .= "</button>";
  //$result .= "<button type='button' onclick='databaseRecount();' class='uk-button uk-button-default'>Update Database</button>";
 // $result .= "<button type='button' onclick='recounttotals();' class='uk-button uk-button-default'>RECOUNT TOTALS</button>";

  $result .= "<button type='button' href='#modal-container' uk-toggle class='uk-button uk-button-default' title='Navigator'>";
  $result .= "<span uk-icon='server'></span>";
  $result .= "</button>";
  $result .= "<button type='button' onclick='tf_create(1, 0);' class='uk-button uk-button-default' title='NEWEVENT'>";
  $result .= "<span uk-icon='file-text'></span>";
  $result .= "</button>";
  $result .= "<a type='button' href='". $this->_btn_expand_nextMonth ."' class='uk-button uk-button-default'>";
  $result .= "<span uk-icon='chevron-double-right'></span>";
  $result .= "</a>";
  $result .= "<a type='button'href='". $this->_btn_go_nextMonth ."'  class='uk-button uk-button-default'>
  <span uk-icon='chevron-right'></span></a>";
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
    $result .=  "<td class='mtotalio'><small>INCOMS<span class='incoms'></span></small></br><small>EXPENSES<span class='expences'></span></small></br><small>DIFFERENCE<span class='difference'></span></small></td>
    <td class='mtotals'>balance: <span class='subtotalbal' date='" . $date4total . "' foracc='" . trim($account->id) . "'>";
    $ttv = 0;
        foreach ($this->items AS $total){
          if ($total->date_in == $date4total && $total->account ==  $account->id){
              $ttv = $total->value;
          }
        }
        $result .=  $ttv;
    $result .=  "</span></td>";
  };
  if (count($accountsToloadArr) > 1){
    $result .=  "<td class='totalofrow_s'><small>balance: " . 
    ": <span class='incoms'></span></small></br><small>EXPENSES" . 
    ": <span class='expences'></span></small></br><small>DIFFERENCE<span class='difference'></span></small></td>";
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

  
    $result .= "<table class='uk-table uk-table-divider uk-table-hover uk-table-small budgetable'>
    <thead>
    <tr style='border-top: 1px solid #e5e5e5;'>
      <th scope='col' class='tthd'>_DATE</th>
      <th scope='col' class='tthd' style='border-right: 1px solid #e5e5e5;'>
      <span class='datetrigwrap'>
        <input class='headdate' type='month' id='dateflash' 
            name='flash_date' value='" . $this->get_startMonth_filter . "' />
            </span></th>";
    if (count($this->accounts)){
      foreach ($this->accounts AS $accid){
        $result .=  "<th scope='col' actype='" . $accid->type . "' account='" . trim($accid->id) . "' decimal='" . $accid->decimals . "'>" . $accid->name . "</th>
        <th class='daytotals' scope='col' accfor='" . trim($accid->id) . "' actype='" . $accid->type . "' >" . "TOTAL" . "</th>";
      }
    }
    if (count($this->accounts) > 1){
      $result .= '<th scope="col" class="headtotal totalofrow">' . 'TOTALS' . '</th>';
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
      $result .= $this->tableTotalSectton($date, $this->accounts);
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
    foreach ($this->accounts AS $account){
      $accountid = $account->id;
      $idconstructorcol = $t;
      $result .=  "<td id='dragarea_" . $idconstructorrow . "_" . $idconstructorcol . "' 
      class='droptabledata' ondrop='drop(event)' ondragover='allowDrop(event)'
      account='{$accountid}' date='{$date}' actype='" . $account->type . "'><span class='daytotal'>";
      if (empty($empty)) {
         // echo $randvalue[$t];
       };
  // onclick='tf_create(1, this);'
       $result .=  "</span><span  class='rect table-button-right event_trigger' uk-icon='icon: plus'>
       <i class='bi-plus-lg' title='Add new item' title='edit' data-bs-toggle='modal' data-bs-target='#EditorWindow'>
       </i></span>";

      //  $result .= count($this->accounts);
      //  $result .= "<br>";
      //  $result .= $this->_params_startMonth;
      //  $result .= "<br>";
      //  $result .= $this->_btn_next_month_date;
       foreach ($this->items AS $_object){
        if ($_object->date_in == $date){
          if ($_object->account == $accountid){
            if (trim($_object->type) < 3){
  
              if (!empty($this->Categories_Objects)) {
                if ($this->Categories_Objects[$_object->category]){

                  $_grpname      = $this->Categories_Objects[$_object->category]->name;
                  $_gpricon      = $this->Categories_Objects[$_object->category]->icon;
                  $_grpcolor     = $this->Categories_Objects[$_object->category]->color; 
                  $_grpwhiteicon = $this->Categories_Objects[$_object->category]->whiteicon; 
                }
              };
              if (empty($this->Categories_Objects) || !isset($_grpname)) {
                  $_grpname      = '';
                  $_gpricon      = '';
                  $_grpcolor     = '';
                  $_grpwhiteicon = '';
                };

              $result .= BudgerTemplates::tpl_in_calendar_event( // $group, $groupname, $icon, $iconcolor, $iconpath, 
              $_object->id, 
              $_object->name, 
              $_object->description, 
              $_object->date_in,
              $_object->account, 
              $_object->type, 
              $_object->value,
              $_object->category,
              $_grpname, 
              $_gpricon,
              $_grpcolor, 
              $_grpwhiteicon,
              "", //$iconpath,
              0, // frequency
              $_object->ordered,
              1,
              $_object->disabled,
              $_object->accented,
              $_object->haschildren); // RENDERER
            } else {
              if (!isset($allAccounts)){
                $allAccounts = IndexModel::LoadAccountList_ALL_keyId(USERID);
              };
              $result .= BudgerTemplates::tpl_in_calendar_event_transfer(
                $_object->id, 
                $_object->name, 
                $_object->description, 
                $_object->date_in,
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
      $result .=  "<td class='daytotals' for='{$accountid}' date='{$date}'  actype='" . $account->type . "'>0</td>";
      $t++;
    };
    if (count($this->accounts) > 1){
      $result .=  "<td class='totalofrow'></td>";
    };
    $result .=  "</tr>";
  if ($daynum == 1){
    $result .= $this->tableTotalSectton($date, $this->accounts, true);
  };
  };

  $result .= "</tbody>
    </table>";
    // if NO ACCOUNTS, GO create account BUTTON
    return $result;
}

// public function renderNoAccounts(){
//   $result .=  "<h3>There is no accounts yet, please make one</h3>";
//   $result .=  "<a href='/index.php/component/teftelebudget/?view=accounts&modal=open'>
// <input type='button' class='btn btn-info' value='CREATE ACCOUNT'/>
// </a>";
// return $result;
// }

}