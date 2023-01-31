<?php
    echo $toolbar;
    echo Snl::app()->getFlashMessage();
    // print_r($GLOBALS['parentfolderid']);
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

<?php if($model == NULL) : ?>
  <p class="text-sm text-secondary p-3">No file or folder</p>
<?php endif; ?>

<?php if($model != NULL) : ?>
<div class="card" id="folder_list">
  <div class="table-responsive">
    <table class="table align-items-center mb-0">
      <thead>
        <tr>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Folder</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Deskripsi</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">User Akses</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Created By</th>
          <!-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Updated By</th> -->
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
                    <i class="fa fa-folder opacity-6 link-info me-3"></i>
                  </div>
                  <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-secondary text-sm text-dark">
                      <a href="<?= Snl::app()->baseUrl() ?>admin/files/index?folder=<?= SecurityHelper::encrypt($folder->folder_id) ?>"><?= $folder->name ?></a>

                      <?php if($folder->isTheOwner()) : ?>
                        <i role="button" class="fa fa-pencil text-secondary text-xxs ms-1 edit-folder" data-folder-id="<?= SecurityHelper::encrypt($folder->folder_id) ?>"></i>
                        <i role="button" class="fa fa-trash text-secondary text-xxs ms-1 delete-folder" data-folder-id="<?= SecurityHelper::encrypt($folder->folder_id) ?>"></i>
                      <?php endif; ?>
                    </h6>
                  </div>
                </div>
              </td>

              <td>
                <p class="text-xs text-secondary mb-0"><?= $folder->description ?></p>
              </td>

              <td>
                <p class="text-xs text-secondary mb-0">
                  <?php
                    if($folder->user_access != NULL) {
                      $user_email = array();
                      $user_access = json_decode($folder->user_access);
                      foreach($user_access as $id) {
                        $user_access_model = User::model()->findByPk($id);
                        array_push($user_email, $user_access_model->email);
                      }

                      array_push($user_email, $user_created->email);
                      
                      echo implode( ", ", $user_email);
                    } else {
                      echo "Only you";
                    }
                  ?>

                </p>
              </td>

              <td>
                <p class="text-xs font-weight-bold mb-0"><?= $user_created->fullname ?></p>
                <p class="text-xs text-secondary mb-0"><?= $user_created->email ?></p>
              </td>

              <td class="align-middle text-center text-sm">
                <p class="text-xs text-secondary mb-0"><?= date('d M Y h:i', strtotime($user_updated->updated_on)) ?></p>
              </td>
            </tr>
        <?php endif; endforeach; ?>
        
      </tbody>
    </table>
  </div>
</div>
<?php endif; ?>

<script type="text/javascript">
    $(document).ready(function() {
      if($("#folder_parent_name").val() != "") {
        $("#page_subtitle").html($("#folder_parent_name").val());
      }

    });
</script>