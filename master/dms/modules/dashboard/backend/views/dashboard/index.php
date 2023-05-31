<?php
    echo $toolbar;
    echo Snl::app()->getFlashMessage();
?>

<div class="row">
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="mb-0">Aktivitas</h6>
                    </div>
                   
                </div>
            </div>

            <div class="card-body p-3 pt-0">
                <?php if($logs == NULL) : ?>
                    <p class="text-sm text-secondary">Tidak ada aktivitas</p>
                <?php else : ?>
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                          <tbody>
                            <?php foreach($logs as $log) : ?>
                                <?php
                                    $log_created = User::model()->findByPk($log->created_by);
                                ?>
                                <tr>
                                    <td class="text-center link-info" style="font-size: 2rem;">
                                        <span><i class="fa fa-user-o"></i></span>
                                    </td>
                                    <td>
                                        <p class="text-dark text-sm mb-1 token important" style="color: #000;"><?= ucwords(strtolower($log_created->fullname)) ?></p>
                                        <p class="text-secondary text-xs mb-2"><?= date('d M Y h:i:s', strtotime($log->created_on)) ?></p>
                                        <p class="text-xs mb-0"><?= $log->description ?></p>
                                    </td>
                                </tr>

                            <?php endforeach;?>
                          </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="mb-0">Shared Folder</h6>
                    </div>
                    
                </div>
            </div>

            <div class="card-body p-3 pt-0">
                <?php if($folders == NULL || !Folder::hasSharedFolder(Snl::app()->user()->user_id)) : ?>
                    <p class="text-sm text-secondary pt-2">Tidak ada folder</p>
                <?php else : ?>
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                          <tbody>
                            <?php foreach($folders as $folder) : ?>
                                <?php if($folder->hasAccess()) : ?>
                                    <?php $folder_created = User::model()->findByPk($folder->created_by); ?>
                                    <tr>
                                        <td class="text-center link-info" style="font-size: 2rem;">
                                            <span><i class="fa fa-folder"></i></span>
                                        </td>
                                        <td>
                                            <p class="text-dark text-sm mb-1 token important" style="color: #000;">
                                                <a href="<?= Snl::app()->baseUrl() ?>admin/files/index?folder=<?= SecurityHelper::encrypt($folder->folder_id) ?>">
                                                    <?= $folder->name ?>
                                                </a>    
                                            </p>

                                            <p class="text-xs mb-0">
                                                <span class="text-secondary">Dibuat oleh <span>
                                                <span class="text-dark"><?= ucwords(strtolower($folder_created->fullname)).' ('.$folder_created->email.')' ?></span>
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-secondary text-xs mb-2">
                                                <?= date('d M Y h:i:s', strtotime($folder->created_on)) ?>
                                            </p>
                                        </td>
                                    </tr>
                                <?php endif;?>
                            <?php endforeach;?>
                          </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<hr />

<div class="row">
    <div class="col-md-12">
        <div class="card h-100">
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="mb-0">Recent Files</h6>
                    </div>
                    
                </div>
            </div>

            <div class="card-body p-3 pt-0" id="folder_list">

              <?php if($recents == NULL) : ?>
                <p class="text-sm text-secondary pt-2">Tidak ada file</p>
              <?php else : ?>    

              <div class="table-responsive">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Unit Kerja</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nomor</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Perihal</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Terakhir Dilihat</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php foreach($recents as $recent) : ?>
                        <?php $model = Folder::model()->findByPk($recent->file_target_id); ?>

                        <?php if($model->hasAccess()) : ?>

                          <?php
                            $user_created = User::model()->findByPk($model->created_by);
                            $user_updated = User::model()->findByPk($model->updated_by);
                          ?>

                          <tr>
                            <td>
                              <div class="d-flex px-2 py-1">
                                <div>
                                  <?php
                                    if($model->type == "file") {
                                      if($model->format == "pdf") {
                                        echo  "<img class='w-100 pe-2' src='".Snl::app()->baseUrl()."uploads/pdflogo_list.png' />";
                                      } else if($model->format == "doc" || $model->format == "docx" || $model->format == "docs") {
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
                                    <?php if($model->type == "folder") : ?>
                                      <a href="<?= Snl::app()->baseUrl() ?>admin/files/index?folder=<?= SecurityHelper::encrypt($model->folder_id) ?>"><?= $model->name ?></a>

                                    <?php else : ?>
                                      <p class="text-sm mb-0 show-right-slider" role="button" data-action="viewfile" data-folder-id="<?= SecurityHelper::encrypt($model->folder_id) ?>">
                                        <?= $model->name ?>
                                      </p>

                                    <?php endif; ?>

                                    <?php if($model->isTheOwner() && $model->type == "folder") : ?>
                                      
                                      <i role="button" class="fa fa-info-circle text-secondary text-xxs ms-1 show-right-slider" data-action="folderdetail" data-folder-id="<?= SecurityHelper::encrypt($model->folder_id) ?>"></i>

                                    <?php endif; ?>
                                  </h6>
                                </div>
                              </div>
                            </td>

                            <td>
                              <p class="text-xs text-secondary mb-0"><?= $model->nomor ?></p>
                            </td>

                            <td>
                              <p class="text-xs text-secondary mb-0"><?= $model->name ?></p>
                            </td>

                            
                            <td class="align-middle text-center text-sm">
                              <p class="text-xs text-secondary mb-0"><?= date('d M Y h:i:s', strtotime($recent->updated_on)) ?></p>
                            </td>
                          </tr>

                        <?php endif; ?>
                      <?php endforeach; ?>

                  </tbody>
                </table>
              </div> <!-- end of table-responsive -->
              <?php endif; ?>
            </div> <!-- end of card -->
        </div> <!-- card h-100 -->
        
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        

    });
</script>