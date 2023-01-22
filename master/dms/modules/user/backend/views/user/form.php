<?php
    echo $toolbar;
    echo Snl::app()->getFlashMessage();

?>
<form class="form-material form-horizontal" id="app_form" action="#" method="POST">
    <?= Snl::chtml()->activeTextbox($model, 'user_id', array('class' => 'hidden')) ?>
    <div class="form-group">
        <label class="col-md-12"><?= $model->getLabel('email', TRUE); ?></label>
        <div class="col-md-12">
            <?= Snl::chtml()->activeTextbox($model, 'email') ?>
        </div>
    </div>

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
            <button type="button" class="btn btn-primary" onclick="submitform('app_form', 'User')"><?= LabelHelper::getLabel('submit') ?></button>
        </div>
    </div>
</form>