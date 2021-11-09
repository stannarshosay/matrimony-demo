<?php
$base_url = base_url();
$member_id = $this->common_front_model->get_session_data('matri_id');
$curre_gender = $this->common_front_model->get_session_data('gender');
$where_arra=array('is_deleted'=>'No',"status !='UNAPPROVED' and status !='Suspended'");
if(isset($curre_gender) && $curre_gender !='')
{
	$where_arra[] = " gender != '$curre_gender' " ;
}
$register_data = $this->common_model->get_count_data_manual('register_view',$where_arra,2,'*','id desc',1,6);
	
if(isset($curre_gender) && $curre_gender == 'Male'){
	$photopassword_image = $base_url.'assets/images/photopassword_female.png';
}else{
	$photopassword_image = $base_url.'assets/images/photopassword_male.png';
}

if(isset($register_data) && $register_data !='' && is_array($register_data) && count($register_data) > 0 )
{	
	$path_photos = $this->common_model->path_photos;?>
    <div class="col-md-8 col-sm-12 col-xs-12 padding-left-zero-search">
        <div id="testimonial-slider" class="owl-carousel">
			<?php foreach($register_data as $member_data){?>
                <div class="testimonial">
                    <div class="pic">
                    	<?php if(isset($member_data['photo1']) && $member_data['photo1'] !='' && $member_data['photo1_approve'] =='APPROVED' && file_exists($path_photos.$member_data['photo1']) && $member_data['photo_view_status']==0){?>
                       		<a data-toggle="modal" data-target="#myModal_photoprotect" title="Photo Protected" onClick="addstyle('<?php echo $member_id;?>','<?php echo $member_data['matri_id']; ?>')"><img src="<?php echo $photopassword_image; ?>" alt="<?php echo $this->common_model->display_data_na($member_data['username']);?>" /></a>
                        <?php }else{?>
							<a href="<?php echo $base_url; ?>search/view-profile/<?php echo $member_data['matri_id'];?>" target="_blank" ><img src="<?php echo $this->common_model->member_photo_disp($member_data);?>" alt="<?php echo $this->common_model->display_data_na($member_data['username']);?>" /></a>
						<?php }?>
                    </div>
                    <div class="pic-2 pic_3">
                        <a href="<?php echo $base_url; ?>search/view-profile/<?php echo $member_data['matri_id'];?>"><p class="text-center matri-id-s"><?php echo $this->common_model->display_data_na($member_data['username']);?></p></a>
                        <p class="text-center matri-id-s-2 matri-zero">
							<?php if(isset($member_data['birthdate']) && $member_data['birthdate'] !=''){
							$birthdate = $member_data['birthdate'];
								 echo $this->common_model->birthdate_disp($birthdate,0);
							}
							else{
								echo $this->common_model->display_data_na('');
							}?>, 
							<?php if(isset($member_data['height']) && $member_data['height'] !=''){
								$height = $member_data['height'];
								echo $this->common_model->display_height($height);
							}
							else{
								echo $this->common_model->display_data_na('');
							}?>,
							<?php if(isset($member_data['weight']) && $member_data['weight'] !=''){
								 $weight = $member_data['weight'].' Kg';
								 echo $weight;
							}
							else{
								echo $this->common_model->display_data_na('');
							}?><br>
							<?php if(isset($member_data['religion_name']) && $member_data['religion_name'] !=''){ echo $member_data['religion_name'];}else{echo $this->common_model->display_data_na($member_data['religion_name']);}?>, <?php if(isset($member_data['caste_name']) && $member_data['caste_name'] !=''){ echo $member_data['caste_name'];}else{echo $this->common_model->display_data_na($member_data['caste_name']);}?><br>
					   <?php if(isset($member_data['city_name']) && $member_data['city_name'] !=''){ echo $member_data['city_name'];}else{echo $this->common_model->display_data_na($member_data['country_name']);}?>, <?php if(isset($member_data['country_name']) && $member_data['country_name'] !=''){ echo $member_data['country_name'];}else{echo $this->common_model->display_data_na($member_data['country_name']);}?>
                       </p>
                    </div>
                </div>
            <?php }?>
        </div>
    </div>
<?php }?>