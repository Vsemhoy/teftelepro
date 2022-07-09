<?php

namespace App\Http\Controllers\Objects;

use Illuminate\Routing\Controller as BaseController;

class SideMenuItem extends BaseController
{
    public $itemName;
    public $itemReference;
    public $itemLetters;
    public $itemIcon;
    public $itemBadge;
    public $itemClass;
    public $isDivider;
    public $badgeClass;


    public function __construct($name, $isDiv = false)
    {
      $this->itemName = $name;
      $this->itemReference = "";
      $this->itemLetters = "";
      $this->itemIcon = "";
      $this->itemBadge = "";
      $this->itemClass = "";
      $this->isDivider = $isDiv;
      $this->badgeClass = "";
    }
}
