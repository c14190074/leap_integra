<div class="modal fade" id="modal-file-setting" role="dialog" aria-labelledby="modal-file-setting" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                	<div class="card-header pb-0 text-center">
                        <p class="text-sm text-secondary">Perbaharui dokumen - <?= $model->name ?></p>
                    </div>
                    <hr class="mb-0" style="border: 1px solid #dee2e6;" />
                    <div class="card-body">
                    	<p class="text-sm" style="padding-left: 0.5rem;">Pilih file lama yang ingin dikembalikan</p>

                    	<div class="table-responsive">
						    <table class="table align-items-center mb-0">
						      <tbody>
						      	<?php if($revisions != NULL) : foreach($revisions as $revisi_model) : ?>
						      		<?php
						      			$user_created = User::model()->findByPk($revisi_model->created_by);
						      		?>
						      		<tr>
						      			<td>
											<p class="text-sm text-dark fw-bold mb-0">
												<?= $revisi_model->name ?>
												<?= $revisi_model->no_revision == NULL ? '' : ' (Versi '.$revisi_model->no_revision.')' ?>
											</p>
											<p class="text-xs text-secondary">
												Note: <?= $revisi_model->no_revision == NULL ? 'Original' : 'Revisi' ?>
											</p>
											<p class="text-xs">
												<span class="text-secondary">Last Updated:</span> <span class="text-dark fw-bold"><?= date('d M Y H:i:s', strtotime($revisi_model->updated_on)) ?>
												oleh: <?= $user_created->fullname ?> (<?= $user_created->email ?>)</span>
													
											</p>
										</td>
										<td>
											<button type="button" class="btn btn-warning btn-rollback" data-active-file="<?= SecurityHelper::encrypt($model->folder_id) ?>" data-folder-id="<?= SecurityHelper::encrypt($revisi_model->folder_id) ?>"><i class="fa fa-refresh me-2"></i>Rollback</button>
											<button type="button" class="btn btn-info" id="btn-download-file" data-url="<?= Snl::app()->baseUrl() . 'uploads/documents/'.$revisi_model->name ?>" data-folder-id="<?= SecurityHelper::encrypt($revisi_model->folder_id) ?>"><i class="fa fa-download me-2"></i>Unduh</button>
										</td>
						      		</tr>
						      	
						      	<?php endforeach;?>

						      	<?php else : ?>
						      		<tr>
						      			<td colspan="2"><p class="text-sm text-secondary ps-2">No file or folder</p></td>
						      		</tr>
						      	<?php endif; ?>
						      </tbody>
						  	</table>
						</div>

						<div class="col-md-12 text-center">
				            <button type="button" class="btn btn-default" id="close-setting-from">Tutup</button>
				        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>