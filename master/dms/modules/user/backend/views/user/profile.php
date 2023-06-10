<?php
    echo $toolbar;
    echo Snl::app()->getFlashMessage();
?>


<div class="row mb-5">
    <div class="col-lg-3">
        <div class="card position-sticky top-1">
            <ul class="nav flex-column bg-white border-radius-lg p-3">
                <li class="nav-item">
                    <a class="nav-link text-body" data-scroll="" href="#profile">
                        <span class="text-sm"><i class="fa fa-rocket text-sm me-2"></i>Profile</span>
                    </a>
                </li>

                <li class="nav-item pt-2">
                    <a class="nav-link text-body" data-scroll="" href="#basic-info">
                        <span class="text-sm"><i class="fa fa-book text-sm me-2"></i>Basic Info</span>
                    </a>
                </li>
                <li class="nav-item pt-2">
                    <a class="nav-link text-body" data-scroll="" href="#password">
                        <span class="text-sm"><i class="fa fa-lock text-sm me-2"></i>Change Password</span>
                    </a>
                </li>

                <li class="nav-item pt-2">
                    <a class="nav-link text-body" data-scroll="" href="#sign">
                        <span class="text-sm"><i class="fa fa-lock text-sm me-2"></i>Privy Sign</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>

    <div class="col-lg-9 mt-lg-0 mt-4">
        <div class="card card-body" id="profile">
            <div class="row justify-content-center align-items-center">
                <div class="col-sm-auto col-4">
                    <div class="avatar avatar-xl position-relative">
                        <i class="fa fa-user-o"></i>
                    </div>
                </div>

                <div class="col-sm-auto col-8 my-auto">
                    <div class="h-100">
                        <h5 class="mb-1 font-weight-bolder">
                            <?= ucwords(strtolower($model->fullname)) ?>
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            <?= $model->email ?>
                        </p>
                    </div>
                </div>

                <div class="col-sm-auto ms-sm-auto mt-sm-0 mt-3 d-flex" style="opacity: 0!important">
                    <label class="form-check-label mb-0">
                        <small id="profileVisibility">
                        Switch to invisible
                        </small>
                    </label>
                    <div class="form-check form-switch ms-2">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault23" checked="" onchange="visible()">
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4" id="basic-info">
            <div class="card-header">
                <h5>Basic Info</h5>
            </div>

            <div class="card-body pt-0">
                <form class="form-material form-horizontal" id="app_form" action="#" method="POST">
                    <?= Snl::chtml()->activeTextbox($model, 'user_id', array('class' => 'hidden')) ?>
                    <div class="form-group">
                        <label class="col-md-12"><?= $model->getLabel('email', FALSE); ?></label>
                        <div class="col-md-12">
                            <?php if($model->isNewRecord) : ?>
                                <?= Snl::chtml()->activeTextbox($model, 'email') ?>
                            <?php else : ?>
                                <label class="col-md-12"><?= $model->email; ?></label>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group hidden">
                        <label class="col-md-12"><?= $model->getLabel('password', TRUE); ?></label>
                        <div class="col-md-12">
                            <?= Snl::chtml()->activePassword($model, 'password') ?>
                        </div>
                    </div>

                    <div class="form-group hidden">
                        <label class="col-md-12"><?= $model->getLabel('password_repeat', TRUE); ?></label>
                        <div class="col-md-12">
                            <?= Snl::chtml()->activePassword($model, 'password_repeat') ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-12"><?= $model->getLabel('fullname', TRUE); ?></label>
                        <div class="col-md-12">
                            <?= Snl::chtml()->activeTextbox($model, 'fullname') ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-12"><?= $model->getLabel('phone', TRUE); ?></label>
                        <div class="col-md-12">
                            <?= Snl::chtml()->activeTextbox($model, 'phone') ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-primary" onclick="submitform('app_form', 'User')">Perbaharui</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <div class="card mt-4" id="password">
            <div class="card-header">
                <h5>Change Password</h5>
            </div>
            <div class="card-body pt-0">
                <form class="form-material form-horizontal" id="app_form_password" action="#" method="POST">
                    <?= Snl::chtml()->activeTextbox($model, 'user_id', array('class' => 'hidden')) ?>
                    
                    <div class="form-group">
                        <label class="col-md-12"><?= $model->getLabel('password', TRUE); ?></label>
                        <div class="col-md-12">
                            <?= Snl::chtml()->activePassword($model, 'password') ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-12"><?= $model->getLabel('password_repeat', TRUE); ?></label>
                        <div class="col-md-12">
                            <?= Snl::chtml()->activePassword($model, 'password_repeat') ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-primary" onclick="submitform('app_form_password', 'User')">Ubah Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-4" id="sign">
            <div class="card-header">
                <h5>Privy Sign</h5>
            </div>
            <div class="card-body pt-0">
                <form class="form-material form-horizontal" id="app_form_sign" action="uploadsign" method="POST" enctype="multipart/form-data">
                    <?= Snl::chtml()->activeTextbox($model, 'user_id', array('class' => 'hidden')) ?>
                    
                    <div class="form-group">
                        <div class="col-md-12">
                            <?php
                                if($model->ttd == '' || $model == NULL) {
                                    echo "<label class='col-md-12'>Not set up yet</label>";
                                } else {
                                    echo "<img style='width: 100px;' src='".Snl::app()->baseUrl() . 'uploads/documents/'.$model->ttd."' />";
                                }
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-12">Upload Here</label>
                        <div class="col-md-12">
                            <input type="file" class="form-control" name="file" />
                        </div>
                         <p class="col-md-12" style="font-size: 10pt;">File type : JPG & PNG. Max 1 MB</p>
                    </div>

                    

                    <div class="form-group">
                        <div class="col-md-12">
                            <button type="submit" name="submit-sign" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

