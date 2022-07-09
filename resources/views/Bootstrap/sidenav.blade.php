<?php 
  use App\Http\Controllers\Controller;
  use Illuminate\Support\Facades\Route;
  $routed = Route::currentRouteName();
  $component = Controller::getComponent($routed);
?>
<nav id="sidebarMenu" class="col-sidenav d-md-block nav-bg sidebar collapse p0">
      <div class="position-sticky pt-3">

        <?php if (isset($component->sideMenu)): ?>
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
                <span class="badger <?php echo $item->badgeClass; ?>"></span>
              <?php }; ?>
              <span class="icon-square">
              <?php 
              if ($item->itemIcon != "")
              {
                echo "<i class='" . $item->itemIcon . "' role='img' aria-label='" . $item->itemLetters . "'></i>";
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
                <span class="badge rounded-pill text-bg-light fr fs-smaller <?php echo $item->badgeClass; ?>"><?php echo $item->itemBadge; ?></span>
              <?php }; ?>
            </a>
          </li>
          <?php
            } else {
              ?>
              </ul>
              <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                <span class="nav-divider-text"><?php echo $item->itemName; ?></span>
                <span class="nav-divider-icon"><?php echo "<i class='" . $item->itemIcon . "' role='img' aria-label='" . $item->itemLetters . "'></i>"; ?></span>
              </h6>
              <ul class="nav flex-column">
              <?php
            };
          };
          ?>
        </ul>
          <?php endif; ?>




       

      </div>
    </nav>

    <div id="navRail" class="nav-rail">
    </div>