<h4 class="box-title">Contact Email <span title="Add" data-toggle="tooltip" class="add_email btn btn-info pull-right"><i class="fa fa-plus"></i> Add More</span> </h4>
<hr class="m-t-0 m-b-40">
               <div id="client_email_ids" class="contact_details">
       
                     <?php if(isset($email_ids) && !empty($email_ids)){ ?>
                     <?php $i=1; foreach($email_ids as $key=> $email_id){ ?>
                     <div class="client_email_ids_block" id="<?php echo $i; ?>">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label class="control-label text-right col-md-4">Contact Person</label>
                                 <div class="col-md-8">
                                    <input class="form-control" type="text" name="tbl_client_email_ids[<?php echo $i; ?>][contact_person]" value="<?php echo $email_id->contact_person; ?>" placeholder="Contact Person"> 
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label class="control-label text-right col-md-4">Email</label>
                                 <div class="col-md-8">
                                    <input class="form-control" type="text" name="tbl_client_email_ids[<?php echo $i; ?>][email_id]" value="<?php echo $email_id->email_id; ?>" placeholder="Email"> 
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label class="control-label text-right col-md-4">Designation</label>
                                 <div class="col-md-8">
                                    <select name="tbl_client_email_ids[<?php echo $i; ?>][ref_designation_id]" class="form-control custom-select">
                                    <?php echo $designation_block = $this->Common_model->getOptionList('designation',$email_id->ref_designation_id); ?>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label class="control-label text-right col-md-4">Primary Contact</label>
                                 <div class="col-md-8">
                                    <?php if($email_id->primary_contact == '1'){ ?>
                                    <input type="radio" class="email_primary" checked name="tbl_client_email_ids[<?php echo $i; ?>][primary_contact]" value="1">
                                    <?php }else{ ?>
                                    <input type="radio" class="email_primary"  name="tbl_client_email_ids[<?php echo $i; ?>][primary_contact]" value="1">
                                    <?php } ?> Primary Contact 
                                 </div>
                              </div>
                           </div>
                           <div style="float:right;" class="col-md-12">
                              <?php if($i=='1' ){ ?> <span title="Add" data-toggle="tooltip" class="add_email btn btn-info pull-right"><i class="fa fa-plus"></i></span>
                              <?php }else{ ?> <span title="Delete" data-toggle="tooltip" class="remove_email btn btn-danger pull-right"><i class="fa fa-trash-o"></i></span>
                              <?php } ?> 
                           </div>
                        </div>
                     </div>
                     <?php $i++; } }else{ ?>
                     <div class="client_email_ids_block" id="1">
                        <div class="clearfix"></div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label class="control-label text-right col-md-4">Contact Person</label>
                                 <div class="col-md-8">
                                    <input class="form-control" type="text" name="tbl_client_email_ids[1][contact_person]" placeholder="Contact Person"> 
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label class="control-label text-right col-md-4">Email</label>
                                 <div class="col-md-8">
                                    <input class="form-control" type="text" name="tbl_client_email_ids[1][email_id]" placeholder="Email"> 
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label class="control-label text-right col-md-4">Designation</label>
                                 <div class="col-md-8">
                                    <select name="tbl_client_email_ids[1][ref_designation_id]" id="select_designation" class="form-control custom-select">
                                    <?php echo $designation_block = $this->Common_model->getOptionList('designation',''); ?>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group row">
                                 <label class="control-label text-right col-md-4">Primary Contact</label>
                                 <div class="col-md-8">
                                    <input type="radio" class="email_primary"  name="tbl_client_email_ids[1][primary_contact]" value="1" checked> Primary Contact 
                                 </div>
                              </div>
                           </div>
                          <!-- <div class="col-md-12"> 
                              <span title="Add" data-toggle="tooltip" class="add_email btn btn-info pull-right"><i class="fa fa-plus"></i></span> 
                           </div>-->
                        </div>
                     </div>
                     <?php } ?> 
                  </div>
              




<script>
   designationNew = '';
   $(document).ready(function() {
      $('.add_email').on('click', function() {
         var row_id = parseInt($('#client_email_ids .client_email_ids_block:last').attr('id')) + 1;
         //alert(row_id);
         if (designationNew != '') {
            designation = designationNew;
         }
         else {
            designation = '<?php echo $designation_block; ?>';
         }
         var client_name = $('input:text[name=client_name]').val();
         $('#client_email_ids .client_email_ids_block:last').after('<div class="client_email_ids_block" id=' + row_id + '><div class="clearfix"></div><div class="row"><div class="col-md-6"><div class="form-group row"><label class="control-label text-right col-md-4">Contact Person</label><div class="col-md-8"><input class="form-control" type="text" name="tbl_client_email_ids[' + row_id + '][contact_person]" value="'+client_name+'" placeholder = "Contact Person"></div></div></div><div class="col-md-6"><div class="form-group row"><label class="control-label text-right col-md-4">Email</label><div class="col-md-8"><input class="form-control" type="text" name="tbl_client_email_ids[' + row_id + '][email_id]" placeholder="Email"></div></div></div><div class="col-md-6"><div class="form-group row"><label class="control-label text-right col-md-4">Designation</label><div class="col-md-8"><select class="form-control custom-select" name="tbl_client_email_ids[' + row_id + '][ref_designation_id]">' + designation + '</select></div></div></div><div class="col-md-6"><div class="form-group row"><label class="control-label text-right col-md-4">Contact Person</label><div class="col-md-8"><input class="email_primary"  type="radio" name="tbl_client_email_ids[' + row_id + '][primary_contact]" value="' + row_id + '"> Primary Contact</div></div></div><div  class="col-md-12"><span title="Delete" data-toggle="tooltip" style="float:right;" class="remove_email btn btn-danger"><i class="fa fa-trash-o"></i></span></div></div></div>');
      });
      $(document).on('click', '.remove_email', function() {
         $(this).closest('.client_email_ids_block').remove();
      });
   });
</script>

