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
    

    $accounts    = BudgerData::LoadAccountsByCurrency($user->id, $cont->currentCurrency);
    $categories  = BudgerData::LoadGroupedCategories($user->id);
    $allaccounts = BudgerData::LoadAccountList($user->id);
    $currencies  = BudgerData::LoadCurrencies_keyId($user->id);
    ?>

<div class="uk-section uk-section-primary uk-padding-small">
    <div class="uk-container uk-container-small uk-light">
    <h3 class="uk-card-title uk-light text-white">Budget events</h3>
    </div>
</div>

<div class="section-l w-100 bg-white" style="overflow: auto;" id="main-tf-1">

    <div class="container-fluid px-0">
      <div class="input-group mb-0">
      <input id="tf_budget_search" type="text" class="uk-input" 
      placeholder="Local filter" aria-label="Recipient's username" aria-describedby="button-addon2" value="">
      
    </div>
    <div class="filterarea d-none p-4 card">
      <div class="container">

      </div>
    </div>
    </div>
      <div class="p-0">
 <!--  <h2>COM_TEFTELEBUDGET_MSG_HELLO_ACCOUNTS</h2> -->

 <br>
 
  <div class="container">

      <?php echo $cont->renderNavigateButtons(); ?>
      <?php echo $cont->renderWholeTable(); ?>

</div>
<br>

      <?php 

      // $result = DB::select('select * from ' . env('TB_BUD_ACCOUNTS') . ' where user = :user AND notshow = 0 AND is_removed = 0 ORDER BY ordered ASC', ['user' => $user, ]);
      // print_r($result);
      ?>

  
    <div class="container">
      <div class="alert alert-info" role="alert">  
        Press SHIFT before you start draging an Event to make a copy of event    </div>
      <div class="alert alert-info" role="alert">  
        This section uses Nestable.JS which implements five-level nesting of items. 
        At the moment this functionality is redundant, but in the future I will definetly 
        figure out how to use it with the greatest benefit for the user.    </div>
    </div>
</div>
  

  </div>

<?php 
 echo BudgerTemplates::renderEventModal(
    $accounts,
    $categories,
    $allaccounts,
    $currencies  
    );

    echo BudgerTemplates::renderEventFilterModal(
      $accounts,
      $categories,
      $allaccounts,
      $currencies  
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

    this.selectCategory = document.querySelector('#mod_category');

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

    document.querySelector('#mod_description').addEventListener('keyup', function(elem){
      if (this.value.length > 0){
        let limit = 2000;
        let cou = this.value.length;
        let block = this.parentNode.querySelectorAll('.uk-text-meta')[0];
        block.innerHTML = cou + " of " + limit;
      } else {
        let block = this.parentNode.querySelectorAll('.uk-text-meta')[0];
        block.innerHTML = "";
      }
    });
    document.querySelector('#mod_name').addEventListener('keyup', function(elem){
      if (this.value.length > 0){
        let limit =  64;
        let cou = this.value.length;
        let block = this.parentNode.querySelectorAll('.uk-text-meta')[0];
        block.innerHTML = cou + " of " + limit;
      } else {
        let block = this.parentNode.querySelectorAll('.uk-text-meta')[0];
        block.innerHTML = "";
      }
    })
  }

  run(){
    let modalTriggers = this.modalTriggers;
    let doubleTriggers = this.doubleTriggers;
    let base = this;

    Array.from(modalTriggers).forEach(i => i.addEventListener("click", function(event){
      let elem = this.parentNode;
      base.openEventModal();
      base.buildClearEventModal(elem, event);
    }));
    
    Array.from(doubleTriggers).forEach(i => i.addEventListener("dblclick", function(event){
      let elem = this;
      let inblocks = elem.querySelectorAll('.bud-event-card');
      console.log(inblocks.length);
      if (inblocks.length == 0){
        base.openEventModal();
        base.buildClearEventModal(elem, event);

      }
    }));
  }

    openEventModal(){
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
      this.btnManage.setAttribute('disabled', 'disabled');

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

    let index = 0;
    let sel = parent.selectCategory.querySelectorAll('option');
    for (let i = 0; i < sel.length; i++){
      if (sel[i].getAttribute('data-type') == 2){
        sel[i].classList.remove('uk-hidden');
        if (index == 0 && !sel[i].classList.contains('opt-header')){
          parent.selectCategory.selectedIndex = i;
          index = i;
        }
      } else {
        sel[i].classList.add('uk-hidden'); 
      }
    }
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

    let index = 0;
    let sel = parent.selectCategory.querySelectorAll('option');
    for (let i = 0; i < sel.length; i++){
      if (sel[i].getAttribute('data-type') == 1){
        sel[i].classList.remove('uk-hidden');
        if (index == 0 && !sel[i].classList.contains('opt-header')){
          parent.selectCategory.selectedIndex = i;
          index = i;
        }
      } else {
        sel[i].classList.add('uk-hidden'); 
      }
    }
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

    let index = 0;
    let sel = parent.selectCategory.querySelectorAll('option');
    for (let i = 0; i < sel.length; i++){
      if (sel[i].getAttribute('data-type') == 3){
        sel[i].classList.remove('uk-hidden');
        if (index == 0 && !sel[i].classList.contains('opt-header')){
          parent.selectCategory.selectedIndex = i;
          index = i;
        }
      } else {
        sel[i].classList.add('uk-hidden'); 
      }
    }
  }
  SetOptionsHidden(){
    
    parent.rowManage.classList.add('uk-hidden');
    parent.rowOptions.classList.add('uk-hidden');
    parent.btnOptns.classList.remove('uk-background-default');
    parent.btnManage.classList.remove('uk-background-default');

  }
  SetOptionsShowed(){
    if (parent.btnOptns.classList.contains('uk-background-default')){
      parent.btnOptns.classList.remove('uk-background-default');
      parent.rowOptions.classList.add('uk-hidden');
      return;
    }
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
    let conter = 0;
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
    data.categoryname = document.querySelector('#mod_category')[document.querySelector('#mod_category').selectedIndex].text.trim();
    data.account = document.querySelector('#mod_account').value;
    data.target = document.querySelector('#mod_tgaccount').value;
    // Addtitional options
    let isRepeat = document.querySelector('#mod_isRepeat').checked ? 1 : 0;
    let isAccent = document.querySelector('#mod_isAccent').checked ? 1 : 0;
    data.accented = isAccent;
    data.isrepeat = isRepeat;
    data.repperiod = document.querySelector('#mod_repeatPeriod').value;
    data.reptimes = document.querySelector('#mod_repeatTimes').value;
    data.repchanger = document.querySelector('#mod_amountChanger').value;
    data.repgoal = document.querySelector('#mod_amounGoal').value;

    if (data.amount == ''){ data.amount = 0; };
    if (data.category == ''){ data.category = 0; };

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == -1){ alert("You are not registered!");
          block.remove();
          return 0;
        };
        console.log(this.responseText);
        let result = JSON.parse(this.responseText);
        let block = result[0];

        let burs = document.querySelectorAll('.budrow');
        for (let i = 0; i < burs.length; i++){
          if (burs[i].getAttribute('date') == data.date){
            let cols = burs[i].querySelectorAll('.droptabledata');
            for (let q = 0; q < cols.length; q++){
              if (cols[q].getAttribute('account') == data.account){
                cols[q].insertAdjacentHTML('beforeEnd', block);
              }
            }
          }
        }
        // block.classList.remove("temper");
        // block.setAttribute('id','item_' + this.responseText);
        setTimeout(() => {
          Dom.reload();
          // reorderItems(block.parentNode.parentNode);
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

    //alert(JSON.stringify(data));

    xhttp.send(JSON.stringify(data));
  }
}


class DOM {
  parent;
  reload(){
    this.menuTrigger = document.querySelectorAll(".itemMenu ");
    this.eventTrigger = document.querySelectorAll(".bud-event-card ");
    this.modalWindow = document.querySelector("#modal_event");

    this.chousenItem = "";

    let modalWindow = this.modalWindow;
    let menuTrigger = this.menuTrigger;
      /// Trigger item Menu button
    for (let i = 0; i < this.menuTrigger.length; i++)
    {
      menuTrigger[i].addEventListener("click", function(){
        //eventBlock = true; 
        parent.chousenItem = this.parentNode.parentNode.parentNode.id;

        let left = menuTrigger[i].getBoundingClientRect().left;
        let top = menuTrigger[i].getBoundingClientRect().top;

        if (document.querySelector('#itemMenu') != null){
          document.querySelector('#itemMenu').remove();
        }
        let block = `<?php echo budgerTemplates::renderEventItemMenu(); ?>`;
        document.body.insertAdjacentHTML('beforeEnd', block);
        block = document.querySelector('#itemMenu');
        block.style.position = "fixed";
        let width = block.getBoundingClientRect().width - menuTrigger[i].getBoundingClientRect().width;
        block.style.left = ( left - width ) + "px";
        block.style.top = top + "px";
        let id = (menuTrigger[i].parentNode.parentNode.parentNode.id).replace(/\D/g, '');
        let parentItem = menuTrigger[i].parentNode.parentNode.parentNode;
        //parentItem.classList.add('menu-opened');
        block.setAttribute('data-target', id);
        let buttons = block.querySelectorAll(".uk-nav")[0].childNodes;
        for (let y = 0; y < buttons.length; y++){

          buttons[y].addEventListener('click', function(elem){
            if (buttons[y].getAttribute('data-event') == 'enlarge'){
              //archieveItem(id);
              console.log('enlarge');
            } else if (buttons[y].getAttribute('data-event') == 'show'){
              // restoreItem(id);
              console.log('show');
            } else if (buttons[y].getAttribute('data-event') == 'edit'){
              Modal.openEventModal();
              console.log('edit');
            } else if (buttons[y].getAttribute('data-event') == 'accent'){
              // removeItem(id);
              console.log('accent');
            } else if (buttons[y].getAttribute('data-event') == 'disable'){
              // removeItem(id);
              console.log('disable');
            } else if (buttons[y].getAttribute('data-event') == 'remove'){
              // removeItem(id);
              
              parent.removeItem(parent.chousenItem);
              console.log('remove');
            }
            document.querySelector('#itemMenu').remove();
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


    for (let i = 0; i < this.eventTrigger.length; i++)
    {
      this.eventTrigger[i].addEventListener("dblclick", function()
      {
        Modal.openEventModal();
        //UIkit.modal(modalWindow).show();
      })
    }

  }
  
  constructor() 
  {
    this.reload(); 
    parent = this;
  }

  removeItem(identer){
    let block = document.querySelector('#' + identer);
    let removeChilds = 0;
    if (block.getAttribute('haschildren') == 1){
      const result = confirm('Remove all child events?');
      if (result == true){
        removeChilds = 1;
      }
    }
    let conter = 0;
    let requestCode = 390;
    let outFormat = "number";

    let data = {};
    data.code = requestCode;
    data.id = identer;
    data.removechilds = removeChilds;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == -1){ alert("You are not registered!");
          block.remove();
          return 0;
        };
        console.log(this.responseText);
        block.remove();

        if (removeChilds){
          let result = JSON.parse(this.responseText);
          // foreach and so on
        }
        setTimeout(() => {
          Dom.reload();
          // reorderItems(block.parentNode.parentNode);
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

    //alert(JSON.stringify(data));

    xhttp.send(JSON.stringify(data));

  }
  

   


 }
 // --------------------------- DOM -------------------


 function allowDrop(ev) {
  ev.preventDefault();
}
let sourceEventId = '';
function drag(ev) {
  ev.dataTransfer.setData("Text", ev.target.id);
  sourceEventId = ev.target.id;
}

function drop(ev) {
  if (ev.shiftKey){
    //var data = ev.dataTransfer.getData("Text");
    var nodeCopy = document.getElementById(sourceEventId).cloneNode(true);
    if (ev.target.classList.contains('droptabledata')){
      ev.target.appendChild(nodeCopy);
      Dom.reload();
    }
  } 
  else {
    if (ev.target.classList.contains('droptabledata')){
    var data = ev.dataTransfer.getData("Text");
    ev.target.appendChild(document.getElementById(data));
    }
  }
  ev.preventDefault();
}
  
class DomManager {
  constructor(){
    
    this.run = this.run();
  }

}
 var Modal = new ModalHandler();
 var Dom = new DOM();
//  var DOME = new DOM();
//  var DMAN =  new DomManager();

 


</script>
@endsection