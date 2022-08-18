<div class="container-fluid">
   <div class="row">
      <div class="col-lg-12">
         <div class="card card-outline-info">
            <div class="card-header">
               <h4 class="m-b-0 text-white">Add New Policy</h4>
            </div>
            <div class="card-body">
               <div class="msg"></div>
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
               <form action="<?php echo site_url('adminsetting'); ?>" method="post" onsubmit="document.getElementById('form').disabled=true;document.getElementById('form').value='Submitting, please wait...';">
                  <div class="vtabs">
                     <ul class="nav nav-tabs tabs-vertical " role="tablist">
                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#tabsms" role="tab"><span class="hidden-xs-down">SMS Settings</span></a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tabmail" role="tab"><span class="hidden-xs-down">E-Mail Settings</span></a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tabimage" role="tab"><span class="hidden-xs-down">Image Settings</span></a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tabsitesetting" role="tab"><span class="hidden-xs-down">App Settings</span></a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tabidreference" role="tab"><span class="hidden-xs-down">ID Referrance</span></a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tabothers" role="tab"><span class="hidden-xs-down">Other Settings</span></a> </li>
                     </ul>
                     <div class="tab-content tabcontent-border">
                        <div class="tab-pane p-20 active" id="tabsms" role="tabpanel">
                           <h4>SMS Details</h4>
                           <hr class="m-t-0 m-b-40">
                           <div class="row">
                              <div class="col-md-12">
                                 <label><input type="radio" name="adminsetting[SMS_ACTIVE_API]"  class="" value="1" <?php if(isset($adminsetting['SMS_ACTIVE_API']) && $adminsetting['SMS_ACTIVE_API'] == '1') echo 'checked'; ?>> SMS API 1</label>
                                 <div class="col-md-12">
                                    <input type="text" name="adminsetting[SMS_API_URL_TEMPLATE_1]"  class="form-control" placeholder="API URL TEMPLATE" value="<?php if(isset($adminsetting['SMS_API_URL_TEMPLATE_1']))echo $adminsetting['SMS_API_URL_TEMPLATE_1']; ?>">
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <label><input type="radio" name="adminsetting[SMS_ACTIVE_API]"  class="" value="2" <?php if(isset($adminsetting['SMS_ACTIVE_API']) && $adminsetting['SMS_ACTIVE_API'] == '2') echo 'checked'; ?>> SMS API 2</label>
                                 <div class="col-md-12">
                                    <input type="text" name="adminsetting[SMS_API_URL_TEMPLATE_2]"  class="form-control" placeholder="API URL TEMPLATE" value="<?php if(isset($adminsetting['SMS_API_URL_TEMPLATE_2']))echo $adminsetting['SMS_API_URL_TEMPLATE_2']; ?>">
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <label><input type="radio" name="adminsetting[SMS_ACTIVE_API]"  class="" value="3" <?php if(isset($adminsetting['SMS_ACTIVE_API']) && $adminsetting['SMS_ACTIVE_API'] == '3') echo 'checked'; ?>> SMS API 3</label>
                                 <div class="col-md-12">
                                    <input type="text" name="adminsetting[SMS_API_URL_TEMPLATE_3]"  class="form-control" placeholder="API URL TEMPLATE" value="<?php if(isset($adminsetting['SMS_API_URL_TEMPLATE_3']))echo $adminsetting['SMS_API_URL_TEMPLATE_3']; ?>">
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <label> <input type="radio" name="adminsetting[SMS_ACTIVE_API]"  class="" value="4" <?php if(isset($adminsetting['SMS_ACTIVE_API']) && $adminsetting['SMS_ACTIVE_API'] == '4') echo 'checked'; ?>> SMS API 4</label>
                                 <div class="col-md-12">
                                    <input type="text" name="adminsetting[SMS_API_URL_TEMPLATE_4]"  class="form-control" placeholder="API URL TEMPLATE" value="<?php if(isset($adminsetting['SMS_API_URL_TEMPLATE_4']))echo $adminsetting['SMS_API_URL_TEMPLATE_4']; ?>">
                                 </div>
                              </div>
                              <h4>CURL Method</h4>
                              <div class="col-md-3">	
                                 <label> Method 1 </label>
                                 <input type="radio" name="adminsetting[SMS_CURL_METHOD]"  class="" value="1" <?php if(isset($adminsetting['SMS_CURL_METHOD']) && $adminsetting['SMS_CURL_METHOD'] == '1') echo 'checked'; ?>>
                              </div>
                              <div class="col-md-3">	
                                 <label> Method 2 </label>
                                 <input type="radio" name="adminsetting[SMS_CURL_METHOD]"  class="" value="2" <?php if(isset($adminsetting['SMS_CURL_METHOD']) && $adminsetting['SMS_CURL_METHOD'] == '2') echo 'checked'; ?>>
                              </div>
                              <div class="clearfix"></div>
                              <div class="clearfix"></div>
                              <hr>
                              <h4>SMS API Through</h4>
                              <div class="col-md-3">	
                                 <label> Same Server </label>
                                 <input type="radio" name="adminsetting[SMS_API_THROUGH]"  class="" value="1" <?php if(isset($adminsetting['SMS_API_THROUGH']) && $adminsetting['SMS_API_THROUGH'] == '1') echo 'checked'; ?>>
                              </div>
                              <div class="col-md-3">	
                                 <label> Remote Server</label>
                                 <input type="radio" name="adminsetting[SMS_API_THROUGH]"  class="" value="2" <?php if(isset($adminsetting['SMS_API_THROUGH']) && $adminsetting['SMS_API_THROUGH'] == '2') echo 'checked'; ?>>
                              </div>
                              <div class="clearfix"></div>
                              <hr>
                              <h4>Remote Server Link</h4>
                              <div class="col-md-12">	
                                 <input type="text" name="adminsetting[SMS_API_REMOTE_LINK]"  class="form-control" value="<?php if(isset($adminsetting['SMS_API_REMOTE_LINK'])) echo $adminsetting['SMS_API_REMOTE_LINK']; ?>">
                              </div>
                              <div class="clearfix"></div>
                              <hr>
                              <h4>Test SMS</h4>
                              <div class="col-md-4">	
                                 <input type="text" name="adminsetting[SMS_TEST_MOBILE_NO]"  class="form-control" placeholder="Mobile Number" value="<?php if(isset($adminsetting['SMS_TEST_MOBILE_NO'])) echo $adminsetting['SMS_TEST_MOBILE_NO']; ?>" id="mobile" onkeypress="return isNumber(event)">
                              </div>
                              <div class="col-md-2">
                                 <a id="test_sms" class="btn btn-success">Test SMS</a>
                              </div>
                              <div class="clearfix"></div>
                              <div class="clearfix"></div>
                              <span style="color:red">Ex SMS API: http://sms1.vefetch.com/SendingSms.aspx?userid=rotarysalem&pass=rotarysalem@9842&title=ROTARY&phone={MOBILE}&msg={MESSAGE}</span>
                           </div>
                        </div>
                        <div class="tab-pane p-20" id="tabmail" role="tabpanel">
                           <div class="row">
                              <div class="col-md-6">
                                 <label>From </label>
                                 <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" name="adminsetting[FROM_ADDRESS]"  class="form-control" placeholder="From Address" value="<?php if(isset($adminsetting['FROM_ADDRESS']))echo $adminsetting['FROM_ADDRESS']; ?>">		
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <label>To </label>
                                 <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" name="adminsetting[TO_ADDRESS]"  class="form-control" placeholder="To Address" value="<?php if(isset($adminsetting['TO_ADDRESS'])) echo $adminsetting['TO_ADDRESS']; ?>">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <label>CC </label>
                                 <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" name="adminsetting[CC_ADDRESS]"  class="form-control" placeholder="CC Address" value="<?php if(isset($adminsetting['CC_ADDRESS'])) echo $adminsetting['CC_ADDRESS']; ?>">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <label>BCC </label>
                                 <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" name="adminsetting[BCC_ADDRESS]"  class="form-control" placeholder="BCC Address" value="<?php if(isset($adminsetting['BCC_ADDRESS'])) echo $adminsetting['BCC_ADDRESS']; ?>">
                                    </div>
                                 </div>
                              </div>
                               <div class="col-md-6">
                                 <label>Mail From Name </label>
                                 <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" name="adminsetting[MAIL_FROM_NAME]"  class="form-control" placeholder="From Name" value="<?php if(isset($adminsetting['MAIL_FROM_NAME'])) echo $adminsetting['MAIL_FROM_NAME']; ?>">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <label>Mail Protocol</label><br>
                                 <input type="radio" name="adminsetting[MAIL_PROTOCOL]" value="mail" <?php if($adminsetting['MAIL_PROTOCOL'] == 'mail') echo 'checked'; ?> >Mail
                                 <input type="radio" name="adminsetting[MAIL_PROTOCOL]" value="smtp" <?php if($adminsetting['MAIL_PROTOCOL'] == 'smtp') echo 'checked'; ?>>SMTP
                              </div>
                              <div class="clearfix"></div>
                              <div class="col-md-6">
                                 <label>SMTP Hostname </label>
                                 <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" name="adminsetting[SMTP_HOSTNAME]"  class="form-control" placeholder="SMTP Hostname" value="<?php if(isset($adminsetting['SMTP_HOSTNAME'])) echo $adminsetting['SMTP_HOSTNAME']; ?>">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <label>SMTP Username </label>
                                 <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" name="adminsetting[SMTP_USERNAME]"  class="form-control" placeholder="SMTP Username" value="<?php if(isset($adminsetting['SMTP_USERNAME'])) echo $adminsetting['SMTP_USERNAME']; ?>">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <label>SMTP Password </label>
                                 <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" name="adminsetting[SMTP_PASSWORD]"  class="form-control" placeholder="SMTP Password" value="<?php if(isset($adminsetting['SMTP_PASSWORD'])) echo $adminsetting['SMTP_PASSWORD']; ?>">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <label>SMTP Port </label>
                                 <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" name="adminsetting[SMTP_PORT]"  class="form-control" placeholder="SMTP Port" value="<?php if(isset($adminsetting['SMTP_PORT'])) echo $adminsetting['SMTP_PORT']; ?>">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <label>SMTP Timeout </label>
                                 <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" name="adminsetting[SMTP_TIMEOUT]"  class="form-control" placeholder="SMTP Timeout" value="<?php if(isset($adminsetting['SMTP_TIMEOUT'])) echo $adminsetting['SMTP_TIMEOUT']; ?>">
                                    </div>
                                 </div>
                              </div>
                              <div class="clearfix"></div>
                              <div class="col-md-12 text-right">
                                 <a class="btn btn-success" id="test_email">Test Email</a>
                              </div>
                              <div class="clearfix"></div>
                           </div>
                        </div>
                        <div class="tab-pane p-20" id="tabimage" role="tabpanel">
                           <div class="row">
                              <div class="col-md-4">
                                 <label>Thumb Width</label>
                                 <input type="text" name="adminsetting[THUMB_WIDTH]"  class="form-control" placeholder="Thumb Image Width" value="<?php if(isset($adminsetting['THUMB_WIDTH'])) echo $adminsetting['THUMB_WIDTH']; ?>">
                              </div>
                              <div class="col-md-4">
                                 <label>Thumb Height</label>
                                 <input type="text" name="adminsetting[THUMB_HEIGHT]"  class="form-control" placeholder="Thumb Image Height" value="<?php if(isset($adminsetting['THUMB_HEIGHT'])) echo $adminsetting['THUMB_HEIGHT']; ?>">
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane p-20" id="tabothers" role="tabpanel">
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group row">
                                    <label class="control-label text-right col-md-4">RPP</label>
                                    <div class="col-md-8">
                                       <input type="text" name="adminsetting[RPP]"  class="form-control" placeholder="Row Per Page" value="<?php if(isset($adminsetting['RPP'])) echo $adminsetting['RPP']; ?>">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group row">
                                    <label class="control-label text-right col-md-4">Default Country</label>
                                    <div class="col-md-8">
                                       <input type="text" name="adminsetting[DEFAULT_COUNTRY]"  class="form-control" placeholder="Country Id" value="<?php if(isset($adminsetting['DEFAULT_COUNTRY'])) echo $adminsetting['DEFAULT_COUNTRY']; ?>">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group row">
                                    <label class="control-label text-right col-md-4">Dashboard Block (Class)</label>
                                    <div class="col-md-8">
                                       <input type="text" name="adminsetting[DASH_TH_CLASS]"  class="form-control" placeholder="Table Header Class" value="<?php if(isset($adminsetting['DASH_TH_CLASS'])) echo $adminsetting['DASH_TH_CLASS']; ?>">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group row">
                                    <label class="control-label text-right col-md-4">List View (Class)</label>
                                    <div class="col-md-8">
                                       <input type="text" name="adminsetting[LIST_TH_CLASS]"  class="form-control" placeholder="Table Header Class" value="<?php if(isset($adminsetting['LIST_TH_CLASS'])) echo $adminsetting['LIST_TH_CLASS']; ?>">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group row">
                                    <label class="control-label text-right col-md-4">Form Header Color</label>
                                    <div class="col-md-8">
                                       <input type="text" name="adminsetting[CARD_HEADER_BG_COLOR]"  class="form-control" placeholder="Color" value="<?php if(isset($adminsetting['CARD_HEADER_BG_COLOR'])) echo $adminsetting['CARD_HEADER_BG_COLOR']; ?>">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group row">
                                    <label class="control-label text-right col-md-4">Form Header Border Color</label>
                                    <div class="col-md-8">
                                       <input type="text" name="adminsetting[CARD_HEADER_BORDER_COLOR]"  class="form-control" placeholder="Color" value="<?php if(isset($adminsetting['CARD_HEADER_BORDER_COLOR'])) echo $adminsetting['CARD_HEADER_BORDER_COLOR']; ?>">
                                    </div>
                                 </div>
                              </div>
                              <div class="clearfix"></div>
                              <div class="col-md-6">
                                 <div class="form-group row">
                                    <label class="control-label text-right col-md-4">Button Success BG Color</label>
                                    <div class="col-md-8">
                                       <input type="text" name="adminsetting[BTN_SUCCESS_BG_COLOR]"  class="form-control" placeholder="Color" value="<?php if(isset($adminsetting['BTN_SUCCESS_BG_COLOR'])) echo $adminsetting['BTN_SUCCESS_BG_COLOR']; ?>">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group row">
                                    <label class="control-label text-right col-md-4">Button Success Border Color</label>
                                    <div class="col-md-8">
                                       <input type="text" name="adminsetting[BTN_SUCCESS_BORDER_COLOR]"  class="form-control" placeholder="Color" value="<?php if(isset($adminsetting['BTN_SUCCESS_BORDER_COLOR'])) echo $adminsetting['BTN_SUCCESS_BORDER_COLOR']; ?>">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group row">
                                    <label class="control-label text-right col-md-4">Button Danger BG Color</label>
                                    <div class="col-md-8">
                                       <input type="text" name="adminsetting[BTN_DANGER_BG_COLOR]"  class="form-control" placeholder="Color" value="<?php if(isset($adminsetting['BTN_DANGER_BG_COLOR'])) echo $adminsetting['BTN_DANGER_BG_COLOR']; ?>">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group row">
                                    <label class="control-label text-right col-md-4">Button Danger Border Color</label>
                                    <div class="col-md-8">
                                       <input type="text" name="adminsetting[BTN_DANGER_BORDER_COLOR]"  class="form-control" placeholder="Color" value="<?php if(isset($adminsetting['BTN_DANGER_BORDER_COLOR'])) echo $adminsetting['BTN_DANGER_BORDER_COLOR']; ?>">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group row">
                                    <label class="control-label text-right col-md-4">Button Info BG Color</label>
                                    <div class="col-md-8">
                                       <input type="text" name="adminsetting[BTN_INFO_BG_COLOR]"  class="form-control" placeholder="Color" value="<?php if(isset($adminsetting['BTN_INFO_BG_COLOR'])) echo $adminsetting['BTN_INFO_BG_COLOR']; ?>">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group row">
                                    <label class="control-label text-right col-md-4">Button Info Border Color</label>
                                    <div class="col-md-8">
                                       <input type="text" name="adminsetting[BTN_INFO_BORDER_COLOR]"  class="form-control" placeholder="Color" value="<?php if(isset($adminsetting['BTN_INFO_BORDER_COLOR'])) echo $adminsetting['BTN_INFO_BORDER_COLOR']; ?>">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group row">
                                    <label class="control-label text-right col-md-4">Button Warning BG Color</label>
                                    <div class="col-md-8">
                                       <input type="text" name="adminsetting[BTN_WARNING_BG_COLOR]"  class="form-control" placeholder="Color" value="<?php if(isset($adminsetting['BTN_WARNING_BG_COLOR'])) echo $adminsetting['BTN_WARNING_BG_COLOR']; ?>">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group row">
                                    <label class="control-label text-right col-md-4">Button Warning Border Color</label>
                                    <div class="col-md-8">
                                       <input type="text" name="adminsetting[BTN_WARNING_BORDER_COLOR]"  class="form-control" placeholder="Color" value="<?php if(isset($adminsetting['BTN_WARNING_BORDER_COLOR'])) echo $adminsetting['BTN_WARNING_BORDER_COLOR']; ?>">
                                    </div>
                                 </div>
                              </div>
                              
                              <div class="col-md-6">
                                 <div class="form-group row">
                                    <label class="control-label text-right col-md-4">GST %</label>
                                    <div class="col-md-8">
                                       <input type="text" name="adminsetting[GST_PERCENTAGE]"  class="form-control" placeholder="Percentage" value="<?php if(isset($adminsetting['GST_PERCENTAGE'])) echo $adminsetting['GST_PERCENTAGE']; ?>">
                                    </div>
                                 </div>
                              </div>
                              
                                                            
                              <div class="col-md-6">
                                 <div class="form-group row">
                                    <label class="control-label text-right col-md-4">Hide Users</label>
                                    <div class="col-md-8">
                                       <ul style="padding-left:2px;height:150px;overflow-y:scroll;border: 1px solid #e4e4e4;" class="users_list" id="users_list">
                                          <?php foreach($user as $key => $val){ ?>
                                          <?php if(in_array($val->user_id,$adminsetting['HIDE_USER'])){ ?>
                                          <li><input type="checkbox" name="adminsetting[HIDE_USER][]" value="<?php echo $val->user_id; ?>" id="user_<?php echo $val->user_id; ?>" checked ><label for="user_<?php echo $val->user_id; ?>"><?php echo $val->full_name.'('.$val->user_name.')'; ?> </label></li>
                                          <?php }else{ ?>
                                          <li><input type="checkbox" id="user_<?php echo $val->user_id; ?>" name="adminsetting[HIDE_USER][]" value="<?php echo $val->user_id; ?>" ><label for="user_<?php echo $val->user_id; ?>"><?php echo $val->full_name.'('.$val->user_name.')'; ?> </label> </li>
                                          <?php } ?>
                                          <?php } ?>
                                       </ul>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane p-20" id="tabsitesetting" role="tabpanel">
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" title="APPLICATION TITLE" name="adminsetting[APP_TITLE]"  class="form-control" placeholder="Title" value="<?php if(isset($adminsetting['APP_TITLE'])) echo $adminsetting['APP_TITLE']; ?>">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane p-20" id="tabidreference" role="tabpanel">
                           <div class="row">
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <div class="form-line">
                                       <label>Super Admin</label>
                                       <input type="text" name="adminsetting[UG_ID_SADMIN]"  class="form-control" value="<?php if(isset($adminsetting['UG_ID_SADMIN'])) echo $adminsetting['UG_ID_SADMIN']; ?>" placeholder="ID">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <div class="form-line">
                                       <label>Admin</label>
                                       <input type="text" name="adminsetting[UG_ID_ADMIN]"  class="form-control" value="<?php if(isset($adminsetting['UG_ID_ADMIN'])) echo $adminsetting['UG_ID_ADMIN']; ?>" placeholder="ID">
                                    </div>
                                 </div>
                              </div>
                          
                           <div class="col-md-4">
                              <div class="form-group">
                                 <div class="form-line">
                                    <label>Admin User Group Id</label>
                                    <input type="text" name="adminsetting[ADMIN_USER_GROUP_ID]"  class="form-control" value="<?php if(isset($adminsetting['ADMIN_USER_GROUP_ID'])) echo $adminsetting['ADMIN_USER_GROUP_ID']; ?>" placeholder="ID">
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <div class="form-line">
                                    <label>Habasit Supplier Id</label>
                                    <input type="text" name="adminsetting[HABASIT_SUPPLIER_ID]"  class="form-control" value="<?php if(isset($adminsetting['HABASIT_SUPPLIER_ID'])) echo $adminsetting['HABASIT_SUPPLIER_ID']; ?>" placeholder="ID">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
            </div>
            <br>
            <button class="btn btn-success pull-right submit" type="submit" value="save" id="form">Update Settings</button>	
            </form>
         </div>
      </div>
   </div>
</div>
</div>	
<script>
   $('.ckeditor').each(function(index){
   	var editor_id = $(this).attr('id');
   	CKEDITOR.replace( editor_id, {
   		height:"200px",
   		on: {
   			blur: onBlur,
   			key: onKeyup
   		}
   	});
   });
</script>
<script>
   $(function(){
      // Generate OTP
   $("#test_sms").on('click',function () {
   	var mobile = $('#mobile').val();
   	$.ajax({
   		type: 'POST',
   		dataType:'json',
   		data:{mobile:mobile},
   		url: '<?php echo base_url(); ?>index.php/adminsetting/testSms',
   		success: function(json) {
   			if(json == 'false'){
   				$('.msg').html('<div role="alert" class="alert alert-danger alert-dismissible "><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button><strong>SMS not sent... </strong></div>');
   			}else{
   				$('.msg').html('<div role="alert" class="alert alert-success alert-dismissible "><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button><strong>SMS sent successfully... </strong></div>');
   				
   			}
   			$("html, body").animate({ scrollTop: 0 }, "slow");
   
   		}
   	});
   });
   
   $("#test_email").on('click',function () {
   	$.ajax({
   		type: 'POST',
   		dataType:'json',
   		url: '<?php echo base_url(); ?>index.php/adminsetting/testEmail',
   		beforeSend: function(){
   			$("#test_email").html("Sending...Please wait...");
   		},
   		success: function(json) {
   			$("#test_email").html("Test Email");
   			if(!json){
   				$('.msg').html('<div role="alert" class="alert alert-danger alert-dismissible "><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button><strong>Mail not sent... </strong></div>');
   				
   			}else{
   				$('.msg').html('<div role="alert" class="alert alert-success alert-dismissible "><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button><strong>Mail sent successfully... </strong></div>');
   				
   			}
   			$("html, body").animate({ scrollTop: 0 }, "slow");
   		}
   	});
   });
   
   });
   
</script>
