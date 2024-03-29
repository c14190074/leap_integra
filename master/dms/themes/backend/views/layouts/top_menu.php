<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
<!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">DMS</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><?= ucwords(strtolower($module)); ?></li>
          </ol>
          <?php if($module == "user" && $action == "profile") : ?>
            <h6 class="font-weight-bolder mb-0" id="page_subtitle"><?= ucwords(strtolower($action)); ?></h6>
          <?php else : ?>
            <h6 class="font-weight-bolder mb-0" id="page_subtitle"><?= ucwords(strtolower($module)); ?></h6>
          <?php endif; ?>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center" style="opacity: 0;">
            <div class="input-group">
              <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="Type here...">
            </div>
          </div>
          <ul class="navbar-nav justify-content-end">
            
           
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>

            <?php if($module == 'user') : ?>
            <li class="nav-item d-flex align-items-center p-2">
              <a href="<?= Snl::app()->baseUrl() ?>admin/user/create" class="nav-link text-body">
                <i class="fa fa-user-plus me-sm-1"></i>
                <span class="d-sm-inline d-none">User</span>
              </a>
            </li>
            <?php endif; ?>

            <?php if($module == 'form') : ?>
            <li class="nav-item d-flex align-items-center p-2">
              <a href="<?= Snl::app()->baseUrl() ?>admin/form/create" class="nav-link text-body">
                <i class="fa fa-file-text-o me-sm-1"></i>
                <span class="d-sm-inline d-none">Form</span>
              </a>
            </li>
            <?php endif; ?>

            <li class="nav-item d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" data-bs-toggle="modal" data-bs-target="#modal-upload-form">
                <i class="fa fa-upload me-sm-1"></i>
                <span class="d-sm-inline d-none">Upload</span>
              </a>
            </li>

            <li class="nav-item d-flex px-3 align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" data-bs-toggle="modal" data-bs-target="#modal-form">
                <i class="fa fa-folder-plus me-sm-1"></i>
                <span class="d-sm-inline d-none">Folder</span>
              </a>
            </li>
            
            <li class="nav-item dropdown d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                <span class="d-sm-inline d-none">Pengaturan</span>
              </a>
              <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="<?= Snl::app()->baseUrl() ?>admin/user/profile">
                    <div class="d-flex py-1">
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <p class="text-sm mb-0 ">
                            <i class="fa fa-user me-1"></i>
                            Profile User
                          </p>
                        </h6>
                      </div>
                    </div>
                  </a>
                </li>
                 <?php if(Snl::app()->user()->is_superadmin) : ?>
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="<?= Snl::app()->baseUrl() ?>admin/perusahaan/profile">
                    <div class="d-flex py-1">
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <p class="text-sm mb-0 ">
                            <i class="fa fa-user me-1"></i>
                            Profile Perusahaan
                          </p>
                        </h6>
                      </div>
                    </div>
                  </a>
                </li>
                <?php endif; ?>
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="<?= Snl::app()->baseUrl() ?>admin/user/logout">
                    <div class="d-flex py-1">
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <p class="text-sm mb-0 ">
                            <i class="fa fa-power-off me-1"></i>
                            Logout
                          </p>
                        </h6>
                      </div>
                    </div>
                  </a>
                </li>
          
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->