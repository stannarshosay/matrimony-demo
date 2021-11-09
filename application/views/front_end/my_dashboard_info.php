<?php $curre_id = $this->common_front_model->get_session_data('id');
$percentage_stored = $this->common_front_model->getprofile_completeness($curre_id);?>
    <?php $cover_path = $this->common_model->path_cover_photo;
	if(isset($member_data_mobile['cover_photo']) && $member_data_mobile['cover_photo'] !='' && file_exists($cover_path.$member_data_mobile['cover_photo'])){
		$cover_img = "style='background-image: url(".$base_url.$cover_path.$member_data_mobile['cover_photo'].") !important;'";
    }else{
    	$cover_img = "style='background-image: url(".$base_url.$this->common_model->default_cover_photo.") !important;'";
    }?>
	<div class="dshbrd_side_section hidden-sm hidden-xs">
        <div class="dshbrd_overlay">
            <div class="dshbrd_color_overlay" <?php echo $cover_img;?> >
                <div class="side_panel_dshbrd">
                    <div class="row margin-0">
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <?php if(isset($member_data_mobile['photo1']) && $member_data_mobile['photo1']!=''){?>
                                <img src="<?php echo $base_url.$this->common_model->path_photos.$member_data_mobile['photo1'];?>" alt="<?php if(isset($current_login_user['username']) && $current_login_user['username'] !=''){ echo ucwords($current_login_user['username']);} ?>" class="img-responsive dshbrd_pro">
                            <?php }else{?>
                                <img src="<?php echo $defult_photo;?>" alt="<?php if(isset($current_login_user['username']) && $current_login_user['username'] !=''){ echo ucwords($current_login_user['username']);} ?>" class="img-responsive dshbrd_pro">
                            <?php }?>
                        </div>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <div class="l-height-19">
                                <div class="row-cstm">
                                    <div class="col-md-8 col-sm-8 col-xs-12 padding-0">
                                        <p class="Poppins-Semi-Bold f-20 color-f dshbrd_pro_nme"><?php if(isset($current_login_user['username']) && $current_login_user['username'] !=''){ echo ucwords($current_login_user['username']);} ?></p>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-12 padding-0">
                                        <div class="progressbar-title red">
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $percentage_stored; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percentage_stored; ?>%;"></div>
                                            </div>
                                            <span class="progressbar-value Poppins-Regular f-13 color-f dshbrd_progree_lable"> <span class="Poppins-Semi-Bold f-14"><?php echo $percentage_stored; ?></span> % Completed Profile</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12 padding-0">
                                    </div>
                                </div>
                                <div class="row-cstm">
                                    <div class="col-md-12 col-sm-12 col-xs-12 padding-0">
                                        <p class="Poppins-Regular f-14 color-f  dshbrd_pro_nme"><?php if(isset($member_data_mobile['occupation_name']) && $member_data_mobile['occupation_name'] !=''){ echo $member_data_mobile['occupation_name'];} ?></p>
                                    </div>
                                </div>
                                <div class="row-cstm">
                                    <div class="col-md-4 col-sm-4 col-xs-4 padding-0">
                                        <p class="Poppins-Regular f-14 color-f dshbrd_pro_nme">Matri ID</p>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-4 padding-0">
                                        <p class="Poppins-Medium f-14 color-f dshbrd_pro_nme"><?php if(isset($current_login_user['matri_id']) && $current_login_user['matri_id'] !=''){ echo $current_login_user['matri_id'];} ?></p>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-12 padding-0">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="row-cstm">
                                    <div class="col-md-4 col-sm-4 col-xs-4 padding-0">
                                        <p class="Poppins-Regular f-14 color-f dshbrd_pro_nme">Date of Birth</p>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-4 padding-0">
                                        <p class="Poppins-Medium f-14 color-f dshbrd_pro_nme"><?php if(isset($member_data_mobile['birthdate']) && $member_data_mobile['birthdate'] !=''){ echo $member_data_mobile['birthdate'];} ?></p>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-12 padding-0">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="row-cstm">
                                    <div class="col-md-4 col-sm-4 col-xs-4 padding-0">
                                        <p class="Poppins-Regular f-14 color-f dshbrd_pro_nme">Work Phone</p>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-4 padding-0">
                                        <p class="Poppins-Medium f-14 color-f dshbrd_pro_nme"><?php if(isset($member_data_mobile['mobile']) && $member_data_mobile['mobile'] !=''){ echo $member_data_mobile['mobile'];} ?></p>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-12 padding-0">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="row-cstm">
                                    <div class="col-md-4 col-sm-4 col-xs-4 padding-0">
                                        <p class="Poppins-Regular f-14 color-f dshbrd_pro_nme">Email</p>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-4 padding-0">
                                        <p class="Poppins-Medium f-14 color-f dshbrd_pro_nme"><?php if(isset($member_data_mobile['email']) && $member_data_mobile['email'] !=''){ echo $member_data_mobile['email'];} ?></p>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-12 padding-0">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12 padding-0">
							<?php if($this->router->fetch_class()!='my_dashboard' || $email!='' && $email_status == 'Verify'){?>
                                <div class="col-md-4 col-sm-4 col-xs-12 padding-0">
                                    <div class="dshbrd_edit_btns dshbrd_right_1">
                                        <button type="button" onclick="window.location.href='<?php echo $base_url;?>my-profile'" class="dshbrd_11 Poppins-Medium f-10">My Profile</button>
                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-8 col-xs-12 padding-0">
                                    <div class="dshbrd_edit_btns dshbrd_right">
                                        <button type="button" onclick="window.location.href='<?php echo $base_url;?>upload/cover-photo'" class="dshbrd_12 Poppins-Medium f-10">Edit Cover Photo</button>
                                    </div>
                                </div>
                           	<?php }else{?>
                                <div class="col-md-12 col-sm-12 col-xs-12 padding-0">
                                    <div class="dshbrd_edit_btns dshbrd_right">
                                        <button type="button" onclick="window.location.href='<?php echo $base_url;?>my-profile'" class="dshbrd_12 Poppins-Medium f-10">My View Profile</button>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 padding-0">
                                    <div class="dshbrd_edit_btns dshbrd_right">
                                        <button type="button" onclick="window.location.href='<?php echo $base_url;?>upload/cover-photo'" class="mt-4 dshbrd_12 Poppins-Medium f-10">Edit Cover Photo</button>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 padding-0">
                                    <div class="dshbrd_edit_btns dshbrd_right">
                                        <button type="button" data-toggle="modal" data-target="#myModal_verify_email" id="myModal_verify_email_btn" class="mt-4 dshbrd_12 Poppins-Medium f-10" title="Email Address Not Verified">Verify Email</button>
                                    </div>
                                </div>
                           	<?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $this->common_model->js_extra_code_fr.="
$(document).ready(function(){
	var dashbord_info = '<style>.dshbrd_pro_nme {line-height: 20px;}</style>';
	$('head').append(dashbord_info);
});";?>          