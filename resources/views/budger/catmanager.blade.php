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

      <button class="uk-button uk-button-default">Add category</button>
      <button class="uk-button uk-button-default">Collapse all</button>
      <button class="uk-button uk-button-default" disabled>Disabled</button>
      </p>
    </div>
</div>


<div class="uk-section uk-section-default">
    <div class="uk-container uk-container-small" id="domContainer">


<div class="uk-child-width-1-1" uk-grid  uk-sortable="handle: .uk-sortable-handle">
    <div class='catBox'>
      
        <h4><span class="uk-icon-link uk-sortable-handle" uk-icon="move"></span>  <span class='groupname'>Group 1</span> 
          <span class='uk-text-muted counts'>[44]</span>
          <span class="btn-collapse">collapse</span>
          <span class="btn-addcategory">create one<span>
        </h4>
        <div uk-sortable="group: sortable-group">
            <div class="uk-margin card-box">
                <div class="uk-card uk-card-default uk-card-body  uk-box-shadow-medium uk-card-small"><span class='cardName'>Item</span></div>
            </div>
            <div class="uk-margin card-box">
                <div class="uk-card uk-card-default uk-card-body  uk-box-shadow-medium uk-card-small"><span class='cardName'>Item</span></div>
            </div>
            <div class="uk-margin card-box">
                <div class="uk-card uk-card-default uk-card-body  uk-box-shadow-medium uk-card-small"><span class='cardName'>Item</span></div>
            </div>
            <div class="uk-margin card-box">
                <div class="uk-card uk-card-default uk-card-body  uk-box-shadow-medium uk-card-small"><span class='cardName'>Item</span></div>
            </div>
        </div>
    </div>

    <div class='catBox'>
    <h4><span class="uk-icon-link uk-sortable-handle" uk-icon="move"></span>  <span class='groupname'>Group 1</span> 
    <span class='uk-text-muted counts'>[12]</span>
    <span class="btn-collapse">collapse</span>
    <span class="btn-addcategory">create one<span>
  </h4>
        <div uk-sortable="group: sortable-group">
            <div class="uk-margin card-box">
                <div class="uk-card uk-card-default uk-card-body  uk-box-shadow-medium uk-card-small"><span class='cardName'>Item</span></div>
            </div>
            <div class="uk-margin card-box">
                <div class="uk-card uk-card-default uk-card-body  uk-box-shadow-medium uk-card-small"><span class='cardName'>Item</span></div>
            </div>
            <div class="uk-margin card-box">
                <div class="uk-card uk-card-default uk-card-body  uk-box-shadow-medium uk-card-small"><span class='cardName'>Item</span></div>
            </div>
            <div class="uk-margin card-box">
                <div class="uk-card uk-card-default uk-card-body  uk-box-shadow-medium uk-card-small"><span class='cardName'>Item</span></div>
            </div>
        </div>
    </div>

    <div class='catBox'>
    <h4><span class="uk-icon-link uk-sortable-handle" uk-icon="move"></span>  
    <span class='groupname'>Group 1</span> <span class='uk-text-muted counts'>[12]</span>
    <span class="btn-collapse">collapse</span>
    <span class="btn-addcategory">create one<span>
  </h4>
        <div uk-sortable="group: sortable-group">
            <div class="uk-margin card-box">
                <div class="uk-card uk-card-default uk-card-body  uk-box-shadow-medium uk-card-small"><span class='cardName'>Item</span></div>
            </div>
            <div class="uk-margin card-box">
                <div class="uk-card uk-card-default uk-card-body  uk-box-shadow-medium uk-card-small"><span class='cardName'>Item</span></div>
            </div>
            <div class="uk-margin card-box">
                <div class="uk-card uk-card-default uk-card-body  uk-box-shadow-medium uk-card-small"><span class='cardName'>Item</span></div>
            </div>
            <div class="uk-margin card-box">
                <div class="uk-card uk-card-default uk-card-body  uk-box-shadow-medium uk-card-small"><span class='cardName'>Item</span></div>
            </div>
        </div>
    </div>

    <div class='catBox'>
    <h4><span class="uk-icon-link uk-sortable-handle" uk-icon="move"></span>  
    <span class='groupname'>Group 1</span> <span class='uk-text-muted counts'>[12]</span>
    <span class="btn-collapse">collapse</span>
    <span class="btn-addcategory">create one<span>
  </h4>

        <div uk-sortable="group: sortable-group">
    </div>
</div>

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
  let addCatTriggers = document.querySelectorAll(".btn-addcategory");
  let groupNames = document.querySelectorAll(".groupname");
  let categoryNames = document.querySelectorAll(".cardName");
  let abs = document.querySelectorAll(".card-box");
  let domContainer = document.querySelector("#domContainer").innerHTML;


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

  for (let i = 0 ; i < addCatTriggers.length; i++){
    addCatTriggers[i].addEventListener("click", function(){
      let block = "<div class='uk-margin card-box' style='user-select: none;'><div class='uk-card uk-card-default uk-card-body  uk-box-shadow-medium uk-card-small'><span class='cardName'>NEW CATEGORY*</span></div></div>";
        addCatTriggers[i].parentNode.parentNode.querySelectorAll(".uk-sortable")[0].insertAdjacentHTML('afterBegin', block);
        DOMreload();
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

        tg.addEventListener("focusout", function(){
          if (tg != null){
          let text = tg.value;
          
          console.log("You clicker!");
          groupNames[i].parentNode.classList.remove("group-edited");
          tg.parentNode.classList.remove("edited");
          tg.remove();
          groupNames[i].innerHTML = text;
   
        }
        })
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

        tg.addEventListener("focusout", function(){
          if (tg != null){
          let text = tg.value;
          
          console.log("You clicker!");
          tg.parentNode.classList.remove("edited");
          tg.remove();
          categoryNames[i].innerHTML = text;
        }
        })
      }
    });
  }


  for (let i = 0 ; i < abs.length; i++){
  abs[i].addEventListener('mouseout', function(){
    if (domContainer != document.querySelector("#domContainer").innerHTML && !document.querySelector("html").classList.contains("uk-drag")){
      refreshCounters();
      console.log("HELLO");
      domContainer = document.querySelector("#domContainer").innerHTML;
    }
  })
};

  // Array.from(doubleTriggers).forEach(i => i.addEventListener("dblclick", function(i){
  //   openEventModal(i);
  //   buildEventModal(i);
  // }));

 }
 // --------------------------- DOM -------------------


 DOM();

function refreshCounters(){
  let groups =  document.querySelectorAll(".catBox");
  for (let i = 0 ; i < groups.length; i++){
    let c = groups[i].querySelectorAll(".card-box") == null ? 0 : groups[i].querySelectorAll(".card-box").length;
    groups[i].querySelectorAll(".counts")[0].innerHTML = "[" + c + "]";
  }
}







</script>
@endsection