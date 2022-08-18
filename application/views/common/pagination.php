
		<?php 	if(isset($mainlist_count)){
				// Display records Based on selection
				if(isset($_REQUEST['limit']) && !empty($_REQUEST['limit'])){
					if($_REQUEST['limit'] == 'View All'){
						$limit = $mainlist_count;
					}else{
						$limit = $_REQUEST['limit'];
				   } 
				}else{
					$limit = RPP;
				}
				// Append Limit query in url
				$limit_url = '';
				if(isset($_REQUEST['limit']) && !empty($_REQUEST['limit'])){
					$limit_url = '?limit='.$_REQUEST['limit'];
				}
				$page_tot = 0;
				if(isset($mainlist_count) && $mainlist_count){
					$page_tot = ceil($mainlist_count/$limit);
				}
				$url_seg = $this->uri->segment( 1 );
				$seperate_list = $this->uri->segment( 2 );
				$filter_key_seg = '';
				$filter_value_seg = '';
				if($url_seg == 'master' || ($url_seg == 'user' && $seperate_list == 'chathistory')){
					$seg = '4';
					$filter_key_seg = $this->uri->segment( 5 );
					$filter_value_seg = $this->uri->segment( 6 );
				}else{
					$filter_key_seg = $this->uri->segment( 4 );
					$filter_value_seg = $this->uri->segment( 5 );
					$seg = '3';
				}
				$filter_key_url = '';
				if(!empty($filter_key_seg) && !empty($filter_value_seg)){
					$filter_key_url = '/'.$filter_key_seg.'/'.$filter_value_seg;
				}
				
				
				$cur_page = $this->uri->segment( $seg );
				$range = 3;
				if(isset($cur_page)){
					$page  = $this->uri->segment( $seg );
				}else{
					$page = '1';
				}
				
						if($page == '1'){
							$pre = 1;
							$next = $page+1;
						} elseif($page == $page_tot){
							$pre = $page-1;
							$next = $page_tot;
						}elseif($page <= $page_tot){
							$pre = $page-1;
							$next = $page+1;
						}else{
							$pre = $page_tot;
							$next = $page-1;
							echo "<br>Reached End Of The Page";
						}
					   
					   $from = (($page-1) * $limit)+1;
					   if($mainlist_count > ($page * $limit)){
							$to = $page * $limit;
						}else{
							$to = $mainlist_count;
						}
				?>
			 <div class="dataTables_info" id="example23_info" role="status" aria-live="polite">
				<?php 
					if($mainlist_count){
						echo 'Showing '.$from.' to '.$to.' of '.$mainlist_count.' ( '.$page_tot.' Pages)'; 
					}else{
						echo 'Showing 0 Records...';
					}
				?>
			</div>
			<div class="dataTables_paginate paging_simple_numbers" id="example23_paginate">
					
					<?php if($page_tot > 1) {  ?>
					<a class="paginate_button previous disabled" aria-controls="example23" data-dt-idx="0" tabindex="0" id="example23_previous" href="<?php echo site_url($init_listing_page.'1'.$filter_key_url.$limit_url); ?>">← First</a>
					<a class="paginate_button previous disabled" aria-controls="example23" data-dt-idx="0" tabindex="0" id="example23_previous"  href="<?php echo site_url($init_listing_page.$pre.$filter_key_url.$limit_url); ?>">«</a>
					<span>
					<?php if($page == '1') {  ?>
					<?php for($i = ($page - $range); $i < (($page + $range) + 3); $i++){ 
					 if (($i > 0) && ($i <= $page_tot)) {?>
						<a class="paginate_button" href="<?php echo site_url($init_listing_page.$i.$filter_key_url.$limit_url); ?>"><?php echo $i; ?></a>
					<?php } } }else { 
						
					for($i = ($page - $range); $i < (($page + $range) + 1); $i++){ 
					 if (($i > 0) && ($i <= $page_tot)) {
						 if($i == $page){ ?>
							<a class="paginate_button current" href="<?php echo site_url($init_listing_page.$i.$filter_key_url.$limit_url); ?>"><?php echo $i; ?></a>
						<?php }else {
						 ?>
						<a class="paginate_button" href="<?php echo site_url($init_listing_page.$i.$filter_key_url.$limit_url); ?>"><?php echo $i; ?></a>
					<?php }
					} }
					 
					
					 } ?>
					</span>
					<a class="paginate_button next" aria-controls="example23" data-dt-idx="7" tabindex="0" id="example23_next" href="<?php echo site_url($init_listing_page.$next.$filter_key_url.$limit_url); ?>">»</a>
					
					<a class="paginate_button next" aria-controls="example23" data-dt-idx="7" tabindex="0" id="example23_next" href="<?php echo site_url($init_listing_page.$page_tot.$filter_key_url.$limit_url); ?>">Last →</a>
					<?php } ?>
			
			</div>
		<?php } ?>

<script>
$(document).ready(function(){
        $('#select_limit').on('change',function(){
			var limit = $(this).val();
            //alert(document.URL);
            var source_url = document.URL;
            var splited_url = source_url.split('?');
            var final_url = splited_url[0];
            var last = final_url.substring(final_url.lastIndexOf('/') + 1);
            //alert(last);
            var target_url = '';
            var seg_2 = '<?php echo $this->uri->segment(2); ?>';
            var seg_3 = '<?php echo $this->uri->segment(3); ?>';
            var seg_4 = '<?php echo $this->uri->segment(4); ?>';
            //alert(seg_2);
            if(seg_2 !='' && seg_3 !=''){
                target_url = final_url+'?limit='+limit;
            }else if(seg_2 !=''){
                target_url = final_url+'/1?limit='+limit;
            }else{
                target_url = final_url+'/getlist/1?limit='+limit;     
            }
            window.location= target_url;
        });
     });  
</script>
