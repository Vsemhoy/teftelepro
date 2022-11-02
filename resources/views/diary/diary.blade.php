@extends('template.shell')

@section('page-content')

    <?php
    use App\Http\Controllers\Controller;
    use Illuminate\Foundation\Auth\User;
    use App\Http\Controllers\Components\Diary\DiaryTemplates;
    use App\Http\Controllers\Components\Gen\TextGen;
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
    <div class='di-main-container uk-container-xlarge'>

      <div class='di-main-navigation'>
        <div class='di-main-grid-header'>
        <span uk-icon="book" class='di-book-icon'>
          </span>
          <span>WorkBook</span>
        </div>
      <div class='di-grpup-list'>
        <div class='di-group-nav-wrapper'>

        <?php 
        for ($i = 0; $i < 7; $i++){   ?>
        <div class='di-group-nav-card di-coox' style='border-right: 6px solid rgb(<?php 
        echo rand(100, 255) . "," . rand(100, 255) ."," . rand(100, 255);
        ?>'>
          <div class='di-group-nav-title'>
          <span uk-icon="chevron-down" class='di-group-expander'>
          </span>
          <span class='di-groupname'>
       <?php echo TextGen::generateRandomString(6); ?>
          </p>
          </div>
          <div class='di-group-nav-list'>
            <ul>
              <li><?php echo TextGen::generateRandomString(6); ?></li>
              <li><?php echo TextGen::generateRandomString(6); ?></li>
              <li><?php echo TextGen::generateRandomString(6); ?></li>
              <li><?php echo TextGen::generateRandomString(6); ?></li>
              <li><?php echo TextGen::generateRandomString(6); ?></li>
            </ul>
          </div>
        </div>
          <?php }; ?>

      </div>
    </div>

      </div>
      
      <div class='di-main-content'>
      <div class='di-main-grid-header'>
          <span> HOHO </span>
        </div>
        <div class='di-card-list'>
        <?php for ($i = 0 ; $i < 20; $i++){
          echo "
          <div class='uk-card uk-card-default uk-card-small 
          uk-box-shadow-medium uk-box-shadow-hover-large uk-margin-bottom'>
    <div class='uk-card-header'>
        <div class='uk-grid-small uk-flex-middle' uk-grid>
            <div class='uk-width-auto'>
                <img class='uk-border-circle' width='40' height='40' src='https://avatars.mds.yandex.net/i?id=acb9efc43f8bc6563e9a54395559216c_l-4599550-images-thumbs&ref=rim&n=13&w=640&h=640' alt='Avatar'>
            </div>
            <div class='uk-width-expand'>
                <h3 class='uk-card-title uk-margin-remove-bottom'>Title</h3>
                <p class='uk-text-meta uk-margin-remove-top'><time datetime='2016-04-01T19:00'>April 01, 2016</time></p>
            </div>
        </div>
    </div>
    <div class='uk-card-body'>
        <p>" . TextGen::generateRandomString(200) . "</p>
    </div>
    <div class='uk-card-footer'>
        <a href=H#' class='uk-button uk-button-text'>Read more</a>
    </div>
</div>";
        }; 
        ?>
        
      </div>
      </div>
      <div class='di-main-filters'>
      <div class='di-main-grid-header'>
          <span> HOHO </span>
        </div>
        <?php echo TextGen::generateRandomString(200); ?>

      </div>
    </div> 


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


<script>

  let groupex = document.querySelectorAll('.di-group-expander');
  for (let i = 0; i < groupex.length; i++){
    groupex[i].addEventListener('click', function(){

    let it = groupex[i].parentNode.parentNode;
    if (it.classList.contains('di-coox')){
      it.classList.remove('di-coox');
    } else {
      
      it.classList.add('di-coox');
    }
  });
 }

</script>

@endsection