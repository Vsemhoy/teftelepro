<?php
namespace App\Http\Controllers\Components\Budger;
///use App\Http\Controllers\Language\...;
use App\Http\Controllers\Components\Budger\BudgerController;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Components\Budger\BudgerData;
 // No direct access to this file

class BudgerTemplates extends BaseController{









  public static function tpl_in_calendar_event($id, $name, $text, $date, $account, $eventtype, $amount, $category = '', $catname = '', $icon = '', $iconcolor = '', $whiteicon = '', $iconpath = '', $ordered = 0, $dataSection = 1, $disabled = 0, $accent = 0, $haschildren = 0, $parent = 0){
$length = mb_strlen($text) / 4;
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

$lengthClass = '';
if ($length < 40){
  $lengthClass = "middle-text";
} else if ($length < 80){
  $lengthClass = "long-text";
} else if ($length < 120) {
  $lengthClass = "longest-text";
} else if ($length < 250) {
  $lengthClass = "extrawide-text";
} else {
  $lengthClass = "super-extrawide-text";
};

if ($dataSection == 1){
  $target = 'bud_item_';
} else if ($dataSection == 2){
  $target = 'bud_template_';
} else if ($dataSection == 3){
  $target = 'bud_good_';
};

$parentData = "";
if ($parent != 0){
  $parentData = "parent='" . $parent . "'";
}


$result = "";

$accentclass = "";
if ($accent == 1){
  $accentclass = " bud-accented";
};
$disclass = "";
if ($disabled == 1){
  $disclass = " bud-disabled";
};

//  openeditorwindow = 1 - type: 1-editchart; 2 - edit template, 3 - edit good; second = id of the element
$result .= "<div class='bud-event-card dragtemplate " . $transclasstype . $accentclass . $disclass .
 "' aria-current='true'
  id='" . $target . $id . "' draggable='true' ondragstart='drag(event)'
  template='22" . random_int(1, 30000) . "' type='" . $eventtype . "' ordered='" . $ordered . "'
  haschildren='" . $haschildren . "' " . $parentData . ">

  <div class='cardName'>
    <div class='bud-name'>" . $name . "</div>
    <div class='bud-trigger'>
      <span class='itemMenu '><span class='' uk-icon='settings'></span>
      </span>
    </span>
    </div>
    </div>";

        $result .= '
  <div class="col-12 mb-1 small bud-descr
   ' . $lengthClass . '" >
   ' . preg_replace("/\r\n|\r|\n/", '<br/>', $text) . '</div>
  <div class="bud-footer">
  <strong class="mb-1 bud-value">' . $addsign . $amount  . '</strong>
  <span>';
  if ($haschildren == 1){

    $result .= '<span uk-icon="icon: git-fork" class="bud-parent-icon" title="Has childrens"></span>';
  }
  if ($parent > 0){

    $result .= '<span uk-icon="icon: link" class="bud-linked-icon" title="linked to parent"></span>';
  }
  $result .= '</span>
  <div class="categories">';

  if (!empty($category)){
    $i_color = "";
    $i_white = "";
    $i_blacktext = "text-dark";
    if (!empty($iconcolor)){ $i_color = "style='background-color: #{$iconcolor};'";};
    if (!empty($whiteicon)){ $i_white = "dd-icon-inverted text-white"; $i_blacktext = "";};
    $result .= "<span class='bud-badge {$i_blacktext}' {$i_color} category='{$category}'>";
    if (empty($icon)){
      $result .= $catname;
    } else {
      $result .= "<img class='dd-icon {$i_white}' src='{$iconpath}{$icon}.svg' title='{$catname}'>";
    };
    $result .= "</span>";
  }
  $result .= '</div>
</div>
</div>';
return $result;
}


public static  function tpl_in_calendar_event_transfer($id, $trans_id, $name, $text, $date, $account, $transaccount, $eventtype, $amount, $category = '', $catname = '', $accname, $icon = '', $iconcolor = '', $whiteicon = '', $iconpath = '', $dataSection = 1, $disabled = 0, $accent = 0, $haschildren = 0, $parent = 0)
{
  $footerText = "";
  $transclasstype = "";
  if ($eventtype == 1){
    $transclasstype = "incom";
  } else if ($eventtype  == 2) {
    $transclasstype = "expend";
  } else if ($eventtype  == 3) {
    $transclasstype = "transfer";
    $footerText = "<span class='uk-text-small'>Transfer to <br></span><span class='uk-text-default'>" . $accname . "</div>";
  } else if ($eventtype  == 4) {
    $transclasstype = "transfered";
    $footerText = "<span class='uk-text-small'>Transfer from <br></span>" . $accname;
  };
  
  $accentclass = "";
  if ($accent == 1){
    $accentclass = " bud-accented";
  };
  $disclass = "";
  if ($disabled == 1){
    $disclass = " bud-disabled";
  };

  $result = "  <div class='bud-event-card dragtemplate " . $transclasstype . $accentclass . $disclass . "' aria-current='true'
   id='bud_item_" . $id . "' draggable='true' trans_id='" . $trans_id . "'
   type='" . $eventtype . "'  haschildren='" . $haschildren . "' transaccount='" . $transaccount . "'>
  <div class='cardName'>
  <div class='bud-name'>" . $name . "</div>
  <div class='bud-trigger'>
    <span class='itemMenu '><span uk-icon='settings'></span>
    </span>
  
  </div>
  </div>
<div class='col-12 mb-1 small bud-descr
 shortest-text'>" . $text . "
 </div>
<div class='bud-footer'>
<strong class='mb-1 bud-value'>" . $amount . "</strong>
<span></span>
<div class='categories'><span class='bud-badge text-dark' category='" . $category . "'>" . $catname . "</span></div>
</div>
<div class='bud-card-footer'>" . $footerText . "</div>
</div>";
  return $result;
}

public static  function tpl_in_calendar_event_transfers($id, $name, $text, $date, $account, $targeter, $accname, $acccolor, $accurrency, $eventtype, $amount, $freq  = 0, $ordered = 0){
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
 $result = '<div class="card shadow mb-2 accard" id="acc_' . $id . '" acc="' . $id . '" draggable="true" ondragstart="drag(event)">
 <div class="card-body p-2">';
 $result .= "  <span class='uk-icon-link uk-sortable-hand uk-icon' uk-icon='move' style='user-select: none;'>
 <svg width='20' height='20' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg'>
   <polygon points='4,5 1,5 1,9 2,9 2,6 4,6'>
   </polygon><polygon points='1,16 2,16 2,18 4,18 4,19 1,19'></polygon><polygon points='14,16 14,19 11,19 11,18 13,18 13,16'></polygon><rect fill='none' stroke='#000' x='5.5' y='1.5' width='13' height='13'></rect><rect x='1' y='11' width='1' height='3'></rect><rect x='6' y='18' width='3' height='1'></rect></svg>
   </span>";
 $result .= '
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


public static function renderEventModal($accounts = null, $categories = null, $allaccounts = null, $currencies = null)
{
  $result = "<div id='modal_event' class='uk-flex-top' uk-modal>
  <div class='uk-modal-dialog uk-margin-auto-vertical' >
  <button class='uk-modal-close-default' type='button' uk-close></button>
  <div class='uk-modal-header'>
      <h3 id='mod_title' class=''>Modal Title</h3>
  </div>
  <div>
  <div>
    <div class='uk-button-group uk-column-1-3 uk-width-1-1' style='column-gap: 0px;'>
        <button class='uk-button uk-button-incom uk-width-1-3'>Incom</button>
        <button class='uk-button uk-button-expense uk-width-1-3'>Expense</button>
        <button class='uk-button uk-button-transfer uk-width-1-3'>Transfer</button>
        <button class='uk-hidden uk-button uk-button-percent uk-width-1-3'>Percent</button>
        <button class='uk-hidden uk-button uk-button-deposit uk-width-1-3'>Deposit</button>
    </div>
  </div>
  </div>
  <div class='uk-modal-body'>
    <form>
    <fieldset class='uk-fieldset'>

        <!--legend class='uk-legend'>Legend</legend -->

        <div class='uk-margin uk-mb-0'>
            <input class='uk-input' type='text' placeholder='Name' maxlength='64' id='mod_name'>
            <div class='uk-text-meta uk-align-right'></div>
        </div>

        <div class='uk-margin uk-mb-0'>
            <textarea class='uk-textarea' rows='7' placeholder='Description'
             id='mod_description' maxlength='2000'></textarea>
             <div class='uk-text-meta uk-align-right'></div>
        </div>

        <div class='uk-margin uk-mb-0 uk-inline uk-width-1-1' title='Amount of money'>
          <span class='uk-form-icon uk-form-icon' uk-icon='icon: database' ></span>
          <input class='uk-input' type='number' placeholder='Amount'
           inputmode='decimal' id='mod_amount'>
        </div>

        <div class='uk-margin uk-mb-0 uk-inline uk-width-1-1' title='Event date'>
          <span class='uk-form-icon uk-form-icon' uk-icon='icon: calendar' ></span>
          <input class='uk-input' type='date' placeholder='Date' id='mod_date'>
        </div>

        <div class='uk-margin uk-mb-0 uk-mt-half uk-width-1-1' title='Account'>
          <span class='small' >Account</span>
            <select class='uk-select' id='mod_account' placeholder='Account'>";
            if ($accounts != null){
              foreach ($accounts AS $value){

                  if ($value->archieved == 0){
                    $result .= "<option class=''  data-curr='" . $currencies[$value->currency]->id . "' value='" . $value->id . "'>  " . $value->name . "</option>";
                  }
                  else {

                    $result .= "<option class='opt-archieved' disabled>" . $value->name . "</option>";
                  }
                  
                
              }
            }
          $result .= "</select>
        </div>

        <div id='row_targetAcc' class='uk-margin uk-mb-0 uk-mt-half uk-width-1-1' title='Target account'>
          <span class='small' >Target Account</span>
            <select class='uk-select' id='mod_tgaccount' placeholder='Target account'>";
            if ($allaccounts != null){
              foreach ($allaccounts AS $value){

                  if ($value->archieved == 0){
                    $result .= "<option class='' data-curr='" . $currencies[$value->currency]->id . "' value='" . $value->id . "'>  " . $value->name . " (" . $currencies[$value->currency]->literals .  ")</option>";
                    
                  } 
                  else {
                    $result .= "<option class='opt-header' disabled>" . $value->name . "</option>";

                  }
                  
                
              }
            }
          $result .= "</select>
        </div>

        <div id='row_category' class='uk-margin uk-mb-0 uk-mt-half uk-width-1-1' title='Category of event'>
        <span class='small' >Category</span>
          <select class='uk-select' id='mod_category' placeholder='Event category'>";
            if ($categories != null){
              foreach ($categories AS $value){
                if (!empty($value->data)){
                  if ($value->archieved == 0){
                    $result .= "<option class='opt-header' data-type='" . $value->type . "' disabled>" . $value->name . "</option>";

                  }
  
                  foreach ($value->data AS $dat)
                  {
                    $class = "";
                    if ($dat->type == 1){
                      $class = "opt-incom";
                    } else if ($dat->type == 2){
                      $class = "opt-expense";
                    } else if ($dat->type == 3){
                      $class = "opt-transfer";
                    }
                    if ($dat->archieved == 1){
                      $class .= " opt-archieved";
                    }
                    $result .= "<option class='" . $class . "' data-type='" . $dat->type . "' value='" . $dat->id . "'>  " . $dat->name . "</option>";
                  }

                }
              }
            }
          $result .= "</select>
      </div>

      <div class='uk-margin uk-mb-0'>
        <input id='mod_isAccent' class='uk-checkbox' type='checkbox'> Accented</label>
      </div>

      <div class='uk-margin uk-mb-0 uk-grid-small uk-child-width-auto uk-grid' id='mod_isRepeatRow'>
      <label>
      <input id='mod_isRepeat' class='uk-checkbox' type='checkbox'> Repeat event</label>
        </div>

    </fieldset>
  </form>
  </div>";
  $result .= "<div class='uk-hidden'>
    <div class='uk-button-group uk-column-1-1 uk-width-1-1' style='column-gap: 0px;'>
        <button id='btn_optionTrigger' class='uk-button uk-button-default uk-width-1-2 '>Additiona options</button>
        <button id='btn_manageTrigger' class='uk-button uk-button-default uk-width-1-2'>Sequence management</button>
    </div>
  </div>";
  $result .= " <div class='uk-modal-body' id='mod_options_body'>
    <form>
      <fieldset class='uk-fieldset'>



          <div class='uk-margin uk-mb-0 uk-mt-half uk-width-1-1 uk-column-1-2' title='Main repeat options'>
          <span class='small' >Repeat period</span>
            <select class='uk-select' id='mod_repeatPeriod' placeholder='Period of repeating'>
            <option value='day'>Every day</option>
            <option value='week'>Every week</option>
            <option value='quarter'>Every quarter</option>
                <option value='month'>Every month</option>
                <option value='year'>Every Year</option>
            </select>
            <span class='small' >Repeat times</span>
            <input class='uk-input' type='number'
             placeholder='5 times...' min='1' max='36' step='1' inputmode='decimal'
              id='mod_repeatTimes'>
        </div>

        <div class='uk-margin uk-mb-0 uk-width-1-1 uk-column-1-2' title='Additional repeat options'>

          <span class='small' >Every time Change amount for </span>
          <input class='uk-input' type='number'
           placeholder='-100 or +100' min='0' max='36000000' step='1' title='set negative value if need to subtract from base value'
            inputmode='decimal' id='mod_amountChanger'>

          <span class='small' >Stop repeating when reached</span>
          <input class='uk-input' type='number' placeholder='1000000' min='0'
           max='36000000' step='1' inputmode='decimal' id='mod_amounGoal'>
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
      <button id='btnDisableEvent' class='uk-button uk-button-default' type='button'>Disable</button>
      <button class='uk-button uk-button-default uk-modal-close' type='button'>Cancel</button>
      <button id='btnSaveEvent' class='uk-button uk-button-primary' type='button'>Save</button>
      <button id='btnUpdateEvent' class='uk-button uk-button-primary' type='button'>Update</button>
  </div>
</div>
</div>";
  return $result;
}

public static function renderEventFilterModal($accounts = null, $categories = null, $allaccounts = null, $currencies = null) 
{
  $result = "";
  $result .= "<div id='modal-container' class='uk-modal-container' uk-modal>
  <div class='uk-modal-dialog'>
      <button class='uk-modal-close-default' type='button' uk-close></button>
      <form method='GET' action='/public/budger'>
      <h3 class='uk-modal-header'>Event Navigator</h3>
      <div class='uk-modal-body'>
        <div class='uk-column-1-2@s uk-column-1-3@m uk-column-1-4@l'>
          ";

          $result .= "<div class='uk-margin uk-mb-0 uk-mt-half uk-width-1-1' title='Currency'>
          <span class='small' >Currencies</span>
          <select class='uk-select' name='cur' id='currency_filter' placeholder='Currency'>";
          if ($currencies != null){
            foreach ($currencies AS $value){
    
                      if ($value->is_removed == 0){
                        $result .= "<option class='' data-type='' value='" . $value->id . "'>  " . $value->name . "</option>";
                      }
                      else {
                        
                        $result .= "<option class='opt-archieved' disabled>" . $value->name . "</option>";
                      }
                    }
                  }
                  $result .= "</select>";
          $result .= "</div>
   ";

 $result .= "<div class='uk-margin uk-mb-0 uk-mt-half uk-width-1-1' title='Account'>
          <span class='small' >Accounts</span>
          <select class='uk-select' name='acc[]' id='accounts_filter' placeholder='Account' multiple >";
          if ($allaccounts != null){
            foreach ($allaccounts AS $value){
    
                      if ($value->archieved == 0){
                        $result .= "<option class='' data-type='' value='" . $value->id . "'>  " . $value->name . "</option>";
                      }
                      else {
                        
                        $result .= "<option class='opt-archieved' disabled>" . $value->name . "</option>";
                      }
                    }
                  }
                  $result .= "</select>";
          $result .= "</div>";

   $result .= "<div class='uk-margin uk-mb-0 uk-mt-half uk-width-1-1' title='Past time'>
   <label for='stm'>Month from (past)</label>
   <input class='uk-input' type='month' id='stm' name='stm' value='2022-06'>
   </div>";
   
   $result .= "<div class='uk-margin uk-mb-0 uk-mt-half uk-width-1-1' title='Future time'>
    <label for='enm'>Month to (future)</label>
    <input class='uk-input' type='month' id='enm' name='enm' value='2022-08'>
   </div>

   </div>
   </div>
   <div class='uk-modal-footer'>
   <input class='uk-button uk-button-primary' type='submit' value='GO!'>
   </div>
   </form>
   </div>
   </div>";
                  $result .= "";
  return $result;
}

// masterColor can be null, Icon can be null, and Items can be null, but need an array
public static function renderGroupContainer($id, $name, $masterColor, $icon, $items, $type = 2, $order = 0) 
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
  $classType = 'type_exp';
  if ($type == 1){
    $classType = 'type_inc';
  } else if ($type == 2){
    
    $classType = 'type_exp';
  } else if ($type == 3){
    $classType = 'type_trn';
    
  }

  $result  = "<div class='catBox uk-first-column " . $classType . "' data-type='" . $type . "' 
  data-color='' style='' id='" . $id . "' data-order='" . $order . "'>
  <h4>
  <span class='uk-icon-link uk-sortable-handle uk-icon' uk-icon='move' style='user-select: none;'>
  <svg width='20' height='20' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg'>
    <polygon points='4,5 1,5 1,9 2,9 2,6 4,6'>
    </polygon><polygon points='1,16 2,16 2,18 4,18 4,19 1,19'></polygon><polygon points='14,16 14,19 11,19 11,18 13,18 13,16'></polygon><rect fill='none' stroke='#000' x='5.5' y='1.5' width='13' height='13'></rect><rect x='1' y='11' width='1' height='3'></rect><rect x='6' y='18' width='3' height='1'></rect></svg>
    </span>  
  <span class='groupname'>" . $name . "</span> 
  <span class='uk-text-muted counts'>[" . $iterator . "]</span>
<!--  <span class='btn-colorize' uk-toggle='target: #modal-example'>colorize</span> -->
<span class='btn-remove' title='remove group'><span uk-icon='trash'></span></span>
<span class='btn-archieve' title='toggle archieve group'><span uk-icon='lock'></span></span>

  <div class='btn-colorize'>
  <div uk-form-custom='target: true'>
      <select class='typeChanger'>
          <option 
          ";
          if ($type == 1){   $result .= "selected "; };
          $result .= "value='1'>Incom</option>
          <option 
          ";
          if ($type == 2){   $result .= "selected "; };
          $result .= "value='2'>Expense</option>
          <option 
          ";
          if ($type == 3){   $result .= "selected "; };
          $result .= "value='3'>Transfer</option>
      </select>
      <span></span>
  </div>
</div>

  <span class='btn-collapse' title='toggle collapse'><span uk-icon='shrink'></span></span>
  <span class='btn-addItem' title='add new item'><span uk-icon='plus'></span><span>
</span></span></h4>
      <div uk-sortable='group: sortable-group; handle: .uk-sortable-hand' class='uk-sortable uk-sortable-empty' style=''>";
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

  $result = "<div class='uk-margin-sm card-box' id='" . $id . "' " . $color . " data-order='" . $order . "'>
  <div class='uk-card uk-card-sm uk-card-body  uk-box-shadow-small uk-box-shadow-hover-medium uk-card-small'>
  <span class='uk-icon-link uk-sortable-hand uk-icon' uk-icon='move' style='user-select: none;'>
  <svg width='20' height='20' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg'>
    <polygon points='4,5 1,5 1,9 2,9 2,6 4,6'>
    </polygon><polygon points='1,16 2,16 2,18 4,18 4,19 1,19'></polygon><polygon points='14,16 14,19 11,19 11,18 13,18 13,16'></polygon><rect fill='none' stroke='#000' x='5.5' y='1.5' width='13' height='13'></rect><rect x='1' y='11' width='1' height='3'></rect><rect x='6' y='18' width='3' height='1'></rect></svg>
    </span>  
    
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


public static function renderAccountItemMenu(){
  $result = "<div id='itemMenu' data-target='' class='uk-dropdown uk-open menu-inverted' style=''>
  <ul class='uk-nav uk-dropdown-nav'>
     <!-- <li><a href='' data-event='opensettings' class='btnChangeColor'>Change color</a></li> -->
      <li  data-event='activate' ><a class=''>Toggle activate</a></li>
      <li  data-event='archieve' ><a class=''>Toggle archieve</a></li>
      <li  data-event='remove'   ><a class=''>Remove forever</a></li>
  </ul>
</div>";
return $result;
}

public static function renderEventItemMenu(){
  $result = "<div id='itemMenu' data-target='' class='uk-dropdown uk-open menu-inverted' style=''>
  <ul class='uk-nav uk-dropdown-nav'>
     <!-- <li><a href='' data-event='opensettings' class='btnChangeColor'>Change color</a></li> -->
      <li id='btn_goParent' data-event='goparent'><a class=''>Go to parent</a> <span uk-icon='icon: forward'></span></li>
      <li class='' data-event='enlarge' ><a class=''>Enlarge</a> <span uk-icon='icon: plus'></span></li>
      <li  data-event='show' ><a class=''>Show</a>            <span uk-icon='icon: commenting'></span></li>
      <li  data-event='edit' ><a class=''>Edit</a>            <span uk-icon='icon: pencil'></span></li>
      <li  data-event='accent'  ><a class=''>Accent</a>          <span uk-icon='icon: bookmark'></span></li>
      <li  data-event='disable'  ><a class=''>Disable</a>         <span uk-icon='icon: ban'></span></li>
      <li  data-event='remove'   ><a class=''>Remove</a>          <span uk-icon='icon: trash'></span></li>
  </ul>
</div>";
return $result;
}

public static function renderAccountContainer($id, $name, $items, $order = 0) 
{
  $iterator = 0;
  $cr = $id;
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


  $result  = "<div class='catBox uk-first-column' data-currency='" . $cr . "' 
  data-color='' style='' id='" . $id . "' data-order='" . $order . "'>
  <h4>
  <span class='uk-icon-link uk-sortable-handle uk-icon' uk-icon='move' style='user-select: none;'>
  <svg width='20' height='20' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg'>
    <polygon points='4,5 1,5 1,9 2,9 2,6 4,6'>
    </polygon><polygon points='1,16 2,16 2,18 4,18 4,19 1,19'></polygon><polygon points='14,16 14,19 11,19 11,18 13,18 13,16'></polygon><rect fill='none' stroke='#000' x='5.5' y='1.5' width='13' height='13'></rect><rect x='1' y='11' width='1' height='3'></rect><rect x='6' y='18' width='3' height='1'></rect></svg></span>  
  <span class='groupname'>" . $name . "</span> 
  <span class='uk-text-muted counts'>[" . $iterator . "]</span>
<!--  <span class='btn-colorize' uk-toggle='target: #modal-example'>colorize</span> -->



  <span class='btn-collapse' title='toggle collapse'><span uk-icon='shrink'></span></span>
  
</span></span></h4>
      <div uk-sortable='group: sortable-group; handle: .uk-sortable-hand' class='uk-sortable uk-sortable-empty' style=''>";
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

public static function renderAccountItem($id, $name, $type, $descr, $decimals, $order = 0, 
$isArchieved = 0, $notshow = 0, $isactive = 0)
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
  
  if ($isArchieved == true){
    $addClass .= " archieved hidden";
  }

  $result = "<div class='uk-margin-sm card-box' id='" . $id . "' data-order='" . $order . "'>
  <div class='uk-card uk-card-sm uk-card-body accard uk-box-shadow-small uk-box-shadow-hover-medium uk-card-small'>
  <span class='cardName'>
  <span class='uk-icon-link uk-sortable-hand uk-icon' uk-icon='move' style='user-select: none;'>
  <svg width='20' height='20' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg'>
    <polygon points='4,5 1,5 1,9 2,9 2,6 4,6'>
    </polygon><polygon points='1,16 2,16 2,18 4,18 4,19 1,19'></polygon><polygon points='14,16 14,19 11,19 11,18 13,18 13,16'></polygon><rect fill='none' stroke='#000' x='5.5' y='1.5' width='13' height='13'></rect><rect x='1' y='11' width='1' height='3'></rect><rect x='6' y='18' width='3' height='1'></rect></svg></span>
  " . $name . "</span><div class='uk-align-right'>
  ";
  if ($type == 1){
    $result .= "<span class='itemTypeMarker uktm-1 uk-badge' >standard</span>";
  } else   if ($type == 3){
    $result .= "<span class='itemTypeMarker uktm-2 uk-badge'  >debt</span>";
  } else   if ($type == 2){
    $result .= "<span class='itemTypeMarker uktm-3 uk-badge' >credit</span>";
  }
  $result .= "
  <span class='notshow d-none' title='Not showed in main list'><span uk-icon='ban'></span></span>
  <span class='archieved' title='archieved account'><span uk-icon='lock'></span></span>
  <span class='itemMenu '><span class='' uk-icon='settings'></span></span>
  </div>
    <div class='uk-card-body uk-padding-remove'>
      <p>" . $descr . "</p>
    </div>
    </div>
  </div>";
  return $result;
}

public static function renderAccountModal($currencies)
{
  $result = "<div id='modal_account' class='uk-flex-top' uk-modal>
  <div class='uk-modal-dialog uk-margin-auto-vertical'>
  <button class='uk-modal-close-default' type='button' uk-close></button>
  <div class='uk-modal-header'>
      <h2 class='uk-modal-title'>Add new account</h2>
  </div>

  <div class='uk-modal-body'>
    <form>
    <fieldset class='uk-fieldset'>

        <!--legend class='uk-legend'>Legend</legend -->

        <div class='uk-margin uk-mb-0'>
            <input class='uk-input' type='text' max='64' placeholder='Account name' id='bud_name'>
        </div>

        <div class='uk-margin uk-mb-0'>
            <textarea class='uk-textarea' rows='7' max='256' placeholder='Description' id='bud_descr'></textarea>
        </div>

        <div class='uk-margin uk-mb-0 uk-inline uk-width-1-1' title='Number of symbols after comma'>
          <span class='uk-form-icon uk-form-icon' uk-icon='icon: database' ></span>
          <input class='uk-input' type='number' min='1' max='5' 
          placeholder='Number of digits after comma' inputmode='numeric' id='bud_decimal'>
        </div>


        <div class='uk-margin uk-mb-0 uk-mt-half uk-width-1-1' title='Account'>
          <span class='small' >Type of account</span>
            <select class='uk-select' id='bud_acctype' placeholder='Account type'>
                <option disabled value='0'>Shadow account</option>
                <option value='1'>Standard</option>
                <option value='2'>Cretid/Debt</option>
                <option value='3'>Saving Account</option>
            </select>
        </div>

        <div id='row_percent' class='uk-margin uk-mb-0 uk-inline uk-width-1-1' title='Percentage'>
          <span class='uk-form-icon uk-form-icon' uk-icon='icon: database' ></span>
          <input class='uk-input' type='number' min='1' max='8' placeholder='Percentage value' id='bud_percentage'>
        </div>

        <div class='uk-margin uk-mb-0 uk-mt-half uk-width-1-1' title='Category of event'>
        <span class='small' >Currency identifier</span>
          <select class='uk-select' id='bud_currency' placeholder='Account'>";
            if ($currencies != null){
              foreach ($currencies AS $dat){

                $result .= "<option class='' data-literal='" . $dat->literals . "' value='" . $dat->id . "'>  " . $dat->literals . " " . $dat->name . "</option>";

                
              }
            }
          $result .= "</select>
      </div>
            <hr>
      <div class='uk-margin uk-mb-0 uk-mt-half uk-width-1-1' title='Visibility'>
      <label><input class='uk-checkbox' id='bud_archieved' type='checkbox'> Archieved account</label>
      </div>
      <div class='uk-margin uk-mb-0 uk-mt-half uk-width-1-1' title='Visibility'>
      <label><input class='uk-checkbox' id='bud_notshow' type='checkbox'> Not show in main page</label>
      </div>
    </fieldset>
  </form>
  </div>
  <div class='uk-modal-footer uk-text-right'>
      <button class='uk-button uk-button-default' id='btn_removeIt' type='button'>Remove</button>
      <button class='uk-button uk-button-default uk-modal-close' type='button'>Cancel</button>
      <button class='uk-button uk-button-primary' id='saveButton' type='button'>Save</button>
  </div>
</div>
</div>";
  return $result;
}

};

?>