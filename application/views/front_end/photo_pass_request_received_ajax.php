<?php
$curre_gender = $this->common_front_model->get_session_data('gender');
$base_url = base_url();
if (isset($curre_gender) && $curre_gender == 'Male') {
    $photopassword_image = $base_url . 'assets/images/photopassword_female.png';
} else {
    $photopassword_image = $base_url . 'assets/images/photopassword_male.png';
}?>
<div class="clearfix"></div>
<div class="row">
    <div class="col-sm-12 col-md-12 col-xs-12">
        <div class="alert alert-success" id="delete_success" style="display:none"></div>
    </div>
</div>
<?php
if(isset($photo_pass_data) && $photo_pass_data !='' && is_array($photo_pass_data) && count($photo_pass_data) > 0){
    foreach($photo_pass_data as $row_photo_pass){
		$color_class = 'color-pendding';
		if($row_photo_pass['receiver_response'] == 'Accepted'){
			$color_class = 'color-Accepted';
		}
		else if($row_photo_pass['receiver_response'] == 'Rejected'){
			$color_class = 'color-Rejected';
		}?>
<div class="row mt-4">
    <div class="col-md-12 col-xs-12 col-sm-12 padding-zero">
        <div class="design-process-content-like das-content-2  padding-0">
            <div class="box-view-profile">
                <div class="row">
                    <div class="col-md-1 col-xs-12 col-sm-1">
                        <?php
						if(isset($row_photo_pass['photo1']) && $row_photo_pass['photo1'] !='' && $row_photo_pass['photo1_approve'] =='APPROVED' && $row_photo_pass['photo_view_status'] != 0){?>	
							<a href="<?php echo $base_url; ?>search/view-profile/<?php echo $row_photo_pass['matri_id'];?>" target="_blank"><img src="<?php echo $base_url; ?>assets/photos/<?php echo $row_photo_pass['photo1'];?>" class="like-img" title="Received from <?php echo $row_photo_pass['ph_requester_id'];?>" alt=""/></a>
						<?php }
						else if(isset($row_photo_pass['photo1']) && $row_photo_pass['photo1'] !='' && $row_photo_pass['photo1_approve'] =='APPROVED' && $row_photo_pass['photo_view_status'] == 0){?>
							<a href="<?php echo $base_url; ?>search/view-profile/<?php echo $row_photo_pass['matri_id'];?>" target="_blank"><img src="<?php echo $photopassword_image; ?>" class="like-img" title="Received from <?php echo $row_photo_pass['ph_requester_id'];?>" alt=""/></a>
						<?php }
						else{?>
							<a href="<?php echo $base_url; ?>search/view-profile/<?php echo $row_photo_pass['matri_id'];?>" target="_blank"><img src="<?php echo $this->common_model->member_photo_disp($row_photo_pass);?>" class="like-img" title="Received from <?php echo $row_photo_pass['ph_requester_id'];?>" alt=""/></a>
						<?php }?>
                    </div>
                    <div class="col-md-11 col-xs-12 col-sm-11 like-p-l-0">
                        <p class="like-margin-b">
                            <span class="f-18 f-10-m">Status: <span class="p-search <?php echo $color_class;?>"> <?php echo $row_photo_pass['receiver_response'];?> </span></span>
                            <span class="pull-right  Poppins-Regular f-14 f-10-m f-10-m-2 like-color color-46">
                                <?php echo $this->common_model->displayDate($row_photo_pass['ph_reqdate'],'D, jS, F - Y');?>
                                <span class="Poppins-Regular f-15 f-10-m ">
									<?php if(isset($row_photo_pass['receiver_response']) && $row_photo_pass['receiver_response']=='Pending'){?>
                                        <a data-toggle="modal" data-target="#myModal_delete12" title="Delete Request" onClick="delete_photo_reqeust('<?php echo $row_photo_pass['ph_reqid']; ?>','receiver');"><i class="fas fa-trash-alt color-d m-left-s"></i></a>
                                    <?php }?>
                                </span>
                            </span>
                        </p>
                        <hr class="like-hr">
                        <p class="f-15 color-46"><?php echo $row_photo_pass['ph_msg'];?></p>
                        <div class="row">
                            <div class="col-md-12 col-xs-12 col-sm-12">
                                <span class="pull-right float-none">
                                <a href="<?php echo $base_url; ?>search/view-profile/<?php echo $row_photo_pass['ph_requester_id'];?>" target="_blank" class="mega-n-btn1 like-btn  post-s-d Poppins-Regular color-f f-16">
                                    View Profile
                                </a>
                                <?php if(isset($row_photo_pass['receiver_response']) && $row_photo_pass['receiver_response']=='Pending'){?>
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal_delete13" title="Reject Request" onClick="accept_photo_reqeust('<?php echo $row_photo_pass['ph_requester_id']; ?>','<?php echo $row_photo_pass['receiver_response'];?>');"  class="mega-n-btn1 like-btn  post-s-d Poppins-Regular color-f f-16">
                                        Accept
                                    </a>
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal_delete15" title="Reject Request" onClick="reject_photo_reqeust('<?php echo $row_photo_pass['ph_reqid']; ?>','receiver');" class="mega-n-btn1 like-btn  post-s-d Poppins-Regular color-f f-16">
                                        Reject
                                    </a>
                                <?php }
								else if(isset($row_photo_pass['receiver_response']) && $row_photo_pass['receiver_response']=='Accepted'){?>
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal_delete15" title="Reject Request" onClick="reject_photo_reqeust('<?php echo $row_photo_pass['ph_reqid']; ?>','receiver');" class="mega-n-btn1 like-btn  post-s-d Poppins-Regular color-f f-16">
                                        Reject
                                    </a>
                                <?php }else if(isset($row_photo_pass['receiver_response']) && $row_photo_pass['receiver_response']=='Rejected'){?>
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal_delete13" title="Reject Request" onClick="accept_photo_reqeust('<?php echo $row_photo_pass['ph_requester_id']; ?>','<?php echo $row_photo_pass['receiver_response'];?>');"  class="mega-n-btn1 like-btn  post-s-d Poppins-Regular color-f f-16">
                                        Accept
                                    </a>
                                <?php }?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }
	if(isset($photo_pass_count) && $photo_pass_count !='' && $photo_pass_count > 0){?>
		<div class="col-md-12 col-xs-12 col-sm-12">
        	<div class="pagination-wrap mt-0">
                <div class="col-md-12 tp-pagination">
                <?php echo $this->common_model->rander_pagination_front('my-profile/photo-pass-request-recevied/',$photo_pass_count);?>
                </div>
            </div>
        </div>
	<?php }
}else{?>
	<div class="row mt-3">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="no-data-f">
               <img src="<?php echo $base_url;?>assets/front_end_new/images/no-data.png" class="img-responsive no-data" />
               <h1 class="color-no"><span class="Poppins-Bold color-no">NO</span> DATA <span class="Poppins-Bold color-no"> FOUND </span></h1>
            </div>
        </div>
    </div>
<?php }?>

<div id="myModal_delete12" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-vendor">
        <div class="modal-content">
            <div class="modal-header new-header-modal" style="border-bottom: 1px solid #e5e5e5;">
                <p class="Poppins-Bold mega-n3 new-event text-center"> Delete This <span class="mega-n4 f-s">Photo Request</span></p>
                <button type="button" class="close close-vendor" data-dismiss="modal" aria-hidden="true" style=" margin-top: -37px !important;color:#fff;">×</button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" style="overflow:hidden;">
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <img src="<?php echo $base_url; ?>assets/front_end/images/icon/user-detele.png" alt="" class="margin-right-10" />
                    </div>
                    <div class="col-md-10 col-sm-6 col-xs-12">
                        <strong>Are you sure you want to Remove this request?</strong><br />
						<span class="small">This Profile will be removed permanently from your Records.</span>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12 col-sm-3 col-xs-12">
                        <span class="pull-right float-none">
                            <button onclick="delete_request()" class="add-w-btn new-msg-btn yes-no left-zero-msg Poppins-Medium color-f f-18">Yes</button>
                            <button class="add-w-btn left-zero-msg new-msg-btn yes-no Poppins-Medium color-f f-18" data-dismiss="modal">No</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="myModal_delete15" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-vendor">
        <div class="modal-content">
            <div class="modal-header new-header-modal" style="border-bottom: 1px solid #e5e5e5;">
                <p class="Poppins-Bold mega-n3 new-event text-center"> Reject This <span class="mega-n4 f-s">Photo Request</span></p>
                <button type="button" class="close close-vendor" data-dismiss="modal" aria-hidden="true" style=" margin-top: -37px !important;color:#fff;">×</button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" style="overflow:hidden;">
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <img src="<?php echo $base_url; ?>assets/front_end/images/icon/user-detele.png" alt="" class="margin-right-10" />
                    </div>
                    <div class="col-md-10 col-sm-6 col-xs-12">
                        <strong>Are you sure you want to Reject this request?</strong><br />
                    </div>
                </div>
            	<div class="row mt-3">
                    <div class="col-md-12 col-sm-3 col-xs-12">
                        <span class="pull-right float-none">
                            <button onclick="reject_request()" class="add-w-btn new-msg-btn yes-no left-zero-msg Poppins-Medium color-f f-18">Yes</button>
                            <button class="add-w-btn left-zero-msg new-msg-btn yes-no Poppins-Medium color-f f-18" data-dismiss="modal">No</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="myModal_delete13" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-vendor">
        <div class="modal-content">
            <div class="modal-header new-header-modal" style="border-bottom: 1px solid #e5e5e5;">
                <p class="Poppins-Bold mega-n3 new-event text-center"> Accept This <span class="mega-n4 f-s">Photo Request</span></p>
                <button type="button" class="close close-vendor" data-dismiss="modal" aria-hidden="true" style=" margin-top: -37px !important;color:#fff;">×</button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" style="overflow:hidden;">
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <img src="<?php echo $base_url; ?>assets/front_end/images/icon/user-detele.png" alt="" class="margin-right-10" />
                    </div>
                    <div class="col-md-10 col-sm-6 col-xs-12">
                        <strong>Are you sure you want to Accept this request?</strong><br />
                    </div>
                </div>
            	<div class="row mt-3">
                    <div class="col-md-12 col-sm-3 col-xs-12">
                        <span class="pull-right float-none">
                            <button onclick="accept_request()" class="add-w-btn new-msg-btn yes-no left-zero-msg Poppins-Medium color-f f-18">Yes</button>
                            <button class="add-w-btn left-zero-msg new-msg-btn yes-no Poppins-Medium color-f f-18" data-dismiss="modal">No</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>