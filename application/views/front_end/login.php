</div>

    <div class="login-reg-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                    <div class="reg-login-box"><h1>
                        <p class="calibri-Bold-font f-22 color-31">LOG<span class="color-d">IN</span></p>
                       </h1> <form action="<?php echo $base_url; ?>login/check_login" method="post" id="login_form" name="login_form">
                        <div class="reg-box pb-5">
                        <?php
									if($this->session->flashdata('user_log_err'))
									{
								?>
								<div class="alert alert-danger"><?php
									echo $this->session->flashdata('user_log_err'); ?>
								</div>
								<?php
									}
								?>
								<div class="alert alert-danger" id="login_message" style="display:none"></div>
								<?php
									if($this->session->flashdata('user_log_out'))
									{
								?>
								<div class="alert alert-success" id="log_out_succ">
									<?php echo $this->session->flashdata('user_log_out'); ?>
								</div>
								<?php
									}
								?>
                            <div class="row-cstm">
                                <div class="reg-input">
                                    <input type="text" class="form-control reg_input" required name="username" id="username" placeholder="Enter your Email ID or Matri ID">
                                </div>
                            </div>
                            <div class="row-cstm">
                                <div class="reg-input">
                               
                                    <input type="password" class="form-control reg_input" required name="password" id="password" placeholder="Enter Password">
                                   
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="reg-input">
                                    <div class="col-md-3 col-sm-3 col-xs-6 captcha_11" id="captcha_login">
                                        <img src="<?php echo $base_url; ?>captcha.php?captch_code_front=yes&captch_code=<?php echo $this->session->userdata['captcha_code']; ?>" style="border-radius: 6px;" alt="" />
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-6">
                                        <a title="Change Captcha Code" href="javascript:;" onClick="change_captcha_code('captcha_login','captcha_code')"><i title="Change Captcha Code" class="fa fa-refresh fa-1 curser_icon"></i></a>
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-12">
                                        <input required type="number" name="code_captcha" id="code_captcha" class="form-control reg_input" placeholder="Enter Captcha" value="" /> 
                                    </div>
                                </div>
                            </div>
                            <div class="row pull-right">
                                <div class="reg-input">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <p class="Poppins-Regular color-83 f-13">
                                        <a href="<?php echo $base_url; ?>login/forgot-password"><span class="color-d Poppins-Medium">Forgot Password ?</span></a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row-cstm pt-4">
                                <div class="e-t2">
                                <input type="submit" class="Poppins-Medium f-17 color-f e-3_m" value="Login" >
                                   
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" id="hash_tocken_id" class="hash_tocken_id" />
                                    <input type="hidden" name="base_url" id="base_url" value="<?php echo $base_url; ?>" />
                                    <input type="hidden" name="is_post" id="is_post" value="1" />
                                </div>
                            </div>
                        </div>
                        </form>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="row-cstm">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <p class="Poppins-Regular color-83 f-13 reg-footer_r">New Member?
                                    <a href="<?php echo $base_url; ?>register"><span class="color-d Poppins-Medium">Register Free</span></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="lightbox-panel-mask"></div>
<div id="lightbox-panel-loader" style="text-align:center;display:none"><img alt="Please wait.." title="Please wait.." src='<?php echo $base_url; ?>assets/front_end/images/loading.gif' /></div>
<?php
$this->common_model->user_ip_block();
if(base_url()!='http://192.168.1.111/mega_matrimony/original_script/'){
	$uri_segment_check_red = $this->uri->segment(1);
	if(isset($uri_segment_check_red) && $uri_segment_check_red!=''){
		$uri_segment_check_red = $this->uri->segment(1);
	}
	else{
		$uri_segment_check_red = basename($_SERVER['PHP_SELF']);
	}
	if(isset($uri_segment_check_red) && $uri_segment_check_red!='' && $uri_segment_check_red!="blocked"){
		$details = $this->common_model->add_user_analysis();
	}
} 
$client_key = "";
if(isset($fb_detail['client_key']) && $fb_detail['client_key']!=''){
	$client_key = $fb_detail['client_key']; 
}
?>
<!-- ======== <div class="container"> End ======== -->
    <script src="<?php echo $base_url; ?>assets/front_end_new/js/jquery.min.js?ver=1.0"></script>
    <script src="<?php echo $base_url; ?>assets/front_end_new/js/bootstrap.min.js?ver=1.0"></script>
    <script src="<?php echo $base_url; ?>assets/front_end_new/js/jquery.sticky.js?ver=1.4"></script>
	<script src="<?php echo $base_url; ?>assets/front_end_new/js/select2.js?ver=1.0"></script>
    <script>
        function change_captcha_code(captcha_div_id,captcha_session)
		{
			var base_url = $("#base_url").val();
			var action = base_url+'login/change_captcha';
			var hash_tocken_id = $("#hash_tocken_id").val();
			show_comm_mask();
			$.ajax({
				url: action,
				type: "post",
				data: {"csrf_new_matrimonial":hash_tocken_id,'captcha_session':captcha_session},
				success:function(data)
				{
				$("#"+captcha_div_id).html(data);
				$("#code_captcha").val('');
				hide_comm_mask();
				}
			});
		}
    	if($("#login_form").length > 0)
		{
			$("#login_form").validate({
				submitHandler: function(form)
				{
					//return true;
					check_validation();
				}
			});
		}
		function check_validation()
		{
			var username = $("#username").val();
			var password = $("#password").val();
			var code_captcha = $("#code_captcha").val();
			show_comm_mask();
			var hash_tocken_id = $("#hash_tocken_id").val();
			var base_url = $("#base_url").val();
			var url = base_url+"login/check-login";
			$("#log_out_succ").hide();
			$("#login_message").hide();
			$.ajax({
			   url: url,
			   type: "post",
			   data: {'username':username,'password':password,'<?php echo $this->security->get_csrf_token_name(); ?>':hash_tocken_id,'is_post':0,'code_captcha':code_captcha},
			   dataType:"json",
			   success:function(data)
			   {
				   //alert(data);
				  // return false;
				   //alert(JSON.parse(data));
					if(data.status == 'al_ready_login')
					{	
						//alert('inn');					
						window.location.href = base_url+"my-dashboard";
						return false;
					}
					if(data.status == 'success')
					{
						$("#login_message").removeClass('alert alert-danger');
						$("#login_message").addClass('alert alert-success');
						$("#login_message").html(data.errmessage);
						$("#login_message").slideDown();
						if(data.plan_id != ''){
							window.location.href = base_url+"premium-member/buy-now/"+data.plan_id;
						}else{
							window.location.href = base_url+"my-profile";
						}
						return false;
					}
					else
					{
						$("#login_message").html(data.errmessage);
						$("#login_message").slideDown();
						$("#hash_tocken_id").val(data.token);
					}
					hide_comm_mask();
			   }
			});
			return false;
		}
		$(document).ready(function(){
		setTimeout(function() {
			$('#log_out_succ').fadeOut('fast');
			}, 10000);
		});
		
		
		$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
		$(this).find('i').toggleClass('fa-navicon fa-times')
		
	});
	$(document).ready(function() {
		$('.js-example-basic-single').select2();
	});
    </script>
    
	 
</body>
</html>