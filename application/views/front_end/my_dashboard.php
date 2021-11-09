<?php	
	$comm_model = $this->common_model;
	$curre_gender = $this->common_front_model->get_session_data('gender');
	$matri_id = $this->common_front_model->get_session_data('matri_id');
    $curre_id = $this->common_front_model->get_session_data('id');
    $member_id = $this->common_front_model->get_session_data('matri_id');
	$curre_data = $this->common_front_model->get_session_data();
	
	$member_data_mobile = '';
	if(isset($curre_id) && $curre_id!=''){
		$where_array = array('id'=>$curre_id, 'is_deleted'=>'No');
		$member_data_mobile = $this->common_model->get_count_data_manual('register_view',$where_array,1,'id,matri_id,photo1,username,email,mobile,occupation_name,mobile_verify_status,email,cpass_status,id_proof');
	}
	
	$mobile_num = '';
	$mobile_num_status = '';
	if(isset($member_data_mobile) && $member_data_mobile != "")
	{
		if(isset($member_data_mobile['mobile']) && $member_data_mobile['mobile']!='') 
		{
			$mobile_num = $member_data_mobile['mobile'];
		}
		if(isset($member_data_mobile['mobile_verify_status']) && $member_data_mobile['mobile_verify_status'] != '')
		{
			$mobile_num_status = $member_data_mobile['mobile_verify_status'];
		}
    }
    if(isset($member_data_mobile) && $member_data_mobile != "")
	{
		if(isset($member_data_mobile['mobile']) && $member_data_mobile['mobile']!='') 
		{
			$email = $member_data_mobile['email'];
		}
		if(isset($member_data_mobile['cpass_status']) && $member_data_mobile['cpass_status'] != '')
		{
			$email_status = $member_data_mobile['cpass_status'];
		}
	}
	//$this->common_model->extra_js_fr[] = 'js/editor.js';
	//$percentage_stored = $this->common_front_model->getprofile_completeness($curre_id);
	$where_arra_recent = array('is_deleted' => 'No', "status !='UNAPPROVED' and status !='Suspended'");
	if (isset($curre_gender) && $curre_gender != '') {
        $where_arra_recent[] = " gender != '$curre_gender' ";
	}
	
	if (isset($curre_gender) && $curre_gender == 'Male') {
		$photopassword_image = $base_url . 'assets/images/photopassword_female.png';
		} else {
		$photopassword_image = $base_url . 'assets/images/photopassword_male.png';
	}
$current_login_user = $this->common_front_model->get_session_data(); ?>
   
   <style>
       
		.testimonial .pic {
    	width: 185px;
    	height: 240px;
		}
		.testimonial .pic img {
   		 width: 185px;
    	height: 240px;
}
.pic-2{
	left:0px;
	top:160px;
}
.pic-2:before {
       content: '';
    position: absolute;
    left: 0px;
    right: 5px;
    top: 0px;
    bottom: 13px;
    background-image: linear-gradient(to bottom, rgba(255, 0, 0, 0), rgba(0, 0, 0, 0.94));
    /* opacity: 0.2; */
}

.matri-zero{
	opacity: 10;
    position: relative;
    z-index: 9999;
}
    </style> 
    
    </div>
    <div class="container-fluid width-95 mt-40-pro">
        <div class="row-cstm">
            <?php include_once('my_profile_sidebar.php');?>
        <div class="col-md-9 col-sm-9 col-xs-12 hidden-sm hidden-xs">
            <?php include_once('my_dashboard_info.php');?>
            <div class="row-cstm">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                    <p class="Poppins-Regular f-18 color-31 dshbrd_13">Recently Joined Members</p>
                </div>
            </div>
            <?php
                $div='i';
                $recent_profile = $this->common_model->get_count_data_manual('search_register_view', $where_arra_recent, 2, '*', 'id desc', 1, 4);
                if (isset($recent_profile) && $recent_profile != '' && count($recent_profile) > 0) {
                    $path_photos = $this->common_model->path_photos;
                    foreach ($recent_profile as $member_data_val) {
                        include('page_part/web_member_details.php');
             }
            }else{?>
                <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="no-data-f">
                                    <img src="<?php echo $base_url;?>assets/front_end_new/images/no-data.png" class="img-responsive no-data">
                                    <h1 class="color-no"><span class="Poppins-Bold color-no">NO</span> DATA <span class="Poppins-Bold color-no"> FOUND </span></h1>
                                </div>
                            </div>
                <?php }?>                     
            </div>
        </div>
        
        
        <!--for Mobile start--> 
            
        <?php include('my_profile_sidebar_mob.php');?>
        
        
    <div class="dshbrd_mobile_box hidden-lg hidden-md">
        <?php  //$recent_profiles = $this->common_model->get_count_data_manual('search_register_view', $where_arra_recent, 2, '*', 'id desc', 1, 4);
                    if (isset($recent_profile) && $recent_profile != '' && count($recent_profile) > 0) {?>
        <div class="row">
            <div class="col-sm-12 col-xs-12 text-center">
                <p class="Poppins-Bold f-18 color-31 dshbrd_13">Recently Joined Members</p>
            </div>
        </div>
        
        <?php
                   
                        $path_photos = $this->common_model->path_photos;
                        foreach ($recent_profile as $member_data_val) {
                            include('page_part/mob_member_details.php');
                        }
                        } ?>        
    
    
        <?php 
        $limit=4;
        $class3='p-8 pro-hidden';
        include('featured_rightsidebar.php');
        ?>
        <!--for mobile End-->
        
        
        
    </div>
    </div>
    </div>
    <?php include('my_dashboard_slider.php');?>
    <?php
            if ($mobile_num != '' && $mobile_num_status == 'No') {
                ?>  
    <div class="modal modal-sm fade varify_mobile_no in" id="myModal_verify_mobile" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content varify_mobile_content">
        <div class="modal-header header_t1">
          <button type="button" class="close close_modal" data-dismiss="modal">×</button>
          <p class="modal-title title_v1 Poppins-Semi-Bold color-f f-16"><img src="<?php echo $base_url; ?>assets/front_end_new/images/varify_icon.png" class="img-varify" alt="">Verify Your Mobile</p>
        </div>
        <div class="alert alert-danger" style="display:none" id="error_message_mv"></div>
        <div class="alert alert-success" style="display:none" id="success_message_mv"></div>
        <div id="displ_mobile_generate">
            <div class="modal-body">
                
            
                <label>Your Mobile Number</label>
                <input readonly value="<?php echo $mobile_num; ?>" type="text" placeholder="Your Mobile Number" class="form-control mt-2" />
                
                <!-- <a onClick="return generate_otp_verify()" class="btn btn-sm"><i class="fa fa-send" ></i> Generate OTP</a>
                <a class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</a> -->
            </div>
            <div class="modal-footer footer_t1">
                <div class="footer_btn2">
                    <button type="button" onclick="return generate_otp_verify()" class="generate_otp_btn_m"><i class="fa fa-send send_icon"></i>Generate OTP</button>
                    <button type="button" class="generate_otp_btn_m ml-16" data-dismiss="modal"><i class="fas fa-times send_icon"></i>Close</button>
                </div>
            </div>
        </div>
            <div id="verify_mobile_cont" style="display:none">
            <form class="form-group">
                <div class="modal-body">
                    
                        <label>Verification Code</label>
                        <input id="otp_mobile" value="" type="text" placeholder="Enter OTP Received on Your Mobile" class="form-control mt-2" />
                            <!--<span id="resend_link" style="display:none">-->
                        <span>
                            <a href="javascript:;" onClick="return generate_otp_verify()">Resend OTP</a>
                        </span>
                    

                </div> 
                <div class="modal-footer footer_t1">
                    <div class="footer_btn2">
                        <button type="button" onClick="return varify_mobile_check()" class="generate_otp_btn_m"><i class="fa fa-send send_icon"></i>Verify OTP</button>
                        <button type="button" class="generate_otp_btn_m ml-16" data-dismiss="modal"><i class="fas fa-times send_icon"></i>Close</button>
                    </div>
                </div>
                </form>
            </div>
        
      </div>
      
    </div>
  </div>
            <?php }
            if($email!='' && $email_status == 'Not-Verify'){
            ?> 
           		<div class="modal modal-sm fade varify_mobile_no" id="myModal_verify_email" role="dialog">
                    <div class="modal-dialog">
                    
                    <!-- Modal content-->
                    <div class="modal-content varify_mobile_content">
                        <div class="modal-header header_t1">
                        <button type="button" class="close close_modal" data-dismiss="modal">&times;</button>
                        <p class="modal-title title_v1 Poppins-Semi-Bold color-f f-16"><img src="<?php echo $base_url; ?>assets/front_end_new/images/varify_icon.png" class="img-varify" alt="">Confirm Your Email</p>
                        </div>
                        <div class="modal-body">
                        <div class="alert alert-danger" style="display:none" id="error_message_ev"></div>
                                                <div class="alert alert-success" style="display:none" id="success_message_ev"></div>
                                    <div id="displ_email_generate">
                                    <input type="hidden" id="base_url" value="<?php echo $base_url;?>">
                                                    <label>Click button to send email for confirm your email address..!</label>
                                
                                                </div>
                        </div>
                        <div class="modal-footer footer_t1">
                        <div class="footer_btn2">
                        <button type="button" onClick="return resend_confirm_mail('<?php echo $curre_id;?>')" class="generate_otp_btn_m"><i class="fa fa-send send_icon"></i>Confirm Email</button>
                        <button type="button" class="generate_otp_btn_m ml-16" data-dismiss="modal"><i class="fas fa-times send_icon"></i>Close</button>
                        </div>
                        </div>
                    </div>
                    
                    </div>
                </div>
				<?php }?>
				<?php
								if ($mobile_num != '' && $mobile_num_status == 'No')
								{
								?> 
                                	<span data-toggle="modal" data-target="#myModal_verify_mobile" id="myModal_verify_mobile_btn" class="profile-secure5" style="cursor:pointer" title="Mobile Number Not Verified" style="display:none;"></span>
                                    
								<?php }?>
                
                <?php
	if ($mobile_num != '' && $mobile_num_status == 'No')
	{
		$this->common_model->js_extra_code_fr .= " $('#myModal_verify_mobile_btn').trigger('click'); ";
    }
    include('page_part/front_button_popup.php');
$this->common_model->js_extra_code_fr .= "

/*for action hide show start*/
function more_details(id){
	$('#more_details_btns_'+id).fadeToggle();
	//scroll_to_div('more_details_btns_'+id);
}

function mob_more_details(id){
	$('#mob_more_details_btns_'+id).fadeToggle();
	//scroll_to_div('mob_more_details_btns_'+id);
};
/*for action hide show end*/

load_choosen_code();
$('.button-wrap').on('click', function(){
    $(this).toggleClass('button-active');
});

function fields(field)
{
    var value = $('#'+field).val();
    if(value=='')
    {
        alert('Please Add/Select Value');
    }
    else
    {
        var val = value;
        show_comm_mask();
    }
    var hash_tocken_id = $('#hash_tocken_id').val();
    var base_url = $('#base_url').val();
    var url = base_url+'my-dashboard/update-percentage-slider-field';
    $.ajax({
        url: url,
        type: 'POST',
        data:{'csrf_new_matrimonial':hash_tocken_id,'val':val,'field':field},
        dataType:'json',
        success: function(data) 
        { 	
            if(data.status == 'success')
            {
                $('#my_dashboard_slider_ajax').html(data.my_dashboard_data);
                update_tocken($('#hash_tocken_id_temp').val());
                setTimeout(function() {
                $('#update_field_success').fadeOut('fast');
                }, 5000);
                $('#progress_bar').html(data.progress);
                $('#hash_tocken_id_temp').remove();
            }
            $('#hash_tocken_id').val(data.token);
            hide_comm_mask();
        }
    });
    return false;
}

var win = null;
function newWindow(mypage,myname,w,h,features) {
    var winl = (screen.width-w)/2;
    var wint = (screen.height-h)/2;
    if (winl < 0) winl = 0;
    if (wint < 0) wint = 0;
    var settings = 'height=' + h + ',';
    settings += 'width=' + w + ',';
    settings += 'top=' + wint + ',';
    settings += 'left=' + winl + ',';
    settings += features;

    win = window.open(mypage,myname,settings);
    win.window.focus();
}
function resend_confirm_mail(user_id)
{
    var base_url = $('#base_url').val();
    var action = base_url +'my_dashboard/resend_confirm_mail';
    var hash_tocken_id = $('#hash_tocken_id').val();
    show_comm_mask();
    $.ajax({
        url: action,
        type: 'post',
        dataType:'json',
        data: {'csrf_new_matrimonial':hash_tocken_id,'user_id':user_id},
        success:function(data)
        {
            update_tocken(data.tocken);
            if(data.status == 'success')
            {
                $('#error_message_ev').hide();
                $('#success_message_ev').html(data.success_message);
                $('#success_message_ev').show();
                
                setTimeout(function(){ 
                    $('#success_message_ev').fadeOut('fast');
                },10000);
            }
            else
            {
                $('#success_message_ev').hide();
                $('#error_message_ev').html(data.error_message);
                $('#error_message_ev').show();
                setTimeout(function(){ 
                    $('#error_message_ev').fadeOut('fast');
                },10000);
            }
            hide_comm_mask();
        }
    });
    return false;
}
var markup ='';
	$('head').append(markup);
";
?>