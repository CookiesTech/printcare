<?php 
	$menuList = $this->Common_model->getCommonMenu(); 
	
	$res_permission = $this->session->userdata(SESSION_LOGIN.'user_permission');        

	$user_id = $this->session->userdata( SESSION_LOGIN.'user_id' );
	
	$res_user = $this->Common_model->getDetails('user','user_id',$user_id);
	if(!empty($res_user[0]->user_image)){
		$user_profile_image = base_url().$res_user[0]->user_image;
	}else{
		$user_profile_image = asset_url().'images/profile.jpg';
	}
	
	$where = '';
	$where .= 'general_reminder.assigned_user_id = "'.$user_id.'" AND general_reminder.view_status = 0 ';
	$order_by = 'general_reminder.added_date DESC ';
	$general_reminder_count = $this->Common_model->getRecordsCount( 'general_reminder', $where,'',$order_by );
	$general_reminder = $this->Common_model->getRecords( 'general_reminder', $where );
?>

<!-- Left Sidebar - style you can find in sidebar.scss  -->
<aside class="left-sidebar">
	<!-- Sidebar scroll-->
	<div class="scroll-sidebar">
		<!-- User profile -->
		<div class="user-profile">
			<!-- User profile image -->
			<div class="profile-img"> <img src="<?php echo $user_profile_image; ?>" alt="user" />
				<!-- this is blinking heartbit-->
				<!-- <div class="notify setpos"> <span class="heartbit"></span> <span class="point"></span> </div> -->
			</div>
			<!-- User profile text-->
			<div class="profile-text">
				<h5><?php echo $this->session->userdata( SESSION_LOGIN.'full_name' ); ?></h5>
				 
				<!-- <a href="<?php echo site_url('user/customizeDashboardBlock'); ?>" ><i class="fa fa-dashboard"></i></a> -->
				<a href="<?php echo site_url('user/accountsetting'); ?>" class="" data-toggle="tooltip" title="User"><i class="fa fa-user"></i></a>
				<a href="<?php echo site_url('login/logout'); ?>" class="" data-toggle="tooltip" title="Logout"><i class="fa fa-power-off"></i></a>
				
				<!-- <div class="dropdown-menu animated flipInY">
					<a href="#" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
					<a href="#" class="dropdown-item"><i class="ti-wallet"></i> My Balance</a>
					<a href="#" class="dropdown-item"><i class="ti-email"></i> Inbox</a>
					<div class="dropdown-divider"></div>
					<a href="#" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a>
					<div class="dropdown-divider"></div>
					<a href="#" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
				</div> -->
			</div>
		</div>
		<!-- End User profile text-->
		
		<!-- Sidebar navigation-->
		<nav class="sidebar-nav">
			<ul id="sidebarnav">
				<li class="nav-devider"></li>				
				<?php 	
			if(isset($menuList) && !empty($menuList)){ 
				foreach($menuList as $key => $val){
					if(in_array($val->menu_access_key.'_view',$res_permission)){
						$sub_menu = $this->Common_model->getSubMenu($val->menu_id); 	

						if(isset($sub_menu) && !empty($sub_menu)){  ?>
							<li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="<?php echo $val->icon; ?>"></i><span class="hide-menu"><?php echo $val->menu_name; ?></span></a>
							<ul aria-expanded="false" class="collapse">
						<?php 
							foreach($sub_menu as $sub){ 
							if(in_array($sub->menu_access_key.'_view',$res_permission)){
						?>
								<li><a href="<?php echo site_url($sub->menu_link); ?>" title="<?php echo $sub->menu_name; ?>"><?php echo $sub->menu_name; ?></a></li>
						<?php } } ?>
							</ul>
						</li>
						<?php }else{ ?>
							<li id="<?php echo $val->menu_name; ?>" >
							 <a class="has-arrow waves-effect waves-dark" href="<?php echo site_url($val->menu_link); ?>" aria-expanded="false"><i class="<?php echo $val->icon; ?>"></i><span class="hide-menu"><?php echo $val->menu_name; ?></span></a>							
						<?php } ?>
			<?php } } } ?>
			
				
			</ul>
		</nav>
		<!-- End Sidebar navigation -->
	</div>
	<!-- End Sidebar scroll-->
</aside>
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<div class="page-wrapper">
<!-- Bread crumb-->
<div class="row page-titles">
   <div class="col-md-5 align-self-center">
      <h3 class="text-themecolor">
		  <?php 
			if(isset($page_title))
				echo $page_title;
			else	
				echo $title; 
			?>
	  </h3>
   </div>
   <div class="col-md-7 align-self-center">
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
         <li class="breadcrumb-item">
			 <?php echo $title; ?>
		 </li>
      </ol>
   </div>
</div>
<!-- End Bread crumb -->
