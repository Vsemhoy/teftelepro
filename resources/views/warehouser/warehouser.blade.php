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
      $component = Controller::getComponent('home');
    ?>



    <div class="content p-3 pt-0">
      <h1><?php echo $component->name; ?></h1>
      <!-- end of content -->
    </div>

@endsection