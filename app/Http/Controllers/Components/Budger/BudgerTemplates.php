<?php
namespace App\Http\Controllers\Components\Budger;
///use App\Http\Controllers\Language\...;
use App\Http\Controllers\Components\Budger\BudgerController;
use Illuminate\Routing\Controller as BaseController;
 // No direct access to this file

class BudgerTemplates extends BaseController{









function tpl_in_calendar_event($id, $name, $text, $date, $account, $eventtype, $amount, $group = '', $groupname = '', $icon = '', $iconcolor = '', $whiteicon = '', $iconpath = '', $freq  = 0, $ordered = 0, $dataSection = 1, $disabled = 0, $accent = 0){
$length = strlen($text) / 4;
// Prevent insert negative values
if ($amount < 0){
  $amount = $amount * -1;
  };
  $addsign = '+';
if ($eventtype == 2){
  $amount = $amount * -1;
  $addsign = "";
};
if ($eventtype == 1){
  $transclasstype = "incom";
} else if ($eventtype  == 2) {
  $transclasstype = "expend";
} else if ($eventtype  == 3) {
  $transclasstype = "transfer";
} else if ($eventtype  == 4) {
  $transclasstype = "transfered";
};

if ($length < 10){
  $lengthClass = "shortest-text";
} else if ($length < 20){
  $lengthClass = "short-text";
} else if ($length < 40){
  $lengthClass = "middle-text";
} else if ($length < 80){
  $lengthClass = "long-text";
} else if ($length < 120) {
  $lengthClass = "longest-text";
} else {
  $lengthClass = "extrawide-text";
};

if ($dataSection == 1){
  $target = 'tf_item_';
} else if ($dataSection == 2){
  $target = 'tf_template_';
} else if ($dataSection == 3){
  $target = 'tf_good_';
};

$result = "";

$accentclass = "";
if ($accent == 1){
  $accentclass = " tf-accented";
};
$disclass = "";
if ($disabled == 1){
  $disclass = " tf-disabled";
  $accentclass = "";
};

//  openeditorwindow = 1 - type: 1-editchart; 2 - edit template, 3 - edit good; second = id of the element
$result .= '<div class="list-group-item py-1 tf_item dragtemplate ' . $transclasstype . $accentclass . $disclass . '" aria-current="true"
  id="'. $target . $id . '" draggable="true" ondragstart="drag(event)"
  template="22' . random_int(1, 30000) . '" type="' . $eventtype . '"
  onekeydown="tf_keyhandler(event)" frequency="' . $freq . '" ordered="' . $ordered . '">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">' . $name  . '</strong>
    <div>

    <span class="anchor fr pl-03rem tfItemMenuTrig" >
    <i class="bi-three-dots-vertical"></i>
    <div class="tfEventMenu d-none" section=' . $dataSection . ' id=' . $id . '>
      <ul>
        <li class="nav-item tf_edittrigger" >
          <a class="nav-link">
          <i class="bi-pencil-square"></i>
          <span class="">Edit Item</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="javascript:void(false);" class="nav-link">
          <i class="bi-toggle-off"></i>
          <span class="">Toggle active</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link">
          <i class="bi-bookmark"></i>
          <span class="">Toggle highlight</span>
          </a>
        </li>
        <li class="nav-item"  onclick="tf_deletethisitem(this);">
          <a class="nav-link">
          <i class="bi-trash-fill"></i>
          <span class="">Delete</span>
          </a>
        </li>';
        if (!empty($text)){
          $result .= '        <li class="nav-item" onclick="expandthistext(this)>
          <a class="nav-link">
          <i class="bi-eye"></i>
          <span class="">Delete</span>
          </a>
        </li>';
        };
        $result .= '</ul>
    </div>
    </span>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   ' . $lengthClass . '" onclick="dbc_opener(this);">
   ' . preg_replace("/\r\n|\r|\n/", '<br/>', $text) . '</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">' . $addsign . $amount  . '</strong>
  <div class="categories">';

  if (!empty($group)){
    $i_color = "";
    $i_white = "";
    $i_blacktext = "text-dark";
    if (!empty($iconcolor)){ $i_color = "style='background-color: #{$iconcolor};'";};
    if (!empty($whiteicon)){ $i_white = "dd-icon-inverted text-white"; $i_blacktext = "";};
    $result .= "<span class='badge {$i_blacktext}' {$i_color} category='{$group}'>";
    if (empty($icon)){
      $result .= $groupname;
    } else {
      $result .= "<img class='dd-icon {$i_white}' src='{$iconpath}{$icon}.svg' title='{$groupname}'>";
    };
    $result .= "</span>";
  }
  $result .= '</div>
</div>
</div>';
return $result;
}


function tpl_in_calendar_event_transfer($id, $name, $text, $date, $account, $targeter, $accname, $acccolor, $accurrency, $eventtype, $amount, $freq  = 0, $ordered = 0){
  $length = strlen($text) / 4;
  // Prevent insert negative values
  if ($amount < 0){
    $amount = $amount * -1;
    };
    $addsign = '+';
  if ($eventtype == 3){
    $amount = $amount * -1;
    $addsign = "";
  };
  $result = "";
  if ($eventtype == 1){
    $transclasstype = "incom";
  } else if ($eventtype  == 2) {
    $transclasstype = "expend";
  } else if ($eventtype  == 3) {
    $transclasstype = "transfer";
  } else if ($eventtype  == 4) {
    $transclasstype = "transfered";
  };
  
  if ($length < 10){
  $lengthClass = "shortest-text";
  } else if ($length < 20){
  $lengthClass = "short-text";
  } else if ($length < 40){
  $lengthClass = "middle-text";
  } else if ($length < 80){
  $lengthClass = "long-text";
  } else if ($length < 120) {
  $lengthClass = "longest-text";
  } else {
  $lengthClass = "extrawide-text";
  };
  //  openeditorwindow = 1 - type: 1-editchart; 2 - edit template, 3 - edit good; second = id of the element
  $result .= '<div class="list-group-item py-1 tf_item ' . $transclasstype . '" aria-current="true"
    id="tf_item_' . $id . '" draggable="true" ondragstart="drag(event)"
    type="' . $eventtype . '" target="' . $account . '"
    onekeydown="tf_keyhandler(event)" frequency="' . $freq . '" ordered="' . $ordered . '">
    <div class="d-flex w-100 align-items-center justify-content-between">
      <strong class="mb-1 namevalue">' . $name  . '</strong>
      <div>';
      if (!empty($text)){
        $result .= '<a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a>';
      };
      $result .= '<a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
      </div>
  
    </div>
    <div class="col-12 mb-1 small textvalue
     ' . $lengthClass . '" onclick="dbc_opener(this);">
     ' . preg_replace("/\r\n|\r|\n/", '<br/>', $text) . '</div>
    <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 amountvalue">' . $addsign . $amount  . '</strong>
    <div class="categories">';

  
    if (!empty($group)){
      $i_color = "";
      $i_white = "";
      $i_blacktext = "text-dark";
      if (!empty($iconcolor)){ $i_color = "style='background-color: #{$iconcolor};'";};
      if (!empty($whiteicon)){ $i_white = "dd-icon-inverted text-white"; $i_blacktext = "";};
      $result .= "<span class='badge {$i_blacktext}' {$i_color} category='{$group}'>";
      if (empty($icon)){
        $result .= $groupname;
      } else {
        $result .= "<img class='dd-icon {$i_white}' src='{$iconpath}{$icon}.svg' title='{$groupname}'>";
      };
      $result .= "</span>";
    }
    $result .= '</div>
  </div><hr class="mb-1 mt-1">';
  if ($eventtype == 3){
    $result .= "<span class='transferspan'>Transfer to </span>";
  } else {
    $result .= "<span class='transferspan'>Transfer from </span>";

  }
  $result .= $accname;
  $result .= '</div>';
  return $result;
}


function tpl_group_items($id, $parent, $name, $level, $icon, $whiteicon, $comment, $color, $itemcount, $type, $typename, $archieved) {
  // global $TPL_LOCALIZE;
   $dir_name = "/components/com_teftelebudget/src/Media/icons/"; //. JURI::base()
 
     $activelabel = "<i title='turn on category' onclick='do_active_cat(" . $id .");' class='bi-dash-square text-danger'></i>";
  if ($archieved == 1){$archieved = "archieved";} else {$archieved = "";};
   $block = "<li id='dd3_" . $id . "' class='dd-item dd3-item " . $archieved . "' data-id='" . $id . "'";
   if ($parent) {
     $block .= " data-parent='" . $parent . "'";
   };
   $block .= "><div class='dd-handle dd3-handle'";
   if ($color) {
     $block .= " style='background: #" . $color . ";'";
   }
   $iconcolor = "";
   if ($whiteicon){
     $iconcolor = "dd-icon-inverted";
   };
   if ($icon){
     $sideic_b = "";
     $sideic_a = "d-none";
    } else {
     $sideic_b = "d-none";
     $sideic_a = "";
  }
  $sideicon = "<img class='dd_i_b dd-icon {$iconcolor} {$sideic_b}' src='" . $dir_name . $icon .".svg' />
  <i class='dd_i_a bi-list dd-icon {$iconcolor} {$sideic_a}'></i>";
 if ($type == 1){
    $typeclass = "incom";
  } else {
    $typeclass = "expend";
  }
 
   $block .= ">{$sideicon}</div><div class='dd3-content'><div class='dd3-cent'>
   <span class='modal-trigger dd3-name h5' onclick='openeditor(" . $id . ");' 
   data-bs-toggle='modal' data-bs-target='#EditorWindow'>" . $name . "</span>
   <span class='dd3-bared dd3-icon'>" . $activelabel . "</span>
   <div class='dd3-groupinfo'>
   <span class='grouparchieved'>" . $archieved . "</span>
   <span class='groupname " . $typeclass . "' grouptype='" . $type . "'>" . $typename . "</span>
   <span class='itemcount'>" . $itemcount . " items</span></div>
   </div></div>";
  // $block .= tpl_group_items_modal('Edit Note Category', $name, $id, $comment, $icon, $whiteicon, $color);
     return $block;
 }



 function account_wrap_account($id, $curr, $part){
  if ($part == "start"){
  return '<div class="card mb-3 inshadow tf_account">
  <div class="card-head">
    <span class="cardhead-name">' . $curr . '</span>
    <div class="cardhead-buttons">
      <span class="cardhead-button moveup" title="move in sequence up"><i class="bi-chevron-up"></i></span>
      <span class="cardhead-button movedown" title="move in sequence down"><i class="bi-chevron-down"></i></span>
    </div>
  </div>
  <div class="card-body p-3 accard-dragarea" curr="' . $curr . '"
   id="currarea_' . $id . '" ondrop="drop(event)" ondragover="allowDrop(event)" curr="' . $curr . '">';
  } else {
    return '</div>
    </div>';
  };
}


function account_item_render($id, $name, $amount, $comment, $language, $accesstype){
  if ($amount > 0){
     $balclass = "incom-color";
  } else {
     $balclass = "expend-color";
  };
 return '<div class="card shadow mb-2 accard" id="acc_' . $id . '" acc="' . $id . '" draggable="true" ondragstart="drag(event)">
 <div class="card-body p-2">
 <h5 class="card-title modal-trigger" onclick="openeditor(' . $id . ');" 
 data-bs-toggle="modal" data-bs-target="#EditorWindow"><span class="mname">
 ' . $name . '</span><span class="card-balance ' . $balclass . '" 
 title="current balance">' . $amount . '</span></h5>
 <p class="card-text">' . $comment . '</p>
 </div>
 <div class="card-footer">
 <span>' . $language . '</span>
 <span>' . $accesstype . '</span>
 </div>
 </div>';
}



 function account_wrap_menu($name, $literals, $curr, $id, $part){
  if ($part == "start"){
  return '<div class="card mb-3 inshadow tf_minimenu" mid="' . $id . '" curr="' . $curr . '" id="tf_minimenu_' . $id . '">
  <div class="card-head">
    <span class="cardhead-name cardhead-liter">' . $literals . '</span>
    <span class="cardhead-name"><small>' . $name . '</small></span>
    <span class="cardhead-name"> (' . $curr . ')</span>
    <div class="cardhead-buttons">
      <span class="cardhead-button moveup_m" title="move in sequence up"><i class="bi-chevron-up"></i></span>
      <span class="cardhead-button movedown_m" title="move in sequence down"><i class="bi-chevron-down"></i></span>
      <span class="cardhead-button" title="delete" onclick="deleteitemenu(' . $id . ');"><i class="bi-x-lg"></i></span>
    </div>
  </div>
  <div class="card-body p-3 menus-dragarea" curr="' . $curr . '" 
  id="menuarea_' . $id . '" ondrop="drop(event)" ondragover="allowDrop(event)">';
  } else {
    return '</div>
    </div>';
  };
}





function account_menu_in_item($name, $order, $acc, $curr){
 return '<div class="card shadow mb-2 mencard" curr="' . $curr . '" acc="' . $acc . '" id="mit_' . $order . '" draggable="true" ondragstart="drag(event)">
 <div class="card-body p-2">
   <h5 class="card-title mb-0"><span class="mname"> ' . $name . '</span>
   <span class="cardhead-button float-right p-0" onclick="removecard(' . $order . ');" 
   title="delete"><i class="text-muted bi-x-lg "></i></span></h5>
 </div>
</div>';
}

function tpl_youAreGuestMessage() {
 $block='<div class="mt-4">
 <div class="alert alert-warning" role="alert">
 <h3>You are not registered!</h3>
   <p>You can use this PUBLIC demo account to understand what this service do, or you can <a href="/register.php"> Sign Up </a>and use your own private budget board.</p>
 </div>
</div>';
return $block;
}



function getMenuItems($current, $db, $user){
  if (is_object($db)){
  // Create a new query object
  $query = $db->getQuery(true);
  // Select all records 
  // Order it by the ordering field
  $query->select('*');
  $query->from($db->quoteName('#__tf_budget_menus'));
  $query->where($db->quoteName('user') . ' = ' . $db->quote($user));
  // Reset the query using your newly population query object
  $query->order('ordered ASC');
  $db->setQuery($query);
  // Load the results as a list of stdClass objects (see Later for more options on retrieving data)
  $result = '';
  $object =  $db->loadObjectList();
    if (!empty($object)){
      foreach ($object AS $item){
        $accounts = '';
        $accs = explode(',', $item->accounts);
        foreach ($accs AS $ac){
          if (!empty($ac)){
            $accounts .= "&acc[]=" . $ac;
          }
        }
        if ($item->id == $current){
          $activeclass = "active";
        } else {
          $activeclass = "";
        };
        $result .= '<li class="nav-item ' . $activeclass . '">
        <a href="index.php/component/teftelebudget/?view=teftele&mit=' . $item->id . $accounts . '"
         class="nav-link nl-fix ' . $activeclass . ' rounded-0" aria-current="page"
          title="" data-bs-toggle="tooltip" data-bs-placement="right"
           data-bs-original-title="Home"><span class="fs-4">' . $item->literals . '
           </span><span class="text-sm w-100 d-block"><small>' . $item->name . '</small></span>
        </a>
        </li>';
      }
    }
    return $result;
  } else {
    return true;
  }
}


  // $current = '';
  // $user = Factory::getUser();
  // $db   = Factory::getDbo();
  // $app  = Factory::getApplication();
  // $input = $app->input;
  // if (!empty($input->get('mit', '', 'CMD'))){
  //  $current = $input->get('mit', '', 'CMD');
  // };
  // $addition_menu_items = getMenuItems($current, $db, $user->id);


function renderdiarycard(){
  $result = '<div class="card-wraper card-parent looked" id="">
    <div class="inline-card">
      <div class="icard-head">
        <div class="icard-name">
    ' . generateRandomString(5) . '
        </div>
      </div>
      <div class="icard-body">
    ' . generateRandomString(50) . '
      </div>
      <div class="icard-footer">
    ' . generateRandomString(5) . '
      </div>
    </div>
  </div>';
return $result;
}

function renderDateSign(){
  $result = '<div class="card-wraper">
    <div class="inline-card-date">

        <div class="idate-inline">
    ' . generateRandomString(5) . '
        </div>

    </div>
  </div>';
return $result;
}

function renderEditorZone(){
  $result = '';
}


public static function renderEventModal()
{
  $result = "<div id='modal_event' class='uk-flex-top' uk-modal>
  <div class='uk-modal-dialog uk-margin-auto-vertical'>
  <button class='uk-modal-close-default' type='button' uk-close></button>
  <div class='uk-modal-header'>
      <h2 class='uk-modal-title'>Modal Title</h2>
  </div>
  <div>
  <div>
    <div class='uk-button-group uk-column-1-3 uk-width-1-1' style='column-gap: 0px;'>
        <button class='uk-button uk-button-primary uk-width-1-3'>Incom</button>
        <button class='uk-button uk-button-danger uk-width-1-3'>Expense</button>
        <button class='uk-button uk-button-secondary uk-width-1-3'>Transfer</button>
    </div>
  </div>
  </div>
  <div class='uk-modal-body'>
    <form>
    <fieldset class='uk-fieldset'>

        <!--legend class='uk-legend'>Legend</legend -->

        <div class='uk-margin uk-mb-0'>
            <input class='uk-input' type='text' placeholder='Name' id='tf_name'>
        </div>

        <div class='uk-margin uk-mb-0'>
            <textarea class='uk-textarea' rows='7' placeholder='Description' id='tf_description'></textarea>
        </div>

        <div class='uk-margin uk-mb-0 uk-inline uk-width-1-1' title='Amount of money'>
          <span class='uk-form-icon uk-form-icon' uk-icon='icon: database' ></span>
          <input class='uk-input' type='number' placeholder='Amount' inputmode='decimal' id='tf_amount'>
        </div>

        <div class='uk-margin uk-mb-0 uk-inline uk-width-1-1' title='Event date'>
          <span class='uk-form-icon uk-form-icon' uk-icon='icon: calendar' ></span>
          <input class='uk-input' type='date' placeholder='Date' id='tf_datedate'>
        </div>

        <div class='uk-margin uk-mb-0 uk-mt-half uk-width-1-1' title='Account'>
          <span class='small' >Account</span>
            <select class='uk-select' id='tf_account' placeholder='Account'>
                <option>Option 01</option>
                <option>Option 02</option>
            </select>
        </div>

        <div class='uk-margin uk-mb-0 uk-mt-half uk-width-1-1' title='Target account'>
          <span class='small' >Account</span>
            <select class='uk-select' id='tf_account' placeholder='Target account'>
                <option>Option 01</option>
                <option>Option 02</option>
            </select>
        </div>

        <div class='uk-margin uk-mb-0 uk-mt-half uk-width-1-1' title='Category of event'>
        <span class='small' >Category</span>
          <select class='uk-select' id='tf_group' placeholder='Account'>
              <option>Option 01</option>
              <option>Option 02</option>
          </select>
      </div>




    </fieldset>
  </form>
  </div>
  <div>
    <div class='uk-button-group uk-column-1-1 uk-width-1-1' style='column-gap: 0px;'>
        <button class='uk-button uk-button-default uk-width-1-2'>Additiona options</button>
        <button class='uk-button uk-button-default uk-width-1-2'>Sequence management</button>
    </div>
  </div>
  <div class='uk-modal-body' id='mod_options_body'>
    <form>
      <fieldset class='uk-fieldset'>

      <div class='uk-margin uk-mb-0 uk-grid-small uk-child-width-auto uk-grid'>
        <label><input class='uk-checkbox' type='checkbox' checked> Repeat event</label>
    </div>

    <div class='uk-margin uk-mb-0 uk-mt-half uk-width-1-1 uk-column-1-2' title='Main repeat options'>
    <span class='small' >Repeat period</span>
      <select class='uk-select' id='tf_repeatperiod' placeholder='Period of repeating'>
          <option>Every month</option>
          <option>Every week</option>
          <option>Every day</option>
          <option>Every Year</option>
      </select>
      <span class='small' >Repeat times</span>
      <input class='uk-input' type='number' placeholder='5 times...' min='1' max='36' step='1' inputmode='decimal' id='tf_repeattimes'>
  </div>

  <div class='uk-margin uk-mb-0 uk-width-1-1 uk-column-1-2' title='Additional repeat options'>

    <span class='small' >Every time Change amount for</span>
    <input class='uk-input' type='number' placeholder='+100' min='0' max='36000000' step='1' inputmode='decimal' id='tf_amountchanger'>

    <span class='small' >Stop repeating when reached</span>
    <input class='uk-input' type='number' placeholder='1000000' min='0' max='36000000' step='1' inputmode='decimal' id='tf_amoungoal'>
</div>

      </fieldset>
    </form>
  </div>

  <div class='uk-modal-body' id='mod_manage_body'>
    <form>
      <fieldset class='uk-fieldset'>

      <div class='uk-margin uk-mb-0 uk-grid-small uk-child-width-auto uk-grid'>
        <p>Remove all subsequent events</p>
        <p>Change all subsequent events (change name)</p>
        <p>Change all subsequent events (change amount)</p>
    </div>


      </fieldset>
    </form>
  </div>

  <div class='uk-modal-footer uk-text-right'>
      <button class='uk-button uk-button-default' type='button'>Disable</button>
      <button class='uk-button uk-button-default uk-modal-close' type='button'>Cancel</button>
      <button class='uk-button uk-button-primary' type='button'>Save</button>
  </div>
</div>
</div>";
  return $result;
}

// masterColor can be null, Icon can be null, and Items can be null, but need an array
public static function renderGroupContainer($id, $name, $masterColor, $icon, $items, $order = 0) 
{
  $iterator = 0;
  if (isset($items) && count($items) > 0){ $iterator = count($items); };
  if ($id != ""){ 
    if ($id == "rand") { 
      $id = "group_" . rand(1000000,32000000);
    } else {
      $id = "group_" . $id; 
    }
  } else {
    $id = "__NEWGROUP__";
  }

  $result  = "<div class='catBox uk-first-column' style='' id='" . $id . "' data-order='" . $order . "'>
  <h4>
  <span class='uk-icon-link uk-sortable-handle uk-icon' uk-icon='move' style='user-select: none;'>
  <svg width='20' height='20' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg'>
    <polygon points='4,5 1,5 1,9 2,9 2,6 4,6'>
    </polygon><polygon points='1,16 2,16 2,18 4,18 4,19 1,19'></polygon><polygon points='14,16 14,19 11,19 11,18 13,18 13,16'></polygon><rect fill='none' stroke='#000' x='5.5' y='1.5' width='13' height='13'></rect><rect x='1' y='11' width='1' height='3'></rect><rect x='6' y='18' width='3' height='1'></rect></svg></span>  
  <span class='groupname'>" . $name . "</span> 
  <span class='uk-text-muted counts'>[" . $iterator . "]</span>
  <span class='btn-colorize' uk-toggle='target: #modal-example'>colorize</span>
  <span class='btn-collapse'>collapse</span>
  <span class='btn-addItem'>create one<span>
</span></span></h4>
      <div uk-sortable='group: sortable-group' class='uk-sortable uk-sortable-empty' style=''>";
      if ($iterator != 0){
        foreach ($items AS $item)
        {
          $result .= $item;
        }
      }
$result .= "      </div>
  </div>";
  return $result;
}


public static function renderGroupItem($id, $name, $color, $isArchieved, $order = 0)
{
  $addClass = "";
  if ($id == "rand"){ 
    $id = "item_" . rand(1000000,32000000); 
  } else if ($id != ""){
    $id = "item_" . $id;
  } else {
    $id = "__NEWITEM__";
  }
  if ($name == "") { $name = "New item"; }
  if ($color == "" || $color == null){ } else { $color = "style='background-color: " . $color . "'"; }
  if ($isArchieved == true){
    $addClass .= " archieved hidden";
  }

  $result = "<div class='uk-margin card-box' id='" . $id . "' " . $color . " data-order='" . $order . "'>
  <div class='uk-card uk-card-default uk-card-body  uk-box-shadow-medium uk-card-small'>
  <span class='cardName'>" . $name . "</span><div class='uk-align-right'>
  <span class='itemMenu '><span class='' uk-icon='settings'></span>
  </span></div>
    </div>
  </div>";
  return $result;
}


public static function renderCategoryItemMenu(){
  $result = "<div id='itemMenu' data-target='' class='uk-dropdown uk-open menu-inverted' style=''>
  <ul class='uk-nav uk-dropdown-nav'>
     <!-- <li><a href='' data-event='opensettings' class='btnChangeColor'>Change color</a></li> -->
      <li  data-event='archieve' ><a class=''>Archieve</a></li>
      <li  data-event='restore'  ><a class=''>Restore</a></li>
      <li  data-event='remove'   ><a class=''>Remove forever</a></li>
  </ul>
</div>";
return $result;
}

};

?>