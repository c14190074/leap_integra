<tr>
	<td>
		<select class="form-control user-list" name="Folder[user_access][]">
    		<?php 
        		if($model != NULL) {
        			foreach($model as $d) {
        				echo "<option value='".$d->user_id."'>".ucwords(strtolower($d->fullname))."</option>";
        			}
        		}
        	?>
		</select>
	</td>
	<td>
		<select class="form-control role-list" name="Folder[access_role][][]" multiple="multiple">
        	<option value="view">Lihat</option>
        	<option value="edit">Revisi</option>
		</select>
	</td>
	<td>
		<i class="fa fa-plus text-sm me-2 link-info append-user-role" role="button"></i>
		<i class="fa fa-times text-sm me-2 link-danger remove-user-role" role="button"></i>
	</td>
</tr>