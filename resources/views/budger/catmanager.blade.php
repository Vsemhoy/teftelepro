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
    //$com = Controller::getComponent('budger');
    //$cont = new BudgerMain($user->id);
    $BD = new BudgerData();

    $groups = null;
    if ($user != null){
      $groups = $BD->LoadGroupList_ALL_keyId($user->id);
      $categs = $BD->LoadCategoryList_ALL_keyId($user->id);
    }
    ?>
<div class="uk-section uk-section-primary uk-padding-small">
    <div class="uk-container uk-container-small uk-light">
    <h3 class="uk-card-title uk-light text-white">Category manager: <span>active items</span></h3>
    <p uk-margin>

      <button class="uk-button uk-button-default" id='addGroupButton'>Add group</button>
      <button class="uk-button uk-button-default" data-collapsed='false' id='collapesAllButton'>Collapse all</button>
      <button class="uk-button uk-button-primary" >Show archieved</button>
        
      </p>
    </div>
</div>


<div class="uk-section uk-section-default">
    <div class="uk-container uk-container-small ">


<div class="uk-child-width-1-1 not-archieved-list" uk-grid  uk-sortable="handle: .uk-sortable-handle"  id="domContainer">

<?php
if ($user != null){

  foreach ($groups AS $key => $value)
  {
    $groupId =  $value->id;
    $items = [];
    foreach ($categs AS $keyq => $volk)
    {
      if ($volk->grouper == $groupId){
        $row = BudgerTemplates::renderGroupItem($volk->id, $volk->name, $volk->color, $volk->archieved, $volk->ordered);
        array_push($items, $row);
      }
    }

    echo BudgerTemplates::renderGroupContainer($key, $value->name, $value->color, null, $items, $value->type, $value->ordered);
  }
}
else {
  ?>
<div class="uk-alert-danger" uk-alert>
    <a class="uk-alert-close" uk-close></a>
    <p>You are not logged in!</p>
</div>
  <?php 
};
 ?>
    </div>
</div>

<!-- This is the modal -->
<div id="modal-example" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <h2 class="uk-modal-title">Headline</h2>
        <div class="uk-margin">
        <label class='uk-h4'>Choose base color:</label>
        
        <input type="color" id="colorPicker" class='uk-input' value="#316596"/></div>
        <div class="uk-margin">
        <label>Count of instances: <span id="clrscount"></span></label>
        <input type="range" class='uk-range' id="colorSteps" max="128" min="2" step="1" value="12">
        </div>
        <div class="uk-margin">
        <label>Color step: <span id="clrstplbl"></span></label>
        <input id="colorStep" class='uk-range' type="range" id="colorSteps" max="120" min="1" step="1" value="10">
      </div>
        <p class="uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
            <button class="uk-button uk-button-primary" type="button">Save</button>
        </p>
    </div>
</div>

@endsection

@section('page-scripts')
<script>

// let modalWindow = document.querySelector("#modal_event");

// let doubleTriggers = document.querySelectorAll(".droptabledata");

// --------------------------- DOM -------------------

function DOMreload(){
  let data = document.querySelector('#domContainer').innerHTML;
  document.querySelector('#domContainer').innerHTML = "";
  document.querySelector('#domContainer').insertAdjacentHTML('afterBegin', data);


  DOM();
  refreshCounters();
}

function DOM() {

  let collapseTriggers = document.querySelectorAll(".btn-collapse");
  let addItemTriggers = document.querySelectorAll(".btn-addItem");
  let removeGroupTriggers = document.querySelectorAll(".btn-remove");

  let groupNames = document.querySelectorAll(".groupname");
  let categoryNames = document.querySelectorAll(".cardName");
  let cardBoxes = document.querySelectorAll(".card-box");
  let menuTrigger = document.querySelectorAll(".itemMenu");
  let typeChanger = document.querySelectorAll(".typeChanger");
  let domContainer = document.querySelector("#domContainer").innerHTML;
  let groupOrderString = "";
  let groupContainer = "";
  // let eventBlocker = false;

  let categoryBoxes = document.querySelectorAll(".catBox");
    for (let y = 0; y < categoryBoxes.length; y++){
      groupOrderString += categoryBoxes[y].id;
    };


  for (let i = 0 ; i < collapseTriggers.length; i++){
    collapseTriggers[i].addEventListener("click", function(){
      if (!collapseTriggers[i].parentNode.parentNode.classList.contains("collapsed"))
      {
        collapseTriggers[i].parentNode.parentNode.classList.add("collapsed");
      }
      else 
      {
        collapseTriggers[i].parentNode.parentNode.classList.remove("collapsed");
      }

    });
  }

  for (let i = 0 ; i < addItemTriggers.length; i++){
    addItemTriggers[i].addEventListener("click", function(){
      let block = `<?php echo BudgerTemplates::renderGroupItem("", "", "", ""); ?>`;
        addItemTriggers[i].parentNode.parentNode.querySelectorAll(".uk-sortable")[0].insertAdjacentHTML('afterBegin', block);
        DOMreload();
        saveNewItem();
    });
  }

  for (let i = 0 ; i < groupNames.length; i++){
    groupNames[i].addEventListener("dblclick", function(elem){
      let text = groupNames[i].innerHTML;
      let block = "<input type='text' maxlength='64' id='newGroupName' class='group-name-editor' value='" + text + "'/> "
      if (groupNames[i].classList.contains("edited"))
      {

      }
      else 
      {
        groupNames[i].parentNode.classList.add("group-edited");
        groupNames[i].classList.add("edited");
        groupNames[i].innerHTML = block;
        let tg =  document.querySelector("#newGroupName");
        let element = groupNames[i].parentNode.parentNode;
        tg.focus();
        tg.addEventListener("focusout", function(){
          if (tg != null){
          let text = tg.value;
          groupNames[i].parentNode.classList.remove("group-edited");
          tg.parentNode.classList.remove("edited");
          tg.remove();
          groupNames[i].innerHTML = text.trim();
          UpdateGroupName(text, element);
        }
        });
        tg.addEventListener("keyup", function(e){
          if (e.key == 'Enter'){
            if (tg != null){
              let text = tg.value;
              groupNames[i].parentNode.classList.remove("group-edited");
              tg.parentNode.classList.remove("edited");
              // tg.remove();
              
              if (text == ""){ text = "No name";}
              groupNames[i].innerHTML = text.trim();
              UpdateGroupName(text, element);
            };
          };
        });
      }
    });
  }
  
  for (let i = 0 ; i < categoryNames.length; i++){
    categoryNames[i].addEventListener("dblclick", function(elem){
      let id = categoryNames[i].parentNode.parentNode.id;
      let text = categoryNames[i].innerHTML;
      let block = "<input type='text' maxlength='32' id='newCategoryName' class='group-name-editor' value='" + text + "'/> "
      if (categoryNames[i].classList.contains("edited"))
      {

      }
      else 
      {
        categoryNames[i].classList.add("edited");
        categoryNames[i].innerHTML = block;
        let tg =  document.querySelector("#newCategoryName");
        tg.focus();
        tg.addEventListener("focusout", function(){
          if (tg != null){
          let text = tg.value;      
          tg.parentNode.classList.remove("edited");
          tg.remove();
          if (text == ""){ text = "No name";}
          categoryNames[i].innerHTML = text.trim();
          updateNameOfItem(id, text);
        }
        });
        tg.addEventListener("keyup", function(e){
          if (e.key == 'Enter'){
            if (tg != null){
              let text = tg.value;      
              tg.parentNode.classList.remove("edited");
              // tg.remove();
              if (text == ""){ text = "No name";}
              categoryNames[i].innerHTML = text.trim();
              updateNameOfItem(id, text);
            };
          };
        });
      }
    });
  }

  /// Trigger item Menu button
  for (let i = 0; i < menuTrigger.length; i++)
  {
    menuTrigger[i].addEventListener("mouseover", function(){
      //eventBlock = true; 
      let left = menuTrigger[i].getBoundingClientRect().left;
      let top = menuTrigger[i].getBoundingClientRect().top;


      if (document.querySelector('#itemMenu') != null){
        document.querySelector('#itemMenu').remove();
      }
      let block = `<?php echo budgerTemplates::renderCategoryItemMenu(); ?>`;
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
          reorderItems(cardBoxes[i].parentNode.parentNode);
          groupContainer = cardBoxes[i].parentNode.parentNode.innerHTML;
          counter++;
        }
      }
      let categoryBoxes = document.querySelectorAll('.catBox');
      let groupOrderString = "";
            for (let y = 0; y < categoryBoxes.length; y++){
              groupOrderString += categoryBoxes[y].id;
            };
      saveGroupOrder(groupOrderString);
    }
  })
};


  for (let i = 0; i  < typeChanger.length; i++){
    typeChanger[i].addEventListener('change', function(elem){
      let body = typeChanger[i].parentNode.parentNode.parentNode.parentNode;
      body.setAttribute('data-type', typeChanger[i].value);
      if (typeChanger[i].value == 1){
        body.classList.remove('type_trn');
        body.classList.remove('type_exp');
        body.classList.add('type_inc');
      } else if (typeChanger[i].value == 2){
        body.classList.remove('type_trn');
        body.classList.remove('type_inc');
        body.classList.add('type_exp');
      } else if (typeChanger[i].value == 3){
        body.classList.remove('type_exp');
        body.classList.remove('type_inc');
        body.classList.add('type_trn');
      } 
      let groupOrderString = "";
      saveGroupOrder(groupOrderString);
      reorderItems(body);
    })
  }


  for (let i = 0; i < removeGroupTriggers.length; i++){
    removeGroupTriggers[i].addEventListener("click", function(){
      group = removeGroupTriggers[i].parentNode.parentNode;
      items = group.querySelectorAll('.card-box');
      if (items.length > 0){

        alert("Before do this, you must remove or transfer all containing items");
      }
      else 
      {
        removeGroup(group);
      }
    })
  }

  // Array.from(doubleTriggers).forEach(i => i.addEventListener("dblclick", function(i){
  //   openEventModal(i);
  //   buildEventModal(i);
  // }));

    // -------- DATABASE MANAGE FUNCTIONS ------- //
  function saveNewItem()
  {
    let counter = 0;
    let requestCode = 101;
    let outFormat = "number";
    let block = document.querySelector("#__NEWITEM__");
    block.classList.add("temper");

    let parent = block.parentNode.parentNode;
    let type = parent.getAttribute('data-type');
    let archieved = 0;
    if (parent.classList.contains('archieved')){
      archieved = 1;
    }
    let group = parent.id;
//    setTimeout(() => {   }, 5000);
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
    let data = {};
    data.code = requestCode;
    data.name = "New item";
    data.archieved = archieved;
    data.type = type;
    data.group = group;
    xhttp.send(JSON.stringify(data));

  }



  // Save data if items reordered
  function reorderItems(container)
  {
    //console.log("reorderee");
    // if (eventBlock == true){ return; }
    let counter = 0;
    let objects = [];
    let items = container.querySelectorAll('.uk-sortable')[0].querySelectorAll(".card-box");
    if (items.length > 0){
      let parentId = items[0].parentNode.parentNode.id;
      let type = items[0].parentNode.parentNode.getAttribute('data-type');
      let archieved = 0;
      if (items[0].parentNode.parentNode.classList.contains("archieved")){ archieved = 1 ;}
      //alert(container.id);
      for (let i = 0; i < items.length; i++){
        //alert(items[i].id);
        let object = {};
        items[i].setAttribute('data-order', i + 1);
        object.id = (items[i].id).replace(/\D/g, '');
        object.group = parentId;
        object.type = type;
        object.archieved = archieved;
        object.name = items[i].querySelectorAll(".cardName")[0].innerHTML;
        object.order = i + 1;
        objects.push(object);
      }
      // AJAX 
      let requestCode = 120;
      let outFormat = "number";
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          //console.log(this.responseText);
          if (this.responseText == -1){ 
            alert("You are not registered!");
            return 0;
          } else if (this.responseText == 0){
            console.log("Reorder items code 0");
            return 0;
           } else {
            // ok, moved
            console.log(this.responseText + "reordered");
            
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
      xhttp.open("POST", "/budger/ajaxcall?code=" + requestCode + "&format=" + outFormat, true);
      // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
      xhttp.setRequestHeader('X-CSRF-TOKEN', '<?php echo csrf_token(); ?>');
      xhttp.send(JSON.stringify(objects));
      //alert(JSON.stringify(objects));
      // AJAX END
    }
  }

  function UpdateGroupName(name, group){
    counter = 0;
    let requestCode = 130;
    let outFormat = "number";

//    setTimeout(() => {   }, 5000);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == -1){ alert("You are not registered!");
          return 0;
        };
        console.log(this.responseText);
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
   data = {};
   data.name = name;
   data.id = group.id;
    data.archieved = 0;
    if (group.classList.contains('archieved')){
      data.archieved = 1;
    }
    data.type = 1;
    if (group.classList.contains('type_exp')){
      data.type = 2;
    }
    data.color = group.getAttribute("data-color");
    data.code = requestCode;
    xhttp.send(JSON.stringify(data));
  }
 



  function updateNameOfItem(id, text){
    counter = 0;
    let requestCode = 131;
    let outFormat = "number";
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == -1){ alert("You are not registered!");
          return 0;
        };
        console.log(this.responseText);
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
   data = {};
   data.name = text;
   data.id = id;
    data.code = requestCode;
    xhttp.send(JSON.stringify(data));
  }

  // Remove Item from DATABASE
  function removeItem(itemId){
    let counter = 0;
    let requestCode = 191;
    let outFormat = "number";
    let block = document.querySelector("#item_" + itemId);
    block.classList.add("temper");
//    setTimeout(() => {   }, 5000);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == -1){ 
          alert("You cannot remove this item!");
          block.classList.remove("temper");
          return 0;
        } else if (this.responseText == 0){

          alert("Detach all attached events before removing");
        }
          let parent = block.parentNode.parentNode;
          block.remove();
          //reorderItems(parent);
      }
      else if (this.status > 200)
      {
        if (counter < 1){
          alert("Oops! There is some problems with the server connection.");
          block.classList.remove("temper");
          counter++;
        }
      }
    };
    xhttp.open("POST", "/budger/ajaxcall?code=" + requestCode + "&format=" + outFormat, true);
    // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhttp.setRequestHeader('X-CSRF-TOKEN', '<?php echo csrf_token(); ?>');
   // xhttp.setRequestHeader('name', '<?php echo csrf_token(); ?>');
    let data = {};
    data.code = requestCode;
    data.id = itemId;
    xhttp.send(JSON.stringify(data));
  }



  function archieveItem(itemId){
    let counter = 0;
    let requestCode = 911;
    let outFormat = "number";
    let block = document.querySelector("#item_" + itemId);
    //alert(itemId);
    block.classList.add("temper");
//    setTimeout(() => {   }, 5000);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == -1){ 
          alert("You cannot archieve this item!");
          block.classList.remove("temper");
          return 0;
        };
        console.log(this.responseText);
          let parent = block.parentNode.parentNode;
          block.classList.add('archieved');
          //reorderItems(parent);
      }
      else if (this.status > 200)
      {
        if (counter < 1){
          alert("Oops! There is some problems with the server connection.");
          block.classList.remove("temper");
          counter++;
        }
      }
    };
    xhttp.open("POST", "/budger/ajaxcall?code=" + requestCode + "&format=" + outFormat, true);
    // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhttp.setRequestHeader('X-CSRF-TOKEN', '<?php echo csrf_token(); ?>');
    let data = {};
    data.code = requestCode;
    data.id = itemId;
    xhttp.send(JSON.stringify(data));
  }


  function restoreItem(itemId){
    let counter = 0;
    let requestCode = 910;
    let outFormat = "number";
    let block = document.querySelector("#item_" + itemId);
    block.classList.add("temper");
//    setTimeout(() => {   }, 5000);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == -1){ 
          alert("You cannot restore this item!");
          block.classList.remove("temper");
          return 0;
        };
        console.log(this.responseText);
          let parent = block.parentNode.parentNode;
          block.classList.remove('archieved');
          //reorderItems(parent);
      }
      else if (this.status > 200)
      {
        if (counter < 1){
          alert("Oops! There is some problems with the server connection.");
          block.classList.remove("temper");
          counter++;
        }
      }
    };
    xhttp.open("POST", "/budger/ajaxcall?code=" + requestCode + "&format=" + outFormat, true);
    // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhttp.setRequestHeader('X-CSRF-TOKEN', '<?php echo csrf_token(); ?>');
    let data = {};
    data.code = requestCode;
    data.id = itemId;
    xhttp.send(JSON.stringify(data));
  }


  function removeGroup(block){
    let counter = 0;
    let requestCode = 193;
    let outFormat = "number";
    block.classList.add("temper");
    itemId = block.id;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == -1){ 
          alert("You cannot remove this item!");
          block.classList.remove("temper");
          return 0;
        } else if (this.responseText == 0){

          alert("Detach all attached categories before removing this");
        }
          block.remove();
          //reorderItems(parent);
      }
      else if (this.status > 200)
      {
        if (counter < 1){
          alert("Oops! There is some problems with the server connection.");
          block.classList.remove("temper");
          counter++;
        }
      }
    };
    xhttp.open("POST", "/budger/ajaxcall?code=" + requestCode + "&format=" + outFormat, true);
    // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhttp.setRequestHeader('X-CSRF-TOKEN', '<?php echo csrf_token(); ?>');
   // xhttp.setRequestHeader('name', '<?php echo csrf_token(); ?>');
    let data = {};
    data.code = requestCode;
    data.id = itemId;
    xhttp.send(JSON.stringify(data));
  }

 }
 // --------------------------- DOM END -------------------

function DOMmanager(){
  // Define variables
  let addGroupTrigger = document.querySelector("#addGroupButton");
  let collapseAllButton = document.querySelector("#collapesAllButton");
  
  
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




    // Template definitions
    // Add new group of categories function
    let grouperTemplate = `<?php echo BudgerTemplates::renderGroupContainer("", "New group", null, null, null); ?>`;
    addGroupTrigger.addEventListener("click", function(){
      document.querySelector('#domContainer').insertAdjacentHTML('afterBegin', grouperTemplate);
      DOMreload();
      saveNewGroup();
    });


        // -------- DATABASE MANAGE FUNCTIONS ------- //
  function saveNewGroup()
  {
    let counter = 0;
    let requestCode = 100;
    let outFormat = "number";
    let block = document.querySelector("#__NEWGROUP__");
    block.classList.add("temper");
    setTimeout(() => {   }, 5000);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        //document.getElementById("demo").innerHTML =
        if (this.responseText == -1){ alert("You are not registered!");
          block.remove();
          return 0;
        };
        block.classList.remove("temper");
        block.setAttribute('id','group_' + this.responseText);

        setTimeout(() => {
            let categoryBoxes = document.querySelectorAll(".catBox");
            let groupOrderString = "";
          for (let y = 0; y < categoryBoxes.length; y++){
            groupOrderString += categoryBoxes[y].id;
          };
          saveGroupOrder(groupOrderString);
        }, 300);
        DOMreload

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
    let data = {};
    data.code = requestCode;
    data.name = "New group";
    xhttp.send(JSON.stringify(data));
  }

  

}


 DOM();
 DOMmanager();

 // Refresh counters of categories in groups
function refreshCounters(){
  let groups =  document.querySelectorAll(".catBox");
  for (let i = 0 ; i < groups.length; i++){
    let c = groups[i].querySelectorAll(".card-box") == null ? 0 : groups[i].querySelectorAll(".card-box").length;
    groups[i].querySelectorAll(".counts")[0].innerHTML = "[" + c + "]";
  }
}



      let ctb = document.querySelectorAll('.catBox');
      let lastGroupOrder = "";
            for (let y = 0; y < ctb.length; y++){
              lastGroupOrder += ctb[y].id;
            };


function saveGroupOrder(string){ 
  //console.log(string);
  //console.log(lastGroupOrder);
  let counter = 0;
    if (string != lastGroupOrder){
      lastGroupOrder = string;
      let categoryBoxes = document.querySelectorAll(".catBox");
      //console.log("hello");
      let data = [];
      for (let y = 0; y < categoryBoxes.length; y++){
        let object = {};
        object.id = categoryBoxes[y].id;
        object.name = categoryBoxes[y].querySelectorAll('.groupname')[0].innerHTML;
        object.order = y + 1;
        object.archieved = 0;
        if (categoryBoxes[y].classList.contains('archieved')){
          object.archieved = 1;
        }
        object.type = categoryBoxes[y].getAttribute('data-type');
        data.push(object);
        categoryBoxes[y].setAttribute('data-order', y + 1);
      };

      let requestCode = 121;
      let outFormat = "number";
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          //console.log(this.responseText);
          if (this.responseText == -1){ 
            alert("You are not registered!");
            return 0;
          } else if (this.responseText == 0){
            console.log("Items reordered");
            return 0;
           } else {
            // ok, moved
            console.log(this.responseText + "reordered");
            
           }
        }
        else if (this.status > 200)
        {
          if (counter < 1){
            alert("Oops! There is some problems with the server connection. e");
            counter++;
          }
        }
      };
      xhttp.open("POST", "/budger/ajaxcall?code=" + requestCode + "&format=" + outFormat, true);
      // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
      xhttp.setRequestHeader('X-CSRF-TOKEN', '<?php echo csrf_token(); ?>');
      xhttp.send(JSON.stringify(data));
      //console.log(JSON.stringify(data) + " CALLED saveGroupOrder");
      DOMreload();
      
    }
  
  
  }

function GenerateColorArray(color, stepCount, stepInt){
  stepCount = (stepCount > 1) ? stepCount : 2;
  stepInt = (stepInt > 1) ? stepInt : 2;
  let pallette = document.querySelector("#pallette");
  pallette.innerHTML = "";
  //pallette.style.backgroundColor = color;
  
  let stepIntRed = stepInt;
  let stepIntGrn = stepInt;
  let stepIntBlu = stepInt;
  let colorString = "";

  let result = [];
  
  for (let i = 0 ; i < stepCount; i++)
  {
    let colorinstance = color.substring(1);
    let colors = colorinstance.match(/.{1,2}/g);
    let red = parseInt(colors[0], 16);
    let green = parseInt(colors[1], 16);
    let blue = parseInt(colors[2], 16);
    
    if (red + (stepIntRed * stepCount) > 256){
      stepIntRed = (255 - red) / stepCount;
      //console.log(red + " to " + stepIntRed);
    }
    if (green + (stepIntGrn * stepCount) > 256){
      stepIntGrn = (255 - green) / stepCount;
      //console.log(green + "  to " + stepIntGrn);
    }
    if (blue + (stepIntBlu * stepCount) > 256){
      stepIntBlu = ( 255 - blue) / stepCount;
      //console.log(blue + "  to " + stepIntBlu);
    }
    
    console.log(i * stepIntRed);
    let redn = red + parseInt((i * stepIntRed));
    if (redn < 256 && redn >= 0){
      red = parseInt(red + (i * stepIntRed));
    }
    let greend = parseInt(green + (i * stepIntGrn));
        if (greend < 256 && greend >= 0){
              green = parseInt(green + (i * stepIntGrn));
        }
    let blueb = parseInt(blue + (i * stepIntBlu));
        if (blueb < 256 && blueb >= 0){
              blue = parseInt(blue + (i * stepIntBlu));
        }
    //console.log(i + " red: " + red + "; green: " + green + "; blue: " + blue);
    
    if (!(redn > 255 && greend > 255 && blueb > 255)){
      let redhex = red.toString(16).toUpperCase();
      if (redhex.length == 1){
        redhex = "0" + redhex;
      };
      let greenhex = green.toString(16).toUpperCase();
      if (greenhex.length == 1){
        greenhex = "0" + greenhex;
      };
      let bluehex = blue.toString(16).toUpperCase();
          if (bluehex.length == 1){
        bluehex = "0" + bluehex;
      };
      
      let finalColor = "#" + redhex + greenhex + bluehex; 
      result.push(finalColor);
      // colorString += finalColor + ", ";
      // let block = '<div class="colorInstance" style="background-color: ' + finalColor + ';" ></div>';
      // pallette.insertAdjacentHTML("beforeend", block);
    };
  };
  // let colstr = document.querySelector("#colstr");
  // colstr.innerHTML = colorString;
  return result;
};

</script>
@endsection