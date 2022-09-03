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
    <div class="uk-container uk-container-small">


<div class="uk-child-width-1-1" uk-grid>
    <div>
        <h4><span href="" class="uk-icon-link" uk-icon="shrink"></span>  <span class='groupname'>Group 1</span> <span class='uk-text-muted counts'>[44]</span></h4>
        <div uk-sortable="group: sortable-group">
            <div class="uk-margin">
                <div class="uk-card uk-card-default uk-card-body  uk-box-shadow-medium uk-card-small">Item 1</div>
            </div>
            <div class="uk-margin">
                <div class="uk-card uk-card-default uk-card-body  uk-box-shadow-medium uk-card-small">Item 2</div>
            </div>
            <div class="uk-margin">
                <div class="uk-card uk-card-default uk-card-body  uk-box-shadow-medium uk-card-small">Item 3</div>
            </div>
            <div class="uk-margin">
                <div class="uk-card uk-card-default uk-card-body  uk-box-shadow-medium uk-card-small">Item 4</div>
            </div>
        </div>
    </div>

    <div>
    <h4><span href="" class="uk-icon-link" uk-icon="expand"></span>  <span class='groupname'>Group 1</span> <span class='uk-text-muted counts'>[12]</span></h4>
        <div uk-sortable="group: sortable-group">
            <div class="uk-margin">
                <div class="uk-card uk-card-default uk-card-body  uk-box-shadow-medium uk-card-small">Item 1</div>
            </div>
            <div class="uk-margin">
                <div class="uk-card uk-card-default uk-card-body  uk-box-shadow-medium uk-card-small">Item 2</div>
            </div>
            <div class="uk-margin">
                <div class="uk-card uk-card-default uk-card-body  uk-box-shadow-medium uk-card-small">Item 3</div>
            </div>
            <div class="uk-margin">
                <div class="uk-card uk-card-default uk-card-body  uk-box-shadow-medium uk-card-small">Item 4</div>
            </div>
        </div>
    </div>

    <div>
    <h4><span href="" class="uk-icon-link" uk-icon="expand"></span>  <span class='groupname'>Group 1</span> <span class='uk-text-muted counts'>[12]</span></h4>
        <div uk-sortable="group: sortable-group">
            <div class="uk-margin">
                <div class="uk-card uk-card-default uk-card-body  uk-box-shadow-medium uk-card-small">Item 1</div>
            </div>
            <div class="uk-margin">
                <div class="uk-card uk-card-default uk-card-body  uk-box-shadow-medium uk-card-small">Item 2</div>
            </div>
            <div class="uk-margin">
                <div class="uk-card uk-card-default uk-card-body  uk-box-shadow-medium uk-card-small">Item 3</div>
            </div>
            <div class="uk-margin">
                <div class="uk-card uk-card-default uk-card-body  uk-box-shadow-medium uk-card-small">Item 4</div>
            </div>
        </div>
    </div>

    <div>
        <h4>Empty Group</h4>
        <div uk-sortable="group: sortable-group">
    </div>
</div>

    </div>
</div>

@endsection

@section('page-scripts')
<script>

let modalWindow = document.querySelector("#modal_event");
let modalTriggers  = document.querySelectorAll(".event_trigger");
let doubleTriggers = document.querySelectorAll(".droptabledata");

// --------------------------- DOM -------------------
function DOM() {
  
  modalTriggers  = document.querySelectorAll(".event_trigger");
  doubleTriggers = document.querySelectorAll(".droptabledata");
  
  Array.from(modalTriggers).forEach(i => i.addEventListener("click", function(i){
    openEventModal(i);
    buildEventModal(i);
  }));

  Array.from(doubleTriggers).forEach(i => i.addEventListener("dblclick", function(i){
    openEventModal(i);
    buildEventModal(i);
  }));
   
 }
 // --------------------------- DOM -------------------

 function openEventModal(elem){
   UIkit.modal(modalWindow).show();
 }
 function BuildEventModal(){}

 DOM();


</script>
@endsection