<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Express_interest_model extends CI_Model {
	public $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->mode_exp = '';
		$this->table_name = 'expressinterest';
	}
	
	function all_sent_interest($post=0,$page='')
	{
		$mode_exp = '';	
		if($this->input->post('exp_status') !='')
		{
			$mode_exp = $this->input->post('exp_status');
		}
		if($mode_exp == '' )
		{
			$mode_exp = 'all_sent';
		}
		$this->mode_exp = $mode_exp;
		
		$member_id = $this->common_front_model->get_user_id();
		$where_arra = array('id'=>$member_id);  
		$row_data = $this->common_model->get_count_data_manual('register',$where_arra,1,'matri_id');
		$login_user_matri_id = $row_data['matri_id'];
		//$login_user_matri_id = $this->common_front_model->get_user_id('matri_id','matri_id');
		
		$this->common_model->set_table_name($this->table_name);
		if($mode_exp =='all_sent' || $mode_exp =='accept_sent' || $mode_exp =='reject_sent' || $mode_exp =='pending_sent')
		{
			$where_arra=array('expressinterest.sender'=>$login_user_matri_id,'expressinterest.trash_sender'=>'No');
			$this->db->join('register_view','expressinterest.receiver = register_view.matri_id ','left');
		}
		else if($mode_exp =='all_receive' || $mode_exp =='accept_receive' || $mode_exp =='reject_receive' || $mode_exp =='pending_receive')
		{
			$where_arra=array('expressinterest.receiver'=>$login_user_matri_id,'expressinterest.trash_receiver'=>'No',"register_view.is_deleted"=>'No');
			$this->db->join('register_view','expressinterest.sender = register_view.matri_id ','left');
		}
		if($mode_exp =='accept_sent' || $mode_exp =='accept_receive')
		{
			$where_arra['expressinterest.receiver_response']='Accepted';
		}
		else if($mode_exp =='reject_sent' || $mode_exp =='reject_receive')
		{
			$where_arra['expressinterest.receiver_response']='Rejected';
		}
		else if($mode_exp =='pending_sent' || $mode_exp =='pending_receive')
		{
			$where_arra['expressinterest.receiver_response']='Pending';
		}
		//$where_arra = array('register_view.is_deleted' => 'No', "register_view.status !='UNAPPROVED' and register_view.status !='Suspended'");
		if($post == 0)
		{	
			$data = $this->common_model->get_count_data_manual($this->table_name,$where_arra,0,'');
		}
		else
		{
			$data = $this->common_model->get_count_data_manual($this->table_name,$where_arra,2,'register_view.id as user_id,register_view.matri_id,register_view.username,register_view.gender,register_view.birthdate,register_view.height,register_view.weight,register_view.religion,register_view.religion_name,register_view.caste_name,register_view.caste,register_view.country_name,register_view.city_name,register_view.photo1,register_view.photo1_approve,register_view.photo2,register_view.photo3,register_view.photo4,register_view.photo5,register_view.photo6,register_view.photo_view_status,register_view.photo_password,register_view.photo_protect,register_view.last_login,register_view.birthdate,register_view.mtongue_name,register_view.occupation_name,register_view.education_detail,register_view.state_name,register_view.is_deleted as deleted,expressinterest.*','expressinterest.id desc',$page,10);
		}
		/*echo $this->common_model->last_query();
		echo '<br/><br/>';*/
		return $data;
	}
	public function check_for_update_status()
	{
		$user_agent = $this->input->post('user_agent') ? $this->input->post('user_agent') : 'NI-WEB';
		
		$status = '';
		$id = '';
		if($this->input->post('status') !='')
		{
			$status = $this->input->post('status');
		}
		if($this->input->post('id') !='')
		{
			$id = $this->input->post('id');
			$data_id = $this->input->post('id');
		}
		if($status !='' && $id !='')
		{
			$mode_exp = '';	
			if($this->input->post('exp_status') !='')
			{
				$mode_exp = $this->input->post('exp_status');
			}
			if($mode_exp == '' )
			{
				$mode_exp = 'all_sent';
			}
			if($status =='delete')
			{
				$coulmn_name = 'trash_sender';
				if($mode_exp !='' && in_array($mode_exp,array('all_receive','accept_receive','reject_receive','pending_receive')))
				{
					$coulmn_name = 'trash_receiver';
				}
				if($coulmn_name !='')
				{
					$data_array = array($coulmn_name=>'Yes','is_deleted'=>'Yes');
					$success_message = "Data Deleted Successfully";
				}
			}
			else if($status =='reject')
			{
				$data_array = array('receiver_response'=>'Rejected','reminder_status'=>'No');
				$success_message = "Express interest rejected successfully";
			}
			else if($status =='accept')
			{
				$data_array = array('receiver_response'=>'Accepted','reminder_status'=>'No');
				$success_message = "Express interest accepted successfully";
				$accept_status='Yes';
				// need to send sms and email 
			}
			else if($status =='reminder')
			{
				$data_array = array('reminder_status'=>'Yes');
				$success_message = "Reminder sent successfully";
				$reminder_mail = "yes";
			}
			if(isset($data_array) && $data_array !='' && count($data_array))
			{
				if($id !='' && !is_array($id))
				{
					$id = explode(',',$id);
				}
				$where_arra = array('is_deleted'=>'No');
				$this->db->where_in('id',$id);
				$return = $this->common_model->update_insert_data_common($this->table_name,$data_array,$where_arra,1,0);
				$sender = '';
				$receiver = '';
				if(isset($reminder_mail) && $reminder_mail=='yes'){
					$this->db->where_in('id',$id);
					$data = $this->common_model->get_count_data_manual($this->table_name,'',1,'sender,receiver','');
					$sender = $data['sender'];
					$receiver = $data['receiver'];
					$email_temp_data = $this->common_front_model->getemailtemplate('Interest Reminder');
					$message = $email_temp_data['email_content'];
					$subject = $email_temp_data['email_subject'];
					$sender_data = $this->common_model->get_count_data_manual('register_view',array('matri_id'=>$sender),1,'*','');
					$user_data = $this->common_model->get_count_data_manual('register_view',array('matri_id'=>$receiver),1,'matri_id,username,email,mobile','');
							
					$username = $user_data['username'];
					$matri_id = $user_data['matri_id'];
					$email = $user_data['email'];
					
					$config_arra = $this->common_model->get_site_config();
					$web_name = $config_arra['web_name'];
					$webfriendlyname = $config_arra['web_frienly_name'];
					$facebook_link = $config_arra['facebook_link'];
					$twitter_link = $config_arra['twitter_link'];
					$google_link = $config_arra['google_link'];
					$linkedin_link = $config_arra['linkedin_link'];
					$footer_text = $config_arra['footer_text'];
					$contact_no = $config_arra['contact_no'];
					$from_email = $config_arra['from_email'];
					$android_app_link = $config_arra['android_app_link'];
					$template_image_url = $web_name.'assets/email_template';
					$login = $web_name.'login';
					$contact_us = $web_name.'contact';
					$part_basic_detail = $web_name.'my-profile/edit-profile/part-basic-detail';
					$member_data_html = '';
					if(isset($sender_data) && $sender_data!= ''){
						$path_photos = $this->common_model->path_photos;
						if(isset($sender_data['photo1']) && $sender_data['photo1']!='' && $sender_data['photo1_approve']=='APPROVED' && file_exists($path_photos.$sender_data['photo1'])){
							$defult_photo = $web_name.$path_photos.$sender_data['photo1'];
						}else{ 
							if(isset($sender_data['gender']) && $sender_data['gender'] == 'Male'){
								$defult_photo = $web_name.'assets/front_end/img/default-photo/male.png';
							}else{
								$defult_photo = $web_name.'assets/front_end/img/default-photo/female.png';
							}
						}
						$username111 = $sender_data['username'];
						$matri_id111 = $sender_data['matri_id'];
						$religion_name = $sender_data['religion_name'];
						$caste_name = $sender_data['caste_name'];
						$location = $sender_data['state_name'].', '.$sender_data['country_name'];
						$education_name = $sender_data['education_name'];
						$occupation_name = $sender_data['occupation_name'];
						$profile_link = $web_name.'search/view-profile/'.$sender_data['matri_id'];
						if(isset($sender_data['birthdate']) && $sender_data['birthdate'] !=''){
							$birthdate = $sender_data['birthdate'];
							$age = $this->common_model->birthdate_disp($birthdate,0);
						}
						else{
							$age = $this->common_model->display_data_na('');
						}
						if(isset($sender_data['height']) && $sender_data['height'] !=''){
							$height123 = $sender_data['height'];
							$height = $this->common_model->display_height($height123);
						}
						else{
							$height = $this->common_model->display_data_na('');
						}
		
						$member_data_html .='<div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">
							<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
								<tbody><tr><td colspan="5">&nbsp;</td></tr>
									<tr><td>&nbsp;</td><td>
										<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
											<tbody><tr><td>
												<div class="contentEditableContainer contentTextEditable">
													<div class="contentEditable" style="font-size:20px;color:#333333;">
														<div style="text-align:center;"><img style="width:150px; height:180px;" src="'.$defult_photo.'" /></div>
													</div>
												</div>
												</td></tr>
											<tr><td>&nbsp;</td></tr></tbody>
										</table>
									</td><td>&nbsp;</td><td>
										<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
											<tbody><tr><td>
													<div class="contentEditableContainer contentTextEditable">
														<div class="contentEditable" style="font-size:20px;color:#333333;">
															<div style="text-align:center;margin-top:-10px;">
																<p>'.$username111.' ('.$matri_id111.')</p>
															</div>
															<div class="contentEditable" style="font-size:14px;color:#333333;line-height:22px;text-align:center;">
																<p>'.$age.', '.$height.' | '.$religion_name.' : '.$caste_name.' | Location : '.$location.' | Education : '.$education_name.' | Occupation : '.$occupation_name.'</p>
																<a href="'.$profile_link.'" style="background: #01bcd5; border-radius: 8px; border: none; padding: 10px 25px; width: 80%; color: #fff;text-decoration:none;">View Profile</a>

															</div>
														</div>
													</div>
												</td></tr>
												<tr></tr>
											</tbody>
										</table>
									</td><td>&nbsp;</td></tr>
								</tbody>
							</table>
						</div>
						<div style="border-top: 1px solid #01bcd5;margin-top:20px;"></div>';
					}
					$array_repla = array('sender'=>$sender,'username'=>$username,'webfriendlyname'=>$webfriendlyname,'matri_id'=>$matri_id,"site_domain_name"=>$web_name,"facebook_link"=>$facebook_link,"twitter_link"=>$twitter_link,"linkedin_link"=>$linkedin_link,"footer_text"=>$footer_text,"template_image_url"=>$template_image_url,"contact_no"=>$contact_no,"from_email"=>$from_email,"contact_us"=>$contact_us,"android_app_link"=>$android_app_link,"part_basic_detail"=>$part_basic_detail,"member_data_html"=>$member_data_html);

					$message_email = $this->common_model->getstringreplaced($message,$array_repla);
					$subject = $this->common_model->getstringreplaced($subject,$array_repla);
					$to_email = $email;
					if($to_email !="" && $message !=""){
						$this->common_model->common_send_email($to_email,$subject,$message_email);
					}
				}
				if($return == true)
				{
					if(isset($success_message) && $success_message !='')
					{
						$this->session->set_flashdata('success_message',$success_message);
					}
					if($user_agent !='NI-WEB')
					{
						$data1['status'] = 'success';
						if(isset($accept_status) && $accept_status!=''){
							$interest_data = $this->common_front_model->get_user_data('register',$data_id,'ios_device_id,android_device_id','id');
							if(isset($interest_data) && $interest_data!='' && count($interest_data)>0){
								foreach ($interest_data as $key => $value) {
									if(isset($value) && $value!='' && isset($key) && $key!=''){
										$interest_message = 'You receive interest from ';
										$this->common_model->new_send_notification_android($value,$interest_message,'Interest Receive','interest_receive','send');
									}
								}	
							}
						}
						$data1['tocken'] = $this->security->get_csrf_hash();
						$data1['errormessage'] =  $success_message;
						$data1['errmessage'] =  $success_message;
						$data['data'] = json_encode($data1);
						$this->load->view('common_file_echo',$data);
					}
				}
				else
				{
					$this->session->set_userdata('error_message','Sorry Some error occurred, Please try again');
					
					if($user_agent !='NI-WEB')
					{
						$data1['status'] = 'error';
						$data1['tocken'] = $this->security->get_csrf_hash();
						$data1['errormessage'] =  "Sorry Some error occurred, Please try again";
						$data1['errmessage'] =  "Sorry Some error occurred, Please try again";
						$data['data'] = json_encode($data1);
						$this->load->view('common_file_echo',$data);
					}
				}
			}
		}
	}
}
?>