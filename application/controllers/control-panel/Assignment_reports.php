<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Assignment_reports extends CI_Controller {
	public $data = array();
	public function __construct()
	{
		parent::__construct();
		//$this->common_model->check_admin_only_access();
		$this->load->model('back_end/Assignment_reports_model','assignment_reports_model');
	}
	public function index()
	{
		$this->member_assigned_to_me();
	}
	public function member_assigned_to_me($status ='ALL', $page =1, $clear_filter='no'){
		$u_id = $this->common_model->get_session_data('id');
		$user_type = $this->common_model->get_session_user_type();
		if($user_type=='staff'){
			$user_type = 'Staff';
		}
		if($user_type == 'franchise'){
			$user_type = 'Franchise';
		}
		
		$other_config = array(
			'addAllow'=>'no',
			'editAllow'=>'no',
			'default_order'=>'desc',
			'display_status'=>'no',
			'deleteAllow'=>'no',
			'statusChangeAllow'=>'no',
			'personal_where'=>" member_id!='' and action = 'Assign' and user_type = '".$user_type."' and assign_to = '".$u_id."'",
		);
		if($clear_filter == 'yes'){
			$this->clear_filter('no');
		}
		$this->common_model->created_on_fild = 'assign_date';
		$this->common_model->display_selected_field = array('assign_by','matri_id','username','email','assign_date');
		$this->common_model->common_rander('member_assign_history_view', $status, $page, 'Assigned members to staff','','assign_date',0,$other_config,'');
	}
	public function lead_generation_assigned_to_me($status ='ALL', $page =1, $clear_filter='no'){
		$u_id = $this->common_model->get_session_data('id');
		$user_type = $this->common_model->get_session_user_type();
		if($user_type=='staff'){
			$user_type = 'Staff';
		}
		if($user_type == 'franchise'){
			$user_type = 'Franchise';
		}
		
		$other_config = array(
			'addAllow'=>'no',
			'editAllow'=>'no',
			'default_order'=>'desc',
			'display_status'=>'no',
			'deleteAllow'=>'no',
			'statusChangeAllow'=>'no',
			'personal_where'=>" lead_generation_id!='' and action = 'Assign' and user_type = '".$user_type."' and assign_to = '".$u_id."'",
		);
		if($clear_filter == 'yes'){
			$this->clear_filter('no');
		}
		$this->common_model->created_on_fild = 'assign_date';
		$this->common_model->display_selected_field = array('assign_by','username','email','assign_date');
		$this->common_model->common_rander('lead_generation_assign_history_view', $status, $page, 'Assigned Lead Generation To '.$user_type,'','assign_date',0,$other_config,'');
	}
	/*public function staff_assign_history($status ='ALL', $page =1, $clear_filter='no')
	{
		$other_config = array(
			'addAllow'=>'no',
			'editAllow'=>'no',
			'default_order'=>'desc',
			'display_status'=>'no',
			'deleteAllow'=>'no',
			'statusChangeAllow'=>'no',
			'personal_where'=>" member_id!='' and action = 'Assign' and user_type = 'Staff' ",
		);
		if($clear_filter == 'yes'){
			$this->clear_filter('no');
		}
		$this->common_model->primary_key = 'assign_id';
		$this->common_model->created_on_fild = 'assign_date';
		$this->common_model->labelArr =  array('assign_to_name'=>'Assign To');
		
		$this->common_model->display_selected_field = array('matri_id','username','email','assign_to_name','assign_date');
		$this->common_model->common_rander('member_assign_history_view', $status, $page, 'Assigned members to staff','','assign_date',0,$other_config,'');
	}
	public function franchise_assign_history($status ='ALL', $page =1, $clear_filter='no')
	{
		$other_config = array(
			'addAllow'=>'no',
			'editAllow'=>'no',
			'default_order'=>'desc',
			'display_status'=>'no',
			'deleteAllow'=>'no',
			'statusChangeAllow'=>'no',
			'personal_where'=>" member_id!='' and action = 'Assign' and user_type ='Franchise' ",
		);
		if($clear_filter == 'yes'){
			$this->clear_filter('no');
		}
		$this->common_model->primary_key = 'assign_id';
		$this->common_model->created_on_fild = 'assign_date';
		$this->common_model->labelArr =  array('assign_to_name'=>'Assign To');
		//'assign_by','assign_by_email',
		$this->common_model->display_selected_field = array('matri_id','username','email','assign_to_name','assign_date');
		$this->common_model->common_rander('member_assign_history_view', $status, $page, 'Assigned members to franchise','','assign_date',0,$other_config,'');
	}
	public function staff_unassign_history($status ='ALL', $page =1, $clear_filter='no')
	{
		$this->common_model->status_arr = array();
		$this->common_model->status_arr_change = array();
		$this->common_model->assing_to_member = 'yes';
		$this->common_model->staffassign_arr_change = array('Assign_Staff'=>'Assign Staff');
		$this->common_model->franchiseassign_arr_change = array();
		if($clear_filter == 'yes')
		{
			$this->clear_filter('no');
		}
		$personal_where = array();
		$personal_where['where_per'] = " member_id!='' and user_type = 'Staff' and action='Unassigned' ";
		$this->assignment_reports_model->unassigned_member_list($status,$page,$personal_where,'staff');
	}
	public function franchise_unassign_history($status ='ALL', $page =1, $clear_filter='no')
	{
		$this->common_model->primary_key ='member_id';
		$this->common_model->status_arr = array();
		$this->common_model->status_arr_change = array();
		$this->common_model->assing_to_member = 'yes';
		$this->common_model->staffassign_arr_change = array();
		$this->common_model->franchiseassign_arr_change = array('Assign_Franchise'=>'Assign Franchise');
		if($clear_filter == 'yes')
		{
			$this->clear_filter('no');
		}
		$personal_where = array();
		$personal_where['where_per'] = " member_id!='' and user_type = 'Franchise' and action='Unassigned' ";
		
		$this->assignment_reports_model->unassigned_member_list($status,$page,$personal_where,'franchise');
	}
	
	public function follow_up_report($status ='ALL', $page =1, $clear_filter='no')
	{
		$this->common_model->status_arr = array();
		$this->common_model->status_arr_change = array();
		$this->common_model->assing_to_member = 'yes';
		$this->common_model->staffassign_arr_change = array('Assign_Staff'=>'Assign Staff','Unassign_Staff'=>'Unassign Staff');
		$this->common_model->franchiseassign_arr_change = array('Assign_Franchise'=>'Assign Franchise','Unassign_Franchise'=>'Unassign Franchise');
		$personal_where = array();
		$personal_where['where_per'] = "";
		$access_perm = $this->common_model->check_permission('view_member','redirect');
		$other_config = $this->common_model->add_own_where('',$access_perm);
		if(isset($other_config['personal_where']) && $other_config['personal_where'] !='')
		{
			$personal_where['where_per'] = $other_config['personal_where'];
		}
		if($clear_filter == 'yes')
		{
			$this->clear_filter('no');
		}
		$this->assignment_reports_model->follow_up_report($status,$page,$personal_where);
	}
	public function staff_lead_assign_history($status ='ALL', $page =1, $clear_filter='no')
	{
		$other_config = array(
			'addAllow'=>'no',
			'editAllow'=>'no',
			'default_order'=>'desc',
			'display_status'=>'no',
			'deleteAllow'=>'no',
			'statusChangeAllow'=>'no',
			'personal_where'=>" lead_generation_id!='' and action = 'Assign' and user_type = 'Staff' ",
		);
		if($clear_filter == 'yes'){
			$this->clear_filter('no');
		}
		$this->common_model->primary_key = 'assign_id';
		$this->common_model->created_on_fild = 'assign_date';
		$this->common_model->labelArr =  array('assign_to_name'=>'Assign To');
		
		$this->common_model->display_selected_field = array('id','username','email','assign_to_name','assign_date');
		$this->common_model->common_rander('lead_generation_assign_history_view', $status, $page, 'Assigned members to staff','','assign_date',0,$other_config,'');
	}
	public function franchise_lead_assign_history($status ='ALL', $page =1, $clear_filter='no')
	{
		$other_config = array(
			'addAllow'=>'no',
			'editAllow'=>'no',
			'default_order'=>'desc',
			'display_status'=>'no',
			'deleteAllow'=>'no',
			'statusChangeAllow'=>'no',
			'personal_where'=>" lead_generation_id!='' and action = 'Assign' and user_type ='Franchise' ",
		);
		if($clear_filter == 'yes'){
			$this->clear_filter('no');
		}
		$this->common_model->primary_key = 'assign_id';
		$this->common_model->created_on_fild = 'assign_date';
		$this->common_model->labelArr =  array('assign_to_name'=>'Assign To');
		//'assign_by','assign_by_email',
		$this->common_model->display_selected_field = array('id','username','email','assign_to_name','assign_date');
		$this->common_model->common_rander('lead_generation_assign_history_view', $status, $page, 'Assigned members to franchise','','assign_date',0,$other_config,'');
	}
	
	public function staff_lead_unassign_history($status ='ALL', $page =1, $clear_filter='no')
	{
		$this->common_model->status_arr = array();
		$this->common_model->status_arr_change = array();
		$this->common_model->assing_to_member = 'yes';
		$this->common_model->staffassign_arr_change = array('Assign_Staff'=>'Assign Staff');
		$this->common_model->franchiseassign_arr_change = array();
		if($clear_filter == 'yes')
		{
			$this->clear_filter('no');
		}
		$personal_where = array();
		$personal_where['where_per'] = " lead_generation_id!='' and user_type = 'Staff' and action='Unassigned' ";
		$this->common_model->member_or_lead = 'lead_generation';
		$this->assignment_reports_model->unassigned_lead_generation_list($status,$page,$personal_where,'staff');
	}
	public function franchise_lead_unassign_history($status ='ALL', $page =1, $clear_filter='no')
	{
		$this->common_model->primary_key ='lead_generation_id';
		$this->common_model->status_arr = array();
		$this->common_model->status_arr_change = array();
		$this->common_model->assing_to_member = 'yes';
		$this->common_model->staffassign_arr_change = array();
		$this->common_model->franchiseassign_arr_change = array('Assign_Franchise'=>'Assign Franchise');
		if($clear_filter == 'yes')
		{
			$this->clear_filter('no');
		}
		$personal_where = array();
		$personal_where['where_per'] = " lead_generation_id!='' and user_type = 'Franchise' and action='Unassigned' ";
		$this->common_model->member_or_lead = 'lead_generation';
		$this->assignment_reports_model->unassigned_lead_generation_list($status,$page,$personal_where,'franchise');
	}
	public function lead_generation_follow_up_report($status ='ALL', $page =1, $clear_filter='no')
	{
		$this->common_model->status_arr = array();
		$this->common_model->status_arr_change = array();
		$this->common_model->assing_to_member = 'yes';
		$this->common_model->staffassign_arr_change = array('Assign_Staff'=>'Assign Staff','Unassign_Staff'=>'Unassign Staff');
		$this->common_model->franchiseassign_arr_change = array('Assign_Franchise'=>'Assign Franchise','Unassign_Franchise'=>'Unassign Franchise');
		$personal_where = array();
		$personal_where['where_per'] = "";
		$access_perm = $this->common_model->check_permission('view_member','redirect');
		$other_config = $this->common_model->add_own_where('',$access_perm);
		if(isset($other_config['personal_where']) && $other_config['personal_where'] !='')
		{
			$personal_where['where_per'] = $other_config['personal_where'];
		}
		if($clear_filter == 'yes')
		{
			$this->clear_filter('no');
		}
		$this->common_model->member_or_lead = 'lead_generation';
		$this->assignment_reports_model->lead_follow_up_report($status,$page,$personal_where);
	}*/
	
	public function search_model()
	{
		$this->assignment_reports_model->save_session_search();
	}
	public function search()
	{
		$this->assignment_reports_model->save_session_search();
		redirect($this->common_model->base_url_admin.'member/advanced-search-result');
	}
	
	public function clear_filter($return='yes')
	{
		if($this->common_model->session_search_name !='')
		{
			$session_search_name = $this->common_model->session_search_name;
			$this->common_model->return_tocken_clear($session_search_name,$return);
		}
	}
}?>