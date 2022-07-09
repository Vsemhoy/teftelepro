<?php
namespace App\Http\Controllers\Components\Budger;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Objects\SidemenuItem;

class BudgerController extends BaseController
{
    public $sideMenu;
    public $name;
    public $title;
    
    public function __construct()
    {
      $this->sideMenu = [];
      $this->name = "Budget";
      $this->title = "Simple Budget manager";

      $this->_buildSideMenu();
    }
    
    private function _buildSideMenu()
    {

      $menuItem1 = new SidemenuItem("Basic Accounts", false);
      $menuItem1->itemReference = "#";
      $menuItem1->itemLetters = "BA";
      $menuItem1->itemIcon = "";
      $menuItem1->itemBadge = "120";
      $menuItem1->itemClass = "";
      $menuItem1->badgeClass = "";
      //$menuItem1->isDivider = $isDiv;
      array_push($this->sideMenu, $menuItem1 );
      
      $menuItem2 = new SidemenuItem("Shared Accounts", false);
      $menuItem2->itemReference = "#";
      $menuItem2->itemLetters = "SA";
      $menuItem2->itemIcon = "";
      $menuItem2->itemBadge = "";
      $menuItem2->itemClass = "";
      $menuItem1->badgeClass = "";
      //$menuItem1->isDivider = $isDiv;
      array_push($this->sideMenu, $menuItem2 );

      $menuItem2 = new SidemenuItem("Group accounts", false);
      $menuItem2->itemReference = "#";
      $menuItem2->itemLetters = "GA";
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
      $menuItem4->itemReference = "#";
      $menuItem4->itemLetters = "BS";
      $menuItem4->itemIcon = "";
      $menuItem4->itemBadge = "";
      $menuItem4->itemClass = "";
      $menuItem4->badgeClass = "";
      //$menuItem1->isDivider = $isDiv;
      array_push($this->sideMenu, $menuItem4 );

      $menuItem5 = new SidemenuItem("Group Manager", false);
      $menuItem5->itemReference = "#";
      $menuItem5->itemLetters = "GM";
      $menuItem5->itemIcon = "bi-collection";
      $menuItem5->itemBadge = "";
      $menuItem5->itemClass = "";
      $menuItem5->badgeClass = "";
      //$menuItem1->isDivider = $isDiv;
      array_push($this->sideMenu, $menuItem5 );

      $menuItem5 = new SidemenuItem("Accoount Grouping", false);
      $menuItem5->itemReference = "#";
      $menuItem5->itemLetters = "AG";
      $menuItem5->itemIcon = "";
      $menuItem5->itemBadge = "";
      $menuItem5->itemClass = "";
      $menuItem5->badgeClass = "";
      //$menuItem1->isDivider = $isDiv;
      array_push($this->sideMenu, $menuItem5 );
      
      return $this;
    }

}