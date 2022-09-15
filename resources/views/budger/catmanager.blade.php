@extends('Template.shell')

@section('page-content')

    <?php
    use App\Http\Controllers\Controller;
    use App\Http\Controllers\Components\Budger\BudgerMain;
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
    ?>
<div class="uk-section uk-section-primary uk-padding-small">
    <div class="uk-container uk-container-small uk-light">
    <h3 class="uk-card-title uk-light text-white">Category manager</h3>
    <p uk-margin>

      <button class="uk-button uk-button-default" id='addGroupButton'>Add group</button>
      <button class="uk-button uk-button-default" data-collapsed='false' id='collapesAllButton'>Collapse all</button>
      <button class="uk-button uk-button-default" disabled>Disabled</button>
      </p>
    </div>
</div>


<div class="uk-section uk-section-default">
    <div class="uk-container uk-container-small ">


<div class="uk-child-width-1-1 not-archieved-list" uk-grid  uk-sortable="handle: .uk-sortable-handle"  id="domContainer">

<?php
$items = [];
array_push($items, BudgerTemplates::renderGroupItem("rand", "dfDDDSSF pasta gora", "", ""));
array_push($items, BudgerTemplates::renderGroupItem("rand", "ANNA pasta gora", "", ""));
array_push($items, BudgerTemplates::renderGroupItem("rand", "ANNA FDS gora", "", ""));
array_push($items, BudgerTemplates::renderGroupItem("rand", "ANNA pasta gora", "", ""));
array_push($items, BudgerTemplates::renderGroupItem("rand", "ANNA pasta gora", "", ""));
 echo BudgerTemplates::renderGroupContainer("rand", "Hero Wooo", null, null, $items); ?>
    
    <?php
$items = [];
array_push($items, BudgerTemplates::renderGroupItem("rand", "fasdf pasta gora", "", ""));
array_push($items, BudgerTemplates::renderGroupItem("rand", "GGDFDF pasta gora", "", ""));
array_push($items, BudgerTemplates::renderGroupItem("rand", "fdsahgah pasta gora", "", ""));
array_push($items, BudgerTemplates::renderGroupItem("rand", "ANNA DFD gora", "", ""));
array_push($items, BudgerTemplates::renderGroupItem("rand", "ANNA DF gora", "", ""));
 echo BudgerTemplates::renderGroupContainer("rand", "Hero Wooo", null, null, $items); ?>
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

  let groupNames = document.querySelectorAll(".groupname");
  let categoryNames = document.querySelectorAll(".cardName");
  let cardBoxes = document.querySelectorAll(".card-box");
  let categoryBoxes = document.querySelectorAll(".catBox");
  let menuTrigger = document.querySelectorAll(".itemMenu");
  let domContainer = document.querySelector("#domContainer").innerHTML;
  let groupContainer = "";
  // let eventBlocker = false;


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
      setTimeout(() => {
        }, 500);
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
        tg.focus();
        tg.addEventListener("focusout", function(){
          if (tg != null){
          let text = tg.value;
          groupNames[i].parentNode.classList.remove("group-edited");
          tg.parentNode.classList.remove("edited");
          tg.remove();
          groupNames[i].innerHTML = text.trim();
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
            };
          };
        });
      }
    });
  }
  
  for (let i = 0 ; i < categoryNames.length; i++){
    categoryNames[i].addEventListener("dblclick", function(elem){
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
        reorderItems(cardBoxes[i].parentNode.parentNode);
        groupContainer = cardBoxes[i].parentNode.parentNode.innerHTML;
      }
    }
  })
};





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
//    setTimeout(() => {   }, 5000);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == -1){ alert("You are not registered!");
          block.remove();
          return 0;
        };
        block.classList.remove("temper");
        block.setAttribute('id','item_' + this.responseText);
        setTimeout(() => {
          reorderItems(block.parentNode.parentNode);
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
   // xhttp.setRequestHeader('name', '<?php echo csrf_token(); ?>');
    let data = {};
    data.code = requestCode;
    data.name = "New item";
    xhttp.send(JSON.stringify(data));

    
  }


  // Save data if items reordered
  function reorderItems(container)
  {
    // if (eventBlock == true){ return; }
    let objects = [];
    let items = container.querySelectorAll('.uk-sortable')[0].querySelectorAll(".card-box");
    if (items.length > 0){
      let parentId = items[0].parentNode.parentNode.id;
      //alert(container.id);
      for (let i = 0; i < items.length; i++){
        //alert(items[i].id);
        let object = {};
        items[i].setAttribute('data-order', i + 1);
        object.id = (items[i].id).replace(/\D/g, '');
        object.group = parentId;
        object.name = items[i].querySelectorAll(".cardName")[0].innerHTML;
        object.order = i + 1;
        objects.push(object);
      }
      // AJAX 
      let requestCode = 201;
      let outFormat = "number";
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          if (this.responseText == -1){ 
            alert("You are not registered!");
            return 0;
          } else if (this.responseText == 0){
            alert("Restricted process!");
            return 0;
           } else {
            // ok, moved
            console.log(this.responseText + "reordered");
            saveGroupOrder();
           }
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
      xhttp.open("POST", "/budger/ajaxcall?code=" + requestCode + "&format=" + outFormat, true);
      // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
      xhttp.setRequestHeader('X-CSRF-TOKEN', '<?php echo csrf_token(); ?>');
      xhttp.send(JSON.stringify(objects));
      //alert(JSON.stringify(objects));
      // AJAX END
    }
  }


  function reorderGroups()
  {
    console.log("YOURE");
  }

  // Remove Item from DATABASE
  function removeItem(itemId){
    let counter = 0;
    let requestCode = 901;
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
        };
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
    alert(itemId);
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
        saveGroupOrder();
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
    xhttp.open("POST", "/budger/ajaxcall?code=" + requestCode + "&format=" + outFormat, true);
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

function saveGroupOrder(){
    let categoryBoxes = document.querySelectorAll(".catBox");
    //console.log("hello");
    let data = [];
    for (let y = 0; y < categoryBoxes.length; y++){
      let object = {};
      object.id = categoryBoxes[y].id;
      object.name = categoryBoxes[y].querySelectorAll('.groupname')[0].innerHTML;
      object.order = y + 1;
      data.push(object);
    };
  
  
    alert(JSON.stringify(data));
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