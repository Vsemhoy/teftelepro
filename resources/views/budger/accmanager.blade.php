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

@endsection

@section('page-scripts')
<script>
var activeId = 0;


function DOMreload(){
  let data = document.querySelector('#domContainer').innerHTML;
  document.querySelector('#domContainer').innerHTML = "";
  document.querySelector('#domContainer').insertAdjacentHTML('afterBegin', data);


  DOM();
  refreshCounters();
}

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
    DOMreload();
    //alert(JSON.stringify(data));
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
        document.querySelector('#bud_name').value = data.name;
        document.querySelector('#bud_descr').innerHTML = data.description;
        document.querySelector('#bud_decimal').value = data.decimals;
        document.querySelector('#bud_percentage').value = data.percent;
        document.querySelector('#bud_acctype').value = data.type;
        document.querySelector('#bud_currency').value = data.currency;
        document.querySelector('#bud_currency').value = data.currency;
        document.querySelector('#bud_archieved').checked = data.archieved;
        document.querySelector('#bud_notshow').checked = data.notshow;
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

    document.querySelector('#bud_name').value            = "";
    document.querySelector('#bud_descr').innerHTML = "";
    document.querySelector('#bud_decimal').value         = 0;
    document.querySelector('#bud_percentage').value = 0;
    document.querySelector('#bud_acctype').value         = 1;
    document.querySelector('#bud_currency').value        = 1;
    document.querySelector('#bud_archieved').checked     = false;
    document.querySelector('#bud_notshow').checked       = false;
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
      let name =  document.querySelector('#bud_name').value;
      let descr =  document.querySelector('#bud_descr').value;
      let decimals =  document.querySelector('#bud_decimal').value;
      let type =  document.querySelector('#bud_acctype').value;
      let currency =  document.querySelector('#bud_currency').value;
      let percent = document.querySelector('#bud_percentage').value;
      let archieved =  document.querySelector('#bud_archieved').checked ? 1 : 0;
      let notshow =  document.querySelector('#bud_notshow').checked ? 1 : 0;
      let data = {};
      data.name = name;
      data.descr = descr;
      data.decimals = decimals;
      data.percent = percent;
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
    let name =  document.querySelector('#bud_name').value;
      let descr =  document.querySelector('#bud_descr').value;
      let decimals =  document.querySelector('#bud_decimal').value;
      let type =  document.querySelector('#bud_acctype').value;
      let percent = document.querySelector('#bud_percentage').value;
      let currency =  document.querySelector('#bud_currency').value;
      let archieved =  document.querySelector('#bud_archieved').checked ? 1 : 0;
      let notshow =  document.querySelector('#bud_notshow').checked ? 1 : 0;
      let data = {};
      data.id = activeId;
      data.name = name;
      data.descr = descr;
      data.decimals = decimals;
      data.percent = percent;
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