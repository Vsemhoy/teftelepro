@extends('Template.shell')

@section('page-content')

    <?php
    use App\Http\Controllers\Controller;
    use App\Http\Controllers\Components\Budger\BudgerMain;
    use App\Http\Controllers\Components\Budger\BudgerData;
    use App\Http\Controllers\Components\Budger\BudgerTemplates;
    use Illuminate\Foundation\Auth\User;
    // $routed = explode('.', Route::currentRouteName())[0];
    // $section = "";
    // if (isset(explode('.', Route::currentRouteName())[1])){
    //   $section = explode('.', Route::currentRouteName())[1];
    // };
    // $component = Controller::getComponent($routed);
    $user = User::where('id', '=', session('LoggedUser'))->first();
    // $instant  = new Controller();
    // echo $instant->renderValue();

    // $results = DB::select('select * from splmod_users where id < ?', [10]);
    // foreach($results AS $key => $value){
    //     print_r($value);
    //     echo "<br>";
    // }
    $com = Controller::getComponent('budger');
    $cont = new BudgerMain($user->id);
    
    ?>

<div class="uk-section uk-section-primary uk-padding-small">
    <div class="uk-container uk-container-small uk-light">
    <h3 class="uk-card-title uk-light text-white">Budget events</h3>
    <p uk-margin>

      <button class="uk-button uk-button-default">Add event</button>
      <button class="uk-button uk-button-default">Collapse all</button>
      <button class="uk-button uk-button-default" disabled>Disabled</button>
      </p>
    </div>
</div>

<div class="section-l w-100 bg-white" style="overflow: auto;" id="main-tf-1">

    <div class="container-fluid px-0">
      <div class="input-group mb-0">
      <input id="tf_budget_search" type="text" class="form-control rounded-0 bg-transparent" placeholder="Component search" aria-label="Recipient's username" aria-describedby="button-addon2" value="">
      <button class="btn btn-outline-secondary rounded-0 bg-transparent " type="button" id="button-addon1">GO!</button>
      <button onclick="togglefilterarea();" class="btn btn-outline-secondary rounded-0 bg-transparent " type="button" id="button-addon2">Filter</button>
    </div>
    <div class="filterarea d-none p-4 card">
      <div class="container">
      <form method="GET" action="/index.php/component/teftelebudget/?stm=2022-06&amp;enm=2022-08">
        <div class="row">
          <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-3">
            <select onchange="selectGroupsBycurrency();" class="form-select" name="cur" id="currency_filter" value="">
<option value="RUB">RUB</option>
Warning:  Undefined variable $urrentCurr in /home/host1334262/teftele.com/htdocs/www/components/com_teftelebudget/tmpl/index/default.php on line 620
<option value="USD">USD</option><option value="BYR">BYR</option>            </select>
          </div>
          <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3  mb-3">
            <select class="form-select" multiple="" name="acc[]" id="accounts_filter">
            <option value="1" class="" currency="RUB">CASH</option><option value="2" class="" currency="RUB">SBER CARD</option><option value="7" class="" currency="RUB">Credit Debt</option><option value="4" class="d-none" currency="USD">Global Success</option><option value="8" class="d-none" currency="USD">Beginning deals</option><option value="3" class="d-none" currency="BYR">TINKOFF CR</option>            </select>
          </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3  mb-3">
            <label for="stm">Month from (past)</label>
            <input class="form-control" type="month" id="stm" name="stm" value="2022-06">
          </div>
          <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3  mb-3">
            <label for="enm">Month to (future)</label>
            <input class="form-control" type="month" id="enm" name="enm" value="2022-08">
          </div>
          <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3  mb-3">
            <input class="btn btn-secondary" type="submit" value="Submit Button">
          </div>
        </div>
</form>
      </div>
    </div>
    </div>
      <div class="p-0">
 <!--  <h2>COM_TEFTELEBUDGET_MSG_HELLO_ACCOUNTS</h2> -->
<p><?php  echo $cont->currentCurrency; ?> - current currency</p>
 <br>
 <?php echo $cont->get_lastMonth; ?>
  <div class="container">

      <?php echo $cont->renderNavigateButtons(); ?>
      <?php echo $cont->renderWholeTable(); ?>

</div>
<br>

      <?php 
      $user = 3;
      // $result = DB::select('select * from ' . env('TB_BUD_ACCOUNTS') . ' where user = :user AND notshow = 0 AND is_removed = 0 ORDER BY ordered ASC', ['user' => $user, ]);
      // print_r($result);
      ?>

  
    <div class="container">
    <div class="alert alert-info" role="alert">  
      Press SHIFT before you start draging an Event to make a copy of event    </div>
    <div class="alert alert-info" role="alert">  
      This section uses Nestable.JS which implements five-level nesting of items. At the moment this functionality is redundant, but in the future I will definetly figure out how to use it with the greatest benefit for the user.    </div>
  </div>
</div>
  
<?php echo $cont->currentCurrency;
print_r(BudgerData::LoadCurrencies_keyId($user)); ?>

  </div>
  </div>
<?php 
 echo BudgerTemplates::renderEventModal(
  BudgerData::LoadAccountsByCurrency($user, $cont->currentCurrency),
 BudgerData::LoadGroupedCategories($user),
BudgerData::LoadAccountList($user),
BudgerData::LoadCurrencies_keyId($user)
    );
 ?>


@endsection

@section('page-scripts')
<script>


let modalTriggers  = document.querySelectorAll(".event_trigger");
let doubleTriggers = document.querySelectorAll(".droptabledata");

// --------------------------- DOM -------------------


class ModalHandler
{
  parent;
  constructor() 
  {
    this.eventType = 0;

    this.modalWindow = document.querySelector("#modal_event");
    this.btnInc = document.querySelectorAll('.uk-button-incom')[0];
    this.btnExp = document.querySelectorAll('.uk-button-expense')[0];
    this.btnTrs = document.querySelectorAll('.uk-button-transfer')[0];
    this.modHeader = document.querySelectorAll('.uk-modal-header')[0];
    this.btnOptns = document.querySelector('#btn_optionTrigger');
    this.btnManage = document.querySelector('#btn_manageTrigger');

    this.btnDisable = document.querySelector("#btnDisableEvent");
    this.btnSave = document.querySelector("#btnSaveEvent");

    this.rowTgAcc = document.querySelector('#row_targetAcc');
    this.rowCateg = document.querySelector('#row_category');

    this.rowOptions = document.querySelector('#mod_options_body');
    this.rowManage = document.querySelector('#mod_manage_body');

    this.title = document.querySelector('#mod_title');

    this.modalTriggers  = document.querySelectorAll(".event_trigger");
    this.doubleTriggers = document.querySelectorAll(".droptabledata");
    this.run = this.run();
    //this.buttonHandle = this.buttonHandle(this);

    this.btnExp.addEventListener('click', this.SetExpense);
    this.btnInc.addEventListener('click', this.SetIncom);
    this.btnTrs.addEventListener('click', this.SetTranfer);
    this.btnOptns.addEventListener('click', this.SetOptionsShowed);
    this.btnManage.addEventListener('click', this.SetManageShowed);
    this.btnSave.addEventListener('click', this.SaveNewEvent);

    parent = this;
  }

  run(){
    let modalTriggers = this.modalTriggers;
    let doubleTriggers = this.doubleTriggers;
    let base = this;

    Array.from(modalTriggers).forEach(i => i.addEventListener("click", function(event){
      let elem = this.parentNode;
      base.openEventModal(elem);
      base.buildClearEventModal(elem, event);
    }));
    
    Array.from(doubleTriggers).forEach(i => i.addEventListener("dblclick", function(event){
      let elem = this;
      base.openEventModal(elem);
      base.buildClearEventModal(elem, event);
    }));
  }

    openEventModal(elem){
     UIkit.modal(parent.modalWindow).show();
   }
  
    buildClearEventModal(elem, ev){
      if (ev.ctrlKey){
        this.SetIncom();
      } else if  (ev.altKey) {
        this.SetTranfer();
      } else {
        this.SetExpense();
      }
      this.SetOptionsHidden();
      this.title.innerHTML = 'Add new event';

      let date = elem.parentNode.getAttribute('date');
      document.querySelector('#mod_date').value = date;
     //alert(date);
   }

  SetExpense(){
    parent.btnInc.classList.remove('active');
    parent.btnExp.classList.add('active');
    parent.btnTrs.classList.remove('active');
   
    parent.modHeader.classList.add('hd-incom');
    parent.modHeader.classList.remove('hd-expense');
    parent.modHeader.classList.remove('hd-transfer');

    parent.rowTgAcc.classList.add('uk-hidden');
    parent.eventType = 2;
  }
  SetIncom(){
    parent.btnInc.classList.add('active');
    parent.btnExp.classList.remove('active');
    parent.btnTrs.classList.remove('active');
 
    parent.modHeader.classList.remove('hd-incom');
    parent.modHeader.classList.add('hd-expense');
    parent.modHeader.classList.remove('hd-transfer');

    parent.rowTgAcc.classList.add('uk-hidden');
    parent.eventType = 1;
  }
  SetTranfer(){
    parent.btnInc.classList.remove('active');
    parent.btnExp.classList.remove('active');
    parent.btnTrs.classList.add('active');
    
    parent.modHeader.classList.remove('hd-incom');
    parent.modHeader.classList.remove('hd-expense');
    parent.modHeader.classList.add('hd-transfer');

    parent.rowTgAcc.classList.remove('uk-hidden');
    parent.eventType = 3;
  }
  SetOptionsHidden(){
    
    parent.rowManage.classList.add('uk-hidden');
    parent.rowOptions.classList.add('uk-hidden');
    parent.btnOptns.classList.remove('uk-background-default');
    parent.btnManage.classList.remove('uk-background-default');

  }
  SetOptionsShowed(){
    parent.btnOptns.classList.add('uk-background-default');
    parent.btnManage.classList.remove('uk-background-default');
    parent.rowManage.classList.add('uk-hidden');
    parent.rowOptions.classList.remove('uk-hidden');
  }
  SetManageShowed(){
    parent.btnOptns.classList.remove('uk-background-default');
    parent.btnManage.classList.add('uk-background-default');
    parent.rowOptions.classList.add('uk-hidden');
    parent.rowManage.classList.remove('uk-hidden');
  }

  SaveNewEvent()
  {
    let requestCode = 300;
    let outFormat = "number";

    let name = document.querySelector('#mod_name').value;
    if (name.length == 0){
      alert("Name is too short!");
      return;
    }

    let data = {};
    data.code = requestCode;
    data.name = name;
    data.type = parent.eventType;
    data.description = document.querySelector('#mod_description').value;
    data.amount = document.querySelector('#mod_amount').value;
    data.date = document.querySelector('#mod_date').value;
    data.category = document.querySelector('#mod_category').value;
    data.account = document.querySelector('#mod_account').value;
    data.target = document.querySelector('#mod_tgaccount').value;
    // Addtitional options
    let isRepeat = document.querySelector('#mod_isRepeat').checked ? 1 : 0;
    data.isrepeat = isRepet;
    data.repperiod = document.querySelector('#mod_repeatPeriod').value;
    data.reptimes = document.querySelector('#mod_repeatTimes').value;
    data.repchanger = document.querySelector('#mod_amountChanger').value;
    data.repgoal = document.querySelector('#mod_amounGoal').value;
    
    

    if (data.amount == ''){ data.amount = 0; };
    if (data.category == ''){ data.category = 0; };


    alert(isRepeat);

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == -1){ alert("You are not registered!");
          block.remove();
          return 0;
        };
        console.log(this.responseText);
        block.classList.remove("temper");
        block.setAttribute('id','item_' + this.responseText);
        setTimeout(() => {
          reorderItems(block.parentNode.parentNode);
        }, 30);
      }
      else if (this.status > 200)
      {
        if (counter < 1){
          alert("Oops! There is some problems with the server connection.");
          block.remove();
          counter++;
        }
      }
    };
    xhttp.open("POST", "/budger/ajaxcall?code=" + requestCode + "&format=" + outFormat, false);
    // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhttp.setRequestHeader('X-CSRF-TOKEN', '<?php echo csrf_token(); ?>');
   // xhttp.setRequestHeader('name', '<?php echo csrf_token(); ?>');

    alert(parent.eventType);

    //xhttp.send(JSON.stringify(data));
  }
}


class DOM {
  
  constructor() 
  {
    this.modalTriggers  = document.querySelectorAll(".event_trigger");
    this.doubleTriggers = document.querySelectorAll(".droptabledata");
    
  }
  

   


 }
 // --------------------------- DOM -------------------


  
class DomManager {
  constructor(){
    
    this.run = this.run();
  }

}
 var Modal = new ModalHandler();
//  var DOME = new DOM();
//  var DMAN =  new DomManager();

 


</script>
@endsection