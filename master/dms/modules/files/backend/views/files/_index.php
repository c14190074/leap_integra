<?php if($model != NULL) : ?>
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
                    echo  "<img class='w-100 pe-2' src='".Snl::app()->baseUrl()."uploads/pdflogo_list.png' />";
                  } else if($folder->format == "doc" || $folder->format == "docx" || $folder->format == "docs") {
                    // echo "<i class='fa fa-file-word-o opacity-6 text-dark me-3'></i>";
                    echo  "<img class='w-100 pe-2' src='".Snl::app()->baseUrl()."uploads/wordlogo_list.png' />";
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

                <?php
                  if($is_search_result) {
                    echo $folder->getLocation();
                  }
                ?>

              </h6>
            </div>
          </div>
        </td>


        <td>
          <p class="text-xs text-secondary mb-0"><?= $folder->perihal ?></p>
        </td>

        <td>
          <p class="text-xs text-secondary mb-0"><?= $folder->nomor ?></p>
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

        <td class="align-middle text-center text-sm">
          <p class="text-xs text-secondary mb-0"><?= date('d M Y h:i:s', strtotime($folder->updated_on)) ?></p>
        </td>
      </tr>
  <?php endif; endforeach; ?>
<?php else : ?>
    <tr>
        <td colspan="5"><p class="text-sm text-secondary ps-2">No file or folder</p></td>
    </tr>

<?php endif; ?>