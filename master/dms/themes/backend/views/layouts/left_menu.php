<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="<?= Snl::app()->baseUrl() ?>admin/dashboard/index" target="_blank">
        <img src="<?= Snl::app()->config()->theme_url ?>assets_soft/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">ITS | DMS</span>

      </a>
    </div>
    <p class="px-4 text-secondary text-sm">Hi, <?= Snl::app()->user()->fullname ?></p clas="my-3">
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link<?= $module == "dashboard" ? " active" : ""; ?>" href="<?= Snl::app()->baseUrl() ?>admin/dashboard/index">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-clock-o text-sm opacity-6 <?= $module == "dashboard" ? " text-white" : "text-dark"; ?>"></i>
            </div>
            <span class="nav-link-text ms-1">Recent</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link<?= $module == "files" ? " active" : ""; ?>" href="<?= Snl::app()->baseUrl() ?>admin/files/index">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-folder-o text-sm opacity-6 <?= $module == "files" ? " text-white" : "text-dark"; ?>"></i>
            </div>
            <span class="nav-link-text ms-1">Files</span>
          </a>
        </li>
        <?php if(Snl::app()->user()->is_superadmin) : ?>
        <li class="nav-item">
          <a class="nav-link<?= $module == "user" ? " active" : ""; ?>" href="<?= Snl::app()->baseUrl() ?>admin/user/index">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-users text-sm opacity-6 <?= $module == "user" ? " text-white" : "text-dark"; ?>"></i>
            </div>
            <span class="nav-link-text ms-1">Users</span>
          </a>
        </li>
        <?php endif; ?>
      </ul>
    </div>
  </aside>