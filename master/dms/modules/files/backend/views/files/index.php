<?php
    echo $toolbar;
    echo Snl::app()->getFlashMessage();
    //SecurityHelper::encrypt

?>

<input type="hidden" id="folder_parent_name" value="<?= $folder_parent != NULL ? ucwords(strtolower($folder_parent->name)) : '' ?>" />

<?php if($model == NULL) : ?>
  <p class="text-sm text-secondary p-3">No file or folder</p>
<?php endif; ?>

<?php if($model != NULL) : ?>
<div class="card" id="folder-list">
  <div class="table-responsive">
    <table class="table align-items-center mb-0">
      <thead>
        <tr>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Folder</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Deskripsi</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Created By</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Updated By</th>
          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Last Updated</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($model as $folder) : ?>
            <?php
              $user_created = User::model()->findByPk($folder->created_by);
              $user_updated = User::model()->findByPk($folder->updated_by);
            ?>
            <tr>
              <td>
                <div class="d-flex px-2 py-1">
                  <div>
                    <i class="fa fa-folder opacity-6 text-dark me-3"></i>
                  </div>
                  <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-secondary text-sm text-dark"><a href="<?= Snl::app()->baseUrl() ?>admin/files/index?folder=<?= SecurityHelper::encrypt($folder->folder_id) ?>"><?= $folder->name ?></a></h6>
                  </div>
                </div>
              </td>

              <td>
                <p class="text-xs text-secondary mb-0"><?= $folder->description ?></p>
              </td>

              <td>
                <p class="text-xs font-weight-bold mb-0"><?= $user_created->fullname ?></p>
                <p class="text-xs text-secondary mb-0"><?= $user_created->email ?></p>
              </td>

              <td>
                <p class="text-xs font-weight-bold mb-0"><?= $user_updated->fullname ?></p>
                <p class="text-xs text-secondary mb-0"><?= $user_updated->email ?></p>
              </td>

              <td class="align-middle text-center text-sm">
                <p class="text-xs text-secondary mb-0"><?= date('d M Y h:i', strtotime($user_updated->updated_on)) ?></p>
              </td>
            </tr>
        <?php endforeach; ?>
        
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