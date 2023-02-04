<!-- Pop up modal untuk upload file -->
<div class="modal fade" id="modal-revisi-form" role="dialog" aria-labelledby="modal-revisi-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-body">
                        <form action="<?= Snl::app()->baseUrl() ?>admin/files/upload?ajax=1" class="dropzone" id="my-dropzone-revisi">
						    <div class="dz-message">
						        <h1 class="mb-0 "><i class="fa fa-file-text-o"></i></h1>
						        <p class="mb-2">Tarik file disini</p>
						        <p class="text-sm text-secondary mb-3">atau</p>
						        <button type="button" class="btn btn-default">Pilih Dokumen</button>
						    </div>
						</form>

						<hr style="border-top: 1px solid aquamarine !important;" />

						<form role="form text-left" id="app_form_upload" action="<?= Snl::app()->baseUrl() ?>admin/files/revisidocument" method="POST">
							<div class="form-group">
	                            <label class="col-md-12 text-secondary">Dokumen Asli :</label>
	                            <div class="col-md-12">
	                                <label class="text-sm mb-0 view-file-attribute" role="button" data-folder-id="<?= SecurityHelper::encrypt($folder->folder_id) ?>">
			                          <?= $folder->name ?>
			                        </label>
	                            </div>
	                        </div>

							<div class="form-group" style="display: none;">
						        <label class="col-md-12"><?= $model->getLabel('original_id', TRUE); ?></label>
						        <div class="col-md-12">
						            <?= Snl::chtml()->activeTextbox($model, 'original_id') ?>
						        </div>
						    </div>

						    <div class="form-group" style="display: none;">
						        <label class="col-md-12"><?= $model->getLabel('name', TRUE); ?></label>
						        <div class="col-md-12">
						            <?= Snl::chtml()->activeTextbox($model, 'name') ?>
						        </div>
						    </div>

						    <div class="form-group" style="display: none;">
						        <label class="col-md-12"><?= $model->getLabel('format', TRUE); ?></label>
						        <div class="col-md-12">
						            <?= Snl::chtml()->activeTextbox($model, 'format') ?>
						        </div>
						    </div>

						    <div class="form-group" style="display: none;">
						        <label class="col-md-12"><?= $model->getLabel('size', TRUE); ?></label>
						        <div class="col-md-12">
						            <?= Snl::chtml()->activeTextbox($model, 'size') ?>
						        </div>
						    </div>


							<div class="form-group">
	                            <label class="col-md-12"><?= $model->getLabel('description', TRUE); ?></label>
	                            <div class="col-md-12">
	                                <?= Snl::chtml()->activeTextarea($model, 'description') ?>
	                            </div>
	                        </div>

						    
                            <div class="form-group">
						        <div class="col-md-12 text-center">
						            <button type="button" class="btn bg-gradient-info mt-4 mb-0" id="upload-file-btn" data-is-revisi="1">Submit</button>

						            <button type="button" class="btn bg-gradient-warning mt-4 mb-0" data-dismiss="modal-upload-form" id="close-upload-form">Cancel</button>
						        </div>
						    </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>