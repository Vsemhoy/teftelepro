<?php
namespace App\Http\Controllers\Components\Budger;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Objects\SidemenuItem;
use App\Http\Controllers\Base\Input;

class BudgerController extends BaseController
{   
    private $componentName = "budger";
    public $sideMenu;
    public $name;
    public $title;
    public $input;

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

    public $__accounts;
    public $__goods_Objects;
    public $__groups_Objects;

    //http://link/foo.php?id[]=1&id[]=2&id[]=3

    public function __construct()
    {
      $this->sideMenu = [];
      $this->name = "Budget";
      $this->title = "Simple Budget manager";
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

      $this->_btn_prev_month_date ;
      $this->_btn_next_month_date ;
      $this->_btn_go_prevMonth    ;
      $this->_btn_go_nextMonth    ;
      $this->_btn_expand_prevMonth;
      $this->_btn_expand_nextMonth;
      $this->get_startMonth_filter;
      $this->get_lastMonth_filter ;
      $this->tableLength;
      $this->currentCurr;
      $this->__accounts;
      $this->__goods_Objects;
      $this->__groups_Objects;
    }
    
    private function _buildSideMenu()
    {
      $menuItem1 = new SidemenuItem("Main", false);
      $menuItem1->itemReference = route($this->componentName);
      $menuItem1->itemLetters = "MA";
      $menuItem1->itemIcon = "";
      $menuItem1->itemBadge = "";
      $menuItem1->itemClass = "";
      $menuItem1->badgeClass = "";
      //$menuItem1->isDivider = $isDiv;
      array_push($this->sideMenu, $menuItem1 );

      $menuItem1 = new SidemenuItem("Basic Accounts", false);
      $menuItem1->itemReference = route("budger.base");
      $menuItem1->itemLetters = "BA";
      $menuItem1->itemIcon = "";
      $menuItem1->itemBadge = "120";
      $menuItem1->itemClass = "";
      $menuItem1->badgeClass = "";
      //$menuItem1->isDivider = $isDiv;
      array_push($this->sideMenu, $menuItem1 );
      
      $menuItem2 = new SidemenuItem("Shared Accounts", false);
      $menuItem2->itemReference = route("budger.shares");
      $menuItem2->itemLetters = "SA";
      $menuItem2->itemIcon = "";
      $menuItem2->itemBadge = "";
      $menuItem2->itemClass = "";
      $menuItem1->badgeClass = "";
      //$menuItem1->isDivider = $isDiv;
      array_push($this->sideMenu, $menuItem2 );

      $menuItem2 = new SidemenuItem("Group accounts", false);
      $menuItem2->itemReference = route("budger.group");
      $menuItem2->itemLetters = "GA";
      $menuItem2->itemIcon = "";
      $menuItem2->itemBadge = "";
      $menuItem2->itemClass = "";
      $menuItem1->badgeClass = "";
      //$menuItem1->isDivider = $isDiv;
      array_push($this->sideMenu, $menuItem2 );

      $menuItem2 = new SidemenuItem("Loans", false);
      $menuItem2->itemReference = route("budger.loans");
      $menuItem2->itemLetters = "LO";
      $menuItem2->itemIcon = "";
      $menuItem2->itemBadge = "";
      $menuItem2->itemClass = "";
      $menuItem1->badgeClass = "";
      //$menuItem1->isDivider = $isDiv;
      array_push($this->sideMenu, $menuItem2 );

      $menuItem2 = new SidemenuItem("Credits", false);
      $menuItem2->itemReference = route("budger.credits");
      $menuItem2->itemLetters = "CR";
      $menuItem2->itemIcon = "";
      $menuItem2->itemBadge = "";
      $menuItem2->itemClass = "";
      $menuItem1->badgeClass = "";
      //$menuItem1->isDivider = $isDiv;
      array_push($this->sideMenu, $menuItem2 );

      
      $menuItem3 = new SidemenuItem("Utilities:", true);
      $menuItem3->itemReference = "";
      $menuItem3->itemLetters = "GA";
      $menuItem3->itemIcon = "bi-dot";
      $menuItem3->itemBadge = "";
      $menuItem3->itemClass = "";
      $menuItem3->badgeClass = "";
      //$menuItem1->isDivider = $isDiv;
      array_push($this->sideMenu, $menuItem3 );

      $menuItem4 = new SidemenuItem("Account manager", false);
      $menuItem4->itemReference = route("budger.accmanager");
      $menuItem4->itemLetters = "BS";
      $menuItem4->itemIcon = "";
      $menuItem4->itemBadge = "";
      $menuItem4->itemClass = "";
      $menuItem4->badgeClass = "";
      //$menuItem1->isDivider = $isDiv;
      array_push($this->sideMenu, $menuItem4 );

      $menuItem5 = new SidemenuItem("Category Manager", false);
      $menuItem5->itemReference = route("budger.catmanager");
      $menuItem5->itemLetters = "GM";
      $menuItem5->itemIcon = "bi-collection";
      $menuItem5->itemBadge = "";
      $menuItem5->itemClass = "";
      $menuItem5->badgeClass = "";
      //$menuItem1->isDivider = $isDiv;
      array_push($this->sideMenu, $menuItem5 );

      $menuItem5 = new SidemenuItem("Accoount Grouping", false);
      $menuItem5->itemReference = route("budger.group");
      $menuItem5->itemLetters = "AG";
      $menuItem5->itemIcon = "";
      $menuItem5->itemBadge = "";
      $menuItem5->itemClass = "";
      $menuItem5->badgeClass = "";
      //$menuItem1->isDivider = $isDiv;
      array_push($this->sideMenu, $menuItem5 );
      
      $menuItem3 = new SidemenuItem("Statistics:", true);
      $menuItem3->itemReference = "";
      $menuItem3->itemLetters = "ST";
      $menuItem3->itemIcon = "bi-dot";
      $menuItem3->itemBadge = "";
      $menuItem3->itemClass = "";
      $menuItem3->badgeClass = "";
      //$menuItem1->isDivider = $isDiv;
      array_push($this->sideMenu, $menuItem3 );

      $menuItem4 = new SidemenuItem("Common stat", false);
      $menuItem4->itemReference = route("budger.commstat");
      $menuItem4->itemLetters = "CS";
      $menuItem4->itemIcon = "";
      $menuItem4->itemBadge = "";
      $menuItem4->itemClass = "";
      $menuItem4->badgeClass = "";
      //$menuItem1->isDivider = $isDiv;
      array_push($this->sideMenu, $menuItem4 );

      return $this;
    }




}