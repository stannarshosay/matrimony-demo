<?php $current_login_user = $this->common_front_model->get_session_data();
$is_login = $this->common_front_model->checkLogin('return');
$login_li = '';
if($is_login){
	$login_li = 'after-login-li';
}
?>
<div class="contact-tab">
    <div class="container-fluid new-width">
        <div class="row">
            <div class="col-md-12">
                <div class="tab contact-tab-m quick-search-tab hidden-sm hidden-xs" role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs contact-tab-nav2" role="tablist">
                        <li role="presentation" class="<?php echo $login_li; if($this->uri->segment(2)=='quick-search'){echo ' active';}?> f-17">
                            <a href="<?php echo $base_url;?>search/quick-search">
                                <i class="fas fa-search"></i>
                            Quick Search</a>
                        </li>
                        <li role="presentation" class="<?php echo $login_li; if($this->uri->segment(2)=='advance-search'){echo ' active';}?> f-17">
                            <a href="<?php echo $base_url;?>search/advance-search"><i class="fas fa-search-plus"></i> Advance Search</a>
                        </li>
                        <li role="presentation" class="<?php echo $login_li; if($this->uri->segment(2)=='keyword-search'){echo ' active';}?> f-17">
                            <a href="<?php echo $base_url;?>search/keyword-search"><i class="fas fa-keyboard"></i> Keyword Search</a>
                        </li>
                        <li role="presentation" class="<?php echo $login_li; if($this->uri->segment(2)=='id-search'){echo ' active';}?> f-17 li-last">
                            <a href="<?php echo $base_url;?>search/id-search" ><i class="fas fa-user"></i> ID Search</a>
                        </li>
                        <?php if($is_login){?>
                        	<li role="presentation" class="<?php echo $login_li; if($this->uri->segment(2)=='saved'){echo ' active';}?> f-17">
                            	<a href="<?php echo $base_url;?>search/saved"><i class="fas fa-list"></i> Saved Search</a>
                        	</li>
						<?php }?>
                    </ul>
                    <!-- Tab panes -->
                </div>
            </div>
        </div>
    </div>
</div>
		<div class="container new-width" style="width:93%;">
			<div class="row">
				<div class="tab-content tabs tab-content-margin-top">
					<div role="tabpanel" class="tab-pane fade in <?php if($this->uri->segment(2)=='quick-search'){echo 'active';}?>" id="quick-search-tab">
						<div class="row mt-4 margin-lr-0">
							<?php include_once('quick_search.php');?>
							<div class="col-md-4 col-sm-12 col-xs-12">
								<?php 
								include('id_search_rightsidebar.php');
								echo $this->common_model->display_advertise('Level 2','hidden-sm hidden-xs');
								$class1 = 'Prf_sidebar-new-mac';
								include('featured_rightsidebar.php');
								?>
							</div>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane fade in <?php if($this->uri->segment(2)=='advance-search'){echo 'active';}?>" id="advance-search-tab">
						<div class="row mt-4 margin-lr-0">
							<?php include_once('advance_search.php');?>
							<div class="col-md-4 col-sm-12 col-xs-12">
								<?php include('id_search_rightsidebar.php');
                                echo $this->common_model->display_advertise('Level 2');
								include('featured_rightsidebar.php');
								?>
							</div>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane fade in <?php if($this->uri->segment(2)=='keyword-search'){echo 'active';}?>" id="keyword-search-tab">
						<div class="row mt-4 margin-lr-0">
							<?php include_once('keyword_search.php');?>
							<div class="col-md-4 col-sm-12 col-xs-12">
								<?php 
									include('id_search_rightsidebar.php');
							    	include('featured_rightsidebar.php');
								?>
							</div>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane fade in <?php if($this->uri->segment(2)=='id-search'){echo 'active';}?>" id="id-search-tab">
						<div class="row mt-4 margin-lr-0">
							<?php include_once('id_search.php');?>
							<div class="col-md-4 col-sm-12 col-xs-12">
							     <?php $limit=3;
								 include('featured_rightsidebar.php');?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container new-width hidden-sm hidden-xs" style="width:93%;display:inherit;">
			<div class="row">
            	<?php include_once('search_footer_slider.php');?>
				<div class="col-md-4 col-sm-12 col-xs-12 padding-right-zero-search">
					<?php echo $this->common_model->display_advertise('Level 1','cstm_border_new');?>
				</div>
			</div>
		</div>
        