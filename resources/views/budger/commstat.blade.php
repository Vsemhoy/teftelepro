@extends('template.shell')
<?php
    use App\Http\Controllers\Controller;
    use App\Http\Controllers\Components\Budger\BudgerMain;
    use App\Http\Controllers\Components\Budger\BudgerData;
    use App\Http\Controllers\Components\Budger\BudgerTemplates;
    use Illuminate\Foundation\Auth\User;


    $user = User::where('id', '=', session('LoggedUser'))->first();

    $currencies = null;
    $accounts = null;
    $totals = null;
    if (!empty($user)){
      //$currencies = BudgerData::LoadCurrencies_keyId($user->id);
      $accounts = BudgerData::LoadAccountList_Currency_keyId($user->id);
      $totals = BudgerData::LoadAllTotalsByCurrency($user->id, $accounts);
    }
    ?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript" src="/js/themes/gray.js"></script>
@section('page-content')
  <div class="uk-section uk-section-primary uk-padding-small">
      <div class="uk-container uk-container-small uk-light">
      <h3>Totals</h3>
    </div>
  </div>

<?php
foreach ($accounts AS $account){
  ?>
<div id="container_<?php echo $account->id; ?>" style="width:100%; height:400px;"></div>
<script>
Highcharts.chart('container_<?php echo $account->id; ?>', {
  chart: {
    type: 'areaspline'
  },
  title: {
    text: '<?php echo $account->name; ?>'
  },
  subtitle: {
    align: 'center',
    text: 'Source: <a href="https://www.ssb.no/jord-skog-jakt-og-fiskeri/jakt" target="_blank">SSB</a>'
  },
  legend: {
    layout: 'vertical',
    align: 'left',
    verticalAlign: 'top',
    x: 120,
    y: 70,
    floating: true,
    borderWidth: 1,
    backgroundColor:
      Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF'
  },
  xAxis: {
    type: 'category',
    uniqueNames: true
},
  yAxis: {
    title: {
      text: 'Quantity'
    }
  },
  tooltip: {
    shared: true,
    headerFormat: '<b><?php echo $account->name; ?></b><br>'
  },
  credits: {
    enabled: false
  },
  plotOptions: {
    series: {
      pointStart: 2022
    },
    areaspline: {
      fillOpacity: 0.5
    }
  },
  series: [
    {
    name: 'Balance',
    data:
    <?php
    echo " [";
    foreach ($totals AS $item){
      if ($item->account == $account->id){
        $dat = explode("-", $item->setdate);
      echo " {";
      echo "'name': '" . $dat[0] . "-" . $dat[1] .  "',";
      echo "'y': " . $item->value . ",";
      echo "'drilldown': '" . $item->value . "'";
      echo "},";
    }
  };
    echo "]";
    ?>
  }, 
  {
    name: 'Difference',
    data:
    <?php
    echo " [";
    foreach ($totals AS $item){
      if ($item->account == $account->id){
        $dat = explode("-", $item->setdate);
      echo " {";
      echo "'name': '" . $dat[0] . "-" . $dat[1] .  "',";
      echo "'y': " . $item->monthdiff . ",";
      echo "'drilldown': '" . $item->value . "'";
      echo "},";
    }
  };
    echo "]";
    ?>
  },
  {
    name: 'Incomes',
    data:
    <?php
    echo " [";
    foreach ($totals AS $item){
      if ($item->account == $account->id){
        $dat = explode("-", $item->setdate);
      echo " {";
      echo "'name': '" . $dat[0] . "-" . $dat[1] .  "',";
      echo "'y': " . $item->incomes . ",";
      echo "'drilldown': '" . $item->value . "'";
      echo "},";
    }
  };
    echo "]";
    ?>
  },
  {
    name: 'Expenses',
    data:
    <?php
    echo " [";
    foreach ($totals AS $item){
      if ($item->account == $account->id){
        $dat = explode("-", $item->setdate);
      echo " {";
      echo "'name': '" . $dat[0] . "-" . $dat[1] .  "',";
      echo "'y': " . $item->expenses . ",";
      echo "'drilldown': '" . $item->value . "'";
      echo "},";
    }
  };
    echo "]";
    ?>
  },
  <?php if ($account->type == 2){ ?>
  {
    name: 'Percents',
    data:
    <?php
    echo " [";
    foreach ($totals AS $item){
      if ($item->account == $account->id){
        $dat = explode("-", $item->setdate);
      echo " {";
      echo "'name': '" . $dat[0] . "-" . $dat[1] .  "',";
      echo "'y': " . $item->percent . ",";
      echo "'drilldown': '" . $item->value . "'";
      echo "},";
    }
  };
    echo "]";
    ?>
  },
  <?php }; ?>
]
});
</script>

<?php
}
?>
@endsection