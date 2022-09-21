<?php 
    use App\Http\Controllers\Controller;
    use App\Http\Controllers\Components\Budger\BudgerMain;
    use App\Http\Controllers\Components\Budger\BudgerData;
    use App\Http\Controllers\Components\Budger\BudgerTemplates;
    use App\Http\Controllers\Common\Currency;
    use Illuminate\Foundation\Auth\User;

    $user = User::where('id', '=', session('LoggedUser'))->first();

    $BD = new BudgerData();

    $accounts = null;
    $currencies = null;
    $currencyOrder = null;
    if ($user != null){
      $accounts = $BD->LoadAccountList($user->id);
      $currencyOrder = $BD->GetCurrencyOrder($user->id);
      $currencies = $BD->LoadCurrencies_keyId($user->id);
    }
?>
@extends('Template.shell')

@section('page-content')
<style>
  .catBox:first-child {
    background: #e1effb;
    border: 3px dotted #2196f3;
    border-radius: 2px;
    padding: 12px;
  }
  </style>
<div class="uk-section uk-section-primary uk-padding-small">
    <div class="uk-container uk-container-small uk-light">
    <h3 class="uk-card-title uk-light text-white">Account manager: <span>active items</span></h3>
    <p uk-margin>

      <button class="uk-button uk-button-default" id='addGroupButton'>Add account</button>
      <button class="uk-button uk-button-default" data-collapsed='false' id='collapesAllButton'>Collapse all</button>
      <button class="uk-button uk-button-primary" >Show archieved</button>
        
      </p>
    </div>
</div>


<div class="uk-section uk-section-default">
    <div class="uk-container uk-container-small ">
      <div class="uk-child-width-1-1 not-archieved-list" uk-grid  uk-sortable="handle: .uk-sortable-handle"  id="domContainer">

      <?php
      $currentCurr = 0;
      if ($accounts != null){
        $currentCurr = $currencyOrder[0];
        $accIts = [];
        
        foreach ($currencyOrder AS $curen)
        {
          foreach ($accounts AS $data)
          {
            if ($curen == $data->currency){
              // echo BudgerTemplates::renderAccountContainer($currentCurr,
              //  $currencies[$currentCurr]->literals, $accIts);
              array_push($accIts, 
              BudgerTemplates::renderAccountItem($data->id, $data->name, $data->type, $data->description,
              $data->decimals, $data->ordered, $data->archieved, $data->notshow, $data->is_active));
              //$currentCurr = $data->currency;
            }
          }
          echo BudgerTemplates::renderAccountContainer($curen,
          $currencies[$curen]->literals, $accIts);
          $accIts = [];
        }

      }
      
?>
  </div>
  </div>
  </div>

<?php
  echo BudgerTemplates::renderAccountModal(Currency::getCurrencyList());
?>

<?php /*
<style>
   .list-group-item:hover {
 
   }
   .list-group-flush > .list-group-item {
    transition: all 0.7s  ease;  
    border-width: 0 0 1px;
    box-shadow: 1px 2px 5px rgb(0 0 0 / 43%);
}
   #templatepool {
 
}
.list-group-flush > .list-group-item:last-child {
    border-bottom-width: 1px !important;
}
#templatepool .dragtemplate:hover {
  margin-bottom: 2rem;
  transition: all 0.2s 0.7s  ease-in-out;
}
#templatepool .dragtemplate:last-child:hover {
  margin-bottom: 0rem;
}
.label {
  margin-bottom: 6px;
  color: #303f46;
  letter-spacing: 1px;
}
.tf_acc {
  transition: all 0.7s ease;
    border-width: 0 0 1px;
    box-shadow: 1px 2px 5px rgb(0 0 0 / 43%);
    min-height: 20px;
    margin-bottom: 12px;
    border-radius: 6px;
    border: 1px solid #cacaca;
}
.curhandler {
  display: -webkit-inline-box;
    padding: 6px;
    background: #636363;
    color: white;
    margin: -5px;
    margin-left: -1px;
    border-top-left-radius: 3px;
    border-bottom-left-radius: 3px;
    height: 100%;
    margin-right: 12px;
}
.dd3-groupinfo {
  font-size: 1.1rem;
    color: #6b6c6c;
    font-weight: 100;
    width: calc(100% - 300px);
    float: right;
}
@media (min-width: 1000px) {
  .dd3-groupinfo {
    display: -webkit-box;
  }
.dd3-groupinfo > * {
  display: inline;
    border-left: 1px solid #cccccc;
    padding-left: 12px;
    min-width: 80px;
    float: right;
    max-width: 60%;
    padding-right: 12px;
    text-align: revert;
}
}
@media (max-width: 999px) {
  .dd3-groupinfo > * {
    display: flex;
    border-bottom: 1px solid #cccccc;
    padding-left: 12px;
    min-width: 100px;
    float: left;;
    width: 100%;
    padding-right: 12px;
    text-align: revert;
}
}
.inshadow {
    box-shadow: 0px 5px 12px -6px rgb(0 0 0 / 59%);
  }
  .card-head{
    width: 100%;
    min-height: 28px;
    background: #686868;
    color: white;
    transition: all 0.4s ease-in-out;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
  }
  .card:hover .card-head {
    background: #545454;
  }
  .cardhead-name {
    padding: 6px;
    font-size: 1.2rem;
  }
  .cardhead-buttons {
    float: right;
  }
  .cardhead-button {
    padding: 6px;
    font-size: 1.2rem;
    cursor: pointer;
  }
  .cardhead-button:hover {
    color: #5daec7;
  }
  .card-balance {
    float: right;
  }
.incom-color {
    color: green;
}
.expend-color {
  color: red;
}
.card-dragarea {
  min-height: 80px;
}
.float-right {
  float: right;
}
.cardhead-liter {
  font-size: 1.3rem;
    margin-left: 1px;
    line-height: 1.1rem;
    letter-spacing: 3px;
}
</style>
<div class="container">
<?php 
if ($user->guest):
  echo tpl_youAreGuestMessage();
endif;
?>



<div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white " style="">

<div id="templatepool" class="list-group list-group-flush border-bottom scrollarea" 
    ondrop='drop(event)' ondragover='allowDrop(event)'>




   <?php
   if ($user->guest){
    //$user->id = 0;
   }
//--- GET INSTALLED LANGUAGE LIST --- /
$languages_obj = null // AccountModel::LoadLanguages($user->id); // look here
//  FIRST HARVEST Currencies to arrange items into Currency-groups
$curs = AccountModel::LoadCurrencies($user->id);
//  Get amount of money by each account
$amounts null; //= AccountModel::LoadMoneyInAccountsToday($user->id);
$menus  null;// = AccountModel::LoadExistedMenus($user->id);

$accountcounter = 0; // LIMIT count of accounts for different user Groups
$guestAccLimit  = 15;
?>
<style>
 
</style>

</div>
</div>
  <div class="row mt-5">
  <p class="mt-3"> 
  
  
</p> 
    <div class="col-md-6 col-sm-12">
    <div class="alert alert-info" role="alert">
      <b>Accounts</b>
      <a class="btn btn-info text-white modal-trigger float-right" id="createbutton" href="#EditorWindow" data-bs-toggle='modal' data-bs-target='#EditorWindow' onclick="openeditor('');">Create New Account</a>
    </div>
      <div id="tf_accountpool">
<?php
$accountcounter = 0;
$acc_names = [];
for ($i = 0; $i < count($curs); $i++){
  $result = AccountModel::LoadAccountsByCurrency($user->id, $curs[$i]);

  echo account_wrap_account($i, $curs[$i], 'start');
  foreach ($result AS $key => $object){
    if (!isset($amounts[$object->id])){
      $amounts[$object->id] = 0;
    };
    $accountcounter++;
    if ($amounts[$object->id] > 0){
      $balclass = "incom-color";
   } else {
      $balclass = "expend-color";
   };
   echo account_item_render($object->id, $object->name,  $amounts[$object->id], $object->comment, $object->language, $object->accesstype);
   $acc_names[$object->id] = $object->name;
  };
  echo account_wrap_account($i, $curs[$i], 'end');
};
?>

      </div>
      <div class="alert alert-secondary" role="alert">
        Create and order your accounts.<br>By default (in default page) you will see all accounts from first section.<br>
        To create new currency section just create an account with preferred currency or change existed account currency settings. A new section will appear automatically.<br>
        Drag items between accounts to change currency automatically. Drag it within the section to change order.
      </div>
    </div>

    <div class="col-md-6 col-sm-12">
    <div class="alert alert-info" role="alert">
    <b>Menu Buttons</b>
      <a class="btn btn-info text-white modal-trigger float-right" id="createmenubutton" href="#MenuWindow" data-bs-toggle='modal' data-bs-target='#MenuWindow' onclick="openmenueditor('');">New Menu item</a>
    </div>
      <div id="tf_menupool">

    <?php 
    $menuorder = 0;
    foreach($menus AS $menu){
      echo account_wrap_menu($menu->name, $menu->literals, $menu->currency, $menu->id, 'start');
        if (!empty($menu->accounts)){
          $accs = explode(",", $menu->accounts);
          foreach ($accs AS $ac){
            if (empty($ac)){ break; };
            echo account_menu_in_item($acc_names[trim($ac)], $menuorder, $ac,  $menu->currency);
            $menuorder++;
          }
        }
      echo account_wrap_menu($menu->name, $menu->literals, $menu->currency, $menu->id, 'end');
    } 
    ?>


          

      </div>
      <div class="alert alert-secondary" role="alert">
        Here you can create buttons for quick access to certain accounts. These buttons will appear in the side-menu block.<br>
        Buttons can contain only the same currency accounts.<br>
        Drag items within the section to change order.<br>
        To add account into the sequence just drag it from account pool.
      </div>
    </div>
  </div> <!-- row end -->
<?php 
  if (count($curs) == 0){
    echo "<h3>There is no accounts yet. Create one and let's start!</h3>";
  }
  ?>
</div>

<script>
function accounts_reorder(){
  let sequence = "";
  $("#tf_accountpool").find(".accard").each(function(){
    sequence = sequence + $(this).attr("acc") + ",";
  });
  if (sequence == ""){ return false; }
  var request = $.ajax({
    url: "<?php echo rtrim(JURI::base(), '/') . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); ?>?ajaxcall=com_teftelebudget",
    type: "POST",
    data: {
    code:     120,
    seqs:     sequence
    },
    dataType: "html"
  });

  request.done(function(response) {
    console.log("order changed OK");
    showtoast(9);
  });

  request.fail(function(jqXHR, textStatus) {
    alert( "Request failed: " + textStatus );
  }); 
};


  $(document).on("click", ".movedown", function(){
	let elnum = $(this).parent().parent().parent().index();
  let blocks  = $(".tf_account");
  let blockn  = blocks[elnum];
  let finalarr = [];
  let blen = blocks.length;
  for (let i = 0; i <= blen; i++){

  	if (i != elnum){
    	if (blocks[i] !=  undefined){
        finalarr.push(blocks[i]);
      }
    } else {
    if (blocks[i] !=  undefined){
    	finalarr.push(blocks[i + 1]);
      };
    }
		if (i == (elnum + 1)){
    	finalarr.push(blockn);
    }
  }
  $("#tf_accountpool").html("");
  for (let i = 0; i < finalarr.length; i++){
  	$("#tf_accountpool").append(finalarr[i]);
  };
  accounts_reorder();
});

  $(document).on("click", ".moveup", function(){
	let elnum = $(this).parent().parent().parent().index();
  let blocks  = $(".tf_account");
  let blockn  = blocks[elnum];
  let finalarr = [];
  let blen = blocks.length;
  if (elnum != 0){
  for (let i = 0; i <= blen; i++){
  	if (i != elnum){
    	if (blocks[i] !=  undefined){
        finalarr.push(blocks[i]);
      }
    } else {
    if (blocks[i] !=  undefined){
    	finalarr.push(blocks[i - 1]);
      };
    }
		if (i == (elnum - 1)){
    	finalarr.push(blockn);
    }
  }

  $("#tf_accountpool").html("");
  for (let i = 0; i < finalarr.length; i++){
  	$("#tf_accountpool").append(finalarr[i]);
  };
  accounts_reorder();
  };
});

// --                    --                  --

function menus_reorder(){
  let sequence = "";
  $("#tf_menupool").find(".tf_minimenu").each(function(){
    sequence = sequence + $(this).attr("mid") + ",";
  });
  if (sequence == ""){ return false; }
  var request = $.ajax({
    url: "<?php echo rtrim(JURI::base(), '/') . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); ?>?ajaxcall=com_teftelebudget",
    type: "POST",
    data: {
    code:     121,
    seqs:     sequence
    },
    dataType: "html"
  });

  request.done(function(response) {
    console.log("order changed OK");
    showtoast(9);
  });

  request.fail(function(jqXHR, textStatus) {
    alert( "Request failed: " + textStatus );
  }); 
};


  $(document).on("click", ".movedown_m", function(){
	let elnum = $(this).parent().parent().parent().index();
  let blocks  = $(".tf_minimenu");
  let blockn  = blocks[elnum];
  let finalarr = [];
  let blen = blocks.length;
  for (let i = 0; i <= blen; i++){

  	if (i != elnum){
    	if (blocks[i] !=  undefined){
        finalarr.push(blocks[i]);
      }
    } else {
    if (blocks[i] !=  undefined){
    	finalarr.push(blocks[i + 1]);
      };
    }
		if (i == (elnum + 1)){
    	finalarr.push(blockn);
    }
  }
  $("#tf_menupool").html("");
  for (let i = 0; i < finalarr.length; i++){
  	$("#tf_menupool").append(finalarr[i]);
  };
  menus_reorder();
});

  $(document).on("click", ".moveup_m", function(){
	let elnum = $(this).parent().parent().parent().index();
  let blocks  = $(".tf_minimenu");
  let blockn  = blocks[elnum];
  let finalarr = [];
  let blen = blocks.length;
  if (elnum != 0){
  for (let i = 0; i <= blen; i++){
  	if (i != elnum){
    	if (blocks[i] !=  undefined){
        finalarr.push(blocks[i]);
      }
    } else {
    if (blocks[i] !=  undefined){
    	finalarr.push(blocks[i - 1]);
      };
    }
		if (i == (elnum - 1)){
    	finalarr.push(blockn);
    }
  }

  $("#tf_menupool").html("");
  for (let i = 0; i < finalarr.length; i++){
  	$("#tf_menupool").append(finalarr[i]);
  };
  menus_reorder();
  };
});



function deleteitemenu(iden){
  var request = $.ajax({
    url: "<?php echo rtrim(JURI::base(), '/') . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); ?>?ajaxcall=com_teftelebudget",
    type: "POST",
    data: {
    code:     188,
    iden:     iden
    },
    dataType: "html"
  });

  request.done(function(response) {
    console.log("menu removed OK");
    $("#tf_minimenu_" + iden).remove();
    showtoast(15);
  });

  request.fail(function(jqXHR, textStatus) {
    alert( "Request failed: " + textStatus );
  }); 
};

function changecurrinaccount(iden, cur){
  var request = $.ajax({
    url: "<?php echo rtrim(JURI::base(), '/') . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); ?>?ajaxcall=com_teftelebudget",
    type: "POST",
    data: {
    code:     174,
    iden:     iden,
    curr:     cur
    },
    dataType: "html"
  });

  request.done(function(response) {
    console.log("Account changed his currency");
    showtoast(11);
  });

  request.fail(function(jqXHR, textStatus) {
    alert( "Request failed: " + textStatus );
  }); 
};


function cloneAccToMenu(cur, acc, name, target){
  var request = $.ajax({
    url: "<?php echo rtrim(JURI::base(), '/') . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); ?>?ajaxcall=com_teftelebudget",
    type: "POST",
    data: {
    code:     107,
    acc:      acc,
    name:     name,
    curr:     cur
    },
    dataType: "html"
  });

  request.done(function(response) {
    $("#" + target).append(response);
    //showtoast(11);
  });

  request.fail(function(jqXHR, textStatus) {
    alert( "Request failed: " + textStatus );
  }); 
};


function menuitem_reorder(id){
  let sequence = "";
  let acccheck = [];
  $("#" + id).find(".mencard").each(function(){
    let attracc = $(this).attr("acc");
    if ($.inArray(attracc, acccheck) < 0){
      sequence = sequence + $(this).attr("acc") + ",";
      acccheck.push(attracc);
    } else {
      showtoast(16);
      $(this).remove();
    }
  });
  if (sequence == ""){ return false; }
  var request = $.ajax({
    url: "<?php echo rtrim(JURI::base(), '/') . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); ?>?ajaxcall=com_teftelebudget",
    type: "POST",
    data: {
    code:     122,
    iden:     id,
    seqs:     sequence
    },
    dataType: "html"
  });
  request.done(function(response) {
    console.log("order changed OK");
  });

  request.fail(function(jqXHR, textStatus) {
    alert( "Request failed: " + textStatus );
  }); 
};


function removecard(id){
  let parentd = $("#mit_" + id).parent();
  let pid = $(parentd).attr("id");
  $("#mit_" + id).remove();
  setTimeout(function () {
        menuitem_reorder(pid);
    }, 1000);
    showtoast(15);
};


function delete_account(){
  id = trans_account;
  if (confirm("Remove account and all included events?")){
    var request = $.ajax({
    url: "<?php echo rtrim(JURI::base(), '/') . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); ?>?ajaxcall=com_teftelebudget",
    type: "POST",
    data: {
    code:     187,
    acc:      id
    },
    dataType: "html"
  });

  request.done(function(response) {
    $("#acc_" + id).remove();
    myModal.hide();
    showtoast(12);
    alert(response);
  });

  request.fail(function(jqXHR, textStatus) {
    alert( "Request failed: " + textStatus );
  }); 
  }
};
</script>

<div id="EditorWindow" class="modal fade " style="display: none;" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
     <div class="modal-content">
        <div class="modal-header">
           <h5 class="modal-title" id="modtitle">Edit item</h5>
           <button type="button" class="btn-close" data-bs-dismiss="modal" daria-label="Close"></button>
        </div>
        <div class="modal-body">

        <div class="mb-3">
          <label class="label">Account name</label>
          <input class="form-control" type="text" 
          placeholder="name" value="" id="tf_accname" />
        </div>

        <div class="mb-3">
          <label class="label">Currency identifier</label>
          <select class="form-select" aria-label="Currency" id="tf_currency">
             <option value="USD">USD</option>
             <option value="EUR">EUR</option>
             <option value="GPB">GPB</option>
             <option value="RUB">RUB</option>
             <option value="BYR">BYR</option>
         </select>
        </div>
        <div class="mb-3">
          <label class="label">A number of symbols after comma. (commonly is 2)</label>
          <input class="form-control" type="number" min='0' max='8'
          placeholder="" value="2" id="tf_decimal" placeholder='' />
        </div>
        <div class="mb-3">
          <label class="label">Preferred language of the content within the account</label>
          <select class="form-select" aria-label="Language" id="tf_language">
            <?php
            foreach ($languages_obj AS $key => $language){
              echo "<option value='{$language->lang_code}'>{$language->title_native}</option>";
            };
             ?>
         </select>
        </div>
        <div class="mb-3">
          <label class="label">Type of account (Opened account can be accessible to outsiders)</label>
          <select class="form-select" aria-label="Access type" id="tf_accesstype">
             <option value="0">Private account</option>
             <option value="1">Opened for Coworkers</option>
             <option value="2">Opened for Friends</option>
             <option value="3">Opened for Registered</option>
             <option value="4">Opened account</option>
         </select>
        </div>
        <div class="mb-3">
          <label class="label">Comment or description of Account</label>
          <textarea class="form-control"
           placeholder="Description" rows="3"
           id="tf_comment"></textarea>
        </div>

        <div class="mb-3 tf_archieved">
          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="tf_archieved">
            <label class="form-check-label" for="tf_dregremove"><?= Text::_('COM_TFBUDGET_MODAL_FIELD_ARCHIEVED_ACC') ?></label>
          </div>
        </div>
        <div class="mb-3 tf_notshowdefault">
          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="tf_notshowdefault">
            <label class="form-check-label" for="tf_dregremove"><?= Text::_('COM_TFBUDGET_MODAL_FIELD_NOT_SHOW_ACC') ?></label>
          </div>
        </div>

        </div>
        <div class="modal-footer">
        <button type="button" id="deletethis" onclick="delete_account()" class="btn btn-danger">Delete</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="saveitembtn" onclick="save_account()" class="btn btn-success">Save</button>
      </div>
     </div>
  </div>
</div>


<div id="MenuWindow" class="modal fade" style="display: none;" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
     <div class="modal-content">
        <div class="modal-header">
           <h5 class="modal-title" id="menutitle">Edit item</h5>
           <button type="button" class="btn-close" data-bs-dismiss="modal" daria-label="Close"></button>
        </div>
        <div class="modal-body">

        <div class="mb-3">
          <label class="label">Menu Item name</label>
          <input class="form-control" type="text" 
          placeholder="name" value="" id="tf_menu_name" maxlength="12" />
        </div>

        <div class="mb-3">
          <label class="label">Name Literals (from 1 to 5 symbols)</label>
          <input class="form-control" type="text" 
          placeholder="literals" value="" id="tf_menu_liter" maxlength="5" />
        </div>

        <div class="mb-3">
          <label class="label">Currency of menu section</label>
          <select class="form-select" aria-label="Access type" id="tf_menu_curr">
            <?php foreach ($curs AS $value){
              echo "<option value='{$value}'>{$value}</option>";
            };
?>
         </select>
        </div>

        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="menusaveitembtn" onclick="create_menuitem()" class="btn btn-info">Create</button>
      </div>
     </div>
  </div>
</div>
<?php // print_r(AccountModel::LoadMoneyInAccountsToday($user->id)); ?>
<script>
var trans_account = 0;
var existed_currencies = [
  <?php foreach($curs AS $value){
    echo "'" . $value . "',";
  }; ?>
];
   // ---- DRAG N DROP HANDLERS ------------ //
   // 

function allowDrop(ev) {
  ev.preventDefault();
}

function drag(ev) {
  ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
/



  var sourceEventId = ev.dataTransfer.getData("text");
  let sourcecell  = $("#" + sourceEventId).parent();
  if ($(sourcecell).hasClass("accard-dragarea")){
    
  }
	let poolareaid = "templatepool";

	let dropfield  = ev.target.id;

  // TARGET : ACCOUNTS
  if ($(ev.target).hasClass("accard-dragarea") && $(sourcecell).hasClass("accard-dragarea")){
    if ($(sourcecell).attr('curr') != $(ev.target).attr('curr')){
      let curchan = $(ev.target).attr('curr');
      changecurrinaccount(sourceEventId, curchan);
    };
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    ev.target.appendChild(document.getElementById(data));
    accounts_reorder();
    //changeAccoOrder();
    //showtoast(9);
    };
  
  // TARGET : ACCOUNTS
  if ($(ev.target).hasClass("menus-dragarea") && $(sourcecell).hasClass("menus-dragarea")){
    if ($(sourcecell).attr('curr') == $(ev.target).attr('curr')){
      ev.preventDefault();
      var data = ev.dataTransfer.getData("text");
      ev.target.appendChild(document.getElementById(data));
    //changeAccoOrder();
      showtoast(9);
      menus_reorder();

      setTimeout(function () {
        menuitem_reorder(ev.target.id);
    }, 1000);
    setTimeout(function () {
        menuitem_reorder(sourcecell.id);
    }, 1500);
    } else {
      showtoast(20);
    }
    };

    // TARGET : MENUS
  if ($(ev.target).hasClass("menus-dragarea") && $(sourcecell).hasClass("accard-dragarea")){
    if ($(sourcecell).attr('curr') == $(ev.target).attr('curr')){
      let clonecur = $(ev.target).attr('curr');
      let cloneacc = $("#" + sourceEventId).attr("acc");
      let clonename = $("#" + sourceEventId).find(".mname").text();
      cloneAccToMenu(clonecur, cloneacc, clonename, ev.target.id);
      showtoast(19);
      setTimeout(function () {
        menuitem_reorder(ev.target.id);
    }, 1000);
  } else {
      showtoast(20);
    }
  };

if (poolareaid == dropfield){ // In general to prevent including

  ev.preventDefault();
  var data = ev.dataTransfer.getData("text");
  ev.target.appendChild(document.getElementById(data));
  //changeAccoOrder();
  showtoast(9);
  };
};

var transidenter = '';

function openeditor(id){
  if (id == ''){
    transidenter = '';
    $("#tf_accname").val('');
    $("#tf_currency").val('');
    $("#tf_decimal").val(2);
    $("#tf_language").val('');
    $("#tf_accesstype").val('');
    $("#tf_comment").val('');
    $("#deletethis").addClass('d-none');
    $("#archievethis").addClass('d-none');
    $(".tf_archieved").addClass('d-none');
  } else {
    transidenter = id;
    trans_account = id;
    $(".tf_archieved").removeClass('d-none');
    modalfiller(transidenter);
  }
}

function openmenueditor(id){
  if (id == ''){
    transidenter = '';
    $("#tf_accname").val('');
    $("#tf_currency").val('');
    $("#tf_decimal").val(2);
    $("#tf_language").val('');
    $("#tf_accesstype").val('');
    $("#tf_comment").val('');
    $("#deletethis").addClass('d-none');
    $("#archievethis").addClass('d-none');
  } else {
    transidenter = id;
    modalfiller(transidenter);
  }
}

var trans_currency = "";

function modalfiller(iden){
  var request = $.ajax({
		url: "<?php echo rtrim(JURI::base(), '/') . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); ?>?ajaxcall=com_teftelebudget",
		type: "POST",
		data: {
      code:     106,
      iden:    iden
		},
		dataType: "html"
});
 
request.done(function(response) {
   let object = JSON.parse(response);
   transisdenter = object.id;
    $("#tf_accname").val(object.name);
    $("#tf_currency").val(object.currency);
    $("#tf_decimal").val(object.decimals);
    $("#tf_language").val(object.language);
    $("#tf_accesstype").val(object.accesstype);
    $("#tf_comment").val(object.comment);
    $("#deletethis").removeClass('d-none');
    $("#archievethis").removeClass('d-none');

    if (object.archieved == 0){
    $('#tf_archieved').prop('checked', false);
  } else {
    $('#tf_archieved').prop('checked', true);
  };
  if (object.notshow == 0){
    $('#tf_notshowdefault').prop('checked', false);
  } else {
    $('#tf_notshowdefault').prop('checked', true);
  };
    trans_currency = object.currency;
});

request.fail(function(jqXHR, textStatus) {
  alert( "Request failed: " + textStatus );
}); 
}

function save_account(){
  let name = $("#tf_accname").val();
  let curr = $("#tf_currency").val();
  let lang = $("#tf_language").val();
  let accs = $("#tf_accesstype").val();
  let deci = $("#tf_decimal").val();
  let comm = $("#tf_comment").val();
  let archieved = 0;
  if ($("#tf_archieved").is(":checked")){
    archieved = 1;
  };
  let notshow = 0;
  if ($("#tf_notshowdefault").is(":checked")){
    notshow = 1;
  };
  
  if (name.length < 1){
    alert("Name is too short!");
    return false;
  }

  let newcurrency = 1;
  for (let i = 0; i < existed_currencies.length; i++){
    if (curr == existed_currencies[i]){
      newcurrency = 0;
    };
  };
  if (name.length < 3){ alert("Name is too short"); return false; }
  if (transidenter == ''){ // IF ID IS EMPTY, create new
    var request = $.ajax({
    url: "<?php echo rtrim(JURI::base(), '/') . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); ?>?ajaxcall=com_teftelebudget",
    type: "POST",
    data: {
    code:       144,
    name:       name,
    currency:   curr,
    language:   lang,
    access:     accs,
    decimals:   deci,
    comment:    comm,
    archieved:  archieved,
    notshow:    notshow,
    newcurr:    newcurrency
    },
    dataType: "html"
  });

  request.done(function(response) {
    if (newcurrency == 1){
    $("#tf_accountpool").append(response);
    } else {
      $(".accard-dragarea").each(function(){
        if ($(this).attr("curr") == curr){
          $(this).append(response);
        }
      })
    }
    showtoast(10);
    accounts_reorder();
  });

  request.fail(function(jqXHR, textStatus) {
    alert( "Request failed: " + textStatus );
  }); 
  } else { // SAVE
    if (trans_currency != curr && newcurrency == 1){
      newcurrency = 1;
    } else {
      newcurrency = 0;
    };
    var request = $.ajax({
    url: "<?php echo rtrim(JURI::base(), '/') . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); ?>?ajaxcall=com_teftelebudget",
    type: "POST",
    data: {
    code:     166,
    iden:     transidenter,
    name:     name,
    currency: curr,
    language: lang,
    access:   accs,
    decimals: deci,
    comment:  comm,
    archieved:  archieved,
    notshow:    notshow,
    newcurr:  newcurrency
    },
    dataType: "html"
  });

  request.done(function(response) {
    $("#acc_" + transidenter).remove();
    if (newcurrency == 1){
    $("#tf_accountpool").append(response);
    } else {
      $(".accard-dragarea").each(function(){
        if ($(this).attr("curr") == curr){
          $(this).append(response);
        };
      })
    };
    showtoast(11);
    accounts_reorder();
  });

  request.fail(function(jqXHR, textStatus) {
    alert( "Request failed: " + textStatus );
  }); 
  };
  myModal.hide();
};

$(document).ready(function(){
  addmenuitems();
});






function create_menuitem(){
  let currency = $("#tf_menu_curr").val();
  let name = $("#tf_menu_name").val();
  let literals = $("#tf_menu_liter").val();
  var request = $.ajax({
    url: "<?php echo rtrim(JURI::base(), '/') . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); ?>?ajaxcall=com_teftelebudget",
    type: "POST",
    data: {
    code:     146,
    curr:     currency,
    name:     name,
    liter:    literals
    },
    dataType: "html"
  });

  request.done(function(response) {
    $("#tf_menupool").append(response);
      showtoast(11);
      menus_reorder();
  });

  request.fail(function(jqXHR, textStatus) {
    alert( "Request failed: " + textStatus );
  }); 
  myModal2.hide();
};

<?php
if ($user->guest && $accountcounter > $guestAccLimit){
  ?>
$("#createbutton").remove();
  <?php
} else {
  ?>

  <?php
};
?>

function addmenuitems(){
  let items = `<?php 
  if (isset($addition_menu_items)){
    echo $addition_menu_items;
  };
  ?>`;
  $("#sidebarMenu").find(".metismenu").append(items);
};

var myModal2 = new bootstrap.Modal(document.getElementById('MenuWindow'), {
  keyboard: false
});
/* ---- DRAG N DROP HANDLERS END  ------------ */

?>
@endsection

@section('page-scripts')
<script>
var activeId = 0;

function DOM(){
  let cardBoxes = document.querySelectorAll(".card-box");
  let groupContainer = "";
  let accards = document.querySelectorAll('.accard');
  let modalWindow = document.querySelector("#modal_account");
  let menuTrigger = document.querySelectorAll(".itemMenu");


  for (let i = 0; i < accards.length; i++){
    accards[i].addEventListener('dblclick', function(){
      //alert("HOHOHO");
      //UIkit.modal('#modal_account').show();
      activeId = accards[i].parentNode.id;
      UIkit.modal(modalWindow).show();
      modalWindow.querySelectorAll('.uk-modal-title')[0].innerHTML = "Edit account";
      fillModalWindow();
    });
  }

  for (let i = 0 ; i < cardBoxes.length; i++){
  cardBoxes[i].addEventListener('mouseout', function(){
    let counter = 0;
    if (groupContainer == ""){
      groupContainer = cardBoxes[i].parentNode.parentNode.innerHTML;
      return;
    }
    if (domContainer != document.querySelector("#domContainer").innerHTML && !document.querySelector("html").classList.contains("uk-drag")){
      refreshCounters();
      domContainer = document.querySelector("#domContainer").innerHTML;
      // Handle Items moving 
      if (groupContainer != cardBoxes[i].parentNode.parentNode.innerHTML){
        // Do if container's boxes order changed
        if (counter == 0){
          //reorderItems(cardBoxes[i].parentNode.parentNode);
          groupContainer = cardBoxes[i].parentNode.parentNode.innerHTML;
          counter++;
          saveNewOrder();
          console.log("You reordered");
        }
      }
      let categoryBoxes = document.querySelectorAll('.catBox');
      let groupOrderString = "";
            for (let y = 0; y < categoryBoxes.length; y++){
              groupOrderString += categoryBoxes[y].id;
            };
     // saveGroupOrder(groupOrderString);
    }
  })
};
  

function saveNewOrder(){
  let data = [];
  for (let i = 0; i < cardBoxes.length; i++){
    let obj = {};
    obj.id = cardBoxes[i].id;
    obj.currency = cardBoxes[i].parentNode.parentNode.getAttribute('data-currency');
    data.push(obj);
  }

  let counter = 0;
    let requestCode = 231;
    let outFormat = "number";
//    setTimeout(() => {   }, 5000);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == -1){ alert("You are not registered!");
          return 0;
        };
        return 1;
      }
      else if (this.status > 200)
      {
        if (counter < 1){
          alert("Oops! There is some problems with the server connection.");
          counter++;  
        }
      }
    };
    xhttp.open("POST", "/budger/ajaxcall?code=" + requestCode + "&format=" + outFormat, false);
    // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhttp.setRequestHeader('X-CSRF-TOKEN', '<?php echo csrf_token(); ?>');
   // xhttp.setRequestHeader('name', '<?php echo csrf_token(); ?>');
    xhttp.send(JSON.stringify(data));
}

for (let i = 0; i < menuTrigger.length; i++)
  {
    menuTrigger[i].addEventListener("mouseover", function(){
      //eventBlock = true; 
      let left = menuTrigger[i].getBoundingClientRect().left;
      let top = menuTrigger[i].getBoundingClientRect().top;


      if (document.querySelector('#itemMenu') != null){
        document.querySelector('#itemMenu').remove();
      }
      let block = `<?php echo budgerTemplates::renderAccountItemMenu(); ?>`;
      document.body.insertAdjacentHTML('beforeEnd', block);
      block = document.querySelector('#itemMenu');
      block.style.position = "fixed";
      let width = block.getBoundingClientRect().width - menuTrigger[i].getBoundingClientRect().width;
      block.style.left = ( left - width ) + "px";
      block.style.top = top + "px";
      let id = menuTrigger[i].parentNode.parentNode.parentNode.id;
      let parentItem = menuTrigger[i].parentNode.parentNode.parentNode;
      //parentItem.classList.add('menu-opened');
      block.setAttribute('data-target', id);
      let buttons = block.querySelectorAll(".uk-nav")[0].childNodes;
      for (let y = 0; y < buttons.length; y++){

        buttons[y].addEventListener('click', function(elem){
          if (buttons[y].getAttribute('data-event') == 'archieve'){
            archieveItem(id);
          } else if (buttons[y].getAttribute('data-event') == 'restore'){
            restoreItem(id);
          } else if (buttons[y].getAttribute('data-event') == 'remove'){
            removeItem(id);
            document.querySelector('#itemMenu').remove();
          }
          //parentItem.classList.remove('menu-opened');
        });
      }

      block.addEventListener("mouseleave", function(){
        setTimeout(() => {
          document.querySelector('#itemMenu').remove();
          //parentItem.classList.remove('menu-opened');
          }, 10);
      });

    });
  }


  function fillModalWindow(){
    let counter = 0;
    let requestCode = 250;
    let outFormat = "json";
    document.querySelector('#btn_removeIt').classList.remove("uk-hidden");
//    setTimeout(() => {   }, 5000);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == -1){ alert("You are not registered!");
          return 0;
        };
        let data = JSON.parse(this.responseText);
        //alert(this.responseText);
        document.querySelector('#tf_name').value = data.name;
        document.querySelector('#tf_description').innerHTML = data.description;
        document.querySelector('#tf_decimal').value = data.decimals;
        document.querySelector('#tf_acctype').value = data.type;
        document.querySelector('#tf_currency').value = data.currency;
        document.querySelector('#tf_archieved').checked = data.archieved;
        document.querySelector('#tf_hotshow').checked = data.notshow;
        return 1;
      }
      else if (this.status > 200)
      {
        if (counter < 1){
          alert("Oops! There is some problems with the server connection.");
          counter++;  
        }
      }
    };
    xhttp.open("POST", "/budger/ajaxcall?code=" + requestCode + "&format=" + outFormat, false);
    // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhttp.setRequestHeader('X-CSRF-TOKEN', '<?php echo csrf_token(); ?>');
   data = {};
   data.code = requestCode;
   data.id = activeId;
    xhttp.send(JSON.stringify(data));
  }


  function removeItem(id){
    let counter = 0;
    let requestCode = 290;
    let outFormat = "json";
    let data = {};
    data.id = id;
//    setTimeout(() => {   }, 5000);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == -1){ alert("You are not registered!");
          return 0;
        };
        document.querySelector('#' + id).remove();
        //alert(this.responseText);
        return 1;
      }
      else if (this.status > 200)
      {
        if (counter < 1){
          alert("Oops! There is some problems with the server connection.");
          counter++;  
        }
      }
    };
    xhttp.open("POST", "/budger/ajaxcall?code=" + requestCode + "&format=" + outFormat, false);
    // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhttp.setRequestHeader('X-CSRF-TOKEN', '<?php echo csrf_token(); ?>');
   // xhttp.setRequestHeader('name', '<?php echo csrf_token(); ?>');
    xhttp.send(JSON.stringify(data));
  }

}

// -------------------- RESTRICTOR ----------------
function DOMmanager(){
  let modalWindow = document.querySelector("#modal_account");
  let addGroupTrigger = document.querySelector("#addGroupButton");
  let collapseAllButton = document.querySelector("#collapesAllButton");
  let removeButton = document.querySelector('#btn_removeIt');
  let saveButton = document.querySelector("#saveButton");

  collapseAllButton.addEventListener("click", function(){
    let catBoxes = document.querySelectorAll(".catBox");
    let condition = collapseAllButton.getAttribute("data-collapsed");
    //alert(condition);
    for (let i = 0; i < catBoxes.length; i++)
    {
      
      if (condition == 'false')
      {
        catBoxes[i].classList.add("collapsed");
          collapseAllButton.setAttribute("data-collapsed", true);
        }
        else 
        {
          catBoxes[i].classList.remove("collapsed");
          collapseAllButton.setAttribute("data-collapsed", false);
        }
    }
  });

  addGroupTrigger.addEventListener('click', function(){
    activeId = 0;
    UIkit.modal(modalWindow).show();
    modalWindow.querySelectorAll('.uk-modal-title')[0].innerHTML = "Create account";
    document.querySelector('#btn_removeIt').classList.add("uk-hidden");

    document.querySelector('#tf_name').value            = "";
    document.querySelector('#tf_description').innerHTML = "";
    document.querySelector('#tf_decimal').value         = 0;
    document.querySelector('#tf_acctype').value         = 1;
    document.querySelector('#tf_currency').value        = 1;
    document.querySelector('#tf_archieved').checked     = false;
    document.querySelector('#tf_hotshow').checked       = false;
  });


  saveButton.addEventListener('click', function(){
    if (activeId == 0){
      saveNewAccount();
    } 
    else 
    {
      saveAccount(activeId);
    }
  });



  function saveNewAccount(){
      let name =  document.querySelector('#tf_name').value;
      let descr =  document.querySelector('#tf_description').value;
      let decimals =  document.querySelector('#tf_decimal').value;
      let type =  document.querySelector('#tf_acctype').value;
      let currency =  document.querySelector('#tf_currency').value;
      let archieved =  document.querySelector('#tf_archieved').checked ? 1 : 0;
      let notshow =  document.querySelector('#tf_hotshow').checked ? 1 : 0;
      let data = {};
      data.name = name;
      data.descr = descr;
      data.decimals = decimals;
      data.type = type;
      data.currency = currency;
      data.archieved = archieved;
      data.notshow = notshow;

    let counter = 0;
    let requestCode = 200;
    let outFormat = "json";
    document.querySelector('#btn_removeIt').classList.remove("uk-hidden");
//    setTimeout(() => {   }, 5000);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == -1){ alert("You are not registered!");
          return 0;
        };
        UIkit.modal(modalWindow).hide();
        return 1;
      }
      else if (this.status > 200)
      {
        if (counter < 1){
          alert("Oops! There is some problems with the server connection.");
          counter++;  
        }
      }
    };
    xhttp.open("POST", "/budger/ajaxcall?code=" + requestCode + "&format=" + outFormat, false);
    // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhttp.setRequestHeader('X-CSRF-TOKEN', '<?php echo csrf_token(); ?>');
   // xhttp.setRequestHeader('name', '<?php echo csrf_token(); ?>');
    xhttp.send(JSON.stringify(data));
  }
  
  function saveAccount(){
    let name =  document.querySelector('#tf_name').value;
      let descr =  document.querySelector('#tf_description').value;
      let decimals =  document.querySelector('#tf_decimal').value;
      let type =  document.querySelector('#tf_acctype').value;
      let currency =  document.querySelector('#tf_currency').value;
      let archieved =  document.querySelector('#tf_archieved').checked ? 1 : 0;
      let notshow =  document.querySelector('#tf_hotshow').checked ? 1 : 0;
      let data = {};
      data.id = activeId;
      data.name = name;
      data.descr = descr;
      data.decimals = decimals;
      data.type = type;
      data.currency = currency;
      data.archieved = archieved;
      data.notshow = notshow;

    let counter = 0;
    let requestCode = 230;
    let outFormat = "json";
    document.querySelector('#btn_removeIt').classList.remove("uk-hidden");
//    setTimeout(() => {   }, 5000);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == -1){ alert("You are not registered!");
          return 0;
        };
        //alert(this.responseText);
        UIkit.modal(modalWindow).hide();
        return 1;
      }
      else if (this.status > 200)
      {
        if (counter < 1){
          alert("Oops! There is some problems with the server connection.");
          counter++;  
        }
      }
    };
    xhttp.open("POST", "/budger/ajaxcall?code=" + requestCode + "&format=" + outFormat, false);
    // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhttp.setRequestHeader('X-CSRF-TOKEN', '<?php echo csrf_token(); ?>');
   // xhttp.setRequestHeader('name', '<?php echo csrf_token(); ?>');
    xhttp.send(JSON.stringify(data));
    
  }

}




DOM();
DOMmanager();




function refreshCounters(){
  let groups =  document.querySelectorAll(".catBox");
  for (let i = 0 ; i < groups.length; i++){
    let c = groups[i].querySelectorAll(".card-box") == null ? 0 : groups[i].querySelectorAll(".card-box").length;
    groups[i].querySelectorAll(".counts")[0].innerHTML = "[" + c + "]";
  }
}

</script>
@endsection