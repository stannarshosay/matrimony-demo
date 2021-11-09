<?php 
$current_login_user = $this->common_front_model->get_session_data(); 
$login_user_matri_id = $current_login_user['matri_id'];
$login_user_gender = $current_login_user['gender'];

$gender = $this->common_front_model->get_session_data('gender');
if(isset($gender) && $gender == 'Male'){
	$photopassword_image = $base_url.'assets/images/photopassword_female.png';
}else{
	$photopassword_image = $base_url.'assets/images/photopassword_male.png';
}

$where_arra=array('is_deleted'=>'No','fstatus'=>'Featured',"status !='UNAPPROVED' and status !='Suspended' and plan_status='Paid'");
if($login_user_gender=='Male')
{
    $where_arra['gender'] = 'Female';
}
else if($login_user_gender=='Female')
{
    $where_arra['gender'] = 'Male';
}

$featured_profile_data = $this->common_model->get_count_data_manual('register_view',$where_arra,2,'*','id desc',1);
//echo $this->db->last_query();

if(isset($featured_profile_data) && $featured_profile_data !='' && is_array($featured_profile_data) && count($featured_profile_data) > 0 )
{?>
<style>
.new-width{
	display:inherit;
}
</style>
<div class="mega-box-new p-8 pro-hidden">
    <div id="testimonial-slider_kd" class="owl-carousel arrow_s">
        <?php	
            $path_photos = $this->common_model->path_photos;
            $i = 1;
            foreach($featured_profile_data as $featured_data){
                $path_photos = $this->common_model->path_photos;
                    if(isset($featured_data['photo1']) && $featured_data['photo1'] !='' && $featured_data['photo1_approve'] =='APPROVED' && file_exists($path_photos.$featured_data['photo1']) && $featured_data['photo_password'] !='' && $featured_data['photo_protect'] !='No' && $featured_data['photo_view_status'] == 0){
                        $featured_image = '<a data-toggle="modal" data-target="#myModal_photoprotect" onClick="addstyle('.$login_user_matri_id.','.$featured_data['matri_id'].')"><img src="'.$photopassword_image.'" title="'.$featured_data['username'].'" alt="'.$featured_data['matri_id'].'" class="profile-s brd-raduis"></a>';
                    }else{
                        $featured_image = '<a href="'.$base_url.'search/view-profile/'.$featured_data['matri_id'].'"><img src="'.$this->common_model->member_photo_disp($featured_data).'" title="'.$featured_data['username'].'" alt="'.$featured_data['matri_id'].'" class="profile-s brd-raduis"></a>';
                    }
                ?>
                <div class="testimonial new-view-profile-slider">
                    <div class="row">
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <?php echo $featured_image;?>
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                            <div class="Prf_sidebar dashbrd_img-box">
                                <p class="Poppins-Semi-Bold f-16 color-27 mb-0"><?php echo $featured_data['username'];?></p>
                                <p class="Poppins-Regular f-12 mb-0 color-68">
                                <?php if(isset($featured_data['birthdate']) && $featured_data['birthdate'] !='')
                                {
                                    $birthdate = $featured_data['birthdate'];
                                    echo $this->common_model->birthdate_disp($birthdate,0);
                                }
                                else
                                {
                                    echo $this->common_model->display_data_na('');
                                }?>, <?php if(isset($featured_data['height']) && $featured_data['height'] !='')
                                {
                                    $height = $featured_data['height'];
                                    echo $this->common_model->display_height($height);
                                }
                                else
                                {
                                    echo $this->common_model->display_data_na('');
                                }?>,
                                <?php if(isset($featured_data['city_name']) && $featured_data['city_name'] !=''){
                                    echo $featured_data['city_name'];
                                }
                                else{
                                    echo $this->common_model->display_data_na($featured_data['country_name']);
                                }?>,
                                <?php if(isset($featured_data['country_name']) && $featured_data['country_name'] !=''){
                                    echo $featured_data['country_name'];}
                                else{
                                    echo $this->common_model->display_data_na($featured_data['country_name']);
                                }?></p>
                                <a href="<?php echo $base_url."search/view-profile/".$featured_data['matri_id']; ?>" class="Poppins-Medium color-f f-11 mega-n-btn1 post-s-d dshbrd_btn" style="padding: 8px 11px !important;">View Full Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
			<?php
         	$i++;
         }?>
    </div>
</div>
<?php }?>
    <?php  $this->common_model->js_extra_code_fr .= "
$(document).ready(function(){
    $('#testimonial-slider_kd').owlCarousel({
        items:1,
        itemsDesktop:[1000,2],
        itemsDesktop:[1920,1],
        itemsDesktopSmall:[979,1],
        itemsTablet:[768,1],
        pagination:false,
        navigation:true,
        slideSpeed:1000,
        singleItem:true,
        navigationText:['',''],
        autoPlay:true,
    });
});";?>
    