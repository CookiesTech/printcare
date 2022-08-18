<!-- Record Insertion Common status message available where ever flter block used--> 
 <?php if(isset($_SESSION['success_msg'])){ ?>
	<div role="alert" class="alert alert-success black alert-dismissible"> 
		<button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button> 
		<strong>
			<?php 
				echo $_SESSION['success_msg'];
				unset($_SESSION['success_msg']);
			?>
		</strong> 
	</div>
<?php } ?>

 <?php if(isset($_SESSION['error_msg'])){ ?>
	<div role="alert" class="alert alert-danger alert-dismissible"> 
		<button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button> 
		<strong>
			<?php 
				echo $_SESSION['error_msg'];
				unset($_SESSION['error_msg']);
			?>
		</strong> 
	</div>
<?php } ?>		

<!----- Ends Here---->			
<div id="lead_filter" class="col-md-12">
    <?php if(isset($filter_data['filter_data']) && !empty($filter_data['filter_data'])) {
         $i = 1;
         foreach($filter_data['filter_data'] as $key => $filter){ 
    ?>
                  
	<div id="<?php echo $i; ?>" class="filter_row row">
		<div class="col-md-2">
            <?php if(isset($filter['filter_type']) && !empty($filter['filter_type'])){ ?>
                
                <input type="radio" name="filter_data[<?php echo $i; ?>][filter_type]" value="AND" <?php if($filter['filter_type'] == 'AND') echo 'checked'; ?>> <span class="custom-control-label">AND</span> <input type="radio" name="filter_data[<?php echo $i; ?>][filter_type]" value="OR" <?php if($filter['filter_type'] == 'OR') echo 'checked'; ?>> <span class="custom-control-label">OR</span>
               
            <?php } ?>
         </div>
		
        <div class="col-md-3">
			<div class="form-group">
				<div class="form-line">
			<select class ="form-control filter_field" name="filter_data[<?php echo $i; ?>][field]" >
				<?php 
					$fields = ''; 
					foreach ( $tablefields as $key => $val ) { 
                        if($val->COLUMN_NAME == $filter['field']){
                            $fields .= '<option value="'.$val->COLUMN_NAME.'" selected>'.$val->COLUMN_COMMENT.'</option>';
                        }else{
                            $fields .= '<option value="'.$val->COLUMN_NAME.'">'.$val->COLUMN_COMMENT.'</option>';
                        }
				} 
					echo $fields;
				?>
			</select>
			
		</div>
		</div>
		</div>
		
	
		
		<div class="col-md-2">
			<?php  if (strpos($filter['field'], '_date') !== false) { ?>
				<input type="hidden" name="filter_data[<?php echo $i; ?>][operation]" value="BETWEEN">
				<div class="form-group">
					<div class="form-line">
						<input type="text" class ="form-control datepicker"  name="filter_data[<?php echo $i; ?>][value_from]" placeholder="Value" value="<?php echo $filter['value_from']; ?>" id="filter_value_<?php echo $i; ?>" autocomplete="off"> 
						<input type="text" class ="form-control datepicker"  name="filter_data[<?php echo $i; ?>][value_to]" placeholder="Value" value="<?php echo $filter['value_to']; ?>" id="filter_value_<?php echo $i; ?>" autocomplete="off"> 
					</div>
				</div>
			<?php }else{ ?>
				<input type="hidden" name="filter_data[<?php echo $i; ?>][operation]" value="LIKE %...%">
				<div class="form-group">
					<div class="form-line">
						<input type="text" class ="form-control"  name="filter_data[<?php echo $i; ?>][value]" placeholder="Value" value="<?php echo $filter['value']; ?>" id="filter_value_<?php echo $i; ?>"> 
					</div>
				</div>
			<?php } ?>
		</div>
		
		<div class="col-md-1">
            <?php if($i == '1'){ ?>
                <a id="add_filter_row" class="btn btn-success"><i class="fa fa-plus"> </i></a>
            <?php }else{ ?>
                <a class="btn btn-danger remove_filter_row"><i class="fa fa-trash-o"></i></a>
            <?php } ?>
		</div>
         <?php if($i == '1'){ ?>
            <div class="col-md-2">
                <button class="btn btn-info" name="submit" type="submit">Filter</button>
                <button class="btn btn-danger" name="reset" type="submit">Reset</button>
            </div>
            
            <?php 
            $record_limit = array('View All','10','50','100');
            if(isset($_REQUEST['limit']) && !empty($_REQUEST['limit'])){
                $limit = $_REQUEST['limit'];
            }else{
                $limit = '10';
            }
            ?> 
                   
            <div class="col-md-2">
               <div class="form-group">
				<div class="form-line">
                <select name="limit" class="form-control" id="select_limit">
                    <?php if(isset($record_limit) && !empty($record_limit)){
                        foreach($record_limit as $key => $val){ 
                            if($val == $limit){
                                echo '<option value="'.$val.'" selected>'.$val.'</option>';
                            }else{
                                echo '<option value="'.$val.'">'.$val.'</option>';
                            }
                         }
                    }?>
                </select>
            </div>
            </div>
            </div>
        <?php } ?>
	</div>
        
        <?php $i++; }
    }else{ ?>
	<div id="1" class="filter_row row">
		 <div class="col-md-2">
		 
		 </div>
		<div class="col-md-3">
			<div class="form-group">
				<div class="form-line">
			<select class ="form-control filter_field" name="filter_data[1][field]" >
				<?php 
					$fields = ''; 
					foreach ( $tablefields as $key => $val ) { 
						$fields .= '<option value="'.$val->COLUMN_NAME.'">'.$val->COLUMN_COMMENT.'</option>';
				} 
					echo $fields;
				?>
			</select>
			
		</div>
		</div>
		</div>
		
		
		<div class="col-md-2">
			<?php  if (strpos($tablefields[0]->COLUMN_NAME, '_date') !== false) { ?>
				
				<div class="form-group">
					<div class="form-line">
						<input type="hidden" name="filter_data[1][operation]" value="BETWEEN">
						<input class="form-control datepicker" type="text" name="filter_data[1][value_from]" placeholder="From Date" id="filter_value_1" autocomplete="off">
					
						<input class="form-control datepicker" type="text" name="filter_data[1][value_to]" placeholder="To Date" id="filter_value_1" autocomplete="off">
					</div>
				</div>
				
			<?php }else{ ?>
				
				<div class="form-group">
					<div class="form-line">
						<input type="hidden" name="filter_data[1][operation]" value="LIKE %...%">
						<input class="form-control" type="text" name="filter_data[1][value]" placeholder="Value" id="filter_value_1">
					</div>
				</div>		
			<?php } ?>	
		</div>
		
		<div class="col-md-1">
			<a id="add_filter_row" class="btn btn-success"><i class="fa fa-plus"> </i></a>
		</div>
	
        <div class="col-md-2" style="text-align:left;float:left;margin-bottom:10px;">
			 <button class="btn btn-info" name="submit" type="submit">Filter</button>
			 <button class="btn btn-danger" name="reset" type="submit">Reset</button>
		</div>
		
		<?php 
		$record_limit = array('View All','10','50','100');
		if(isset($_REQUEST['limit']) && !empty($_REQUEST['limit'])){
			$limit = $_REQUEST['limit'];
		}else{
			$limit = '10';
		}
		?> 
			   
		<div class="col-md-2">
			<div class="form-group">
				<div class="form-line">
					<select name="limit" class="form-control" id="select_limit">
						<?php if(isset($record_limit) && !empty($record_limit)){
							foreach($record_limit as $key => $val){ 
								if($val == $limit){
									echo '<option value="'.$val.'" selected>'.$val.'</option>';
								}else{
									echo '<option value="'.$val.'">'.$val.'</option>';
								}
							 }
						}?>
					</select>
				</div>
			</div>
		</div>
      </div> 
        <?php } ?>
	</div>
	
	<script>
	
	
	$(function(){
		
	$(document).on('change','.filter_field',function(){
		var row_id =$(this).closest('#lead_filter .row').attr('id');
		//alert(row_id);
		
		var field_name = $(this).find('option:selected').val();
		//alert(field_name);
		if(field_name.indexOf('_date') > -1){
			html = '<input type="hidden" name="filter_data['+row_id+'][operation]" value="BETWEEN"><input type="text" name="filter_data['+row_id+'][value_from]" class="form-control datepicker" id="filter_value_'+row_id+'" placeholder="From Date" autocomplete="off"><input type="text" name="filter_data['+row_id+'][value_to]" class="form-control datepicker" id="filter_value_'+row_id+'" placeholder="To Date" autocomplete="off">';
			
			$('#filter_value_'+row_id).parent().html(html);
			//$('#filter_value_'+row_id).addClass('datepicker');
			$('.datepicker').datetimepicker({
				dayOfWeekStart : 1,
				lang:'en',
				disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
				startDate:	'2015-10-28',
				step:5,
				format:'d-m-Y',
				formatDate:'d-m-Y',
			}).on('change', function() {
            $('.xdsoft_datetimepicker').hide();
        });
		}else{
			//alert(row_id);
			var val_txt = '';
			var readonly_txt = '';
			if(field_name == 'accounts_transaction_credit' || field_name == 'accounts_transaction_debit'){
				val_txt = '1';
				readonly_txt = 'readonly';
			}
			var new_row_id = parseInt(row_id) -1;
			$('#filter_value_'+row_id).removeClass('datepicker');
			$('#filter_value_'+row_id).parent().html('<input type="hidden" name="filter_data['+row_id+'][operation]" value="LIKE %...%"><input class="form-control " type="text" name="filter_data['+row_id+'][value]" placeholder = "value" value="'+val_txt+'" '+readonly_txt+' id="filter_value_'+row_id+'">');
		}
	});
	
	  $('#add_filter_row').on('click',function(){
		var row_id = parseInt($('#lead_filter .filter_row:last').attr('id'))+1;
		var fields = '<?php echo $fields; ?>';
		$('#lead_filter .filter_row:last').after('<div style="margin-bottom:10px;" class="row filter_row" id="'+row_id+'"><div class="col-md-2"><input type="radio" name="filter_data['+row_id+'][filter_type]" value="AND" checked>AND <input type="radio" name="filter_data['+row_id+'][filter_type]" value="OR">OR</div><div class="col-md-3"><select class="form-control filter_field" name="filter_data['+row_id+'][field]">'+fields+'</select><input type="hidden" name="filter_data['+row_id+'][operation]" value="LIKE %...%"></div><div class="col-md-2"><div class="form-group"><div class="form-line"><input class=" datepicker form-control" type="text" id="filter_value_'+row_id+'" name="filter_data['+row_id+'][value]" placeholder = "value"></div></div></div><div class="col-md-1"><a class="remove_filter_row btn btn-danger"><i class="fa fa-trash-o"></i></a></div></div>');
		$('.datepicker').datetimepicker({
				dayOfWeekStart : 1,
				lang:'en',
				disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
				startDate:	'2015-10-28',
				step:5,
				format:'d-m-Y',
				formatDate:'d-m-Y',
				pickDate: false, 
			}).on('change', function() {
            $('.xdsoft_datetimepicker').hide();
        });
		});
		$(document).on('click','.remove_filter_row',function(){
			$(this).closest('#lead_filter .filter_row').remove();
		});	
	});
	</script>
           

