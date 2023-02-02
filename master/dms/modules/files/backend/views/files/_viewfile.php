<div class="modal fade" id="modal-view-file" tabindex="-1" role="dialog" aria-labelledby="modal-view-file" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <!-- <div class="card-header pb-0 text-left">
                        <h3 class="font-weight-bolder text-info text-gradient">
                        	<i class="fa fa-folder me-1"></i>Buat Folder
                        </h3>
                    </div> -->

                    <div class="card-body">
                    	<div class="card-body p-3">
							<div class="row">
								<div class="col-md-4 text-center">
									<h1 class="text-9xl">
									<?php
				                        if($model->format == "pdf") {
				                          echo "<i class='fa fa-file-pdf-o opacity-6 text-dark me-3'></i>";
				                        } else if($model->format == "doc" || $model->format == "docx" || $model->format == "docs") {
				                          echo "<i class='fa fa-file-word-o opacity-6 text-dark me-3'></i>";
				                        } else {
				                          echo "<i class='fa fa-file opacity-6 text-dark me-3'></i>";
				                        }
				                    ?>
				                    </h1>
								</div>
								<div class="col-md-8">
									<div class="row">
										<div class="col-md-6">
											<button type="button" class="btn btn-outline-info w-100" id="btn-open-file" data-url="<?= Snl::app()->baseUrl() . 'uploads/documents/'.$model->name?>" data-format="<?= $model->format ?>"><i class="me-2 fa fa-eye"></i>Lihat</button>
										</div>

										<div class="col-md-6">
											<button type="button" class="btn btn-outline-info w-100" id="btn-download-file" data-url="<?= Snl::app()->baseUrl() . 'uploads/documents/'.$model->name?>"><i class="me-2 fa fa-download"></i>Unduh</button>
										</div>

										<div class="col-md-6">
											<button type="button" class="btn btn-outline-info w-100"><i class="me-2 fa fa-pencil-square-o"></i>Revisi</button>
										</div>

										<?php if($model->isTheOwner()) : ?>
										<div class="col-md-6">
											<button type="button" class="btn btn-outline-danger w-100" id="btn-delete-file" data-folder-id="<?= SecurityHelper::encrypt($model->folder_id) ?>"><i class="me-2 fa fa-trash"></i>Hapus</button>
										</div>
										<?php endif; ?>
									</div>
								</div>
							</div>

							<hr class="horizontal gray-light my-3">


							<div class="card">
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
								    			<td><span class="text-sm text-secondary">Unit Kerja</span></td>
								    			<td><span class="text-sm text-dark"><?= $model->unit_kerja ?></span></td>
								    		</tr>

								    		<tr>
								    			<td><span class="text-sm text-secondary">Dokumen Terkait</span></td>
								    			<td><span class="text-sm text-dark"><?= implode($model->getRelatedDocuments(), ', ') ?></span></td>
								    		</tr>

								    		<tr>
								    			<td><span class="text-sm text-secondary">Keywords</span></td>
								    			<td><span class="text-sm text-dark"><?= $model->keyword ?></span></td>
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
							
						</div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>