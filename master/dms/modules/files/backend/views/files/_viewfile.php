<div class="card-header pb-0 pt-3 ">
    
	<div class="row">

		<div class="col-md-4 text-center">
			<h1 class="text-9xl">
					<?php
              if($model->format == "pdf") {
                echo "<img class='w-90' src='".Snl::app()->baseUrl()."uploads/pdflogo.png' />";
              } else if($model->format == "doc" || $model->format == "docx" || $model->format == "docs") {
                echo "<img class='w-90' src='".Snl::app()->baseUrl()."uploads/wordlogo.png' />";
              } else {
                echo "<i class='fa fa-file opacity-6 text-dark me-3'></i>";
              }
          ?>
       </h1>

       <?php if($model->hasViewAccess()) : ?>
					<button type="button" class="btn btn-outline-info w-70 mb-0" id="btn-open-file" data-url="<?= Snl::app()->baseUrl() . 'uploads/documents/'.$model->name?>" data-format="<?= $model->format ?>" data-folder-id="<?= SecurityHelper::encrypt($model->folder_id) ?>"><i class="me-2 fa fa-eye"></i>Lihat</button>
					
				<?php endif; ?>
		</div>
		<div class="col-md-7">
			<div class="row">
				<?php if($model->hasViewAccess()) : ?>
					<div class="col-md-6 pe-1 ps-0 pt-3">
						<button type="button" class="btn btn-outline-info w-100 mb-1" style="font-size: 11px;" id="btn-download-file" data-url="<?= Snl::app()->baseUrl() . 'uploads/documents/'.$model->name?>" data-folder-id="<?= SecurityHelper::encrypt($model->folder_id) ?>"><i class="me-2 fa fa-download"></i>Unduh</button>
					</div>
					<?php endif; ?>
					
					<?php if($model->hasEditAccess()) : ?>										
					<div class="col-md-6 pe-0 ps-0 pt-3">
						<button type="button" class="btn btn-outline-info w-100 mb-1" style="font-size: 11px;" id="btn-revisi-file" data-folder-id="<?= SecurityHelper::encrypt($model->folder_id) ?>"><i class="me-2 fa fa-pencil-square-o"></i>Revisi</button>
					</div>

					<div class="col-md-6 pe-1 ps-0">
						<button type="button" class="btn btn-outline-info w-100" style="font-size: 11px;" id="btn-file-setting" data-folder-id="<?= SecurityHelper::encrypt($model->folder_id) ?>"><i class="me-2 fa fa-cog"></i>Atur</button>
					</div>
					<?php endif; ?>

					<?php if($model->isTheOwner()) : ?>
					<div class="col-md-6 pe-0 ps-0">
						<button type="button" class="btn btn-outline-danger w-100" style="font-size: 11px;" id="btn-delete-file" data-folder-id="<?= SecurityHelper::encrypt($model->folder_id) ?>"><i class="me-2 fa fa-trash"></i>Hapus</button>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<div class="col-md-1 text-right">
			<button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
		        <i class="fa fa-close"></i>
		      </button>		
		</div>
	</div>

    <!-- End Toggle Button -->
  </div>

  <hr class="horizontal dark my-1">

  <div class="card-body pt-sm-3 pt-0">
	<nav>
	  <div class="nav nav-tabs" id="nav-tab" role="tablist">
	    <button class="nav-link text-sm active" id="nav-info-tab" data-bs-toggle="tab" data-bs-target="#nav-info" type="button" role="tab" aria-controls="nav-info" aria-selected="true">Informasi</button>

	   

	    <button class="nav-link text-sm" id="nav-log-tab" data-bs-toggle="tab" data-bs-target="#nav-log" type="button" role="tab" aria-controls="nav-log" aria-selected="false">Aktivitas</button>
	  </div>
	</nav>
	<div class="tab-content" id="nav-tabContent">
		<!-- tab untuk informasi -->
	  <div class="tab-pane fade show active" id="nav-info" role="tabpanel" aria-labelledby="nav-info-tab">
	  	<div class="table-responsive">
		    <table class="table align-items-center mb-0">
		    	<tbody>
		    		<tr>
		    			<td><span class="text-sm text-secondary">Nomor</span></td>
		    			<td><span class="text-sm text-dark"><?= $model->nomor ?></span></td>
		    		</tr>

		    		<tr>
		    			<td><span class="text-sm text-secondary">Perihal</span></td>
		    			<td><span class="text-sm text-dark"><?= $model->perihal ?></span></td>
		    		</tr>

		    		<tr>
		    			<td><span class="text-sm text-secondary">Nama File</span></td>
		    			<td><span class="text-sm text-dark"><?= $model->name ?></span></td>
		    		</tr>

		    		<tr>
		    			<td><span class="text-sm text-secondary">Ukuran</span></td>
		    			<td><span class="text-sm text-dark"><?= $model->size ?></span></td>
		    		</tr>

		    		<tr>
		    			<td><span class="text-sm text-secondary">Deskripsi</span></td>
		    			<td><span class="text-sm text-dark"><?= $model->description ?></span></td>
		    		</tr>

		    		<tr>
		    			<td><span class="text-sm text-secondary">Dokumen Terkait</span></td>
		    			<td><span class="text-sm text-dark"><?= implode(', ', $model->getRelatedDocuments()) ?></span></td>
		    		</tr>

		    		<tr>
		    			<td>
		    				<span class="text-sm text-secondary">
		    					User Akses 
		    					<?php if($model->isTheOwner()) : ?>
		    						<i class="fa fa-pencil-square-o me-3 link-info" id="btn-edit-user-access" role="button" data-folder-id="<?= SecurityHelper::encrypt($model->folder_id) ?>"></i>
		    					<?php endif; ?>
		    				</span>
		    			</td>
		    			<td style="white-space: normal; max-width: 200px;">
		    				<span class="text-sm text-dark">
		    					<?php
			              if($model->user_access != NULL) {
			                $user_email = array();
			                $user_access = json_decode($model->user_access);
			                foreach($user_access as $d) {
			                  $user_access_model = User::model()->findByPk($d->user);
			                  $tmp_str = $user_access_model->email . "(".implode(',', $d->role).")";
			                  array_push($user_email, $tmp_str);
			                }

			                array_push($user_email, $user->email." (owner)");
			                
			                echo implode( ", ", $user_email);
			              } else {
			                echo "Only you";
			              }
			            ?>
		    				</span>
		    			</td>
		    		</tr>

		    		<tr>
		    			<td><span class="text-sm text-secondary">Diperbaharui</span></td>
		    			<td><span class="text-sm text-dark"><?= date('d M Y H:i:s', strtotime($model->updated_on)) ?></span></td>
		    		</tr>

		    		<tr>
		    			<td><span class="text-sm text-secondary">Dibuat Oleh</span></td>
		    			<td><span class="text-sm text-dark"><?= ucwords(strtolower($user->fullname)) ?></span></td>
		    		</tr>
		    	</tbody>
		    </table>
		</div>
	  </div>

	  	
	  <!-- tab untuk logs -->
	  <div class="tab-pane fade" id="nav-log" role="tabpanel" aria-labelledby="nav-log-tab">

	  	<?php if($model_logs == NULL) : ?>
	  		<p class="text-sm text-secondary p-sm-4">Tidak ada aktivitas</p>

	  	<?php else : ?>

	  	<div class="table-responsive">
		    <table class="table align-items-center mb-0">
		      <tbody>
		      	<?php foreach($model_logs as $log) : ?>
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