<?php 
$current_login_user = $this->common_front_model->get_session_data(); 
$login_user_matri_id = $current_login_user['matri_id'];
$login_user_gender = $current_login_user['gender'];
$login_user_id = $current_login_user['id'];
$curre_id = $this->common_front_model->get_session_data('id');

if($login_user_gender == 'Male')
{
	$defult_photo = $base_url.'assets/front_end/img/default-photo/male.png';
}
else
{
	$defult_photo = $base_url.'assets/front_end/img/default-photo/female.png';
}
	
$member_data_mobile = '';
if(isset($curre_id) && $curre_id!='')
{
	$where_array = array('id'=>$curre_id, 'is_deleted'=>'No');
	$member_data_mobile = $this->common_model->get_count_data_manual('register_view',$where_array,1,'id,matri_id,birthdate,username,email,mobile,mobile_verify_status,email,occupation_name,cpass_status,id_proof,id_proof_approve,plan_name,plan_status,photo1,cover_photo,cover_photo_approve');
}

$mobile_num = '';
$mobile_num_status = '';
$email = '';
$email_status = '';
$id_proof = '';
$plan_name = '';
$plan_status = '';
$id_proof_approve = '';

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
	
	if(isset($member_data_mobile['email']) && $member_data_mobile['email']!='') 
	{
		$email = $member_data_mobile['email'];
	}
	if(isset($member_data_mobile['cpass_status']) && $member_data_mobile['cpass_status'] != '')
	{
		$email_status = $member_data_mobile['cpass_status'];
	}
	
	if(isset($member_data_mobile['id_proof']) && $member_data_mobile['id_proof'] != '')
	{
		$id_proof = $member_data_mobile['id_proof'];
	}
	if(isset($member_data_mobile['id_proof_approve']) && $member_data_mobile['id_proof_approve']!='')
	{
		$id_proof_approve = $member_data_mobile['id_proof_approve'];
	}
	
	if(isset($member_data_mobile['plan_name']) && $member_data_mobile['plan_name'] != '')
	{
		$plan_name = $member_data_mobile['plan_name'];
	}
	if(isset($member_data_mobile['plan_status']) && $member_data_mobile['plan_status'] != '')
	{
		$plan_status = $member_data_mobile['plan_status'];
    }
    if(isset($member_data_mobile['matri_id']) && $member_data_mobile['matri_id'] != '')
	{
		$matri_id=$member_data_mobile['matri_id'];
	}
}

if(isset($matri_id) && $matri_id!='')
{
	$where_arr = array('matri_id'=>$matri_id, 'is_deleted'=>'No');
	$member_plan = $this->common_model->get_count_data_manual('payments',$where_arr,1,'id,matri_id,plan_expired','id desc');
}

if(isset($member_plan) && $member_plan != "")
{
	if(isset($member_plan['plan_expired']) && $member_plan['plan_expired']!='') 
	{
		$plan_expired = $member_plan['plan_expired'];
	}
}
$today=date('Y-m-d');

//$this->common_model->extra_js_fr= array('js/owl.carousel.min.js','js/slider.js');
?>
<style>
.select_box5 .select2-container--default .select2-selection--multiple {
    
    
    border-radius: 0px;
    background-color: rgb(255, 255, 255) !important;
    
}
.select_box5 .select2-container--default.select2-container--focus .select2-selection--multiple {
    border: solid #aaaaaa 1px;
   
}
</style>
<div class="col-md-3 col-sm-3 col-xs-12 pr-0 hidden-sm hidden-xs">
	<div class="col-3-main">
        <?php /*?><div class="list-group">
            <a class="list-group-item google-plus" href="#">
                <p class="Poppins-Semi-Bold f-17 color-d dashbrd_1">
                <i class="fas fa-envelope dashbrd_user_icon"></i> Messages
                </p>
            </a>
            <?php
                $message_model = $this->common_front_model->load_message_model();
                $message_count = $message_model->get_message_count();
            ?>
            <a class="list-group-item visitor" href="<?php echo $base_url.'message/inbox/inbox'; ?>">
                <p class="Poppins-Medium f-16 color-38 dashbrd_3">
                    Inbox
                </p>
                <span class="Poppins-Semi-Bold f-16 color-38 dashbrd_4"><?php if(isset($message_count['inbox']) && $message_count['inbox'] !=''){ echo sprintf("%02d", $message_count['inbox']);} else{ echo sprintf("%02d", 0);} ?></span>
            </a>
			<a class="list-group-item visitor" href="<?php echo $base_url.'message/inbox/sent'; ?>">
                <p class="Poppins-Medium f-16 color-38 dashbrd_3">
                    Sent
                </p>
                <span class="Poppins-Semi-Bold f-16 color-38 dashbrd_4"><?php if(isset($message_count['sent']) && $message_count['sent'] !=''){ echo sprintf("%02d", $message_count['sent']);} else{ echo sprintf("%02d", 0);} ?></span>
            </a>
            <a class="list-group-item visitor" href="<?php echo $base_url.'message/inbox/draft'; ?>">
                <p class="Poppins-Medium f-16 color-38 dashbrd_3">
                    Draft
                </p>
                <span class="Poppins-Semi-Bold f-16 color-38 dashbrd_4"><?php if(isset($message_count['draft']) && $message_count['draft'] !=''){ echo sprintf("%02d", $message_count['draft']);} else{ echo sprintf("%02d", 0);} ?></span>
            </a>
        </div><?php */?>
        <?php 
            $received_data = $this->common_model->get_count_data_manual('photoprotect_request',array('photoprotect_request.ph_receiver_id'=>$login_user_matri_id,'rec_delete' => 'No'),0,'','','','','','');
            $send_data = $this->common_model->get_count_data_manual('photoprotect_request',array('photoprotect_request.ph_requester_id'=>$login_user_matri_id,'sen_delete'=>'No'),0,'','','','','','');
            $Like_data = $this->common_model->get_count_data_manual('member_likes',array('my_id'=>$login_user_matri_id,'like_status'=>'Yes'),0,'','','','','','');
            $Unlike_data = $this->common_model->get_count_data_manual('member_likes',array('my_id'=>$login_user_matri_id,'like_status'=>'No'),0,'','','','','','');
            $Short_List_data = $this->common_model->get_count_data_manual('shortlist',array('shortlist.is_deleted'=>'No','shortlist.from_id'=>$login_user_matri_id),0,'');
            $Block_data = $this->common_model->get_count_data_manual('block_profile',array('is_deleted'=>'No','block_by'=>$login_user_matri_id),0,'');
            $this->common_model->is_delete_fild = '';
            $where_arra=array('who_viewed_my_profile.my_id'=>$login_user_matri_id,"register_view.is_deleted"=>'No',"register_view.status!="=>'Suspended');
            $this->common_model->set_table_name('who_viewed_my_profile');
            $this->db->join('register_view',' who_viewed_my_profile.viewed_member_id = register_view.matri_id ','left');
            $i_view_data = $this->common_model->get_count_data_manual('who_viewed_my_profile',$where_arra,0,'','',0);
            // $i_view_data = $this->common_model->get_count_data_manual('who_viewed_my_profile',array('my_id'=>$login_user_matri_id,"register_view.status!="=>'Suspended'),0,'','',0);
            $this->common_model->is_delete_fild = '';
            $view_my_data = $this->common_model->get_count_data_manual('who_viewed_my_profile',array('viewed_member_id'=>$login_user_matri_id),0,'','',0);
            $expinter_data = $this->common_model->get_count_data_manual('expressinterest',array("is_deleted"=>'No',"(sender = '".$login_user_matri_id."' OR receiver = '".$login_user_matri_id."')"),0,'','',0);
        ?>
        <div class="list-group">
            <a class="list-group-item google-plus" href="#">
                <p class="Poppins-Semi-Bold f-17 color-d dashbrd_1">
                    <i class="fas fa-user dashbrd_user_icon"></i> List of profile
                </p>
            </a>

            <a class="list-group-item visitor" href="<?php echo $base_url.'my-profile/photo-pass-request-received'; ?>">
                <p class="Poppins-Medium f-16 color-38 dashbrd_3">
                Photo Request Received
                </p>
                <span class="Poppins-Semi-Bold f-16 color-38 dashbrd_4"><?php echo sprintf("%02d", $received_data); ?></span>
            </a>

            <a class="list-group-item visitor" href="<?php echo $base_url.'my-profile/photo-pass-request-sent'; ?>">
                <p class="Poppins-Medium f-16 color-38 dashbrd_3">
                Photo Request Sent
                </p>
                <span class="Poppins-Semi-Bold f-16 color-38 dashbrd_4"><?php echo sprintf("%02d", $send_data); ?></span>
            </a>

            <a class="list-group-item visitor" href="<?php echo $base_url.'my-profile/like-profile'; ?>">
                <p class="Poppins-Medium f-16 color-38 dashbrd_3">
                Like Profile
                </p>
                <span class="Poppins-Semi-Bold f-16 color-38 dashbrd_4"><?php echo sprintf("%02d", $Like_data); ?></span>
            </a>

            <a class="list-group-item visitor" href="<?php echo $base_url.'my-profile/unlike-profile'; ?>">
                <p class="Poppins-Medium f-16 color-38 dashbrd_3">
                Unlike Profile
                </p>
                <span class="Poppins-Semi-Bold f-16 color-38 dashbrd_4"><?php echo sprintf("%02d", $Unlike_data); ?></span>
            </a>

            <a class="list-group-item visitor" href="<?php echo $base_url;?>my-profile/short-listed">
                <p class="Poppins-Medium f-16 color-38 dashbrd_3">
                    Short Listed Profile
                </p>
                <span class="Poppins-Semi-Bold f-16 color-38 dashbrd_4"><?php echo sprintf("%02d", $Short_List_data);?></span>
            </a>

            <a class="list-group-item visitor" href="<?php echo $base_url;?>my-profile/block-listed">
                <p class="Poppins-Medium f-16 color-38 dashbrd_3">
                    Blocked Profile
                </p>
                <span class="Poppins-Semi-Bold f-16 color-38 dashbrd_4"><?php echo sprintf("%02d", $Block_data);?></span>
            </a>

            <a class="list-group-item visitor" href="<?php echo $base_url;?>my-profile/i-viewed">
                <p class="Poppins-Medium f-16 color-38 dashbrd_3">
                    I Viewed Profile
                </p>
                <span class="Poppins-Semi-Bold f-16 color-38 dashbrd_4"><?php echo sprintf("%02d", $i_view_data);?></span>
            </a>

            <a class="list-group-item visitor" href="<?php echo $base_url;?>my-profile/who-viewed">
                <p class="Poppins-Medium f-16 color-38 dashbrd_3">
                    Viewed My Profile
                </p>
                <span class="Poppins-Semi-Bold f-16 color-38 dashbrd_4"><?php echo sprintf("%02d", $view_my_data);?></span>
            </a>
            
            <a class="list-group-item visitor" href="<?php echo $base_url;?>express-interest">
                <p class="Poppins-Medium f-16 color-38 dashbrd_3">
                    My Express Interest
                </p>
                <span class="Poppins-Semi-Bold f-16 color-38 dashbrd_4"><?php echo sprintf("%02d", $expinter_data);?></span>
            </a>
        </div>
        <div class="list-group pt-2 pb-4 clearfix">
        <form method="post" action="<?php echo $base_url; ?>search/search_now">
            <a class="list-group-item google-plus" href="#">
                <p class="Poppins-Semi-Bold f-17 color-d dashbrd_1">
                    <i class="fas fa-search dashbrd_user_icon"></i> Quick Search
                </p>
            </a>
            <div class="age_dshbrd">
                <div class="row-cstm">
                    <label class="list-group-item dshbrd_100 f-normal Poppins-Medium f-16 color-38 dashbrd_3">Age:</label>
                </div>
                <div class="row-cstm">
                    <div class="col-md-5 col-sm-5 col-xs-5">
                        <div class="select_box3">
                            <select class="form-control dashbrd_cstm" name="from_age">
                                <option value="">From</option>
                                <?php echo $this->common_model->array_optionstr($this->common_model->age_rang(),18);?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2">
                        <p class="Poppins-Regular f-16 color-3c dshbrd_to">To</p>
                    </div>
                    <div class="col-md-5 col-sm-5 col-xs-5">
                        <div class="select_box4 dshbrd_pr">
                        <select class="form-control dashbrd_cstm" name="to_age">
                            <option value="">To</option>
                            <?php echo $this->common_model->array_optionstr($this->common_model->age_rang(),30);?>
                        </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="height_dshbrd">
                <div class="row-cstm">
                    <label class="list-group-item dshbrd_100 f-normal Poppins-Medium f-16 color-38 dashbrd_3">Height:</label>
                </div>
                <div class="row-cstm">
                    <div class="col-md-5 col-sm-5 col-xs-5">
                        <div class="select_box3">
                            <select class="form-control dashbrd_cstm" name="from_height">
                                <option value="">From</option>
                                <?php echo $this->common_model->array_optionstr($this->common_model->height_list());?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2">
                        <p class="Poppins-Regular f-16 color-3c dshbrd_to">To</p>
                    </div>
                    <div class="col-md-5 col-sm-5 col-xs-5">
                        <div class="select_box4 dshbrd_pr">
                            <select class="form-control dashbrd_cstm" name="to_height">
                                <option value="">To</option>
                                <?php echo $this->common_model->array_optionstr($this->common_model->height_list());?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="religion_dshbrd">
                <div class="row-cstm">
                    <label class="list-group-item dshbrd_100 f-normal Poppins-Medium f-16 color-38 dashbrd_3">Religion:</label>
                </div>
                <div class="row-cstm">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="select_box5">
                            <select data-placeholder="Select Religion" name="religion[]" id="religion-search" multiple class="form-control dashbrd_cstm"  style="width:100%">
                                <option value="">Select Religion</option>
                                <?php echo $this->common_model->array_optionstr($this->common_model->dropdown_array_table('religion'));?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dshbrd_checkbox">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="custom-control custom-checkbox mtm-0 w-102">
                        <input class="custom-control-input" id="3600" type="checkbox" value="photo_search" name="photo_search">
                        <label for="3600" class="dshbrd_cstm-control mt-3 Poppins-Regular">
                        <span class="t1 Poppins-Regular f-13 color-65">With Photo</span>
                        </label>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
                    <button type="submit" class="dshbrd_21 Poppins-Medium f-17 color-f"><i class="fas fa-search"></i> Search</button>
                </div>
            </div>
        </form>
        </div>
        <?php 
        if($this->router->fetch_method()!='current_plan'){
            // $data = array();
            // $data['limit']=3;
            // $data['class']='p-8 pro-hidden';
            // $data['class1']='dashbrd_img-box';
            
            $this->load->view('front_end/featured_leftsidebar');
        }
        ?>
        <?php //$this->load->view('front_end/featured_leftsidebar');?>
    </div>
</div>
<?php $this->common_model->js_extra_code_fr .= "select2('#religion-search','Select Languages Known');";?>