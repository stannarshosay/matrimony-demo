<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Api extends CI_Controller {
	public $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->load->model("front_end/modify_photo_model");
		$this->load->model('front_end/search_model');
		$this->load->model('front_end/success_story_model');
		$this->load->model('front_end/message_model');
		$this->load->model('front_end/home_model');


		// $this->base_url = base_url();
		// $this->data['base_url'] = $this->base_url;
	}

	//session checker
	// public function get_session(){
	// 	$this->common_front_model->set_orgin();
	// 	echo '<pre>';
	// 	var_dump($_SESSION);
	// 	echo '</pre>';
		
	// }


	public function get_tocken()
	{
		$this->common_front_model->set_orgin();
		$data1['tocken'] = $this->security->get_csrf_hash();
		$android_app = $this->common_model->android_app;//set app_version in common model
		$ios_app = $this->common_model->ios_app;//set app_version in common model
		$force_status = false;
		$data1['status'] = 'success';
		$data1['android_version'] = $android_app;// android version
		$data1['app_version'] = $ios_app;//ios appp version 
		if(isset($_REQUEST['appversion']) && $_REQUEST['appversion'] !='')
		{
			$appversion = $_REQUEST['appversion'];
			if(isset($_REQUEST['device_type']) && $_REQUEST['device_type']=='android')
			{
				if($appversion !=$android_app && $appversion < $android_app)
				{
					$force_status = true;	
				}
			}
			else if(isset($_REQUEST['device_type']) && $_REQUEST['device_type']=='ios')
			{
				if($appversion !=$ios_app && $appversion < $ios_app)
				{
					$force_status = true;
				}
			}
		}
		$data1['is_force_update'] = $force_status;
		
		// for get menu sidebar for app dynamic
		$data1['menu_arr'] = $this->common_model->sidebar_menu_api();
		// for get menu sidebar for app dynamic

		$data['data'] = json_encode($data1);
		$this->load->view('common_file_echo',$data);
	}
	public function get_mobile_code()
	{
        $this->common_front_model->set_orgin();
		$str_ddr = array();
		$str_ddr = $this->common_front_model->get_country_code('array');
		$this->output->set_content_type('application/json');
		$data['tocken'] = $this->security->get_csrf_hash();
		$data['status'] = 'success';
		$data['data'] = $str_ddr;
		$this->output->set_output(json_encode($data));
	}
    
	public function get_list_json($get_list='',$currnet_val='')
	{
        $this->common_front_model->set_orgin();
		$str_ddr = array();
		if($this->input->post('multivar') && $this->input->post('multivar')=='multi')
		{
			$str_ddr = $this->common_front_model->get_list_multiple($get_list,'json','','json');	
		}
		else
		{
			$str_ddr = $this->common_front_model->get_list($get_list,'json','','array');
		}
		$this->output->set_content_type('application/json');
		$data['tocken'] = $this->security->get_csrf_hash();
		$data['status'] = 'success';
		$data['data'] = $str_ddr;
		$this->output->set_output(json_encode($data));
	}

	public function get_plan_data()

	{
        $this->common_front_model->set_orgin();

		//$where_arra=array('is_deleted'=>'No','status'=>'APPROVED');

		if($this->input->post('user_agent')=='NI-IAPP')

		{

			$where_arra=array('is_deleted'=>'No','status'=>'APPROVED',"in_app_product_id!=''");
		}

		else

		{

			$where_arra=array('is_deleted'=>'No','status'=>'APPROVED');

		}

		$membership_plan_data = $this->common_model->get_count_data_manual('membership_plan',$where_arra,2,'*','id asc');



		$data1['tocken'] = $this->security->get_csrf_hash();

		if(isset($membership_plan_data) && $membership_plan_data !='' && count($membership_plan_data) > 0)

		{

			$data1['status'] = 'success';

			$data1['plan_data'] = $membership_plan_data;

		}

		else

		{

			$data1['status'] = 'error';

			$data1['plan_data'] = "Sorry, Currently no any plan available";

		}

		$this->output->set_content_type('application/json');

		$data['data'] = $this->output->set_output(json_encode($data1));

	}
	public function upload_photo_new()

	{
		$this->common_front_model->set_orgin();

		$response = $this->modify_photo_model->upload_photo_file();

		$this->load->view('common_file_echo',$response);

	}
	public function set_profile_pic()

	{
		$this->common_front_model->set_orgin();

		$response = $this->modify_photo_model->set_profile_pic();

		$this->load->view('common_file_echo',$response);

	}

	public function delete_photo()

	{
		$this->common_front_model->set_orgin();

		$response = $this->modify_photo_model->delete_photo();

		$this->load->view('common_file_echo',$response);

	}

	public function delete_id_proof_photo()

	{
		$this->common_front_model->set_orgin();

		$response = $this->modify_photo_model->delete_id_proof_photo();

		$this->load->view('common_file_echo',$response);

	}

	public function upload_id_proof_photo()

	{
		$this->common_front_model->set_orgin();

		$response = $this->modify_photo_model->upload_id_proof_photo();

		$this->load->view('common_file_echo',$response);

	}

	public function refine_search($page = 1)

	{

		$this->search_model->set_search();

		$this->result($page);

	}

	public function result($page=1)

	{

		$this->common_front_model->set_orgin();

		$is_ajax = 0;

		if($this->input->post('is_ajax') && $this->input->post('is_ajax') !='')

		{

			$is_ajax = $this->input->post('is_ajax');

		}

		// for web API

		$user_agent = $this->input->post('user_agent') ? $this->input->post('user_agent') : 'NI-WEB';

		if($user_agent!='NI-WEB')

		{

			$member_data = $this->search_model->get_search_result($page);

			$member_data_count = $this->search_model->get_search_count();

			$data1['continue_request'] = TRUE;

			$data1['tocken'] = $this->security->get_csrf_hash();

			$data1['status'] = 'success';

			$data1['total_count'] = $member_data_count;

			if(isset($member_data) && $member_data!='')

			{

				$data1['errormessage'] = 'Total Result found('.$member_data_count.')';

				$data1['errmessage'] = 'Total Result found('.$member_data_count.')';

				$data1['data'] = $this->common_front_model->process_data_app($member_data);

			}

			else

			{

				$data1['errormessage'] = 'No data found';

				$data1['errmessage'] = 'No data found';

				$data1['data'] = '';

				$data1['continue_request'] = FALSE;

			}

			$data['data'] = json_encode($data1);

			$this->load->view('common_file_echo',$data);

		}// for web API

		else

		{

			$this->data['member_total_count'] 	= $this->search_model->get_search_count();

			$this->data['member_data'] 			= $this->search_model->get_search_result($page);

			

			if($is_ajax == 0)

			{

				$this->common_model->extra_css_fr= array ('css/popup_user.css');

				$this->common_model->extra_js_fr= array ('js/photo_protect_js.js','js/range-slider.js');

				$this->common_model->front_load_header();

				$this->load->view('front_end/search_result',$this->data);

				$this->common_model->front_load_footer();

			}

			else

			{
				$this->load->view('front_end/search_result_member_profile',$this->data);

			}

		}

	}
	public function get_success_stories($page=1,$pageSize=10){

		$this->common_front_model->set_orgin();
		$user_agent = $this->input->post('user_agent') ? $this->input->post('user_agent') : 'NI-WEB';
		if($user_agent!='NI-WEB')

		{

		$this->common_model->limit_per_page = $pageSize;

		$where_arra = array('is_deleted'=>'No','status'=>'APPROVED');

		    $data1['data'] = $this->common_model->get_count_data_manual('success_story',$where_arra,2,'*','id desc',$page,'','','');

			$story_count = $this->common_model->get_count_data_manual('success_story',$where_arra,0,'id');

			$data1['continue_request'] = TRUE;

			$data1['tocken'] = $this->security->get_csrf_hash();

			$data1['status'] = 'success';

			$data1['total_count'] = $story_count;

			if(isset($data1['data']) && $data1['data']!='')

			{

				$data1['errormessage'] = 'Total Result found('.$story_count.')';

				$data1['errmessage'] = 'Total Result found('.$story_count.')';
			}

			else

			{

				$data1['errormessage'] = 'No data found';

				$data1['errmessage'] = 'No data found';

				$data1['data'] = '';

				$data1['continue_request'] = FALSE;

				$data1['status'] = 'error';


			}

			$data['data'] = json_encode($data1);

			$this->load->view('common_file_echo',$data);

		}
	}

	public function get_success_story($id='')

	{	

		$this->common_front_model->set_orgin();

		$id = $this->common_model->descrypt_id($id);

		if($id!='')

		{	

		$data1['tocken'] = $this->security->get_csrf_hash();

		$where_arra = array(" (id ='".$id."')",'status'=>'APPROVED','is_deleted'=>'No');

		    $data1['data'] =  $this->common_model->get_count_data_manual('success_story',$where_arra,1,'id,weddingphoto,weddingphoto_type,bridename,groomname,marriagedate,successmessage,created_on','','','',"");

			if(isset($data1['data']) && $data1['data']!='' && count($data1['data']) > 0)

			{

				$data1['errmessage'] = 'Result Found';

				$data1['status'] = 'success';

			}

			else

			{

				$data1['errmessage'] = 'No data found';

				$data1['data'] = '';

				$data1['status'] = 'error';


			}			

		}else{

			$data1['errmessage'] = 'Invalid credentials';

			$data1['data'] = '';

			$data1['status'] = 'error';

		}

		$data['data'] = json_encode($data1);

		$this->load->view('common_file_echo',$data);

	}

	public function get_notifications($page = 1){
		
		$this->common_front_model->set_orgin();

		$notification_count = $this->message_model->get_notification_list(0);

		$notification_list = $this->message_model->get_notification_list(1,$page);

		$data1['continue_request'] = TRUE;

		$data1['tocken'] = $this->security->get_csrf_hash();

		$data1['status'] = 'success';

		$data1['total_count'] = $notification_count;

		if(isset($notification_count) && $notification_count!='' && $notification_count > 0 && isset($notification_list) && $notification_list!='')

		{

			$data1['errormessage'] = 'Total Result found('.$notification_count.')';

			$data1['errmessage'] = 'Total Result found('.$notification_count.')';	

			$data1['data'] = $notification_list;

		}

		else

		{
			$data1['status'] = 'error';

			$data1['data'] = '';

			$data1['errormessage'] = 'No data available';

			$data1['errmessage'] = 'No data available';

			$data1['continue_request'] = FALSE;

		}

		if($this->input->post('nav') !='' && isset($notification_list) && $notification_list!=''){

			$data1['status'] = 'success';

			$data1['errormessage'] = 'Total Unread Notification('.$notification_count.')';

			$data1['errmessage'] = 'Total Unread Notification('.$notification_count.')';	

			$data1['data'] = $notification_list;

			$data1['continue_request'] = TRUE;
		}

		$data['data'] = json_encode($data1);

		$this->load->view('common_file_echo',$data);

	}
    
	public function update_notification_action(){
		if($this->input->post('mode') !='')

		{

			$this->data['update_status'] = $this->message_model->update_notification_action();

		}

		if(isset($_REQUEST['user_agent']) && $_REQUEST['user_agent'] != 'NI-WEB')

		{

			$data['data'] = json_encode($this->data['update_status']);

			$this->load->view('common_file_echo',$data);

		}
	}

	function get_dashboard_count(){
		$this->common_front_model->set_orgin();
		$member_id = $this->common_front_model->get_session_data("matri_id");
		$data1['status'] = 'error';
		$data1['errmessage'] = 'Oops! Something went wrong';

		if(!isset($member_id) || $member_id == ''){
			$data1['status'] = 'error';
		    $data1['errmessage'] = 'Oops! Session Timed Out';
		}else{
			$data1['errmessage'] = 'Counts Recieved';
			$data1['status'] = 'success';
			$data1['like_count'] = $this->common_model->get_count_data_manual('member_likes',array('my_id'=>$member_id,'like_status'=>'Yes'),0,'','','','','','');
			$data1['shortlist_count'] = $this->common_model->get_count_data_manual('shortlist',array('shortlist.is_deleted'=>'No','shortlist.from_id'=>$member_id),0,'');
			$data1['block_count'] = $this->common_model->get_count_data_manual('block_profile',array('is_deleted'=>'No','block_by'=>$member_id),0,'');
			$data1['interest_count'] = $this->common_model->get_count_data_manual('expressinterest',array("is_deleted"=>'No',"(sender = '".$member_id."' OR receiver = '".$member_id."')"),0,'','',0);
		
		}
		
		$data['data'] = json_encode($data1);

		$this->load->view('common_file_echo',$data);
	
	}

	public function get_homepage_banner($page = 1){
		
		$this->common_front_model->set_orgin();

		$homepage_banners = $this->home_model->get_homepage_banner_list($page);

		$data1['tocken'] = $this->security->get_csrf_hash();

		$data1['status'] = 'success';

		if(isset($homepage_banners) && $homepage_banners!='')

		{

			$data1['errmessage'] = 'Banners recieved successfully';	

			$data1['data'] = $homepage_banners;

		}

		else

		{
			$data1['status'] = 'error';

			$data1['data'] = '';

			$data1['errormessage'] = 'No data available';
		}

		$data['data'] = json_encode($data1);

		$this->load->view('common_file_echo',$data);

	}
           
}