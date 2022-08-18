<h4 class="box-title">Product Batch <span title="Add" data-toggle="tooltip" class="add_batch btn btn-info pull-right"><i class="fa fa-plus"></i> Add Batch</span> </h4>
<hr class="m-t-0 m-b-40">
<div id="product_batch_list" class="contact_details">

   <?php if(isset($product_batch_list) && !empty($product_batch_list)){ ?>
   <?php $i=1; foreach($product_batch_list as $key=> $val){ ?>
   <div class="product_batch_list_block" id="<?php echo $i; ?>">
      <div class="row">
         <div class="col-md-4">
            <div class="form-group row">
               <label class="control-label text-right col-md-4">Batch No</label>
               <div class="col-md-8">
                  <input class="form-control" type="text" name="tbl_product_batch[<?php echo $i; ?>][product_batch_name]" value="<?php echo $val->product_batch_name; ?>" placeholder="Batch No"> 
                  <input class="form-control" type="hidden" name="tbl_product_batch[<?php echo $i; ?>][product_batch_id]" value="<?php echo $val->product_batch_id; ?>" >
               </div>
            </div>
         </div>
         <div class="col-md-4">
            <div class="form-group row">
               <label class="control-label text-right col-md-4">Manufacture Date</label>
               <div class="col-md-8">
                  <input class="form-control datepicker" type="text" name="tbl_product_batch[<?php echo $i; ?>][manufacture_date]" value="<?php echo getDateFormat($val->manufacture_date); ?>" placeholder="Manufacture Date"> 
               </div>
            </div>
         </div>

         <div class="col-md-4">
            <div class="form-group row">
               <label class="control-label text-right col-md-4">Expiry Date</label>
               <div class="col-md-8">
                  <input class="form-control datepicker" type="text" name="tbl_product_batch[<?php echo $i; ?>][expiry_date]" value="<?php echo getDateFormat($val->expiry_date); ?>" placeholder="Expiry Date"> 
               </div>
            </div>
         </div>
         <div class="col-md-4">
            <div class="form-group row">
               <label class="control-label text-right col-md-4">Quantity</label>
               <div class="col-md-8">
                  <input class="form-control" type="text" name="tbl_product_batch[<?php echo $i; ?>][quantity]" value="<?php echo $val->quantity; ?>" placeholder="Quantity"> 
               </div>
            </div>
         </div>
         <div class="col-md-4">
            <div class="form-group row">
               <label class="control-label text-right col-md-4">Avail Quantity</label>
               <div class="col-md-8">
                  <input class="form-control" type="text" name="tbl_product_batch[<?php echo $i; ?>][avail_quantity]" value="<?php echo $val->avail_quantity; ?>" placeholder="Quantity"> 
               </div>
            </div>
         </div>
         <div class="col-md-4">
            <div class="form-group row">
               <label class="control-label text-right col-md-4">Price</label>
               <div class="col-md-6">
                  <input class="form-control" type="text" name="tbl_product_batch[<?php echo $i; ?>][price]" value="<?php echo $val->price; ?>" placeholder="Price"> 
               </div>
               <div class="col-md-2">
                  <span title="Delete" data-toggle="tooltip" class="remove_batch btn btn-danger pull-right" remove_batch_id="<?php echo $val->product_batch_id; ?>" data-qty="<?php echo $val->quantity; ?>" data-product_id="<?php echo $val->ref_product_id; ?>"><i class="fa fa-trash-o"></i></span>
               </div>
            </div>
         </div>
         
        <!--  <div style="float:right;" class="col-md-1">
            
         </div> -->
      </div>
   </div>
   <?php $i++; } }else{ ?>
   <div class="product_batch_list_block" id="1">
      <div class="clearfix"></div>
      <div class="row">
         <div class="col-md-4">
            <div class="form-group row">
               <label class="control-label text-right col-md-4">Batch No</label>
               <div class="col-md-8">
                  <input class="form-control" type="text" name="tbl_product_batch[0][product_batch_name]"  placeholder="Batch No"> 
               </div>
            </div>
         </div>
         <div class="col-md-4">
            <div class="form-group row">
               <label class="control-label text-right col-md-4">Manufacture Date</label>
               <div class="col-md-8">
                  <input class="form-control datepicker" type="text" name="tbl_product_batch[0][manufacture_date]"  placeholder="Manufacture Date"> 
               </div>
            </div>
         </div>

         <div class="col-md-4">
            <div class="form-group row">
               <label class="control-label text-right col-md-4">Expiry Date</label>
               <div class="col-md-8">
                  <input class="form-control datepicker" type="text" name="tbl_product_batch[0][expiry_date]" value="" placeholder="Expiry Date"> 
               </div>
            </div>
         </div>
         <div class="col-md-4">
            <div class="form-group row">
               <label class="control-label text-right col-md-4">Quantity</label>
               <div class="col-md-8">
                  <input class="form-control" type="text" name="tbl_product_batch[0][quantity]" value="" placeholder="Quantity"> 
               </div>
            </div>
         </div>
         <div class="col-md-4">
            <div class="form-group row">
               <label class="control-label text-right col-md-4">Avail Quantity</label>
               <div class="col-md-8">
                  <input class="form-control" type="text" name="tbl_product_batch[0][avail_quantity]" value="" placeholder="Quantity"> 
               </div>
            </div>
         </div>
         <div class="col-md-4">
            <div class="form-group row">
               <label class="control-label text-right col-md-4">Price</label>
               <div class="col-md-8">
                  <input class="form-control" type="text" name="tbl_product_batch[0][price]" value="" placeholder="Price"> 
               </div>
            </div>
         </div>
      </div>
   </div>
   <?php } ?> 
</div>
              




<script>
   $(document).ready(function() {
      $('.add_batch').on('click', function() {
         var row_id = parseInt($('#product_batch_list .product_batch_list_block:last').attr('id')) + 1;
         //alert(row_id);
         $('#product_batch_list .product_batch_list_block:last').after('<div class="product_batch_list_block" id=' + row_id + '><div class="clearfix"></div><div class="row"><div class="col-md-4"> <div class="form-group row"> <label class="control-label text-right col-md-4">Batch No</label> <div class="col-md-8"> <input class="form-control" type="text" name="tbl_product_batch['+row_id+'][product_batch_name]" placeholder="Batch No"> </div></div></div><div class="col-md-4"> <div class="form-group row"> <label class="control-label text-right col-md-4">Manufacture Date</label> <div class="col-md-8"> <input class="form-control datepicker" type="text" name="tbl_product_batch['+row_id+'][manufacture_date]" placeholder="Manufacture Date"> </div></div></div><div class="col-md-4"> <div class="form-group row"> <label class="control-label text-right col-md-4">Expiry Date</label> <div class="col-md-8"> <input class="form-control datepicker" type="text" name="tbl_product_batch['+row_id+'][expiry_date]" value="" placeholder="Expiry Date"> </div></div></div><div class="col-md-4"> <div class="form-group row"> <label class="control-label text-right col-md-4">Quantity</label> <div class="col-md-8"> <input class="form-control" type="text" name="tbl_product_batch['+row_id+'][quantity]" value="" placeholder="Quantity"> </div></div></div><div class="col-md-4"> <div class="form-group row"> <label class="control-label text-right col-md-4">Avail Quantity</label> <div class="col-md-8"> <input class="form-control" type="text" name="tbl_product_batch['+row_id+'][avail_quantity]" value="" placeholder="Quantity"> </div></div></div><div class="col-md-4"> <div class="form-group row"> <label class="control-label text-right col-md-4">Price</label> <div class="col-md-8"> <input class="form-control" type="text" name="tbl_product_batch['+row_id+'][price]" value="" placeholder="Price"> </div></div></div><div  class="col-md-12"><span title="Delete" data-toggle="tooltip" style="float:right;" class="remove_batch btn btn-danger"><i class="fa fa-trash-o"></i></span></div></div></div>');

            $('.datepicker').datetimepicker({
               dayOfWeekStart: 1,
               lang: 'en',
               disabledDates: ['1986/01/08', '1986/01/09', '1986/01/10'],
               startDate: '2015-10-28',
               step: 5,
               format: 'd-m-Y',
               formatDate: 'd-m-Y',
            }).on('change', function() {
               $('.xdsoft_datetimepicker').hide();
            });
      });
      $(document).on('click', '.remove_batch', function() {
		 var batch_id = $(this).attr('remove_batch_id');
       var qty = $(this).data('qty');
       var product_id = $(this).data('product_id');
			if(batch_id != '' && batch_id != undefined) {
				var r=confirm("Are you sure want to delete permanentaly ?");
				if (r==true){
				remove_batch_particulars(batch_id,qty,product_id);
				} else {
				return false;	
				}
			}
         $(this).closest('.product_batch_list_block').remove();
      });
   });
   
   function remove_batch_particulars(batch_id,qty,product_id) {
		$.ajax({ 
		type: "POST",
		data:{batch_id:batch_id,qty:qty,product_id:product_id},
		url: '<?php echo base_url(); ?>index.php/product/remove_batch_particulars',
		success: function(result){ 
			console.log(result);
		}
		});
	}
   
</script>

