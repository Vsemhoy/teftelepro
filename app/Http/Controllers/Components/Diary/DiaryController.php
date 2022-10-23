<?php
namespace App\Http\Controllers\Components\Diary;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Objects\SideMenuItem;
use App\Http\Controllers\Base\Input;

class DiaryController extends BaseController
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
    // public $today_MY;
    // public $last_MY;

    // public $get_startMonth;
    // public $get_lastMonth;

    // private $_GET_PARAMS;
    // private $_params_startMonth = "";
    // private $_params_endMonth = "";

    // public $_btn_prev_month_date;
    // public $_btn_next_month_date;
    // public $_btn_go_prevMonth;
    // public $_btn_go_nextMonth;
    // public $_btn_expand_prevMonth;
    // public $_btn_expand_nextMonth;
    // public $get_startMonth_filter;
    // public $get_lastMonth_filter;

    // public $tableLength;
    // public $currentCurr;

    // public $__accounts;
    // public $__goods_Objects;
    // public $__groups_Objects;

    public $color_col_sidenav_bg = "rgb(193 0 66 / 82%) !important";
    public $color_col_sidenav_shadow = "rgb(108 0 25 / 70%) 0px 0px 200px inset !important";
    public $color_col_sidenav_divider = "rgb(251 176 190) !important";
    public $styles = [
      "/components/diary/main.css"
    ];
    //http://link/foo.php?id[]=1&id[]=2&id[]=3

    public function __construct()
    {
      $this->sideMenu = [];
      $this->name = "Diary";
      $this->title = "Simple diary";

      $this->_buildSideMenu();
    }
    
    

    private function _buildSideMenu()
    {
      $menuItem1 = new SideMenuItem("Main", false);
      $menuItem1->itemReference = route($this->componentName);
      $menuItem1->itemLetters = "MA";
      $menuItem1->itemIcon = "";
      $menuItem1->itemBadge = "";
      $menuItem1->itemClass = "";
      $menuItem1->badgeClass = "";
      //$menuItem1->isDivider = $isDiv;
      array_push($this->sideMenu, $menuItem1 );

      // $menuItem1 = new SideMenuItem("FLOW", false);
      // $menuItem1->itemReference = route("budger.flow");
      // $menuItem1->itemLetters = "FL";
      // $menuItem1->itemIcon = "";
      // $menuItem1->itemBadge = "120";
      // $menuItem1->itemClass = "";
      // $menuItem1->badgeClass = "";
      // //$menuItem1->isDivider = $isDiv;
      // array_push($this->sideMenu, $menuItem1 );

      // $menuItem1 = new SideMenuItem("Basic Accounts", false);
      // $menuItem1->itemReference = route("budger.base");
      // $menuItem1->itemLetters = "BA";
      // $menuItem1->itemIcon = "";
      // $menuItem1->itemBadge = "120";
      // $menuItem1->itemClass = "";
      // $menuItem1->badgeClass = "";
      // //$menuItem1->isDivider = $isDiv;
      // array_push($this->sideMenu, $menuItem1 );
      
      // $menuItem2 = new SideMenuItem("Shared Accounts", false);
      // $menuItem2->itemReference = route("budger.shares");
      // $menuItem2->itemLetters = "SA";
      // $menuItem2->itemIcon = "";
      // $menuItem2->itemBadge = "";
      // $menuItem2->itemClass = "";
      // $menuItem1->badgeClass = "";
      // //$menuItem1->isDivider = $isDiv;
      // array_push($this->sideMenu, $menuItem2 );

      // $menuItem2 = new SideMenuItem("Group accounts", false);
      // $menuItem2->itemReference = route("budger.group");
      // $menuItem2->itemLetters = "GA";
      // $menuItem2->itemIcon = "";
      // $menuItem2->itemBadge = "";
      // $menuItem2->itemClass = "";
      // $menuItem1->badgeClass = "";
      // //$menuItem1->isDivider = $isDiv;
      // array_push($this->sideMenu, $menuItem2 );

      // $menuItem2 = new SideMenuItem("Loans", false);
      // $menuItem2->itemReference = route("budger.loans");
      // $menuItem2->itemLetters = "LO";
      // $menuItem2->itemIcon = "";
      // $menuItem2->itemBadge = "";
      // $menuItem2->itemClass = "";
      // $menuItem1->badgeClass = "";
      // //$menuItem1->isDivider = $isDiv;
      // array_push($this->sideMenu, $menuItem2 );

      // $menuItem2 = new SideMenuItem("Credits", false);
      // $menuItem2->itemReference = route("budger.credits");
      // $menuItem2->itemLetters = "CR";
      // $menuItem2->itemIcon = "";
      // $menuItem2->itemBadge = "";
      // $menuItem2->itemClass = "";
      // $menuItem1->badgeClass = "";
      // //$menuItem1->isDivider = $isDiv;
      // array_push($this->sideMenu, $menuItem2 );

      
      // $menuItem3 = new SideMenuItem("Utilities:", true);
      // $menuItem3->itemReference = "";
      // $menuItem3->itemLetters = "GA";
      // $menuItem3->itemIcon = "bi-dot";
      // $menuItem3->itemBadge = "";
      // $menuItem3->itemClass = "";
      // $menuItem3->badgeClass = "";
      // //$menuItem1->isDivider = $isDiv;
      // array_push($this->sideMenu, $menuItem3 );

      $menuItem4 = new SideMenuItem("Account manager", false);
      $menuItem4->itemReference = route("budger.accmanager");
      $menuItem4->itemLetters = "BS";
      $menuItem4->itemIcon = "";
      $menuItem4->itemBadge = "";
      $menuItem4->itemClass = "";
      $menuItem4->badgeClass = "";
      //$menuItem1->isDivider = $isDiv;
      array_push($this->sideMenu, $menuItem4 );

      $menuItem5 = new SideMenuItem("Category Manager", false);
      $menuItem5->itemReference = route("budger.catmanager");
      $menuItem5->itemLetters = "GM";
      $menuItem5->itemIcon = "";
      $menuItem5->itemBadge = "";
      $menuItem5->itemClass = "";
      $menuItem5->badgeClass = "";
      //$menuItem1->isDivider = $isDiv;
      array_push($this->sideMenu, $menuItem5 );

      // $menuItem5 = new SideMenuItem("Accoount Grouping", false);
      // $menuItem5->itemReference = route("budger.group");
      // $menuItem5->itemLetters = "AG";
      // $menuItem5->itemIcon = "";
      // $menuItem5->itemBadge = "";
      // $menuItem5->itemClass = "";
      // $menuItem5->badgeClass = "";
      // //$menuItem1->isDivider = $isDiv;
      // array_push($this->sideMenu, $menuItem5 );
      
      $menuItem3 = new SideMenuItem("Statistics:", true);
      $menuItem3->itemReference = "";
      $menuItem3->itemLetters = "ST";
      $menuItem3->itemIcon = "bi-dot";
      $menuItem3->itemBadge = "";
      $menuItem3->itemClass = "";
      $menuItem3->badgeClass = "";
      //$menuItem1->isDivider = $isDiv;
      array_push($this->sideMenu, $menuItem3 );

      $menuItem4 = new SideMenuItem("Common stat", false);
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