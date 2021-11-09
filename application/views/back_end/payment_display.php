<?php $dna = $this->common_model->data_not_availabel; 
$hidd_user_id = '';
if(isset($_REQUEST['user_id']) && $_REQUEST['user_id'] !='')
{
	$hidd_user_id = $_REQUEST['user_id'];
}
$user_data = array();
$path_img = $this->common_model->path_photos;
$plan_table_name = 'membership_plan';
if($hidd_user_id !='')
{
	$user_data = $this->common_model->get_count_data_manual('register_view',array('id'=>$hidd_user_id),1,' username, email, mobile, photo1 ','',0,'',0);
}
//print_r($user_data);
//	$this->load->view('back_end/job_basic_detail');
//print_r($_REQUEST);
?>
<div id="plan_detail">
	<div class="alert alert-danger" id="model_body_common_err" style="display:none"></div>
	<div class="row">
    	<div class="col-lg-5 col-xs-12 col-sm-12 col-md-5 imgPaddingRightZero" align="center">
        	<?php
				$avatar = $this->common_model->photo_avtar;
				if(isset($user_data['photo1']) && $user_data['photo1'] !='')
				{
					$temp_img = $user_data['photo1'];
					if(file_exists($path_img.$temp_img))
					{
						$avatar = $path_img.$temp_img;
					}
				}
			?>
            <img data-src="<?php echo $base_url.$avatar; ?>" title="<?php echo $user_data['username']; ?>" alt="<?php echo $user_data['username']; ?>" class=" img-responsive lazyload">
        </div>
        <div class="col-lg-5 col-xs-12 col-sm-12 col-md-5">
        	<p class="text-bold"><span class="fa fa-user"></span>&nbsp;&nbsp;<?php 
			if(isset($user_data['username']) && $user_data['username'] !=''){echo $user_data['username'];} else{ echo $dna;} ?></p>
            <p><span class="fa fa-envelope"></span>&nbsp;&nbsp;<?php if(isset($user_data['email']) && $user_data['email'] !=''){if(isset($this->common_model->is_demo_mode) && $this->common_model->is_demo_mode == 1){ echo $this->common_model->disable_in_demo_text; } else{ echo $user_data['email'];}} else{ echo $dna;}  ?></p>
            <p><span class="fa fa-phone"></span>&nbsp;&nbsp;
			<?php if(isset($user_data['mobile']) && $user_data['mobile'] !=''){if(isset($this->common_model->is_demo_mode) && $this->common_model->is_demo_mode == 1){ echo $this->common_model->disable_in_demo_text; } else{ echo $user_data['mobile'];}} else{ echo $dna;} ?>
            </p>
        </div>
    </div>
    <div class="clearfix"><br/></div>
    <div class="row form-horizontal">
    	<div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
        	<div class="form-group ">
              <label class="col-sm-1 col-lg-1"></label>
              <label class="col-sm-2 col-lg-2 control-label text-bold">Plan</label>
              <div class="col-sm-6 col-lg-6">
                <select required name="plan_id" id="plan_id" class="form-control" onChange="display_plan()">
                	<option selected="" value="">Select Plan</option>
                    <?php
                    $where_arra = array('status'=>'APPROVED','is_deleted'=>'No');

					$plan_data = $this->common_model->get_count_data_manual($plan_table_name,$where_arra,2,' * ','',0,'',0);
					if(isset($plan_data) && $plan_data !='' && count($plan_data) > 0)
					{
						foreach($plan_data as $plan_data_val)
						{
					?>
                    	<option value="<?php echo $plan_data_val['id']; ?>"><?php echo $plan_data_val['plan_name'].' ('.$plan_data_val['plan_amount_type'].' '.$plan_data_val['plan_amount'].' )'; ?></option>
                    <?php
						}
					}
					?>
                </select>
              </div>
              <label class="col-sm-1 col-lg-1"></label>
            </div>
            <div class="form-group ">
              <label class="col-sm-1 col-lg-1"></label>
              <label class="col-sm-2 col-lg-2 control-label text-bold pr0">Payment&nbsp;Mode</label>
              <div class="col-sm-6 col-lg-6">
                <select required name="payment_mode" id="payment_mode" class="form-control">
                	<option selected="" value="">Select Payment Mode</option>
                    <option value="Cash">Cash</option>
                    <option value="Credit Card">Credit Card</option>
                    <option value="Debit Card">Debit Card</option>
                    <option value="Other">Other</option>
                </select>
              </div>
              <label class="col-sm-1 col-lg-1"></label>
            </div>
        </div>
    </div>
    <?php
		//$plan_data = $this->common_model->get_count_data_manual($plan_table_name,array('status'=>'APPROVED'),2,' * ','',0,'',0);
		if(isset($plan_data) && $plan_data !='' && count($plan_data) > 0)
		{
			foreach($plan_data as $plan_data_val)
			{
	?>
    	<div class="plan_detail" style="display:none;margin:0px;padding:10px 8px;border: 1px solid #E0E0E0;" id="plan_detail_<?php echo $plan_data_val['id']; ?>">
	    	<div class="row">
	   		<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 neAdminResultDetail">
               <div class="col-md-2 col-lg-2 col-xs-4 col-sm-4 pr0">
                    Plan Name
                </div>
                <div class="col-md-7 col-lg-7 col-xs-7 col-sm-7 ml20 text-bold pr0">:&nbsp;
                	<?php echo $plan_data_val['plan_name']; ?>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12 neAdminResultDetail">
               <div class="col-lg-5 col-md-5 col-xs-4 col-sm-4 pr0">
                    Plan Amount
                </div>
                <div class="col-md-7 col-lg-7 col-xs-7 col-sm-7 m-l-left pr0">:&nbsp;
                	<?php echo $plan_data_val['plan_amount_type'].' '.$plan_data_val['plan_amount']; ?>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12 neAdminResultDetail">
               <div class="col-lg-5 col-md-5 col-xs-4 col-sm-4 pr0">
                    Plan Duration
                </div>
                <div class="col-md-7 col-lg-7 col-xs-7 col-sm-7 m-l-left pr0">:&nbsp;
                	<?php echo $plan_data_val['plan_duration']; ?> Days
                </div>
           </div>
           <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12 neAdminResultDetail">
               <div class="col-lg-5 col-md-5 col-xs-4 col-sm-4 pr0">
                    Message
                </div>
                <div class="col-md-7 col-lg-7 col-xs-7 col-sm-7 m-l-left pr0">:&nbsp;
                	<?php echo $plan_data_val['plan_msg']; ?>
                </div>
           </div>
           <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12 neAdminResultDetail">
               <div class="col-lg-5 col-md-5 col-xs-4 col-sm-4 pr0">
                    Contacts
                </div>
                <div class="col-md-7 col-lg-7 col-xs-7 col-sm-7 m-l-left pr0">:&nbsp;
                	<?php echo $plan_data_val['plan_contacts']; ?>
                </div>
           </div>           
           <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12 neAdminResultDetail">
               <div class="col-lg-5 col-md-5 col-xs-4 col-sm-4 pr0">
                    Profile
                </div>
                <div class="col-md-7 col-lg-7 col-xs-7 col-sm-7 m-l-left pr0">:&nbsp;
                	<?php echo $plan_data_val['profile']; ?>
                </div>
           </div>
           <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12 neAdminResultDetail">
               <div class="col-lg-5 col-md-5 col-xs-4 col-sm-4 pr0">
                    Chat
                </div>
                <div class="col-md-7 col-lg-7 col-xs-7 col-sm-7 m-l-left pr0">:&nbsp;
                	<?php echo $plan_data_val['chat']; ?>
                </div>
           </div>
           <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 neAdminResultDetail">
               <div class="col-lg-2 col-md-2 col-xs-4 col-sm-4 pr0">
                    Plan Offer
                </div>
                <div class="col-md-7 col-lg-7 col-xs-7 col-sm-7 ml20 pr0">:&nbsp;
                	<?php 
						if(isset($plan_data_val['plan_offers']) && $plan_data_val['plan_offers'] !='')
						{
							echo $plan_data_val['plan_offers'];
						}
						else
						{
							echo $dna;
						}
					?>
                </div>
           </div>
        </div>

        </div>
    <?php
			}
		}
	?>
    <div class="clearfix"><br/></div>
    <div class="row form-horizontal">
    	<div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
        	<div class="form-group ">
              <label class="col-sm-1 col-lg-1"></label>
              <label class="col-sm-2 col-lg-2 control-label text-bold">Payment&nbsp;Note</label>
              <div class="col-sm-6 col-lg-6">
                <textarea rows="5" class="form-control" name="payment_note" id="payment_note" placeholder="Enter Payment Note"></textarea>
              </div>
              <label class="col-sm-1 col-lg-1"></label>
            </div>
        </div>
    </div>
    <div class="clearfix"><br/></div>
    <div class="row form-horizontal">
    	<div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 text-center">
    		<button type="button" class="btn btn-primary mr10" onclick="update_payment_member()">Submit</button>
            <button type="button" onclick="close_payment_pop()" class="btn btn-default" data-dismiss="myModal_common">Close</button>
        </div>
    </div>
    
</div>
<input type="hidden" id="hash_tocken_id_temp" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
<input type="hidden" id="hidd_user_id" name="hidd_user_id" value="<?php echo $hidd_user_id;?>" />

<script type="text/javascript">
	function display_plan()
	{
		var plan_id = $("#plan_id").val();
		$(".plan_detail").slideUp();
		if(plan_id !='')
		{
			$("#plan_detail_"+plan_id).slideDown();
		}
	}
</script>