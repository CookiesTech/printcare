<div class="container-fluid">
   <div class="row">
      <div class="col-lg-12">
         <div class="card card-outline-info">
            <div class="card-body">
               <div class="row">
                  <div class="col-md-6">
                     <h4 class="card-title">Report</h4>
                     <h6 class="card-subtitle"><?php
                        if(isset($filter_data) && !empty($filter_data)){
                         $search_result_count = 0;
                         if(count($mainlist)){
                          $search_result_count = count($mainlist);
                         }
                         echo '<a style="font-size:14px;padding-left:10px;">'.$search_result_count.' result(s) found...</a>';
                        }
                        ?></h6>
                  </div>
                  <div class="col-md-6 text-right">
                     <div class="dt-buttons">
                        <?php if(in_array('purchase_order_add',$permission)){?> 	
                        <a class="btn btn-info" href="<?php echo site_url('purchase_order/export_purchase_order_report_excel'); ?>" target="_blank">Excel</a>
                        <a class="btn btn-info" href="<?php echo site_url('purchase_order/export_purchase_order_report_pdf'); ?>" target="_blank">PDF</a>
                        <?php } ?>
                     </div>
                  </div>
               </div>
               <div class="clearfix"></div>
               <?php echo form_open('purchase_order/purchase_order_report'); ?>
                <div class="row">
                  <div class="col-md-2">
                     <div class="form-group">
                        <input type="text" name="po_no" class="form-control" placeholder="PO #" value="<?php echo @$filter_data['po_no']; ?>"> 
                     </div>
                  </div>

                   <div class="col-md-2">
                     <div class="form-group">
                        <input type="text" name="from_date" class="datepicker form-control" placeholder="From Date" value="<?php echo $this->Common_model->getDateFormat(@$filter_data['from_date']); ?>"> 
                     </div>
                  </div>
                  <div class="col-md-2">
                     <div class="form-group">
                        <input type="text" name="to_date" class="datepicker form-control" placeholder="To Date" value="<?php echo $this->Common_model->getDateFormat(@$filter_data['to_date']); ?>"> 
                     </div>
                  </div>

                  <div class="col-md-2">
                     <div class="form-group">
                        <select name="ref_client_id" class="form-control custom-select">
                           <option value="" disabled selected>Select Client</option>
                           <?php 
                              if(isset($filter_data['ref_client_id'])){
                              echo $this->Common_model->getOptionList('client',$filter_data['ref_client_id']); 
                              }else{
                              echo $this->Common_model->getOptionList('client',''); 
                              }
                              ?>
                        </select> 
                     </div>
                  </div>
                  <div class="col-md-2">
                     <div class="form-group">
                        <select name="ref_supplier_id" id="select_supplier" class="form-control custom-select">
                           <option value="" disabled selected>Select Supplier</option>
                           <?php 
                              if(isset($filter_data['ref_supplier_id'])){
                              echo $this->Common_model->getOptionList('supplier',$filter_data['ref_supplier_id']); 
                              }else{
                              echo $this->Common_model->getOptionList('supplier',''); 
                              }
                              ?>
                        </select> 
                     </div>
                  </div>

                  

                  <div class="col-md-2">
                     <div class="form-group">
                        <select id="select_product" name="ref_product_id" class="form-control custom-select">
                           <option value="" >Select Product</option>
                        </select>
                     </div>
                </div>

                <div class="col-md-2">
                     <div class="form-group">
                          <select id="select_quality" name="ref_product_quality_id" class="form-control custom-select">
                           <option value="" >Select Quality</option>
                        </select> 
                     </div>   
                  </div>
                  <div class="col-md-2">
                     <div class="form-group">
                        <select id="select_size" name="ref_product_quality_size_id" class="form-control custom-select" >
                           <option value="" >Select Size</option>
                        </select>
                     </div>   
                  </div>
                  <div class="col-md-2">
                     <div class="form-group">
                        <select id="select_variety" name="ref_product_variety_id" class="form-control custom-select" >
                           <option value="" >Variety</option>
                        </select>
                     </div>   
                  </div>

                  <div class="col-md-2">
                     <div class="form-group">
                        <select name="payment_status" class="form-control custom-select" >
                           <option value="2" disabled selected>Payment Status</option>
                           <option value="2">Pending</option>
                           <option value="1">Received</option>
                        </select> 
                     </div>
                  </div>
                  <div class="col-md-2">
                     <div class="form-group">
                        <select name="commission_status" class="form-control custom-select" >
                           <option value="2" disabled selected>Commission Status</option>
                           <option value="2">Pending</option>
                           <option value="1">Received</option>
                        </select> 
                     </div>
                  </div>
                 <div class="col-md-2">
                    <input type="submit" name="submit" class="btn btn-success" value="Filter">
                     <button class="btn btn-danger" name="reset" type="submit">Reset</button>
                 </div>
               </div>

               <?php echo form_close(); ?>
               <div class="table-responsive">
                  <div class="dataTables_wrapper">
                     <?php echo form_open('purchase_order/delete'); ?>
                     <table class="table color-table muted-table ">
                        <thead>
                           <tr>
                             
                              <th class="text-center sorting" width="2%">S.No</th>
                              <th class="text-left sorting" width="4%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'purchase_purchase_order_code/ASC'); ?>">PO #</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'purchase_purchase_order_code/DESC'); ?>">PO #</a>
                                 <?php } ?>
                              </th>
                              <th class="text-left sorting" width="8%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'purchase_purchase_order_date/ASC'); ?>">Date</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'purchase_purchase_order_date/DESC'); ?>">Date</a>
                                 <?php } ?>
                              </th>
                              <th class="text-left sorting" width="15%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'client_name/ASC'); ?>">Customer</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'client_name/DESC'); ?>">Customer</a>
                                 <?php } ?>
                              </th>
                              <th class="text-left sorting" width="20%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'supplier_name/ASC'); ?>">Supplier</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'supplier_name/DESC'); ?>">Supplier</a>
                                 <?php } ?>
                              </th>
                             
                               <th class="text-left" width="10%">Inv.No</th>
                              <th class="text-left" width="6%">Inv.Date</th>
                             <th class="text-right" width="6%">Inv.Total</th>
                             <th class="text-center sorting" width="4%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'despatch_mode_name/ASC'); ?>">Pay</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'despatch_mode_name/DESC'); ?>">Pay</a>
                                 <?php } ?>
                              </th>
                             <th class="text-center sorting" width="4%">
                                 <?php if($this->uri->segment( 5 ) == 'DESC'){ ?>
                                 <a href="<?php echo site_url($listing_page.'invoice_commission_status/ASC'); ?>">Comm</a>
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url($listing_page.'invoice_commission_status/DESC'); ?>">Comm</a>
                                 <?php } ?>
                              </th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if(isset($mainlist)&& !empty($mainlist)){ ?>
                           <?php $i = $start+1; foreach ($mainlist as $key => $val){ 
								 $res_invoice = $this->Common_model->getDetails('invoice','ref_purchase_order_id',$val->purchase_order_id);
							   ?>
                           <tr>
                             
                              <td class="text-center"><?php echo $i; ?></td>
                              <td class="text-left">
								   <a id="<?php echo $val->purchase_order_id; ?>" data-toggle="tooltip" class="btn" style="cursor:pointer" title="<?php echo $val->purchase_order_code; ?>" href="<?php echo base_url().$val->purchase_order_file; ?>" target="_blank"><?php echo substr($val->purchase_order_code,-9,4); ?> <i class="fa fa-search"></i></a>
                              </td>
                              <td class="text-left"><?php echo $this->Common_model->getDateFormat($val->purchase_order_date); ?></td>
                              <td class="text-left"><?php echo $val->client_name; ?></td>
                              <td class="text-left"><?php echo $val->supplier_name; ?></td>                             
                             
							    <td class="text-left"><?php echo $res_invoice[0]->invoice_no; ?></td>
							   <td class="text-left"><?php echo $this->Common_model->getDateFormat($res_invoice[0]->invoice_date); ?></td>
							   <td class="text-right"><?php echo number_format($res_invoice[0]->grand_total); ?></td>
							   <td class="text-center">
								  <?php 
									if($val->ref_delivery_point_id == 2){
										if($val->invoice_payment_status)
											echo '<span class="label label-success payment_history" title="view Payment History" id="'.$val->purchase_order_id.'">R <i class="fa fa-info-circle"></i></span>';
										else	
											echo '<span class="label label-danger payment_history" title="view Payment History" id="'.$val->purchase_order_id.'">P</span>'; 
									}else{
										echo '-';
									}	
								  ?>
							   </td>
							   <td class="text-center">
								  <?php 
									if($val->ref_delivery_point_id == 2){
										if($val->invoice_commission_status)
											echo '<span class="label label-success commission_history" title="view Commission History" id="'.$val->purchase_order_id.'">R <i class="fa fa-info-circle"></i></span>';
										else	
											echo '<span class="label label-danger commission_history" title="view Commission History" id="'.$val->purchase_order_id.'">P</span>'; 
									}else{
										echo '-';
									}			
								  ?>
							   </td>  
							  
                             
                           </tr>
                           <?php  $i++; } ?>
                           <?php }else{ ?>
							<tr><td align="center" colspan="10">No records found...</td></tr>   
							<?php } ?>  	
                        </tbody>
                     </table>
                     
                     <?php echo form_close(); ?>		
                     
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php include('popup_commission_history_list_view.php'); ?>
<?php include('popup_payment_history_list_view.php'); ?>
<script>

   $(document).on('change','#select_supplier', function() {       
         var p_row_id = $(this).parent().parent().attr('id');
            var id = $(this).val();
            $.ajax({
                type: 'POST',
                dataType: 'json',
                data:{ref_supplier_id:id},
                url: '<?php echo base_url(); ?>index.php/product_sample_request/ajax/get_product_list',
                beforeSend: function(){
               $("#status").css("display", "block");
               $("#loader").css("display", "block");
            },
                success: function(json) {
                    $("#status").fadeOut("slow"); 
               $("#loader").delay(500).fadeOut();
                    if (json['product']) {
                  var html = '<option value="">Select Product</option>';
                        $(json['product']).each(function(index, value) {
                     html += '<option value="'+value['product_id']+'">'+value['product_name']+'</option>';
                  
                        });
                        $('#select_product').html(html);
                    }
                    
                    if (json['variety']) {
                  var html = '<option value="">Select Variety</option>';
                        $(json['variety']).each(function(index, value) {
                     html += '<option value="'+value['product_variety_id']+'">'+value['product_variety_name']+'</option>';
                  
                        });
                        $('#select_variety').html(html);
                    }
                    
                    //~ if (json['size']) {
                  //~ var html = '<option value="">Select Size</option>';
                        //~ $(json['size']).each(function(index, value) {
                     //~ html += '<option value="'+value['product_quality_size_id']+'">'+value['product_quality_size_name']+'</option>';
                  //~ 
                        //~ });
                        //~ $('#select_size').html(html);
                    //~ }
                    
                    
                }
            });
        });
        
        $(document).on('change','#select_product', function() {        
            var product_id = $(this).val();
            $.ajax({
                type: 'POST',
                dataType: 'json',
                data:{product_id:product_id},
                url: '<?php echo base_url(); ?>index.php/product_sample_request/ajax/get_product_size_quality',
                beforeSend: function(){
               $("#status").css("display", "block");
               $("#loader").css("display", "block");
            },
                success: function(json) {                    
                   $("#status").fadeOut("slow"); 
               $("#loader").delay(500).fadeOut();
                  var html = '<option value="">Select Quality</option>';
                  if (json['quality']) {
                     $(json['quality']).each(function(index, value) {
                        html += '<option value="'+value['product_quality_id']+'">'+value['product_quality_name']+'</option>';
                     
                     });
                        }
                        $('#select_quality').html(html);
                                      
                  var html = '<option value="">Select Size</option>';
                  if (json['size']) {
                     $(json['size']).each(function(index, value) {
                        html += '<option value="'+value['product_quality_size_id']+'">'+value['product_quality_size_name']+'</option>';
                     
                     });
                        }
                        $('#select_size').html(html);
                   
                   
                }
            });
        });
     
	
         
</script>

