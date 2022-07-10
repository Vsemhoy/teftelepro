@extends('bootstrap.default')

@section('page-content')

    <?php
    use App\Http\Controllers\Controller;
    // $instant  = new Controller();
    // echo $instant->renderValue();

    // $results = DB::select('select * from splmod_users where id < ?', [10]);
    // foreach($results AS $key => $value){
    //     print_r($value);
    //     echo "<br>";
    // }

    ?>

<style>
  .section-l {
    width: calc(100% - 280px);
    float: left;
    transition: all 0.4s ease-out;
  }
  .section-l.w-100 {
    width: 100%;
  }
  .section-r {
    width: 279px;
    float: left;
    transition: all  0.4s ease-out;
  }
  .section-r.w-none {
    width: 0px;
    overflow: hidden;
  }

  .section-r #flatarea {
    transition: all  0.2s ease-out;
    opacity: 1;
  }
  .section-r.w-none #flatarea {
    opacity: 0;
  }
  .emptyrow {
    
  }
  .incom {
    border-left: 3px solid #0df0b1 !important;
  }
  .expend {
    border-left: 3px solid #f1aab1 !important;
  }
  .transfer {
    border-left: 3px dotted #f77380 !important;
    background: #fde1e1;
  }
  .transferspan {
    color: #3e3e3e;
  }
  .transfered {
    border-left: 3px dotted #00cb92 !important;
    background: #e5ffde;
  }
  .bg-incom {
    background-color: #0df0b1;
  }
  .bg-expend {
    background-color: #f1aab1;
  }

.table-button-right {
  display: none;
  float: right;
  color: rgb(255 255 255 / 15%);
  font-size: 1rem;
}
.droptabledata:hover > .table-button-right {
  color: #555;
    cursor: pointer;
    z-index: 9;
    display: block;
    position: relative;
    margin-right: -24px;
    background: #ffffff;
    padding-right: 4px;
    padding-left: 4px;
    outline: 1px solid #dee2e6;
    margin-top: -8px;
    box-shadow: 1px 1px 5px rgb(0 0 0 / 25%);
}
.bbw1px {
  border-bottom: 1px #cfd4da solid;
}
#templatepool, #goodspool {
  background-image: linear-gradient( 
315deg
 , #e6e2af 10%, rgb(255 255 255 / 1%) 10%, rgb(255 255 255 / 1%) 50%, #e6e4af 50%, #e3e6af 60%, rgb(255 255 255 / 1%) 60%, rgb(255 255 255 / 1%) 100%);
  background-size: 5.00px 5.00px;
  z-index: 1;
}
#templatepool.dropHere  {
  padding-bottom: 111px;
  min-height: calc(100vh - 160px);
}
.list-group-flush > .list-group-item:last-child {
    border-bottom-width: 1px !important;
}
#templatepool .dragtemplate:hover ,.tf-item {
  transition: all 0.2s 0.6s  ease-in-out;
}
 #templatepool.dropHere .tf_item {
  z-index: -9;
}
.tf-dragged {
  z-index: 99;
}
.currentdate {
  background: #fff9c4 !important;
  outline: auto;
  outline-color: #6d6d6d;
  outline-style: dashed;
}

.daytotal {
  font-weight: 500;
  letter-spacing: 1px;
  font-style: oblique;
}
.subtotal {
  border-top: 3px solid #f1f1f1 !important; 
  box-shadow: 0px -4px 13px -9px black;
}
.stdtyr {
  font-size: 1.2rem;
}
.groupicon {
  display: inline-block;
  padding: 0.35em 0.35em;
  font-weight: 700;
  line-height: 1;
  color: #fff;
  text-align: center;
  white-space: nowrap;
  vertical-align: baseline;
  border-radius: 0.25rem;
  font-size: 1rem;
}
.daytotals, .tf_daytd, .tf_datetd, .tthd {
  color: #838990;
  background-color: rgb(183 170 130 / 12%) !important;
}
.budrow td {
  transition: all 0.1s ease-in-out;
}
.budrow:hover .daytotals {
  color: black;
}
.totalofrow, .ttfr {
  background-color: rgb(161 153 107 / 19%) !important;
}
.droptabledata {
  background: rgb(240 13 13 / 1%) !important;
  max-width: 400px;
}
.tftable {
  width: fit-content;
  margin-left: auto;
  margin-right: auto;
}
.tabs {
  display: flex;
}
.tab {
  border: 1px solid #cfd4da;
  border-bottom: 0px;
  border-left: 0px;
  padding: 6px;
  margin: 0px;
  cursor: pointer;
  margin-top: 12px;
  background: rgb(0 0 0 / 6%);
}
.tab:hover {
  box-shadow: inset 1px 1px 3px rgb(0 0 0 / 18%);
}
.tab:first-child {
  border-left: 1px solid #cfd4da;
  border-top-left-radius: 3px;
}
.tab:last-child {
  border-top-right-radius: 3px;
}
.tab.active {
  border-bottom: 1px solid #cfd4da;
  margin-bottom: -1px;
  font-weight: 600;
  box-shadow: 1px 1px 5px rgb(0 0 0 / 21%);
  background: white;
}
.subtotal small {
  font-size: 0.875em;
  border-bottom: 1px solid grey;
  width: 100%;
  display: inline-block;
}
.subtotal small > span {
  float: right;
}
.bg-subtotal {
  background-color: #afb9c1;
}
.incom .amountvalue {
  color: green;
}
.expend .amountvalue {
  color: red;
}
#tfflatfilterareaclear {
  display: block;
  margin-left: -42px;
  margin-top: 7px;
  z-index: 9;
  padding-right: 18px;
}
.d-in-flex {
  display: inline-flex;
}

.toollbartrig{ 
  position: fixed;
  margin-left: -44px;
  background: white;
  padding: 2px;
  font-size: larger;
  box-shadow: -5px 0px 9px -4px grey;
  border-right: 0px;
  padding-left: 6px;
  color: #5f6265;
  cursor: pointer;
  border-top-left-radius: 12px;
  border-bottom-left-radius: 12px;
    
}
.toollbartrig * {
  display: block;
}
.ttricon {
  transition: all 0.8s;
}
.w-none .ttricon {
  transform: rotate(180deg);
}
.w-none #tfflatfilterareaclear {
  display: none;
}
#fixedpool {
  position: fixed;
    width: inherit;
    height:100vh;
    overflow-y: auto;
    overflow-x: hidden;
}
.tf_datetd {
  transform: rotation(90deg);
}
.tf_datetd {
    text-align: center;
    font-weight: 500;
    font-size: medium;
    font-style: italic;
    padding: 3px !important;
    margin: 0px;
    color: #525252;
}
.tf_daytd {
    text-align: center;
    font-size: medium;
    padding: 3px !important;
    margin: 0px;
    color: #525252;
}
.weekend {
 /* background: #fffde8; */
  background: #f9f0f0;
}


#itm_type_btns * {
  border-radius: 0px;
}
#itm_type_btns .fade {
  opacity: 0.4;
  filter: contrast(0.5);
}
#itm_type_btns .fade:hover {
  opacity: 0.9;
  filter: contrast(0.9);
}
.input-group-text {
    min-width: 22%;
}
.badge .dd-icon {
  height: 1.2em;
}
.btn-transfer {
  background-color: #039be5;
  border-color: #03a9f4;
  border-radius: 0px;
}
.bg-transfer {
  background-color: #29b6f6;
}

.topdownto {
  display: block;
    position: fixed;
    bottom: 52px;
    right: 12px;
    z-index: 99;
    font-size: x-large;
}
.topdownto > div {
  opacity: 0.3;
}
.topdownto > div:hover {
  opacity: 1;
  cursor: pointer;
}
.droptabledata {
  transition: all 0.5s ease-in-out;
}
.dropHere {
  background-image: linear-gradient( 
315deg , #54e709 10%, rgb(255 255 255 / 1%) 10%, rgb(255 255 255 / 1%) 50%, #18c71f 50%, #76eb1e 60%, rgb(255 255 255 / 1%) 60%, rgb(255 255 255 / 1%) 100%) !important;
    background-size: 5.00px 5.00px !important;
}
.NOT_dropHere {
  background-image: linear-gradient( 
315deg , #f44336 10%, #ffffff 10%, #ffffff 50%, #eef113 50%, #ff1100 60%, #ffffff 60%, #ffffff 100%) !important;
    background-size: 5.00px 5.00px  !important;
}
.tf_datetd {
  font-size: 1.3rem;
}

#stickytablehead {
  position: fixed;
  top: 0px;
  background: white;
  z-index: 99;
  transition: all 0.5s ease-in-out;
}
#stickytablehead table {
  width: max-content;
}
#stickytablehead th {
  transition: width 0.5s ease-in-out;
}

.tf-disabled {
  background: #dfdfdf;
  opacity: 0.85;
}
.tf-accented {
  background: #faffb1;
  border: 1px solid rgb(255 207 0 / 25%);
}
.tf-accented .textvalue {
  color: #282828;
}
.tf_item:hover {
  opacity: 0.9;
  cursor: pointer;
  box-shadow: 0px 2px 7px rgb(0 0 0 / 38%);
  z-index: 9;
}
.tf-accented:hover {
box-shadow: 0 3px 12px rgb(255 225 0 / 87%);
}
.agentchoose {
  color: black;
  margin: 3px;
  cursor: pointer;
  background-color: #fff7ac;
  border: 0.5px solid #d5d5d5;
  margin-top: 12px;
  margin-bottom: 0px;
}
.agentchoose:hover {
  box-shadow: 0px 2px 7px rgb(0 0 0 / 38%);
}
 .datetrigwrap {
  display: block;
    width: 30px;
    height: 30px;
    overflow: hidden;
    margin-left: auto;
    margin-right: auto;
} 
.headdate, .headdate:focus {
  border: none;
    background: none;
    outline: none;
    float: right;
    padding: 0px !important;
}
.headdate::-webkit-calendar-picker-indicator {
  color: #838990;
  padding: none;
  margin: none;
}
.headdate::-webkit-datetime-edit-fields-wrapper {
  /* display: none; */
}
.headdate::-webkit-datetime-edit {
  /* display: none; */
}
.tthd:nth-child(2){
  padding-bottom: 1px;
}
#fixedpool , #sidebarMenu{
 
}
#fixedpool > * {
  background: white;
}
.top-zero {
  top: 0px;
  z-index: 999;
}
.top-zero#fixedpool {
  background: white;
}
.tftable td {
  transition: all 0.1s ease-in-out;
  border: 1px solid #edece3;
}
.tf_item {
  box-shadow: 0px 3px 5px rgb(0 0 0 / 15%);
  padding: 12px;
}
.droptabledata {
  min-width: 200px;
}

/* MODAL FIX FOR TEMPLATE */
@media screen and (max-width: 550px) {
.modal {
  margin: 0px;
  padding-right: 0px !important;

}
.modal div {
  border-radius: 0px;
}
.modal-dialog {
  padding: 0px;
  margin: 0px;
    width: 100%;
    height: 100%;
}
.modal-footer {
  padding: 0.1rem;
}
.section-l {
    overflow-y: visible;
}
}
.section-l > div {
    min-width: 360px;
}



</style>

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
  
  <div class="container">
<div class="btn-group mb-3 m-auto d-table" role="group" aria-label="Basic outlined example">
  <a type="button" href="https://teftele.com/index.php/component/teftelebudget/?stm=2022-05&amp;enm=2022-05" class="btn btn-outline-secondary"><i class=" bi-chevron-left"></i></a>
  <a type="button" href="https://teftele.com/index.php/component/teftelebudget/?stm=2022-05&amp;enm=2022-08" class="btn btn-outline-secondary">
  <i class=" bi-chevron-left"></i>
  <i class=" bi-plus"></i>
</a>
  <button onclick="showempties();" type="button" class="btn btn-outline-secondary" title="Hide empty rows">
  <i class=" bi-distribute-vertical"></i>
</button>
  <button onclick="hidetotals();" type="button" class="btn btn-outline-secondary" title="Hide Totals">
  <i class=" bi-grip-vertical"></i>
</button>
  <button type="button" onclick="databaseRecount();" class="d-none btn btn-outline-danger">Update Database</button>
  <button type="button" onclick="recounttotals();" class="d-none btn btn-outline-secondary">RECOUNT TOTALS</button>
  <button type="button" onclick="tf_create(1, 0);" class="btn btn-outline-secondary" title="New Event">
  <i class=" bi-journal-plus"></i>
</button>
  <a type="button" href="https://teftele.com/index.php/component/teftelebudget/?stm=2022-06&amp;enm=2022-09" class="btn btn-outline-secondary">
  <i class=" bi-plus"></i>
  <i class=" bi-chevron-right"></i>
</a>
  <a type="button" href="https://teftele.com/index.php/component/teftelebudget/?stm=2022-09&amp;enm=2022-09" class="btn btn-outline-secondary"><i class=" bi-chevron-right"></i></a>
</div>
</div>
<br>



  <table class="table table-bordered table-hover tftable">
    <thead>
    <tr>
      <th scope="col" class="tthd">Date</th>
      <th scope="col" class="tthd">
      <span class="datetrigwrap">
        <input class="headdate" type="month" id="dateflash" name="flash_date" value="2022-06">
            </span></th>
<th scope="col" acc="1" decimal="2">CASH</th>
      <th class="daytotals" scope="col" accfor="1">Total</th><th scope="col" acc="2" decimal="2">SBER CARD</th>
      <th class="daytotals" scope="col" accfor="2">Total</th><th scope="col" acc="7" decimal="2">Credit Debt</th>
      <th class="daytotals" scope="col" accfor="7">Total</th><th scope="col" class="headtotal ttfr">Totals</th>    </tr>
  </thead>
  <tbody id="budgettable">
<tr class="bg-subtotal subtotal">
  <td class="" colspan="2"><b><span class="tf-table-monthname">August</span> <span class="stdtyr">2022</span></b></td><td class="mtotalio"><small>Incoms: <span class="incoms">0.00</span></small><br><small>Expenses: <span class="expences">0.00</span></small><br><small>Difference: <span class="difference">0.00</span></small></td>
    <td class="mtotals">Balance: <span class="subtotalbal" date="2022-08-01" foracc="1">226545</span></td><td class="mtotalio"><small>Incoms: <span class="incoms">72000.00</span></small><br><small>Expenses: <span class="expences">-55000.00</span></small><br><small>Difference: <span class="difference">17000.00</span></small></td>
    <td class="mtotals">Balance: <span class="subtotalbal" date="2022-08-01" foracc="2">115427</span></td><td class="mtotalio"><small>Incoms: <span class="incoms">0.00</span></small><br><small>Expenses: <span class="expences">-8000.00</span></small><br><small>Difference: <span class="difference">-8000.00</span></small></td>
    <td class="mtotals">Balance: <span class="subtotalbal" date="2022-08-01" foracc="7">-612673</span></td><td class="totalofrow_s"><small>Balance: <span class="incoms">72000.00</span></small><br><small>Expenses: <span class="expences">-63000.00</span></small><br><small>Difference: <span class="difference">9000.00</span></small></td></tr><tr class="budrow " id="dragrow_0" date="2022-08-31">
  <td class="tf_datetd" title="2022-08-31" scope="row">31</td>
  <td class="tf_daytd">Wed</td><td id="dragarea_0_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-08-31"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-08-31">226545</td><td id="dragarea_0_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-08-31"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-08-31">115427</td><td id="dragarea_0_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-08-31"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-08-31">-612673</td><td class="totalofrow">-270701.00</td></tr><tr class="budrow " id="dragrow_1" date="2022-08-30">
  <td class="tf_datetd" title="2022-08-30" scope="row">30</td>
  <td class="tf_daytd">Tue</td><td id="dragarea_1_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-08-30"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-08-30">226545</td><td id="dragarea_1_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-08-30"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-08-30">115427</td><td id="dragarea_1_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-08-30"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-08-30">-612673</td><td class="totalofrow">-270701.00</td></tr><tr class="budrow " id="dragrow_2" date="2022-08-29">
  <td class="tf_datetd" title="2022-08-29" scope="row">29</td>
  <td class="tf_daytd">Mon</td><td id="dragarea_2_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-08-29"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-08-29">226545</td><td id="dragarea_2_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-08-29"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-08-29">115427</td><td id="dragarea_2_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-08-29"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-08-29">-612673</td><td class="totalofrow">-270701.00</td></tr><tr class="budrow  weekend" id="dragrow_3" date="2022-08-28">
  <td class="tf_datetd" title="2022-08-28" scope="row">28</td>
  <td class="tf_daytd">Sun</td><td id="dragarea_3_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-08-28"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-08-28">226545</td><td id="dragarea_3_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-08-28"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-08-28">115427</td><td id="dragarea_3_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-08-28"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-08-28">-612673</td><td class="totalofrow">-270701.00</td></tr><tr class="budrow  weekend" id="dragrow_4" date="2022-08-27">
  <td class="tf_datetd" title="2022-08-27" scope="row">27</td>
  <td class="tf_daytd">Sat</td><td id="dragarea_4_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-08-27"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-08-27">226545</td><td id="dragarea_4_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-08-27"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-08-27">115427</td><td id="dragarea_4_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-08-27"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-08-27">-612673</td><td class="totalofrow">-270701.00</td></tr><tr class="budrow " id="dragrow_5" date="2022-08-26">
  <td class="tf_datetd" title="2022-08-26" scope="row">26</td>
  <td class="tf_daytd">Fri</td><td id="dragarea_5_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-08-26"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-08-26">226545</td><td id="dragarea_5_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-08-26"><span class="daytotal">20000</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item dragtemplate incom" aria-current="true" id="tf_item_364" draggable="true" ondragstart="drag(event)" template="2216592" type="1" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Аддон</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,364);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   shortest-text" onclick="dbc_opener(this);">
   </div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">+20000</strong>
  <div class="categories"><span class="badge " style="background-color: #0065b8;" category="13"><img class="dd-icon dd-icon-inverted text-white" src="/components/com_teftelebudget/src/Media/icons/cash-register-solid.svg" title="Salary"></span></div>
</div>
</div></td><td class="daytotals" for="2" date="2022-08-26">115427</td><td id="dragarea_5_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-08-26"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-08-26">-612673</td><td class="totalofrow">-270701.00</td></tr><tr class="budrow " id="dragrow_6" date="2022-08-25">
  <td class="tf_datetd" title="2022-08-25" scope="row">25</td>
  <td class="tf_daytd">Thu</td><td id="dragarea_6_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-08-25"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-08-25">226545</td><td id="dragarea_6_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-08-25"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-08-25">95427</td><td id="dragarea_6_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-08-25"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-08-25">-612673</td><td class="totalofrow">-290701.00</td></tr><tr class="budrow " id="dragrow_7" date="2022-08-24">
  <td class="tf_datetd" title="2022-08-24" scope="row">24</td>
  <td class="tf_daytd">Wed</td><td id="dragarea_7_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-08-24"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-08-24">226545</td><td id="dragarea_7_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-08-24"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-08-24">95427</td><td id="dragarea_7_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-08-24"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-08-24">-612673</td><td class="totalofrow">-290701.00</td></tr><tr class="budrow " id="dragrow_8" date="2022-08-23">
  <td class="tf_datetd" title="2022-08-23" scope="row">23</td>
  <td class="tf_daytd">Tue</td><td id="dragarea_8_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-08-23"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-08-23">226545</td><td id="dragarea_8_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-08-23"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-08-23">95427</td><td id="dragarea_8_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-08-23"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-08-23">-612673</td><td class="totalofrow">-290701.00</td></tr><tr class="budrow " id="dragrow_9" date="2022-08-22">
  <td class="tf_datetd" title="2022-08-22" scope="row">22</td>
  <td class="tf_daytd">Mon</td><td id="dragarea_9_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-08-22"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-08-22">226545</td><td id="dragarea_9_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-08-22"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-08-22">95427</td><td id="dragarea_9_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-08-22"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-08-22">-612673</td><td class="totalofrow">-290701.00</td></tr><tr class="budrow  weekend" id="dragrow_10" date="2022-08-21">
  <td class="tf_datetd" title="2022-08-21" scope="row">21</td>
  <td class="tf_daytd">Sun</td><td id="dragarea_10_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-08-21"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-08-21">226545</td><td id="dragarea_10_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-08-21"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-08-21">95427</td><td id="dragarea_10_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-08-21"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-08-21">-612673</td><td class="totalofrow">-290701.00</td></tr><tr class="budrow  weekend" id="dragrow_11" date="2022-08-20">
  <td class="tf_datetd" title="2022-08-20" scope="row">20</td>
  <td class="tf_daytd">Sat</td><td id="dragarea_11_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-08-20"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-08-20">226545</td><td id="dragarea_11_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-08-20"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-08-20">95427</td><td id="dragarea_11_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-08-20"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-08-20">-612673</td><td class="totalofrow">-290701.00</td></tr><tr class="budrow " id="dragrow_12" date="2022-08-19">
  <td class="tf_datetd" title="2022-08-19" scope="row">19</td>
  <td class="tf_daytd">Fri</td><td id="dragarea_12_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-08-19"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-08-19">226545</td><td id="dragarea_12_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-08-19"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-08-19">95427</td><td id="dragarea_12_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-08-19"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-08-19">-612673</td><td class="totalofrow">-290701.00</td></tr><tr class="budrow " id="dragrow_13" date="2022-08-18">
  <td class="tf_datetd" title="2022-08-18" scope="row">18</td>
  <td class="tf_daytd">Thu</td><td id="dragarea_13_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-08-18"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-08-18">226545</td><td id="dragarea_13_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-08-18"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-08-18">95427</td><td id="dragarea_13_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-08-18"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-08-18">-612673</td><td class="totalofrow">-290701.00</td></tr><tr class="budrow " id="dragrow_14" date="2022-08-17">
  <td class="tf_datetd" title="2022-08-17" scope="row">17</td>
  <td class="tf_daytd">Wed</td><td id="dragarea_14_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-08-17"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-08-17">226545</td><td id="dragarea_14_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-08-17"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-08-17">95427</td><td id="dragarea_14_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-08-17"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-08-17">-612673</td><td class="totalofrow">-290701.00</td></tr><tr class="budrow " id="dragrow_15" date="2022-08-16">
  <td class="tf_datetd" title="2022-08-16" scope="row">16</td>
  <td class="tf_daytd">Tue</td><td id="dragarea_15_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-08-16"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-08-16">226545</td><td id="dragarea_15_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-08-16"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-08-16">95427</td><td id="dragarea_15_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-08-16"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-08-16">-612673</td><td class="totalofrow">-290701.00</td></tr><tr class="budrow " id="dragrow_16" date="2022-08-15">
  <td class="tf_datetd" title="2022-08-15" scope="row">15</td>
  <td class="tf_daytd">Mon</td><td id="dragarea_16_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-08-15"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-08-15">226545</td><td id="dragarea_16_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-08-15"><span class="daytotal">-30000</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_259" draggable="true" ondragstart="drag(event)" template="2223167" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Общие расходы</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,259);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   short-text" onclick="dbc_opener(this);">
   Рента, ремонт, еда, здоровье, шмот.</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-14000</strong>
  <div class="categories"><span class="badge " style="background-color: #a76bc2;" category="29">Payments</span></div>
</div>
</div><div class="list-group-item py-1 tf_item transfer" aria-current="true" id="tf_item_608" draggable="true" ondragstart="drag(event)" type="3" target="7" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
    <div class="d-flex w-100 align-items-center justify-content-between">
      <strong class="mb-1 namevalue">На кредит</strong>
      <div><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
      </div>
  
    </div>
    <div class="col-12 mb-1 small textvalue
     shortest-text" onclick="dbc_opener(this);">
     </div>
    <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 amountvalue">-16000</strong>
    <div class="categories"></div>
  </div><hr class="mb-1 mt-1"><span class="transferspan">Transfer to </span>Credit Debt</div></td><td class="daytotals" for="2" date="2022-08-15">95427</td><td id="dragarea_16_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-08-15"><span class="daytotal">8000</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item transfered" aria-current="true" id="tf_item_609" draggable="true" ondragstart="drag(event)" type="4" target="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
    <div class="d-flex w-100 align-items-center justify-content-between">
      <strong class="mb-1 namevalue">На кредит</strong>
      <div><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
      </div>
  
    </div>
    <div class="col-12 mb-1 small textvalue
     shortest-text" onclick="dbc_opener(this);">
     </div>
    <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 amountvalue">+16000</strong>
    <div class="categories"></div>
  </div><hr class="mb-1 mt-1"><span class="transferspan">Transfer from </span>SBER CARD</div><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_610" draggable="true" ondragstart="drag(event)" template="2217218" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Кредит 2</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,610);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   shortest-text" onclick="dbc_opener(this);">
   </div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-8000</strong>
  <div class="categories"><span class="badge " style="background-color: #7a6952;" category="30"><img class="dd-icon dd-icon-inverted text-white" src="/components/com_teftelebudget/src/Media/icons/weight-hanging-solid.svg" title="Credit Debts"></span></div>
</div>
</div></td><td class="daytotals" for="7" date="2022-08-15">-612673</td><td class="totalofrow">-290701.00</td></tr><tr class="budrow  weekend" id="dragrow_17" date="2022-08-14">
  <td class="tf_datetd" title="2022-08-14" scope="row">14</td>
  <td class="tf_daytd">Sun</td><td id="dragarea_17_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-08-14"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-08-14">226545</td><td id="dragarea_17_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-08-14"><span class="daytotal">-35000</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_935" draggable="true" ondragstart="drag(event)" template="222002" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Возврат долга мюс</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,935);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   shortest-text" onclick="dbc_opener(this);">
   Осталось 70 + 50</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-35000</strong>
  <div class="categories"><span class="badge " style="background-color: #7a6952;" category="30"><img class="dd-icon dd-icon-inverted text-white" src="/components/com_teftelebudget/src/Media/icons/weight-hanging-solid.svg" title="Credit Debts"></span></div>
</div>
</div></td><td class="daytotals" for="2" date="2022-08-14">125427</td><td id="dragarea_17_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-08-14"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-08-14">-620673</td><td class="totalofrow">-268701.00</td></tr><tr class="budrow  weekend" id="dragrow_18" date="2022-08-13">
  <td class="tf_datetd" title="2022-08-13" scope="row">13</td>
  <td class="tf_daytd">Sat</td><td id="dragarea_18_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-08-13"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-08-13">226545</td><td id="dragarea_18_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-08-13"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-08-13">160427</td><td id="dragarea_18_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-08-13"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-08-13">-620673</td><td class="totalofrow">-233701.00</td></tr><tr class="budrow " id="dragrow_19" date="2022-08-12">
  <td class="tf_datetd" title="2022-08-12" scope="row">12</td>
  <td class="tf_daytd">Fri</td><td id="dragarea_19_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-08-12"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-08-12">226545</td><td id="dragarea_19_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-08-12"><span class="daytotal">52000</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item dragtemplate incom" aria-current="true" id="tf_item_256" draggable="true" ondragstart="drag(event)" template="2220537" type="1" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Разработка ПО</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,256);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   short-text" onclick="dbc_opener(this);">
   Разработка по для заказчиков</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">+52000</strong>
  <div class="categories"><span class="badge " style="background-color: #0065b8;" category="13"><img class="dd-icon dd-icon-inverted text-white" src="/components/com_teftelebudget/src/Media/icons/cash-register-solid.svg" title="Salary"></span></div>
</div>
</div></td><td class="daytotals" for="2" date="2022-08-12">160427</td><td id="dragarea_19_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-08-12"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-08-12">-620673</td><td class="totalofrow">-233701.00</td></tr><tr class="budrow " id="dragrow_20" date="2022-08-11">
  <td class="tf_datetd" title="2022-08-11" scope="row">11</td>
  <td class="tf_daytd">Thu</td><td id="dragarea_20_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-08-11"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-08-11">226545</td><td id="dragarea_20_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-08-11"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-08-11">108427</td><td id="dragarea_20_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-08-11"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-08-11">-620673</td><td class="totalofrow">-285701.00</td></tr><tr class="budrow " id="dragrow_21" date="2022-08-10">
  <td class="tf_datetd" title="2022-08-10" scope="row">10</td>
  <td class="tf_daytd">Wed</td><td id="dragarea_21_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-08-10"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-08-10">226545</td><td id="dragarea_21_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-08-10"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-08-10">108427</td><td id="dragarea_21_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-08-10"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-08-10">-620673</td><td class="totalofrow">-285701.00</td></tr><tr class="budrow " id="dragrow_22" date="2022-08-09">
  <td class="tf_datetd" title="2022-08-09" scope="row">09</td>
  <td class="tf_daytd">Tue</td><td id="dragarea_22_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-08-09"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-08-09">226545</td><td id="dragarea_22_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-08-09"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-08-09">108427</td><td id="dragarea_22_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-08-09"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-08-09">-620673</td><td class="totalofrow">-285701.00</td></tr><tr class="budrow " id="dragrow_23" date="2022-08-08">
  <td class="tf_datetd" title="2022-08-08" scope="row">08</td>
  <td class="tf_daytd">Mon</td><td id="dragarea_23_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-08-08"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-08-08">226545</td><td id="dragarea_23_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-08-08"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-08-08">108427</td><td id="dragarea_23_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-08-08"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-08-08">-620673</td><td class="totalofrow">-285701.00</td></tr><tr class="budrow  weekend" id="dragrow_24" date="2022-08-07">
  <td class="tf_datetd" title="2022-08-07" scope="row">07</td>
  <td class="tf_daytd">Sun</td><td id="dragarea_24_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-08-07"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-08-07">226545</td><td id="dragarea_24_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-08-07"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-08-07">108427</td><td id="dragarea_24_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-08-07"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-08-07">-620673</td><td class="totalofrow">-285701.00</td></tr><tr class="budrow  weekend" id="dragrow_25" date="2022-08-06">
  <td class="tf_datetd" title="2022-08-06" scope="row">06</td>
  <td class="tf_daytd">Sat</td><td id="dragarea_25_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-08-06"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-08-06">226545</td><td id="dragarea_25_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-08-06"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-08-06">108427</td><td id="dragarea_25_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-08-06"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-08-06">-620673</td><td class="totalofrow">-285701.00</td></tr><tr class="budrow " id="dragrow_26" date="2022-08-05">
  <td class="tf_datetd" title="2022-08-05" scope="row">05</td>
  <td class="tf_daytd">Fri</td><td id="dragarea_26_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-08-05"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-08-05">226545</td><td id="dragarea_26_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-08-05"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-08-05">108427</td><td id="dragarea_26_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-08-05"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-08-05">-620673</td><td class="totalofrow">-285701.00</td></tr><tr class="budrow " id="dragrow_27" date="2022-08-04">
  <td class="tf_datetd" title="2022-08-04" scope="row">04</td>
  <td class="tf_daytd">Thu</td><td id="dragarea_27_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-08-04"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-08-04">226545</td><td id="dragarea_27_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-08-04"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-08-04">108427</td><td id="dragarea_27_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-08-04"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-08-04">-620673</td><td class="totalofrow">-285701.00</td></tr><tr class="budrow " id="dragrow_28" date="2022-08-03">
  <td class="tf_datetd" title="2022-08-03" scope="row">03</td>
  <td class="tf_daytd">Wed</td><td id="dragarea_28_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-08-03"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-08-03">226545</td><td id="dragarea_28_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-08-03"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-08-03">108427</td><td id="dragarea_28_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-08-03"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-08-03">-620673</td><td class="totalofrow">-285701.00</td></tr><tr class="budrow " id="dragrow_29" date="2022-08-02">
  <td class="tf_datetd" title="2022-08-02" scope="row">02</td>
  <td class="tf_daytd">Tue</td><td id="dragarea_29_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-08-02"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-08-02">226545</td><td id="dragarea_29_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-08-02"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-08-02">108427</td><td id="dragarea_29_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-08-02"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-08-02">-620673</td><td class="totalofrow">-285701.00</td></tr><tr class="budrow " id="dragrow_30" date="2022-08-01">
  <td class="tf_datetd" title="2022-08-01" scope="row">01</td>
  <td class="tf_daytd">Mon</td><td id="dragarea_30_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-08-01"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-08-01">226545</td><td id="dragarea_30_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-08-01"><span class="daytotal">-6000</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_831" draggable="true" ondragstart="drag(event)" template="2228488" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="1">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Аренда комнаты</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,831);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   shortest-text" onclick="dbc_opener(this);">
   Мюс за комнату</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-6000</strong>
  <div class="categories"><span class="badge " style="background-color: #835ba4;" category="8">Rent</span></div>
</div>
</div></td><td class="daytotals" for="2" date="2022-08-01">108427</td><td id="dragarea_30_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-08-01"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-08-01">-620673</td><td class="totalofrow">-285701.00</td></tr><tr class="bg-subtotal subtotal" date="2022-07-01">
  <td class="" colspan="2"><b><span class="tf-table-monthname">July</span> <span class="stdtyr">2022</span></b></td><td class="mtotalio"><small>Incoms: <span class="incoms">100000.00</span></small><br><small>Expenses: <span class="expences">-19500.00</span></small><br><small>Difference: <span class="difference">80500.00</span></small></td>
    <td class="mtotals">Balance: <span class="subtotalbal" date="2022-07-01" foracc="1">226545</span></td><td class="mtotalio"><small>Incoms: <span class="incoms">65000.00</span></small><br><small>Expenses: <span class="expences">-27165.00</span></small><br><small>Difference: <span class="difference">37835.00</span></small></td>
    <td class="mtotals">Balance: <span class="subtotalbal" date="2022-07-01" foracc="2">114427</span></td><td class="mtotalio"><small>Incoms: <span class="incoms">0.00</span></small><br><small>Expenses: <span class="expences">-8000.00</span></small><br><small>Difference: <span class="difference">-8000.00</span></small></td>
    <td class="mtotals">Balance: <span class="subtotalbal" date="2022-07-01" foracc="7">-620673</span></td><td class="totalofrow_s"><small>Incoms: <span class="incoms">165000.00</span></small><br><small>Expenses: <span class="expences">-54665.00</span></small><br><small>Expenses: <span class="difference">110335.00</span></small></td></tr><tr class="budrow  weekend" id="dragrow_31" date="2022-07-31">
  <td class="tf_datetd" title="2022-07-31" scope="row">31</td>
  <td class="tf_daytd">Sun</td><td id="dragarea_31_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-07-31"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-07-31">226545</td><td id="dragarea_31_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-07-31"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-07-31">114427</td><td id="dragarea_31_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-07-31"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-07-31">-620673</td><td class="totalofrow">-279701.00</td></tr><tr class="budrow  weekend" id="dragrow_32" date="2022-07-30">
  <td class="tf_datetd" title="2022-07-30" scope="row">30</td>
  <td class="tf_daytd">Sat</td><td id="dragarea_32_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-07-30"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-07-30">226545</td><td id="dragarea_32_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-07-30"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-07-30">114427</td><td id="dragarea_32_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-07-30"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-07-30">-620673</td><td class="totalofrow">-279701.00</td></tr><tr class="budrow " id="dragrow_33" date="2022-07-29">
  <td class="tf_datetd" title="2022-07-29" scope="row">29</td>
  <td class="tf_daytd">Fri</td><td id="dragarea_33_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-07-29"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-07-29">226545</td><td id="dragarea_33_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-07-29"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-07-29">114427</td><td id="dragarea_33_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-07-29"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-07-29">-620673</td><td class="totalofrow">-279701.00</td></tr><tr class="budrow " id="dragrow_34" date="2022-07-28">
  <td class="tf_datetd" title="2022-07-28" scope="row">28</td>
  <td class="tf_daytd">Thu</td><td id="dragarea_34_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-07-28"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-07-28">226545</td><td id="dragarea_34_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-07-28"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-07-28">114427</td><td id="dragarea_34_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-07-28"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-07-28">-620673</td><td class="totalofrow">-279701.00</td></tr><tr class="budrow " id="dragrow_35" date="2022-07-27">
  <td class="tf_datetd" title="2022-07-27" scope="row">27</td>
  <td class="tf_daytd">Wed</td><td id="dragarea_35_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-07-27"><span class="daytotal">130000</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item transfered" aria-current="true" id="tf_item_934" draggable="true" ondragstart="drag(event)" type="4" target="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
    <div class="d-flex w-100 align-items-center justify-content-between">
      <strong class="mb-1 namevalue">На зубы</strong>
      <div><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
      </div>
  
    </div>
    <div class="col-12 mb-1 small textvalue
     short-text" onclick="dbc_opener(this);">
     На восстановление передних рядов зубов </div>
    <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 amountvalue">+130000</strong>
    <div class="categories"></div>
  </div><hr class="mb-1 mt-1"><span class="transferspan">Transfer from </span>SBER CARD</div></td><td class="daytotals" for="1" date="2022-07-27">226545</td><td id="dragarea_35_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-07-27"><span class="daytotal">-130000</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item transfer" aria-current="true" id="tf_item_933" draggable="true" ondragstart="drag(event)" type="3" target="1" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
    <div class="d-flex w-100 align-items-center justify-content-between">
      <strong class="mb-1 namevalue">На зубы</strong>
      <div><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
      </div>
  
    </div>
    <div class="col-12 mb-1 small textvalue
     short-text" onclick="dbc_opener(this);">
     На восстановление передних рядов зубов </div>
    <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 amountvalue">-130000</strong>
    <div class="categories"></div>
  </div><hr class="mb-1 mt-1"><span class="transferspan">Transfer to </span>CASH</div></td><td class="daytotals" for="2" date="2022-07-27">114427</td><td id="dragarea_35_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-07-27"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-07-27">-620673</td><td class="totalofrow">-279701.00</td></tr><tr class="budrow " id="dragrow_36" date="2022-07-26">
  <td class="tf_datetd" title="2022-07-26" scope="row">26</td>
  <td class="tf_daytd">Tue</td><td id="dragarea_36_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-07-26"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-07-26">96545</td><td id="dragarea_36_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-07-26"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-07-26">244427</td><td id="dragarea_36_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-07-26"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-07-26">-620673</td><td class="totalofrow">-279701.00</td></tr><tr class="budrow " id="dragrow_37" date="2022-07-25">
  <td class="tf_datetd" title="2022-07-25" scope="row">25</td>
  <td class="tf_daytd">Mon</td><td id="dragarea_37_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-07-25"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-07-25">96545</td><td id="dragarea_37_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-07-25"><span class="daytotal">25000</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item dragtemplate incom" aria-current="true" id="tf_item_602" draggable="true" ondragstart="drag(event)" template="227699" type="1" onekeydown="tf_keyhandler(event)" frequency="0" ordered="2">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Аванс</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,602);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   shortest-text" onclick="dbc_opener(this);">
   </div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">+25000</strong>
  <div class="categories"><span class="badge " style="background-color: #0065b8;" category="13"><img class="dd-icon dd-icon-inverted text-white" src="/components/com_teftelebudget/src/Media/icons/cash-register-solid.svg" title="Salary"></span></div>
</div>
</div></td><td class="daytotals" for="2" date="2022-07-25">244427</td><td id="dragarea_37_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-07-25"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-07-25">-620673</td><td class="totalofrow">-279701.00</td></tr><tr class="budrow  weekend" id="dragrow_38" date="2022-07-24">
  <td class="tf_datetd" title="2022-07-24" scope="row">24</td>
  <td class="tf_daytd">Sun</td><td id="dragarea_38_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-07-24"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-07-24">96545</td><td id="dragarea_38_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-07-24"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-07-24">219427</td><td id="dragarea_38_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-07-24"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-07-24">-620673</td><td class="totalofrow">-304701.00</td></tr><tr class="budrow  weekend" id="dragrow_39" date="2022-07-23">
  <td class="tf_datetd" title="2022-07-23" scope="row">23</td>
  <td class="tf_daytd">Sat</td><td id="dragarea_39_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-07-23"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-07-23">96545</td><td id="dragarea_39_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-07-23"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-07-23">219427</td><td id="dragarea_39_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-07-23"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-07-23">-620673</td><td class="totalofrow">-304701.00</td></tr><tr class="budrow " id="dragrow_40" date="2022-07-22">
  <td class="tf_datetd" title="2022-07-22" scope="row">22</td>
  <td class="tf_daytd">Fri</td><td id="dragarea_40_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-07-22"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-07-22">96545</td><td id="dragarea_40_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-07-22"><span class="daytotal">-8000</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_607" draggable="true" ondragstart="drag(event)" template="227097" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Рента</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,607);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   shortest-text" onclick="dbc_opener(this);">
   </div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-8000</strong>
  <div class="categories"><span class="badge " style="background-color: #835ba4;" category="8">Rent</span></div>
</div>
</div></td><td class="daytotals" for="2" date="2022-07-22">219427</td><td id="dragarea_40_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-07-22"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-07-22">-620673</td><td class="totalofrow">-304701.00</td></tr><tr class="budrow " id="dragrow_41" date="2022-07-21">
  <td class="tf_datetd" title="2022-07-21" scope="row">21</td>
  <td class="tf_daytd">Thu</td><td id="dragarea_41_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-07-21"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-07-21">96545</td><td id="dragarea_41_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-07-21"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-07-21">227427</td><td id="dragarea_41_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-07-21"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-07-21">-620673</td><td class="totalofrow">-296701.00</td></tr><tr class="budrow " id="dragrow_42" date="2022-07-20">
  <td class="tf_datetd" title="2022-07-20" scope="row">20</td>
  <td class="tf_daytd">Wed</td><td id="dragarea_42_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-07-20"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-07-20">96545</td><td id="dragarea_42_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-07-20"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-07-20">227427</td><td id="dragarea_42_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-07-20"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-07-20">-620673</td><td class="totalofrow">-296701.00</td></tr><tr class="budrow " id="dragrow_43" date="2022-07-19">
  <td class="tf_datetd" title="2022-07-19" scope="row">19</td>
  <td class="tf_daytd">Tue</td><td id="dragarea_43_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-07-19"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-07-19">96545</td><td id="dragarea_43_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-07-19"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-07-19">227427</td><td id="dragarea_43_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-07-19"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-07-19">-620673</td><td class="totalofrow">-296701.00</td></tr><tr class="budrow " id="dragrow_44" date="2022-07-18">
  <td class="tf_datetd" title="2022-07-18" scope="row">18</td>
  <td class="tf_daytd">Mon</td><td id="dragarea_44_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-07-18"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-07-18">96545</td><td id="dragarea_44_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-07-18"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-07-18">227427</td><td id="dragarea_44_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-07-18"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-07-18">-620673</td><td class="totalofrow">-296701.00</td></tr><tr class="budrow  weekend" id="dragrow_45" date="2022-07-17">
  <td class="tf_datetd" title="2022-07-17" scope="row">17</td>
  <td class="tf_daytd">Sun</td><td id="dragarea_45_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-07-17"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-07-17">96545</td><td id="dragarea_45_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-07-17"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-07-17">227427</td><td id="dragarea_45_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-07-17"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-07-17">-620673</td><td class="totalofrow">-296701.00</td></tr><tr class="budrow  weekend" id="dragrow_46" date="2022-07-16">
  <td class="tf_datetd" title="2022-07-16" scope="row">16</td>
  <td class="tf_daytd">Sat</td><td id="dragarea_46_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-07-16"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-07-16">96545</td><td id="dragarea_46_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-07-16"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-07-16">227427</td><td id="dragarea_46_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-07-16"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-07-16">-620673</td><td class="totalofrow">-296701.00</td></tr><tr class="budrow " id="dragrow_47" date="2022-07-15">
  <td class="tf_datetd" title="2022-07-15" scope="row">15</td>
  <td class="tf_daytd">Fri</td><td id="dragarea_47_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-07-15"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-07-15">96545</td><td id="dragarea_47_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-07-15"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-07-15">227427</td><td id="dragarea_47_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-07-15"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-07-15">-620673</td><td class="totalofrow">-296701.00</td></tr><tr class="budrow " id="dragrow_48" date="2022-07-14">
  <td class="tf_datetd" title="2022-07-14" scope="row">14</td>
  <td class="tf_daytd">Thu</td><td id="dragarea_48_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-07-14"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-07-14">96545</td><td id="dragarea_48_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-07-14"><span class="daytotal">-22500</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_260" draggable="true" ondragstart="drag(event)" template="228955" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Общие расходы</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,260);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   short-text" onclick="dbc_opener(this);">
   Рента, ремонт, еда, здоровье, шмот.</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-6000</strong>
  <div class="categories"><span class="badge " style="background-color: #a76bc2;" category="29">Payments</span></div>
</div>
</div><div class="list-group-item py-1 tf_item transfer" aria-current="true" id="tf_item_605" draggable="true" ondragstart="drag(event)" type="3" target="7" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
    <div class="d-flex w-100 align-items-center justify-content-between">
      <strong class="mb-1 namevalue">На кредит</strong>
      <div><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
      </div>
  
    </div>
    <div class="col-12 mb-1 small textvalue
     shortest-text" onclick="dbc_opener(this);">
     </div>
    <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 amountvalue">-16500</strong>
    <div class="categories"></div>
  </div><hr class="mb-1 mt-1"><span class="transferspan">Transfer to </span>Credit Debt</div></td><td class="daytotals" for="2" date="2022-07-14">227427</td><td id="dragarea_48_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-07-14"><span class="daytotal">8500</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_604" draggable="true" ondragstart="drag(event)" template="2222841" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Крудит 2</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,604);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   shortest-text" onclick="dbc_opener(this);">
   </div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-8000</strong>
  <div class="categories"><span class="badge " style="background-color: #7a6952;" category="30"><img class="dd-icon dd-icon-inverted text-white" src="/components/com_teftelebudget/src/Media/icons/weight-hanging-solid.svg" title="Credit Debts"></span></div>
</div>
</div><div class="list-group-item py-1 tf_item transfered" aria-current="true" id="tf_item_606" draggable="true" ondragstart="drag(event)" type="4" target="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
    <div class="d-flex w-100 align-items-center justify-content-between">
      <strong class="mb-1 namevalue">На кредит</strong>
      <div><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
      </div>
  
    </div>
    <div class="col-12 mb-1 small textvalue
     shortest-text" onclick="dbc_opener(this);">
     </div>
    <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 amountvalue">+16500</strong>
    <div class="categories"></div>
  </div><hr class="mb-1 mt-1"><span class="transferspan">Transfer from </span>SBER CARD</div></td><td class="daytotals" for="7" date="2022-07-14">-620673</td><td class="totalofrow">-296701.00</td></tr><tr class="budrow " id="dragrow_49" date="2022-07-13">
  <td class="tf_datetd" title="2022-07-13" scope="row">13</td>
  <td class="tf_daytd">Wed</td><td id="dragarea_49_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-07-13"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-07-13">96545</td><td id="dragarea_49_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-07-13"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-07-13">249927</td><td id="dragarea_49_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-07-13"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-07-13">-629173</td><td class="totalofrow">-282701.00</td></tr><tr class="budrow " id="dragrow_50" date="2022-07-12">
  <td class="tf_datetd" title="2022-07-12" scope="row">12</td>
  <td class="tf_daytd">Tue</td><td id="dragarea_50_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-07-12"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-07-12">96545</td><td id="dragarea_50_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-07-12"><span class="daytotal">40000</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item dragtemplate incom" aria-current="true" id="tf_item_255" draggable="true" ondragstart="drag(event)" template="222250" type="1" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Разработка ПО</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,255);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   short-text" onclick="dbc_opener(this);">
   Разработка по для заказчиков</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">+40000</strong>
  <div class="categories"><span class="badge " style="background-color: #0065b8;" category="13"><img class="dd-icon dd-icon-inverted text-white" src="/components/com_teftelebudget/src/Media/icons/cash-register-solid.svg" title="Salary"></span></div>
</div>
</div></td><td class="daytotals" for="2" date="2022-07-12">249927</td><td id="dragarea_50_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-07-12"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-07-12">-629173</td><td class="totalofrow">-282701.00</td></tr><tr class="budrow " id="dragrow_51" date="2022-07-11">
  <td class="tf_datetd" title="2022-07-11" scope="row">11</td>
  <td class="tf_daytd">Mon</td><td id="dragarea_51_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-07-11"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-07-11">96545</td><td id="dragarea_51_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-07-11"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-07-11">209927</td><td id="dragarea_51_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-07-11"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-07-11">-629173</td><td class="totalofrow">-322701.00</td></tr><tr class="budrow  currentdate weekend" id="dragrow_52" date="2022-07-10">
  <td class="tf_datetd" title="2022-07-10" scope="row">10</td>
  <td class="tf_daytd">Sun</td><td id="dragarea_52_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-07-10"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-07-10">96545</td><td id="dragarea_52_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-07-10"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-07-10">209927</td><td id="dragarea_52_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-07-10"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-07-10">-629173</td><td class="totalofrow">-322701.00</td></tr><tr class="budrow  weekend" id="dragrow_53" date="2022-07-09">
  <td class="tf_datetd" title="2022-07-09" scope="row">09</td>
  <td class="tf_daytd">Sat</td><td id="dragarea_53_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-07-09"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-07-09">96545</td><td id="dragarea_53_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-07-09"><span class="daytotal">-170</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_954" draggable="true" ondragstart="drag(event)" template="2223030" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Шаверма </strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,954);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   middle-text" onclick="dbc_opener(this);">
   В пите, не хочу готовить еду, но буду варить гречу</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-170</strong>
  <div class="categories"><span class="badge " style="background-color: #ff0000;" category="32"><img class="dd-icon dd-icon-inverted text-white" src="/components/com_teftelebudget/src/Media/icons/pizza-slice-solid.svg" title="Canteen"></span></div>
</div>
</div></td><td class="daytotals" for="2" date="2022-07-09">209927</td><td id="dragarea_53_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-07-09"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-07-09">-629173</td><td class="totalofrow">-322701.00</td></tr><tr class="budrow " id="dragrow_54" date="2022-07-08">
  <td class="tf_datetd" title="2022-07-08" scope="row">08</td>
  <td class="tf_daytd">Fri</td><td id="dragarea_54_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-07-08"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_949" draggable="true" ondragstart="drag(event)" template="2213437" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Стома</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,949);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   short-text" onclick="dbc_opener(this);">
   Расточка нижних зубов</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-0</strong>
  <div class="categories"><span class="badge text-dark" style="background-color: #00ffff;" category="16">Medicine</span></div>
</div>
</div></td><td class="daytotals" for="1" date="2022-07-08">96545</td><td id="dragarea_54_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-07-08"><span class="daytotal">-920</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_953" draggable="true" ondragstart="drag(event)" template="222377" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Вечерний вкуснажрать</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,953);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   middle-text" onclick="dbc_opener(this);">
   Взяли 2 разные пиццы во вкусвилле и кг черешни. Обожрались. Но надо было это сделать.</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-920</strong>
  <div class="categories"><span class="badge " style="background-color: #905e18;" category="1"><img class="dd-icon dd-icon-inverted text-white" src="/components/com_teftelebudget/src/Media/icons/carrot-solid.svg" title="Grocery"></span></div>
</div>
</div></td><td class="daytotals" for="2" date="2022-07-08">210097</td><td id="dragarea_54_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-07-08"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-07-08">-629173</td><td class="totalofrow">-322531.00</td></tr><tr class="budrow " id="dragrow_55" date="2022-07-07">
  <td class="tf_datetd" title="2022-07-07" scope="row">07</td>
  <td class="tf_daytd">Thu</td><td id="dragarea_55_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-07-07"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-07-07">96545</td><td id="dragarea_55_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-07-07"><span class="daytotal">-305</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_952" draggable="true" ondragstart="drag(event)" template="2210191" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Еда в столовой</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,952);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   middle-text" onclick="dbc_opener(this);">
   За этот раз взял окрошку и пасту - оч вкусно и мягко, с учётом вываливающихся зубов</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-305</strong>
  <div class="categories"><span class="badge " style="background-color: #ff0000;" category="32"><img class="dd-icon dd-icon-inverted text-white" src="/components/com_teftelebudget/src/Media/icons/pizza-slice-solid.svg" title="Canteen"></span></div>
</div>
</div></td><td class="daytotals" for="2" date="2022-07-07">211017</td><td id="dragarea_55_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-07-07"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-07-07">-629173</td><td class="totalofrow">-321611.00</td></tr><tr class="budrow " id="dragrow_56" date="2022-07-06">
  <td class="tf_datetd" title="2022-07-06" scope="row">06</td>
  <td class="tf_daytd">Wed</td><td id="dragarea_56_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-07-06"><span class="daytotal">-19500</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_593" draggable="true" ondragstart="drag(event)" template="2219738" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Стома. Расточка передних зубов и одевание пластика.</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,593);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   middle-text" onclick="dbc_opener(this);">
   16000 - за пластиковые зубы, остальное за карие с терапию.</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-19500</strong>
  <div class="categories"><span class="badge text-dark" style="background-color: #00ffff;" category="16">Medicine</span></div>
</div>
</div></td><td class="daytotals" for="1" date="2022-07-06">96545</td><td id="dragarea_56_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-07-06"><span class="daytotal">-150</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_950" draggable="true" ondragstart="drag(event)" template="2220256" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Вкусняхи</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,950);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   short-text" onclick="dbc_opener(this);">
   3 литра хорошего лидского кваса</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-150</strong>
  <div class="categories"><span class="badge " style="background-color: #b17816;" category="2"><img class="dd-icon dd-icon-inverted text-white" src="/components/com_teftelebudget/src/Media/icons/hamburger-solid.svg" title="Junk Food"></span></div>
</div>
</div></td><td class="daytotals" for="2" date="2022-07-06">211322</td><td id="dragarea_56_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-07-06"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-07-06">-629173</td><td class="totalofrow">-321306.00</td></tr><tr class="budrow " id="dragrow_57" date="2022-07-05">
  <td class="tf_datetd" title="2022-07-05" scope="row">05</td>
  <td class="tf_daytd">Tue</td><td id="dragarea_57_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-07-05"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-07-05">116045</td><td id="dragarea_57_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-07-05"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-07-05">211472</td><td id="dragarea_57_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-07-05"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-07-05">-629173</td><td class="totalofrow">-301656.00</td></tr><tr class="budrow " id="dragrow_58" date="2022-07-04">
  <td class="tf_datetd" title="2022-07-04" scope="row">04</td>
  <td class="tf_daytd">Mon</td><td id="dragarea_58_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-07-04"><span class="daytotal">100000</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item dragtemplate incom" aria-current="true" id="tf_item_932" draggable="true" ondragstart="drag(event)" template="2218352" type="1" onekeydown="tf_keyhandler(event)" frequency="0" ordered="1">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Беру в долг у мюс</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,932);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   short-text" onclick="dbc_opener(this);">
   На восстановление передних рядов зубов</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">+100000</strong>
  <div class="categories"><span class="badge " style="background-color: #9946dd;" category="26"><img class="dd-icon dd-icon-inverted text-white" src="/components/com_teftelebudget/src/Media/icons/recycle-solid.svg" title="Debts"></span></div>
</div>
</div></td><td class="daytotals" for="1" date="2022-07-04">116045</td><td id="dragarea_58_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-07-04"><span class="daytotal">-480</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_951" draggable="true" ondragstart="drag(event)" template="2217806" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Еда в столовой</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,951);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   shortest-text" onclick="dbc_opener(this);">
   За 2 дня</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-480</strong>
  <div class="categories"><span class="badge " style="background-color: #ff0000;" category="32"><img class="dd-icon dd-icon-inverted text-white" src="/components/com_teftelebudget/src/Media/icons/pizza-slice-solid.svg" title="Canteen"></span></div>
</div>
</div></td><td class="daytotals" for="2" date="2022-07-04">211472</td><td id="dragarea_58_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-07-04"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-07-04">-629173</td><td class="totalofrow">-301656.00</td></tr><tr class="budrow  weekend" id="dragrow_59" date="2022-07-03">
  <td class="tf_datetd" title="2022-07-03" scope="row">03</td>
  <td class="tf_daytd">Sun</td><td id="dragarea_59_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-07-03"><span class="daytotal">16000</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item transfered" aria-current="true" id="tf_item_947" draggable="true" ondragstart="drag(event)" type="4" target="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
    <div class="d-flex w-100 align-items-center justify-content-between">
      <strong class="mb-1 namevalue">На зубы</strong>
      <div><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
      </div>
  
    </div>
    <div class="col-12 mb-1 small textvalue
     shortest-text" onclick="dbc_opener(this);">
     </div>
    <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 amountvalue">+16000</strong>
    <div class="categories"></div>
  </div><hr class="mb-1 mt-1"><span class="transferspan">Transfer from </span>SBER CARD</div></td><td class="daytotals" for="1" date="2022-07-03">16045</td><td id="dragarea_59_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-07-03"><span class="daytotal">-16540</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_945" draggable="true" ondragstart="drag(event)" template="2218087" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Продукты</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,945);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   short-text" onclick="dbc_opener(this);">
   Булка, фрукты, капуста, сыр, сода...</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-540</strong>
  <div class="categories"><span class="badge " style="background-color: #905e18;" category="1"><img class="dd-icon dd-icon-inverted text-white" src="/components/com_teftelebudget/src/Media/icons/carrot-solid.svg" title="Grocery"></span></div>
</div>
</div><div class="list-group-item py-1 tf_item transfer" aria-current="true" id="tf_item_946" draggable="true" ondragstart="drag(event)" type="3" target="1" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
    <div class="d-flex w-100 align-items-center justify-content-between">
      <strong class="mb-1 namevalue">На зубы</strong>
      <div><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
      </div>
  
    </div>
    <div class="col-12 mb-1 small textvalue
     shortest-text" onclick="dbc_opener(this);">
     </div>
    <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 amountvalue">-16000</strong>
    <div class="categories"></div>
  </div><hr class="mb-1 mt-1"><span class="transferspan">Transfer to </span>CASH</div></td><td class="daytotals" for="2" date="2022-07-03">211952</td><td id="dragarea_59_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-07-03"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-07-03">-629173</td><td class="totalofrow">-401176.00</td></tr><tr class="budrow  weekend" id="dragrow_60" date="2022-07-02">
  <td class="tf_datetd" title="2022-07-02" scope="row">02</td>
  <td class="tf_daytd">Sat</td><td id="dragarea_60_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-07-02"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-07-02">45</td><td id="dragarea_60_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-07-02"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-07-02">228492</td><td id="dragarea_60_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-07-02"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-07-02">-629173</td><td class="totalofrow">-400636.00</td></tr><tr class="budrow " id="dragrow_61" date="2022-07-01">
  <td class="tf_datetd" title="2022-07-01" scope="row">01</td>
  <td class="tf_daytd">Fri</td><td id="dragarea_61_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-07-01"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-07-01">45</td><td id="dragarea_61_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-07-01"><span class="daytotal">-10600</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_941" draggable="true" ondragstart="drag(event)" template="2212339" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Метро</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,941);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   shortest-text" onclick="dbc_opener(this);">
   </div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-500</strong>
  <div class="categories"><span class="badge " style="background-color: #2196f3;" category="10">Transport</span></div>
</div>
</div><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_942" draggable="true" ondragstart="drag(event)" template="229459" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Еда в столовой</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,942);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   short-text" onclick="dbc_opener(this);">
   Взял дороже и вкусннее</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-100</strong>
  <div class="categories"><span class="badge " style="background-color: #ff0000;" category="32"><img class="dd-icon dd-icon-inverted text-white" src="/components/com_teftelebudget/src/Media/icons/pizza-slice-solid.svg" title="Canteen"></span></div>
</div>
</div><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_944" draggable="true" ondragstart="drag(event)" template="2224601" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Стома</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,944);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   middle-text" onclick="dbc_opener(this);">
   Аванс на изготовление пластиковых нижних и верхних зубов</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-10000</strong>
  <div class="categories"><span class="badge text-dark" style="background-color: #00ffff;" category="16">Medicine</span></div>
</div>
</div></td><td class="daytotals" for="2" date="2022-07-01">228492</td><td id="dragarea_61_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-07-01"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-07-01">-629173</td><td class="totalofrow">-400636.00</td></tr><tr class="bg-subtotal subtotal" date="2022-06-01">
  <td class="" colspan="2"><b><span class="tf-table-monthname">June</span> <span class="stdtyr">2022</span></b></td><td class="mtotalio"><small>Incoms: <span class="incoms">0.00</span></small><br><small>Expenses: <span class="expences">0.00</span></small><br><small>Difference: <span class="difference">0.00</span></small></td>
    <td class="mtotals">Balance: <span class="subtotalbal" date="2022-06-01" foracc="1">45</span></td><td class="mtotalio"><small>Incoms: <span class="incoms">80077.00</span></small><br><small>Expenses: <span class="expences">-25030.00</span></small><br><small>Difference: <span class="difference">55047.00</span></small></td>
    <td class="mtotals">Balance: <span class="subtotalbal" date="2022-06-01" foracc="2">239092</span></td><td class="mtotalio"><small>Incoms: <span class="incoms">0.00</span></small><br><small>Expenses: <span class="expences">-8000.00</span></small><br><small>Difference: <span class="difference">-8000.00</span></small></td>
    <td class="mtotals">Balance: <span class="subtotalbal" date="2022-06-01" foracc="7">-629173</span></td><td class="totalofrow_s"><small>Incoms: <span class="incoms">80077.00</span></small><br><small>Expenses: <span class="expences">-33030.00</span></small><br><small>Expenses: <span class="difference">47047.00</span></small></td></tr><tr class="budrow " id="dragrow_62" date="2022-06-30">
  <td class="tf_datetd" title="2022-06-30" scope="row">30</td>
  <td class="tf_daytd">Thu</td><td id="dragarea_62_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-06-30"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-06-30">45</td><td id="dragarea_62_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-06-30"><span class="daytotal">-135</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_938" draggable="true" ondragstart="drag(event)" template="227495" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Вкусняхи 140</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,938);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   shortest-text" onclick="dbc_opener(this);">
   Соки шоки</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-135</strong>
  <div class="categories"><span class="badge " style="background-color: #b17816;" category="2"><img class="dd-icon dd-icon-inverted text-white" src="/components/com_teftelebudget/src/Media/icons/hamburger-solid.svg" title="Junk Food"></span></div>
</div>
</div></td><td class="daytotals" for="2" date="2022-06-30">239092</td><td id="dragarea_62_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-06-30"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-06-30">-629173</td><td class="totalofrow">-390036.00</td></tr><tr class="budrow " id="dragrow_63" date="2022-06-29">
  <td class="tf_datetd" title="2022-06-29" scope="row">29</td>
  <td class="tf_daytd">Wed</td><td id="dragarea_63_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-06-29"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-06-29">45</td><td id="dragarea_63_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-06-29"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-06-29">239227</td><td id="dragarea_63_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-06-29"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-06-29">-629173</td><td class="totalofrow">-389901.00</td></tr><tr class="budrow " id="dragrow_64" date="2022-06-28">
  <td class="tf_datetd" title="2022-06-28" scope="row">28</td>
  <td class="tf_daytd">Tue</td><td id="dragarea_64_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-06-28"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-06-28">45</td><td id="dragarea_64_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-06-28"><span class="daytotal">-380</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item dragtemplate expend tf-disabled" aria-current="true" id="tf_item_836" draggable="true" ondragstart="drag(event)" template="2217639" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Стома</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,836);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   middle-text" onclick="dbc_opener(this);">
   Заделка вскрывшейся дыры в переднем верхнем втором зубе.</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-7000</strong>
  <div class="categories"><span class="badge text-dark" style="background-color: #00ffff;" category="16">Medicine</span></div>
</div>
</div><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_930" draggable="true" ondragstart="drag(event)" template="2226694" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Метро</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,930);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   shortest-text" onclick="dbc_opener(this);">
   </div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-200</strong>
  <div class="categories"><span class="badge " style="background-color: #2196f3;" category="10">Transport</span></div>
</div>
</div><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_931" draggable="true" ondragstart="drag(event)" template="2217382" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Вкусняхи</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,931);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   shortest-text" onclick="dbc_opener(this);">
   </div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-180</strong>
  <div class="categories"><span class="badge " style="background-color: #b17816;" category="2"><img class="dd-icon dd-icon-inverted text-white" src="/components/com_teftelebudget/src/Media/icons/hamburger-solid.svg" title="Junk Food"></span></div>
</div>
</div></td><td class="daytotals" for="2" date="2022-06-28">239227</td><td id="dragarea_64_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-06-28"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-06-28">-629173</td><td class="totalofrow">-389901.00</td></tr><tr class="budrow " id="dragrow_65" date="2022-06-27">
  <td class="tf_datetd" title="2022-06-27" scope="row">27</td>
  <td class="tf_daytd">Mon</td><td id="dragarea_65_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-06-27"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-06-27">45</td><td id="dragarea_65_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-06-27"><span class="daytotal">-1200</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_596" draggable="true" ondragstart="drag(event)" template="229893" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="1">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Еда в столовой</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,596);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   shortest-text" onclick="dbc_opener(this);">
   </div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-1200</strong>
  <div class="categories"><span class="badge " style="background-color: #ff0000;" category="32"><img class="dd-icon dd-icon-inverted text-white" src="/components/com_teftelebudget/src/Media/icons/pizza-slice-solid.svg" title="Canteen"></span></div>
</div>
</div></td><td class="daytotals" for="2" date="2022-06-27">239607</td><td id="dragarea_65_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-06-27"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-06-27">-629173</td><td class="totalofrow">-389521.00</td></tr><tr class="budrow  weekend" id="dragrow_66" date="2022-06-26">
  <td class="tf_datetd" title="2022-06-26" scope="row">26</td>
  <td class="tf_daytd">Sun</td><td id="dragarea_66_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-06-26"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-06-26">45</td><td id="dragarea_66_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-06-26"><span class="daytotal">-277</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_929" draggable="true" ondragstart="drag(event)" template="2223476" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Вкусняхи</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,929);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   short-text" onclick="dbc_opener(this);">
   Фрукты и продукты / бананы по 60 рублей!</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-277</strong>
  <div class="categories"><span class="badge " style="background-color: #905e18;" category="1"><img class="dd-icon dd-icon-inverted text-white" src="/components/com_teftelebudget/src/Media/icons/carrot-solid.svg" title="Grocery"></span></div>
</div>
</div></td><td class="daytotals" for="2" date="2022-06-26">240807</td><td id="dragarea_66_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-06-26"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-06-26">-629173</td><td class="totalofrow">-388321.00</td></tr><tr class="budrow  weekend" id="dragrow_67" date="2022-06-25">
  <td class="tf_datetd" title="2022-06-25" scope="row">25</td>
  <td class="tf_daytd">Sat</td><td id="dragarea_67_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-06-25"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-06-25">45</td><td id="dragarea_67_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-06-25"><span class="daytotal">-6000</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_834" draggable="true" ondragstart="drag(event)" template="2222220" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="1">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Аренда комнаты</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,834);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   middle-text" onclick="dbc_opener(this);">
   Аренда комнаты в качестве спальни и комнаты для отдыха</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-6000</strong>
  <div class="categories"><span class="badge " style="background-color: #835ba4;" category="8">Rent</span></div>
</div>
</div></td><td class="daytotals" for="2" date="2022-06-25">241084</td><td id="dragarea_67_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-06-25"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-06-25">-629173</td><td class="totalofrow">-388044.00</td></tr><tr class="budrow " id="dragrow_68" date="2022-06-24">
  <td class="tf_datetd" title="2022-06-24" scope="row">24</td>
  <td class="tf_daytd">Fri</td><td id="dragarea_68_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-06-24"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-06-24">45</td><td id="dragarea_68_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-06-24"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-06-24">247084</td><td id="dragarea_68_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-06-24"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-06-24">-629173</td><td class="totalofrow">-382044.00</td></tr><tr class="budrow " id="dragrow_69" date="2022-06-23">
  <td class="tf_datetd" title="2022-06-23" scope="row">23</td>
  <td class="tf_daytd">Thu</td><td id="dragarea_69_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-06-23"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-06-23">45</td><td id="dragarea_69_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-06-23"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-06-23">247084</td><td id="dragarea_69_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-06-23"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-06-23">-629173</td><td class="totalofrow">-382044.00</td></tr><tr class="budrow " id="dragrow_70" date="2022-06-22">
  <td class="tf_datetd" title="2022-06-22" scope="row">22</td>
  <td class="tf_daytd">Wed</td><td id="dragarea_70_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-06-22"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-06-22">45</td><td id="dragarea_70_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-06-22"><span class="daytotal">30893</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item dragtemplate incom" aria-current="true" id="tf_item_597" draggable="true" ondragstart="drag(event)" template="2217290" type="1" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Аванс</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,597);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   shortest-text" onclick="dbc_opener(this);">
   </div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">+31115</strong>
  <div class="categories"><span class="badge " style="background-color: #0065b8;" category="13"><img class="dd-icon dd-icon-inverted text-white" src="/components/com_teftelebudget/src/Media/icons/cash-register-solid.svg" title="Salary"></span></div>
</div>
</div><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_829" draggable="true" ondragstart="drag(event)" template="2219100" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Вкусняхи</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,829);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   shortest-text" onclick="dbc_opener(this);">
   Зефирки и шоколадки</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-92</strong>
  <div class="categories"><span class="badge " style="background-color: #b17816;" category="2"><img class="dd-icon dd-icon-inverted text-white" src="/components/com_teftelebudget/src/Media/icons/hamburger-solid.svg" title="Junk Food"></span></div>
</div>
</div><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_830" draggable="true" ondragstart="drag(event)" template="2223993" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Soda</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,830);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   middle-text" onclick="dbc_opener(this);">
   Решил попробовать новую колу от черноголовки - один в один</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-130</strong>
  <div class="categories"><span class="badge " style="background-color: #b17816;" category="2"><img class="dd-icon dd-icon-inverted text-white" src="/components/com_teftelebudget/src/Media/icons/hamburger-solid.svg" title="Junk Food"></span></div>
</div>
</div></td><td class="daytotals" for="2" date="2022-06-22">247084</td><td id="dragarea_70_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-06-22"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-06-22">-629173</td><td class="totalofrow">-382044.00</td></tr><tr class="budrow " id="dragrow_71" date="2022-06-21">
  <td class="tf_datetd" title="2022-06-21" scope="row">21</td>
  <td class="tf_daytd">Tue</td><td id="dragarea_71_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-06-21"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-06-21">45</td><td id="dragarea_71_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-06-21"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-06-21">216191</td><td id="dragarea_71_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-06-21"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-06-21">-629173</td><td class="totalofrow">-412937.00</td></tr><tr class="budrow " id="dragrow_72" date="2022-06-20">
  <td class="tf_datetd" title="2022-06-20" scope="row">20</td>
  <td class="tf_daytd">Mon</td><td id="dragarea_72_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-06-20"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-06-20">45</td><td id="dragarea_72_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-06-20"><span class="daytotal">-1200</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_595" draggable="true" ondragstart="drag(event)" template="221029" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="1">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Еда в столовой</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,595);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   shortest-text" onclick="dbc_opener(this);">
   </div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-1200</strong>
  <div class="categories"><span class="badge " style="background-color: #ff0000;" category="32"><img class="dd-icon dd-icon-inverted text-white" src="/components/com_teftelebudget/src/Media/icons/pizza-slice-solid.svg" title="Canteen"></span></div>
</div>
</div></td><td class="daytotals" for="2" date="2022-06-20">216191</td><td id="dragarea_72_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-06-20"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-06-20">-629173</td><td class="totalofrow">-412937.00</td></tr><tr class="budrow  weekend" id="dragrow_73" date="2022-06-19">
  <td class="tf_datetd" title="2022-06-19" scope="row">19</td>
  <td class="tf_daytd">Sun</td><td id="dragarea_73_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-06-19"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-06-19">45</td><td id="dragarea_73_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-06-19"><span class="daytotal">-170</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_828" draggable="true" ondragstart="drag(event)" template="229775" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Шаверма</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,828);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   shortest-text" onclick="dbc_opener(this);">
   В пите как всегда</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-170</strong>
  <div class="categories"><span class="badge " style="background-color: #ff0000;" category="32"><img class="dd-icon dd-icon-inverted text-white" src="/components/com_teftelebudget/src/Media/icons/pizza-slice-solid.svg" title="Canteen"></span></div>
</div>
</div></td><td class="daytotals" for="2" date="2022-06-19">217391</td><td id="dragarea_73_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-06-19"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-06-19">-629173</td><td class="totalofrow">-411737.00</td></tr><tr class="budrow  weekend" id="dragrow_74" date="2022-06-18">
  <td class="tf_datetd" title="2022-06-18" scope="row">18</td>
  <td class="tf_daytd">Sat</td><td id="dragarea_74_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-06-18"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-06-18">45</td><td id="dragarea_74_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-06-18"><span class="daytotal">-930</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_827" draggable="true" ondragstart="drag(event)" template="2212083" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Продукты</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,827);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   middle-text" onclick="dbc_opener(this);">
   Бульмени 2 пачки по кг, морковка, капуста,бананы, 2 уп яиц, яблоки, бананы, лимонад</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-930</strong>
  <div class="categories"><span class="badge " style="background-color: #905e18;" category="1"><img class="dd-icon dd-icon-inverted text-white" src="/components/com_teftelebudget/src/Media/icons/carrot-solid.svg" title="Grocery"></span></div>
</div>
</div></td><td class="daytotals" for="2" date="2022-06-18">217561</td><td id="dragarea_74_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-06-18"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-06-18">-629173</td><td class="totalofrow">-411567.00</td></tr><tr class="budrow " id="dragrow_75" date="2022-06-17">
  <td class="tf_datetd" title="2022-06-17" scope="row">17</td>
  <td class="tf_daytd">Fri</td><td id="dragarea_75_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-06-17"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-06-17">45</td><td id="dragarea_75_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-06-17"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-06-17">218491</td><td id="dragarea_75_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-06-17"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-06-17">-629173</td><td class="totalofrow">-410637.00</td></tr><tr class="budrow " id="dragrow_76" date="2022-06-16">
  <td class="tf_datetd" title="2022-06-16" scope="row">16</td>
  <td class="tf_daytd">Thu</td><td id="dragarea_76_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-06-16"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-06-16">45</td><td id="dragarea_76_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-06-16"><span class="daytotal">-800</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_825" draggable="true" ondragstart="drag(event)" template="2215050" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Метро</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,825);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   middle-text" onclick="dbc_opener(this);">
   В метро главная проблема - отсутствие интернета, поэтому нужно читать книги.</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-800</strong>
  <div class="categories"><span class="badge " style="background-color: #2196f3;" category="10">Transport</span></div>
</div>
</div></td><td class="daytotals" for="2" date="2022-06-16">218491</td><td id="dragarea_76_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-06-16"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-06-16">-629173</td><td class="totalofrow">-410637.00</td></tr><tr class="budrow " id="dragrow_77" date="2022-06-15">
  <td class="tf_datetd" title="2022-06-15" scope="row">15</td>
  <td class="tf_daytd">Wed</td><td id="dragarea_77_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-06-15"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-06-15">45</td><td id="dragarea_77_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-06-15"><span class="daytotal">-16000</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item transfer" aria-current="true" id="tf_item_584" draggable="true" ondragstart="drag(event)" type="3" target="7" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
    <div class="d-flex w-100 align-items-center justify-content-between">
      <strong class="mb-1 namevalue">Кредит</strong>
      <div><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
      </div>
  
    </div>
    <div class="col-12 mb-1 small textvalue
     shortest-text" onclick="dbc_opener(this);">
     </div>
    <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 amountvalue">-16000</strong>
    <div class="categories"></div>
  </div><hr class="mb-1 mt-1"><span class="transferspan">Transfer to </span>Credit Debt</div></td><td class="daytotals" for="2" date="2022-06-15">219291</td><td id="dragarea_77_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-06-15"><span class="daytotal">8000</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item transfered" aria-current="true" id="tf_item_585" draggable="true" ondragstart="drag(event)" type="4" target="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
    <div class="d-flex w-100 align-items-center justify-content-between">
      <strong class="mb-1 namevalue">Кредит</strong>
      <div><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
      </div>
  
    </div>
    <div class="col-12 mb-1 small textvalue
     shortest-text" onclick="dbc_opener(this);">
     </div>
    <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 amountvalue">+16000</strong>
    <div class="categories"></div>
  </div><hr class="mb-1 mt-1"><span class="transferspan">Transfer from </span>SBER CARD</div><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_586" draggable="true" ondragstart="drag(event)" template="2219619" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="2">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Кредит 2</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,586);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   shortest-text" onclick="dbc_opener(this);">
   </div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-8000</strong>
  <div class="categories"><span class="badge " style="background-color: #7a6952;" category="30"><img class="dd-icon dd-icon-inverted text-white" src="/components/com_teftelebudget/src/Media/icons/weight-hanging-solid.svg" title="Credit Debts"></span></div>
</div>
</div></td><td class="daytotals" for="7" date="2022-06-15">-629173</td><td class="totalofrow">-409837.00</td></tr><tr class="budrow " id="dragrow_78" date="2022-06-14">
  <td class="tf_datetd" title="2022-06-14" scope="row">14</td>
  <td class="tf_daytd">Tue</td><td id="dragarea_78_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-06-14"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-06-14">45</td><td id="dragarea_78_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-06-14"><span class="daytotal">-1180</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_580" draggable="true" ondragstart="drag(event)" template="2216799" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Еда в столовой</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,580);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   shortest-text" onclick="dbc_opener(this);">
   </div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-1000</strong>
  <div class="categories"><span class="badge " style="background-color: #ff0000;" category="32"><img class="dd-icon dd-icon-inverted text-white" src="/components/com_teftelebudget/src/Media/icons/pizza-slice-solid.svg" title="Canteen"></span></div>
</div>
</div><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_826" draggable="true" ondragstart="drag(event)" template="2212295" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Вкусняхи</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,826);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   shortest-text" onclick="dbc_opener(this);">
   Конфеты итд</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-180</strong>
  <div class="categories"><span class="badge " style="background-color: #b17816;" category="2"><img class="dd-icon dd-icon-inverted text-white" src="/components/com_teftelebudget/src/Media/icons/hamburger-solid.svg" title="Junk Food"></span></div>
</div>
</div></td><td class="daytotals" for="2" date="2022-06-14">235291</td><td id="dragarea_78_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-06-14"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-06-14">-637173</td><td class="totalofrow">-401837.00</td></tr><tr class="budrow " id="dragrow_79" date="2022-06-13">
  <td class="tf_datetd" title="2022-06-13" scope="row">13</td>
  <td class="tf_daytd">Mon</td><td id="dragarea_79_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-06-13"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-06-13">45</td><td id="dragarea_79_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-06-13"><span class="daytotal">-930</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_261" draggable="true" ondragstart="drag(event)" template="2229499" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Масла и лекарства</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,261);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   short-text" onclick="dbc_opener(this);">
   Масла для роста волос и Мирамистин от зуда</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-760</strong>
  <div class="categories"><span class="badge text-dark" style="background-color: #00ffff;" category="16">Medicine</span></div>
</div>
</div><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_824" draggable="true" ondragstart="drag(event)" template="2225020" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="2">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Шаверма</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,824);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   shortest-text" onclick="dbc_opener(this);">
   В пите</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-170</strong>
  <div class="categories"><span class="badge " style="background-color: #ff0000;" category="32"><img class="dd-icon dd-icon-inverted text-white" src="/components/com_teftelebudget/src/Media/icons/pizza-slice-solid.svg" title="Canteen"></span></div>
</div>
</div></td><td class="daytotals" for="2" date="2022-06-13">236471</td><td id="dragarea_79_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-06-13"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-06-13">-637173</td><td class="totalofrow">-400657.00</td></tr><tr class="budrow  weekend" id="dragrow_80" date="2022-06-12">
  <td class="tf_datetd" title="2022-06-12" scope="row">12</td>
  <td class="tf_daytd">Sun</td><td id="dragarea_80_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-06-12"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-06-12">45</td><td id="dragarea_80_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-06-12"><span class="daytotal">-1262</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_820" draggable="true" ondragstart="drag(event)" template="223376" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Вкусняхи</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,820);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   short-text" onclick="dbc_opener(this);">
   Печенье, газ вода 2бут, чипсы, цикорий</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-256</strong>
  <div class="categories"><span class="badge " style="background-color: #905e18;" category="1"><img class="dd-icon dd-icon-inverted text-white" src="/components/com_teftelebudget/src/Media/icons/carrot-solid.svg" title="Grocery"></span></div>
</div>
</div><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_821" draggable="true" ondragstart="drag(event)" template="2220086" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Вкусняхи</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,821);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   short-text" onclick="dbc_opener(this);">
   Печенье, газ вода 2бут, чипсы, цикорий</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-256</strong>
  <div class="categories"><span class="badge " style="background-color: #905e18;" category="1"><img class="dd-icon dd-icon-inverted text-white" src="/components/com_teftelebudget/src/Media/icons/carrot-solid.svg" title="Grocery"></span></div>
</div>
</div><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_822" draggable="true" ondragstart="drag(event)" template="2226055" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Бритва</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,822);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   shortest-text" onclick="dbc_opener(this);">
   </div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-750</strong>
  <div class="categories"><span class="badge " style="background-color: #2196f3;" category="9">Electronic</span></div>
</div>
</div></td><td class="daytotals" for="2" date="2022-06-12">237401</td><td id="dragarea_80_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-06-12"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-06-12">-637173</td><td class="totalofrow">-399727.00</td></tr><tr class="budrow  weekend" id="dragrow_81" date="2022-06-11">
  <td class="tf_datetd" title="2022-06-11" scope="row">11</td>
  <td class="tf_daytd">Sat</td><td id="dragarea_81_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-06-11"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-06-11">45</td><td id="dragarea_81_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-06-11"><span class="daytotal">-820</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_819" draggable="true" ondragstart="drag(event)" template="226356" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Ремень для штанов</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,819);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   long-text" onclick="dbc_opener(this);">
   Старый ремень развалился и рвет футболки, поэтому решил купить новый, это позволит оставить футболки целыми</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-650</strong>
  <div class="categories"><span class="badge text-dark" style="background-color: #c8ff00;" category="17">Clothes</span></div>
</div>
</div><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_823" draggable="true" ondragstart="drag(event)" template="2215385" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Шаверма</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,823);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   shortest-text" onclick="dbc_opener(this);">
   В пите</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-170</strong>
  <div class="categories"><span class="badge " style="background-color: #ff0000;" category="32"><img class="dd-icon dd-icon-inverted text-white" src="/components/com_teftelebudget/src/Media/icons/pizza-slice-solid.svg" title="Canteen"></span></div>
</div>
</div></td><td class="daytotals" for="2" date="2022-06-11">238663</td><td id="dragarea_81_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-06-11"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-06-11">-637173</td><td class="totalofrow">-398465.00</td></tr><tr class="budrow " id="dragrow_82" date="2022-06-10">
  <td class="tf_datetd" title="2022-06-10" scope="row">10</td>
  <td class="tf_daytd">Fri</td><td id="dragarea_82_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-06-10"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-06-10">45</td><td id="dragarea_82_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-06-10"><span class="daytotal">48662</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item dragtemplate incom" aria-current="true" id="tf_item_254" draggable="true" ondragstart="drag(event)" template="2221265" type="1" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Зарплата </strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,254);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   short-text" onclick="dbc_opener(this);">
   Разработка по для заказчиков</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">+48962</strong>
  <div class="categories"><span class="badge " style="background-color: #0065b8;" category="13"><img class="dd-icon dd-icon-inverted text-white" src="/components/com_teftelebudget/src/Media/icons/cash-register-solid.svg" title="Salary"></span></div>
</div>
</div><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_796" draggable="true" ondragstart="drag(event)" template="2224428" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Еда</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,796);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   shortest-text" onclick="dbc_opener(this);">
   Фрукты, батоны, хлеб</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-300</strong>
  <div class="categories"><span class="badge " style="background-color: #bc6a34;" category="27">FOOD</span></div>
</div>
</div></td><td class="daytotals" for="2" date="2022-06-10">239483</td><td id="dragarea_82_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-06-10"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-06-10">-637173</td><td class="totalofrow">-397645.00</td></tr><tr class="budrow " id="dragrow_83" date="2022-06-09">
  <td class="tf_datetd" title="2022-06-09" scope="row">09</td>
  <td class="tf_daytd">Thu</td><td id="dragarea_83_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-06-09"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-06-09">45</td><td id="dragarea_83_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-06-09"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="2" date="2022-06-09">190821</td><td id="dragarea_83_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-06-09"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-06-09">-637173</td><td class="totalofrow">-446307.00</td></tr><tr class="budrow " id="dragrow_84" date="2022-06-08">
  <td class="tf_datetd" title="2022-06-08" scope="row">08</td>
  <td class="tf_daytd">Wed</td><td id="dragarea_84_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-06-08"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-06-08">45</td><td id="dragarea_84_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-06-08"><span class="daytotal">-250</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_795" draggable="true" ondragstart="drag(event)" template="2220408" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Вкусняхи</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,795);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   shortest-text" onclick="dbc_opener(this);">
   На работу</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-250</strong>
  <div class="categories"><span class="badge " style="background-color: #b17816;" category="2"><img class="dd-icon dd-icon-inverted text-white" src="/components/com_teftelebudget/src/Media/icons/hamburger-solid.svg" title="Junk Food"></span></div>
</div>
</div></td><td class="daytotals" for="2" date="2022-06-08">190821</td><td id="dragarea_84_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-06-08"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-06-08">-637173</td><td class="totalofrow">-446307.00</td></tr><tr class="budrow " id="dragrow_85" date="2022-06-07">
  <td class="tf_datetd" title="2022-06-07" scope="row">07</td>
  <td class="tf_daytd">Tue</td><td id="dragarea_85_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-06-07"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-06-07">45</td><td id="dragarea_85_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-06-07"><span class="daytotal">-1000</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_592" draggable="true" ondragstart="drag(event)" template="2215494" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Еда в столовой</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,592);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   shortest-text" onclick="dbc_opener(this);">
   </div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-1000</strong>
  <div class="categories"><span class="badge " style="background-color: #ff0000;" category="32"><img class="dd-icon dd-icon-inverted text-white" src="/components/com_teftelebudget/src/Media/icons/pizza-slice-solid.svg" title="Canteen"></span></div>
</div>
</div></td><td class="daytotals" for="2" date="2022-06-07">191071</td><td id="dragarea_85_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-06-07"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-06-07">-637173</td><td class="totalofrow">-446057.00</td></tr><tr class="budrow " id="dragrow_86" date="2022-06-06">
  <td class="tf_datetd" title="2022-06-06" scope="row">06</td>
  <td class="tf_daytd">Mon</td><td id="dragarea_86_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-06-06"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-06-06">45</td><td id="dragarea_86_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-06-06"><span class="daytotal">-210</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_794" draggable="true" ondragstart="drag(event)" template="2220950" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Еда в столовой</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,794);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   short-text" onclick="dbc_opener(this);">
   Шаверма и вода с газом</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-210</strong>
  <div class="categories"><span class="badge " style="background-color: #ff0000;" category="32"><img class="dd-icon dd-icon-inverted text-white" src="/components/com_teftelebudget/src/Media/icons/pizza-slice-solid.svg" title="Canteen"></span></div>
</div>
</div></td><td class="daytotals" for="2" date="2022-06-06">192071</td><td id="dragarea_86_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-06-06"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-06-06">-637173</td><td class="totalofrow">-445057.00</td></tr><tr class="budrow  weekend" id="dragrow_87" date="2022-06-05">
  <td class="tf_datetd" title="2022-06-05" scope="row">05</td>
  <td class="tf_daytd">Sun</td><td id="dragarea_87_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-06-05"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-06-05">45</td><td id="dragarea_87_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-06-05"><span class="daytotal">-364</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_790" draggable="true" ondragstart="drag(event)" template="221250" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Чипсы</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,790);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   short-text" onclick="dbc_opener(this);">
   Русская картошка - вкусно жрать</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-60</strong>
  <div class="categories"><span class="badge " style="background-color: #b17816;" category="2"><img class="dd-icon dd-icon-inverted text-white" src="/components/com_teftelebudget/src/Media/icons/hamburger-solid.svg" title="Junk Food"></span></div>
</div>
</div><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_791" draggable="true" ondragstart="drag(event)" template="2226854" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Фрукты</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,791);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   shortest-text" onclick="dbc_opener(this);">
   Фрукты: киви и бананы</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-134</strong>
  <div class="categories"><span class="badge " style="background-color: #905e18;" category="1"><img class="dd-icon dd-icon-inverted text-white" src="/components/com_teftelebudget/src/Media/icons/carrot-solid.svg" title="Grocery"></span></div>
</div>
</div><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_792" draggable="true" ondragstart="drag(event)" template="227941" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Шаверма</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,792);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   shortest-text" onclick="dbc_opener(this);">
   В пите</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-170</strong>
  <div class="categories"><span class="badge " style="background-color: #ff0000;" category="32"><img class="dd-icon dd-icon-inverted text-white" src="/components/com_teftelebudget/src/Media/icons/pizza-slice-solid.svg" title="Canteen"></span></div>
</div>
</div></td><td class="daytotals" for="2" date="2022-06-05">192281</td><td id="dragarea_87_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-06-05"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-06-05">-637173</td><td class="totalofrow">-444847.00</td></tr><tr class="budrow  weekend" id="dragrow_88" date="2022-06-04">
  <td class="tf_datetd" title="2022-06-04" scope="row">04</td>
  <td class="tf_daytd">Sat</td><td id="dragarea_88_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-06-04"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-06-04">45</td><td id="dragarea_88_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-06-04"><span class="daytotal">-800</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_793" draggable="true" ondragstart="drag(event)" template="2215333" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Метро</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,793);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   shortest-text" onclick="dbc_opener(this);">
   </div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-800</strong>
  <div class="categories"><span class="badge " style="background-color: #df2a60;" category="31"><img class="dd-icon dd-icon-inverted text-white" src="/components/com_teftelebudget/src/Media/icons/star-solid.svg" title="Education"></span></div>
</div>
</div></td><td class="daytotals" for="2" date="2022-06-04">192645</td><td id="dragarea_88_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-06-04"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-06-04">-637173</td><td class="totalofrow">-444483.00</td></tr><tr class="budrow " id="dragrow_89" date="2022-06-03">
  <td class="tf_datetd" title="2022-06-03" scope="row">03</td>
  <td class="tf_daytd">Fri</td><td id="dragarea_89_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-06-03"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-06-03">45</td><td id="dragarea_89_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-06-03"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item dragtemplate incom tf-accented" aria-current="true" id="tf_item_589" draggable="true" ondragstart="drag(event)" template="2212476" type="1" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Операция по пересадке волос</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,589);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   long-text" onclick="dbc_opener(this);">
   Вторая операция!<br>Ещё каких-то 8 месяцев и у меня на голове появятся волосы, а к следующему лету я уже буду волосат как кишак...</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">+0</strong>
  <div class="categories"><span class="badge " style="background-color: #0065b8;" category="13"><img class="dd-icon dd-icon-inverted text-white" src="/components/com_teftelebudget/src/Media/icons/cash-register-solid.svg" title="Salary"></span></div>
</div>
</div></td><td class="daytotals" for="2" date="2022-06-03">193445</td><td id="dragarea_89_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-06-03"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-06-03">-637173</td><td class="totalofrow">-443683.00</td></tr><tr class="budrow " id="dragrow_90" date="2022-06-02">
  <td class="tf_datetd" title="2022-06-02" scope="row">02</td>
  <td class="tf_daytd">Thu</td><td id="dragarea_90_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-06-02"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-06-02">45</td><td id="dragarea_90_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-06-02"><span class="daytotal">-5100</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_785" draggable="true" ondragstart="drag(event)" template="2228043" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Еда на 2 месяца</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,785);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   middle-text" onclick="dbc_opener(this);">
   Курица, курочка, 5 пакетов сухого молока, изюм, семки, финики, булочки, Галина, что-то ещё</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-1800</strong>
  <div class="categories"><span class="badge " style="background-color: #905e18;" category="1"><img class="dd-icon dd-icon-inverted text-white" src="/components/com_teftelebudget/src/Media/icons/carrot-solid.svg" title="Grocery"></span></div>
</div>
</div><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_786" draggable="true" ondragstart="drag(event)" template="2214623" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="0">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Гантеля</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,786);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="show" onclick="expandthistext(this);"><i class="bi-eye"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   middle-text" onclick="dbc_opener(this);">
   Сломался и купил гантелю на 20 кило, ибо дошел до 16-ти. Гексагональная с пуфиками</div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-3300</strong>
  <div class="categories"><span class="badge " style="background-color: #870149;" category="24"><img class="dd-icon dd-icon-inverted text-white" src="/components/com_teftelebudget/src/Media/icons/basketball-ball-solid.svg" title="Sport Inventory"></span></div>
</div>
</div></td><td class="daytotals" for="2" date="2022-06-02">193445</td><td id="dragarea_90_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-06-02"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-06-02">-637173</td><td class="totalofrow">-443683.00</td></tr><tr class="budrow " id="dragrow_91" date="2022-06-01">
  <td class="tf_datetd" title="2022-06-01" scope="row">01</td>
  <td class="tf_daytd">Wed</td><td id="dragarea_91_0" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="1" date="2022-06-01"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="1" date="2022-06-01">45</td><td id="dragarea_91_1" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="2" date="2022-06-01"><span class="daytotal">-1500</span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span><div class="list-group-item py-1 tf_item dragtemplate expend" aria-current="true" id="tf_item_781" draggable="true" ondragstart="drag(event)" template="2222837" type="2" onekeydown="tf_keyhandler(event)" frequency="0" ordered="1">
  <div class="d-flex w-100 align-items-center justify-content-between">
    <strong class="mb-1 namevalue">Пцр тест</strong>
    <div>
    <a href="javascript:void(false);" class="fr pl-03rem tf_edittrigger" title="edit" data-bs-toggle="modal" data-bs-target="#EditorWindow" onclick="tf_edit(1,781);"><i class="bi-pencil-square"></i></a><a href="javascript:void(false);" class="fr pl-03rem" title="remove"><i class="bi-trash-fill" onclick="tf_deletethisitem(this);"></i></a>
    </div>

  </div>
  <div class="col-12 mb-1 small textvalue
   shortest-text" onclick="dbc_opener(this);">
   </div>
  <div class="d-flex w-100 align-items-center justify-content-between">
  <strong class="mb-1 amountvalue">-1500</strong>
  <div class="categories"><span class="badge text-dark" style="background-color: #00ffff;" category="16">Medicine</span></div>
</div>
</div></td><td class="daytotals" for="2" date="2022-06-01">198545</td><td id="dragarea_91_2" class="droptabledata" ondrop="drop(event)" ondragover="allowDrop(event)" acc="7" date="2022-06-01"><span class="daytotal"></span><span class="rect table-button-right" onclick="tf_create(1, this);">
     <i class="bi-plus-lg" title="Add new item" data-bs-toggle="modal" data-bs-target="#EditorWindow">
     </i></span></td><td class="daytotals" for="7" date="2022-06-01">-637173</td><td class="totalofrow">-438583.00</td></tr><tr class="bg-subtotal subtotal" date="2022-05-01">
  <td class="" colspan="2"><b><span class="tf-table-monthname">May</span> <span class="stdtyr">2022</span></b></td><td class="mtotalio"><small>Incoms: <span class="incoms">0</span></small><br><small>Expenses: <span class="expences">0</span></small><br><small>Difference: <span class="difference">0</span></small></td>
    <td class="mtotals">Balance: <span class="subtotalbal" date="2022-05-01" foracc="1">45</span></td><td class="mtotalio"><small>Incoms: <span class="incoms">0</span></small><br><small>Expenses: <span class="expences">0</span></small><br><small>Difference: <span class="difference">0</span></small></td>
    <td class="mtotals">Balance: <span class="subtotalbal" date="2022-05-01" foracc="2">200045</span></td><td class="mtotalio"><small>Incoms: <span class="incoms">0</span></small><br><small>Expenses: <span class="expences">0</span></small><br><small>Difference: <span class="difference">0</span></small></td>
    <td class="mtotals">Balance: <span class="subtotalbal" date="2022-05-01" foracc="7">-637173</span></td><td class="totalofrow_s"><small>Incoms: <span class="incoms">0</span></small><br><small>Expenses: <span class="expences">0</span></small><br><small>Expenses: <span class="difference">0</span></small></td></tr>  </tbody>
  </table>
    <div class="container">
    <div class="alert alert-info" role="alert">  
      Press SHIFT before you start draging an Event to make a copy of event    </div>
    <div class="alert alert-info" role="alert">  
      This section uses Nestable.JS which implements five-level nesting of items. At the moment this functionality is redundant, but in the future I will definetly figure out how to use it with the greatest benefit for the user.    </div>
  </div>
</div>
  


  </div>
  </div>

@endsection