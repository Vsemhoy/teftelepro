@extends('template.shell')

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
    $cont        = null;
    $accounts    = null;
    $categories  = null;
    $allaccounts = null;
    $currencies  = null;
    if (!empty($user)){
      $cont = new BudgerMain($user->id);
      $accounts    = BudgerData::LoadAccountsByCurrency($user->id, $cont->currentCurrency);
      if (!empty($accounts)){
        $categories  = BudgerData::LoadGroupedCategories($user->id);
        $allaccounts = BudgerData::LoadAccountList($user->id);
        $currencies  = BudgerData::LoadCurrencies_keyId($user->id);

      }
    }
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
      <?php
      if (empty($user)){
        ?>
        <div class="uk-container uk-container-xsmall">
          <div class="uk-alert-danger" uk-alert>
          <a class="uk-alert-close" uk-close></a>
          <p>You are not <a href="{{ route('login') }}">logged in!</a></p>
        </div>
  </div>
  <?php
      } 
      else {
        if (!empty($accounts)){
          echo $cont->renderNavigateButtons('topoftable');
          echo $cont->renderWholeTable(); 
          echo "<br>";
          echo $cont->renderNavigateButtons('botoftable', 'bottom'); 
        }
        else 
        {
          ?>
          <div class="uk-container uk-container-xsmall">
            <div class="uk-card uk-card-secondary uk-card-body">
              <h3 class="uk-card-title">There is no accounts yet!</h3>
              <p>Create <a href="{{ route('budger.accmanager')}}" >account</a> and <a href="{{ route('budger.catmanager')}}" >category</a> at first.</p>
            </div>
          </div>
          <?php
        }
      }
      ?>
</div>
<br>

      <?php 

      // $result = DB::select('select * from ' . env('TB_BUD_ACCOUNTS') . ' where user = :user AND notshow = 0 AND is_removed = 0 ORDER BY ordered ASC', ['user' => $user, ]);
      // print_r($result);
      ?>

  
    
</div>
  

  </div>

<?php 
if ($accounts != null){
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
       $currencies,
       $cont->get_startMonth,
       $cont->get_lastMonth
       );
  
}
 ?>
 <style>
  .date-navigation {
    position: fixed;
    right: 0px;
    bottom: 0px;
  }
  .btn-template-trigger {
    position: fixed;
    right: 0px;
    bottom: 90px;
  }
  .trashbin-area {
    position: fixed;
    right: 0px;
    bottom: 180px;
  }
  .date-navigation .uk-dropdown.uk-open {
    display: block;
    box-shadow: 0px 1px 4px #00000033;
    background: #ffffff75;
    backdrop-filter: blur(15px);
}
.date-navigation .uk-dropdown.uk-open a {
    color: #777;
}
.date-navigation .uk-dropdown.uk-open li:hover > a {
    color: #026bbf
}

.bud-offcanvas {
  display: grid;
  grid-template-rows: 40px auto ;
  padding: 0px;
  max-width: 200px !important;
  box-shadow: -4px -1px 11px 5px rgb(0 0 0 / 11%);
}
@media only screen and (min-width: 900px){
  .bud-offcanvas {
    max-width: 250px !important;
  }
}
@media only screen and (min-width: 1200px){
  .bud-offcanvas {
    max-width: 300px !important;
  }
}
.offc-botcloser {
  bottom: 0px;
    right: 0px;
    top: 0px;
    border: none;
}
.offc-botcloser:hover {
  border: none;
}
.offcanvas-body {
  display: grid;
  grid-template-rows: auto ;
}
 </style>
 <div id='bud_trashbin' ondrop='removeEvent(event)' ondragover='allowDrop(event)'
  class="uk-button uk-button-text trashbin-area" ><span class=" uk-padding-small" uk-icon="trash"></span></div>
 <button class="uk-button uk-button-text btn-template-trigger" 
 type="button" uk-toggle="target: #offcanvas-push"
 ondrop='moveToTemplate(event)' ondragover='allowDrop(event)'
 >
  <span class=" uk-padding-small" uk-icon="album"></span></button>
 <div class="uk-inline date-navigation">
    <button class="uk-button uk-button-text" type="button"><span class=" uk-padding-small" uk-icon="more-vertical"></span></button>
    <div uk-dropdown class='dd-datenav'>
        <ul class="uk-nav uk-dropdown-nav">
            <!-- <li class="uk-active"><a href="#">Active</a></li> -->
            <li class="uk-nav-header">Navigator</li>
            <li><a href='#topoftable'>Go top</a></li>
            <li class="uk-nav-divider"></li>
            
  <?php
  if (!empty($cont)){
    foreach ($cont->navigationByMonth AS $navi)
    {
      echo "<li><a href='#" . $navi->id . "'>" . $navi->name . "</a></li>";
    }

  }
    ?>
  
            <li class="uk-nav-divider"></li>
            <li><a href='#botoftable'>Go Bottom</a></li>
        </ul>
    </div>
</div>


<div id="offcanvas-push" uk-offcanvas=" flip: true; overlay: false; bg-close: false; esc-close: true">
    <div class="uk-offcanvas-bar bud-offcanvas uk-background-default">

        <button class="uk-offcanvas-close" type="button" uk-close></button>
        <h3>Title</h3>
        <div class='offcanvas-body'>
          <div id='templatePool' class="templatepool" ondrop='moveToTemplate(event)' ondragover='allowDrop(event)'>

          </div>
        </div>

        <button class="uk-offcanvas-close nav-rail offc-botcloser"></button>
    </div>
</div>

@endsection

@section('page-scripts')
<script>


let modalTriggers  = document.querySelectorAll(".event_trigger");
let doubleTriggers = document.querySelectorAll(".droptabledata");

// --------------------------- DOM -------------------


class ModalHandler
{
  constructor() 
  {
    let self = this;
    this.eventType = 0;
    
    this.modalWindow = document.querySelector("#modal_event");
    this.btnInc = document.querySelectorAll('.uk-button-incom')[0];
    this.btnExp = document.querySelectorAll('.uk-button-expense')[0];
    this.btnTrs = document.querySelectorAll('.uk-button-transfer')[0];
    this.btnPrc = document.querySelectorAll('.uk-button-percent')[0];
    this.btnDep = document.querySelectorAll('.uk-button-deposit')[0];

    this.modHeader = document.querySelectorAll('.uk-modal-header')[0];

    this.btnManage = document.querySelector('#btn_manageTrigger');
    
    this.btnDisable = document.querySelector("#btnDisableEvent");
    this.btnSave = document.querySelector("#btnSaveEvent");
    this.btnUpdate = document.querySelector("#btnUpdateEvent");
    
    this.rowTgAcc = document.querySelector('#row_targetAcc');
    this.rowCateg = document.querySelector('#row_category');
    
    this.rowOptions = document.querySelector('#mod_options_body');
    this.rowManage = document.querySelector('#mod_manage_body');
    this.rowRepeat = document.querySelector('#mod_isRepeatRow');
    
    this.categorySelector = document.querySelector('#mod_category');
    this.accountSelector = document.querySelector('#mod_account');
    
    this.title = document.querySelector('#mod_title');
    
    this.modalTriggers  = document.querySelectorAll(".event_trigger");
    this.doubleTriggers = document.querySelectorAll(".droptabledata");
    this.run = this.run();
    //this.buttonHandle = this.buttonHandle(this);
    

    this.btnExp.addEventListener('click', function(){
      self.SetExpense(self);
    });
    this.btnInc.addEventListener('click', function(){
      self.SetIncom(self);
    });

    this.btnTrs.addEventListener('click', function(){
      self.SetTranfer(self);
    });
    this.btnPrc.addEventListener('click', function(){
      self.SetPercent(self);
    });
    this.btnDep.addEventListener('click', function(){
      self.SetDeposit(self);
    });
    

    // this.btnOptns.addEventListener('click', function(){
    //   self.SetOptionsShowed(self);
    // });
    

    this.btnManage.addEventListener('click', function(){
      self.SetManageShowed(self);
    });

    this.btnSave.addEventListener('click', function(){
      self.SaveNewEvent(self);
    });
    this.btnUpdate.addEventListener('click', function(){
      self.UpdateEvent(self);
    });
    this.accountSelector.addEventListener('change', function(){
      self.HideTargetAccount();
    });
    
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
    parent = this;
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
    
    Array.from(doubleTriggers).forEach(i => i.addEventListener("dblclick", function(e){
      let elem = this;
      let inblocks = elem.querySelectorAll('.bud-event-card');

      let inwindow = (e || event).clientY; // Throw position depended by window top
      let scrolled = window.scrollY;
      let clickposition = scrolled + inwindow;
      //let id = $(this).attr("id");
      let blockpos = 0;
      let height = 0;
      if (inblocks.length > 0){
        blockpos = inblocks[0].getBoundingClientRect().top + scrolled;
        height = inblocks[inblocks.length - 1].getBoundingClientRect().bottom - inblocks[0].getBoundingClientRect().top;
      };
      console.log(height);
      if (blockpos == 0 || blockpos > clickposition || clickposition > blockpos + height){
        base.openEventModal();
        base.buildClearEventModal(elem, event);
      }
    }));
  }

    openEventModal(){
     UIkit.modal(parent.modalWindow).show();
   }
   closeEventModal(){
     UIkit.modal(parent.modalWindow).hide();
   }
  
    buildClearEventModal(elem, ev){
      document.querySelector('#btnSaveEvent').classList.remove('uk-hidden');
      document.querySelector('#btnUpdateEvent').classList.add('uk-hidden');
      if (ev.ctrlKey){
        this.SetIncom(this);
      } else if  (ev.altKey) {
        this.SetTranfer(this);
      } else {
        this.SetExpense(this);
      }
      this.title.innerHTML = 'Add new event';
      this.btnManage.setAttribute('disabled', 'disabled');
      // this.btnOptns.removeAttribute('disabled');
      this.rowRepeat.classList.remove('uk-hidden');
      let date = elem.parentNode.getAttribute('date');
      let account = elem.getAttribute('account');
      
      document.querySelector('#mod_date').value = date;
      console.log(account);
      document.querySelector('#mod_account').value = account;
     //alert(date);

     document.querySelector('#mod_name').value = "";
        document.querySelector('#mod_description').value = "";
        document.querySelector('#mod_amount').value = '';
      
        //document.querySelector('#mod_category').value = result.category;
        // document.querySelector('#mod_category')[document.querySelector('#mod_category').selectedIndex].text.trim();
        //document.querySelector('#mod_account').value = result.account;
        //data.target = document.querySelector('#mod_tgaccount').value = result.transaccount;
        // Addtitional options
        document.querySelector('#mod_isRepeat').checked = false;
        document.querySelector('#mod_isAccent').checked  = false;
   }

  SetExpense(parent){
    parent.btnInc.classList.remove('active');
    parent.btnExp.classList.add('active');
    parent.btnTrs.classList.remove('active');
    parent.btnDep.classList.remove('active');
    parent.btnPrc.classList.remove('active');
   
    parent.modHeader.classList.add('hd-incom');
    parent.modHeader.classList.remove('hd-expense');
    parent.modHeader.classList.remove('hd-transfer');
    parent.modHeader.classList.remove('hd-deposit');
    parent.modHeader.classList.remove('hd-percent');

    parent.rowTgAcc.classList.add('uk-hidden');
    parent.eventType = 2;

    let index = 0;
    let sel = parent.categorySelector.querySelectorAll('option');
    for (let i = 0; i < sel.length; i++){
      if (sel[i].getAttribute('data-type') == 2){
        sel[i].classList.remove('uk-hidden');
        if (index == 0 && !sel[i].classList.contains('opt-header')){
          parent.categorySelector.selectedIndex = i;
          index = i;
        }
      } else {
        sel[i].classList.add('uk-hidden'); 
      }
    }
  }
  SetIncom(parent){
    parent.btnInc.classList.add('active');
    parent.btnExp.classList.remove('active');
    parent.btnTrs.classList.remove('active');
    parent.btnDep.classList.remove('active');
    parent.btnPrc.classList.remove('active');
 
    parent.modHeader.classList.remove('hd-incom');
    parent.modHeader.classList.add('hd-expense');
    parent.modHeader.classList.remove('hd-transfer');
    parent.modHeader.classList.remove('hd-deposit');
    parent.modHeader.classList.remove('hd-percent');

    parent.rowTgAcc.classList.add('uk-hidden');
    parent.eventType = 1;

    let index = 0;
    let sel = parent.categorySelector.querySelectorAll('option');
    for (let i = 0; i < sel.length; i++){
      if (sel[i].getAttribute('data-type') == 1){
        sel[i].classList.remove('uk-hidden');
        if (index == 0 && !sel[i].classList.contains('opt-header')){
          parent.categorySelector.selectedIndex = i;
          index = i;
        }
      } else {
        sel[i].classList.add('uk-hidden'); 
      }
    }
  }
  SetTranfer(parent){
    parent.btnInc.classList.remove('active');
    parent.btnExp.classList.remove('active');
    parent.btnTrs.classList.add('active');
    parent.btnDep.classList.remove('active');
    parent.btnPrc.classList.remove('active');
    
    parent.modHeader.classList.remove('hd-incom');
    parent.modHeader.classList.remove('hd-expense');
    parent.modHeader.classList.add('hd-transfer');
    parent.modHeader.classList.remove('hd-deposit');
    parent.modHeader.classList.remove('hd-percent');

    parent.rowTgAcc.classList.remove('uk-hidden');
    parent.eventType = 3;

    let index = 0;
    let sel = parent.categorySelector.querySelectorAll('option');
    for (let i = 0; i < sel.length; i++){
      if (sel[i].getAttribute('data-type') == 3){
        sel[i].classList.remove('uk-hidden');
        if (index == 0 && !sel[i].classList.contains('opt-header')){
          parent.categorySelector.selectedIndex = i;
          index = i;
        }
      } else {
        sel[i].classList.add('uk-hidden'); 
      }
    }
    parent.HideTargetAccount();
  }
  SetPercent(parent){
    parent.btnInc.classList.remove('active');
    parent.btnExp.classList.remove('active');
    parent.btnExp.classList.remove('active');
    parent.btnDep.classList.remove('active');
    parent.btnPrc.classList.add('active');
    
    parent.modHeader.classList.remove('hd-incom');
    parent.modHeader.classList.remove('hd-expense');
    parent.modHeader.classList.add('hd-transfer');
    parent.modHeader.classList.remove('hd-deposit');
    parent.modHeader.classList.add('hd-percent');

    parent.rowTgAcc.classList.remove('uk-hidden');
    parent.eventType = 3;

    let index = 0;
    let sel = parent.categorySelector.querySelectorAll('option');
    for (let i = 0; i < sel.length; i++){
      if (sel[i].getAttribute('data-type') == 3){
        sel[i].classList.remove('uk-hidden');
        if (index == 0 && !sel[i].classList.contains('opt-header')){
          parent.categorySelector.selectedIndex = i;
          index = i;
        }
      } else {
        sel[i].classList.add('uk-hidden'); 
      }
    }
  }
  SetDeposit(parent){
    parent.btnInc.classList.remove('active');
    parent.btnExp.classList.remove('active');
    parent.btnTrs.classList.remove('active');
    parent.btnDep.classList.add('active');
    parent.btnPrc.classList.remove('active');
    
    parent.modHeader.classList.remove('hd-incom');
    parent.modHeader.classList.remove('hd-expense');
    parent.modHeader.classList.add('hd-transfer');
    parent.modHeader.classList.add('hd-deposit');
    parent.modHeader.classList.remove('hd-percent');

    parent.rowTgAcc.classList.remove('uk-hidden');
    parent.eventType = 3;

    let index = 0;
    let sel = parent.categorySelector.querySelectorAll('option');
    for (let i = 0; i < sel.length; i++){
      if (sel[i].getAttribute('data-type') == 3){
        sel[i].classList.remove('uk-hidden');
        if (index == 0 && !sel[i].classList.contains('opt-header')){
          parent.categorySelector.selectedIndex = i;
          index = i;
        }
      } else {
        sel[i].classList.add('uk-hidden'); 
      }
    }
  }

  SetManageShowed(parent){
    // if (parent.btnManage.classList.contains('uk-background-default')){
    //   parent.btnManage.classList.remove('uk-background-default');
    //   parent.rowManage.classList.add('uk-hidden');
    //   return;
    // }
    // parent.btnOptns.classList.remove('uk-background-default');
    // parent.btnManage.classList.add('uk-background-default');
    // parent.rowOptions.classList.add('uk-hidden');
    // parent.rowManage.classList.remove('uk-hidden');
  }

  HideTargetAccount(){
    let acc = document.querySelector('#mod_account');
    let tgacc = document.querySelector('#mod_tgaccount');
    let val = acc.value;
    let curr = acc.options[acc.selectedIndex].getAttribute('data-curr');
    console.log(curr);
    let co = 0;
    for(let i = 0; i < tgacc.options.length; i++){
      if (tgacc.options[i].value == val){
        tgacc.options[i].classList.add('uk-hidden');
      } else {
        tgacc.options[i].classList.remove('uk-hidden');
        if (co == 0 && tgacc.options[i].getAttribute('data-curr') == curr){
          tgacc.value = tgacc.options[i].value;
          co++;
        }
      }
    //Add operations here
    }
  }

  SaveNewEvent(self) // Create event item add new item
  {
    let counter = 0;
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
    data.type = self.eventType;
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
        let containers = JSON.parse(this.responseText);
        
        let burs = document.querySelectorAll('.budrow');
        for (let n = 0; n < containers.length; n++)
        {
          let container = containers[n];
          for (let i = 0; i < burs.length; i++){
            if (burs[i].getAttribute('date') == container.date){
              let cols = burs[i].querySelectorAll('.droptabledata');
              for (let q = 0; q < cols.length; q++){
                if (cols[q].getAttribute('account') == container.account){
                  
                  cols[q].insertAdjacentHTML('beforeEnd', container.block);
                }
              }
            }
          }
        }
        
        // block.classList.remove("temper");
        // block.setAttribute('id','item_' + this.responseText);
        setTimeout(() => {
          Modal.closeEventModal();
          Dom.reload();
          MasterCounter.recount();
          MasterCounter.recountTotals(MasterCounter.firstDayInMonth(data.date), data.account);
          // reorderItems(block.parentNode.parentNode);
        }, 100);
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


  UpdateEvent(self)
  {

    let counter = 0;
    let requestCode = 330;
    let outFormat = "json";

    let name = document.querySelector('#mod_name').value;
    if (name.length == 0){
      alert("Name is too short!");
      return;
    }
    let data = {};
    data.id = Dom.chousenItem;
    data.code = requestCode;
    data.name = name;
    data.type = self.eventType;
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
        document.querySelector('#' + data.id).remove();
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

        setTimeout(() => {
          Dom.reload();
          Modal.closeEventModal();
          MasterCounter.recount();
          MasterCounter.recountTotals(MasterCounter.firstDayInMonth(data.date), data.account);
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
              
              let textBlock = document.querySelector('#' + parent.chousenItem).querySelectorAll('.bud-descr')[0];
              if (textBlock.classList.contains('normal-text')){
                textBlock.classList.remove('normal-text');
              }
              else {
                textBlock.classList.add('normal-text')
              }
              console.log('enlarge');
            } else if (buttons[y].getAttribute('data-event') == 'show'){
              // restoreItem(id);
              console.log('show');
            } else if (buttons[y].getAttribute('data-event') == 'edit'){
              Modal.openEventModal();
              parent.fillEditItemWindow(parent.chousenItem);
              console.log('edit');
            } else if (buttons[y].getAttribute('data-event') == 'accent'){
              // removeItem(id);
              parent.accentItem(parent.chousenItem);
              console.log('accent');
            } else if (buttons[y].getAttribute('data-event') == 'disable'){
              // removeItem(id);
              parent.disableItem(parent.chousenItem);
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

        let h = 0;
        block.addEventListener("mouseleave", function(){
          block.classList.add('bud-coox');
          setTimeout(() => {
            if (h == 0){
              if (document.querySelector('#itemMenu') != null){

                document.querySelector('#itemMenu').remove();
              }
            }
          }, 500);
        });
      });
    }


    for (let i = 0; i < this.eventTrigger.length; i++)
    {
      let self = this;
      let identer = this.eventTrigger[i].id;
      this.eventTrigger[i].addEventListener("dblclick", function()
      {
        Modal.openEventModal();
        self.fillEditItemWindow(identer);
        //UIkit.modal(modalWindow).show();
      })
    }

  }
  
  constructor() 
  {
    this.reload(); 
    parent = this;
  }

  fillEditItemWindow(identer)
  {
    document.querySelector('#btnSaveEvent').classList.add('uk-hidden');
    document.querySelector('#btnUpdateEvent').classList.remove('uk-hidden');
    Modal.rowRepeat.classList.add('uk-hidden');
    Modal.rowOptions.classList.add('uk-hidden');

    let block = document.querySelector('#' + identer);
    Dom.chousenItem = identer;
    let counter = 0;
    let requestCode = 350;
    let outFormat = "json";

    let data = {};
    data.code = requestCode;
    data.id = identer;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == -1){ alert("You are not registered!");
          block.remove();
          return 0;
        };
        console.log(this.responseText);
        let result = JSON.parse(this.responseText);
        
        let disabled = result.disabled;
        if (disabled == 0){
          document.querySelector('#mod_title').innerHTML = "Edit event ";

        } else {
          document.querySelector('#mod_title').innerHTML = "Edit event (disabled)";
        }
        let type = result.type;
        if (type == 1){
          Modal.SetIncom(Modal);
        }
        if (type == 2){
          Modal.SetExpense(Modal);
        }
        if (type == 3){
          Modal.SetTransfer(Modal);
        }

        Modal.SetManageShowed(Modal);
        // Modal.btnOptns.setAttribute('disabled', 'disabled');
        Modal.btnManage.removeAttribute('disabled');
        if (result.haschildren == 0){
          Modal.SetManageShowed(Modal);

        }

        document.querySelector('#mod_name').value = result.name;
        document.querySelector('#mod_description').value = result.description;
        document.querySelector('#mod_amount').value = result.value;
        let date = result.date_in;
        //console.log(date);
        //date =   dateFormat(date, 'YYYY-MM-DD');
        document.querySelector('#mod_date').value = date;
        document.querySelector('#mod_category').value = result.category;
        // document.querySelector('#mod_category')[document.querySelector('#mod_category').selectedIndex].text.trim();
        document.querySelector('#mod_account').value = result.account;
        data.target = document.querySelector('#mod_tgaccount').value = result.transaccount;
        // Addtitional options
        let isRepeat = document.querySelector('#mod_isRepeat').checked = result.haschildren == 1 ? true : false;
        let isAccent = document.querySelector('#mod_isAccent').checked  = result.accented == 1 ? true : false;

        let parentId = result.parent;

        setTimeout(() => {
          //Dom.reload();
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
    xhttp.send(JSON.stringify(data));

  }


  removeItem(identer){
    let block = document.querySelector('#' + identer);
    let date = block.parentNode.parentNode.getAttribute('date');
    let account = block.parentNode.getAttribute('account');
    let removeChilds = 0;
    if (block.getAttribute('haschildren') == 1){
      const result = confirm('Remove all child events?');
      if (result == true){
        removeChilds = 1;
      }
    }
    let type = block.getAttribute('type');
    let trans = 0;
    if (type == 4 || type == 3){
      trans = block.getAttribute('trans_id');
    }

    let counter = 0;
    let requestCode = 390;
    let outFormat = "json";

    let data = {};
    data.code = requestCode;
    data.id = identer;
    data.removechilds = removeChilds;
    data.type = type;
    data.trans = trans;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == -1){ alert("You are not registered!");
          block.remove();
          return 0;
        };
          if (block.getAttribute("type") == 3 || block.getAttribute("type") == 4){
            let trans = block.getAttribute("trans_id");
            let remToo = document.querySelector('#bud_item_' + trans);
            if (remToo != undefined){
              remToo.remove();
                }
              };
        console.log(this.responseText);
        block.remove();

        let result = JSON.parse(this.responseText);
        if (removeChilds == 1){
          for (let i = 0; i < result.length; i++)
          {
            let remblock = document.querySelector('#bud_item_' + result[i]);
            if (remblock != undefined){
              if (remblock.getAttribute("type") == 3 || remblock.getAttribute("type") == 4){
                let trans = remblock.getAttribute("trans_id");
                let remToo = document.querySelector('#bud_item_' + trans);
                if (remToo != undefined){
                  remToo.remove();
                }
              }
              remblock.remove();
            }
          }
        }
        //  OR UNLINK EVENTS
        else
        {
          for (let i = 0; i < result.length; i++)
          {
            let upblock = document.querySelector('#bud_item_' + result[i]);
            if (upblock != undefined){
              let icon = upblock.querySelectorAll('.bud-linked-icon')[0];
              if (icon != undefined){
                icon.remove();
              }
            }
          }
        }
        Dom.reload();
        setTimeout(() => {
          MasterCounter.recount();
          MasterCounter.recountTotals(MasterCounter.firstDayInMonth(date), account);
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
    xhttp.send(JSON.stringify(data));
  }
  

  disableItem(identer){
    let block = document.querySelector('#' + identer);
    let date = block.parentNode.parentNode.getAttribute('date');
    let account = block.parentNode.getAttribute('account');
    let disablestate = 1;
    if (block.classList.contains('bud-disabled')){
       disablestate = 0;
       block.classList.remove('bud-disabled');
      } else {
        block.classList.add('bud-disabled');
      }
      let type = block.getAttribute('type');
    let trans = 0;
    if (type == 4 || type == 3){
      trans = block.getAttribute('trans_id');
    }
    let disableChilds = 0;
    if (block.getAttribute('haschildren') == 1){
      let phrase = 'Disable all child events?';
      if (disablestate == 0){
        phrase = 'Enable all child events?';
      }
      const result = confirm(phrase);
      if (result == true){
        disableChilds = 1;
      }
    }
    let counter = 0;
    let requestCode = 380;
    let outFormat = "json";

    let data = {};
    data.code = requestCode;
    data.id = identer;
    data.state = disablestate;
    data.disablechilds = disableChilds;
    data.type = type;
    data.trans = trans;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == -1){ alert("You are not registered!");
          return 0;
        };
        if (block.getAttribute("type") == 3 || block.getAttribute("type") == 4){
          let meToo = document.querySelector('#bud_item_' + trans);
          if (meToo != undefined){
              //alert(meToo);
              if (disablestate == 0)
              {
                meToo.classList.remove('bud-disabled');
              }
              else 
              {
                meToo.classList.add('bud-disabled');
              }
            }
          };
        console.log(this.responseText);
        if (disableChilds){
          let result = JSON.parse(this.responseText);
          for (let i = 0; i < result.length; i++)
          {
            let upblock = document.querySelector('#bud_item_' + result[i]);
            if (upblock != undefined){
              if (disablestate == 0)
              {
                upblock.classList.remove('bud-disabled');
              }
              else 
              {
                upblock.classList.add('bud-disabled');
              }
              
            }
          }
        }
        Dom.reload();
        setTimeout(() => {
          MasterCounter.recount();
          MasterCounter.recountTotals(MasterCounter.firstDayInMonth(date), account);
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
    xhttp.send(JSON.stringify(data));
  }

  accentItem(identer){
    let block = document.querySelector('#' + identer);
    let accentstate = 1;
    if (block.classList.contains('bud-accented')){
      accentstate = 0;
       block.classList.remove('bud-accented');
      } else {
        block.classList.add('bud-accented');
      }
    let accentChilds = 0;
    if (block.getAttribute('haschildren') == 1){
      let phrase = 'Accent all child events?';
      if (accentstate == 0){
        phrase = 'Remove accent of all child events?';
      }
      const result = confirm(phrase);
      if (result == true){
        accentChilds = 1;
      }
    }
    let type = block.getAttribute('type');
    let trans = 0;
    if (type == 4 || type == 3){
      trans = block.getAttribute('trans_id');
    }

    let counter = 0;
    let requestCode = 370;
    let outFormat = "number";

    let data = {};
    data.code = requestCode;
    data.id = identer;
    data.state = accentstate;
    data.accentchilds = accentChilds;
    data.type = type;
    data.trans = trans;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == -1){ alert("You are not registered!");
          block.remove();
          return 0;
        };
        if (block.getAttribute("type") == 3 || block.getAttribute("type") == 4){
          let meToo = document.querySelector('#bud_item_' + trans);
          if (meToo != undefined){
              if (accentstate == 0)
              {
                meToo.classList.remove('bud-accented');
              }
              else 
              {
                meToo.classList.add('bud-accented');
              }
            }
          };
        console.log(this.responseText);
        if (accentChilds){
          let result = JSON.parse(this.responseText);
          for (let i = 0; i < result.length; i++)
          {
            let upblock = document.querySelector('#bud_item_' + result[i]);
            if (upblock != undefined){
              if (accentstate == 0)
              {
                upblock.classList.remove('bud-accented');
              }
              else 
              {
                upblock.classList.add('bud-accented');
              }
            }
          }
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
    xhttp.send(JSON.stringify(data));
  }

  moveEventItem(id, date, account)
  {
    let counter = 0;
    let requestCode = 331;
    let outFormat = "json";

    let data = {};
    data.code = requestCode;
    data.id = id;
    data.date = date;
    data.account = account;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == -1){ alert("You are not registered!");
          block.remove();
          return 0;
        };
        console.log(this.responseText);

        setTimeout(() => {
          Dom.reload();
          // reorderItems(block.parentNode.parentNode);
        }, 30);
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
    xhttp.send(JSON.stringify(data));
  }

  cloneEventItem(id, date, account, target) 
  {
    let counter = 0;
    let requestCode = 332;
    let outFormat = "number";

    let data = {};
    data.code = requestCode;
    data.id = id;
    data.date = date;
    data.account = account;
    console.log(id + " "  + date + " " + account);

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == -1){ alert("You are not registered!");
          
          return 0;
        };
        //console.log(JSON.parse(this.responseText));
        let dat = JSON.parse(this.responseText);
        if (dat.length > 0){

          target.insertAdjacentHTML('beforeEnd', dat[0]);
        } else {
          console.log(dat);
        }

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
  let account = ev.target.getAttribute('account');
  let date = ev.target.getAttribute('date');
  
  let sourceType = document.getElementById(sourceEventId).getAttribute('type');


  if (ev.shiftKey){
    // CLONE EVENT
    //var data = ev.dataTransfer.getData("Text");
    var nodeCopy = document.getElementById(sourceEventId).cloneNode(true);
    console.log(sourceEventId);
    if (ev.target.classList.contains('droptabledata')){
      Dom.cloneEventItem(sourceEventId, date, account, ev.target);
      // if (data.length > 0){
      //   ev.target.appendChild(data[0]);
      // } else {
        
      //   ev.target.appendChild(nodeCopy);
      // }
      Dom.reload();
      MasterCounter.recount();
      MasterCounter.recountTotals(MasterCounter.firstDayInMonth(date), account);
    }
  } 
  else { 
    // MOVE EVENT
    if (ev.target.classList.contains('droptabledata')){
      var data = ev.dataTransfer.getData("Text");
      let sourceDate = document.getElementById(sourceEventId).parentNode.getAttribute('date');
    let sourceAccount = document.getElementById(sourceEventId).parentNode.getAttribute('account');
    Dom.moveEventItem(sourceEventId, date, account);
    ev.target.appendChild(document.getElementById(data));
    MasterCounter.recount();
      // we should recount only if:
        // 1 - account changed
        // 2 - Month changed
        if (document.getElementById(sourceEventId).parentNode.classList.contains('droptabledata')){
          // ONLY for main table events
          //alert(sourceDate + " to " + date);
          let s_date = MasterCounter.firstDayInMonth(sourceDate);
          let g_date = MasterCounter.firstDayInMonth(date);
          let minDate = s_date;
          let s_o = new Date(s_date);
          let g_o = new Date(g_date);
          if (s_o.getTime() > g_o.getTime()){
            minDate = g_date;
          }
          if (sourceAccount != account){
            // Call function for 2 accounts
            MasterCounter.recountTotals(minDate, account);
            MasterCounter.recountTotals(minDate, sourceAccount);
          } else {
            // only for one
            if (s_date != g_date){
              MasterCounter.recountTotals(minDate, account);
            }
          }
          
        }
        //recountTotals(month, account);
      }
    }
  ev.preventDefault();
}


function moveToTemplate(ev){

      //alert(ev.target.id);

    var nodeCopy = document.getElementById(sourceEventId).cloneNode(true);
    console.log(sourceEventId);
    // let pool = document.querySelector('#templatePool').insertAdjacentHTML('afterBegin', nodeCopy);
     let pool = document.querySelector('#templatePool');
     pool.appendChild(nodeCopy);
      //Dom.cloneEventItem(sourceEventId, date, account, ev.target);
    
}

function removeEvent(ev){

        Dom.removeItem(sourceEventId);
        ev.preventDefault();
}
  
class DomManager {
  constructor(){
    
    this.run = this.run();
  }

}

class Counter
{
  recount()
  {
    let toFixer = 0;
    this.droptabledata = document.querySelectorAll('.droptabledata');

    // recount CELL
    for (let i = 0; i < this.droptabledata.length; i++)
    {
      let total = 0;
      let dec = this.droptabledata[i].getAttribute('dec');
      toFixer = toFixer < dec ? dec : toFixer;
      if (this.droptabledata[i].querySelectorAll('.bud-event-card').length > 0)
      {
        for (let q = 0; q < this.droptabledata[i].querySelectorAll('.bud-event-card').length; q++) {
          if (!this.droptabledata[i].querySelectorAll('.bud-event-card')[q].classList.contains('bud-disabled')){
            let value = this.droptabledata[i].querySelectorAll('.bud-event-card')[q].querySelectorAll('.bud-value')[0].innerHTML;
            value = +(value.trim());
            total += value;
          }
        }
      }
      if (total != 0){
        this.droptabledata[i].querySelectorAll('.daytotal')[0].innerHTML = total.toFixed(dec);
      }
      else 
      {
        this.droptabledata[i].querySelectorAll('.daytotal')[0].innerHTML = "";
      }
    }

    // RECOUNT ROWS
    // 1 - get starting balance and create value array
    let resarray = [];
    let percarray = [];
    let lastBalanceArr = [];
    let subobjects = [];
    let subtotalrows = document.querySelectorAll('.subtotal');
    for (let i = 0; i < subtotalrows.length ; i++) {
      let index = subtotalrows.length - i - 1;
      let subbalances = subtotalrows[index].querySelectorAll('.subtotalbal');
      for (let q = 0; q < subbalances.length; q++) {
        let value = +((subbalances[q].innerHTML).trim());
        resarray.push(value);
        percarray.push(0);
        lastBalanceArr.push(value);
        let obj = {
          "incom" : 0,
          "depos" : 0,
          "expens" : 0,
          "transfer" : 0,
          "prev_incom" : 0,
          "prev_depos" : 0,
          "prev_expens" : 0,
          "prev_transfer" : 0
        }
        subobjects.push(obj);
      }
      break;
    }
    let table = document.querySelector('#budgettable');
    let rows = table.querySelectorAll('tr');

    for (let i = 0; i < rows.length; i++) {
      let index = rows.length - 1 - i;
      if (rows[index].classList.contains('budrow')){
        for (let t = 0; t < resarray.length; t++) {
          let value = rows[index].querySelectorAll('.daytotal')[t].innerHTML;
          value = value == "" ? 0 : +(value.trim());
          resarray[t] += value;
          if (rows[index].querySelectorAll('.daytotals')[t].getAttribute('actype') == 2 && resarray[t] < 0)
          {
            let percentValue = rows[index].querySelectorAll('.daytotals')[t].getAttribute('data-percent');
            if (percentValue > 0){
              // COUNT PERCENTS
              let days  = this.daysInMonth(rows[index].getAttribute('date'));
              let addon = resarray[t] * (percentValue / 100) / 12 / days;
              percarray[t] = percarray[t] + addon;
              resarray[t] = resarray[t] + addon;
              //console.log(addon);
            }
          }
          let dec = rows[index].querySelectorAll('.daytotals')[t].getAttribute('dec');
          toFixer = toFixer < dec ? dec : toFixer;
          rows[index].querySelectorAll('.daytotals')[t].innerHTML = resarray[t].toFixed(dec);


        }
      }
      if (rows[index].classList.contains('subtotal')){
        let sums = 0;
        for (let t = 0; t < resarray.length; t++) {
          let dec = rows[index].querySelectorAll('.subtotalbal')[t].getAttribute('dec');
          rows[index].querySelectorAll('.subtotalbal')[t].innerHTML = resarray[t].toFixed(dec);

          // if (lastBalanceArr[t] != 0){
            let valDiff  = (resarray[t] - lastBalanceArr[t]).toFixed(0);
            // if (valDiff != 0){
              //console.log(valDiff);
              rows[index].querySelectorAll('.subbal-diff')[t].innerHTML = valDiff > 0 ? ("+" + valDiff) : valDiff;
            // }
          // }
          // percent set
          if (percarray[t] != 0){
            rows[index].querySelectorAll('.subbal-perc')[t].innerHTML = percarray[t] != 0 ? percarray[t].toFixed(dec) : "";
            console.log(percarray[t]);
            percarray[t] = 0;
          }
          lastBalanceArr[t] = resarray[t];

          sums += resarray[t];
        }
        if (resarray.length > 1){
          rows[index].querySelectorAll('.totalofrow_s')[0].innerHTML = sums.toFixed(toFixer);
        }
      }
      if (rows[index].querySelectorAll('.totalofrow').length > 0){
        let sum = 0;
        for (let t = 0; t < resarray.length; t++) {
          sum += resarray[t];
        }
        rows[index].querySelectorAll('.totalofrow')[0].innerHTML = sum.toFixed(toFixer);
      }
    }

    for (let i = 0; i < rows.length; i++) {
      let index = rows.length - 1 - i;
      for (let h = 0; h < rows[index].querySelectorAll('.droptabledata').length; h++)
      {
        let total = 0;
        if (rows[index].querySelectorAll('.droptabledata')[h].querySelectorAll('.bud-event-card').length > 0)
        {
          for (let q = 0; q < rows[index].querySelectorAll('.droptabledata')[h].querySelectorAll('.bud-event-card').length; q++) {
            let value = rows[index].querySelectorAll('.droptabledata')[h].querySelectorAll('.bud-event-card')[q].querySelectorAll('.bud-value')[0].innerHTML;
            let type = rows[index].querySelectorAll('.droptabledata')[h].querySelectorAll('.bud-event-card')[q].getAttribute('type');
            value = +(value.trim());
            if (type == 1){
              subobjects[h].incom += value;
            }
            if (type == 4){
              subobjects[h].depos += value;
            }
            if (type == 2){
              subobjects[h].expens += value;
            }
            if (type == 3){
              subobjects[h].transfer += value;
            }
          }
        }
      }

      for (let i = 0; i < rows[index].querySelectorAll('.mtotalio').length; i++) {
        let celler = rows[index].querySelectorAll('.mtotalio')[i];
        if (celler.querySelectorAll('.incomes').length > 0){

          let sign = "+";
          let previc = "";
          let value = 0;

          value = subobjects[i].incom - subobjects[i].prev_incom;
          if (value > 0){sign = "+";} else {sign = "";};
          previc = "(" + sign + (value) + ")";
          let t = previc;
          celler.querySelectorAll('.incomes')[0].innerHTML      = subobjects[i].incom;
          celler.querySelectorAll('.incomes')[0].parentNode.setAttribute('title', t);
          
          value = subobjects[i].depos - subobjects[i].prev_depos;
          if (value > 0){sign = "+";} else {sign = "";};
          previc = "(" + sign + value + ")";
          celler.querySelectorAll('.deposits')[0].innerHTML    = subobjects[i].depos;
          let b = previc + " incomes + deposits = " + (subobjects[i].incom + subobjects[i].depos);
          celler.querySelectorAll('.deposits')[0].parentNode.setAttribute('title', b);
          
          value = subobjects[i].expens - subobjects[i].prev_expens;
          if (value > 0){sign = "+";} else {sign = "";};
          previc = "(" + sign + value + ")";
          celler.querySelectorAll('.expenses')[0].innerHTML    = subobjects[i].expens;
          celler.querySelectorAll('.expenses')[0].parentNode.setAttribute('title', previc);

          value = subobjects[i].transfer - subobjects[i].prev_transfer;
          if (value > 0){sign = "+";} else {sign = "";};
          previc = "(" + sign + value + ")";
          celler.querySelectorAll('.transfers')[0].innerHTML   = subobjects[i].transfer;
          let e = previc + " expenses + transfers = " + (subobjects[i].expens + subobjects[i].transfer);
          celler.querySelectorAll('.transfers')[0].parentNode.setAttribute('title', e);

          celler.querySelectorAll('.difference')[0].innerHTML  = subobjects[i].incom + subobjects[i].expens;
          let s = "all transactions = " + (subobjects[i].incom + subobjects[i].depos + subobjects[i].expens + subobjects[i].transfer);
          celler.querySelectorAll('.difference')[0].parentNode.setAttribute('title', s);


          subobjects[i].prev_incom    = subobjects[i].incom;
          subobjects[i].prev_depos    = subobjects[i].depos;
          subobjects[i].prev_expens   = subobjects[i].expens;
          subobjects[i].prev_transfer = subobjects[i].transfer;
          subobjects[i].incom = 0;
          subobjects[i].depos = 0;
          subobjects[i].expens = 0;
          subobjects[i].transfer = 0;
        }
      }
    }


  }

  constructor()
  {
    this.recount();
  }

  daysInMonth (date) {
    let arr = date.split('-');
    return new Date(arr[0], arr[1], 0).getDate();
  }

  firstDayInMonth(dater){
    let parts = dater.split('-');
    return parts[0] +  "-" + parts[1] + "-01";
    //var dt = new Date(parts[1], parts[1] - 1);
    // return new Date(date.getFullYear(), date.getMonth(), 1);
    //return dt.getFullYear() + "-" + (dt.getMonth() + 1) + "-01"; // dt.getDate();
  }

  lastDayInMonth(dater){
    var date = new Date(dater);
    return new Date(date.getFullYear(), date.getMonth() + 1, 0);
  }

  recountTotals(startDate, account){
    let counter = 0;
    let requestCode = 901;
    let outFormat = "number";

    let objectArray = [];
    let table = document.querySelector('#budgettable');
    let rows = table.querySelectorAll('tr');

    for (let i = 0; i < rows.length; i++) {
      if (rows[i].classList.contains('subtotal'))
      {
        if (rows[i].getAttribute('startDate') != null){
          let trasholdDate = new Date(startDate);
          let currDate = new Date(rows[i].getAttribute('startDate'));
          if (trasholdDate.getTime() <= currDate.getTime()){

            console.log(rows[i].getAttribute('startDate') + " account: " + account);
            let totalCells = rows[i].querySelectorAll('.mtotals');
            let preCells = rows[i].querySelectorAll('.mtotalio');
            for (let n = 0; n < totalCells.length; n++){
              if (totalCells[n].getAttribute('acc') == account){
                let amount = totalCells[n].querySelectorAll('.subtotalbal')[0].innerHTML.trim();
                let diff = totalCells[n].querySelectorAll('.subbal-diff')[0].innerHTML.trim();
                let perc = totalCells[n].querySelectorAll('.subbal-perc')[0].innerHTML.trim();
                let incomes = preCells[n].querySelectorAll('.incomes')[0].innerHTML.trim();
                let deposits = preCells[n].querySelectorAll('.deposits')[0].innerHTML.trim();
                let expenses = preCells[n].querySelectorAll('.expenses')[0].innerHTML.trim();
                let transfers = preCells[n].querySelectorAll('.transfers')[0].innerHTML.trim();
                let difference = preCells[n].querySelectorAll('.difference')[0].innerHTML.trim();
                let obj = {
                  'value'      : amount, 
                  'monthdiff'  : diff,
                  'percent'    : perc,
                  'incomes'    : incomes,
                  'deposits'   : deposits,
                  'expenses'   : expenses,
                  'transfers'  : transfers,
                  'difference' : difference,
                  'date'       : rows[i].getAttribute('startDate')
                }
                objectArray.push(obj);
              }
            }
          }
        }
      }
    }
    let data = {};
    data.account = account;
    data.code = requestCode;
    data.objects = objectArray;
    data.date = startDate;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == -1){ alert("You are not registered!");

          return 0;
        };
        console.log(this.responseText);
        // let result = JSON.parse(this.responseText);
        console.log('subtotals updated ' + this.responseText);
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






 class Decorator
 {
    reload(){
      this.tabledata = document.querySelectorAll('td');
      this.tabledatahead = document.querySelectorAll('th');
      this.subtotalrows = document.querySelectorAll('.subtotal');
      for (let i = 0; i < this.tabledata.length; i++)
      {
        if (this.tabledata[i].getAttribute('actype') == 2)
        {
          this.tabledata[i].classList.add('credits');
        }
        if (this.tabledata[i].getAttribute('actype') == 3)
        {
          this.tabledata[i].classList.add('savings');
        }
      }
      for (let i = 0; i < this.tabledatahead.length; i++)
      {
        if (this.tabledatahead[i].getAttribute('actype') == 2)
        {
          this.tabledatahead[i].classList.add('credits');
        }
        if (this.tabledatahead[i].getAttribute('actype') == 3)
        {
          this.tabledatahead[i].classList.add('savings');
        }
      }

      for (let i = 0 ; i < this.subtotalrows.length; i++){
        this.subtotalrows[i].classList.add('totalhider');
        let self  = this.subtotalrows[i];
        this.subtotalrows[i].addEventListener('dblclick', function(e){
          if (self.classList.contains('totalhider')){
            self.classList.remove('totalhider');
          }
          else 
          {
            self.classList.add('totalhider');
          }
        });
      }

    }
    constructor()
    {
      let autoCategoryArray = [ <?php
      if (isset($user->id)){
        $helpers = BudgerData::getCategorySelectHelpers($user->id);
        if ($helpers != null){
          foreach ($helpers AS $data){
            echo "{ 'word': '" . $data->word . "', 'value': " . $data->value . ", 'freq': " . $data->freq . "},";
          };

        }
      }
    ?>];
      this.reload();
      this.handleScrollTableTop();

      let rowOptions = document.querySelector('#mod_options_body');
      let rowManage = document.querySelector('#mod_manage_body');
      rowOptions.classList.add('uk-hidden');
      rowManage.classList.add('uk-hidden');
      var checkbox = document.querySelector("#mod_isRepeat");

      checkbox.addEventListener('change', function() {
        if (this.checked) {
          rowOptions.classList.remove('uk-hidden');
        } else {
          rowOptions.classList.add('uk-hidden');
        }
      });

      document.querySelector('#mod_repeatPeriod').addEventListener('change', function(){
        document.querySelector('#mod_isRepeat').checked = true;
      });
      document.querySelector('#mod_amountChanger').addEventListener('change', function(){
        document.querySelector('#mod_isRepeat').checked = true;
      });
      document.querySelector('#mod_repeatTimes').addEventListener('change', function(){
        document.querySelector('#mod_isRepeat').checked = true;
      });
      document.querySelector('#mod_amounGoal').addEventListener('change', function(){
        document.querySelector('#mod_isRepeat').checked = true;
      });


      let saver = document.querySelector('#btnSaveEvent');
      let mdn = document.querySelector('#mod_name');
      mdn.addEventListener('keyup', function(){
        if (mdn.value.length > 2){
          // console.log(mdn.value);
          let result = autoCategoryArray.find(el => (el.word.toLowerCase()).includes(mdn.value.toLowerCase()));
          if (result != undefined){
            
            document.querySelector('#mod_category').value = result.value;
            // console.log(result);
          }
        }
      });
      saver.addEventListener('click', function(){
        mdn = document.querySelector('#mod_name');
        let arr = mdn.value.split(' ');
        let string = arr[0];
        if (arr.length > 1){
          string += " " + arr[1];
        }
        if (arr.length > 2){
          string += " " + arr[2];
        } 
        string = string.toLowerCase();
        let value = document.querySelector('#mod_category').value;

        let result = autoCategoryArray.find(el => (el.word.toLowerCase()).includes(string));
          if (result == undefined){
            let lock = {};
            lock.word = string.toLowerCase();
            lock.value = +value;
            lock.freq = 1;
            autoCategoryArray.push(lock);
            //console.log(lock);
            console.log("RESULT IS UNDEF " + autoCategoryArray);
          }
          else {
            console.log("RESULT IS DEFF " + autoCategoryArray);
            let maxFreq = 0;
            let minFreq = 999999999;
            for (let i = 0 ; i < autoCategoryArray.length; i++){
              if (autoCategoryArray[i].word == result.word &&
              autoCategoryArray[i].value == result.value 
              // autoCategoryArray[i].freq == result.freq
              ){
                autoCategoryArray[i].freq += 1;
                if (maxFreq < autoCategoryArray[i].freq){
                  maxFreq = autoCategoryArray[i].freq;
                }
                if (minFreq > autoCategoryArray[i].freq){
                  minFreq = autoCategoryArray[i].freq;
                }
              }
            }
            let newArray = [];
            while (autoCategoryArray.length > 100){
              for (let i = 0 ; i < autoCategoryArray.length; i++){
                if (autoCategoryArray[i].freq == minFreq){
                  autoCategoryArray[i].splice(i, 1);
                }
              }
              minFreq += 1;
            }
            if (maxFreq > 1000){
              for (let i = 0 ; i < autoCategoryArray.length; i++){
                autoCategoryArray[i].freq == autoCategoryArray[i].freq / 2;
              }
            }
          }

          let counter = 0;
          let requestCode = 333;
          let outFormat = "number";
          let data = {};
          data.code = requestCode;
          data.objects = autoCategoryArray;

          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              if (this.responseText == -1){ alert("You are not registered!");

                return 0;
              };
              console.log(this.responseText);
              // let result = JSON.parse(this.responseText);
              console.log('рудзукы updated ' + this.responseText);
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

          //alert(JSON.stringify(data));
          xhttp.send(JSON.stringify(autoCategoryArray));
      });
    }

    handleScrollTableTop(){
      /* HIDE Nav when scroll down
      */
      var lastScrollTop = 0;
      var conditor = 0;
      var position = 0;
      let position_left = 0;
      let self = window;
      let scrolled = 0;
      
      window.addEventListener('scroll', function(event){
        let tableToTop = document.querySelectorAll(".budgetable")[0].offsetTop;
        let tableWidth = document.querySelectorAll(".budgetable")[0].getBoundingClientRect().width;
        
        scrolled = window.scrollY;
        // console.log("table top " + tableToTop);
        // console.log("scrolled from top " + scrolled);
          if (scrolled > lastScrollTop){
            position_left = document.querySelectorAll(".budgetable")[0].getBoundingClientRect().left;
            if (position_left > -1){
              position_left = document.querySelectorAll(".budgetable")[0].getBoundingClientRect().left;
            };
            //$("#stickytablehead").css("left", position + "px");
            // document.querySelector("#stickytablehead").style.left = position + "px";
          };
          if (document.querySelector("#stickytablehead") != undefined){
            
            document.querySelector("#stickytablehead").style.left = position_left + "px";
            document.querySelector("#stickytablehead").style.width = tableWidth + "px";
            let month = document.querySelectorAll('.tf-table-monthname');
            //console.log(month[0].getBoundingClientRect().top + window.scrollY);
            for (let i = 0 ; i < month.length ; i++){
              let montnamepos = month[i].getBoundingClientRect().top + window.scrollY;
              let montnamneme = month[i].innerHTML;
              //console.log("position of name " + montnamepos);
              if (scrolled > montnamepos){
                montnamneme = montnamneme.slice(0, 3);
                //$("#stickytablehead").find("th").eq(0).text(montnamneme);
                document.querySelector('#stickytablehead').querySelectorAll('th')[0].innerHTML = montnamneme;
              }
            }
            

          };
          if (scrolled > tableToTop + 1){
            //console.log("last scroll top  " + lastScrollTop);
            if  (scrolled > lastScrollTop){
              if (conditor == 0){
                let counter = 0;
                let header = document.querySelectorAll(".budgetable")[0].querySelectorAll("thead")[0].innerHTML;
                //$(".tftable").children("thead").html();
                let newCon = "<div id='stickytablehead'><table class='uk-table uk-table-divider uk-table-hover uk-table-small'><thead>" + header + "</thead></table></div>";
                if (scrolled > tableToTop + 1){
                  document.querySelector("#main-tf-1").insertAdjacentHTML('afterBegin', newCon);
                };
                let tabrowhead = document.querySelectorAll(".budgetable")[0].querySelectorAll("th");
                
                for (let i = 0; i < tabrowhead.length ; i++){
                  let width = tabrowhead[i].getBoundingClientRect().width - (25);
                  let padding = tabrowhead[i].style.getPropertyValue('padding');
                  let back = tabrowhead[i].style.getPropertyValue('background');
                  // console.log(width);
                  //width = parseInt(width) - 0.5;
                  document.querySelector("#stickytablehead").querySelectorAll("th")[i].style.width = width + "px";
                  //document.querySelector("#stickytablehead").querySelectorAll("th")[i].style.padding = padding ;
                  document.querySelector("#stickytablehead").querySelectorAll("th")[i].style.zIndex = 99;
                  document.querySelector("#stickytablehead").querySelectorAll("th")[i].style.background = back;
                }


              conditor = 1;
              };
            } else {
            // upscroll code
            if (conditor == 1){
              //$("nav").removeClass("d-none");
              document.querySelector("#stickytablehead").remove();
              // $("#stickytablehead").remove();
              // $("#sidebarMenu").removeClass("top-zero");
              // $("#fixedpool").removeClass("top-zero");
              conditor = 0;
              // console.log("OFF");
            };
          }
        }
          

          lastScrollTop = scrolled;
          position = document.querySelectorAll(".uk-table")[0].getBoundingClientRect().left; // position
          if (position > -1){
            position = document.querySelectorAll(".uk-table")[0].getBoundingClientRect().left; // offset
          };
          //console.log(position);
          // document.querySelector("#stickytablehead").style.left = position + "px";
      });
    }
 }

 
 class FilterModal 
 {
   constructor(){
     let unitFilter = document.querySelector("#unit_filter");
     let accounts = document.querySelector("#accounts_filter");
    <?php if (isset( $cont->currentCurrency)){
      ?>
        unitFilter.value = '<?php echo $cont->currentCurrency; ?>';
      <?php
    };
    ?>

    let unitid = unitFilter.value;

    for(let i = 0; i < accounts.options.length; i++){
      if (accounts.options[i].getAttribute('data-unit') == unitid){
        accounts.options[i].classList.remove('uk-hidden');
      } else {
        accounts.options[i].classList.add('uk-hidden');
      }
    //Add operations here
    }

    unitFilter.addEventListener('change', function(){
      unitid = unitFilter.value;
      for(let i = 0; i < accounts.options.length; i++){
      if (accounts.options[i].getAttribute('data-unit') == unitid){
        accounts.options[i].classList.remove('uk-hidden');
      } else {
        accounts.options[i].classList.add('uk-hidden');
      }
    //Add operations here
    }
    });

   }
 }

 var Modal = new ModalHandler();
 var Dom = new DOM();
//  var DOME = new DOM();
//  var DMAN =  new DomManager();
 var Decor = new Decorator();
 var MasterCounter = new Counter();
 
 var Filter = new FilterModal();




 //a simple date formatting function
function dateFormat(inputDate, format) {
    //parse the input date
    const date = new Date(inputDate);

    //extract the parts of the date
    const day = date.getDate();
    const month = date.getMonth() + 1;
    const year = date.getFullYear();    

    //replace the month
    format = format.replace("MM", month.toString().padStart(2,"0"));        

    //replace the year
    if (format.indexOf("yyyy") > -1) {
        format = format.replace("yyyy", year.toString());
    } else if (format.indexOf("yy") > -1) {
        format = format.replace("yy", year.toString().substr(2,2));
    }

    //replace the day
    format = format.replace("dd", day.toString().padStart(2,"0"));

    return format;
}

// window.onload = function(){
//   alert("READY!");
// }

</script>
@endsection