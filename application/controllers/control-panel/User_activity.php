<?php defined('BASEPATH') OR exit('No direct script access allowed');
class User_activity extends CI_Controller {
	public $data = array();
	public function __construct()
	{
		parent::__construct();
		//$this->common_model->checkLogin(); // here check for login or not
		$this->common_model->check_admin_only_access();
	}
	public function index()
	{
		$this->express_interest();
	}
	public function express_interest($status ='ALL', $page =1)
	{		
		$other_config = array(
			'addAllow'=>'no',
			'editAllow'=>'no',
			'default_order'=>'desc',
			'display_status'=>'no',
			'statusChangeAllow'=>'no'
		);
		$this->common_model->created_on_fild = 'sent_date';
		$this->common_model->data_tabel_filedIgnore = array('id','status','trash_receiver','trash_sender','is_deleted');
		$this->common_model->common_rander('expressinterest', $status, $page , 'Express Interest','','sent_date',0,$other_config);
	}
	public function message($status ='ALL', $page =1)
	{		
		$other_config = array(
			'addAllow'=>'no',
			'editAllow'=>'no',
			'default_order'=>'desc',
			'display_status'=>'no',
			'statusChangeAllow'=>'no'
		);
		$this->common_model->created_on_fild = 'sent_on';
		$this->common_model->data_tabel_filedIgnore = array('id','status','read_status','important_status','trash_sender','trash_receiver','sender_delete','receiver_delete','is_deleted');
		$this->common_model->common_rander('message', $status, $page , 'Message','','sent_on',0,$other_config);
	}
	
	public function user_login_history($status ='ALL', $page =1)
	{	
		$other_config = array(
			'addAllow'=>'no',
			'editAllow'=>'no',
			'default_order'=>'desc',
			'display_status'=>'no',
			'statusChangeAllow'=>'no'
		);
		$this->common_model->created_on_fild = 'login_at';
		//$this->common_model->data_tabel_filedIgnore = array('is_deleted');
		$this->common_model->common_rander('user_login_history', $status, $page , 'User Login History','','login_at',0,$other_config);
	}
}