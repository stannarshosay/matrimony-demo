<div class="container-fluid new-width width-95 mt-40-pro">
    <div class="row-cstm">
        <!--for Mobile start--> 
        <?php include_once('my_profile_sidebar_mob.php');?>				
        <!--for Mobile end--> 
        <!--for Desktop start--> 
        <?php include_once('my_profile_sidebar.php');?>
        <!--for Desktop end--> 
        <div class="col-md-9 col-sm-12 col-xs-12">
            <?php include_once('my_dashboard_info.php');?>
            <div class="dshbrd_overlay mt-2">
					<div class="dshbrd_color_overlay new-saved-search">
						<div class="row">
							<div class="col-md-12 col-xs-12">
								<span class="saved-search-i Poppins-Medium"> <i class="fas fa-key"></i> Photo Password Request Sent
								</span>
							</div>
						</div>
					</div>
				</div>
				<!------- for search result ----->
            	<div id="main_content_ajax">
					<?php include_once('photo_pass_request_sent_ajax.php'); ?>
				</div>
           	   	<!------ for search result ------> 
			</div>
		</div>
	</div>
</div>

<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" id="hash_tocken_id_temp" class="hash_tocken_id" />
<input type="hidden" name="base_url" value="<?php echo $base_url; ?>" id="base_url"/>
<input type="hidden" name="requester_id" value="" id="requester_id"/>
<input type="hidden" name="status_sent_recieve" value="" id="status_sent_recieve"/>
<?php
$this->common_model->js_extra_code_fr.="
	function delete_photo_reqeust(id,status)
	{
		$('#requester_id').val(id);
		$('#status_sent_recieve').val(status);
	}
	";
	$this->common_model->js_extra_code_fr.=" load_pagination_code_front_end(); ";
?>