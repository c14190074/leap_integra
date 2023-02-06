<div class="modal fade" id="modal-folder-detail" tabindex="-1" role="dialog" aria-labelledby="modal-folder-detail" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-body">
                    	<div class="card-body p-3">
                    		<div class="card-header pb-3 ps-0 pt-sm-0 text-left">
	                            <h3 class="font-weight-bolder text-info text-gradient"><i class="fa fa-folder me-1"></i>Informasi Folder</h3>
	                            
	                        </div>

                    		<div class="card">
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
									    			<td><span class="text-sm text-secondary"><?= $model->getLabel('name', FALSE); ?></span></td>
									    			<td><span class="text-sm text-dark"><?= $model->name ?></span></td>
									    		</tr>

									    		<tr>
									    			<td><span class="text-sm text-secondary"><?= $model->getLabel('description', FALSE); ?></span></td>
									    			<td><span class="text-sm text-dark"><?= $model->description ?></span></td>
									    		</tr>

									    		<tr>
									    			<td><span class="text-sm text-secondary"><?= $model->getLabel('user_access', FALSE); ?></span></td>
									    			<td style="white-space: normal; max-width: 300px;">
									    				<span class="text-sm text-dark">
									    					<?php
											                    if($model->user_access != NULL) {
											                      $user_email = array();
											                      $user_access = json_decode($model->user_access);

											                      foreach($user_access as $d) {
											                        $user_access_model = User::model()->findByPk($d->user);
											                        if($model->type == "file") {
											                          $tmp_str = $user_access_model->email . "(".implode(',', $d->role).")";
											                          array_push($user_email, $tmp_str);
											                        } else {
											                          array_push($user_email, $user_access_model->email);
											                        }
											                        
											                      }

											                      array_push($user_email, $user_model->email." (owner)");
											                      
											                      echo implode( ", ", $user_email);
											                    } else {
											                      echo "Only you";
											                    }
											                  ?>	
										    			</span>
										    		</td>
									    		</tr>

									    		<tr>
									    			<td><span class="text-sm text-secondary"><?= $model->getLabel('created_by', FALSE); ?></span></td>
									    			<td><span class="text-sm text-dark"><?= $user_model->fullname ?></span></td>
									    		</tr>

									    		<tr>
									    			<td><span class="text-sm text-secondary"><?= $model->getLabel('created_on', FALSE); ?></span></td>
									    			<td><span class="text-sm text-dark"><?= date('d M Y h:i:s', strtotime($model->created_on)) ?></span></td>
									    		</tr>

									    		<tr>
									    			<td><span class="text-sm text-secondary"><?= $model->getLabel('updated_on', FALSE); ?></span></td>
									    			<td><span class="text-sm text-dark"><?= date('d M Y h:i:s', strtotime($model->updated_on)) ?></span></td>
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

						</div> <!-- end of card-body p-3 -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>