<?php
namespace App\Http\Controllers\Components\Home;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Objects\SidemenuItem;

class HomeController extends BaseController
{
    public $sideMenu;
    public $name;
    public $title;
    
    public function __construct()
    {
      $this->sideMenu = [];
      $this->name = "Home Page";
      $this->title = "TefteleCom home page";

      $this->_buildSideMenu();
    }
    
    private function _buildSideMenu()
    {

      $menuItem1 = new SidemenuItem("Home", false);
      $menuItem1->itemReference = "#";
      $menuItem1->itemLetters = "HO";
      $menuItem1->itemIcon = "";
      $menuItem1->itemBadge = "120";
      $menuItem1->itemClass = "";
      $menuItem1->badgeClass = "";
      //$menuItem1->isDivider = $isDiv;
      array_push($this->sideMenu, $menuItem1 );
      
      $menuItem2 = new SidemenuItem("Dashboard", false);
      $menuItem2->itemReference = "#";
      $menuItem2->itemLetters = "DB";
      $menuItem2->itemIcon = "home";
      $menuItem2->itemBadge = "";
      $menuItem2->itemClass = "";
      $menuItem1->badgeClass = "";
      //$menuItem1->isDivider = $isDiv;
      array_push($this->sideMenu, $menuItem2 );
      
      $menuItem3 = new SidemenuItem("Super Divider", true);
      $menuItem3->itemReference = "";
      $menuItem3->itemLetters = "BS";
      $menuItem3->itemIcon = "settings";
      $menuItem3->itemBadge = "";
      $menuItem3->itemClass = "";
      $menuItem3->badgeClass = "";
      //$menuItem1->isDivider = $isDiv;
      array_push($this->sideMenu, $menuItem3 );

      $menuItem4 = new SidemenuItem("Base Accounts", false);
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
      $menuItem5->itemIcon = "comment";
      $menuItem5->itemBadge = "";
      $menuItem5->itemClass = "";
      $menuItem5->badgeClass = "";
      //$menuItem1->isDivider = $isDiv;
      array_push($this->sideMenu, $menuItem5 );
      
      return $this;
    }

}