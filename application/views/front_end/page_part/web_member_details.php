<?php if($this->router->fetch_class()=='my_dashboard'){?>
    <div class="dshbrd_w-box">
                <div class="row-cstm mt-6">
                    <div class="m-b">
                        <div class="row">
                            <div class="col-md-3 col-sm-3 col-xs-12">
<?php }else{?>
<div class="m-b <?php echo $mt;?>">
    <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-12">
<?php }?>

			<?php if(isset($member_data_val['gender']) && $member_data_val['gender']=='Female'){
                $photopassword_image = $base_url.'assets/images/photopassword_female.png';
            }elseif(isset($member_data_val['gender']) && $member_data_val['gender']=='Male'){
                $photopassword_image = $base_url.'assets/images/photopassword_male.png';
            }else{
                $photopassword_image = $photopassword_image;
            }
            $path_photos = $this->common_model->path_photos;
			if(isset($member_data_val['photo1']) && $member_data_val['photo1'] !='' && isset($member_data_val['photo1_approve']) && $member_data_val['photo1_approve'] == 'APPROVED' && file_exists($path_photos.$member_data_val['photo1']) && isset($member_data_val['photo_view_status']) && $member_data_val['photo_view_status'] == 0){?>
                <a data-toggle="modal" data-target="#myModal_photoprotect" title="Photo Protected" onClick="addstyle('<?php echo $member_id;?>','<?php echo $member_data_val['matri_id']; ?>')"><img src="<?php echo $photopassword_image; ?>" alt="" class="img-responsive placeholder-img"></a>
            <?php }else{?>
                <a target="_blank" href="<?php echo base_url()."search/view-profile/".$member_data_val['matri_id']; ?>">
                    <img src="<?php echo $comm_model->member_photo_disp($member_data_val);?>" class="img-responsive <?php if($comm_model->member_photo_disp($member_data_val) == $base_url.'assets/front_end/img/default-photo/male.png' || $comm_model->member_photo_disp($member_data_val) == $base_url.'assets/front_end/img/default-photo/female.png'){ echo 'placeholder-img';}else{ echo 's-img-1';}?>" title="<?php echo $comm_model->display_data_na($member_data_val['username']);?>" alt="<?php echo $comm_model->display_data_na($member_data_val['matri_id']);?>">
                </a>
            <?php }?>

            <div class="profile-card-btn">
                <a href="<?php echo base_url()."search/view-profile/".$member_data_val['matri_id'];?>" class="s-card-1 OpenSans-Light">View Full Profile</a>
            </div>
        </div>
        <div class="col-md-9 col-sm-9 col-xs-12">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <p class="p-search OpenSans-Bold">
                        <?php echo $comm_model->display_data_na($member_data_val['matri_id']);?> |
                        <span class="p-search2">Profile Created By <?php echo $comm_model->display_data_na($member_data_val['profileby']);?></span>
                    </p>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <p class="p-search3 OpenSans-Regular pull-right">
                        <!--Online Now-->
                    </p>
                </div>
            </div>
            <hr class="search-r-hr">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12 margin-top-10 right-hr new-p">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <p class="sr1 Roboto-Bold">
                            Age / Height:
                        </p>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <p class="sr2 Roboto-Bold">
                            <?php echo $comm_model->birthdate_disp($member_data_val['birthdate'],0);?>, <?php echo $comm_model->display_height($member_data_val['height']);?>
                        </p>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <p class="sr1 Roboto-Bold Roboto-Bold">
                            Religion:
                        </p>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <p class="sr2 Roboto-Bold">
                            <?php echo $comm_model->display_data_na($member_data_val['religion_name']);?>
                        </p>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <p class="sr1 Roboto-Bold Roboto-Bold">
                            Caste:
                        </p>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <p class="sr2 Roboto-Bold">
                            <?php echo $comm_model->display_data_na($member_data_val['caste_name']);?>
                        </p>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <p class="sr1 Roboto-Bold Roboto-Bold">
                            Mother Tongue:
                        </p>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <p class="sr2 Roboto-Bold">
                            <?php echo $comm_model->display_data_na($member_data_val['mtongue_name']);?>
                        </p>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <p class="sr1 Roboto-Bold Roboto-Bold">
                            Education:
                        </p>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <p class="sr2 Roboto-Bold">
                            <?php $edu = $comm_model->valueFromId('education_detail',$member_data_val['education_detail'],'education_name');
                            if($edu==''){echo 'N/A';}else{echo $edu;}?>
                        </p>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <p class="sr1 Roboto-Bold Roboto-Bold">
                            Location:
                        </p>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <p class="sr2 Roboto-Bold">
                            <?php echo $comm_model->display_data_na($member_data_val['city_name']).', '.$comm_model->display_data_na($member_data_val['country_name']);?>
                        </p>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <p class="sr1 Roboto-Bold Roboto-Bold">
                            Occupation:
                        </p>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <p class="sr2 Roboto-Bold">
                            <?php echo $comm_model->display_data_na($member_data_val['occupation_name']);?>
                        </p>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <p class="sr1 Roboto-Bold Roboto-Bold">
                            Annual Income:
                        </p>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <p class="sr2 Roboto-Bold">
                            <?php echo $comm_model->display_data_na($member_data_val['income']);?>
                        </p>
                    </div>
                </div>
                <?php include('like_dislike.php');?>
            </div>
            <?php if(isset($member_id) && $member_id!='' && isset($member_data_val) && $member_data_val !=''  && is_array($member_data_val)){?>
                <hr class="search-r-hr">
                <div class="row mt-3">
                    <div id="more_details_btns_<?php echo $member_data_val['id'];?>" style="display: none;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <button data-toggle="modal" data-target="#myModal_sms" class="dshbrd_17 Poppins-Regular f-14" title="Send Message" onClick="get_member_matri_id('<?php echo $member_data_val['matri_id'];?>')">
                                Send Message
                            </button>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <button class="dshbrd_17 Poppins-Regular f-14" data-toggle="modal" data-target="#myModal_sendinterest" onClick="express_interest('<?php echo $member_data_val['matri_id'];?>')" title="Send Interest">
                            Send Interest</button>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                        <?php $where_arra=array('block_to'=>$result_member_matri_id,'block_by'=>$member_id);
                            $data = $this->common_model->get_count_data_manual('block_profile',$where_arra,1,'id');
                            $is_block_list = 0;
                            if(isset($data) && $data > 0){
                                $is_block_list = 1;
                            }?>
                            <input type="hidden" id="is_member_block_<?php echo $member_data_val['matri_id'];?>" name="is_member_block_<?php echo $member_data_val['matri_id'];?>" value="<?php if($is_block_list != 0){ echo 'is_member_block_'.$member_data_val['matri_id']; } ?>" >
                            <!--<button type="button" class="dshbrd_17 Poppins-Regular f-14">Blocklist </button>-->
                            <div id="add_blocklist_<?php echo $member_data_val['matri_id'];?>" style="display:<?php if($is_block_list != 0){ echo 'none';}else{ echo 'block';} ?>;">
                                <button data-toggle="modal" data-target="#myModal_block" title="Add to Blocklist" onClick="add_block_list_matri_id('<?php echo $member_data_val['matri_id'];?>')" class="dshbrd_17 Poppins-Regular f-14">Blocklist</button>
                            </div>
                            <div id="remove_blocklist_<?php echo $member_data_val['matri_id'];?>" style="display:<?php if($is_block_list == 0){ echo 'none';}else{ echo 'block';} ?>;">
                                <button data-toggle="modal" data-target="#myModal_unblock" title="Remove to Blocklist" onClick="remove_block_list_id('<?php echo $member_data_val['matri_id'];?>')" class="dshbrd_17 Poppins-Regular f-14"> Blocklisted</button>
                          </div>
                        </div>
                    </div>
                </div>
            <?php }?>
            <?php if($this->router->fetch_class()=='my_dashboard'){?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }
else{?>
        </div>
    </div>
</div>
<?php }
    ?>
       