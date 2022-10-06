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
      <br>
      <?php echo $cont->renderNavigateButtons(); ?>
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
  constructor() 
  {
    let self = this;
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
    this.btnUpdate = document.querySelector("#btnUpdateEvent");
    
    this.rowTgAcc = document.querySelector('#row_targetAcc');
    this.rowCateg = document.querySelector('#row_category');
    
    this.rowOptions = document.querySelector('#mod_options_body');
    this.rowManage = document.querySelector('#mod_manage_body');
    
    this.categorySelector = document.querySelector('#mod_category');
    
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
    

    this.btnOptns.addEventListener('click', function(){
      self.SetOptionsShowed(self);
    });
    

    this.btnManage.addEventListener('click', function(){
      self.SetManageShowed(self);
    });

    this.btnSave.addEventListener('click', function(){
      self.SaveNewEvent(self);
    });
    this.btnUpdate.addEventListener('click', function(){
      self.UpdateEvent(self);
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
      this.SetOptionsHidden(this);
      this.title.innerHTML = 'Add new event';
      this.btnManage.setAttribute('disabled', 'disabled');
      this.btnOptns.removeAttribute('disabled');

      let date = elem.parentNode.getAttribute('date');
      document.querySelector('#mod_date').value = date;
     //alert(date);

     document.querySelector('#mod_name').value = "";
        document.querySelector('#mod_description').value = "";
        document.querySelector('#mod_amount').value = 0;

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
   
    parent.modHeader.classList.add('hd-incom');
    parent.modHeader.classList.remove('hd-expense');
    parent.modHeader.classList.remove('hd-transfer');

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
 
    parent.modHeader.classList.remove('hd-incom');
    parent.modHeader.classList.add('hd-expense');
    parent.modHeader.classList.remove('hd-transfer');

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
    
    parent.modHeader.classList.remove('hd-incom');
    parent.modHeader.classList.remove('hd-expense');
    parent.modHeader.classList.add('hd-transfer');

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
  SetOptionsHidden(parent){
    parent.rowManage.classList.add('uk-hidden');
    parent.rowOptions.classList.add('uk-hidden');
    parent.btnOptns.classList.remove('uk-background-default');
    parent.btnManage.classList.remove('uk-background-default');

  }
  SetOptionsShowed(parent){
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
  SetManageShowed(parent){
    if (parent.btnManage.classList.contains('uk-background-default')){
      parent.btnManage.classList.remove('uk-background-default');
      parent.rowManage.classList.add('uk-hidden');
      return;
    }
    parent.btnOptns.classList.remove('uk-background-default');
    parent.btnManage.classList.add('uk-background-default');
    parent.rowOptions.classList.add('uk-hidden');
    parent.rowManage.classList.remove('uk-hidden');
  }

  SaveNewEvent(self)
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
          Modal.closeEventModal();
          Dom.reload();
          Mastercounter.recount();
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
          Mastercounter.recount();
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
              parent.fillEditItemWindow(parent.chousenItem);
              console.log('edit');
            } else if (buttons[y].getAttribute('data-event') == 'accent'){
              // removeItem(id);
              parent.accentItem(parent.chousenItem);
              console.log('accent');
            } else if (buttons[y].getAttribute('data-event') == 'disable'){
              // removeItem(id);
              console.log('disable');
              parent.disableItem(parent.chousenItem);
              Mastercounter.recount();
            } else if (buttons[y].getAttribute('data-event') == 'remove'){
              // removeItem(id);
              parent.removeItem(parent.chousenItem);
              console.log('remove');
              Mastercounter.recount();
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
              
              document.querySelector('#itemMenu').remove();
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
        Modal.btnOptns.setAttribute('disabled', 'disabled');
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
    let removeChilds = 0;
    if (block.getAttribute('haschildren') == 1){
      const result = confirm('Remove all child events?');
      if (result == true){
        removeChilds = 1;
      }
    }
    let counter = 0;
    let requestCode = 390;
    let outFormat = "json";

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
    xhttp.send(JSON.stringify(data));
  }
  

  disableItem(identer){
    let block = document.querySelector('#' + identer);
    let disablestate = 1;
    if (block.classList.contains('bud-disabled')){
       disablestate = 0;
       block.classList.remove('bud-disabled');
      } else {
        block.classList.add('bud-disabled');
      }
    let disableChilds = 0;
    if (block.getAttribute('haschildren') == 1){
      const result = confirm('Disable all child events?');
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

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == -1){ alert("You are not registered!");
          block.remove();
          return 0;
        };
        console.log(this.responseText);

        if (disableChilds){
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

    let counter = 0;
    let requestCode = 370;
    let outFormat = "number";

    let data = {};
    data.code = requestCode;
    data.id = identer;
    data.state = accentstate;

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
  let actype = ev.target.getAttribute('account');

  let sourceType = document.getElementById(sourceEventId).getAttribute('type');

  if (ev.shiftKey){
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
    }
  } 
  else {
    if (ev.target.classList.contains('droptabledata')){
    var data = ev.dataTransfer.getData("Text");
    Dom.moveEventItem(sourceEventId, date, account);
    ev.target.appendChild(document.getElementById(data));
    }
  }
  Mastercounter.recount();
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
    this.droptabledata = document.querySelectorAll('.droptabledata');

    // recount CELL
    for (let i = 0; i < this.droptabledata.length; i++)
    {
      let total = 0;
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
        this.droptabledata[i].querySelectorAll('.daytotal')[0].innerHTML = total;
      }
      else 
      {
        this.droptabledata[i].querySelectorAll('.daytotal')[0].innerHTML = "";
      }
    }

    // RECOUNT ROWS
    // 1 - get starting balance and create value array
    let resarray = [];
    let subobjects = [];
    let subtotalrows = document.querySelectorAll('.subtotal');
    for (let i = 0; i < subtotalrows.length ; i++) {
      let index = subtotalrows.length - i - 1;
      let subbalances = subtotalrows[index].querySelectorAll('.subtotalbal');
      for (let q = 0; q < subbalances.length; q++) {
        let value = +((subbalances[q].innerHTML).trim());
        resarray.push(value);
        let obj = {
          "incom" : 0,
          "depos" : 0,
          "expens" : 0,
          "transfer" : 0,
          "prev_incom" : 0,
          "prev_depos" : 0,
          "prev_expens" : 0,
          "prev_transfer" : 0,
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
          rows[index].querySelectorAll('.daytotals')[t].innerHTML = resarray[t];
        }
      }
      if (rows[index].classList.contains('subtotal')){
        let sums = 0;
        for (let t = 0; t < resarray.length; t++) {
          rows[index].querySelectorAll('.subtotalbal')[t].innerHTML = resarray[t];
          sums += resarray[t];
        }
        if (resarray.length > 1){
          rows[index].querySelectorAll('.totalofrow_s')[0].innerHTML = sums;
        }
      }
      if (rows[index].querySelectorAll('.totalofrow').length > 0){
        let sum = 0;
        for (let t = 0; t < resarray.length; t++) {
          sum += resarray[t];
        }
        rows[index].querySelectorAll('.totalofrow')[0].innerHTML = sum;
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
        if (celler.querySelectorAll('.incoms').length > 0){

          let sign = "+";
          let previc = "";
          let value = 0;

          value = subobjects[i].incom - subobjects[i].prev_incom;
          if (value > 0){sign = "+";} else {sign = "";};
          previc = "(" + sign + (value) + ")";
          let t = previc;
          celler.querySelectorAll('.incoms')[0].innerHTML      = subobjects[i].incom;
          celler.querySelectorAll('.incoms')[0].parentNode.setAttribute('title', t);
          
          value = subobjects[i].depos - subobjects[i].prev_depos;
          if (value > 0){sign = "+";} else {sign = "";};
          previc = "(" + sign + value + ")";
          celler.querySelectorAll('.deposits')[0].innerHTML    = subobjects[i].depos;
          let b = previc + " incoms + deposits = " + (subobjects[i].incom + subobjects[i].depos);
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
      this.reload();
      this.handleScrollTableTop();
    }

    handleScrollTableTop(){
      /* HIDE Nav when scroll down
      let inwindow = (e || event).clientY; // Throw position depended by window top
      let scrolled = window.scrollY;
      let clickposition = scrolled + inwindow;
      //let id = $(this).attr("id");
      let blockpos = 0;
      let height = 0;
      if (inblocks.length > 0){
        blockpos = inblocks[0].getBoundingClientRect().top + scrolled;
      */
      var lastScrollTop = 0;
      var conditor = 0;
      window.addEventListener('scroll', function(event){
        let self = window;
        var position = 0;
        var st = window.scrollY;

        var ttble = document.querySelectorAll(".uk-table")[0].getBoundingClientRect().top;
        //console.log(ttble);
          if (st > lastScrollTop){
            position = document.querySelectorAll(".uk-table")[0].getBoundingClientRect().left;
            if (position > -1){
              position = document.querySelectorAll(".uk-table")[0].getBoundingClientRect().left;
            };
            //console.log(position);
            //$("#stickytablehead").css("left", position + "px");
           // document.querySelector("#stickytablehead").style.left = position + "px";
          };
          if (document.querySelector("#stickytablehead") != undefined){
            /*
            $(".tf-table-monthname").each(function(){
                let montnamepos = $(this).offset().top;
                let montnamneme = $(this).text();
                if (st > montnamepos){
                  montnamneme = montnamneme.slice(0, 3);
                  $("#stickytablehead").find("th").eq(0).text(montnamneme);
                }
              }); */
          };
          /*
          if (st > ttble + 1){
      // if (st > lastScrollTop){
          if (conditor == 0){
            let counter = 0;
            let header = $(".tftable").children("thead").html();
            let newCon = "<div id='stickytablehead'><table class='table table-bordered mb-0'><thead>" + header + "</thead></table></div>";
            if (st > ttble + 1){
              $("#main-tf-1").append(newCon);
            };
            $(".tftable").eq(0).children("thead").find("th").each(function(){
              let width = ($(this).css("width"));
              let padding = $(this).css("padding");
              width = parseInt(width) + 0.5;
              $("#stickytablehead").find("th").eq(counter).css("width", width + "px");
              $("#stickytablehead").find("th").eq(counter).css("padding", padding);
              $("#stickytablehead").find("th").eq(counter).css("z-index", "99");
              $("#sidebarMenu").addClass("top-zero");
              $("#fixedpool").addClass("top-zero");
              counter++;
              });
              $("nav").addClass("d-none");
              conditor = 1;
            }
            // downscroll code
          } else {
            // upscroll code
            if (conditor == 1){
              $("nav").removeClass("d-none");
              $("#stickytablehead").remove();
              $("#sidebarMenu").removeClass("top-zero");
              $("#fixedpool").removeClass("top-zero");
              conditor = 0;
            };
          } */
          lastScrollTop = st;
          position = document.querySelectorAll(".uk-table")[0].getBoundingClientRect().left; // position
          if (position > -1){
            position = document.querySelectorAll(".uk-table")[0].getBoundingClientRect().left; // offset
          };
          //console.log(position);
          // document.querySelector("#stickytablehead").style.left = position + "px";
      });
    }
 }
 var Modal = new ModalHandler();
 var Dom = new DOM();
//  var DOME = new DOM();
//  var DMAN =  new DomManager();
 var Decor = new Decorator();
 var Mastercounter = new Counter();

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

</script>
@endsection