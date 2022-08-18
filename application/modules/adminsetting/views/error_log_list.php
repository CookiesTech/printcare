<section class="content home">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Admin Setting</h2> 
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Error Logs</h2> 
                    </div>
                    <div class="body">
						<table class="table table-striped table-borderless">
							<thead>
								<tr>
									<th width="5%" class="text-center">S.No</th>
									<th  width="75%" class="text-left">File Name</th>
									<th width="20%" class="text-right">Action</th>
								</tr>
							</thead>
							<tbody>
								
								<?php 
									if(isset($error_logs) && !empty($error_logs)){ 
								$i = 1; foreach ($error_logs as $val){ ?>
								<tr>
									<td class="text-center"><?php echo $i; ?></td>
									<td class="text-left"><?php echo $val; ?></td>
									<td class="text-right">
										<a class="btn btn-info white btn-xs" title="View" data-toggle="tooltip" href="<?php echo site_url('adminsetting/errorLogView/'.$val); ?>"><i class="fa fa-eye"></i></a>
										<a class="btn btn-primary white btn-xs" title="Download" data-toggle="tooltip" href="<?php echo site_url('adminsetting/downloadLogs/'.$val); ?>"><i class="fa fa-download"></i></a>
									</td>
								</tr>
								<?php  $i++; } ?>
								<?php  } ?>	
							</tbody>	
						</table>
						</table>
                    </div>
                </div>
            </div>
        </div>
    
