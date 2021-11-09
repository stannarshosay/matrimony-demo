<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Wedding_vendors extends CI_Controller {
	public $data = array();
	public function __construct()
	{
		parent::__construct();
		//$this->common_model->checkLogin(); // here check for login or not
		$this->common_model->check_admin_only_access();
	}
	public function index()
	{
		$this->vendors_list();
	}
	public function vendors_list($status ='ALL', $page =1)
	{
		$ele_array = array(
			'category_id'=>array('is_required'=>'required','type'=>'dropdown','relation'=>array('rel_table'=>'vendor_category','key_val'=>'id','key_disp'=>'category_name'),'label'=>'Category Name'),
			'planner_name'=>array('is_required'=>'required'),
			'title'=>array('is_required'=>'required','label'=>'Venue Title'),
			'capacity'=>array('is_required'=>'required','label'=>'Capacity People','input_type'=>'number','other'=>"min='0'"),
			'email'=>array('input_type'=>'email','is_required'=>'required','check_duplicate'=>'Yes'),
			
			'mobile'=>array('is_required'=>'required','type'=>'mobile','check_duplicate'=>'Yes'),
			
			//'mobile'=>array('is_required'=>'required','type'=>'mobile','check_duplicate'=>'Yes'),
			'currency'=>array('is_required'=>'required','type'=>'dropdown','relation'=>array('rel_table'=>'currency_master','key_val'=>'currency_code','key_disp'=>'currency_name')),
			'start_rate_range'=>array('is_required'=>'required','input_type'=>'number','other'=>"min='0'"),
			'end_rate_range'=>array('is_required'=>'required','input_type'=>'number','other'=>"min='0'"),
			'address'=>array('type'=>'textarea','is_required'=>'required'),
			'country_id'=>array('is_required'=>'required','class'=>' not_reset ','type'=>'dropdown','onchange'=>"dropdownChange('country_id','state_id','state_list')",'relation'=>array('rel_table'=>'country_master','key_val'=>'id','key_disp'=>'country_name')),
			'state_id'=>array('is_required'=>'required','onchange'=>"dropdownChange('state_id','city_id','city_list')",'type'=>'dropdown','relation'=>array('rel_table'=>'state_master','key_val'=>'id','key_disp'=>'state_name','rel_col_name'=>'country_id','not_load_add'=>'yes','rel_col_name'=>'country_id')),
			'city_id'=>array('is_required'=>'required','type'=>'dropdown','relation'=>array('rel_table'=>'city_master','key_val'=>'id','key_disp'=>'city_name','rel_col_name'=>'state_id','not_load_add'=>'yes','rel_col_name'=>'state_id')),
			'description'=>array('type'=>'textarea'),
			//'map_location'=>array('type'=>'textarea','is_required'=>'required'),
			'website'=>array('input_type'=>'url'),
			'facebook_link'=>array('input_type'=>'url'),
			'twitter_link'=>array('input_type'=>'url'),
			'linkedin_link'=>array('input_type'=>'url'),
			'google_link'=>array('input_type'=>'url'),
			'image'=>array('is_required'=>'required','type'=>'file','path_value'=>$this->common_model->path_wedding,'inline_style'=>'height:100px;width:150px;'),
			'image_2'=>array('type'=>'file','path_value'=>$this->common_model->path_wedding,'inline_style'=>'height:100px;width:150px;'),
			'image_3'=>array('type'=>'file','path_value'=>$this->common_model->path_wedding,'inline_style'=>'height:100px;width:150px;'),
			'image_4'=>array('type'=>'file','path_value'=>$this->common_model->path_wedding,'inline_style'=>'height:100px;width:150px;'),
			'image_5'=>array('type'=>'file','path_value'=>$this->common_model->path_wedding,'inline_style'=>'height:100px;width:150px;'),
			'status'=>array('type'=>'radio')
		);
		$this->common_model->extra_js[] = 'vendor/jquery-validation/dist/additional-methods.min.js';
		$this->common_model->extra_js[] = 'vendor/ckeditor/ckeditor.js';
		$this->common_model->extra_js[] = 'vendor/jquery-validation/dist/additional-methods.min.js';
		$this->common_model->js_extra_code = " if($('#description').length > 0) { $('.page_description_edit').removeClass(' col-lg-7 ');
			$('.page_description_edit').addClass(' col-lg-10 ');
			CKEDITOR.replace( 'description' ); } ";
		$data_table = array(
			'title_disp'=>'planner_name',
			'disp_column_array'=> array('category_name','mobile','start_rate_range','end_rate_range','created_on','email','address')
		);
		$btn_arr = array(
			array('url'=>'wedding-vendors/vendors-list/edit-data/#id#','class'=>'info','label'=>'Edit Vendor'),
			array('url'=>'wedding-vendors/view-detail/#id#','class'=>'info','label'=>'View Detail'),
		);
		$join_tab_array = array();
		$join_tab_array[] = array( 'rel_table'=>'vendor_category', 'rel_filed'=>'id', 'rel_filed_disp'=>'category_name','rel_filed_org'=>'category_id');
		
		$other_config = array('load_member'=>'yes','data_table_mem'=>$data_table,'data_tab_btn'=>$btn_arr,'default_order'=>'DESC','enctype'=>'enctype="multipart/form-data"','display_image'=>'image','image'=>$this->common_model->path_wedding,'field_duplicate'=>array('email','mobile'));
		if(isset($_REQUEST['email']) && $_REQUEST['email'] !='')
		{
			
		}
		else
		{
			unset($other_config['field_duplicate']);
		}
		//$other_config = array('enctype'=>'enctype="multipart/form-data"','display_image'=>array('image'));
		$this->common_model->common_rander('wedding_planner', $status, $page ,'Vendor',$ele_array,'created_on',0,$other_config,$join_tab_array);
	}
	public function view_detail($id='')
	{
		if($id !='')
		{
			$data = array();
			$data['id'] = $id; // current row id for view detail
			
			// $data['data_array'] = $this->common_model->get_count_data_manual('events',array('id'=>$id),1,' * ','',0,'',0); // pass data_array perameter for custom row 
			$image_arra = array(
			array(
				'filed_arr' => array('image','image_2','image_3','image_4','image_5'),
				'path_value'=>$this->common_model->path_wedding,
				'title'=>'Vendor Gallary',
				'class_width'=>' col-lg-3 col-md-4 col-sm-6  col-xs-12 ',
				'img_class'=>'img-responsive img-thumbnail',
				'inline_style'=>''
			));
			$field_main_array = array(				
				array(
					'title_from_arr'=>'planner_name',
					'class_width'=>' col-lg-4 col-md-4 col-sm-6  col-xs-12 ',
					'field_array'=>array(
						'category_id'=>array('type'=>'relation','table_name'=>'vendor_category','prim_id'=>'id','disp_column_name'=>'category_name','label'=>'Category Name'),
						'mobile'=>'',
						'email'=>'',
						'start_rate_range'=>array('pre_filed'=>'currency'),
						'end_rate_range'=>array('pre_filed'=>'currency'),
						//'map_location'=>array('inline_style'=>'word-wrap:break-word;'),
						'address'=>array('inline_style'=>'word-wrap:break-word;'),
						'country_id'=>array('type'=>'relation','table_name'=>'country_master','prim_id'=>'id','disp_column_name'=>'country_name'),
						'state_id'=>array('type'=>'relation','table_name'=>'state_master','prim_id'=>'id','disp_column_name'=>'state_name'),
						'city_id'=>array('type'=>'relation','table_name'=>'city_master','prim_id'=>'id','disp_column_name'=>'city_name'),
						'created_on'=>array('type'=>'date'),
						
						'website'=>array('type'=>'link'),
						'facebook_link'=>array('type'=>'link'),
						'twitter_link'=>array('type'=>'link'),
						'linkedin_link'=>array('type'=>'link'),
						'google_link'=>array('type'=>'link'),
					),
				),
				array(
					'title'=>'Description',
					'class_width'=>' col-lg-12 col-md-12 col-sm-12 col-xs-12 ',
					'is_single'=>'yes',
					'field_array'=>array(
						'description'=>'description'
					),
				),
			);
			$data['img_list_arr'] = $image_arra;
			$data['img_position'] = 'bottom';
			$data['field_list'] = $field_main_array;
			$this->common_model->js_extra_code.= ' if($(".magniflier").length > 0){OnhoverMove();}';
			$this->common_model->table_name = 'wedding_planner'; // set table name for get data from wich table 
			
			$this->common_model->common_view_detail('Vendors Detail',$data);
		}
		else
		{
			redirect($this->common_model->base_url_admin.'event-management/event-list');
		}
	}
	
	public function vendors_category($status ='ALL', $page =1)
	{
		$ele_array = array(
			'category_name'=>array('is_required'=>'required'),
			'status'=>array('type'=>'radio')
		);
		$this->common_model->common_rander('vendor_category', $status, $page , 'Vendor Category',$ele_array,'category_name',1);
	}
}