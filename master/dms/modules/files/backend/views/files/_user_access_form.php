<div class="modal fade" id="modal-user-access-form" role="dialog" aria-labelledby="modal-user-access-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                	<div class="card-header pb-0 text-center">
                        <p class="text-sm text-secondary">Edit User Akses Untuk <?= $model->name ?></p>
                    </div>
                    <hr class="mb-0" style="border: 1px solid #dee2e6;" />
                    <div class="card-body">

						<form role="form text-left" id="form_edit_access" action="<?= Snl::app()->baseUrl() ?>admin/files/submitedituseraccess" method="POST">
							<div class="form-group" style="display: none;">
						        <label class="col-md-12"><?= $model->getLabel('folder_id', TRUE); ?></label>
						        <div class="col-md-12">
						            <?= Snl::chtml()->activeTextbox($model, 'folder_id') ?>
						        </div>
						    </div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-12">
										<input type="hidden" id="edit-access-ids" value="<?php echo implode(',',$edit_access) ?>" />
										<input type="hidden" id="view-access-ids" value="<?php echo implode(',',$view_access) ?>" />

										<div class="table-responsive">
										    <table class="table align-items-center mb-0">
										      <thead>
										        <tr>
										          <th class="text-xs font-weight-bolder opacity-7"><label><?= $model->getLabel('user_access', TRUE); ?></label></th>
										          <th class="text-xs font-weight-bolder opacity-7"><label>Akses</label></th>
										          <th class="text-xs font-weight-bolder opacity-7"><label>&nbsp;</label></th>
										        </tr>
										      </thead>

										      <tbody>
										      	<?php if(count($edit_access) == 0 && count($view_access) == 0) : ?>
											      	<tr>
											      		<td class="w-40">
											      			<select class="form-control file-access-user" name="Folder[user_access][<?= $ctr ?>][]" multiple="multiple">
												            	<?php 
												            		if($user_model != NULL) {
												            			foreach($user_model as $d) {
												            				if($d->hasFolderAccess($model->folder_parent_id)) {
												            					echo "<option value='".$d->user_id."'>".ucwords(strtolower($d->fullname))."</option>";	
												            				}
												            			}
												            		}
												            	?>
															</select>
											      		</td>
											      		<td class="w-40">
											      			<div class="form-check">
															  <input class="form-check-input role-list" type="checkbox" value="1" name="Folder[access_role][<?= $ctr ?>][]">
															  <label class="custom-control-label">Akses untuk edit?</label>
															</div>
															<?php $ctr++; ?>
											      		</td>
											      		<td>
											      			<i class="fa fa-plus text-sm me-2 link-info append-user-role" role="button" data-folder-id="<?= $model->folder_parent_id ?>" data-form-type="edit"></i>
											      			<i class="fa fa-times text-sm me-2 link-danger remove-user-role" role="button" data-form-type="edit"></i>
											      		</td>
											      	</tr>
										      <?php endif; ?>


										      	<?php if(count($edit_access) > 0) : ?>
											      	<tr>
											      		<td class="w-40">
											      			<select class="form-control file-access-user" name="Folder[user_access][<?= $ctr ?>][]" multiple="multiple">
												            	<?php 
												            		if($user_model != NULL) {
												            			foreach($user_model as $d) {
												            				if($d->hasFolderAccess($model->folder_parent_id)) {
												            					echo "<option value='".$d->user_id."'>".ucwords(strtolower($d->fullname))."</option>";	
												            				}
												            			}
												            		}
												            	?>
															</select>
											      		</td>
											      		<td class="w-40">
											      			<div class="form-check">
															  <input class="form-check-input role-list" type="checkbox" value="1" name="Folder[access_role][<?= $ctr ?>][]" checked>
															  <label class="custom-control-label">Akses untuk edit?</label>
															</div>
															<?php $ctr++; ?>
											      		</td>
											      		<td>
											      			<i class="fa fa-plus text-sm me-2 link-info append-user-role" role="button" data-folder-id="<?= $model->folder_id ?>" data-form-type="edit"></i>
											      			<i class="fa fa-times text-sm me-2 link-danger remove-user-role" role="button" data-form-type="edit"></i>
											      		</td>
											      	</tr>
										      <?php endif; ?>

										      <?php if(count($view_access) > 0) : ?>
											      	<tr>
											      		<td class="w-40">
											      			<select class="form-control file-access-user" name="Folder[user_access][<?= $ctr ?>][]" multiple="multiple">
												            	<?php 
												            		if($user_model != NULL) {
												            			foreach($user_model as $d) {
												            				if($d->hasFolderAccess($model->folder_parent_id)) {
												            					echo "<option value='".$d->user_id."'>".ucwords(strtolower($d->fullname))."</option>";	
												            				}
												            			}
												            		}
												            	?>
															</select>
											      		</td>
											      		<td class="w-40">
											      			<div class="form-check">
															  <input class="form-check-input role-list" type="checkbox" value="1" name="Folder[access_role][<?= $ctr ?>][]">
															  <label class="custom-control-label">Akses untuk edit?</label>
															</div>

											      		</td>
											      		<td>
											      			<i class="fa fa-plus text-sm me-2 link-info append-user-role" role="button" data-folder-id="<?= $model->folder_id ?>" data-form-type="edit"></i>
											      			<i class="fa fa-times text-sm me-2 link-danger remove-user-role" role="button" data-form-type="edit"></i>
											      		</td>
											      	</tr>
										      <?php endif; ?>

										      </tbody>
										  </table>
										</div>
									</div>
								</div>
						    </div>


	                        <div class="form-group">
						        <div class="col-md-12 text-center">
						            <button type="submit" class="btn bg-gradient-info mt-4 mb-0"><?= LabelHelper::getLabel('submit') ?></button>

						            <button type="button" class="btn bg-gradient-warning mt-4 mb-0" id="close-edit-access-form">Cancel</button>
						        </div>
						    </div>
	                    </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>