<?php
    echo $toolbar;
    echo Snl::app()->getFlashMessage();
?>


<div class="row mb-5">
   

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
                            <?= strtoupper(strtolower($model->name)) ?>
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            <?= $model->address ?>
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
                <h5>Info</h5>
            </div>

            <div class="card-body pt-0">
                <form class="form-material form-horizontal" id="app_form" action="#" method="POST">
                    <?= Snl::chtml()->activeTextbox($model, 'perusahaan_id', array('class' => 'hidden')) ?>
                    <div class="form-group">
                        <label class="col-md-12"><?= $model->getLabel('name', TRUE); ?></label>
                        <div class="col-md-12">
                            <?= Snl::chtml()->activeTextbox($model, 'name') ?>
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="col-md-12"><?= $model->getLabel('email', TRUE); ?></label>
                        <div class="col-md-12">
                            <?= Snl::chtml()->activeTextbox($model, 'email') ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-12"><?= $model->getLabel('address', TRUE); ?></label>
                        <div class="col-md-12">
                            <?= Snl::chtml()->activeTextbox($model, 'address') ?>
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
                            <button type="button" class="btn btn-primary" onclick="submitform('app_form', 'Perusahaan')">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        
    </div>
</div>

