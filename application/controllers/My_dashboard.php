<?php defined('BASEPATH') OR exit('No direct script access allowed');
class My_dashboard extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->base_url = base_url();
		$this->data['base_url'] = $this->base_url;
		$this->load->model('front_end/matches_model');
		$this->load->model('front_end/dashboard_model');
		$this->load->model('front_end/message_model');
		$this->common_front_model->checkLogin();
		$this->common_front_model->last_member_activity();
	}
	public function index()
	{
		$this->common_model->display_top_menu_perm = 'No';
		$this->common_model->extra_css_fr = array('css/chosen.css','css/select2.css','css/popup_user.css');
		$this->common_model->extra_js_fr = array('js/photo_protect_js.js','js/chosen.jquery.js','js/select2.min.js');
		
		$base_url = $this->data['base_url'];
		$this->common_model->front_load_header();
		$this->load->view('front_end/my_dashboard',$this->data);
		$this->load->view('front_end/photo_protect',$this->data);
		$this->common_model->front_load_footer();
	}
	public function update_percentage_slider_field()
	{
		$this->dashboard_model->update_percentage_slider_field();
	}
	public function generate_otp()
	{
		$response = $this->dashboard_model->generate_otp();
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($response));
		//$this->load->view('common_file_echo',$response);
	}
	function varify_mobile_check_otp()
	{
		$response = $this->dashboard_model->varify_mobile_otp();
		if($response == 'success')
		{
			$returnvar['status'] = 'success';
			$returnvar['error_meessage'] = 'Your mobile number verified successfully.';
			$returnvar['errmessage'] = 'Your mobile number verified successfully.';
		}
		else
		{
			$returnvar['status'] = 'error';
			$returnvar['error_meessage'] = $response;
			$returnvar['errmessage'] = $response;
		}
		$returnvar['tocken'] = $this->security->get_csrf_hash();
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($returnvar));
	}
	
	public function recent_profile()
    {
		$member_id = $this->common_front_model->get_user_id();
		if(isset($member_id) && $member_id!='')
		{
			$user_agent = $this->input->post('user_agent') ? $this->input->post('user_agent') : 'NI-WEB';
			
			
			$curre_gender = $this->common_front_model->get_session_data('gender');
			$where_arra=array("status !='UNAPPROVED' and status !='Suspended'");
			if(isset($curre_gender) && $curre_gender !='')
			{
				$where_arra[] = " gender != '$curre_gender' " ;
			}
			if($user_agent !='NI-WEB')
			{
				$id = $this->input->post('member_id');
				$where_arr = array('id'=>$id);
				$user_data = $this->common_model->get_count_data_manual('register',$where_arr,1,'gender','','','');
				$curre_gender = $user_data['gender'];
				$where_arra[] = " gender != '$curre_gender' " ;
				
			}
			
			$this->data['member_data'] = $this->common_model->get_count_data_manual('search_register_view',$where_arra,2,'*','id desc',1,10);
			
			
			$member_data = $this->data['member_data'];
			
			if($user_agent !='NI-WEB')
			{
				$data1['tocken'] = $this->security->get_csrf_hash();
				$data1['status'] = 'success';
				if(isset($member_data) && $member_data!='')
				{
					$data1['errormessage'] = '';
					$data1['errmessage'] = '';

					$data1['data'] = $this->common_front_model->process_data_app($member_data);
					
				}
				else
				{
					$data1['data'] = array();
				}
				$data['data'] = json_encode($data1);
				$this->load->view('common_file_echo',$data);
			}
			else
			{
				$this->load->view('front_end/match_result_member_profile',$this->data);
			}
		}
		else
		{
			$data1['tocken'] = $this->security->get_csrf_hash();
			$data1['status'] = 'error';
			$data1['errormessage'] =  "Sorry, Your session has been time out, Please login Again";
			$data1['errmessage'] =  "Sorry, Your session has been time out, Please login Again";
			$data['data'] = json_encode($data1);
			$this->load->view('common_file_echo',$data);
		}
    }
	
	public function recently_login()
    {
		$member_id = $this->common_front_model->get_user_id();
		if(isset($member_id) && $member_id!='')
		{
			$user_agent = $this->input->post('user_agent') ? $this->input->post('user_agent') : 'NI-WEB';
			
			$curre_gender = $this->common_front_model->get_session_data('gender');
			$date = $this->common_model->getCurrentDate();
			$last_month_date = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s'). " -1 months "));
			$where_arra=array("status !='UNAPPROVED' and status !='Suspended' and last_login > '$last_month_date' ");
			if(isset($curre_gender) && $curre_gender !='')
			{
				$where_arra[] = " gender != '$curre_gender' " ;
			}
			
			if($user_agent !='NI-WEB')
			{
				$id = $this->input->post('member_id');
				$where_arr = array('id'=>$id);
				$user_data = $this->common_model->get_count_data_manual('register',$where_arr,1,'gender','','','');
				$curre_gender = $user_data['gender'];
				
				$where_arra[] = " gender != '$curre_gender' " ;
			}
			
			$this->data['member_data'] = $this->common_model->get_count_data_manual('register_view',$where_arra,2,'*','last_login desc',1,10);
			
			$member_data = $this->data['member_data'];
			
			if($user_agent !='NI-WEB')
			{
				$data1['tocken'] = $this->security->get_csrf_hash();
				$data1['status'] = 'success';
				if(isset($member_data) && $member_data!='')
				{
					$data1['errormessage'] = '';
					$data1['errmessage'] = '';
					$data1['data'] = $this->common_front_model->process_data_app($member_data);
				}
				else
				{
					$data1['data'] = array();
				}
				$data['data'] = json_encode($data1);
				$this->load->view('common_file_echo',$data);
			}
			else
			{
				$this->load->view('front_end/match_result_member_profile',$this->data);
			}
		}
		else
		{
			$data1['tocken'] = $this->security->get_csrf_hash();
			$data1['status'] = 'error';
			$data1['errormessage'] =  "Sorry, Your session has been time out, Please login Again";
			$data1['errmessage'] =  "Sorry, Your session has been time out, Please login Again";
			$data['data'] = json_encode($data1);
			$this->load->view('common_file_echo',$data);
		}
    }
	
	public function resend_confirm_mail()
	{
		$this->dashboard_model->sent_confirm_mail_user();
	}
}