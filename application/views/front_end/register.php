</div>

<?php

$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http").'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

$franchise_by = $this->common_model->get_count_data_manual('franchise',array('referral_link'=>$url,'status'=>'APPROVED','is_deleted'=>'No'),1,'id');

$birth_date = '';

?>

    <div class="">

        <div class="container">

            <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12 text-center">

                    <div class="reg-login-box"  id="first_div"><h1>

                        <p class="calibri-Bold-font f-22 color-31">REGISTER FOR <span class="color-d"> FREE</span></p></h1>

                        <form method="post" id="register_step1" name="register_step1" action="<?php echo $base_url; ?>register/save-register">

                        

                       

                        <div class="reg-box pb-5">

                            <div class="clearfix"></div>

                            <div id="reponse_message_step1" style="margin-bottom: 0px;"></div>

                            <div class="clearfix"></div>

                            <?php

                            if($this->session->flashdata('error_message'))

                            {

                            ?>

                            <div class="alert alert-danger"><?php

                                echo $this->session->flashdata('error_message'); ?>

                            </div>

                            <?php

                                }

                            ?>

                            <!--Start Custom radio button-->

                           <div class="row-cstm">

                                <label class="lable-cstm Poppins-Medium f-16 color-31">Gender :</label>

                                <div class="md-radio" onClick="add_gender_class('male')">

									<input id="1" type="radio" name="g" checked>

									<label for="1" class="Poppins-Medium default-color color-d" id="male_id">Male</label>

								</div>

								<div class="md-radio" onClick="add_gender_class('female')">

									<input id="2" type="radio" name="g">

									<label for="2" class="default-color" id="female_id">Female</label>

								</div>

								<input type="hidden" name="gender" id="gender" value="<?php if(isset($_REQUEST['gender']) && $_REQUEST['gender']!=''){ echo $_REQUEST['gender'];}else{ echo 'Male';}?>">

                            </div>

                            <!--End Custom radio button-->

                            <div class="row-cstm">

                                <div class="reg-input">

                                    <input type="email" class="form-control reg_input" required name="email" id="usr2" value="<?php if(isset($_REQUEST['email']) && $_REQUEST['email'] !=''){ echo $_REQUEST['email'];}?>" placeholder="Enter your Email ID">

                                    <input type="hidden" name="email_varifired" id="email_varifired" value="0" />

                                        <input type="hidden" name="is_post" id="is_post" value="1" />

                                </div>

                            </div>

						

                            <div class="row ">

								<div class="reg-input">

									<div class="col-md-4 col-sm-4 col-xs-4" id="country_codes">

											<select name="country_code" id="country_code" required style="height:44px;" class="form-control valid">

												<?php if(isset($_REQUEST['country_code']) && $_REQUEST['country_code'] !=''){  $val=$_REQUEST['country_code'];}else{  $val='+91';}?>

												<option value="">Select Country Code</option>

												<?php echo $this->common_model->country_code_opt($val);?>

											</select>

									</div>

									<div class="col-md-8 col-sm-8 col-xs-8">

											<input type="text" class="form-control reg_input mtc-10" required name="mobile_number" id="mobile_number" placeholder="Enter Your Mobile No" minlength="7" maxlength="13" value="<?php if(isset($_REQUEST['mobile_number']) && $_REQUEST['mobile_number']!=''){ echo $_REQUEST['mobile_number'];}?>"/>

									</div>

								</div>

                            </div>

                            <div class="row-cstm">

                                <div class="reg-input">

                                    <input type="password" class="form-control reg_input"  required name="password" id="password" minlength="6" value="<?php if(isset($_REQUEST['password']) && $_REQUEST['password']!=''){ echo $_REQUEST['password'];}?>" placeholder="Create a Password"/>

                                </div>

                            </div>

                            <div class="row-cstm pt-4"><h2>

                                <div class="e-t2">

                                <button class="Poppins-Medium f-17 color-f e-3_m" id="data">Next</button>

                                <!-- <a href="javascript:;" onclick="form.submit();"><div class="Poppins-Medium f-17 color-f e-3_m">

                                            Next

                                        </div></a> -->

                                    <!-- <a href="#">



                                        <div class="Poppins-Medium f-17 color-f e-3_m">

                                            Next

                                        </div>

                                    </a> -->

                                </div></h2>

                            </div>

                        </div>

                            <input type="hidden" name="status_front_page" id="status_front_page" value="<?php if(isset($_REQUEST['status_front_page']) && $_REQUEST['status_front_page']!=''){ echo $_REQUEST['status_front_page'];}?>">	

                        	<input type="hidden" name="id"  value="" />

                            <input type="hidden" name="mode"  value="add" />

                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" id="hash_tocken_id"  class="hash_tocken_id" />

                        </form>

                        <div class="col-md-12 col-sm-12 col-xs-12">

                            <div class="row-cstm">

                                <div class="col-md-12 col-sm-12 col-xs-12">

                                    <p class="Poppins-Regular color-83 f-13 reg-footer_r">Already a Member?

                                    <a href="<?php echo $base_url; ?>login"><span class="color-d Poppins-Medium">Login</span></a></p>

                                </div>

                                <!-- <div class="col-md-6 col-sm-6 col-xs-12">

                                    <p class="Poppins-Regular color-83 f-13 reg-footer_r">Sign UP with

                                        <span class="color-0a Poppins-Medium"><i class="fab fa-facebook-square"></i> Facebook</span></p>

                                </div> -->

                            </div>

                        </div>

                    </div>

                    <div class="reg-login-box" style="display:none;" id="second_div">

                        <p class="calibri-Bold-font f-22 color-31">Add Some Basic <span class="color-d">Details</span></p>

                        <form method="post" id="register_step2" name="register_step2" action="<?php echo $base_url; ?>register/save-register">

                        

                       

                        <div class="reg-box pb-5">

                            <div class="clearfix"></div>

                            <div id="reponse_message" style="margin-bottom: 0px;"></div>

                            <div class="clearfix"></div>

                            <?php

                            if($this->session->flashdata('error_message'))

                            {

                            ?>

                            <div class="alert alert-danger"><?php

                                echo $this->session->flashdata('error_message'); ?>

                            </div>

                            <?php

                                }

                            ?>

                           

                            <div class="row-cstm">

                                <div class="reg-input">

                                    <input type="text" class="form-control reg_input" required name="firstname" id="firstname" value="<?php if(isset($_REQUEST['firstname']) && $_REQUEST['firstname'] !=''){ echo $_REQUEST['firstname'];}?>" placeholder="Enter Your First Name">

                                    <input type="hidden" name="email_varifired" value="0" />

                                        <input type="hidden" name="is_post" value="1" />

                                </div>

                            </div>

                            <div class="row-cstm">

                                <div class="reg-input">

                                    <input type="text" class="form-control reg_input" required name="lastname" id="lastname" value="<?php if(isset($_REQUEST['lastname']) && $_REQUEST['lastname'] !=''){ echo $_REQUEST['lastname'];}?>" placeholder="Enter Your Last Name">

                                    

                                </div>

                            </div>

                            <div class="row-cstm">

                                <div class="reg-input">

                                    <?php echo $this->common_model->birth_date_picker($birth_date);?>

                                </div>

                            </div>

                            <div class="clearfix"></div>

                            <div class="row-cstm">

                                <div class="reg-input">

                                    <select class="form-control select-cust select2" required name="religion" id="religion" onChange="dropdownChange('religion','caste','caste_list')" style="width:100%;">

                                            <option value="">Select Religion</option>

											<?php echo $this->common_model->array_optionstr($this->common_model->dropdown_array_table('religion'));?>

                                    </select>

                                    

                                </div>

                            </div>

                            <div class="row-cstm">

                                <div class="reg-input">

                                    <select class="form-control select-cust select2" required name="caste" id="caste" style="width:100%;">

                                        <option value="">Select Your Religion First</option>

                                    </select>

                                </div>

                            </div>

							<div class="row-cstm">

								<div class="checkboxes mt-3">

									<label class="checkbox d-initial Poppins-Regular f-16 color-40">

										<input type="checkbox" name="terms" value='Yes' <?php if(isset($_REQUEST['terms']) && $_REQUEST['terms']!=''){ echo 'checked';}else{ echo '';}?>>

										<span class="indicator"></span>

										I agree to the<a href="#myModal505" data-toggle="modal" class="color-d"> Terms And Conditions</a>

									</label>

								</div>

							</div>

							<!--write something modal start-->

							<div id="myModal505" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog  modal-dialog-vendor">

    



        <div class="modal-content">

            <div class="modal-header new-header-modal">

                <p class="Poppins-Bold mega-n3 new-event text-center">Terms and <span class="mega-n4 f-s">Conditions </span></p>

                <button type="button" class="close close-vendor" data-dismiss="modal" aria-hidden="true" style="    margin-top: -37px !important;">×</button>

            </div>

            <div class="modal-body">

                

                <div class="row">

                    

                    <div class="col-md-12 col-sm-12 col-xs-12">

					<?php if(isset($cms_pages['page_content']) && $cms_pages['page_content'] !='')

                            {	

                                echo $cms_pages['page_content'];

                            }

                            else

                            {	?>

                            <div class="no-data-f">

								<img src="<?php echo $base_url;?>assets/front_end_new/images/no-data.png" class="img-responsive no-data" />

								<h1 class="color-no"><span class="Poppins-Bold color-no">NO</span> DATA <span class="Poppins-Bold color-no"> FOUND </span></h1>

							</div>

                        <?php }?> 

                    </div>

                </div>

                

            </div>

        </div>

       

    </div>

    </div>

    <!--write something modal End-->

                            <div class="row-cstm pt-4">

                                <div class="e-t2">

                                    <button class="Poppins-Medium f-17 color-f e-3_m">Next</button>

                                    <button class="Poppins-Medium f-17 color-f e-3_m back_b_d mt-4" onClick="back_tostep()" >Back</button>

                                </div>

                            </div>

                        </div>

                        <input type="hidden" name="base_url" id="base_url" value="<?php echo $base_url; ?>" />

                            <input type="hidden" name="id" id="id" value="" />

                            <input type="hidden" name="mode" id="mode" value="add" />

                            <input type="hidden" name="franchised_by" id="franchised_by" value="<?php if(isset($franchise_by['id']) && $franchise_by['id']!=''){echo $franchise_by['id'];}?>">

                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" class="hash_tocken_id" />

                            

                        </form>

                        

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="clearfix"></div>

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

	            <div id="termsandconditions" class="modal fade in" role="dialog" style="display: none; padding-right: 17px;">

                    <div class="modal-dialog" style="width:1000px;">

                        <div class="modal-content">

                            <div class="modal-header">

                                <button type="button" class="close" data-dismiss="modal">×</button>

                                <h4 class="modal-title"><i class="fa fa-lock"></i> Terms and Conditions</h4>

                            </div>

                            <div class="modal-body">

                                <div class="alert alert-danger" style="display:none" id="error_message_mv"></div>

                                <div class="alert alert-success" style="display:none" id="success_message_mv"></div>

                                <div id="displ_mobile_generate">

								<?php if(isset($cms_pages['page_content']) && $cms_pages['page_content'] !='')

                            {	

                                echo $cms_pages['page_content'];

                            }

                            else

                            {	?>

                            <div class="col-md-4 col-sm-12 col-xs-12">

                                <div class="padding-lr-zero-xs" style="margin-bottom:0px;">

                                    <div class="new_reg">

                                        <header class="header_bg" style="margin-bottom:0px;">

                                            <h1 style="margin: 0px !important;">No Data Available</h1>

                                        </header> 

                                    </div>

                                </div>

                            </div>

                        <?php }?>  

                                </div>                               

                            </div>

                            <div class="modal-footer" id="close_buttonn_div" style="display:block">

                                <a class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</a>

                            </div>

                        </div>

                    </div>

                </div>

	<!-- ========= <div class="container"> End =========-->	

    <script src="<?php echo $base_url; ?>assets/front_end_new/js/jquery.min.js?ver=1.0"></script>		

    <script src="<?php echo $base_url; ?>assets/front_end_new/js/bootstrap.min.js?ver=1.0"></script>

    <script src="<?php echo $base_url; ?>assets/front_end_new/js/jquery.sticky.js?ver=1.0"></script>

    <script src="<?php echo $base_url; ?>assets/front_end_new/js/select2.js?ver=1.0"></script>

    <script src="<?php echo $base_url; ?>assets/front_end_new/js/common.js?ver=1.0"></script>

    <script src="<?php echo $base_url; ?>assets/front_end_new/js/additional-methods.min.js?ver=1.0"></script>

	<script>

	<?php if(isset($_REQUEST['gender']) && $_REQUEST['gender']!=''){?>add_gender_class('".$_REQUEST['gender']."');<?php } ?>

	// mobile menu start

	$(document).ready(function() {

		$("#sidebar").mCustomScrollbar({

			theme: "minimal"

		});

		

		$('#dismiss, .overlay').on('click', function() {

			$('#sidebar').removeClass('active');

			$('.overlay').removeClass('active');

		});

		

		$('#sidebarCollapse').on('click', function() {

			$('#sidebar').addClass('active');

			$('.overlay').addClass('active');

			$('.collapse.in').toggleClass('in');

			$('a[aria-expanded=true]').attr('aria-expanded', 'false');

		});

	});

	// mobile menu ends

	$("#menu-toggle").click(function(e) {

		e.preventDefault();

		$("#wrapper").toggleClass("toggled");

		$(this).find('i').toggleClass('fa-navicon fa-times')

		

	});

	$(document).ready(function() {

		$('.js-example-basic-single').select2();

	});

    // function add_gender_class(id)

	// {

	// 	if(id=="male")

	// 	{

	// 		$("#ml").addClass("color-d Poppins-Medium");

	// 		$("#fml").removeClass("color-d Poppins-Medium");

	// 		$("#gender").val('Male');

	// 	}

	// 	else

	// 	{

	// 		$("#ml").removeClass("color-d Poppins-Medium");

	// 		$("#fml").addClass("color-d Poppins-Medium");

	// 		$("#gender").val('Female');

	// 	}

	// }

	function add_gender_class_2(id)

	{

		if(id=="male2")

		{

			$("#m2").addClass("color-d");

			$("#fm2").removeClass("color-d");

		}

		else

		{

			$("#m2").removeClass("color-d");

			$("#fm2").addClass("color-d");

		}

	}

</script>

    

		<script>

		<!-----------------Gender Radio Button-------------------->

		$('#radioBtn a').on('click', function(){

			var sel = $(this).data('title');

			var tog = $(this).data('toggle');

			$('#'+tog).prop('value', sel);

			$('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');

			$('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');

		});

		

		$( document ).ready(function() {

			$('select').select2();

			var gender = $('#gender').val();

			var email = $('#email').val();

			var mobile_number = $('#mobile_number').val();

			var password = $('#password').val();

			var status_front_page = $('#status_front_page').val();

			

			if(gender!='' && mobile_number!='' && password!='' && email!='' && status_front_page=='Yes')

			{

				//$( "#next_auto_step" ).trigger("click");

				$( "#second_div" ).css("display","block");

				$( "#first_div" ).hide(); 

			}

		});

		$( "#next_form" ).click(function() {

		$( "#second_div" ).css("display","block");

		$( "#first_div" ).hide();

	});

	//back_tostep();

	function back_tostep(){

		$( "#second_div" ).hide();

		$( "#first_div" ).css("display","block");

       // $( "#second_div" ).hide();

	}

	//$('select').select2();

	if($("#register_step1").length > 0){

		$("#register_step1").validate({

			rules: {

				mobile_number: {

				  required: true,

				  number: true

				},

			},			 

			submitHandler: function(form){

				//return true;

				/*if($("#email_varifired").val() == 0 && $("#email").val() !=''){

					$("#email-error").text('Duplicate Email address found, please enter another one');

					$("#email-error").show();

					$("#email").addClass('error');

					return false;

				}*/

				/*var validator = $( "#register_step1" ).validate();

				alert(validator);

				validator.showErrors({

				  "mobile_number": "I know that your firstname is Pete, Pete!"

				});*/

				var mobile_number = $("#mobile_number").val();

				if(mobile_number !='')

				{

					var isnum = /^\d+$/.test(mobile_number);

					if(!isnum)

					{

						alert("Please enter valid number only");

						$("#mobile_number").val('');

						$("#mobile_number").focus();

						return false;

					}

				}

				var form_data = $('#register_step1').serialize();

				form_data = form_data+ "&is_post=0";

				var action = "<?php echo $base_url; ?>register/check_duplicate";

				show_comm_mask();

				$.ajax({

				   url: action,

				   type: "post",

				   dataType:"json",

				   data: form_data,

				   success:function(data)

				   {

					    $("#reponse_message_step1").removeClass('alert alert-success alert-danger');

						$("#reponse_message_step1").html(data.errmessage);

						$("#reponse_message_step1").slideDown();

						update_tocken(data.tocken);

						hide_comm_mask();

						if(data.status == 'success')

						{

							$("#reponse_message_step1").html('');

							$( "#second_div" ).css("display","block");

					        $( "#first_div" ).hide();

						}

						else

						{

							$("#reponse_message_step1").addClass('alert alert-danger');

						}

				   }

				});

				return false;

			}

		});

	}

	if($("#register_step2").length > 0)

	{

		$("#register_step2").validate({

			rules: {

				firstname: {

				  required: true,

				  lettersonly: true

				},

				lastname: {

				  required: true,

				  lettersonly: true

				},

			 },

			submitHandler: function(form)

			{

				//return true;

				var form_data = $('#register_step1, #register_step2').serialize();

				form_data = form_data+ "&is_post=0";

				var action = $('#register_step2').attr('action');

				show_comm_mask();

				$.ajax({

				   url: action,

				   type: "post",

				   dataType:"json",

				   data: form_data,

				   success:function(data)

				   {

					   $("#reponse_message").removeClass('alert alert-success alert-danger');

						$("#reponse_message").html(data.errmessage);

						$("#reponse_message").slideDown();

						update_tocken(data.tocken);

						hide_comm_mask();

						if(data.status == 'success')

						{

							is_reload_page = 1;

							$("#reponse_message").addClass('alert alert-success');

							document.getElementById('register_step2').reset();

							var red_url = '';

							setTimeout(function(){

								window.location.href = $("#base_url").val()+'register/step2';

							},2000);

						}

						else

						{

							$("#reponse_message").addClass('alert alert-danger');

						}

				   }

				});

				return false;

			}

		});

	}

	

	

	function add_gender_class(id)

	{

		if(id=="male")

{

	$("#male_id").addClass("color-d");

	$("#male_id").addClass("Poppins-Medium");

	$("#female_id").removeClass("color-d");

	$("#female_id").removeClass("Poppins-Medium");

	$("#gender").val('Male');

}

	else

{

	$("#male_id").removeClass("color-d");

	$("#male_id").removeClass("Poppins-Medium");

	$("#female_id").addClass("color-d");

	$("#female_id").addClass("Poppins-Medium");

	$("#gender").val('Female');

	}

}

	</script>

    

	<div class="clearfix"></div>

	<!-- <div id="lightbox-panel-mask"></div> -->

	<div id="lightbox-panel-loader" style="text-align:center;display:none;">

	<img alt="Please wait.." title="Please wait.." src="<?php echo $base_url; ?>assets/front_end/images/loading.gif" />

	</div>

	

	</body>

</html>

    