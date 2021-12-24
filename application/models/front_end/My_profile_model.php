<?php defined('BASEPATH') OR exit('No direct script access allowed');

class My_profile_model extends CI_Model {

	public $data = array();

	public function __construct()

	{

		parent::__construct();

	}

	

	public function save_profile($is_post = 0,$step='step1')

	{

		// $member_id = $this->common_front_model->get_user_id();

		$member_id = $this->common_front_model->get_session_data("id");
        
		$data1['tocken'] = $this->security->get_csrf_hash();

		$data1['status'] = 'error';

		if(!isset($member_id) || $member_id == '' )

		{

			$data1['errmessage'] =  "Sorry, Your session hase been time out, Please login Again";

			$data['data'] = json_encode($data1);

			return $data;

		}

		else

		{

			if(isset($_REQUEST['user_agent']) && $_REQUEST['user_agent'] =='NI-AAPP')

			{

				$step = '';

				if(isset($_REQUEST["mobile_num"]))

				{

					$_REQUEST['mobile'] = $this->input->post('country_code').'-'.$this->input->post('mobile_num');

					$count_mobile = $this->common_model->get_count_data_manual('register',array('mobile'=>$_REQUEST['mobile'],'is_deleted'=>'No'),2,'id');

					

					if(isset($count_mobile) && is_array($count_mobile) && count($count_mobile)>0)

					{

						$mob_check_var = 1;

						foreach($count_mobile as $m_row){

							if($m_row["id"]!=$member_id){

								$mob_check_var = 0;

							}

						}

						if($mob_check_var==0){

							$data1['errmessage'] =  "Duplicate Mobile Number found, please enter another one";	

							$data['data'] = json_encode($data1);

							return $data;

						}else{

							$data1['status'] = 'success';

						}

					}

				}

				else

				{

						$data1['status'] = 'success';

				}

			}

			else

			{

				if($step =='basic-detail')

				{

					$this->basic_detail();

				}

				else if($step =='residence-detail')

				{

					$this->residence_detail();

					if(isset($_REQUEST['mobile']))

					{

						$this->common_model->field_duplicate = array('mobile');

					}

				}

			}

			$this->common_model->set_table_name('register');

			$_REQUEST['mode'] ='edit';

			$_REQUEST['id'] =$member_id;

			//print_r($_REQUEST);

			/*if(

			( (isset($_REQUEST['bodytype']) && $_REQUEST['bodytype']=='') && (isset($_REQUEST['diet']) && $_REQUEST['diet']=='') && (isset($_REQUEST['smoke']) && $_REQUEST['smoke']=='') && (isset($_REQUEST['drink']) && $_REQUEST['drink']=='') && (isset($_REQUEST['complexion']) && $_REQUEST['complexion']=='') && (isset($_REQUEST['blood_group']) && $_REQUEST['blood_group']=='') )

			 || ( (isset($_REQUEST['part_country_living']) && $_REQUEST['part_country_living']=='') && (isset($_REQUEST['part_state']) && $_REQUEST['part_state']=='') && (isset($_REQUEST['part_city']) && $_REQUEST['part_city']=='') && (isset($_REQUEST['part_resi_status']) && $_REQUEST['part_resi_status']=='') )

			){

				$data1['errmessage'] = 'Data not updated';

				$data1['status'] = 'error';

			}

			else{*/

				$response = $this->common_model->save_update_data(1,1);

			

				$data1 = json_decode($response, true);

				if(isset($data1['status']) && $data1['status'] =='success')

				{

					$data1['errmessage'] =  "<i class='fa fa-check text-success'></i> Your profile has been updated successfully.";

					$data1['status'] = 'success';

					if($step =='basic-detail' && isset($_REQUEST['username']) && $_REQUEST['username'] !='')

					{

						$row_data_cuur = $this->session->userdata('mega_user_data');

						if($row_data_cuur !='' && count($row_data_cuur) > 0)

						{

							$row_data_cuur['username'] = $_REQUEST['username'];

							$row_data_cuur['firstname'] = $_REQUEST['firstname'];

							$row_data_cuur['lastname'] = $_REQUEST['lastname'];

							$this->session->set_userdata('mega_user_data', $row_data_cuur);

						}

					}

				}

				else

				{

					$data1['errmessage'] = strip_tags($data1['response']);

					unset($data1['response']);

				}

			//}

			if($is_post == 0)

			{

				if(isset($_REQUEST['user_agent']) && $_REQUEST['user_agent'] =='NI-AAPP')

				{

					if(isset($data1['response']))

					{

						unset($data1['response']);

					}

					$data1['errmessage'] = strip_tags($data1['errmessage']);

				}

				$data['data'] = json_encode($data1);

				return $data;

			}

			else

			{

				if(isset($data1['status']) && $data1['status'] == 'success')

				{

					$this->session->set_flashdata('success_message', "<div class='alert alert-success'><i class='fa fa-check text-success'></i> Your profile has been updated successfully.</div>");

					return 'success';

				}

				else 

				{

					if(isset($data1['errmessage']) && $data1['errmessage'] !='')

					{

						$this->session->set_flashdata('error_message', "<div class='alert alert-danger'>".$data1['errmessage']."</div>");

					}

					return 'error';

				}

			}

		}

	}

	function basic_detail()

	{

		$username = '';

		if($this->input->post('firstname') && $this->input->post('firstname') !='')

		{

			$username = $this->input->post('firstname');

		}

		if($this->input->post('lastname') && $this->input->post('lastname') !='')

		{

			$username = $username.' '.$this->input->post('lastname');

		}

		if($username !='')

		{

			$_REQUEST['username'] = $username;

		}

		$birth_date = '';

		$birth_month = '';

		$birth_year = '';

		if($this->input->post('birth_date') && $this->input->post('birth_date') !='')

		{

			$birth_date = $this->input->post('birth_date');

		}

		if($this->input->post('birth_month') && $this->input->post('birth_month') !='')

		{

			$birth_month = $this->input->post('birth_month');

		}

		if($this->input->post('birth_year') && $this->input->post('birth_year') !='')

		{

			$birth_year = $this->input->post('birth_year');

		}

		if($birth_year !='' && $birth_date !='' && $birth_month !='')

		{

			$birthdate = $birth_year.'-'.$birth_month.'-'.$birth_date;

			$_REQUEST['birthdate'] = $birthdate;

		}

	}

	function residence_detail()

	{

		$mobile_num = '';

		$country_code = '';

		if(isset($_REQUEST['mobile_num']) && $_REQUEST['mobile_num'] !='')

		{

			$mobile_num = $_REQUEST['mobile_num'];

		}

		if(isset($_REQUEST['country_code']) && $_REQUEST['country_code'] !='')

		{

			$country_code = $_REQUEST['country_code'];

		}

		if($this->input->post('country_code') && $this->input->post('country_code') !='')

		{

			$country_code = $this->input->post('country_code');

		}

		if($this->input->post('mobile_num') && $this->input->post('mobile_num') !='')

		{

			$mobile_num = $this->input->post('mobile_num');

		}

		if($country_code !='' && $mobile_num !='')

		{

			$mobile = $country_code.'-'.$mobile_num;

			$_REQUEST['mobile'] = $mobile;

		}

		

	}

	function get_my_profile()

	{

		$data = '';

		$member_id = $this->common_front_model->get_session_data('id');

		if($member_id !='')

		{

			$data = $this->common_front_model->get_user_data('register_view',$member_id);

		}

		return $data;

	}

	function short_list_profile($post=0,$page='')

	{

		$user_agent = $this->input->post('user_agent') ? $this->input->post('user_agent') : 'NI-WEB';

		

		if($user_agent == 'NI-AAPP'){

			// $login_user_matri_id = $this->input->post('matri_id');
			$login_user_matri_id = $this->common_front_model->get_session_data('matri_id');


		}else{

			$login_user_matri_id = $this->common_front_model->get_session_data('matri_id');

		}

		

		$where_arra=array('shortlist.is_deleted'=>'No','shortlist.from_id'=>$login_user_matri_id);

		$this->common_model->set_table_name('shortlist');

		$this->db->join('register_view',' shortlist.to_id = register_view.matri_id ','left');

		

		if($post == 0)

		{	

			$data = $this->common_model->get_count_data_manual('shortlist',$where_arra,0,'');

		}

		else

		{
			
			$data = $this->common_model->get_count_data_manual('shortlist',$where_arra,2,'register_view.id as user_id,register_view.matri_id,register_view.username,register_view.gender,register_view.birthdate,register_view.height,register_view.weight,register_view.religion_name,register_view.caste_name,register_view.country_name,register_view.city_name,register_view.photo1,register_view.photo1_approve,register_view.photo_view_status,register_view.photo_protect,register_view.photo_password,register_view.is_deleted as deleted,shortlist.created_on,shortlist.id','shortlist.id desc',$page,10);

		}

		return $data;

	}

	function block_list_profile($post=0,$page='')

	{

		$user_agent = $this->input->post('user_agent') ? $this->input->post('user_agent') : 'NI-WEB';

			

		if($user_agent == 'NI-AAPP'){

			$login_user_matri_id = $this->common_front_model->get_session_data('matri_id');

			// $login_user_matri_id = $this->input->post('matri_id');

		}else{

			$login_user_matri_id = $this->common_front_model->get_session_data('matri_id');

		}

		

		$where_arra=array('block_profile.is_deleted'=>'No','block_profile.block_by'=>$login_user_matri_id);

		$this->common_model->set_table_name('block_profile');

		$this->db->join('register_view',' block_profile.block_to = register_view.matri_id ','left');

		

		if($post == 0)

		{	

			$data = $this->common_model->get_count_data_manual('block_profile',$where_arra,0,'');

		}

		else

		{

			$data = $this->common_model->get_count_data_manual('block_profile',$where_arra,2,'register_view.id as user_id,register_view.matri_id,register_view.username,register_view.gender,register_view.birthdate,register_view.height,register_view.weight,register_view.religion_name,register_view.caste_name,register_view.country_name,register_view.city_name,register_view.photo1,register_view.photo1_approve,register_view.photo_view_status,register_view.is_deleted as deleted,block_profile.created_on,block_profile.id','block_profile.id desc',$page,10);

		}

		return $data;

	}

	function i_viewed_profile($post=0,$page='')

	{

		$user_agent = $this->input->post('user_agent') ? $this->input->post('user_agent') : 'NI-WEB';

			

		if($user_agent == 'NI-AAPP'){

			$login_user_matri_id = $this->input->post('matri_id');

		}else{

			$login_user_matri_id = $this->common_front_model->get_session_data('matri_id');

		}

		

		$this->common_model->is_delete_fild = '';

		$where_arra=array('who_viewed_my_profile.my_id'=>$login_user_matri_id,"register_view.is_deleted"=>'No',"register_view.status!="=>'Suspended');

		$this->common_model->set_table_name('who_viewed_my_profile');

		$this->db->join('register_view',' who_viewed_my_profile.viewed_member_id = register_view.matri_id ','left');

		

		if($post == 0)

		{	

			$data = $this->common_model->get_count_data_manual('who_viewed_my_profile',$where_arra,0,'','',0);

		}

		else

		{

			$data = $this->common_model->get_count_data_manual('who_viewed_my_profile',$where_arra,2,'register_view.id as user_id,register_view.matri_id,register_view.username,register_view.gender,register_view.birthdate,register_view.height,register_view.weight,register_view.religion_name,register_view.caste_name,register_view.country_name,register_view.city_name,register_view.photo1,register_view.photo1_approve,register_view.photo_view_status,register_view.photo_protect,register_view.is_deleted as deleted,who_viewed_my_profile.created_on,who_viewed_my_profile.id','who_viewed_my_profile.id desc',$page,10,0);

		}

		return $data;

	}

	function who_viewed_profile($post=0,$page='')

	{

		$user_agent = $this->input->post('user_agent') ? $this->input->post('user_agent') : 'NI-WEB';

			

		if($user_agent == 'NI-AAPP'){

			$login_user_matri_id = $this->input->post('matri_id');

		}else{

			$login_user_matri_id = $this->common_front_model->get_session_data('matri_id');

		}

		//$login_user_matri_id = $this->common_front_model->get_session_data('matri_id');

		$this->common_model->is_delete_fild = '';

		$where_arra=array('who_viewed_my_profile.viewed_member_id'=>$login_user_matri_id);

		$this->common_model->set_table_name('who_viewed_my_profile');

		$this->db->join('register_view',' who_viewed_my_profile.my_id = register_view.matri_id ','left');

		

		if($post == 0)

		{	

			$data = $this->common_model->get_count_data_manual('who_viewed_my_profile',$where_arra,0,'','',0);

		}

		else

		{

			$data = $this->common_model->get_count_data_manual('who_viewed_my_profile',$where_arra,2,'register_view.id as user_id,register_view.matri_id,register_view.username,register_view.gender,register_view.birthdate,register_view.height,register_view.weight,register_view.religion_name,register_view.caste_name,register_view.country_name,register_view.city_name,register_view.photo1,register_view.photo1_approve,register_view.photo_view_status,register_view.photo_protect,register_view.is_deleted as deleted,who_viewed_my_profile.created_on,who_viewed_my_profile.id','who_viewed_my_profile.id desc',$page,10,0);

		}

		return $data;

	}

	public function check_unblock_status()

	{

		$status = '';

		$id = '';

		$block_by = $this->common_front_model->get_session_data('matri_id');

		if($this->input->post('status') !='')

		{

			$status = $this->input->post('status');

		}

		if($this->input->post('id') !='')

		{

			$id = $this->input->post('id');

		}

		if($this->input->post('block_to') !='')

		{

			$block_to = $this->input->post('block_to');

		}

		if($status !='' && $id !='' && $block_to !='')

		{

			 $where_arra = array('id'=>$id,'block_by'=>$block_by,'block_to'=>$block_to);

			 $this->common_model->data_delete_common('block_profile',$where_arra,0,'id');

			 $data1['status'] = 'unblock';

			 $data1['message'] = "Your request for member unblocking is successfully done.";

			 

			 $this->data['page_name'] = 'Block Listed Profile';

			 $this->data['base_url'] = base_url();

			 $this->data['shortlist_data_count'] = $this->my_profile_model->block_list_profile(0);

			 $this->data['shortlist_data'] = $this->my_profile_model->block_list_profile(1,1);

			 $data1['block_profile_code'] = $this->load->view('front_end/short_listed_member_profile',$this->data,true); 

			 $data['data'] = json_encode($data1);

			 $data1['token'] = $this->security->get_csrf_hash();

			 $this->load->view('common_file_echo',$data);

		}

	}

	

	

	function photo_pass_request_received($post=0,$page='')

	{

		if($this->input->post('matri_id') && $this->input->post('matri_id')!='')

		{

			$login_user_matri_id = $this->input->post('matri_id');

		}

		else

		{

			$login_user_matri_id = $this->common_front_model->get_session_data('matri_id');

		}

		$where_arra=array('p.ph_receiver_id'=>$login_user_matri_id,'p.rec_delete' => 'No');

		$this->db->join('register','p.ph_requester_id = register.matri_id');

		if($post == 0){

			$data = $this->common_model->get_count_data_manual('photoprotect_request p',$where_arra,0,'','p.ph_reqid desc','','','','');

		}else{

			$data = $this->common_model->get_count_data_manual('photoprotect_request p',$where_arra,2,'p.ph_reqid,p.ph_requester_id,p.ph_receiver_id,p.ph_msg,p.ph_reqdate,p.receiver_response,p.status,p.rec_delete,p.sen_delete,register.id as user_id,register.photo1,register.photo_view_status,register.photo1_approve,register.username,register.matri_id','p.ph_reqid desc',$page,'','','','');

		}

		return $data;

	}

	

	function send_photo_pass()

	{

		$user_agent = $this->input->post("user_agent");

		if($user_agent=='NI-AAPP'){

			$login_user_matri_id = $this->input->post("matri_id");

		}else{

			$login_user_matri_id = $this->common_front_model->get_session_data('matri_id');

		}

		$to_matri_id = $_REQUEST['requester_id'];

		$check_count = $this->common_model->get_count_data_manual('photoprotect_request',array('ph_receiver_id'=>$login_user_matri_id, 'ph_requester_id'=>$to_matri_id, 'receiver_response' => 'Accepted'),0,'','','','',0);

		//echo $this->db->last_query();

		if($check_count<=0){

			$data_receiver = $this->common_model->get_count_data_manual('register','matri_id = "'.$to_matri_id.'"',1,'username,email');

			if(isset($data_receiver) && $data_receiver !='' && count($data_receiver) > 0 ){

				$username = $this->common_front_model->get_session_data('username');

				

				$receiver = $data_receiver['username'];

				$to_email = $data_receiver['email'];

				

				$config_arra = $this->common_model->get_site_config();

				$webfriendlyname = $config_arra['web_frienly_name'];

				

				$subject = "Your requested Photo Request of $login_user_matri_id for $webfriendlyname";

				$message = "<body>

					<div>Hello Dear $receiver,</div>

					<p>Thank you for requesting member's Photo Request.</p>

					<p>&nbsp;</p><p>&nbsp;</p>

					<p><b style='background:#f3f3f3;font-size:13px;color:#096b53'>

						Here is your Requested Photo Info<br>

						Member : $username ($login_user_matri_id)<br>

						

					</b></p>

					<p>&nbsp;</p><p>&nbsp;</p>

					<p>Thank you for choosing us to reach you better.</p>

					<p>&nbsp;</p>

					<p>Regards,<br />

					$webfriendlyname</p>

					<p>&nbsp;</p>

					</body>";

			

					$data['result'] = $this->common_model->common_send_email($to_email,$subject,$message,'','','');

			

					if($data['result'] == 'Email sent.'){

						$data['response'] = 'Request Accepted Successfully.';

						$data['status'] = 'success';

						

						$this->common_model->update_insert_data_common('photoprotect_request',array('receiver_response' => 'Accepted'),array('ph_receiver_id'=>$login_user_matri_id, 'ph_requester_id'=>$to_matri_id));

					}

					else{

						$data['response'] = 'Try again.';

						$data['status'] = 'error';

					}

				}

				else{

					$data['response'] = 'Please try again';

					$data['status'] = 'error';	

				}

			}else{

				$data['response'] = 'Password already send!!!';

				$data['status'] = 'error';

			}

			if($user_agent!='NI-AAPP'){

				$data1['photo_pass_count'] = $this->my_profile_model->photo_pass_request_received(0);

				$data1['photo_pass_data'] = $this->my_profile_model->photo_pass_request_received(1,1);

				

				$data['profile_code'] = $this->load->view('front_end/photo_pass_request_received_ajax',$data1,true); 

			}

				

		$data['tocken'] = $this->security->get_csrf_hash();

		$data1 = json_encode($data);

		$data['data'] = $data1;

        $this->load->view('common_file_echo',$data);

	}

	

	function reject_request()

	{

		$user_agent = $this->input->post("user_agent");

		if(isset($_REQUEST['requester_id']))

		{

			$ph_reqid=$_REQUEST['requester_id'];

			

			if(isset($_REQUEST['status']) && $_REQUEST['status'] == 'receiver' ){

				$this->common_model->update_insert_data_common('photoprotect_request',array('receiver_response' => 'Rejected'),array('ph_reqid'=>$ph_reqid));

				

				$data1['photo_pass_count'] = $this->my_profile_model->photo_pass_request_received(0);

				$data1['photo_pass_data'] = $this->my_profile_model->photo_pass_request_received(1,1);

				

				if($user_agent!='NI-AAPP')

					$data['profile_code'] = $this->load->view('front_end/photo_pass_request_received_ajax',$data1,true);

					

				$data['response'] = 'Request Successfully Rejected...!!!';

				$data['status'] = 'success';

			}

			if(isset($_REQUEST['status']) && $_REQUEST['status'] == 'Accepted' ){

				$this->common_model->update_insert_data_common('photoprotect_request',array('receiver_response' => 'Accepted'),array('ph_reqid'=>$ph_reqid));

				

				$data1['photo_pass_count'] = $this->my_profile_model->photo_pass_request_received(0);

				$data1['photo_pass_data'] = $this->my_profile_model->photo_pass_request_received(1,1);

				

				if($user_agent!='NI-AAPP')

					$data['profile_code'] = $this->load->view('front_end/photo_pass_request_received_ajax',$data1,true); 



				$data['response'] = 'Request Successfully Accepted...!!!';

				$data['status'] = 'success';			

				//app push notification

				$ph_receiver_id = $ph_reqid;

				$send_data = $this->common_front_model->get_user_data('register',$ph_receiver_id,'ios_device_id,android_device_id','id');

				if(isset($send_data) && $send_data!='' && count($send_data)>0)

				{

					foreach ($send_data as $key => $value) {

						if(isset($value) && $value!='' && isset($key) && $key!='')

						{

							$send_message = 'Photo request send by '.$ph_reqid;

							$this->common_model->new_send_notification_android($value,$send_message,'Photo Request','photo_password','send');

						}

					}	

				}		

			}

			if(isset($_REQUEST['status']) && $_REQUEST['status'] == 'Rejected' ){

				$this->common_model->update_insert_data_common('photoprotect_request',array('receiver_response' => 'Rejected'),array('ph_reqid'=>$ph_reqid));

				

				$data1['photo_pass_count'] = $this->my_profile_model->photo_pass_request_received(0);

				$data1['photo_pass_data'] = $this->my_profile_model->photo_pass_request_received(1,1);

				

				if($user_agent!='NI-AAPP')

					$data['profile_code'] = $this->load->view('front_end/photo_pass_request_received_ajax',$data1,true); 

				

				$data['response'] = 'Request Successfully Rejected...!!!';

				$data['status'] = 'success';

			}			

		}else{

			$data['response'] = 'Please try again...!!!';

			$data['status'] = 'fail';

		}



		$data['tocken'] = $this->security->get_csrf_hash();

		$data['data'] = json_encode($data);

		$this->load->view('common_file_echo',$data);

	}



	function delete_request()

	{

		$user_agent = $this->input->post("user_agent");

		if(isset($_REQUEST['requester_id']))

		{

			$ph_reqid=$_REQUEST['requester_id'];

			if(isset($_REQUEST['status']) && $_REQUEST['status']=='sender'){		

				$this->common_model->update_insert_data_common('photoprotect_request',array('sen_delete' => 'Yes'),array('ph_reqid'=>$ph_reqid));

				

				$data1['photo_pass_count'] = $this->my_profile_model->photo_pass_request_sent(0);

				$data1['photo_pass_data'] = $this->my_profile_model->photo_pass_request_sent(1,1);				

				if($user_agent!='NI-AAPP')

					$data['profile_code'] = $this->load->view('front_end/photo_pass_request_sent_ajax',$data1,true); 

			}

			

			if(isset($_REQUEST['status']) && $_REQUEST['status'] == 'receiver' ){

				$this->common_model->update_insert_data_common('photoprotect_request',array('rec_delete' => 'Yes'),array('ph_reqid'=>$ph_reqid));

				

				$data1['photo_pass_count'] = $this->my_profile_model->photo_pass_request_received(0);

				$data1['photo_pass_data'] = $this->my_profile_model->photo_pass_request_received(1,1);

				

				if($user_agent!='NI-AAPP')

					$data['profile_code'] = $this->load->view('front_end/photo_pass_request_received_ajax',$data1,true); 

			}

			$data['errmessage'] = 'Request Successfully deleted...!!!';

			$data['status'] = 'success';

			

		}else{

			$data['errmessage'] = 'Please try again...!!!';

			$data['status'] = 'fail';

		}



		$data['tocken'] = $this->security->get_csrf_hash();

		$data['data'] = json_encode($data);

		$this->load->view('common_file_echo',$data);

	}

	

	function photo_pass_request_sent($post=0,$page='')

	{

		

		if($this->input->post('matri_id') && $this->input->post('matri_id')!='')

		{

			$login_user_matri_id = $this->input->post('matri_id');

		}

		else

		{

			$login_user_matri_id = $this->common_front_model->get_session_data('matri_id');

		}

		//$login_user_matri_id = $this->common_front_model->get_session_data('matri_id');

		$where_arra=array('p.ph_requester_id'=>$login_user_matri_id,'p.sen_delete' => 'No');

		

		if($post == 0){	

			$this->db->join('register','p.ph_receiver_id = register.matri_id');

			$data = $this->common_model->get_count_data_manual('photoprotect_request p',$where_arra,0,'','','','','','');

		}else{

			$this->db->join('register','p.ph_receiver_id = register.matri_id');

			$data = $this->common_model->get_count_data_manual('photoprotect_request p',$where_arra,2,'p.ph_reqid,p.ph_requester_id,p.ph_receiver_id,p.ph_msg,p.ph_reqdate,p.receiver_response,p.status,p.rec_delete,p.sen_delete,register.id as user_id,register.photo1,register.photo_view_status,register.photo1_approve,register.username,register.matri_id','',$page,'','','','');

			

		}

		

	

		return $data;

	}

	

	function like_profile($post=0,$page='')

	{

		$user_agent = $this->input->post('user_agent') ? $this->input->post('user_agent') : 'NI-WEB';

			

		if($user_agent == 'NI-AAPP'){

			// $login_user_matri_id = $this->input->post('matri_id');
			$login_user_matri_id = $this->common_front_model->get_session_data('matri_id');

		}else{

			$login_user_matri_id = $this->common_front_model->get_session_data('matri_id');

		}

		//$login_user_matri_id = $this->common_front_model->get_session_data('matri_id');

		

		$where_arra=array('member_likes.is_deleted'=>'No','member_likes.like_status'=>'Yes','member_likes.my_id'=>$login_user_matri_id,"register_view.status!="=>'Suspended');

		$this->common_model->set_table_name('member_likes');

		$this->db->join('register_view',' member_likes.other_id = register_view.matri_id ','left');

		

		if($post == 0)

		{	

			$data = $this->common_model->get_count_data_manual('member_likes',$where_arra,0,'');

		}

		else

		{

			$data = $this->common_model->get_count_data_manual('member_likes',$where_arra,2,'register_view.id as user_id,register_view.matri_id,register_view.username,register_view.gender,register_view.birthdate,register_view.height,register_view.weight,register_view.religion_name,register_view.caste_name,register_view.country_name,register_view.city_name,register_view.photo1,register_view.photo1_approve,register_view.photo_view_status,register_view.photo_protect,register_view.is_deleted as deleted,member_likes.created_on,member_likes.id','member_likes.id desc',$page,10);

		}

		return $data;

	}

	

	function unlike_profile($post=0,$page='')

	{

		$user_agent = $this->input->post('user_agent') ? $this->input->post('user_agent') : 'NI-WEB';

		

		if($user_agent == 'NI-AAPP'){

			// $login_user_matri_id = $this->input->post('matri_id');
			$login_user_matri_id = $this->common_front_model->get_session_data('matri_id');


		}else{

			$login_user_matri_id = $this->common_front_model->get_session_data('matri_id');

		}

		//$login_user_matri_id = $this->common_front_model->get_session_data('matri_id');

		

		$where_arra=array('member_likes.is_deleted'=>'No','member_likes.like_status'=>'No','member_likes.my_id'=>$login_user_matri_id);

		$this->common_model->set_table_name('member_likes');

		$this->db->join('register_view',' member_likes.other_id = register_view.matri_id ','left');

		

		if($post == 0)

		{	

			$data = $this->common_model->get_count_data_manual('member_likes',$where_arra,0,'');

		}

		else

		{

			$data = $this->common_model->get_count_data_manual('member_likes',$where_arra,2,'register_view.id as user_id,register_view.matri_id,register_view.username,register_view.gender,register_view.birthdate,register_view.height,register_view.weight,register_view.religion_name,register_view.caste_name,register_view.country_name,register_view.city_name,register_view.photo1,register_view.photo1_approve,register_view.photo_view_status,register_view.photo_protect,register_view.is_deleted as deleted,member_likes.created_on,member_likes.id','member_likes.id desc',$page,10);

		}

		return $data;

	}

	

	public function common_delete_list_all_profile()

	{

		$user_id='';

		$matri_id='';

		$page_name='';

		

		$user_agent = $this->input->post('user_agent') ? $this->input->post('user_agent') : 'NI-WEB';

		

		if($user_agent == 'NI-AAPP'){

			$user_id = $this->input->post('user_id');

		}else{

			$user_id = $this->common_front_model->get_session_data('matri_id');

		}

		

		if($this->input->post('matri_id') !='')

		{

			$matri_id = $this->input->post('matri_id');

		}

		if($this->input->post('page_name') !='')

		{

			$page_name = $this->input->post('page_name');

		}

		$this->data['page_name'] = $page_name;

		$this->data['base_url'] = base_url();

		

		if($matri_id !='' && $page_name !='' )

		{

			if(isset($page_name) && $page_name == 'Short Listed Profile'){

				

				$where_arra = array('to_id'=>$matri_id,'from_id'=>$user_id);

			

				$this->common_model->data_delete_common('shortlist',$where_arra,0,'id');

				

				if($user_agent == 'NI-AAPP'){

					$success = 'success';

				}else{

					$success = 'success';

					

					$this->data['shortlist_data_count'] = $this->my_profile_model->short_list_profile(0);

					$this->data['shortlist_data'] = $this->my_profile_model->short_list_profile(1,1);

					$data1['profile_code'] = $this->load->view('front_end/short_listed_member_profile',$this->data,true); 

				}

				

			}elseif(isset($page_name) && $page_name == 'I Viewed Profile'){

				

				$where_arra = array('viewed_member_id'=>$matri_id,'my_id'=>$user_id);

			

				$this->common_model->data_delete_common('who_viewed_my_profile',$where_arra,0,'id');

				

				if($user_agent == 'NI-AAPP'){

					$success = 'success';

				}else{

					$success = 'success';

					$this->data['shortlist_data_count'] = $this->my_profile_model->i_viewed_profile(0);

					$this->data['shortlist_data'] = $this->my_profile_model->i_viewed_profile(1,1);

					$data1['profile_code'] = $this->load->view('front_end/short_listed_member_profile',$this->data,true); 

				}

			}elseif(isset($page_name) && $page_name == 'Who Viewed My Profile'){

				

				$where_arra = array('viewed_member_id'=>$user_id,'my_id'=>$matri_id);

			

				$this->common_model->data_delete_common('who_viewed_my_profile',$where_arra,0,'id');

				

				if($user_agent == 'NI-AAPP'){

					$success = 'success';

				}else{

					$success = 'success';

					$this->data['shortlist_data_count'] = $this->my_profile_model->who_viewed_profile(0);

					$this->data['shortlist_data'] = $this->my_profile_model->who_viewed_profile(1,1);

					$data1['profile_code'] = $this->load->view('front_end/short_listed_member_profile',$this->data,true);  

				}

			}else{

				$success = 'error';

			}

			

			if($success == 'success'){

				$data1['status'] = 'success';

				$data1['message'] = "Delete successfully done.";

			}else{

				if($user_agent == 'NI-AAPP'){

					$data1['status'] = 'error';

					$data1['message'] = "Please try again.";

				}else{

					$data1['status'] = 'error';

					$data1['message'] = "Please try again.";

					$data1['profile_code'] = 'No data available.';

				}

			}

			

		}else{

			if($user_agent == 'NI-AAPP'){

				$data1['status'] = 'error';

				$data1['message'] = "Please try again.";

			}else{

				$data1['status'] = 'error';

				$data1['message'] = "Please try again.";

				$data1['profile_code'] = 'No data available.';

			}

		}

		

		$data1['token'] = $this->security->get_csrf_hash();

		$data['data'] = json_encode($data1);

		$this->load->view('common_file_echo',$data);

	}

	

	public function delete_pro_req_chk($id='')

	{

		$del_req_count = 0;

		if($id!='')

		{

			$where_arra = array('sender'=>$id,'is_deleted'=>'No');

			$del_req_count = $this->common_front_model->get_count_data_manual('delete_profile_request',$where_arra,0,'id','id desc','','','');

		}

		return $del_req_count;

	}

	public function send_delete_reason_admin()

	{

		$user_agent = $this->input->post('user_agent') ? $this->input->post('user_agent') : 'NI-WEB';

		$subject="Hello Admin";

		$to="Admin";

		$date = $this->common_model->getCurrentDate();//date('Y-m-d H:i:s');

		if($user_agent == 'NI-AAPP')

		{

			$from = $this->input->post('matri_id');

			$where_arra=array('matri_id'=>$from,'is_deleted'=>'No',"status !='UNAPPROVED' and status !='Suspended'");

			$user_data = $this->common_model->get_count_data_manual('register',$where_arra,1,'username');

			if(isset($user_data) && $user_data!='')

			{

				$username = $user_data['username'];

			}

			else

			{

				$username = '';

			}

			$reason = $this->input->post('reason');

			$data_array = array(

				'sender'=>$from,

				'reason'=>$reason,

				'sent_on'=>$date,

				'is_deleted'=>'No'

				);

			$check_if_req_exitst = $this->delete_pro_req_chk($from);

	

			if($check_if_req_exitst > 0)

			{

				$data1['status'] = 'error';

				$data1['errmessage'] = "Your profile delete request is already under consideration. Please have patience while it is being processed.";	

			}

			else

			{

				$response = $this->common_front_model->save_update_data('delete_profile_request',$data_array);

				$config_arra = $this->common_model->get_site_config();

				$web_name = $config_arra['web_name'];

				$webfriendlyname = $config_arra['web_frienly_name'];

			    $admin_main = $config_arra['contact_email'];

				

				$message = "<html>

					<head>

					</head>

					<body>

						<p>Dear $to,</p>

						

						<p><strong>Delete Request Reason :</strong><br /></p>

						<p>$reason</p>

						

						<p>Thank You<br />$username ($from)</p>

						<br />

						<p>Regards ,<br />

						   $webfriendlyname,<br />

						   $web_name

						</p>

					</body>

					</html>";

				$email_subject = "$from has been request for delete profile on - $webfriendlyname";

				

				if($admin_main !="" && $message !="")

				{

					$this->common_model->common_send_email($admin_main,$email_subject,$message);

				}

				$data1['status'] = 'success';

				$data1['errmessage'] = "Your request for deleting your profile has been submitted successfully.";

			}

			$data1['token'] = $this->security->get_csrf_hash();

			$data['data'] = json_encode($data1);

			$this->load->view('common_file_echo',$data);

		}

		else

		{

			$from = $this->common_front_model->get_session_data('matri_id');

			$username = $this->common_front_model->get_session_data('username');

			$reason = $_POST['reason'];

			$status='sent';

			$data_array = array(

				'sender'=>$from,

				'reason'=>$reason,

				'sent_on'=>$date,

				'is_deleted'=>'No'

				);

				

				$check_if_req_exitst = $this->delete_pro_req_chk($from);

		

				if($check_if_req_exitst > 0)

				{

					$this->session->set_flashdata('error_message','Your profile delete request is already under consideration. Please have patience while it is being processed.');

				}

				else

				{

					$response = $this->common_front_model->save_update_data('delete_profile_request',$data_array);

								

					$config_arra = $this->common_model->get_site_config();

					$web_name = $config_arra['web_name'];

					$webfriendlyname = $config_arra['web_frienly_name'];

					$admin_main = $config_arra['contact_email'];

					

					$message = "<html>

						<head>

						</head>

						<body>

							<p>Dear $to,</p>

							

							<p><strong>Delete Request Reason :</strong><br /></p>

							<p>$reason</p>

							

							<p>Thank You<br />$username ($from)</p>

							<br />

							<p>Regards ,<br />

							   $webfriendlyname,<br />

							   $web_name

							</p>

						</body>

						</html>";

					$email_subject = "$from has been request for delete profile on - $webfriendlyname";

					

					if($admin_main !="" && $message !="")

					{

						$this->common_model->common_send_email($admin_main,$email_subject,$message);

					}

					$data = json_encode($response);

					$this->session->set_flashdata('success_message','Your request for deleting your profile has been submitted successfully.');

			}

			redirect($this->base_url.'my-profile/delete_request_to_admin');

		}

			

	}

}

?>