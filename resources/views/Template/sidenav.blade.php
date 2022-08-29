<?php 
  use App\Http\Controllers\Controller;
  use Illuminate\Support\Facades\Route;

  $routed = explode('.', Route::currentRouteName())[0];
  $section = "";
  if (isset(explode('.', Route::currentRouteName())[1])){
    $section = explode('.', Route::currentRouteName())[1];
  };
?>
<nav id="sidebarMenu" class="col-sidenav uk-background-muted">
      <div class="position-sticky pt-3" >
      <a class="uk-navbar-toggle " id="leftSidenavToggler2" style="justify-items: none;">
      <div class="uk-width-1-1 " style="padding: 3px;">
            <span uk-navbar-toggle-icon ></span>
</div>
        </a>
        <?php if (isset($component->sideMenu)): ?>
          <br>
        <ul class="nav flex-column">
          <?php 
          foreach ($component->sideMenu AS $item)
          {
            if (!$item->isDivider){
            ?>
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?php echo $item->itemReference; ?>">
              <?php if ($item->itemBadge != "")
              { ?>
                <span class="uk-badge badger <?php echo $item->badgeClass; ?>"></span>
              <?php }; ?>
              <span class="icon-square">
              <?php 
              if ($item->itemIcon != "")
              {
                echo "<i uk-icon='" . $item->itemIcon . "'></i>";
              }
              else 
              {
                echo $item->itemLetters; 
              }
              ?>
              </span>
              <span data-feather="home" class="align-text-bottom"></span>
              <span class="sitem-text">
              <?php echo $item->itemName; ?>
              </span>
              <?php if ($item->itemBadge != "")
              { ?>
                <span class="uk-badge textbadge fs-smaller <?php echo $item->badgeClass; ?>"><?php echo $item->itemBadge; ?></span>
              <?php }; ?>
            </a>
          </li>
          <?php
            } else {
              ?>
              </ul>
              <div class="sidebar-heading uk-padding-x-small uk-text-uppercase uk-text-medium">
                <span class="nav-divider-text"><?php echo $item->itemName; ?></span>
                <span class="nav-divider-icon"><?php echo "<i class='" . $item->itemIcon . "' uk-icon='icon: flickr' title='" . $item->itemLetters . "'></i>"; ?></span>
            </div>
              <ul class="nav flex-column">
              <?php
            };
          };
          ?>
        </ul>
          <?php endif; ?>




       

      </div>
    </nav>

    <div id="navRail"  class="nav-rail">
    </div>