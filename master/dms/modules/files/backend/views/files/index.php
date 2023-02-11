<?php
    echo $toolbar;
    echo Snl::app()->getFlashMessage();
?>

<input type="hidden" id="folder_parent_name" value="<?= $folder_parent != NULL ? ucwords(strtolower($folder_parent->name)) : '' ?>" />

<?php if(count($local_breadcrumbs) > 0) : ?>
<nav aria-label="breadcrumb" class="p-3 pt-0">
  <ol class="breadcrumb bg-transparent mb-0 pb-0 px-0 me-sm-6 me-5 pt-0">
    <?php foreach($local_breadcrumbs as $data) : ?>
      <?php if(end($local_breadcrumbs) == $data) : ?>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><?= $data['name'] ?></li>
      <?php else : ?>
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="<?= $data['url'] ?>"><?= $data['name'] ?></a></li>
      <?php endif; ?>
      
    <?php endforeach; ?>    
  </ol>
</nav>
<?php endif; ?>

<div class="row mb-4">
  <div class="col-md-4">
    <div class="input-group">
      <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
      <input type="text" class="form-control" id="input-search" placeholder="Cari file atau folder.." onfocus="focused(this)" onfocusout="defocused(this)">
    </div>  
  </div>

  <div class="col-md-3">
      <button type="button" class="btn btn-primary mb-0" id="advanced-search">Cari disemua folder</button>
  </div>
</div>

<?php if($model == NULL || Folder::countNumberOfFile($model) == 0) : ?>
  <p class="text-sm text-secondary p-3">No file or folder</p>

<?php else : ?>
<div class="card" id="folder_list">
  <div class="table-responsive">
    <table class="table align-items-center mb-0" id="table-data">
      <thead>
        <tr>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Unit Kerja</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nomor</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Perihal</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">User Akses</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Keywords</th>
          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Last Updated</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($model as $folder) : if($folder->hasAccess()) : ?>
            <?php
              $user_created = User::model()->findByPk($folder->created_by);
              $user_updated = User::model()->findByPk($folder->updated_by);
            ?>
            <tr>
              <td>
                <div class="d-flex px-2 py-1">
                  <div>
                    <?php
                      if($folder->type == "file") {
                        if($folder->format == "pdf") {
                          // echo "<i class='fa fa-file-pdf-o opacity-6 text-dark me-3'></i>";
                          echo  "<img class='w-100 pe-2' src='https://localhost/leap_integra/master/dms/uploads/pdflogo_list.png' />";
                        } else if($folder->format == "doc" || $folder->format == "docx" || $folder->format == "docs") {
                          // echo "<i class='fa fa-file-word-o opacity-6 text-dark me-3'></i>";
                          echo  "<img class='w-100 pe-2' src='https://localhost/leap_integra/master/dms/uploads/wordlogo_list.png' />";
                        } else {
                          echo "<i class='fa fa-file opacity-6 text-dark me-3'></i>";
                        }
                      } else {
                        echo "<i class='fa fa-folder opacity-6 link-info me-3'></i>";
                      }
                    ?>
                  </div>
                  
                  <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-secondary text-sm text-dark">
                      <?php if($folder->type == "folder") : ?>
                        <a href="<?= Snl::app()->baseUrl() ?>admin/files/index?folder=<?= SecurityHelper::encrypt($folder->folder_id) ?>"><?= $folder->name ?></a>

                      <?php else : ?>
                        <p class="text-sm mb-0 show-right-slider" role="button" data-action="viewfile" data-folder-id="<?= SecurityHelper::encrypt($folder->folder_id) ?>">
                          <?= $folder->name ?>
                        </p>

                      <?php endif; ?>

                      <?php if($folder->isTheOwner() && $folder->type == "folder") : ?>
                        
                        <i role="button" class="fa fa-info-circle text-secondary text-xxs ms-1 show-right-slider" data-action="folderdetail" data-folder-id="<?= SecurityHelper::encrypt($folder->folder_id) ?>"></i>

                      <?php endif; ?>
                    </h6>
                  </div>
                </div>
              </td>

              <td>
                <p class="text-xs text-secondary mb-0"><?= $folder->nomor ?></p>
              </td>

              <td>
                <p class="text-xs text-secondary mb-0"><?= $folder->name ?></p>
              </td>

              <td style="white-space: normal; max-width: 200px;">
                <p class="text-xs text-secondary mb-0">
                  <?php
                    if($folder->user_access != NULL) {
                      $user_email = array();
                      $user_access = json_decode($folder->user_access);
                      foreach($user_access as $d) {
                        $user_access_model = User::model()->findByPk($d->user);
                        if($folder->type == "file") {
                          $tmp_str = $user_access_model->email . "(".implode(',', $d->role).")";
                          array_push($user_email, $tmp_str);
                        } else {
                          array_push($user_email, $user_access_model->email);
                        }
                        
                      }

                      array_push($user_email, $user_created->email." (owner)");
                      
                      echo implode( ", ", $user_email);
                    } else {
                      echo "Only you";
                    }
                  ?>

                </p>
              </td>

              <td style="white-space: normal; max-width: 200px;">
                <p class="text-xs font-weight-bold mb-0"><?= $folder->keyword ?></p>
              </td>

              <td class="align-middle text-center text-sm">
                <p class="text-xs text-secondary mb-0"><?= date('d M Y h:i:s', strtotime($folder->updated_on)) ?></p>
              </td>
            </tr>
        <?php endif; endforeach; ?>
        
      </tbody>
    </table>
  </div>
</div>
<?php endif; ?>

<hr />




<script type="text/javascript">
    $(document).ready(function() {
      if($("#folder_parent_name").val() != "") {
        $("#page_subtitle").html($("#folder_parent_name").val());
      }

    });
</script>