<div class="container-fluid new-width width-95 mt-40-pro">
    <div class="row-cstm">
        <!--for Mobile start--> 
        <?php include_once('my_profile_sidebar_mob.php');?>				
        <!--for Mobile end--> 
        <!--for Desktop start--> 
        <?php include_once('my_profile_sidebar.php');?>
        <!--for Desktop end--> 
        	<div class="col-md-9 col-sm-12 col-xs-12 padding-zero">
            	<?php include_once('my_dashboard_info.php');?>
            	<div class="dshbrd_overlay mt-2">
					<div class="dshbrd_color_overlay new-saved-search">
						<div class="row">
							<div class="col-md-12 col-xs-12">
								<span class="saved-search-i Poppins-Medium"> <i class="fas fa-heart"></i>  Like Profiles
								</span>
							</div>
						</div>
					</div>
				</div>
				<!------- for search result ----->
            	<div id="main_content_ajax">
					<?php include_once('short_listed_member_profile.php'); ?>
				</div>
           	   	<!------ for search result ------> 
			</div>
		</div>
	</div>
</div>