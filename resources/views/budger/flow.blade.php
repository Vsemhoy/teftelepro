@extends('Template.shell')

@section('page-content')
<div class="uk-section uk-section-primary uk-padding-small">
    <div class="uk-container uk-container-large uk-light">
    <h3 class="uk-card-title uk-light text-white">Account manager: <span>active items</span></h3>
    <p uk-margin>

      <button class="uk-button uk-button-default" id='addGroupButton'>Add account</button>
      <button class="uk-button uk-button-default" data-collapsed='false' id='collapesAllButton'>Collapse all</button>
      <button class="uk-button uk-button-primary" >Show archieved</button>
        
      </p>
    </div>
</div>
<?php 
function renderFlowEventCard($id, $type){
  $result = "";
  $typeTag = 'tag-incom';
  if ($type == 2){
    $typeTag = 'tag-expense';
    
  } else if ($type == 3){
    $typeTag = 'tag-transfer';
  }

  $result .= "<div class='uk-card " . $typeTag . "'>
  <div class='uk-card uk-card-default uk-box-shadow-medium uk-box-shadow-hover-large uk-padding-none'>
    <div class='uk-card-header uk-padding-small'>
        <div class='uk-card-title'>
        <span class='uk-h4'>LOREM DOLLOR JIPSUM EVENT...</span>
        <span class='itemMenu uk-align-right'><span class='' uk-icon='settings'></span>
      </div>
    </div>
      <div class='uk-card-body uk-padding-small uk-padding-remove-bottom uk-padding-remove-top'>
        <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</div>
      </div>
        <div class='uk-card-footer uk-padding-small'>
        <span class='summ uk-text-bold'>+5400</span>
        <span class='categorytag uk-align-right'>Events</span>
    </div>
  </div></div>";
return $result;
}
?>
<div class="uk-section uk-section-default">
    <div class="uk-container uk-container-large ">

<div uk-filter="target: .js-filter">
  <ul class="uk-subnav uk-subnav-pill">
      <li uk-filter-control=""><a href="#">All</a></li>
      <li uk-filter-control=".tag-incom"><a href="#">Incoms</a></li>
      <li uk-filter-control=".tag-expense"><a href="#">Expenses</a></li>
      <li uk-filter-control=".tag-transfer"><a href="#">Transfers</a></li>
  </ul>


  <div class='bevent-day today  uk-margin-bottom'>
    <ul uk-tab class='bevent-header'>
      <li class="" uk-switcher-item="" ><a class='h-decorate'><b>Saturday, 13 Feb 2022</b> (10)</a></li>
      <li class="uk-align-right" ><a href="#">Statistics</a></li>
    </ul>

    <div class='uk-switcher'  >
      <div js-filter class="bevent-list js-filter uk-child-width-1-3@m uk-grid-small uk-grid-match" uk-grid>
      <?php
      for ($i = 0; $i < 5 ; $i++){
        echo renderFlowEventCard($i, 1);
      };
      for ($i = 0; $i < 2 ; $i++){
        echo renderFlowEventCard($i, 2);
      };
      for ($i = 0; $i < 4 ; $i++){
        echo renderFlowEventCard($i, 3);
      };
      ?>
      </div>
      <div class='bevent-stat' >
        <p>Here will be stat...</p>
      </div>
  </div>
  </div>


  <div class='bevent-day uk-margin-bottom'>
    <ul uk-tab class='bevent-header'>
      <li class="" uk-switcher-item="" ><a>Saturday, 13 Feb 2022 (10)</a></li>
      <li class="uk-align-right" ><a href="#">Statistics</a></li>
    </ul>

    <div class='uk-switcher'  >
    <div js-filter class="bevent-list js-filter uk-child-width-1-3@m uk-grid-small uk-grid-match" uk-grid>
    <?php
    for ($i = 0; $i < 7 ; $i++){
      echo renderFlowEventCard($i, 2);
    };
    for ($i = 0; $i < 2 ; $i++){
      echo renderFlowEventCard($i, 1);
    };
    ?>
    </div>
    <div class='bevent-stat' >
      <p>Here will be stat...</p>
    </div>
  </div>
  </div>


  <div class='bevent-day uk-margin-bottom'>
    <ul uk-tab class='bevent-header'>
      <li class="" uk-switcher-item="" ><a>Saturday, 13 Feb 2022 (10)</a></li>
      <li class="uk-align-right" ><a href="#">Statistics</a></li>
    </ul>

    <div class='uk-switcher '  >
    <div js-filter class="bevent-list js-filter uk-child-width-1-3@m uk-grid-small uk-grid-match" uk-grid>
    <?php
    for ($i = 0; $i < 4 ; $i++){
      echo renderFlowEventCard($i, 3);
    };
    ?>
    </div>
    <div class='bevent-stat' >
      <p>Here will be stat...</p>
    </div>
  </div>
  </div>


</div>

  </div>
</div>
@endsection

@section('page-scripts')

@endsection