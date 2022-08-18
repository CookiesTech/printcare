<section class="content home">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Error Logs</h2> 
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Details</h2> 
                    </div>
                    <div class="body">
						<div style="background-color: #f4f4f4;
						height: 400px;
						overflow-x: hidden;
						overflow-y: scroll;
						padding: 10px;">
						<?php if(isset($error_details) && !empty($error_details)){
							echo $error_details;
						} ?>
						</div>
                    </div>
                </div>
            </div>
        </div>

