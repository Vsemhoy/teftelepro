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
  


  </div>
  </div>
<?php
 echo BudgerTemplates::renderEventModal(null, BudgerData::LoadGroupedCategories($user));
 ?>


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