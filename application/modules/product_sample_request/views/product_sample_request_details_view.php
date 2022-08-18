 <!--<p align="right"><a class="btn btn-pdf" href="<?php echo site_url('agent/exportClientDetailsPdf/'.$this->uri->segment( 3 )); ?>"><i class="fa fa-file-pdf-o"></i></a></p>-->
 
<section class="content home">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Agent</h2> 
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Details of <b><?php echo $agent[0]->agent_name; ?></b></h2> 
                    </div>
                    <div class="body">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab-details" data-toggle="tab">Personal Details</a></li>
							<li><a href="#tab-contact" data-toggle="tab">Mobile</a></li>
							<li><a href="#tab-email" data-toggle="tab">Email</a></li>
							
						</ul>
						
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane fade in active" id="tab-details">
								<table class="table table-striped table-borderless">
									<tr>
								<th align="left" width="25%">Name</th>
								<td align="left"><?php if(isset($agent[0]->agent_name)) echo $agent[0]->agent_name ; ?></td>
								</tr>	
								
								
								<tr>
									<th align="left" width="20%">From Date</th>
									<td align="left"><?php echo $this->Common_model->getDateFormat($agent[0]->agent_from_date);?></td>
								</tr>	
							<tr>
								<th align="left">Data Source</th>
								<td align="left"><?php 
									echo $agent[0]->data_source_name; 
									
								?></td>
							</tr>	
								
							
							
							
						
							<tr>
								<th align="left">Address </th>
								<td align="left"><?php if(isset($agent[0]->agent_address_line1)) echo $agent[0]->agent_address_line1 ;?><?php if(isset($agent[0]->agent_address_line2)) echo ','.$agent[0]->agent_address_line2 ;?><?php if(isset($agent[0]->agent_address_line3)) echo ','.$agent[0]->agent_address_line3 ;?>
								<Br>
								<?php if(isset($agent[0]->state_name)) echo $agent[0]->state_name ;?>
								<?php if(isset($agent[0]->agent_pincode)) echo '-'.$agent[0]->agent_pincode ;?>
								<br>
								<?php if(isset($agent[0]->country_name)) echo $agent[0]->country_name ;?>
								</td>
							</tr>
							
							<!--<tr>
								<th align="left">Referred Date</th>
								<td align="left">
								<?php echo $this->Common_model->getDateFormat($agent[0]->agent_referred_date);?>
								
								</td>
								
								</tr>	
							<tr>
								<th align="left">Referred By</th>
								<td align="left"><?php if(isset($agent[0]->agent_referred_by)) echo $agent[0]->agent_referred_by ;?></td>
							</tr>-->
								</table>
							</div>
							
							<div role="tabpanel" class="tab-pane fade" id="tab-contact">
								<table class="table table-striped table-borderless">
									<thead>
							<tr>
								<th align="left" width="5%">S.No</th>
								<th align="left">Primary</th>
								<th align="left">Name</th>
								<th align="left">Designation</th>
								<th align="left">Number Type</th>
								
								<th align="left">Contact Number</th>
								<th align="left">Extension</th>
								<th align="left">From</th>
								<th align="left">To</th>
							</tr>
						</thead>
						<tbody>
						<?php if(isset($agent_numbers) && !empty($agent_numbers)){ ?>
							<?php $i = 1; foreach ($agent_numbers as $key => $val){ ?>
							<tr>
								<td align="left"><?php echo $i; ?></td>
								<td align="left"><?php if($val->primary_contact == '1'){ echo 'Yes'; }else{ echo ''; } ?></td>
								<td align="left"><?php echo $val->contact_person; ?></td>
								<td align="left"><?php echo $val->designation_name; ?></td>
								<td align="left"><?php echo $val->mobile_or_phone_or_whatsapp; ?></td>
								
								<td align="left"><?php echo $val->contact_number; ?></td>
								<td align="left"><?php echo $val->contact_extension; ?></td>
								<td align="left"><?php echo $val->contact_timing_from; ?></td>
								<td align="left"><?php echo $val->contact_timing_to; ?></td>
							</tr>
							<?php $i++; } ?>
							<?php } ?>
						</tbody>
								</table>
							</div>
							<div role="tabpanel" class="tab-pane fade" id="tab-email">
								<table class="table table-striped table-borderless">
									<thead>
							<tr>
								<th align="center" width="5%">S.No</th>
								<th align="left">Primary</th>
								<th align="left">Name</th>
								<th align="left">Email</th>
								<th align="left">Designation</th>
								
							</tr>
						</thead>
						<tbody>
						<?php if(isset($agent_emails) && !empty($agent_emails)){ ?>
							<?php $i = 1; foreach ($agent_emails as $key => $val){ ?>
							<tr>
								<td align="center"><?php echo $i; ?></td>
								<td align="left"><?php if($val->primary_contact == '1'){ echo 'Yes'; }else{ echo ''; } ?></td>
								<td align="left"><?php echo $val->contact_person; ?></td>
								<td align="left"><?php echo $val->email_id; ?></td>
								<td align="left"><?php echo $val->designation_name; ?></td>
							</tr>
							<?php $i++; } ?>
							<?php }else{ ?>
								<tr><td align="center" colspan="5">No records found...</td></tr>
							<?php } ?>
						</tbody>
								</table>
							</div>
							
						</div>	
                    </div>
                </div>
            </div>
        </div>
    
