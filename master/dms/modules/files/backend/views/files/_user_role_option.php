<tr>
	<td>
		<select class="form-control file-access-user" name="Folder[user_access][0][]" multiple="multiple">
			<?php 
        		if($model != NULL) {
        			foreach($model as $d) {
        				if($d->hasFolderAccess($folder_id)) {
        					echo "<option value='".$d->user_id."'>".ucwords(strtolower($d->fullname))."</option>";	
        				}
        			}
        		}
        	?>
		</select>
	</td>
	<td>
		<div class="form-check">
		  <input class="form-check-input role-list" type="checkbox" value="1" name="Folder[access_role][0][]">
		  <label class="custom-control-label">Akses untuk edit?</label>
		</div>
	</td>
	<td>
		<i class="fa fa-plus text-sm me-2 link-info append-user-role" role="button" data-folder-id="<?= $folder_id ?>" data-form-type="<?= $form_type ?>"></i>
		<i class="fa fa-times text-sm me-2 link-danger remove-user-role" role="button" data-form-type="<?= $form_type ?>"></i>
	</td>
</tr>