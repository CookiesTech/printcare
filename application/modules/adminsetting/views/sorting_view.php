<!--- Form --->
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<div class="card card-outline-info">
				<div class="card-header">
					<h4 class="m-b-0 text-white">Change Menu Order</h4>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						   <?php if(isset($sorting)&& !empty($sorting)){ 
							  ?>
						   <ul id="sortable" >
							  <li class="ui-state-default">
								  <div class="row">
								 <div class=" col-md-3">ID
								 </div>
								 <?php foreach ($fields as $key => $field){ ?>
								 <div class="col-md-3">
									<?php echo $field; ?>
								 </div>
								 <?php } ?>
								 </div>
							  </li>
							  <?php $i = 1; foreach ($sorting as $key => $val){ 
								 $id_field = $table.'_id';
								 ?>
							  <li id="item-<?php echo $val->$id_field; ?>" class="ui-state-default">
								 <div class="row">
								 <?php	foreach ($val as $keyy => $vall){ 
									?>
								 <?php if (strpos($keyy, '_image') !== false) { ?>
								 <div class=" col-md-3"><?php echo '<img src='.base_url().$vall.' width="50" height="50">'; ?></div>
								 <?php }else{?>
								 <div class=" col-md-3"><?php echo $vall; ?></div>
								 <?php } ?>
								 <?php }
									echo '</div>';
									echo '</li>';
									} //exit;?>
						   </ul>
						   <?php } 
							  ?>
						</div>
				</div>	
			</div>	
		</div>	
	</div>	
</div>	

<link rel="stylesheet" href="<?php echo asset_url(); ?>css/jquery-ui.css">
<script src="<?php echo asset_url(); ?>js/jquery-1.10.2.js"></script>
<script src="<?php echo asset_url(); ?>js/jquery-ui.js"></script>
<?php $base = $this->uri->segment(1); ?>
<style>
   #sortable { list-style-type: none; margin: 0; padding: 0; width:75%}
   #sortable li {  border: 1px solid rgba(204, 204, 204, 0.8); margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em;  height: 30px; }
   #sortable li span { position: absolute; margin-left: -1.3em; }	
</style>
<script>
   $(document).ready(function(){
   // Code for Drag items
   
   var base = '<?php echo $action; ?>';
   $('#sortable').sortable({
   	axis: 'y',
   	update: function (event, ui) {
   		var data = $(this).sortable('serialize');
   		var type = 'update_sortorder';
   		$.ajax({
   			data:data,
   			type: 'POST',
   			dataType:'json',
   			url: '<?php echo base_url(); ?>index.php/'+base+'/updateMenuSortorder',
   			success: function(json) {
   				if(json == 'true'){
   					alert('Success...');
   				}else{
   					alert('Error on change order...');
   				}
   			}
   		});
   	}
   });
   });
   
</script>
