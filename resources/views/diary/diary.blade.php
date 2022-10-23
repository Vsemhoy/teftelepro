@extends('Template.shell')

@section('page-content')

    <?php
    use App\Http\Controllers\Controller;
    use Illuminate\Foundation\Auth\User;
    use App\Http\Controllers\Components\Diary\DiaryTemplates;
    // $instant  = new Controller();
    // echo $instant->renderValue();

    // $results = DB::select('select * from splmod_users where id < ?', [10]);
    // foreach($results AS $key => $value){
    //     print_r($value);
    //     echo "<br>";
    // }
    $component = Controller::getComponent('diary');
    $user = User::where('id', '=', session('LoggedUser'))->first();
    ?>



    <div class="content p-3 pt-0 bg-white">
      <!-- <h1><?php echo $component->name; ?></h1> -->
      
      
      

      <a class="uk-button uk-button-default" href="#modal-full" uk-toggle>Open</a>

<div id="modal-full" class="uk-modal-full" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
        <div class="" style="min-height: 100vh;">
          <?php echo DiaryTemplates::renderLupoEditor(); ?>
        </div>
        <!-- <div class="uk-grid-collapse" uk-grid>
            <div class="uk-background-cover" style="background-image: url('images/photo.jpg');" uk-height-viewport></div>
            <div class="uk-padding-large">
                <h1>Headline</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
        </div> -->
    </div>
</div>




@endsection