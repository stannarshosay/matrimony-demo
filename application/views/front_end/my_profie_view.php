<style>
	
.Zebra_DatePicker_Icon {
	left: 174px !important;
}
.new-accordion {
	right: 0;
	width: 100%;
}
.breakword{
	word-break: break-word;
}
.h-34{
	height:45px;
}
</style>
    <div class="container-fluid width-95 mt-60-pro">
        <div class="row-cstm hidden-sm hidden-xs">
            <?php include_once('my_profile_sidebar.php');?>
        </div>
        <div class="col-md-9 col-sm-9 col-xs-12 hidden-sm hidden-xs" id="refresh_div">
            <?php include_once('my_dashboard_info.php');?>
            <div class="">
                <div class="row">
                    <div class="col-xs-12">
                        <!-- design process steps-->
                        <!-- Nav tabs -->
                        <!-- end design process steps-->
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="edit_div tab-pane fade" id="basic_info_tab_edit">
                                <div class="design-process-content pb-5">
                                    <form id="ne_lft_pan_list1" class=" basic-detail" name="ne_lft_pan_list1" action="<?php echo $base_url; ?>my-profile/save-profile/basic-detail" onSubmit="return validat_function_frm1('ne_lft_pan_list1')">
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"  class="hash_tocken_id" />
                                    <input type="hidden" name="is_post" value="1" />
                                    <input type="hidden" name="base_url" value="<?php echo $base_url; ?>" />
                                    
                                    <div id="reponse_ne_lft_pan_list1"></div>
                                    
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <a href="javascript:;" onClick="return view_show('basic_info_tab');" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right">Cancel</a>
                                            <button onClick="return validat_function_frm1('ne_lft_pan_list1')" class="edit_pro-1 edit_pro_submit Poppins-Semi-Bold f-15 color-31 pull-right" style="background-color: transparent;border: none;">Submit</button>
                                    	</div>
                                    </div>
                                    <div class="main_box_basic_detail">
                                        <div class="">
                                            <div class="row margin-0">
                                            <?php
                                                $member_id = $this->common_front_model->get_session_data('id');
                                                if(isset($member_id) && $member_id != '' )
                                                {
                                                    $row_data = $this->common_model->get_count_data_manual('register',array('id'=>$member_id,'is_deleted'=>'No'),1);
                                                $this->common_front_model->edit_row_data = $row_data;
                                                $this->common_model->edit_row_data = $row_data;
                                                $this->common_model->mode= 'edit';
                                                $this->common_front_model->mode= 'edit';
                                                $mother_tongue_arr = $this->common_model->dropdown_array_table('mothertongue');
                                                $religion_arr = $this->common_model->dropdown_array_table('religion');
                                                $education_name_arr = $this->common_model->dropdown_array_table('education_detail');
                                                $occupation_arr = $this->common_model->dropdown_array_table('occupation');
                                                $designation_arr = $this->common_model->dropdown_array_table('designation');
                                                $country_arr = $this->common_model->dropdown_array_table('country_master');
                                                $height = $this->common_model->height_list();
                                                $weight = $this->common_model->weight_list();
                                                
                                                $mobile = $row_data['mobile'];
                                                $birth_date = $row_data['birthdate'];
                                                if($mobile !='')
                                                {
                                                    $mobile_arr = explode('-',$mobile);
                                                    if(isset($mobile_arr) && count($mobile_arr) == 2 )
                                                    {
                                                        $current_count_code = $mobile_arr[0];
                                                        $mobile_val = $mobile_arr[1];
                                                    }
                                                    else
                                                    {
                                                        $mobile_val = $mobile_arr[0];
                                                    }
                                                }
                                                
                                                $birth_ddr_str = $this->common_model->birth_date_picker($birth_date);
                                            //     $birth_date_str = '<div class="col-md-4 col-sx-12 col-sm-4" >
                                            //     <h5 class="color-profile Poppins-Regular">Birthdate</h5>
                                            //     <input type="text" class="form-control w-75" id="datepicker-example22" placeholder="Birth Date:">
                                            // </div>';
                                            $birth_date_str = '<div class="col-md-12 col-sx-12 col-sm-12" >
                                            <h5 class="color-profile Poppins-Regular">Birthdate</h5>
                                           '.$birth_ddr_str.'
                                       </div>';
                                                }
                                                $ele_array = array(
                                                'firstname'=>array('is_required'=>'required','label'=>'First Name','class'=>'form-control h-34'),
                                                'lastname'=>array('is_required'=>'required','label'=>'Last Name','class'=>'form-control h-34'),
                                                'marital_status'=>array('is_required'=>'required','class'=>'form-control select-cust w-75','type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('marital_status'),'value'=>'Unmarried','onchange'=>'display_total_childern()'),
                                            );
                                            echo $this->common_front_model->generate_common_front_form($ele_array,array('enctype'=>'enctype="multipart/form-data"','page_type'=>'edit_profile'));

                                            ?>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <div class="row mt-4 margin-0">
                                                <?php 
                                                $ele_array = array(
                                                    'total_children'=>array('is_required'=>'required','class'=>'form-control select-cust w-75','type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('total_children'),'value_curr'=>0,'extra'=>'disabled','onchange'=>'display_childern_status()'),
                                                    'status_children'=>array('is_required'=>'required','class'=>'form-control select-cust w-75','type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('status_children'),'extra'=>'disabled'),
                                                    'mother_tongue'=>array('is_required'=>'required','type'=>'dropdown','class'=>'form-control select-cust w-75 select2','value_arr'=>$mother_tongue_arr,'label'=>'Mother Tongue','extra_style'=>'width:100%'),
                                                   
                                                );
                                                echo $this->common_front_model->generate_common_front_form($ele_array,array('enctype'=>'enctype="multipart/form-data"','page_type'=>'edit_profile'));
                                                ?>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <div class="row mt-3 margin-0">
                                            <?php 
                                             $ele_array = array(
                                                'languages_known'=>array('type'=>'dropdown','id'=>'language','is_multiple'=>'yes','display_placeholder'=>'No','class'=>'form-control dashbrd_cstm','value_arr'=>$mother_tongue_arr,'label'=>'Language Known'));
                                                echo $this->common_front_model->generate_common_front_form($ele_array,array('enctype'=>'enctype="multipart/form-data"','page_type'=>'edit_profile_multiple'));
                                                $ele_array = array(
                                                    
                                                    'height'=>array('is_required'=>'required','type'=>'dropdown','class'=>'form-control select-cust w-75 select2','value_arr'=>$height,'label'=>'Height','extra_style'=>'width:100%'),
                                                    'weight'=>array('is_required'=>'required','type'=>'dropdown','class'=>'form-control select-cust w-75 select2','value_arr'=>$weight,'label'=>'Weight','extra_style'=>'width:100%'),
                                                    
                                                );
                                                echo $this->common_front_model->generate_common_front_form($ele_array,array('enctype'=>'enctype="multipart/form-data"','page_type'=>'edit_profile'));
                                                ?>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <div class="row mt-3 margin-0">
                                            <?php 
                                                $ele_array = array(
                                                    'birthdate'=>array('type'=>'manual','code'=>$birth_date_str),
                                                );
                                                echo $this->common_front_model->generate_common_front_form($ele_array,array('enctype'=>'enctype="multipart/form-data"','page_type'=>'edit_profile'));
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            <!--2nd tab start-->
                            <div role="tabpanel" class="edit_div tab-pane fade" id="lifestyle_style_tab_edit">
                                <div class="design-process-content pb-5">
                                    <div id="reponse_ne_lft_pan_list15"></div>	
                                    <form id="ne_lft_pan_list15" name="ne_lft_pan_list15" action="<?php echo $base_url; ?>my-profile/save-profile/life-style-detail" onSubmit="return validat_function('ne_lft_pan_list15')" class="margin-top-10 life-style-detail">
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"  class="hash_tocken_id" />
                                    <input type="hidden" name="is_post" value="1" />
                                    <input type="hidden" name="base_url" value="<?php echo $base_url; ?>" />
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <a href="javascript:;" onclick="return view_show('lifestyle_style_tab');" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right">Cancel</a>
                                            <button onClick="return validat_function('ne_lft_pan_list15')" class="edit_pro-1 edit_pro_submit Poppins-Semi-Bold f-15 color-31 pull-right" style="background-color: transparent;border: none;">Submit</button>
                                        </div>
                                    </div>
                                    <div class="main_box_basic_detail">
                                        <div class="">
                                            <div class="row margin-0">
                                               <?php 
                                               $ele_array = array(
                                                'bodytype'=>array('type'=>'dropdown','display_placeholder'=>'Yes','class'=>'form-control select-cust w-75 select2','value_arr'=>$this->common_model->get_list_ddr('bodytype'),'label'=>'Body Type'),
                                                
                                                'diet'=>array('type'=>'dropdown','display_placeholder'=>'Yes','class'=>'form-control select-cust w-75 select2','value_arr'=>$this->common_model->get_list_ddr('diet'),'label'=>'Eating Habit','extra_style'=>'width:100%'),
                                                
                                                'smoke'=>array('type'=>'dropdown','display_placeholder'=>'Yes','class'=>'form-control select-cust w-75 select2','value_arr'=>$this->common_model->get_list_ddr('smoke'),'label'=>'Smoke Habit'),
                                                
                                                );
                                                echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile'));
                                            ?>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <div class="row mt-4 margin-0">
                                            <?php 
                                            $ele_array = array(
							
                                                'drink'=>array('type'=>'dropdown','display_placeholder'=>'Yes','class'=>'form-control select-cust w-75 select2','value_arr'=>$this->common_model->get_list_ddr('drink'),'label'=>'Drink Habit'),
                                                
                                                'complexion'=>array('type'=>'dropdown','display_placeholder'=>'Yes','class'=>'form-control select-cust w-75 select2','value_arr'=>$this->common_model->get_list_ddr('complexion'),'label'=>'Skin Tone'),
                                                'blood_group'=>array('type'=>'dropdown','display_placeholder'=>'Yes','class'=>'form-control select-cust w-75 select2','value_arr'=>$this->common_model->get_list_ddr('blood_group')));
                                                echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile'));
                                            ?>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            <!--2nd tab end-->
                            <!--3rd tab start-->
                            <div role="tabpanel" class="edit_div tab-pane fade" id="about_me_hobby_edit">
                                <div class="design-process-content pb-5">
                                <div id="reponse_ne_lft_pan_list2"></div>
                                <form id="ne_lft_pan_list2" name="ne_lft_pan_list2" action="<?php echo $base_url; ?>my-profile/save-profile/about-me-detail" onSubmit="return validat_function_form2('ne_lft_pan_list2')" class="margin-top-10 about-me-detail">
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"  class="hash_tocken_id" />
                                    <input type="hidden" name="is_post" value="1" />
                                    <input type="hidden" name="base_url" value="<?php echo $base_url; ?>" />
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <a href="javascript:;" onclick="return view_show('about_me_hobby');" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right">Cancel</a>
                                            <button onClick="return validat_function_form2('ne_lft_pan_list2')" class="edit_pro-1 edit_pro_submit Poppins-Semi-Bold f-15 color-31 pull-right" style="background-color: transparent;border: none;">Submit</button>

                                        </div>
                                    </div>
                                    <div class="main_box_basic_detail">
                                        <div class="">
                                            <div class="row margin-0">
                                            <?php
                                            $member_id = $this->common_front_model->get_session_data('id');
                                            if(isset($member_id) && $member_id != '' )
                                            {
                                                $row_data = $this->common_model->get_count_data_manual('register',array('id'=>$member_id,'is_deleted'=>'No'),1);
                                                $this->common_front_model->edit_row_data = $row_data;
                                                $this->common_model->edit_row_data = $row_data;
                                                $this->common_model->mode= 'edit';
                                                $this->common_front_model->mode= 'edit';
                                            }
                                            $ele_array = array(
                                            'profile_text'=>array('type'=>'textarea','label'=>'About Us'),
                                            'hobby'=>array('type'=>'textarea'),
                                            'birthplace'=>array('label'=>'Birth Place','class'=>'form-control h-34'),
                                            );
                                            echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile'));
                                        ?>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <div class="row mt-4 margin-0">
                                            <?php 
                                                 $ele_array = array(
                                                'birthtime'=>array('label'=>'Birth Time','other'=>'type="time"','class'=>'form-control h-34'),
                                                'profileby'=>array('is_required'=>'required','type'=>'dropdown','class'=>'form-control select-cust w-75 select2','value_arr'=>$this->common_model->get_list_ddr('profileby'),'label'=>'Created By'),
                                                'reference'=>array('is_required'=>'required','type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('reference')),
                                                );
                                                echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile'));
                                            ?>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            <!--3rd tab end-->
                            <!--4th tab start-->
                            <div role="tabpanel" class="edit_div tab-pane fade" id="religious_info_edit">
                                <div class="design-process-content pb-5">
                                <div id="reponse_ne_lft_pan_list3"></div>
                                <form id="ne_lft_pan_list3" name="ne_lft_pan_list3" action="<?php echo $base_url; ?>my-profile/save-profile/religious-detail" onSubmit="return validat_function('ne_lft_pan_list3')" class=" margin-top-10 religious-detail">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"  class="hash_tocken_id" />
                                <input type="hidden" name="is_post" value="1" />
                                <input type="hidden" name="base_url" value="<?php echo $base_url; ?>" />
								
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <a href="javascript:;" onclick="return view_show('religious_info');" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right">Cancel</a>
                                            <button onClick="return validat_function('ne_lft_pan_list3')" class="edit_pro-1 edit_pro_submit Poppins-Semi-Bold f-15 color-31 pull-right" style="background-color: transparent;border: none;">Submit</button>
                                        </div>
                                    </div>
                                    <div class="main_box_basic_detail">
                                        <div class="">
                                            <div class="row margin-0">
                                            <?php
                                                $member_id = $this->common_front_model->get_session_data('id');
                                                if(isset($member_id) && $member_id != '' )
                                                {
                                                    $row_data = $this->common_model->get_count_data_manual('register',array('id'=>$member_id,'is_deleted'=>'No'),1);
                                                    $this->common_front_model->edit_row_data = $row_data;
                                                    $this->common_model->edit_row_data = $row_data;
                                                    $this->common_model->mode= 'edit';
                                                    $this->common_front_model->mode= 'edit';
                                                }
                                                $ele_array = array(
                                                'religion'=>array('is_required'=>'required','type'=>'dropdown','onchange'=>"dropdownChange('religion','caste','caste_list')",'value_arr'=>$religion_arr),
                                                'caste'=>array('is_required'=>'required','type'=>'dropdown','relation'=>array('rel_table'=>'caste','key_val'=>'id','key_disp'=>'caste_name','rel_col_name'=>'religion_id','not_load_add'=>'yes','not_load_add'=>'yes','cus_rel_col_val'=>'religion')),
                                                'subcaste'=>array('label'=>'Sub Caste','class'=>'form-control h-34'),
                                                );
                                                echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile'));
                                            ?>          
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <div class="row mt-4 margin-0">
                                                <?php 
                                                $ele_array = array(
                                                    'manglik'=>array('type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('manglik'),'extra_style'=>'width:100%'),
                                                    'star'=>array('type'=>'dropdown','class'=>'form-control select-cust w-75 select2','value_arr'=>$this->common_model->dropdown_array_table('star'),'extra_style'=>'width:100%'),
                                                    'horoscope'=>array('type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('horoscope'),'extra_style'=>'width:100%'),
                                                    );
                                                    echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile'));
                                                ?>   
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <div class="row mt-3 margin-0">
                                            <?php 
                                                $ele_array = array(
                                                    'gothra'=>array('label'=>'Gothra','class'=>'form-control h-34'),
                                                    'moonsign'=>array('type'=>'dropdown','class'=>'form-control select-cust w-75 select2','value_arr'=>$this->common_model->dropdown_array_table('moonsign'),'extra_style'=>'width:100%'),
                                                    );
                                                    echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile'));
                                                ?> 
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            <!--4th tab end-->
                            <!--5th tab start-->
                            <div role="tabpanel" class="edit_div tab-pane fade" id="location_info_edit">
                                <div class="design-process-content pb-5">
                                    <div id="reponse_ne_lft_pan_list4"></div>
								    <form id="ne_lft_pan_list4" name="ne_lft_pan_list4" action="<?php echo $base_url; ?>my-profile/save-profile/residence-detail" onSubmit="return validat_function_res('ne_lft_pan_list4')" class="margin-top-10 residence-detail">
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"  class="hash_tocken_id" />
									<input type="hidden" name="is_post" value="1" />
									<input type="hidden" name="base_url" value="<?php echo $base_url; ?>" />
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <a href="javascript:;" onclick="return view_show('location_info');" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right">Cancel</a>
                                            <button onClick="return validat_function_res('ne_lft_pan_list4')" class="edit_pro-1 edit_pro_submit Poppins-Semi-Bold f-15 color-31 pull-right" style="background-color: transparent;border: none;">Submit</button>
                                        </div>
                                    </div>
                                    <div class="main_box_basic_detail">
                                        <div class="">
                                            <div class="row margin-0">
                                            <?php		
                                                $mobile_val = '';
                                                $current_count_code = '+91';
                                                $member_id = $this->common_front_model->get_session_data('id');
                                                if(isset($member_id) && $member_id != '' )
                                                {
                                                    $row_data = $this->common_model->get_count_data_manual('register',array('id'=>$member_id,'is_deleted'=>'No'),1);
                                                    $this->common_front_model->edit_row_data = $row_data;
                                                    $this->common_model->edit_row_data = $row_data;
                                                    $this->common_model->mode= 'edit';
                                                    $this->common_front_model->mode= 'edit';
                                                    
                                                    $mobile = $row_data['mobile'];
                                                    if($mobile !='')
                                                    {
                                                        $mobile_arr = explode('-',$mobile);
                                                        if(isset($mobile_arr) && count($mobile_arr) == 2 )
                                                        {
                                                            $current_count_code = $mobile_arr[0];
                                                            $mobile_val = $mobile_arr[1];
                                                        }
                                                        else
                                                        {
                                                            $mobile_val = $mobile_arr[0];
                                                        }
                                                    }
                                                    $where_country_code= array(" ( is_deleted ='No' ) GROUP BY country_code");
                                                    $country_code_arr = $this->common_model->get_count_data_manual('country_master',$where_country_code,2,'country_code,country_name','','','',"");
                                                    $mobile_ddr= '<div class="col-sm-4 col-lg-4 pl0"  style="padding-left:0px">
                                                    <select name="country_code" id="country_code" required class="form-control select-cust w-75 select2" style="width:100%;">
                                                    <option value="">Select Country Code</option>';
                                                    foreach($country_code_arr as $country_code_arr)
                                                    {	
                                                        $select_ed_drp = '';
                                                        if($country_code_arr['country_code'] == $current_count_code)
                                                        {
                                                            $select_ed_drp = 'selected';
                                                        }
                                                        $mobile_ddr.= '<option '.$select_ed_drp.' value='.$country_code_arr['country_code'].'>'.$country_code_arr['country_code'].'</option>';
                                                    }
                                                    $mobile_ddr.='</select>
                                                    </div>
                                                    <div class="col-sm-8 col-lg-8" style="padding:0px">
                                                    <input type="text" minlength="7" maxlength="13" required name="mobile_num" id="mobile_num" class="form-control h-34" placeholder="Mobile Number" value ="'.$mobile_val.'"  />
                                                    </div>';
                                                    
                                                }	
                                                
                                                $ele_array = array(
                                                'country_id'=>array('is_required'=>'required','type'=>'dropdown','value_arr'=>$country_arr,'label'=>'Country','class'=>'select2 country_id_update','onchange'=>"dropdownChange_new('country_id_update','state_id_update','state_list')",'extra_style'=>'width:100%'),
                                                'state_id'=>array('is_required'=>'required','type'=>'dropdown','relation'=>array('rel_table'=>'state_master','key_val'=>'id','key_disp'=>'state_name','not_load_add'=>'yes','cus_rel_col_name'=>'country_id',),'label'=>'State','class'=>'select2 state_id_update','onchange'=>"dropdownChange_new('state_id_update','city_update','city_list')",'extra_style'=>'width:100%'),
                                                'city'=>array('is_required'=>'required','type'=>'dropdown','relation'=>array('rel_table'=>'city_master','key_val'=>'id','key_disp'=>'city_name','not_load_add'=>'yes','cus_rel_col_name'=>'state_id'),'label'=>'City','class'=>'select2 city_update','extra_style'=>'width:100%'),
                                                );
                                                echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile'));
                                            ?>
                                                
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <div class="row mt-4 margin-0">
                                            <?php
                                            $ele_array = array(
                                                'address'=>array('type'=>'textarea'),
                                            'mobile'=>array('type'=>'manual','code'=>'
                                            <div class="col-md-4 col-sx-12 col-sm-4">
                                            <h5 class="color-profile Poppins-Regular">Mobile <span class="color-d f-16 select2-lbl-span">* </span></h5>
                                                
                                                '.$mobile_ddr.'
                                                <input type="hidden" name="mobile" id="mobile" value="" />
                                                
                                                </div>'),
                                                'phone'=>array('class'=>'form-control h-34'),
                                                
                                               
                                            );
                                                if(isset($this->common_model->is_demo_mode) && $this->common_model->is_demo_mode == 1 && $row_data['mobile']  !='')
                                                {
                                                    $ele_array['mobile'] = array('type'=>'manual','code'=>'
                                                    <div class="col-md-4 col-sx-12 col-sm-4">
                                                    <h5 class="color-profile Poppins-Regular">Mobile <span class="color-d f-16 select2-lbl-span">* </span></h5>
                                                    <div class="xxl-12 xl-10 s-16 xs-16 m-16 l-10">
                                                    <span><strong>'.$this->common_model->disable_in_demo_text.'</strong></span>
                                                    </div>
                                                    </div>');
                                                }
                                                echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile'));
                                            ?>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <div class="row mt-3 margin-0">
                                            <?php
                                            $ele_array = array(
                                                'time_to_call'=>array('class'=>'form-control h-34'),
                                                'residence'=>array('type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('residence'),'extra_style'=>'width:100%')
                                            );
                                            echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile'));
                                            ?>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            <!--5th tab end-->
                            <!--6th tab start-->
                            <div role="tabpanel" class="edit_div tab-pane fade" id="education_info_edit">
                                <div class="design-process-content pb-5">
                                    <div id="reponse_ne_lft_pan_list5"></div>
                                    <form id="ne_lft_pan_list5" name="ne_lft_pan_list5" action="<?php echo $base_url; ?>my-profile/save-profile/education-detail" onSubmit="return validat_function('ne_lft_pan_list5')" class="margin-top-10 education-detail">
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"  class="hash_tocken_id" />
									<input type="hidden" name="is_post" value="1" />
									<input type="hidden" name="base_url" value="<?php echo $base_url; ?>" />
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <a href="javascript:;" onclick="return view_show('education_info');" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right">Cancel</a>
                                            <button onClick="return validat_function('ne_lft_pan_list5')" class="edit_pro-1 edit_pro_submit Poppins-Semi-Bold f-15 color-31 pull-right" style="background-color: transparent;border: none;">Submit</button>
                                        </div>
                                    </div>
                                    <div class="main_box_basic_detail">
                                        <div class="">
                                            <div class="row margin-0">
                                                <?php
                                                    $member_id = $this->common_front_model->get_session_data('id');
                                                    if(isset($member_id) && $member_id != '' )
                                                    {
                                                        $row_data = $this->common_model->get_count_data_manual('register',array('id'=>$member_id,'is_deleted'=>'No'),1);
                                                        $this->common_front_model->edit_row_data = $row_data;
                                                        $this->common_model->edit_row_data = $row_data;
                                                        $this->common_model->mode= 'edit';
                                                        $this->common_front_model->mode= 'edit';
                                                    }
                                                    $ele_array = array(
                                                        'education_detail'=>array('is_required'=>'required','type'=>'dropdown','is_multiple'=>'yes','display_placeholder'=>'No','class'=>'select2','value_arr'=>$education_name_arr,'label'=>'Education','extra_style'=>'width:100%'));
                                                        echo $this->common_front_model->generate_common_front_form($ele_array,array('enctype'=>'enctype="multipart/form-data"','page_type'=>'edit_profile_multiple'));
                                                    $ele_array = array(
                                                    
                                                    'employee_in'=>array('type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('employee_in'),'extra_style'=>'width:100%'),
                                                    'income'=>array('type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('income'),'label'=>'Annual Income','extra_style'=>'width:100%'),
                                                    
                                                    );
                                                    echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile'));
                                                ?>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <div class="row mt-4 margin-0">
                                                <?php 
                                                $ele_array = array(
                                                    'occupation'=>array('is_required'=>'required','type'=>'dropdown','value_arr'=>$occupation_arr,'label'=>'Occupation','class'=>'select2','extra_style'=>'width:100%'),
                                                    'designation'=>array('type'=>'dropdown','class'=>'select2','value_arr'=>$designation_arr,'extra_style'=>'width:100%')
                                                );
                                                echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile'));
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            <!--6th tab end-->
                            <!--7th tab start-->
                            <div role="tabpanel" class="edit_div tab-pane fade" id="family_info_edit">
                                <div class="design-process-content pb-5">
                                    <div id="reponse_ne_lft_pan_list6"></div>
                                    <form id="ne_lft_pan_list6" name="ne_lft_pan_list6" action="<?php echo $base_url; ?>my-profile/save-profile/family-detail" onSubmit="return validat_function_frm6('ne_lft_pan_list6')" class="margin-top-10 family-detail">
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"  class="hash_tocken_id" />
                                    <input type="hidden" name="is_post" value="1" />
                                    <input type="hidden" name="base_url" value="<?php echo $base_url; ?>" />
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <a href="javascript:;" onclick="return view_show('family_info');" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right">Cancel</a>
                                            <button onClick="return validat_function_frm6('ne_lft_pan_list6')" class="edit_pro-1 edit_pro_submit Poppins-Semi-Bold f-15 color-31 pull-right" style="background-color: transparent;border: none;">Submit</button> 
                                        </div>
                                    </div>
                                    <div class="main_box_basic_detail">
                                        <div class="">
                                            <div class="row margin-0">
                                            <?php
                                                $member_id = $this->common_front_model->get_session_data('id');
                                                if(isset($member_id) && $member_id != '' )
                                                {
                                                    $row_data = $this->common_model->get_count_data_manual('register',array('id'=>$member_id,'is_deleted'=>'No'),1);
                                                    $this->common_front_model->edit_row_data = $row_data;
                                                    $this->common_model->edit_row_data = $row_data;
                                                    $this->common_model->mode= 'edit';
                                                    $this->common_front_model->mode= 'edit';
                                                }
                                                $ele_array = array(
                                                    'family_type'=>array('type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('family_type'),'extra_style'=>'width:100%'),
                                                    'father_name'=>array('class'=>'form-control h-34'),
                                                    'father_occupation'=>array('lable'=>"Father's Occupation",'class'=>'form-control h-34'),
                                                );
                                                echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile'));
                                            ?>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <div class="row mt-4 margin-0">
                                            <?php
                                                $ele_array = array(
                                                    'mother_name'=>array('class'=>'form-control h-34'),
                                                    'mother_occupation'=>array('lable'=>"Mother's Occupation",'class'=>'form-control h-34'),
                                                    'family_status'=>array('type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('family_status'),'extra_style'=>'width:100%'),    
                                                );
                                                echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile'));
                                            ?>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <div class="row mt-3 margin-0">
                                            <?php
                                                $ele_array = array(
                                                    'no_of_brothers'=>array('type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('no_of_brothers'),'extra_style'=>'width:100%','class'=>'no_of_brothers','onchange'=>'show_bro_details()'),
													'no_of_married_brother'=>array('type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('no_marri_brother'),'extra_style'=>'width:100%','class'=>'no_of_married_brother'),
                                                    'no_of_sisters'=>array('type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('no_of_brothers'),'extra_style'=>'width:100%','class'=>'no_of_sisters','onchange'=>'show_sis_details()')
                                                );
                                                echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile'));
                                            ?>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <div class="row mt-3 margin-0">
                                            <?php
                                                $ele_array = array(
                                                    'no_of_married_sister'=>array('type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('no_marri_sister'),'extra_style'=>'width:100%','class'=>'no_of_married_sister'),
													'family_details'=>array('type'=>'textarea','extra_style'=>'width:100%','label'=>'About My Family')
                                                );
                                                echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile'));
                                            ?>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            <!--7th tab end-->
                        </div>
                        <!--1st box of basic_info_tab view-->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane mt-4 fade in active" id="basic_info_tab">
                                <div class="design-process-content pb-5 basic_info_tab">
                                    <div class="row ml-0">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <p class="prf_30 Poppins-Semi-Bold f-17 color-d">Basic Details</p>
                                        </div>
                                    </div>
                                    <hr class="mt-2">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <a href='javascript:;' onclick="edit_show('basic_info_tab');" role="button" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right"><i class="fas fa-pen Edit_pen"></i>Edit</a>
                                        </div>
                                    </div>
                                    <div class="main_box_preference">
                                        <div class="row margin-0 mt-0">
                                            <?php
                                                $element_array = array(
                                                    'username'=>array('label'=>'Name'),
                                                    'marital_status'=>array(),
                                                    'total_children'=>array(),
                                                );
                                                echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                            ?>
                                        </div>
                                        <div class="row margin-0 mt_partf">
                                            <?php
                                                    $element_array = array(
                                                        'status_children'=>array(),
                                                        'mtongue_name'=>array('label'=>'Mother Tongue'),
                                                        'languages_known'=>array('type'=>'relation','table_name'=>'mothertongue','disp_column_name'=>'mtongue_name'),
                                                        
                                                    );
                                                    echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                                ?>
                                        </div>
                                        <div class="row margin-0 mt_partf">
                                        <?php
                                                $element_array = array(
                                                   
                                                    'height'=>array('call_back'=>'display_height'),
                                                    'weight'=>array('post_filed'=>'KG','post_filed_val'=>'Kg'),
                                                    'birthdate'=>array('call_back'=>'birthdate_disp')
                                                );
                                                echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--2nd box of lifestyle_style_tab view-->
                            <div role="tabpanel" class="tab-pane mt-4 fade" id="lifestyle_style_tab">
                                <div class="design-process-content pb-5 lifestyle_style_tab">
                                    <div class="row ml-0">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <p class="prf_30 Poppins-Semi-Bold f-17 color-d">Life Style Details</p>
                                        </div>
                                    </div>
                                    <hr class="mt-2">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <a href='javascript:;' onclick="edit_show('lifestyle_style_tab');" role="button" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right"><i class="fas fa-pen Edit_pen"></i>Edit</a>
                                        </div>
                                    </div>
                                    <div class="main_box_preference">
                                        <div class="row margin-0 mt-0">
                                        <?php
                                            $element_array = array(
                                                'bodytype'=>array('label'=>'Body Type'),
                                                'diet'=>array('label'=>'Eating Habit'),
                                                'smoke'=>array('label'=>'Smoking Habit'),
                                            );
                                            echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                        ?>
                                        </div>
                                        <div class="row margin-0 mt_partf">
                                        <?php
                                            $element_array = array(
                                                'drink'=>array('label'=>'Drinking Habit'),
                                                'complexion'=>array('label'=>'Skin Tone'),
                                                'blood_group'=>array(),
                                            );
                                            echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                        ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <!--3rd box of about_me_hobby-->
                            <div role="tabpanel" class="tab-pane mt-4 fade" id="about_me_hobby">
                                <div class="design-process-content pb-5 about_me_hobby">
                                    <div class="row ml-0">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <p class="prf_30 Poppins-Semi-Bold f-17 color-d">About Me &amp; Hobby</p>
                                        </div>
                                    </div>
                                    <hr class="mt-2">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <a href='javascript:;' onclick="edit_show('about_me_hobby');" role="button" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right"><i class="fas fa-pen Edit_pen"></i>Edit</a>
                                        </div>
                                    </div>
                                    <div class="main_box_preference">
                                        <div class="row margin-0 mt-0">
                                        <?php
                                            $element_array = array(
                                                'profile_text'=>array('is_single'=>'yes','label'=>'About Us'),
											);
                                            echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                        ?>
                                        </div>
                                        <div class="row margin-0 mt_partf">
                                            <?php
                                            $element_array = array(
                                                'hobby'=>array('is_single'=>'yes','label'=>'Hobby'),
											);
                                            echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                        ?>
                                        </div>
                                        <div class="row margin-0 mt_partf">
                                            <?php
                                            $element_array = array(
                                                'birthplace'=>array('label'=>'Birth Place'),
												'birthtime'=>array('label'=>'Birth Time','type'=>'time'),
                                                'profileby'=>array('label'=>'Created By'),                                            );
                                            echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                        ?>
                                        </div>
                                        <div class="row margin-0 mt_partf">
                                            <?php
                                            $element_array = array(
                                                'reference'=>array('label'=>'Referenced By'),
                                            );
                                            echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                        ?>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <!--4th box of religious_info view-->
                            <div role="tabpanel" class="tab-pane mt-4 fade" id="religious_info">
                                <div class="design-process-content pb-5 religious_info">
                                    <div class="row ml-0">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <p class="prf_30 Poppins-Semi-Bold f-17 color-d">Religious Information</p>
                                        </div>
                                    </div>
                                    <hr class="mt-2">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <a href='javascript:;' onclick="edit_show('religious_info');" role="button" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right"><i class="fas fa-pen Edit_pen"></i>Edit</a>
                                        </div>
                                    </div>
                                    <div class="main_box_preference">
                                        <div class="row margin-0 mt-0">
                                            <?php
                                                $element_array = array(
                                                    'religion_name'=>array('label'=>'Religion'),
                                                    'caste_name'=>array('label'=>'Caste'),
                                                    'subcaste'=>array('label'=>'Subcaste'),
                                                );
                                                echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                            ?>
                                        </div>
                                        <div class="row margin-0 mt_partf">
                                            <?php
                                            $element_array = array(
                                                'manglik'=>array('label'=>'Manglik'),
                                                'star'=>array('label'=>'Star','type'=>'relation','table_name'=>'star','disp_column_name'=>'star_name'),
                                                'horoscope'=>array('label'=>'Horoscope'),
                                            );
                                            echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                            ?>
                                        </div>
                                        <div class="row margin-0 mt_partf">
                                            <?php
                                            $element_array = array(
                                                'gothra'=>array('label'=>'Gothra'),
									            'moonsign'=>array('label'=>'Moonsign','type'=>'relation','table_name'=>'moonsign','disp_column_name'=>'moonsign_name'),
                                            );
                                            echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--5th box of location_info view-->
                            <div role="tabpanel" class="tab-pane mt-4 fade" id="location_info">
                                <div class="design-process-content pb-5 location_info">
                                    <div class="row ml-0">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <p class="prf_30 Poppins-Semi-Bold f-17 color-d">Location Information</p>
                                        </div>
                                    </div>
                                    <hr class="mt-2">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <a href='javascript:;' onclick="edit_show('location_info');" role="button" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right"><i class="fas fa-pen Edit_pen"></i>Edit</a>
                                        </div>
                                    </div>
                                    <div class="main_box_preference">
                                        <div class="row margin-0 mt-0">
                                            <?php
                                                if(isset($this->common_model->is_demo_mode) && $this->common_model->is_demo_mode == 1)
                                                {
                                                    $member_data['city_name'] = $this->common_model->disable_in_demo_text;
                                                    $member_data['address'] = $this->common_model->disable_in_demo_text;
                                                    $member_data['mobile'] = $this->common_model->disable_in_demo_text;
                                                    $member_data['phone'] = $this->common_model->disable_in_demo_text;
                                                }
                                                $element_array = array(
                                                    'country_name'=>array('label'=>'Country'),
                                                    'state_name'=>array('label'=>'State'),
                                                    'city_name'=>array('label'=>'City'),
                                                );
                                                echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                            ?>
                                        </div>
                                        <div class="row margin-0 mt_partf">
                                            <?php
                                            $element_array = array(
                                                'address'=>array('label'=>'Address'),
                                                'mobile'=>array('label'=>'Mobile','fa_icone'=>'fa fa-phone'),
                                                'phone'=>array('label'=>'Phone','fa_icone'=>'fa fa-phone'),
                                            );
                                            echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                            ?>
                                        </div>
                                        <div class="row margin-0 mt_partf">
                                            <?php
                                            $element_array = array(
                                                'time_to_call'=>array('label'=>'Time To Call'),
									            'residence'=>array('label'=>'Residence'),
                                            );
                                            echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--6th box of education_info view-->
                            <div role="tabpanel" class="tab-pane mt-4 fade" id="education_info">
                                <div class="design-process-content pb-5 education_info">
                                    <div class="row ml-0">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <p class="prf_30 Poppins-Semi-Bold f-17 color-d">Education / Occupation Information</p>
                                        </div>
                                    </div>
                                    <hr class="mt-2">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <a href='javascript:;' onclick="edit_show('education_info');" role="button" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right"><i class="fas fa-pen Edit_pen"></i>Edit</a>
                                        </div>
                                    </div>
                                    <div class="main_box_preference">
                                        <div class="row margin-0 mt-0">
                                            <?php
                                                $element_array = array(
                                                    'education_detail'=>array('label'=>'Education','type'=>'relation','table_name'=>'education_detail','disp_column_name'=>'education_name'),
                                                    'employee_in'=>array(),
                                                    'income'=>array('label'=>'Annual Income'),
                                                );
                                                echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                            ?>
                                        </div>
                                        <div class="row margin-0 mt_partf">
                                            <?php
                                            $element_array = array(
                                                'occupation_name'=>array('label'=>'Occupation'),
									            'designation'=>array('label'=>'Designation','type'=>'relation','table_name'=>'designation','disp_column_name'=>'designation_name'),
                                            );
                                            echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--7th box of family_info view-->
                            <div role="tabpanel" class="tab-pane mt-4 fade" id="family_info">
                                <div class="design-process-content pb-5 family_info">
                                    <div class="row ml-0">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <p class="prf_30 Poppins-Semi-Bold f-17 color-d">Family Details</p>
                                        </div>
                                    </div>
                                    <hr class="mt-2">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <a href='javascript:;' onclick="edit_show('family_info');" role="button" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right"><i class="fas fa-pen Edit_pen"></i>Edit</a>
                                        </div>
                                    </div>
                                    <div class="main_box_preference">
                                        <div class="row margin-0 mt-0">
                                            <?php
                                                $element_array = array(
                                                    'family_type'=>array('label'=>'Family Type'),
                                                    'father_name'=>array('label'=>'Father Name'),
                                                    'father_occupation'=>array('label'=>"Father Occupation"),
                                                );
                                                echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                            ?>
                                        </div>
                                        <div class="row margin-0 mt_partf">
                                            <?php
                                            $element_array = array(
                                                'mother_name'=>array('label'=>"Mother Name"),
                                                'mother_occupation'=>array('label'=>"Mother Occupation"),
                                                'family_status'=>array('label'=>'Family Status'),
                                            );
                                            echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                            ?>
                                        </div>
                                        <div class="row margin-0 mt_partf">
                                            <?php
                                            $element_array = array(
                                                'no_of_brothers'=>array('label'=>'No Of Brothers'),
                                                'no_of_married_brother'=>array('label'=>'No Of Married Brother'),
                                                'no_of_sisters'=>array('label'=>'No Of Sisters'),
                                            );
                                            echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                            ?>
                                        </div>
                                        <div class="row margin-0 mt_partf">
                                            <?php
                                            $element_array = array(
                                                'no_of_married_sister'=>array('label'=>'No Of Married Sister'),);
                                            echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                            ?>
                                        </div>
                                        <div class="row margin-0 mt_partf">
                                            <?php
                                            $element_array = array(
									            'family_details'=>array('label'=>'About My Family','is_single'=>'yes','disp_label'=>'yes'),
                                            );
                                            echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--step carousel-->
            <!--horizontal tab start-->
            <div class="horizontab_tab">
                <div class="container-fluid">
                    <div class="row mt-3">
                        <div class="scroller scroller-left-1"><i class="fas fa-caret-left f-16 color-f edit_caret"></i></div>
                        <div class="scroller scroller-right-1"><i class="fas fa-caret-right f-16 color-f edit_caret"></i></div>
                        <div class="wrapper_colors" id="user_basic">
                            <ul class="nav nav-tabs list_colors li1 edit_li" id="myTab">
                                <li class="active a3" id="a1"><a data-toggle="tab" href="#basic_info_tab" class="a2 edit_tab_deactive">Basic Details</a></li>
                    <li class="" id="a2"><a data-toggle="tab" href="#lifestyle_style_tab" class="Poppins-Regular f-14 color-7c a1">Life Style Details</a></li>
                                <li><a data-toggle="tab" href="#about_me_hobby" class="Poppins-Regular f-14 color-7c">About Me & Hobby</a></li>
                                <li><a data-toggle="tab" href="#religious_info" class="Poppins-Regular f-14 color-7c">Religious Information</a></li>
                                <li><a data-toggle="tab" href="#location_info"  class="Poppins-Regular f-14 color-7c">Location Information</a></li>
                            <li><a data-toggle="tab" href="#education_info" class="Poppins-Regular f-14 color-7c">Education / Occupation Information</a></li>
                                <li><a data-toggle="tab" href="#family_info" class="Poppins-Regular f-14 color-7c">Family Details</a></li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="scroller scroller-left f-16 color-f edit_caret">
                        <i class="fas fa-caret-left"></i>
                    </div>
                    <div class="scroller scroller-right"><i class="fas fa-caret-right f-16 color-f edit_caret"></i></div>
                </div>
            </div>
            <!--horizontal tab End-->
            <!--partner preference Start-->
            <!--partner preference edit Start-->
            <div class="tab-content">
                <div role="tabpanel" class="part_edit_div tab-pane mt-4 fade" id="part_prefrence_edit">
                    <div class="design-process-content pb-5">
                        <div id="reponse_ne_lft_pan_list7"></div>
                        <form id="ne_lft_pan_list7" name="ne_lft_pan_list7" action="<?php echo $base_url; ?>my-profile/save-profile/part-basic-detail" onSubmit="return validat_function('ne_lft_pan_list7')" class="margin-top-10 part-basic-detail">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"  class="hash_tocken_id" />
                        <input type="hidden" name="is_post" value="1" />
                        <input type="hidden" name="base_url" value="<?php echo $base_url; ?>" />
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <a href="javascript:;" onclick="return view_show('part_prefrence');" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right">Cancel</a>                                
                                <button onClick="return validat_function('ne_lft_pan_list7')" class="edit_pro-1 edit_pro_submit Poppins-Semi-Bold f-15 color-31 pull-right" style="background-color: transparent;border: none;">Submit</button>
                            </div>
                        </div>
                        <div class="main_box_basic_detail">
                            <div class="">
                                <div class="row margin-0">
                                <?php 
                                $ele_array = array(
                                    'looking_for'=>array('is_required'=>'required','type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('marital_status'),'label'=>'Looking For','is_multiple'=>'yes','display_placeholder'=>'No','class'=>'select2','extra_style'=>'width:100%'),
                                        'part_complexion'=>array('type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('complexion'),'label'=>'Skin Tone','is_multiple'=>'yes','display_placeholder'=>'No','class'=>'select2','extra_style'=>'width:100%'),
                                );
                                echo $this->common_front_model->generate_common_front_form($ele_array,array('enctype'=>'enctype="multipart/form-data"','page_type'=>'edit_profile_multiple'));
                                    $ele_array = array(
                                        
                                        'part_frm_age'=>array('is_required'=>'required','type'=>'dropdown','value_arr'=>$this->common_model->age_rang(),'label'=>"From Age",'class'=>'select2','extra_style'=>'width:100%'),
                                        );
                                        echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile'));
                                    ?>
                                </div>
                            </div>
                            <div class="mt-2">
                                <div class="row mt-4 margin-0">
                                <?php 
                                    $ele_array = array(
                                'part_to_age'=>array('is_required'=>'required','type'=>'dropdown','value_arr'=>$this->common_model->age_rang(),'label'=>"To Age",'class'=>'select2','extra_style'=>'width:100%'),
                                        'part_height'=>array('is_required'=>'required','type'=>'dropdown','value_arr'=>$this->common_model->height_list(),'label'=>"From Height",'class'=>'select2','extra_style'=>'width:100%'),
                                        'part_height_to'=>array('is_required'=>'required','type'=>'dropdown','value_arr'=>$this->common_model->height_list(),'label'=>"To Height",'class'=>'select2','extra_style'=>'width:100%'),
                                    );
                                    echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile'));
                                ?>
                                </div>
                            </div>
                            <div class="mt-2">
                                <div class="row mt-3 margin-0">
                                <?php 
                                    $ele_array = array(
                                        'part_mother_tongue'=>array('type'=>'dropdown','is_multiple'=>'yes','display_placeholder'=>'No','class'=>'select2','value_arr'=>$mother_tongue_arr,'label'=>'Mother Tongue','extra_style'=>'width:100%'),
                                    );
                                    echo $this->common_front_model->generate_common_front_form($ele_array,array('enctype'=>'enctype="multipart/form-data"','page_type'=>'edit_profile_multiple'));
                                    $ele_array = array(
                                        
                                        'part_expect'=>array('type'=>'textarea','label'=>'Expectations','extra_style'=>'width:100%')
                                        );
                                        echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile'));
                                    ?>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <!--2nd box of partner lifestyle preference edit-->
                <div role="tabpanel" class="part_edit_div tab-pane mt-4 fade" id="part_lifestyle_prefrence_edit">
                    <div class="design-process-content pb-5">
                        <div id="reponse_ne_lft_pan_list11"></div>
                        <form id="ne_lft_pan_list11" name="ne_lft_pan_list11" action="<?php echo $base_url; ?>my-profile/save-profile/part-basic-detail" onSubmit="return validat_function('ne_lft_pan_list11')" class="margin-top-10 part-basic-detail">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"  class="hash_tocken_id" />
                        <input type="hidden" name="is_post" value="1" />
                        <input type="hidden" name="base_url" value="<?php echo $base_url; ?>" />
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <a href="javascript:;" onclick="return view_show('part_lifestyle_prefrence');" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right">Cancel</a>
                                <button onClick="return validat_function('ne_lft_pan_list11')" class="edit_pro-1 edit_pro_submit Poppins-Semi-Bold f-15 color-31 pull-right" style="background-color: transparent;border: none;">Submit</button>
                            </div>
                        </div>
                        <div class="main_box_basic_detail">
                            <div class="">
                                <div class="row margin-0">
                                <?php 
                                     $ele_array = array(
                                        'part_bodytype'=>array('type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('bodytype'),'label'=>'Body type','is_multiple'=>'yes','display_placeholder'=>'No','class'=>'select2','extra_style'=>'width:100%'),
                                        'part_diet'=>array('type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('diet'),'label'=>'Eating Habit','is_multiple'=>'yes','display_placeholder'=>'No','class'=>'select2','extra_style'=>'width:100%'),
                                        'part_smoke'=>array('type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('smoke'),'label'=>'Smoking Habit','is_multiple'=>'yes','display_placeholder'=>'No','class'=>'select2','extra_style'=>'width:100%'),
                                    );
                                    echo $this->common_front_model->generate_common_front_form($ele_array,array('enctype'=>'enctype="multipart/form-data"','page_type'=>'edit_profile_multiple'));
                                   
                                    ?>
                                </div>
                            </div>
                            <div class="mt-2">
                                <div class="row mt-4 margin-0">
                                <?php 
                                     $ele_array = array(
                                        'part_drink'=>array('type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('drink'),'label'=>'Drinking Habit','is_multiple'=>'yes','display_placeholder'=>'No','class'=>'select2','extra_style'=>'width:100%'),
                                    );
                                    echo $this->common_front_model->generate_common_front_form($ele_array,array('enctype'=>'enctype="multipart/form-data"','page_type'=>'edit_profile_multiple'));
                                    ?>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <!--3rd box of partner religious preference edit -->
                <div role="tabpanel" class="part_edit_div tab-pane mt-4 fade" id="part_religious_prefrence_edit">
                    <div class="design-process-content pb-5">
                        <div id="reponse_ne_lft_pan_list8"></div>
                        <form id="ne_lft_pan_list8" name="ne_lft_pan_list8" action="<?php echo $base_url; ?>my-profile/save-profile/part-religious-detail" onSubmit="return validat_function('ne_lft_pan_list8')" class="margin-top-10 part-religious-detail">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"  class="hash_tocken_id" />
                        <input type="hidden" name="is_post" value="1" />
                        <input type="hidden" name="base_url" value="<?php echo $base_url; ?>" />
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <a href="javascript:;" onclick="return view_show('part_religious_prefrence');" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right">Cancel</a>
                                <button onClick="return validat_function('ne_lft_pan_list8')" class="edit_pro-1 edit_pro_submit Poppins-Semi-Bold f-15 color-31 pull-right" style="background-color: transparent;border: none;">Submit</button>
                            </div>
                        </div>
                        <div class="main_box_basic_detail">
                            <div class="">
                                <div class="row margin-0">
                                <?php 
                                     $ele_array = array(
                                        'part_religion'=>array('is_required'=>'required','type'=>'dropdown','onchange'=>"dropdownChange('part_religion','part_caste','caste_list')",'value_arr'=>$religion_arr,'label'=>'Religion','is_multiple'=>'yes','display_placeholder'=>'No','class'=>'select2','extra_style'=>'width:100%'),
                                        'part_caste'=>array('type'=>'dropdown','relation'=>array('rel_table'=>'caste','key_val'=>'id','key_disp'=>'caste_name','not_load_add'=>'yes','rel_col_name'=>'religion_id','cus_rel_col_val'=>'part_religion'),'label'=>'Caste','is_multiple'=>'yes','display_placeholder'=>'No','class'=>'select2','extra_style'=>'width:100%'),
                                    );
                                    echo $this->common_front_model->generate_common_front_form($ele_array,array('enctype'=>'enctype="multipart/form-data"','page_type'=>'edit_profile_multiple'));
                                    $ele_array = array(
                                       
                                        'part_manglik'=>array('type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('manglik'),'label'=>'Manglik','extra_style'=>'width:100%'),
                                    );
                                    echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile'));
                                ?>
                                </div>
                            </div>
                            <div class="mt-2">
                                <div class="row mt-4 margin-0">
                                <?php 
                                    $ele_array = array(
                                        'part_star'=>array('type'=>'dropdown','value_arr'=>$this->common_model->dropdown_array_table('star'),'label'=>'Star','is_multiple'=>'yes','display_placeholder'=>'No','class'=>'select2','extra_style'=>'width:100%')
                                    );
                                    echo $this->common_front_model->generate_common_front_form($ele_array,array('enctype'=>'enctype="multipart/form-data"','page_type'=>'edit_profile_multiple'));
                                ?>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <!--4th box of partner location preference-->
                <div role="tabpanel" class="part_edit_div tab-pane mt-4 fade" id="part_location_prefrence_edit">
                    <div class="design-process-content pb-5">
                        <div id="reponse_ne_lft_pan_list9"></div>	
                        <form id="ne_lft_pan_list9" name="ne_lft_pan_list9" action="<?php echo $base_url; ?>my-profile/save-profile/part-location-detail" onSubmit="return validat_function('ne_lft_pan_list9')" class="margin-top-10 part-location-detail">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"  class="hash_tocken_id" />
                        <input type="hidden" name="is_post" value="1" />
                        <input type="hidden" name="base_url" value="<?php echo $base_url; ?>" />
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <a href="javascript:;" onclick="return view_show('part_location_prefrence');" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right">Cancel</a>
                                <button onClick="return validat_function('ne_lft_pan_list9')" class="edit_pro-1 edit_pro_submit Poppins-Semi-Bold f-15 color-31 pull-right" style="background-color: transparent;border: none;">Submit</button>
                            </div>
                        </div>
                        <div class="main_box_basic_detail">
                            <div class="">
                                <div class="row margin-0">
                                <?php
                                    $state_load_special = 'yes';
                                    $city_load_special = 'yes';
                                    if(isset($member_data['part_country_living']) && $member_data['part_country_living'] !=''){
                                        $state_load_special = 'no';
                                    }
                                    if(isset($member_data['part_state']) && $member_data['part_state'] !=''){
                                        $city_load_special = 'no';
                                    }
                                    $ele_array = array(
                                        'part_country_living'=>array('type'=>'dropdown','value_arr'=>$country_arr,'label'=>'Country','onchange'=>"dropdownChange_mul_new('country_list_update','state_list_update','state_list')",'is_multiple'=>'yes','display_placeholder'=>'No','class'=>'select2 country_list_update','extra_style'=>'width:100%'),
										'part_state'=>array('type'=>'dropdown','relation'=>array('rel_table'=>'state_master','key_val'=>'id','key_disp'=>'state_name','not_load_add'=>'yes','cus_rel_col_name'=>'country_id','cus_rel_col_val'=>'part_country_living','not_load_add_special'=>$state_load_special),'label'=>'State','onchange'=>"dropdownChange_mul_new('state_list_update','city_list_update','city_list')",'is_multiple'=>'yes','display_placeholder'=>'No','label'=>'State','class'=>'select2 state_list_update'),
										'part_city'=>array('type'=>'dropdown','relation'=>array('rel_table'=>'city_master','key_val'=>'id','key_disp'=>'city_name','not_load_add'=>'yes','cus_rel_col_name'=>'state_id','cus_rel_col_val'=>'part_state','not_load_add_special'=>$city_load_special),'label'=>'City','class'=>'city_list_update select2','is_multiple'=>'yes','display_placeholder'=>'No'),
                                    );
                                    echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile_multiple'));
                                ?>
                                </div>
                            </div>
                            <div class="mt-2">
                                <div class="row mt-4 margin-0">
                                <?php
                                    $ele_array = array(
                                        'part_resi_status'=>array('type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('residence'),'label'=>'Residence','is_multiple'=>'yes','display_placeholder'=>'No','class'=>'select2','extra_style'=>'width:100%')
                                    );
                                    echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile_multiple'));
                                ?>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <!--5th box of partner education preference-->
                <div role="tabpanel" class="part_edit_div tab-pane mt-4 fade" id="part_education_prefrence_edit">
                    <div class="design-process-content pb-5">
                        <div id="reponse_ne_lft_pan_list10"></div>	
                        <form id="ne_lft_pan_list10" name="ne_lft_pan_list10" action="<?php echo $base_url; ?>my-profile/save-profile/part-education-detail" onSubmit="return validat_function('ne_lft_pan_list10')" class="margin-top-10 part-education-detail">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"  class="hash_tocken_id" />
                        <input type="hidden" name="is_post" value="1" />
                        <input type="hidden" name="base_url" value="<?php echo $base_url; ?>" />
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <a href="javascript:;" onclick="return view_show('part_education_prefrence');"  class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right">Cancel</a>
                                <button onClick="return validat_function('ne_lft_pan_list10')" class="edit_pro-1 edit_pro_submit Poppins-Semi-Bold f-15 color-31 pull-right" style="background-color: transparent;border: none;">Submit</button>
                            </div>
                        </div>
                        <div class="main_box_basic_detail">
                            <div class="">
                                <div class="row margin-0">
                                <?php 
                                    $ele_array = array(
                                        'part_education'=>array('type'=>'dropdown','is_multiple'=>'yes','display_placeholder'=>'No','class'=>'select2','value_arr'=>$education_name_arr,'label'=>'Education','extra_style'=>'width:100%'),
                                        'part_employee_in'=>array('is_multiple'=>'yes','display_placeholder'=>'No','class'=>'select2','type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('employee_in'),'label'=>'Employed In','extra_style'=>'width:100%'),
                                        'part_occupation'=>array('type'=>'dropdown','is_multiple'=>'yes','display_placeholder'=>'No','class'=>'select2','value_arr'=>$occupation_arr,'label'=>'Occupation','class'=>'select2','extra_style'=>'width:100%'),
                                    );
                                    echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile_multiple'));
                                ?>
                                </div>
                            </div>
                            <div class="mt-2">
                                <div class="row mt-4 margin-0">
                                <?php 
                                 $ele_array = array(
                                    'part_designation'=>array('type'=>'dropdown','is_multiple'=>'yes','display_placeholder'=>'No','class'=>'select2','value_arr'=>$designation_arr,'label'=>'Designation','extra_style'=>'width:100%'),
                                );
                                echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile_multiple'));
                                    $ele_array = array(
                                       
                                        'part_income'=>array('type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('income'),'label'=>'Annual Income','extra_style'=>'width:100%')
                                    );
                                    echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile'));
                                ?>
                                </div>
                            </div>
                            <div class="mt-2">
                                <div class="row mt-3 margin-0">
                                   
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--end 2nd tab of partner preference edit-->
            <!-- start partner preference view-->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane mt-4 fade in active" id="part_prefrence">
                    <div class="design-process-content pb-5 part_prefrence">
                        <div class="row ml-0">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <p class="prf_30 Poppins-Semi-Bold f-17 color-d">Partner Basic Preferences</p>
                            </div>
                        </div>
                        <hr class="mt-2">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <a href="javascript:;" onclick="return edit_show('part_prefrence');" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right"><i class="fas fa-pen Edit_pen"></i>Edit</a>
                            </div>
                        </div>
                        <div class="main_box_preference">
                            <div class="row margin-0 mt-0">
                                <?php
                                    $element_array = array(
                                        'looking_for'=>array('label'=>'Looking For','class_width'=>' col-lg-6 col-md-6 col-sm-12 col-xs-12','label_width'=>'3','val_width'=>9),
                                        'part_complexion'=>array('label'=>'Partner Skin Tone','class_width'=>' col-lg-6 col-md-6 col-sm-12 col-xs-12','label_width'=>'3','val_width'=>9),
                                        'part_frm_age'=>array('label'=>"Age Preference",'post_filed_concate'=>' to ','post_filed'=>'part_to_age','post_filed_val_after'=>' Years'),
                                    );
                                    echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                ?>
                            </div>
                            <div class="row margin-0 mt_partf">
                                <?php
                                    $element_array = array(
                                        'part_height'=>array('label'=>"Height",'call_back'=>'display_height','post_filed_concate'=>' to ','post_filed'=>'part_height_to','post_filed_call_back'=>'display_height'),
                                        'part_mother_tongue'=>array('label'=>'Mother Tongue','type'=>'relation','table_name'=>'mothertongue','disp_column_name'=>'mtongue_name','class_width'=>' col-lg-10 col-md-10 col-sm-12 col-xs-12','label_width'=>'2','val_width'=>10,'disp_label'=>'yes'),
                                        'part_expect'=>array('label'=>'Expectations','class_width'=>' col-lg-6 col-md-6 col-sm-12 col-xs-12','label_width'=>'3','val_width'=>9)
                                    );
                                    echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!--2nd box of partner preference-->
                <div role="tabpanel" class="tab-pane mt-4 fade" id="part_lifestyle_prefrence">
                    <div class="design-process-content pb-5 part_lifestyle_prefrence">
                        <div class="row ml-0">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <p class="prf_30 Poppins-Semi-Bold f-17 color-d">Partner Life Style Preferences</p>
                            </div>
                        </div>
                        <hr class="mt-2">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <a href="javascript:;" onclick="return edit_show('part_lifestyle_prefrence');" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right"><i class="fas fa-pen Edit_pen"></i>Edit</a>
                            </div>
                        </div>
                        <div class="main_box_preference">
                            <div class="row margin-0 mt-0">
                            <?php
								$element_array = array(
                                    'part_bodytype'=>array('label'=>'Body Type','class_width'=>' col-lg-6 col-md-6 col-sm-12 col-xs-12','label_width'=>'3','val_width'=>9),
									'part_diet'=>array('label'=>'Eating Habit','class_width'=>' col-lg-6 col-md-6 col-sm-12 col-xs-12','label_width'=>'3','val_width'=>9),
                                    'part_smoke'=>array('label'=>'Smoking'),
								);
								echo $this->common_front_model->view_detail_common($element_array,$member_data);
							?>
                            </div>
                            <div class="row margin-0 mt_partf">
                            <?php
								$element_array = array(
                                    'part_drink'=>array('label'=>'Drinking','class_width'=>' col-lg-6 col-md-6 col-sm-12 col-xs-12','label_width'=>'3','val_width'=>9),
								);
								echo $this->common_front_model->view_detail_common($element_array,$member_data);
							?>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane mt-4 fade" id="part_religious_prefrence">
                    <div class="design-process-content pb-5 part_religious_prefrence">
                        <div class="row ml-0">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <p class="prf_30 Poppins-Semi-Bold f-17 color-d">Partner Religious Preferences</p>
                            </div>
                        </div>
                        <hr class="mt-2">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <a href="javascript:;" onclick="return edit_show('part_religious_prefrence');" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right"><i class="fas fa-pen Edit_pen"></i>Edit</a>
                            </div>
                        </div>
                        <div class="main_box_preference">
                            <div class="row margin-0 mt-0">
                            <?php
								$element_array = array(
									'part_religion'=>array('label'=>'Religion','type'=>'relation','table_name'=>'religion','disp_column_name'=>'religion_name'),
									'part_caste'=>array('label'=>'Caste','type'=>'relation','table_name'=>'caste','disp_column_name'=>'caste_name'),
									'part_manglik'=>array('label'=>'Manglik'),
								);
								echo $this->common_front_model->view_detail_common($element_array,$member_data);
							?>
                            </div>
                            <div class="row margin-0 mt_partf">
                            <?php
								$element_array = array(
                                    'part_star'=>array('label'=>'Star','type'=>'relation','table_name'=>'star','disp_column_name'=>'star_name'),
								);
								echo $this->common_front_model->view_detail_common($element_array,$member_data);
							?>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane mt-4 fade" id="part_location_prefrence">
                    <div class="design-process-content pb-5 part_location_prefrence">
                        <div class="row ml-0">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <p class="prf_30 Poppins-Semi-Bold f-17 color-d">Partner Location Preferences</p>
                            </div>
                        </div>
                        <hr class="mt-2">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <a href="javascript:;" onclick="return edit_show('part_location_prefrence');" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right"><i class="fas fa-pen Edit_pen"></i>Edit</a>
                            </div>
                        </div>
                        <div class="main_box_preference">
                            <div class="row margin-0 mt-0">
                            <?php 
                                $element_array = array(
									'part_country_living'=>array('label'=>'Country','type'=>'relation','table_name'=>'country_master','disp_column_name'=>'country_name'),
									'part_state'=>array('label'=>'State','type'=>'relation','table_name'=>'state_master','disp_column_name'=>'state_name'),
									'part_city'=>array('label'=>'City','type'=>'relation','table_name'=>'city_master','disp_column_name'=>'city_name'),
									
								);
								echo $this->common_front_model->view_detail_common($element_array,$member_data);
							?>
                            </div>
                            <div class="row margin-0 mt_partf">
                            <?php
								$element_array = array(
                                    'part_resi_status'=>array('label'=>'Residence'),
								);
								echo $this->common_front_model->view_detail_common($element_array,$member_data);
							?>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane mt-4 fade" id="part_education_prefrence">
                    <div class="design-process-content pb-5 part_education_prefrence">
                        <div class="row ml-0">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <p class="prf_30 Poppins-Semi-Bold f-17 color-d">Partner Education / Occupation Preferences</p>
                            </div>
                        </div>
                        <hr class="mt-2">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <a href="javascript:;" onclick="return edit_show('part_education_prefrence');" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right"><i class="fas fa-pen Edit_pen"></i>Edit</a>
                            </div>
                        </div>
                        <div class="main_box_preference">
                            <div class="row margin-0 mt-0">
                            <?php
								$element_array = array(
									'part_education'=>array('label'=>'Education','type'=>'relation','table_name'=>'education_detail','disp_column_name'=>'education_name','label_width'=>'1','val_width'=>11,'class_width'=>' col-lg-12 col-md-12 col-sm-12 col-xs-12',),
									'part_employee_in'=>array('label'=>'Employed in'),
									'part_occupation'=>array('label'=>'Occupation','type'=>'relation','table_name'=>'occupation','disp_column_name'=>'occupation_name'),
								);
								echo $this->common_front_model->view_detail_common($element_array,$member_data);
							?>
                            </div>
                            <div class="row margin-0 mt_partf">
                            <?php
								$element_array = array(
                                    'part_designation'=>array('label'=>'Designation','type'=>'relation','table_name'=>'designation','disp_column_name'=>'designation_name'),
									'part_income'=>array('label'=>'Annual Income')
								);
								echo $this->common_front_model->view_detail_common($element_array,$member_data);
							?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end partner preference view-->
            <!--End Preference-->
            <!--partner preference horizontal tab End-->
            <div class="horizontab_tab">
                <div class="container-fluid">
                    <div class="row mt-3">
                        <div class="scroller scroller-left-2"><i class="fas fa-caret-left f-16 color-f edit_caret"></i></div>
                        <div class="scroller scroller-right-2"><i class="fas fa-caret-right f-16 color-f edit_caret"></i></div>
                        <div class="wrapper_colors" id="partner">
                            <ul class="nav nav-tabs list_colors li2 edit_li" id="myTab_9">
                                <li class="active b3" id="b1"><a data-toggle="tab" href="#part_prefrence" class="b2 edit_tab_deactive">Basic Preferences</a></li>
                                <li class="" ><a data-toggle="tab" href="#part_lifestyle_prefrence" class="Poppins-Regular f-14 color-7c b1">Life Style Preferences</a></li>
                                <li class="" ><a data-toggle="tab" href="#part_religious_prefrence" class="Poppins-Regular f-14 color-7c b1">Religious Preferences</a></li>
                                <li><a data-toggle="tab" href="#part_location_prefrence" class="Poppins-Regular f-14 color-7c">Location Preferences</a></li>
                                <li><a data-toggle="tab" href="#part_education_prefrence" class="Poppins-Regular f-14 color-7c">Education / Occupation Preferences</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="scroller scroller-left f-16 color-f edit_caret">
                        <i class="fas fa-caret-left"></i>
                    </div>
                    <div class="scroller scroller-right"><i class="fas fa-caret-right f-16 color-f edit_caret"></i></div>
                </div>
            </div>
            <!--partner preference horizontal tab End-->
        </div>
        
        <!--for mobile Start-->
        <div class="edit_for_mobile_devices hidden-lg hidden-md col-sm-12 col-xs-12 padding-0">
            <!--collapse start-->
            <?php include_once('my_profile_sidebar_mob.php');?>
            <!--collapse end-->
            <!--Accordion Start-->
            <div class="col-md-12 col-xs-12 padding-0">
                <div class="add-input new-accordion">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default mt-4" id="mob_basic_info_tab">
                            <div class="panel-heading">
                                <h4 data-toggle="collapse" data-parent="#accordion" data-target="#mob_basic_info_tab_col" class="panel-title">
                                    <i class="fa fa-plus pull-right"></i>
									
                                    <a href="javascript:void(0)" class="hover-l">Basic Details</a>
                                </h4>
                            </div>
                           <div id="mob_basic_info_tab_col" class="panel-collapse collapse in">
                                <div class="">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <a href='javascript:;' onclick="mob_edit_show('mob_basic_info_tab');" role="button" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right"><i class="fas fa-pen Edit_pen"></i>Edit</a>
                                        </div>
                                    </div>
                                    <div class="main_box_preference">
                                    <div class="row margin-0 mt-0">
                                            <?php
                                                $element_array = array(
                                                    'username'=>array('label'=>'Name'),
                                                    'marital_status'=>array(),
                                                    'total_children'=>array(),
                                                );
                                                echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                            ?>
                                        </div>
                                        <div class="row margin-0 mt_partf">
                                            <?php
                                                    $element_array = array(
                                                        'status_children'=>array(),
                                                        'mtongue_name'=>array('label'=>'Mother Tongue'),
                                                        'languages_known'=>array('type'=>'relation','table_name'=>'mothertongue','disp_column_name'=>'mtongue_name'),
                                                        
                                                    );
                                                    echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                                ?>
                                        </div>
                                        <div class="row margin-0 mt_partf">
                                        <?php
                                                $element_array = array(
                                                   
                                                    'height'=>array('call_back'=>'display_height'),
                                                    'weight'=>array('post_filed'=>'KG','post_filed_val'=>'Kg'),
                                                    'birthdate'=>array('call_back'=>'birthdate_disp')
                                                );
                                                echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default" id="mob_basic_info_tab_edit" style="display:none;">
                            <div class="panel-heading">
                                <h4 data-toggle="collapse" data-parent="#accordion" data-target="#mob_basic_info_tab_edit_col" class="panel-title ">
                                    <i class="fa fa-plus pull-right"></i>
                                    <a href="javascript:void(0)" class="hover-l">Basic Details</a>
                                </h4>
                            </div>
                            <div id="mob_basic_info_tab_edit_col" class="panel-collapse collapse">
                                <div class="">
                                <form id="mob_ne_lft_pan_list1" class=" basic-detail" name="mob_ne_lft_pan_list1" action="<?php echo $base_url; ?>my-profile/save-profile/basic-detail" onSubmit="return validat_function_frm1('mob_ne_lft_pan_list1')">
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"  class="hash_tocken_id" />
                                    <input type="hidden" name="is_post" value="1" />
                                    <input type="hidden" name="base_url" value="<?php echo $base_url; ?>" />
                                    
                                    <div id="reponse_mob_ne_lft_pan_list1"></div>
                                    
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <a href="javascript:;" onClick="return mob_view_show('mob_basic_info_tab');" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right">Cancel</a>
                                    	</div>
                                    </div>
                                    <div class="main_box_basic_detail">
                                        <div class="">
                                            <div class="row margin-0">
                                            <?php
                                                $member_id = $this->common_front_model->get_session_data('id');
                                                if(isset($member_id) && $member_id != '' )
                                                {
                                                    $row_data = $this->common_model->get_count_data_manual('register',array('id'=>$member_id,'is_deleted'=>'No'),1);
                                                $this->common_front_model->edit_row_data = $row_data;
                                                $this->common_model->edit_row_data = $row_data;
                                                $this->common_model->mode= 'edit';
                                                $this->common_front_model->mode= 'edit';
                                                $mother_tongue_arr = $this->common_model->dropdown_array_table('mothertongue');
                                                $religion_arr = $this->common_model->dropdown_array_table('religion');
                                                $education_name_arr = $this->common_model->dropdown_array_table('education_detail');
                                                $occupation_arr = $this->common_model->dropdown_array_table('occupation');
                                                $designation_arr = $this->common_model->dropdown_array_table('designation');
                                                $country_arr = $this->common_model->dropdown_array_table('country_master');
                                                $height = $this->common_model->height_list();
                                                $weight = $this->common_model->weight_list();
                                                
                                                $mobile = $row_data['mobile'];
                                                $birth_date = $row_data['birthdate'];
                                                if($mobile !='')
                                                {
                                                    $mobile_arr = explode('-',$mobile);
                                                    if(isset($mobile_arr) && count($mobile_arr) == 2 )
                                                    {
                                                        $current_count_code = $mobile_arr[0];
                                                        $mobile_val = $mobile_arr[1];
                                                    }
                                                    else
                                                    {
                                                        $mobile_val = $mobile_arr[0];
                                                    }
                                                }
                                                
                                                $birth_ddr_str = $this->common_model->birth_date_picker($birth_date);
                                            //     $birth_date_str = '<div class="col-md-4 col-sx-12 col-sm-4" >
                                            //     <h5 class="color-profile Poppins-Regular">Birthdate</h5>
                                            //     <input type="text" class="form-control w-75" id="datepicker-example22" placeholder="Birth Date:">
                                            // </div>';
                                            $birth_date_str = '<div class="col-md-12 col-sx-12 col-sm-12" >
                                            <h5 class="color-profile Poppins-Regular">Birthdate</h5>
                                           '.$birth_ddr_str.'
                                       </div>';
                                                }
                                                $ele_array = array(
                                                'firstname'=>array('is_required'=>'required','label'=>'First Name','class'=>'form-control h-34'),
                                                'lastname'=>array('is_required'=>'required','label'=>'Last Name','class'=>'form-control h-34'),
                                                'marital_status'=>array('is_required'=>'required','class'=>'form-control select-cust w-75','type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('marital_status'),'value'=>'Unmarried','onchange'=>'display_total_childern()'),
                                            );
                                            echo $this->common_front_model->generate_common_front_form($ele_array,array('enctype'=>'enctype="multipart/form-data"','page_type'=>'edit_profile'));

                                            ?>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <div class="row mt-4 margin-0">
                                                <?php 
                                                $ele_array = array(
                                                    'total_children'=>array('is_required'=>'required','class'=>'form-control select-cust w-75','type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('total_children'),'value_curr'=>0,'extra'=>'disabled','onchange'=>'display_childern_status()'),
                                                    'status_children'=>array('is_required'=>'required','class'=>'form-control select-cust w-75','type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('status_children'),'extra'=>'disabled'),
                                                    'mother_tongue'=>array('is_required'=>'required','type'=>'dropdown','class'=>'form-control select-cust w-75 select2','value_arr'=>$mother_tongue_arr,'label'=>'Mother Tongue','extra_style'=>'width:100%'),
                                                   
                                                );
                                                echo $this->common_front_model->generate_common_front_form($ele_array,array('enctype'=>'enctype="multipart/form-data"','page_type'=>'edit_profile'));
                                                ?>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <div class="row mt-3 margin-0">
                                            <?php 
                                                $ele_array = array(
                                                'languages_known'=>array('type'=>'dropdown','id'=>'language','is_multiple'=>'yes','display_placeholder'=>'No','class'=>'form-control dashbrd_cstm','value_arr'=>$mother_tongue_arr,'label'=>'Language Known'));
                                                echo $this->common_front_model->generate_common_front_form($ele_array,array('enctype'=>'enctype="multipart/form-data"','page_type'=>'edit_profile_multiple'));
                                                $ele_array = array(
                                                    'height'=>array('is_required'=>'required','type'=>'dropdown','class'=>'form-control select-cust w-75 select2','value_arr'=>$height,'label'=>'Height','extra_style'=>'width:100%'),
                                                    'weight'=>array('is_required'=>'required','type'=>'dropdown','class'=>'form-control select-cust w-75 select2','value_arr'=>$weight,'label'=>'Weight','extra_style'=>'width:100%'),
                                                    
                                                );
                                                echo $this->common_front_model->generate_common_front_form($ele_array,array('enctype'=>'enctype="multipart/form-data"','page_type'=>'edit_profile'));
                                                ?>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <div class="row mt-3 margin-0">
                                            <?php 
                                                $ele_array = array(
                                                    'birthdate'=>array('type'=>'manual','code'=>$birth_date_str),
                                                );
                                                echo $this->common_front_model->generate_common_front_form($ele_array,array('enctype'=>'enctype="multipart/form-data"','page_type'=>'edit_profile'));
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="row mt-3 margin-0">
                                                <div class="w-100">
                                                    <button onClick="return validat_function_frm1('mob_ne_lft_pan_list1')" class="edit_accordion_submit_btn Poppins-Semi-Bold f-15 color-f">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--first mob basic deatils tab over-->
                        <!--first mob Life Style Details tab start-->
                        <div class="panel panel-default mt-4" id="mob_lifestyle_style_tab">
                            <div class="panel-heading">
                                <h4 data-toggle="collapse" data-parent="#accordion" data-target="#mob_lifestyle_style_tab_col" class="panel-title ">
                                    <i class="fa fa-plus pull-right"></i>
                                    <a href="javascript:void(0)" class="hover-l">Life Style Details</a>
                                </h4>
                            </div>
                            <div id="mob_lifestyle_style_tab_col" class="panel-collapse collapse">
                                <div class="">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <a href='javascript:;' onclick="mob_edit_show('mob_lifestyle_style_tab');" role="button" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right"><i class="fas fa-pen Edit_pen"></i>Edit</a>
                                        </div>
                                    </div>
                                    <div class="main_box_preference">
                                        <div class="row margin-0 mt-0">
                                        <?php
                                            $element_array = array(
                                                'bodytype'=>array('label'=>'Body Type'),
                                                'diet'=>array('label'=>'Eating Habit'),
                                                'smoke'=>array('label'=>'Smoking Habit'),
                                            );
                                            echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                        ?>
                                        </div>
                                        <div class="row margin-0 mt_partf">
                                        <?php
                                            $element_array = array(
                                                'drink'=>array('label'=>'Drinking Habit'),
                                                'complexion'=>array('label'=>'Skin Tone'),
                                                'blood_group'=>array(),
                                            );
                                            echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                        ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default" id="mob_lifestyle_style_tab_edit" style="display:none;">
                            <div class="panel-heading">
                                <h4 data-toggle="collapse" data-parent="#accordion" data-target="#mob_lifestyle_style_tab_edit_col" class="panel-title ">
                                    <i class="fa fa-plus pull-right"></i>
                                    <a href="javascript:void(0)" class="hover-l">Life Style Details</a>
                                </h4>
                            </div>
                            <div id="mob_lifestyle_style_tab_edit_col" class="panel-collapse collapse">
                                <div class="">
                                    <div id="reponse_mob_ne_lft_pan_list15"></div>	
                                    <form id="mob_ne_lft_pan_list15" name="mob_ne_lft_pan_list15" action="<?php echo $base_url; ?>my-profile/save-profile/life-style-detail" onSubmit="return validat_function('mob_ne_lft_pan_list15')" class="margin-top-10 life-style-detail">
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"  class="hash_tocken_id" />
                                    <input type="hidden" name="is_post" value="1" />
                                    <input type="hidden" name="base_url" value="<?php echo $base_url; ?>" />
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <a href="javascript:;" onclick="return mob_view_show('mob_lifestyle_style_tab');" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right">Cancel</a>
                                        </div>
                                    </div>
                                    <div class="main_box_basic_detail">
                                        <div class="">
                                            <div class="row margin-0">
                                               <?php 
                                               $ele_array = array(
                                                'bodytype'=>array('type'=>'dropdown','display_placeholder'=>'Yes','class'=>'form-control select-cust w-75 select2','value_arr'=>$this->common_model->get_list_ddr('bodytype'),'label'=>'Body Type'),
                                                
                                                'diet'=>array('type'=>'dropdown','display_placeholder'=>'Yes','class'=>'form-control select-cust w-75 select2','value_arr'=>$this->common_model->get_list_ddr('diet'),'label'=>'Eating Habit','extra_style'=>'width:100%'),
                                                
                                                'smoke'=>array('type'=>'dropdown','display_placeholder'=>'Yes','class'=>'form-control select-cust w-75 select2','value_arr'=>$this->common_model->get_list_ddr('smoke'),'label'=>'Smoke Habit'),
                                                
                                                );
                                                echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile'));
                                            ?>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <div class="row mt-4 margin-0">
                                            <?php 
                                            $ele_array = array(
							
                                                'drink'=>array('type'=>'dropdown','display_placeholder'=>'Yes','class'=>'form-control select-cust w-75 select2','value_arr'=>$this->common_model->get_list_ddr('drink'),'label'=>'Drink Habit'),
                                                
                                                'complexion'=>array('type'=>'dropdown','display_placeholder'=>'Yes','class'=>'form-control select-cust w-75 select2','value_arr'=>$this->common_model->get_list_ddr('complexion'),'label'=>'Skin Tone'),
                                                'blood_group'=>array('type'=>'dropdown','display_placeholder'=>'Yes','class'=>'form-control select-cust w-75 select2','value_arr'=>$this->common_model->get_list_ddr('blood_group')));
                                                echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile'));
                                            ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="row mt-3 margin-0">
                                                <div class="w-100">
                                                    <button onClick="return validat_function('mob_ne_lft_pan_list15')" class="edit_accordion_submit_btn Poppins-Semi-Bold f-15 color-f">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--first mob Life Style Details tab end-->
                        <!--first mob About Me & Hobby tab start-->
                        <div class="panel panel-default mt-4" id="mob_about_me_hobby">
                            <div class="panel-heading">
                                <h4 data-toggle="collapse" data-parent="#accordion" data-target="#mob_about_me_hobby_col" class="panel-title ">
                                    <i class="fa fa-plus pull-right"></i>
                                    <a href="javascript:void(0)" class="hover-l">About Me & Hobby</a>
                                </h4>
                            </div>
                            <div id="mob_about_me_hobby_col" class="panel-collapse collapse">
                                <div class="">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <a href='javascript:;' onclick="mob_edit_show('mob_about_me_hobby');" role="button" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right"><i class="fas fa-pen Edit_pen"></i>Edit</a>
                                        </div>
                                    </div>
                                    <div class="main_box_preference">
                                        <div class="row margin-0 mt-0">
                                        <?php
                                            $element_array = array(
                                                'profile_text'=>array('is_single'=>'yes','label'=>'About Us'),
                                                'hobby'=>array('is_single'=>'yes','label'=>'Hobby'),
											);
                                            echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                        ?>
                                        </div>
                                        <div class="row margin-0 mt_partf">
                                            <?php
                                            $element_array = array(
                                                'birthplace'=>array('label'=>'Birth Place'),
												'birthtime'=>array('label'=>'Birth Time','type'=>'time'),
                                                'profileby'=>array('label'=>'Created By'),
                                            );
                                            echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                        ?>
                                        </div>
                                        <div class="row margin-0 mt_partf">
                                            <?php
                                            $element_array = array(
                                                'reference'=>array('label'=>'Referenced By'),
                                            );
                                            echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                        ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default" id="mob_about_me_hobby_edit" style="display:none;">
                            <div class="panel-heading">
                                <h4 data-toggle="collapse" data-parent="#accordion" data-target="#mob_about_me_hobby_edit_col" class="panel-title ">
                                    <i class="fa fa-plus pull-right"></i>
                                    <a href="javascript:void(0)" class="hover-l">About Me & Hobby</a>
                                </h4>
                            </div>
                            <div id="mob_about_me_hobby_edit_col" class="panel-collapse collapse">
                                <div class="">
                                <div id="reponse_mob_ne_lft_pan_list2"></div>
                                <form id="mob_ne_lft_pan_list2" name="mob_ne_lft_pan_list2" action="<?php echo $base_url; ?>my-profile/save-profile/about-me-detail" onSubmit="return validat_function_form2('mob_ne_lft_pan_list2')" class="margin-top-10 about-me-detail">
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"  class="hash_tocken_id" />
                                    <input type="hidden" name="is_post" value="1" />
                                    <input type="hidden" name="base_url" value="<?php echo $base_url; ?>" />
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <a href="javascript:;" onclick="return mob_view_show('mob_about_me_hobby');" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right">Cancel</a>
                                        </div>
                                    </div>
                                    <div class="main_box_basic_detail">
                                        <div class="">
                                            <div class="row margin-0">
                                            <?php
                                            $member_id = $this->common_front_model->get_session_data('id');
                                            if(isset($member_id) && $member_id != '' )
                                            {
                                                $row_data = $this->common_model->get_count_data_manual('register',array('id'=>$member_id,'is_deleted'=>'No'),1);
                                                $this->common_front_model->edit_row_data = $row_data;
                                                $this->common_model->edit_row_data = $row_data;
                                                $this->common_model->mode= 'edit';
                                                $this->common_front_model->mode= 'edit';
                                            }
                                            $ele_array = array(
                                            'profile_text'=>array('type'=>'textarea','label'=>'About Us'),
                                            'hobby'=>array('type'=>'textarea'),
                                            'birthplace'=>array('label'=>'Birth Place','class'=>'form-control h-34'),
                                            );
                                            echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile'));
                                        ?>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <div class="row mt-4 margin-0">
                                            <?php 
                                                 $ele_array = array(
                                                'birthtime'=>array('label'=>'Birth Time','other'=>'type="time"','class'=>'form-control h-34'),
                                                'profileby'=>array('is_required'=>'required','type'=>'dropdown','class'=>'form-control select-cust w-75 select2','value_arr'=>$this->common_model->get_list_ddr('profileby'),'label'=>'Created By'),
                                                'reference'=>array('is_required'=>'required','type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('reference')),
                                                );
                                                echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile'));
                                            ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="row mt-3 margin-0">
                                                <div class="w-100">
                                                    <button onClick="return validat_function_form2('mob_ne_lft_pan_list2')" class="edit_accordion_submit_btn Poppins-Semi-Bold f-15 color-f">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--first mob About Me & Hobby tab end-->
                        <!--first mob Religious Information tab start-->
                        <div class="panel panel-default mt-4" id="mob_religious_info">
                            <div class="panel-heading">
                                <h4 data-toggle="collapse" data-parent="#accordion" data-target="#mob_religious_info_col" class="panel-title ">
                                    <i class="fa fa-plus pull-right"></i>
                                    <a href="javascript:void(0)" class="hover-l">Religious Information</a>
                                </h4>
                            </div>
                            <div id="mob_religious_info_col" class="panel-collapse collapse">
                                <div class="">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <a href='javascript:;' onclick="mob_edit_show('mob_religious_info');" role="button" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right"><i class="fas fa-pen Edit_pen"></i>Edit</a>
                                        </div>
                                    </div>
                                    <div class="main_box_preference">
                                        <div class="row margin-0 mt-0">
                                            <?php
                                                $element_array = array(
                                                    'religion_name'=>array('label'=>'Religion'),
                                                    'caste_name'=>array('label'=>'Caste'),
                                                    'subcaste'=>array('label'=>'Subcaste'),
                                                );
                                                echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                            ?>
                                        </div>
                                        <div class="row margin-0 mt_partf">
                                            <?php
                                            $element_array = array(
                                                'manglik'=>array('label'=>'Manglik'),
                                                'star'=>array('label'=>'Star','type'=>'relation','table_name'=>'star','disp_column_name'=>'star_name'),
                                                'horoscope'=>array('label'=>'Horoscope'),
                                            );
                                            echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                            ?>
                                        </div>
                                        <div class="row margin-0 mt_partf">
                                            <?php
                                            $element_array = array(
                                                'gothra'=>array('label'=>'Gothra'),
									            'moonsign'=>array('label'=>'Moonsign','type'=>'relation','table_name'=>'moonsign','disp_column_name'=>'moonsign_name'),
                                            );
                                            echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default" id="mob_religious_info_edit" style="display:none;">
                            <div class="panel-heading">
                                <h4 data-toggle="collapse" data-parent="#accordion" data-target="#mob_religious_info_edit_col" class="panel-title ">
                                    <i class="fa fa-plus pull-right"></i>
                                    <a href="javascript:void(0)" class="hover-l">Religious Information</a>
                                </h4>
                            </div>
                            <div id="mob_religious_info_edit_col" class="panel-collapse collapse">
                                <div class="">
                                <div id="reponse_mob_ne_lft_pan_list3"></div>
                                <form id="mob_ne_lft_pan_list3" name="mob_ne_lft_pan_list3" action="<?php echo $base_url; ?>my-profile/save-profile/religious-detail" onSubmit="return validat_function('mob_ne_lft_pan_list3')" class=" margin-top-10 religious-detail">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"  class="hash_tocken_id" />
                                <input type="hidden" name="is_post" value="1" />
                                <input type="hidden" name="base_url" value="<?php echo $base_url; ?>" />
								
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <a href="javascript:;" onclick="return mob_view_show('mob_religious_info');" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right">Cancel</a>
                                        </div>
                                    </div>
                                    <div class="main_box_basic_detail">
                                        <div class="">
                                            <div class="row margin-0">
                                            <?php
                                                $member_id = $this->common_front_model->get_session_data('id');
                                                if(isset($member_id) && $member_id != '' )
                                                {
                                                    $row_data = $this->common_model->get_count_data_manual('register',array('id'=>$member_id,'is_deleted'=>'No'),1);
                                                    $this->common_front_model->edit_row_data = $row_data;
                                                    $this->common_model->edit_row_data = $row_data;
                                                    $this->common_model->mode= 'edit';
                                                    $this->common_front_model->mode= 'edit';
                                                }
                                                $ele_array = array(
                                                'religion'=>array('is_required'=>'required','type'=>'dropdown','onchange'=>"dropdownChange('religion','caste','caste_list')",'value_arr'=>$religion_arr),
                                                'caste'=>array('is_required'=>'required','type'=>'dropdown','relation'=>array('rel_table'=>'caste','key_val'=>'id','key_disp'=>'caste_name','rel_col_name'=>'religion_id','not_load_add'=>'yes','not_load_add'=>'yes','cus_rel_col_val'=>'religion')),
                                                'subcaste'=>array('label'=>'Sub Caste','class'=>'form-control h-34'),
                                                );
                                                echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile'));
                                            ?>          
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <div class="row mt-4 margin-0">
                                                <?php 
                                                $ele_array = array(
                                                    'manglik'=>array('type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('manglik'),'extra_style'=>'width:100%'),
                                                    'star'=>array('type'=>'dropdown','class'=>'form-control select-cust w-75 select2','value_arr'=>$this->common_model->dropdown_array_table('star'),'extra_style'=>'width:100%'),
                                                    'horoscope'=>array('type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('horoscope'),'extra_style'=>'width:100%'),
                                                    );
                                                    echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile'));
                                                ?>   
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <div class="row mt-3 margin-0">
                                            <?php 
                                                $ele_array = array(
                                                    'gothra'=>array('label'=>'Gothra','class'=>'form-control h-34'),
                                                    'moonsign'=>array('type'=>'dropdown','class'=>'form-control select-cust w-75 select2','value_arr'=>$this->common_model->dropdown_array_table('moonsign'),'extra_style'=>'width:100%'),
                                                    );
                                                    echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile'));
                                                ?> 
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="row mt-3 margin-0">
                                                <div class="w-100">
                                                    <button onClick="return validat_function('mob_ne_lft_pan_list3')" class="edit_accordion_submit_btn Poppins-Semi-Bold f-15 color-f">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--first mob Religious Information tab end-->
                        <!--first mob Location Information tab start-->
                        <div class="panel panel-default mt-4" id="mob_location_info">
                            <div class="panel-heading">
                                <h4 data-toggle="collapse" data-parent="#accordion" data-target="#mob_location_info_col" class="panel-title ">
                                    <i class="fa fa-plus pull-right"></i>
                                    <a href="javascript:void(0)" class="hover-l">Location Information</a>
                                </h4>
                            </div>
                            <div id="mob_location_info_col" class="panel-collapse collapse">
                                <div class="">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <a href='javascript:;' onclick="mob_edit_show('mob_location_info');" role="button" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right"><i class="fas fa-pen Edit_pen"></i>Edit</a>
                                        </div>
                                    </div>
                                    <div class="main_box_preference">
                                    <div class="row margin-0 mt-0">
                                            <?php
                                                if(isset($this->common_model->is_demo_mode) && $this->common_model->is_demo_mode == 1)
                                                {
                                                    $member_data['city_name'] = $this->common_model->disable_in_demo_text;
                                                    $member_data['address'] = $this->common_model->disable_in_demo_text;
                                                    $member_data['mobile'] = $this->common_model->disable_in_demo_text;
                                                    $member_data['phone'] = $this->common_model->disable_in_demo_text;
                                                }
                                                $element_array = array(
                                                    'country_name'=>array('label'=>'Country'),
                                                    'state_name'=>array('label'=>'State'),
                                                    'city_name'=>array('label'=>'City'),
                                                );
                                                echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                            ?>
                                        </div>
                                        <div class="row margin-0 mt_partf">
                                            <?php
                                            $element_array = array(
                                                'address'=>array('label'=>'Address'),
                                                'mobile'=>array('label'=>'Mobile','fa_icone'=>'fa fa-phone'),
                                                'phone'=>array('label'=>'Phone','fa_icone'=>'fa fa-phone'),
                                            );
                                            echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                            ?>
                                        </div>
                                        <div class="row margin-0 mt_partf">
                                            <?php
                                            $element_array = array(
                                                'time_to_call'=>array('label'=>'Time To Call'),
									            'residence'=>array('label'=>'Residence'),
                                            );
                                            echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default" id="mob_location_info_edit" style="display:none;">
                            <div class="panel-heading">
                                <h4 data-toggle="collapse" data-parent="#accordion" data-target="#mob_location_info_edit_col" class="panel-title ">
                                    <i class="fa fa-plus pull-right"></i>
                                    <a href="javascript:void(0)" class="hover-l">Location Information</a>
                                </h4>
                            </div>
                            <div id="mob_location_info_edit_col" class="panel-collapse collapse">
                                <div class="">
                                <div id="reponse_mob_ne_lft_pan_list4"></div>
								    <form id="mob_ne_lft_pan_list4" name="mob_ne_lft_pan_list4" action="<?php echo $base_url; ?>my-profile/save-profile/residence-detail" onSubmit="return validat_function_res('mob_ne_lft_pan_list4')" class="margin-top-10 residence-detail">
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"  class="hash_tocken_id" />
									<input type="hidden" name="is_post" value="1" />
									<input type="hidden" name="base_url" value="<?php echo $base_url; ?>" />
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <a href="javascript:;" onclick="return mob_view_show('mob_location_info');" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right">Cancel</a>
                                        </div>
                                    </div>
                                    <div class="main_box_basic_detail">
                                        <div class="">
                                            <div class="row margin-0">
                                            <?php		
                                                $mobile_val = '';
                                                $current_count_code = '+91';
                                                $member_id = $this->common_front_model->get_session_data('id');
                                                if(isset($member_id) && $member_id != '' )
                                                {
                                                    $row_data = $this->common_model->get_count_data_manual('register',array('id'=>$member_id,'is_deleted'=>'No'),1);
                                                    $this->common_front_model->edit_row_data = $row_data;
                                                    $this->common_model->edit_row_data = $row_data;
                                                    $this->common_model->mode= 'edit';
                                                    $this->common_front_model->mode= 'edit';
                                                    
                                                    $mobile = $row_data['mobile'];
                                                    if($mobile !='')
                                                    {
                                                        $mobile_arr = explode('-',$mobile);
                                                        if(isset($mobile_arr) && count($mobile_arr) == 2 )
                                                        {
                                                            $current_count_code = $mobile_arr[0];
                                                            $mobile_val = $mobile_arr[1];
                                                        }
                                                        else
                                                        {
                                                            $mobile_val = $mobile_arr[0];
                                                        }
                                                    }
                                                    $where_country_code= array(" ( is_deleted ='No' ) GROUP BY country_code");
                                                    $country_code_arr = $this->common_model->get_count_data_manual('country_master',$where_country_code,2,'country_code,country_name','','','',"");
                                                    $mobile_ddr= '<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 pl0"  style="padding-left:0px">
                                                    <select name="country_code" id="country_code" required class="form-control select-cust w-75 select2" style="width:100%;">
                                                    <option value="">Select Country Code</option>';
                                                    foreach($country_code_arr as $country_code_arr)
                                                    {	
                                                        $select_ed_drp = '';
                                                        if($country_code_arr['country_code'] == $current_count_code)
                                                        {
                                                            $select_ed_drp = 'selected';
                                                        }
                                                        $mobile_ddr.= '<option '.$select_ed_drp.' value='.$country_code_arr['country_code'].'>'.$country_code_arr['country_code'].'</option>';
                                                    }
                                                    $mobile_ddr.='</select>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8  col-sm-12 col-xs-12" style="padding:0px">
                                                    <input type="text" minlength="7" maxlength="13" required name="mobile_num" id="mobile_num" class="form-control h-34" placeholder="Mobile Number" value ="'.$mobile_val.'"  />
                                                    </div>';
                                                    
                                                }	
                                                
                                                $ele_array = array(
                                                'country_id'=>array('is_required'=>'required','type'=>'dropdown','value_arr'=>$country_arr,'label'=>'Country','class'=>'select2 country_id_update','onchange'=>"dropdownChange_new('country_id_update','state_id_update','state_list')",'extra_style'=>'width:100%'),
                                                'state_id'=>array('is_required'=>'required','type'=>'dropdown','relation'=>array('rel_table'=>'state_master','key_val'=>'id','key_disp'=>'state_name','not_load_add'=>'yes','cus_rel_col_name'=>'country_id',),'label'=>'State','class'=>'select2 state_id_update','onchange'=>"dropdownChange_new('state_id_update','city_update','city_list')",'extra_style'=>'width:100%'),
                                                'city'=>array('is_required'=>'required','type'=>'dropdown','relation'=>array('rel_table'=>'city_master','key_val'=>'id','key_disp'=>'city_name','not_load_add'=>'yes','cus_rel_col_name'=>'state_id'),'label'=>'City','class'=>'select2 city_update','extra_style'=>'width:100%'),
                                                );
                                                echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile'));
                                            ?>
                                                
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <div class="row mt-4 margin-0">
                                            <?php
                                            $ele_array = array(
                                            'mobile'=>array('type'=>'manual','code'=>'
                                            <div class="col-md-4 col-sx-12 col-sm-4">
                                            <h5 class="color-profile Poppins-Regular">Mobile <span class="color-d f-16 select2-lbl-span">* </span></h5>
                                                
                                                '.$mobile_ddr.'
                                                <input type="hidden" name="mobile" id="mobile" value="" />
                                                
                                                </div>
                                                <div class="clearfix"></div>'),
                                                'phone'=>array('class'=>'form-control h-34'),
                                                'time_to_call'=>array('class'=>'form-control h-34'),
                                               
                                            );
                                                if(isset($this->common_model->is_demo_mode) && $this->common_model->is_demo_mode == 1 && $row_data['mobile']  !='')
                                                {
                                                    $ele_array['mobile'] = array('type'=>'manual','code'=>'
                                                    <div class="col-md-4 col-sx-12 col-sm-4">
                                                    <h5 class="color-profile Poppins-Regular">Mobile <span class="color-d f-16 select2-lbl-span">* </span></h5>
                                                    <div class="xxl-12 xl-10 s-16 xs-16 m-16 l-10">
                                                    <span><strong>'.$this->common_model->disable_in_demo_text.'</strong></span>
                                                    </div>
                                                    </div>');
                                                }
                                                echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile'));
                                            ?>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <div class="row mt-3 margin-0">
                                            <?php
                                            $ele_array = array(
                                                'residence'=>array('type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('residence'),'extra_style'=>'width:100%')
                                            );
                                            echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile'));
                                            ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="row mt-3 margin-0">
                                                <div class="w-100">
                                                    <button onClick="return validat_function_res('mob_ne_lft_pan_list4')" class="edit_accordion_submit_btn Poppins-Semi-Bold f-15 color-f">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--first mob Location Information tab end-->
                        <!--first mob Education / Occupation Information tab start-->
                        <div class="panel panel-default mt-4" id="mob_education_info">
                            <div class="panel-heading">
                                <h4 data-toggle="collapse" data-parent="#accordion" data-target="#mob_education_info_col" class="panel-title ">
                                    <i class="fa fa-plus pull-right"></i>
                                    <a href="javascript:void(0)" class="hover-l">Education / Occupation Information</a>
                                </h4>
                            </div>
                            <div id="mob_education_info_col" class="panel-collapse collapse">
                                <div class="">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <a href='javascript:;' onclick="mob_edit_show('mob_education_info');" role="button" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right"><i class="fas fa-pen Edit_pen"></i>Edit</a>
                                        </div>
                                    </div>
                                    <div class="main_box_preference">
                                        <div class="row margin-0 mt-0">
                                            <?php
                                                $element_array = array(
                                                    'education_detail'=>array('label'=>'Education','type'=>'relation','table_name'=>'education_detail','disp_column_name'=>'education_name'),
                                                    'employee_in'=>array(),
                                                    'income'=>array('label'=>'Annual Income'),
                                                );
                                                echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                            ?>
                                        </div>
                                        <div class="row margin-0 mt_partf">
                                            <?php
                                            $element_array = array(
                                                'occupation_name'=>array('label'=>'Occupation'),
									            'designation'=>array('label'=>'Designation','type'=>'relation','table_name'=>'designation','disp_column_name'=>'designation_name'),
                                            );
                                            echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default" id="mob_education_info_edit" style="display:none;">
                            <div class="panel-heading">
                                <h4 data-toggle="collapse" data-parent="#accordion" data-target="#mob_education_info_edit_col" class="panel-title ">
                                    <i class="fa fa-plus pull-right"></i>
                                    <a href="javascript:void(0)" class="hover-l">Education / Occupation Information</a>
                                </h4>
                            </div>
                            <div id="mob_education_info_edit_col" class="panel-collapse collapse">
                                <div class="">
                                <div id="reponse_mob_ne_lft_pan_list5"></div>
                                    <form id="mob_ne_lft_pan_list5" name="mob_ne_lft_pan_list5" action="<?php echo $base_url; ?>my-profile/save-profile/education-detail" onSubmit="return validat_function('mob_ne_lft_pan_list5')" class="margin-top-10 education-detail">
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"  class="hash_tocken_id" />
									<input type="hidden" name="is_post" value="1" />
									<input type="hidden" name="base_url" value="<?php echo $base_url; ?>" />
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <a href="javascript:;" onclick="return mob_view_show('mob_education_info');" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right">Cancel</a>
                                        </div>
                                    </div>
                                    <div class="main_box_basic_detail">
                                        <div class="">
                                            <div class="row margin-0">
                                                <?php
                                                    $member_id = $this->common_front_model->get_session_data('id');
                                                    if(isset($member_id) && $member_id != '' )
                                                    {
                                                        $row_data = $this->common_model->get_count_data_manual('register',array('id'=>$member_id,'is_deleted'=>'No'),1);
                                                        $this->common_front_model->edit_row_data = $row_data;
                                                        $this->common_model->edit_row_data = $row_data;
                                                        $this->common_model->mode= 'edit';
                                                        $this->common_front_model->mode= 'edit';
                                                    }
                                                    $ele_array = array(
                                                        'education_detail'=>array('is_required'=>'required','type'=>'dropdown','is_multiple'=>'yes','display_placeholder'=>'No','class'=>'select2','value_arr'=>$education_name_arr,'label'=>'Education','extra_style'=>'width:100%'));
                                                        echo $this->common_front_model->generate_common_front_form($ele_array,array('enctype'=>'enctype="multipart/form-data"','page_type'=>'edit_profile_multiple'));
                                                    $ele_array = array(
                                                    
                                                    'employee_in'=>array('type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('employee_in'),'extra_style'=>'width:100%'),
                                                    'income'=>array('type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('income'),'label'=>'Annual Income','extra_style'=>'width:100%'),
                                                    
                                                    );
                                                    echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile'));
                                                ?>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <div class="row mt-4 margin-0">
                                                <?php 
                                                $ele_array = array(
                                                    'occupation'=>array('is_required'=>'required','type'=>'dropdown','value_arr'=>$occupation_arr,'label'=>'Occupation','class'=>'select2','extra_style'=>'width:100%'),
                                                    'designation'=>array('type'=>'dropdown','class'=>'select2','value_arr'=>$designation_arr,'extra_style'=>'width:100%')
                                                );
                                                echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile'));
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="row mt-3 margin-0">
                                                <div class="w-100">
                                                    <button onClick="return validat_function('mob_ne_lft_pan_list5')" class="edit_accordion_submit_btn Poppins-Semi-Bold f-15 color-f">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--first mob Education / Occupation Information tab end-->
                        <!--first mob Family Details tab start-->
                        <div class="panel panel-default mt-4" id="mob_family_info">
                            <div class="panel-heading">
                                <h4 data-toggle="collapse" data-parent="#accordion" data-target="#mob_family_info_col" class="panel-title ">
                                    <i class="fa fa-plus pull-right"></i>
                                    <a href="javascript:void(0)" class="hover-l">Family Details</a>
                                </h4>
                            </div>
                            <div id="mob_family_info_col" class="panel-collapse collapse">
                                <div class="">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <a href='javascript:;' onclick="mob_edit_show('mob_family_info');" role="button" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right"><i class="fas fa-pen Edit_pen"></i>Edit</a>
                                        </div>
                                    </div>
                                    <div class="main_box_preference">
                                        <div class="row margin-0 mt-0">
                                            <?php
                                                $element_array = array(
                                                    'family_type'=>array('label'=>'Family Type'),
                                                    'father_name'=>array('label'=>'Father Name','class'=>'form-control h-34'),
                                                    'father_occupation'=>array('label'=>"Father Occupation",'class'=>'form-control h-34'),
                                                );
                                                echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                            ?>
                                        </div>
                                        <div class="row margin-0 mt_partf">
                                            <?php
                                            $element_array = array(
                                                'mother_name'=>array('label'=>"Mother Name",'class'=>'form-control h-34'),
                                                'mother_occupation'=>array('label'=>"Mother Occupation",'class'=>'form-control h-34'),
                                                'family_status'=>array('label'=>'Family Status'),
                                            );
                                            echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                            ?>
                                        </div>
                                        <div class="row margin-0 mt_partf">
                                            <?php
                                            $element_array = array(
                                                'no_of_brothers'=>array('label'=>'No Of Brothers'),
                                                'no_of_married_brother'=>array('label'=>'No Of Married Brother'),
                                                'no_of_sisters'=>array('label'=>'No Of Sisters'),
                                            );
                                            echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                            ?>
                                        </div>
                                        <div class="row margin-0 mt_partf">
                                            <?php
                                            $element_array = array(
                                                'no_of_married_sister'=>array('label'=>'No Of Married Sister'),
									            'family_details'=>array('label'=>'About My Family','class_width'=>'col-lg-12 col-md-12 col-sm-12 col-xs-12','disp_label'=>'yes'),
                                            );
                                            echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default" id="mob_family_info_edit" style="display:none;">
                            <div class="panel-heading">
                                <h4 data-toggle="collapse" data-parent="#accordion" data-target="#mob_family_info_edit_col" class="panel-title ">
                                    <i class="fa fa-plus pull-right"></i>
                                    <a href="javascript:void(0)" class="hover-l">Family Details</a>
                                </h4>
                            </div>
                            <div id="mob_family_info_edit_col" class="panel-collapse collapse">
                                <div class="">
                                <div id="reponse_mob_ne_lft_pan_list6"></div>
                                    <form id="mob_ne_lft_pan_list6" name="mob_ne_lft_pan_list6" action="<?php echo $base_url; ?>my-profile/save-profile/family-detail" onSubmit="return validat_function_frm6('mob_ne_lft_pan_list6')" class="margin-top-10 family-detail">
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"  class="hash_tocken_id" />
                                    <input type="hidden" name="is_post" value="1" />
                                    <input type="hidden" name="base_url" value="<?php echo $base_url; ?>" />
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <a href="javascript:;" onclick="return mob_view_show('mob_family_info');" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right">Cancel</a>
                                        </div>
                                    </div>
                                    <div class="main_box_basic_detail">
                                        <div class="">
                                            <div class="row margin-0">
                                            <?php
                                                $member_id = $this->common_front_model->get_session_data('id');
                                                if(isset($member_id) && $member_id != '' )
                                                {
                                                    $row_data = $this->common_model->get_count_data_manual('register',array('id'=>$member_id,'is_deleted'=>'No'),1);
                                                    $this->common_front_model->edit_row_data = $row_data;
                                                    $this->common_model->edit_row_data = $row_data;
                                                    $this->common_model->mode= 'edit';
                                                    $this->common_front_model->mode= 'edit';
                                                }
                                                $ele_array = array(
                                                    'family_type'=>array('type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('family_type'),'extra_style'=>'width:100%'),
                                                    'father_name'=>array('extra_style'=>'width:100%'),
                                                    'father_occupation'=>array('lable'=>"Father's Occupation",'extra_style'=>'width:100%'),
                                                );
                                                echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile'));
                                            ?>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <div class="row mt-4 margin-0">
                                            <?php
                                                $ele_array = array(
                                                    'mother_name'=>array('extra_style'=>'width:100%'),
                                                    'mother_occupation'=>array('lable'=>"Mother's Occupation",'extra_style'=>'width:100%'),
                                                    'family_status'=>array('type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('family_status'),'extra_style'=>'width:100%'),    
                                                );
                                                echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile'));
                                            ?>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <div class="row mt-3 margin-0">
                                            <?php
                                                $ele_array = array(
                                                    'no_of_brothers'=>array('type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('no_of_brothers'),'extra_style'=>'width:100%','class'=>'no_of_brothers','onchange'=>'show_bro_details()'),
													'no_of_married_brother'=>array('type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('no_marri_brother'),'extra_style'=>'width:100%','class'=>'mob_no_of_married_brother'),
                                                    'no_of_sisters'=>array('type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('no_of_brothers'),'extra_style'=>'width:100%','class'=>'no_of_sisters','onchange'=>'show_sis_details()'),
                                                );
                                                echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile'));
                                            ?>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <div class="row mt-3 margin-0">
                                            <?php
                                                $ele_array = array(
													'no_of_married_sister'=>array('type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('no_marri_sister'),'extra_style'=>'width:100%','class'=>'mob_no_of_married_sister'),
													'family_details'=>array('type'=>'textarea','extra_style'=>'width:100%','label'=>'About My Family')
                                                );
                                                echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile'));
                                            ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="row mt-3 margin-0">
                                                <div class="w-100">
                                                    <button onClick="return validat_function_frm6('mob_ne_lft_pan_list6')" class="edit_accordion_submit_btn Poppins-Semi-Bold f-15 color-f">Submit</button> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--first mob Family Details tab end-->
                    </div>
                </div>
            </div>
            <!--partner preference Acoordion start-->
            <div class="#">
                <button class="btn btn-lg btn-primary-k b-m-mobile Poppins-Semi-Bold">
                            Partner Preferences </button>
            </div>
            <div class="col-md-12 col-xs-12 padding-0">
                <div class="add-input new-accordion">
                    <div class="panel-group" id="accordion_2">
                        <!--first mob Partner Basic Preferences tab start-->
                        <div class="panel panel-default mt-4" id="mob_part_prefrence">
                            <div class="panel-heading">
                                <h4 data-toggle="collapse" data-parent="#accordion" data-target="#mob_part_prefrence_col" class="panel-title ">
                                    <i class="fa fa-plus pull-right"></i>
                                    <a href="javascript:void(0)" class="hover-l">Partner Basic Preferences</a>
                                </h4>
                            </div>
                            <div id="mob_part_prefrence_col" class="panel-collapse collapse">
                                <div class="">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <a href='javascript:;' onclick="mob_edit_show('mob_part_prefrence');" role="button" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right"><i class="fas fa-pen Edit_pen"></i>Edit</a>
                                        </div>
                                    </div>
                                    <div class="main_box_preference">
                                        <div class="row margin-0 mt-0">
                                            <?php
                                                $element_array = array(
                                                    'looking_for'=>array('label'=>'Looking For','class_width'=>' col-lg-6 col-md-6 col-sm-12 col-xs-12','label_width'=>'3','val_width'=>9),
                                                    'part_complexion'=>array('label'=>'Partner Complexion','class_width'=>' col-lg-6 col-md-6 col-sm-12 col-xs-12','label_width'=>'3','val_width'=>9),
                                                    'part_frm_age'=>array('label'=>"Age Preference",'post_filed_concate'=>' to ','post_filed'=>'part_to_age','post_filed_val_after'=>' Years'),
                                                );
                                                echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                            ?>
                                        </div>
                                        <div class="row margin-0 mt_partf">
                                            <?php
                                                $element_array = array(
                                                    'part_height'=>array('label'=>"Height",'call_back'=>'display_height','post_filed_concate'=>' to ','post_filed'=>'part_height_to','post_filed_call_back'=>'display_height'),
                                                    'part_mother_tongue'=>array('label'=>'Mother Tongue','type'=>'relation','table_name'=>'mothertongue','disp_column_name'=>'mtongue_name','class_width'=>' col-lg-10 col-md-10 col-sm-12 col-xs-12','label_width'=>'2','val_width'=>10,'disp_label'=>'yes'),
                                                    'part_expect'=>array('label'=>'Expectations','class_width'=>' col-lg-6 col-md-6 col-sm-12 col-xs-12','label_width'=>'3','val_width'=>9)
                                                );
                                                echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default" id="mob_part_prefrence_edit" style="display:none;">
                            <div class="panel-heading">
                                <h4 data-toggle="collapse" data-parent="#accordion" data-target="#mob_part_prefrence_edit_col" class="panel-title ">
                                    <i class="fa fa-plus pull-right"></i>
                                    <a href="javascript:void(0)" class="hover-l">Partner Basic Preferences</a>
                                </h4>
                            </div>
                            <div id="mob_part_prefrence_edit_col" class="panel-collapse collapse">
                                <div class="">
                                    <div id="reponse_mob_ne_lft_pan_list7"></div>
                                    <form id="mob_ne_lft_pan_list7" name="mob_ne_lft_pan_list7" action="<?php echo $base_url; ?>my-profile/save-profile/part-basic-detail" onSubmit="return validat_function('mob_ne_lft_pan_list7')" class="margin-top-10 part-basic-detail">
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"  class="hash_tocken_id" />
                                    <input type="hidden" name="is_post" value="1" />
                                    <input type="hidden" name="base_url" value="<?php echo $base_url; ?>" />
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <a href="javascript:;" onclick="return mob_view_show('mob_part_prefrence');" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right">Cancel</a>
                                        </div>
                                    </div>
                                    <div class="main_box_basic_detail">
                                        <div class="">
                                            <div class="row margin-0">
                                            <?php 
                                            $ele_array = array(
                                                'looking_for'=>array('is_required'=>'required','type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('marital_status'),'label'=>'Looking For','is_multiple'=>'yes','display_placeholder'=>'No','class'=>'select2','extra_style'=>'width:100%'),
                                                'part_complexion'=>array('type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('complexion'),'label'=>'Partner Complexion','is_multiple'=>'yes','display_placeholder'=>'No','class'=>'select2','extra_style'=>'width:100%'),
                                            );
                                            echo $this->common_front_model->generate_common_front_form($ele_array,array('enctype'=>'enctype="multipart/form-data"','page_type'=>'edit_profile_multiple'));
                                                $ele_array = array(
                                                   
                                                    'part_frm_age'=>array('is_required'=>'required','type'=>'dropdown','value_arr'=>$this->common_model->age_rang(),'label'=>"From Age",'class'=>'select2','extra_style'=>'width:100%'),
                                                    );
                                                    echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile'));
                                                ?>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <div class="row mt-4 margin-0">
                                            <?php 
                                                $ele_array = array(
                                            'part_to_age'=>array('is_required'=>'required','type'=>'dropdown','value_arr'=>$this->common_model->age_rang(),'label'=>"To Age",'class'=>'select2','extra_style'=>'width:100%'),
                                                    'part_height'=>array('is_required'=>'required','type'=>'dropdown','value_arr'=>$this->common_model->height_list(),'label'=>"From Height",'class'=>'select2','extra_style'=>'width:100%'),
                                                    'part_height_to'=>array('is_required'=>'required','type'=>'dropdown','value_arr'=>$this->common_model->height_list(),'label'=>"To Height",'class'=>'select2','extra_style'=>'width:100%'),
                                                );
                                                echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile'));
                                            ?>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <div class="row mt-3 margin-0">
                                            <?php 
                                            $ele_array = array(
                                                'part_mother_tongue'=>array('type'=>'dropdown','is_multiple'=>'yes','display_placeholder'=>'No','class'=>'select2','value_arr'=>$mother_tongue_arr,'label'=>'Mother Tongue','extra_style'=>'width:100%'),
                                            );
                                            echo $this->common_front_model->generate_common_front_form($ele_array,array('enctype'=>'enctype="multipart/form-data"','page_type'=>'edit_profile_multiple'));
                                                $ele_array = array(
                                                    
                                                    'part_expect'=>array('type'=>'textarea','label'=>'Expectations','extra_style'=>'width:100%')
                                                    );
                                                    echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile'));
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="row mt-3 margin-0">
                                                <div class="w-100">                            
                                                    <button onClick="return validat_function('mob_ne_lft_pan_list7')" class="edit_accordion_submit_btn Poppins-Semi-Bold f-15 color-f">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--first mob Partner Basic Preferences tab end-->
                        <!--first mob Partner Life Style Preferences tab start-->
                        <div class="panel panel-default mt-4" id="mob_part_lifestyle_prefrence">
                            <div class="panel-heading">
                                <h4 data-toggle="collapse" data-parent="#accordion" data-target="#mob_part_lifestyle_prefrence_col" class="panel-title ">
                                    <i class="fa fa-plus pull-right"></i>
                                    <a href="javascript:void(0)" class="hover-l">Partner Life Style Preferences</a>
                                </h4>
                            </div>
                            <div id="mob_part_lifestyle_prefrence_col" class="panel-collapse collapse">
                                <div class="">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <a href='javascript:;' onclick="mob_edit_show('mob_part_lifestyle_prefrence');" role="button" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right"><i class="fas fa-pen Edit_pen"></i>Edit</a>
                                        </div>
                                    </div>
                                    <div class="main_box_preference">
                                        <div class="row margin-0 mt-0">
                                        <?php
                                            $element_array = array(
                                                'part_bodytype'=>array('label'=>'Body Type','class_width'=>' col-lg-6 col-md-6 col-sm-12 col-xs-12','label_width'=>'3','val_width'=>9),
                                                'part_diet'=>array('label'=>'Eating Habit','class_width'=>' col-lg-6 col-md-6 col-sm-12 col-xs-12','label_width'=>'3','val_width'=>9),
                                                'part_smoke'=>array('label'=>'Smoking'),
                                            );
                                            echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                        ?>
                                        </div>
                                        <div class="row margin-0 mt_partf">
                                        <?php
                                            $element_array = array(
                                                'part_drink'=>array('label'=>'Drinking','class_width'=>' col-lg-6 col-md-6 col-sm-12 col-xs-12','label_width'=>'3','val_width'=>9),
                                            );
                                            echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                        ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default" id="mob_part_lifestyle_prefrence_edit" style="display:none;">
                            <div class="panel-heading">
                                <h4 data-toggle="collapse" data-parent="#accordion" data-target="#mob_part_lifestyle_prefrence_edit_col" class="panel-title ">
                                    <i class="fa fa-plus pull-right"></i>
                                    <a href="javascript:void(0)" class="hover-l">Partner Life Style Preferences</a>
                                </h4>
                            </div>
                            <div id="mob_part_lifestyle_prefrence_edit_col" class="panel-collapse collapse">
                                <div class="">
                                    <div id="reponse_mob_ne_lft_pan_list11"></div>
                                    <form id="mob_ne_lft_pan_list11" name="mob_ne_lft_pan_list11" action="<?php echo $base_url; ?>my-profile/save-profile/part-basic-detail" onSubmit="return validat_function('mob_ne_lft_pan_list11')" class="margin-top-10 part-basic-detail">
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"  class="hash_tocken_id" />
                                    <input type="hidden" name="is_post" value="1" />
                                    <input type="hidden" name="base_url" value="<?php echo $base_url; ?>" />
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <a href="javascript:;" onclick="return mob_view_show('mob_part_lifestyle_prefrence');" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right">Cancel</a>
                                        </div>
                                    </div>
                                    <div class="main_box_basic_detail">
                                        <div class="">
                                            <div class="row margin-0">
                                            <?php 
                                                $ele_array = array(
                                                    'part_bodytype'=>array('type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('bodytype'),'label'=>'Body type','is_multiple'=>'yes','display_placeholder'=>'No','class'=>'select2','extra_style'=>'width:100%'),
                                                    'part_diet'=>array('type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('diet'),'label'=>'Eating Habit','is_multiple'=>'yes','display_placeholder'=>'No','class'=>'select2','extra_style'=>'width:100%'),
                                                    'part_smoke'=>array('type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('smoke'),'label'=>'Smoking Habit','is_multiple'=>'yes','display_placeholder'=>'No','class'=>'select2','extra_style'=>'width:100%'),
                                                    );
                                                    echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile_multiple'));
                                                ?>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <div class="row mt-4 margin-0">
                                            <?php 
                                                $ele_array = array(
                                                    'part_drink'=>array('type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('drink'),'label'=>'Drinking Habit','is_multiple'=>'yes','display_placeholder'=>'No','class'=>'select2','extra_style'=>'width:100%'),
                                                    );
                                                    echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile_multiple'));
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="row mt-3 margin-0">
                                                <div class="w-100">
                                                    <button onClick="return validat_function('mob_ne_lft_pan_list11')" class="edit_accordion_submit_btn Poppins-Semi-Bold f-15 color-f">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--first mob Partner Life Style Preferences tab end-->
                        <!--first mob Partner Religious Preferences tab start-->
                        <div class="panel panel-default mt-4" id="mob_part_religious_prefrence">
                            <div class="panel-heading">
                                <h4 data-toggle="collapse" data-parent="#accordion" data-target="#mob_part_religious_prefrence_col" class="panel-title ">
                                    <i class="fa fa-plus pull-right"></i>
                                    <a href="javascript:void(0)" class="hover-l">Partner Religious Preferences</a>
                                </h4>
                            </div>
                            <div id="mob_part_religious_prefrence_col" class="panel-collapse collapse">
                                <div class="">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <a href='javascript:;' onclick="mob_edit_show('mob_part_religious_prefrence');" role="button" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right"><i class="fas fa-pen Edit_pen"></i>Edit</a>
                                        </div>
                                    </div>
                                    <div class="main_box_preference">
                                        <div class="row margin-0 mt-0">
                                        <?php
                                            $element_array = array(
                                                'part_religion'=>array('label'=>'Religion','type'=>'relation','table_name'=>'religion','disp_column_name'=>'religion_name'),
                                                'part_caste'=>array('label'=>'Caste','type'=>'relation','table_name'=>'caste','disp_column_name'=>'caste_name'),
                                                'part_manglik'=>array('label'=>'Manglik'),
                                            );
                                            echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                        ?>
                                        </div>
                                        <div class="row margin-0 mt_partf">
                                        <?php
                                            $element_array = array(
                                                'part_star'=>array('label'=>'Star','type'=>'relation','table_name'=>'star','disp_column_name'=>'star_name'),
                                            );
                                            echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                        ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default" id="mob_part_religious_prefrence_edit" style="display:none;">
                            <div class="panel-heading">
                                <h4 data-toggle="collapse" data-parent="#accordion" data-target="#mob_part_religious_prefrence_edit_col" class="panel-title ">
                                    <i class="fa fa-plus pull-right"></i>
                                    <a href="javascript:void(0)" class="hover-l">Partner Religious Preferences</a>
                                </h4>
                            </div>
                            <div id="mob_part_religious_prefrence_edit_col" class="panel-collapse collapse">
                                <div class="">
                                    <div id="reponse_mob_ne_lft_pan_list8"></div>
                                    <form id="mob_ne_lft_pan_list8" name="mob_ne_lft_pan_list8" action="<?php echo $base_url; ?>my-profile/save-profile/part-religious-detail" onSubmit="return validat_function('mob_ne_lft_pan_list8')" class="margin-top-10 part-religious-detail">
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"  class="hash_tocken_id" />
                                    <input type="hidden" name="is_post" value="1" />
                                    <input type="hidden" name="base_url" value="<?php echo $base_url; ?>" />
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <a href="javascript:;" onclick="return mob_view_show('mob_part_religious_prefrence');" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right">Cancel</a>
                                        </div>
                                    </div>
                                    <div class="main_box_basic_detail">
                                        <div class="">
                                            <div class="row margin-0">
                                            <?php 
                                                $ele_array = array(
                                                    'part_religion'=>array('is_required'=>'required','type'=>'dropdown','onchange'=>"dropdownChange('part_religion','part_caste','caste_list')",'value_arr'=>$religion_arr,'label'=>'Religion','is_multiple'=>'yes','display_placeholder'=>'No','class'=>'select2','extra_style'=>'width:100%'),
                                                    'part_caste'=>array('type'=>'dropdown','relation'=>array('rel_table'=>'caste','key_val'=>'id','key_disp'=>'caste_name','not_load_add'=>'yes','rel_col_name'=>'religion_id','cus_rel_col_val'=>'part_religion'),'label'=>'Caste','is_multiple'=>'yes','display_placeholder'=>'No','class'=>'select2','extra_style'=>'width:100%'),
                                                );
                                                echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile_multiple'));
                                                $ele_array = array(
                                                    
                                                    'part_manglik'=>array('type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('manglik'),'label'=>'Manglik','extra_style'=>'width:100%'),
                                                );
                                                echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile'));
                                            ?>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <div class="row mt-4 margin-0">
                                            <?php 
                                                $ele_array = array(
                                                    'part_star'=>array('type'=>'dropdown','value_arr'=>$this->common_model->dropdown_array_table('star'),'label'=>'Star','is_multiple'=>'yes','display_placeholder'=>'No','class'=>'select2','extra_style'=>'width:100%')
                                                );
                                                echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile_multiple'));
                                            ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="row mt-3 margin-0">
                                                <div class="w-100"> 
                                                    <button onClick="return validat_function('mob_ne_lft_pan_list8')" class="edit_accordion_submit_btn Poppins-Semi-Bold f-15 color-f">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--first mob Partner Religious Preferences tab end-->
                        <!--first mob Partner Location Preferences tab start-->
                        <div class="panel panel-default mt-4" id="mob_part_location_prefrence">
                            <div class="panel-heading">
                                <h4 data-toggle="collapse" data-parent="#accordion" data-target="#mob_part_location_prefrence_col" class="panel-title ">
                                    <i class="fa fa-plus pull-right"></i>
                                    <a href="javascript:void(0)" class="hover-l">Partner Location Preferences</a>
                                </h4>
                            </div>
                            <div id="mob_part_location_prefrence_col" class="panel-collapse collapse">
                                <div class="">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <a href='javascript:;' onclick="mob_edit_show('mob_part_location_prefrence');" role="button" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right"><i class="fas fa-pen Edit_pen"></i>Edit</a>
                                        </div>
                                    </div>
                                    <div class="main_box_preference">
                                        <div class="row margin-0 mt-0">
                                        <?php 
                                            $element_array = array(
                                                'part_country_living'=>array('label'=>'Country','type'=>'relation','table_name'=>'country_master','disp_column_name'=>'country_name'),
                                                'part_state'=>array('label'=>'State','type'=>'relation','table_name'=>'state_master','disp_column_name'=>'state_name'),
                                                'part_city'=>array('label'=>'City','type'=>'relation','table_name'=>'city_master','disp_column_name'=>'city_name'),
                                                
                                            );
                                            echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                        ?>
                                        </div>
                                        <div class="row margin-0 mt_partf">
                                        <?php
                                            $element_array = array(
                                                'part_resi_status'=>array('label'=>'Residence'),
                                            );
                                            echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                        ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default" id="mob_part_location_prefrence_edit" style="display:none;">
                            <div class="panel-heading">
                                <h4 data-toggle="collapse" data-parent="#accordion" data-target="#mob_part_location_prefrence_edit_col" class="panel-title ">
                                    <i class="fa fa-plus pull-right"></i>
                                    <a href="javascript:void(0)" class="hover-l">Partner Location Preferences</a>
                                </h4>
                            </div>
                            <div id="mob_part_location_prefrence_edit_col" class="panel-collapse collapse">
                                <div class="">
                                    <div id="reponse_mob_ne_lft_pan_list9"></div>	
                                    <form id="mob_ne_lft_pan_list9" name="mob_ne_lft_pan_list9" action="<?php echo $base_url; ?>my-profile/save-profile/part-location-detail" onSubmit="return validat_function('mob_ne_lft_pan_list9')" class="margin-top-10 part-location-detail">
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"  class="hash_tocken_id" />
                                    <input type="hidden" name="is_post" value="1" />
                                    <input type="hidden" name="base_url" value="<?php echo $base_url; ?>" />
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <a href="javascript:;" onclick="return mob_view_show('mob_part_location_prefrence');" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right">Cancel</a>
                                            
                                        </div>
                                    </div>
                                    <div class="main_box_basic_detail">
                                        <div class="">
                                            <div class="row margin-0">
                                            <?php
                                                $state_load_special = 'yes';
												$city_load_special = 'yes';
												if(isset($member_data['part_country_living']) && $member_data['part_country_living'] !=''){
													$state_load_special = 'no';
												}
												if(isset($member_data['part_state']) && $member_data['part_state'] !=''){
													$city_load_special = 'no';
												}
												$ele_array = array(
													'part_country_living'=>array('type'=>'dropdown','value_arr'=>$country_arr,'label'=>'Country','onchange'=>"dropdownChange_mul_new('country_list_update','state_list_update','state_list')",'is_multiple'=>'yes','display_placeholder'=>'No','class'=>'select2 country_list_update','extra_style'=>'width:100%'),
													 'part_state'=>array('type'=>'dropdown','relation'=>array('rel_table'=>'state_master','key_val'=>'id','key_disp'=>'state_name','not_load_add'=>'yes','cus_rel_col_name'=>'country_id','cus_rel_col_val'=>'part_country_living','not_load_add_special'=>$state_load_special),'label'=>'State','onchange'=>"dropdownChange_mul_new('state_list_update','city_list_update','city_list')",'is_multiple'=>'yes','display_placeholder'=>'No','label'=>'State','class'=>'select2 state_list_update'),
													'part_city'=>array('type'=>'dropdown','relation'=>array('rel_table'=>'city_master','key_val'=>'id','key_disp'=>'city_name','not_load_add'=>'yes','cus_rel_col_name'=>'state_id','cus_rel_col_val'=>'part_state','not_load_add_special'=>$city_load_special),'label'=>'City','class'=>'city_list_update select2','is_multiple'=>'yes','display_placeholder'=>'No'),
												);
                                                echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile_multiple'));
                                            ?>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <div class="row mt-4 margin-0">
                                            <?php
                                                $ele_array = array(
                                                    'part_resi_status'=>array('type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('residence'),'label'=>'Residence','is_multiple'=>'yes','display_placeholder'=>'No','class'=>'select2','extra_style'=>'width:100%')
                                                );
                                                echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile_multiple'));
                                            ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="row mt-3 margin-0">
                                                <div class="w-100">
                                                    <button onClick="return validat_function('mob_ne_lft_pan_list9')" class="edit_accordion_submit_btn Poppins-Semi-Bold f-15 color-f">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--first mob Partner Location Preferences tab end-->
                        <!--first mob Partner Education / Occupation Preferences tab start-->
                        <div class="panel panel-default mt-4" id="mob_part_education_prefrence">
                            <div class="panel-heading">
                                <h4 data-toggle="collapse" data-parent="#accordion" data-target="#mob_part_education_prefrence_col" class="panel-title ">
                                    <i class="fa fa-plus pull-right"></i>
                                    <a href="javascript:void(0)" class="hover-l">Partner Education / Occupation Preferences</a>
                                </h4>
                            </div>
                            <div id="mob_part_education_prefrence_col" class="panel-collapse collapse">
                                <div class="">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <a href='javascript:;' onclick="mob_edit_show('mob_part_education_prefrence');" role="button" class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right"><i class="fas fa-pen Edit_pen"></i>Edit</a>
                                        </div>
                                    </div>
                                    <div class="main_box_preference">
                                    <div class="row margin-0 mt-0">
                                        <?php
                                            $element_array = array(
                                                'part_education'=>array('label'=>'Education','type'=>'relation','table_name'=>'education_detail','disp_column_name'=>'education_name','label_width'=>'1','val_width'=>11,'class_width'=>' col-lg-12 col-md-12 col-sm-12 col-xs-12',),
                                                'part_employee_in'=>array('label'=>'Employed in'),
                                                'part_occupation'=>array('label'=>'Occupation','type'=>'relation','table_name'=>'occupation','disp_column_name'=>'occupation_name'),
                                            );
                                            echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                        ?>
                                        </div>
                                        <div class="row margin-0 mt_partf">
                                        <?php
                                            $element_array = array(
                                                'part_designation'=>array('label'=>'Designation','type'=>'relation','table_name'=>'designation','disp_column_name'=>'designation_name'),
                                                'part_income'=>array('label'=>'Annual Income')
                                            );
                                            echo $this->common_front_model->view_detail_common($element_array,$member_data);
                                        ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default" id="mob_part_education_prefrence_edit" style="display:none;">
                            <div class="panel-heading">
                                <h4 data-toggle="collapse" data-parent="#accordion" data-target="#mob_part_education_prefrence_edit_col" class="panel-title ">
                                    <i class="fa fa-plus pull-right"></i>
                                    <a href="javascript:void(0)" class="hover-l">Partner Education / Occupation Preferences</a>
                                </h4>
                            </div>
                            <div id="mob_part_education_prefrence_edit_col" class="panel-collapse collapse">
                                <div class="">
                                    <div id="reponse_mob_ne_lft_pan_list10"></div>	
                                    <form id="mob_ne_lft_pan_list10" name="mob_ne_lft_pan_list10" action="<?php echo $base_url; ?>my-profile/save-profile/part-education-detail" onSubmit="return validat_function('mob_ne_lft_pan_list10')" class="margin-top-10 part-education-detail">
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"  class="hash_tocken_id" />
                                    <input type="hidden" name="is_post" value="1" />
                                    <input type="hidden" name="base_url" value="<?php echo $base_url; ?>" />
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <a href="javascript:;" onclick="return mob_view_show('mob_part_education_prefrence');"  class="edit_pro-1 Poppins-Semi-Bold f-15 color-31 pull-right">Cancel</a>
                                        </div>
                                    </div>
                                    <div class="main_box_basic_detail">
                                        <div class="">
                                            <div class="row margin-0">
                                            <?php 
                                                $ele_array = array(
                                                    'part_education'=>array('type'=>'dropdown','is_multiple'=>'yes','display_placeholder'=>'No','class'=>'select2','value_arr'=>$education_name_arr,'label'=>'Education','extra_style'=>'width:100%'),
                                                    'part_employee_in'=>array('is_multiple'=>'yes','display_placeholder'=>'No','class'=>'select2','type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('employee_in'),'label'=>'Employed In','extra_style'=>'width:100%'),
                                                    'part_occupation'=>array('type'=>'dropdown','is_multiple'=>'yes','display_placeholder'=>'No','class'=>'select2','value_arr'=>$occupation_arr,'label'=>'Occupation','class'=>'select2','extra_style'=>'width:100%'),
                                                );
                                                echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile_multiple'));
                                            ?>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <div class="row mt-4 margin-0">
                                            <?php 
                                                $ele_array = array(
                                                    'part_designation'=>array('type'=>'dropdown','is_multiple'=>'yes','display_placeholder'=>'No','class'=>'select2','value_arr'=>$designation_arr,'label'=>'Designation','extra_style'=>'width:100%'),
                                                );
                                                echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile_multiple'));
                                                $ele_array = array(
                                                    
                                                    'part_income'=>array('type'=>'dropdown','value_arr'=>$this->common_model->get_list_ddr('income'),'label'=>'Annual Income','extra_style'=>'width:100%')
                                                );
                                                echo $this->common_front_model->generate_common_front_form($ele_array,array('page_type'=>'edit_profile'));
                                            ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="row mt-3 margin-0">
                                                <div class="w-100">
                                                    <button onClick="return validat_function('mob_ne_lft_pan_list10')" class="edit_accordion_submit_btn Poppins-Semi-Bold f-15 color-f">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                        <!--first mob Partner Education / Occupation Preferences tab end-->
                    </div>
                </div>
                <!--partner preference accordion End-->
                <!--Accrodion End-->
            </div>
            <!--for mobile End-->
        </div>
    </div>
    </div>
<?php $this->common_model->js_extra_code_fr .= "
    function view_show(id)
    {
        $('#'+id).load(' .'+id);
        $('#'+id).html();
        $('#'+id).addClass('in active');
        $('#'+id+'_edit').removeClass('in active');
        
    }; 
    function edit_show(id)
    {
        $('#'+id+'_edit').html(); 
        $('#'+id).removeClass('in active');
        $('#'+id+'_edit').addClass('in active');
    };
    function mob_view_show(id)
    {
        $('#'+id).load(' #'+id);
        $('#'+id).html();
        $('#'+id).show();
        $('#'+id+'_edit').hide();
        $('#'+id+'_col').addClass('in active');
        $('#'+id+'_edit_col').removeClass('in active');    
    }; 
    function mob_edit_show(id)
    {
        $('#'+id+'_edit').html();
        $('#'+id).hide();
        $('#'+id+'_edit').show();
        $('#'+id+'_col').removeClass('in active');
        $('#'+id+'_edit_col').addClass('in active');
    };
        
    /*user basic scroll tabing start */    
        var scrollBarWidths1 = 40;
        
        var widthOfList1 = function(){
          var itemsWidth1 = 0;
          $('.list_colors.li1 li').each(function(){
            var itemWidth1 = $(this).outerWidth();
            itemsWidth1+=itemWidth1;
          });
          return itemsWidth1;
        };
        
        var widthOfHidden1 = function(){
          return (($('#user_basic').outerWidth())-widthOfList1()-getLeftPosi1())-scrollBarWidths1;
        };
        
        var getLeftPosi1 = function(){
          return $('.list_colors.li1').position().left;
        };
        
        var reAdjust = function(){
          if (($('#user_basic').outerWidth()) < widthOfList1()) {
            $('.scroller-right-1').show();
          }
          else {
            $('.scroller-right-1').hide();
          }
          
          if (getLeftPosi1()<0) {
            $('.scroller-left-1').show();
          }
          else {
            $('.item').animate({left:'-='+getLeftPosi1()+'px'},'slow');
          	$('.scroller-left-1').hide();
          }
        }
        
        reAdjust();
        
        $(window).on('resize',function(e){  
          	reAdjust();
        });
        
        $('.scroller-right-1').click(function() {
          
          $('.scroller-left-1').fadeIn('slow');
          $('.scroller-right-1').fadeOut('slow');
          
          $('.list_colors.li1').animate({left:'+='+widthOfHidden1()+'px'},'slow',function(){
        
          });
        });
        
        $('.scroller-left-1').click(function() {
          
        	$('.scroller-right-1').fadeIn('slow');
        	$('.scroller-left-1').fadeOut('slow');
          
          	$('.list_colors.li1').animate({left:'-='+getLeftPosi1()+'px'},'slow',function(){
          	
          	});
        });

    /*user basic scroll tabing end */

    /*partner prefrences scroll tabing start*/
        
        var scrollBarWidths = 40;
        var widthOfList = function(){
          var itemsWidth = 0;
          $('.list_colors.li2 li').each(function(){
            var itemWidth = $(this).outerWidth();
            itemsWidth+=itemWidth;
          });
          return itemsWidth;
        };
        
        var widthOfHidden = function(){
          return (($('#partner').outerWidth())-widthOfList()-getLeftPosi())-scrollBarWidths;
        };
        
        var getLeftPosi = function(){
          return $('.list_colors.li2').position().left;
        };
        
        var reAdjust2 = function(){
          if (($('#partner').outerWidth()) < widthOfList()) {
            $('.scroller-right-2').show();
          }
          else {
            $('.scroller-right-2').hide();
          }
          
          if (getLeftPosi()<0) {
            $('.scroller-left-2').show();
          }
          else {
            $('.item').animate({left:'-='+getLeftPosi()+'px'},'slow');
          	$('.scroller-left-2').hide();
          }
        }
        
        reAdjust2();
        
        $(window).on('resize',function(e){  
          	reAdjust2();
        });

        $('.scroller-right-2').click(function() {
          
            $('.scroller-left-2').fadeIn('slow');
            $('.scroller-right-2').fadeOut('slow');
            
            $('.list_colors.li2').animate({left:'+='+widthOfHidden()+'px'},'slow',function(){
          
            });
          });
          
          $('.scroller-left-2').click(function() {
            
              $('.scroller-right-2').fadeIn('slow');
              $('.scroller-left-2').fadeOut('slow');
            
                $('.list_colors.li2').animate({left:'-='+getLeftPosi()+'px'},'slow',function(){
                
                });
          });
    
    /*partner prefrences scroll tabing end*/
    
        $(document).ready(function() {
            $('#datepicker-example22').Zebra_DatePicker();
        });
        			
        $(document).ready(function() {
        $('#datepicker-example33').Zebra_DatePicker();
        });
        
        
        $(document).ready(function() {
        $('#datepicker-example44').Zebra_DatePicker();
        });
    

        /*edit profile*/
$(document).ready(function(){


    $('#myTab li a').click(function(){
       
        $('#myTab li a').removeClass('edit_tab_deactive');
        $('#myTab li').removeClass('active');
        var tab_name = $('#myTab li a').attr('href');
        $('#'+tab_name.substr(1)).load(' #'+tab_name.substr(1));
        $(this).addClass('edit_tab_deactive');
        $(this).addClass('active');
        $('.edit_div').removeClass('in active');
    });
    $('#myTab_9 li a').click(function(){
        $('#myTab_9 li a').removeClass('edit_tab_deactive');
        $('#myTab_9 li').removeClass('active');
        var tab_name = $('#myTab_9 li a').attr('href');
        $('#'+tab_name.substr(1)).load(' #'+tab_name.substr(1));
        $(this).addClass('edit_tab_deactive');
        $(this).addClass('active');
        $('.part_edit_div').removeClass('in active');
    });
    
});


/*End edit profile*/
$('.tab-content select').select2();
$('.panel-group select').select2();
   // select2('#languages_known','Select Languages Known');
    
    function validat_function_frm1(form_id)
    {
        
        if($('#'+form_id).length > 0)
        {
            $('#'+form_id).validate({
                
                rules: {
                    firstname: {
                        lettersonly: true
                    },
                    lastname: {
                        lettersonly: true
                    },
                },	
                submitHandler: function(form)
                {
                common_ajax_request(form_id);
                return false;
                }
            });
            
        }
    }
    
    function validat_function_frm6(form_id)
    {
        if($('#'+form_id).length > 0)
        {
            $('#'+form_id).validate({
                rules: {
                    father_name: {
                        lettersonly: true
                    },
                    father_occupation: {
                        lettersonly: true
                    },
                    mother_name: {
                        lettersonly: true
                    },
                    mother_occupation: {
                        lettersonly: true
                    },
                },	
                submitHandler: function(form)
                {
                    common_ajax_request(form_id);
                    return false;
                }
            });
        }
    }
    function validat_function_res(form_id)
    {
        if($('#'+form_id).length > 0)
        {
            $('#'+form_id).validate({
                rules: {
                    mobile_num: {
                    required: true,
                    number: true
                    },
                    phone: {					
                    number: true
                    }
                },	
                submitHandler: function(form)
                {
                    common_ajax_request(form_id);
                    return false;
                }
            });
        }
    }
    function validat_function(form_id)
    {
        if(form_id == 'ne_lft_pan_list3'){
            if($('#'+form_id).length > 0)
            {
                $('#'+form_id).validate({
                    
                        rules: {
                            subcaste: {
                                lettersonly: true
                            },
                            gothra: {
                                lettersonly: true
                            },
                        },
                    
                    submitHandler: function(form)
                    {
                        common_ajax_request(form_id);
                        return false;
                    }
                });
            }
        }else{
            if($('#'+form_id).length > 0)
            {
                $('#'+form_id).validate({
                   
                    submitHandler: function(form)
                    {
                        if(form_id == 'ne_lft_pan_list7' || form_id == 'mob_ne_lft_pan_list7'){
                            var fromage = $('#part_frm_age option:selected').val();
                            var toage = $('#part_to_age option:selected').val();
                            totage =  toage - fromage;
                            if(totage < 1)
                            {
                                
                                $('#reponse_'+form_id).addClass('alert alert-danger');
                                $('#reponse_'+form_id).html('<strong>Partner From Age</strong> is Always Less Than To <strong>Partner To Age</strong>.');
                                $('#reponse_'+form_id).show();
                                stoptimeout();
                                    starttimeout('#reponse_'+form_id);
                                return false;
                            }
                            var partheight = $('#part_height option:selected').val();
                            var partheightto = $('#part_height_to option:selected').val();
                            height =  partheightto - partheight;
                            if(height < 1)
                            {
                                
                                $('#reponse_'+form_id).addClass('alert alert-danger');
                                $('#reponse_'+form_id).html('<strong>Partner From Height</strong> is Always Less Than To <strong>Partner To Height</strong>.');
                                $('#reponse_'+form_id).show();
                                stoptimeout();
                                    starttimeout('#reponse_'+form_id);
                                return false;
                            }
                        }
                        common_ajax_request(form_id);
                        return false;
                    }
                });
            }
        }

	}
	function validat_function_form2(form_id)
    {
        if($('#'+form_id).length > 0)
        {
            $('#'+form_id).validate({
                rules: {
                    birthplace: {
                        lettersonly: true
                    },
                },	
                submitHandler: function(form)
                {
                    common_ajax_request(form_id);
                    return false;
                }
            });
        }
    }
    $(function(){display_total_childern(); });
	
	
	var selectIds = $('#mob_basic_info_tab_col,#mob_lifestyle_style_tab_col,#mob_about_me_hobby_col,#mob_religious_info_col,#mob_location_info_col,#mob_education_info_col,#mob_family_info_col,#mob_part_prefrence_col,#mob_part_lifestyle_prefrence_col,#mob_part_religious_prefrence_col,#mob_part_location_prefrence_col,#mob_part_education_prefrence_col');
			$(function ($) {
				selectIds.on('show.bs.collapse hidden.bs.collapse', function () {
					$(this).prev().find('.fa').toggleClass('fa-plus fa-minus');
				})
            });
            

/*hide and show marri bro sis start*/
    $('.no_of_married_brother').parent().attr('id','web_no_of_married_brother');
    $('.mob_no_of_married_brother').parent().attr('id','mob_no_of_married_brother');
    show_bro_details();
    function show_bro_details() {
        var brother = $('.no_of_brothers').val();	
        var opt = '';
        if(brother == '4 +')
        {
            brother = 5;
        }
        var base_url = $('#base_url').val();
        var hash_tocken_id = $('#hash_tocken_id').val();
        
        if(brother!='' && brother!='No')
        {
            $('#web_no_of_married_brother').show();
            $('#mob_no_of_married_brother').show();
            $.ajax({
                    url: base_url+'my_profile/married_brother_list',
                    type: 'post',
                    data: {
                        count_brother:brother,
                        csrf_new_matrimonial:hash_tocken_id
                    },
                    cache: false,
                    success: function(html)
                    {
                        $('.no_of_married_brother').html('');
                        $('.mob_no_of_married_brother').html('');
                        $('.no_of_married_brother').show();
                        $('.mob_no_of_married_brother').show();
                        $('.no_of_married_brother').append(html);
                        $('.mob_no_of_married_brother').append(html);
                    }
                });
        }
        else{
            $('.no_of_married_brother').prop('selected', false);
            $('.mob_no_of_married_brother').prop('selected', false);
            $('#web_no_of_married_brother').hide();
            $('#mob_no_of_married_brother').hide();
        }
    }    
    $('.no_of_married_sister').parent().attr('id','web_no_of_married_sister');
    $('.mob_no_of_married_sister').parent().attr('id','mob_no_of_married_sister');
    show_sis_details();
    function show_sis_details() {
        var sister = $('.no_of_sisters').val();	
        var opt = '';
        if(sister == '4 +')
        {
            sister = 5;
        }
        var base_url = $('#base_url').val();
        var hash_tocken_id = $('#hash_tocken_id').val();
        
        if(sister!='' && sister!='No')
        {
            $('#web_no_of_married_sister').show();
            $('#mob_no_of_married_sister').show();
            $.ajax({
				url: base_url+'my_profile/married_brother_list',
				type: 'post',
				data: {
					count_sister:sister,
					csrf_new_matrimonial:hash_tocken_id
				},
				cache: false,
				success: function(html)
				{
					
					$('.no_of_married_sister').html('');
					$('.mob_no_of_married_sister').html('');
					$('.no_of_married_sister').show();
					$('.mob_no_of_married_sister').show();
					$('.no_of_married_sister').append(html);
					$('.mob_no_of_married_sister').append(html);
            	}
        	});
        }
        else{
            $('.no_of_married_sister').prop('selected', false);
            $('.mob_no_of_married_sister').prop('selected', false);
            $('#web_no_of_married_sister').hide();
            $('#mob_no_of_married_sister').hide();
        }
    }    
    /*hide and show marri bro sis End*/        
   "; ?>