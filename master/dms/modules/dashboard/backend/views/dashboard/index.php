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
                                        <p class="text-dark text-sm mb-1 token important" style="color: #000;"><?= $log_created->fullname ?></p>
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
        <h6>Recent Files</h6>
        <div class="card">
          <div class="table-responsive">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Project</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Budget</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Completion</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <div class="d-flex px-2">
                      <div>
                        <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/logos/small-logos/logo-spotify.svg" class="avatar avatar-sm rounded-circle me-2">
                      </div>
                      <div class="my-auto">
                        <h6 class="mb-0 text-xs">Spotify</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">$2,500</p>
                  </td>
                  <td>
                    <span class="badge badge-dot me-4">
                      <i class="bg-info"></i>
                      <span class="text-dark text-xs">working</span>
                    </span>
                  </td>
                  <td class="align-middle text-center">
                    <div class="d-flex align-items-center">
                      <span class="me-2 text-xs">60%</span>
                      <div>
                        <div class="progress">
                          <div class="progress-bar bg-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                        </div>
                      </div>
                    </div>
                  </td>

                  <td class="align-middle">
                    <button class="btn btn-link text-secondary mb-0">
                      <i class="fa fa-ellipsis-v text-xs" aria-hidden="true"></i>
                    </button>
                  </td>
                </tr>

                <tr>
                  <td>
                    <div class="d-flex px-2">
                      <div>
                        <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/logos/small-logos/logo-invision.svg" class="avatar avatar-sm rounded-circle me-2">
                      </div>
                      <div class="my-auto">
                        <h6 class="mb-0 text-xs">Invision</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">$5,000</p>
                  </td>
                  <td>
                    <span class="badge badge-dot me-4">
                      <i class="bg-success"></i>
                      <span class="text-dark text-xs">done</span>
                    </span>
                  </td>
                  <td class="align-middle text-center">
                    <div class="d-flex align-items-center">
                      <span class="me-2 text-xs">100%</span>
                      <div>
                        <div class="progress">
                          <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                      </div>
                    </div>
                  </td>

                  <td class="align-middle">
                    <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                      <i class="fa fa-ellipsis-v text-xs" aria-hidden="true"></i>
                    </button>
                  </td>
                </tr>

                <tr>
                  <td>
                    <div class="d-flex px-2">
                      <div>
                        <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/logos/small-logos/logo-jira.svg" class="avatar avatar-sm rounded-circle me-2">
                      </div>
                      <div class="my-auto">
                        <h6 class="mb-0 text-xs">Jira</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">$3,400</p>
                  </td>
                  <td>
                    <span class="badge badge-dot me-4">
                      <i class="bg-danger"></i>
                      <span class="text-dark text-xs">canceled</span>
                    </span>
                  </td>
                  <td class="align-middle text-center">
                    <div class="d-flex align-items-center">
                      <span class="me-2 text-xs">30%</span>
                      <div>
                        <div class="progress">
                          <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="30" style="width: 30%;"></div>
                        </div>
                      </div>
                    </div>
                  </td>

                  <td class="align-middle">
                    <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                      <i class="fa fa-ellipsis-v text-xs" aria-hidden="true"></i>
                    </button>
                  </td>
                </tr>

                <tr>
                  <td>
                    <div class="d-flex px-2">
                      <div>
                        <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/logos/small-logos/logo-slack.svg" class="avatar avatar-sm rounded-circle me-2">
                      </div>
                      <div class="my-auto">
                        <h6 class="mb-0 text-xs">Slack</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">$1,000</p>
                  </td>
                  <td>
                    <span class="badge badge-dot me-4">
                      <i class="bg-danger"></i>
                      <span class="text-dark text-xs">canceled</span>
                    </span>
                  </td>
                  <td class="align-middle text-center">
                    <div class="d-flex align-items-center">
                      <span class="me-2 text-xs">0%</span>
                      <div>
                        <div class="progress">
                          <div class="progress-bar bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="0" style="width: 0%;"></div>
                        </div>
                      </div>
                    </div>
                  </td>

                  <td class="align-middle">
                    <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                      <i class="fa fa-ellipsis-v text-xs" aria-hidden="true"></i>
                    </button>
                  </td>
                </tr>

                <tr>
                  <td>
                    <div class="d-flex px-2">
                      <div>
                        <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/logos/small-logos/logo-webdev.svg" class="avatar avatar-sm rounded-circle me-2">
                      </div>
                      <div class="my-auto">
                        <h6 class="mb-0 text-xs">Webdev</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">$14,000</p>
                  </td>
                  <td>
                    <span class="badge badge-dot me-4">
                      <i class="bg-info"></i>
                      <span class="text-dark text-xs">working</span>
                    </span>
                  </td>
                  <td class="align-middle text-center">
                    <div class="d-flex align-items-center">
                      <span class="me-2 text-xs">80%</span>
                      <div>
                        <div class="progress">
                          <div class="progress-bar bg-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="80" style="width: 80%;"></div>
                        </div>
                      </div>
                    </div>
                  </td>

                  <td class="align-middle">
                    <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                      <i class="fa fa-ellipsis-v text-xs" aria-hidden="true"></i>
                    </button>
                  </td>
                </tr>

                <tr>
                  <td>
                    <div class="d-flex px-2">
                      <div>
                        <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/logos/small-logos/logo-xd.svg" class="avatar avatar-sm rounded-circle me-2">
                      </div>
                      <div class="my-auto">
                        <h6 class="mb-0 text-xs">Adobe XD</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">$2,300</p>
                  </td>
                  <td>
                    <span class="badge badge-dot me-4">
                      <i class="bg-success"></i>
                      <span class="text-dark text-xs">done</span>
                    </span>
                  </td>
                  <td class="align-middle text-center">
                    <div class="d-flex align-items-center">
                      <span class="me-2 text-xs">100%</span>
                      <div>
                        <div class="progress">
                          <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                      </div>
                    </div>
                  </td>

                  <td class="align-middle">
                    <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                      <i class="fa fa-ellipsis-v text-xs" aria-hidden="true"></i>
                    </button>
                  </td>
                </tr>

              </tbody>
            </table>
          </div>
          </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        

    });
</script>