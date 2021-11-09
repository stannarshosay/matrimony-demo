<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Wedding_vendor extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->base_url = base_url();
		$this->data['base_url'] = $this->base_url;
		$this->load->model('front_end/contact_model');
		$this->common_front_model->last_member_activity();
	}
	public function index($page=1)
	{	
		$data['base_url']=$this->data['base_url'];
		$is_ajax = 0;
		if($this->input->post('is_ajax') && $this->input->post('is_ajax') !='')
		{
			$is_ajax = $this->input->post('is_ajax');
		}
		$where_arra=array('is_deleted'=>'No','status'=>'APPROVED');
		$this->data['wedding_planner_data_count']= $this->common_model->get_count_data_manual('wedd_planner_view',$where_arra,0,'id');
		$this->data['wedding_planner'] = $this->common_model->get_count_data_manual('wedd_planner_view',$where_arra,2,'*','id desc',$page);   
				
		if($is_ajax == 0)
		{	
			$this->common_model->extra_css_fr= array('css/fontello.css');
			$seo_data = $this->common_model->get_count_data_manual('seo_page_data',array('status'=>'APPROVED','page_title'=>'Wedding Vendor'),1,'*','','');
			$seo_title='';
			$seo_description ='';
			$seo_keywords='';
			$og_title = '';
			$og_description = '';
			$og_image = '';
			if(isset($seo_data['seo_title']) && $seo_data['seo_title'] !='')
			{
				$seo_title = $seo_data['seo_title'];
			}
			if(isset($seo_data['seo_description']) && $seo_data['seo_description'] !='')
			{
				$seo_description = $seo_data['seo_description'];
			}
			if(isset($seo_data['seo_keywords']) && $seo_data['seo_keywords'] !='')
			{
				$seo_keywords = $seo_data['seo_keywords'];
			}
			if(isset($seo_data['og_title']) && $seo_data['og_title'] !='')
			{
				$og_title = $seo_data['og_title'];
			}
			if(isset($seo_data['og_description']) && $seo_data['og_description'] !='')
			{
				$og_description = $seo_data['og_description'];
			}
			if(isset($seo_data['og_image']) && $seo_data['og_image'] !='')
			{
				$og_image = $seo_data['og_image'];
			}
			$this->common_model->css_extra_code_fr.='.wedding-img {
				height: 220px;
				margin-right: auto;
				margin-left: auto;
			}';
			$this->common_model->front_load_header('Wedding planner','',$seo_title,$seo_description,$seo_keywords,$og_title,$og_description,$og_image);
			$this->load->view('front_end/vendor_list',$this->data);
			$this->common_model->front_load_footer();
		}
		else
		{	
			$this->load->view('front_end/vendor_list_ajax',$this->data);
		}
	}
	public function details($id='')
	{	
		if($id !='')
		{	
			$where_wedding_planner= " (id ='".$id."' and status = 'APPROVED' and is_deleted = 'No')";
			$wedding_planner_arr = $this->common_model->get_count_data_manual('wedd_planner_view',$where_wedding_planner,1,'*','','','',"");
			
			if(isset($wedding_planner_arr) && $wedding_planner_arr!= '')
			{
				$this->common_model->extra_css_fr= array('css/owl.carousel.css','css/fontello.css','css/date-picker.css');	
				$this->common_model->extra_js_fr= array('js/owl.carousel.min.js','js/slider.js','js/date-picker.js','js/jquery.validate.min.js','js/additional-methods.min.js');
				
				$where_arra_reviews=array('vendor_id'=>$id,'is_deleted'=>'No','status'=>'APPROVED');
				$wedding_planner_data['wedding_planner_reviews_count'] = $this->common_model->get_count_data_manual('vendor_reviews',$where_arra_reviews,0,'*','id desc','');
				
				$wedding_planner_data['wedding_planner_reviews'] = $this->common_model->get_count_data_manual('vendor_reviews',$where_arra_reviews,2,'*','id desc',''); 
				
				// generate captcha
				$code = rand(100000,999999);
				$this->session->set_userdata('captcha_vendor',$code);
				// generate captcha
				
				$wedding_planner_data['wedding_planner_item']= $wedding_planner_arr;
				$this->common_model->front_load_header('Wedding Planner Details');
				$this->load->view('front_end/vendor_details',$wedding_planner_data);
				$this->common_model->front_load_footer();
			}
			else
			{
				redirect($this->common_model->base_url.'wedding-vendor');
			}
		}
		else
		{
			redirect($this->common_model->base_url.'wedding-vendor');
		}
	}
	public function validate_captcha()
	{	
		if($this->input->post('code_captcha') != $this->session->userdata['captcha_vendor'])
		{
			$this->form_validation->set_message('validate_captcha', 'Wrong captcha code, Please enter valid captcha code');
			return false;
		}else{
			return true;
		}
	}
	public function send_enquiry_to_planner($id_details='')
	{
		if($id_details =='')
		{
			redirect(base_url().'wedding-vendor/index');
		}
		$this->load->model('front_end/contact_model');
		$is_post = 0;
		if($this->input->post('is_post'))
		{
			$is_post = trim($this->input->post('is_post'));
		}
		$data = $this->contact_model->validate_form_vendor($id_details);
		if($is_post ==0)
		{
			$data1['data'] = json_encode($data);
			$this->load->view('common_file_echo',$data1);
		}
		else
		{
			if($data['status'] =='success')
			{
				$this->session->set_flashdata('email_success_message',$data['errmessage']);
			}
			else
			{
				$this->session->set_flashdata('email_error_message', $data['errmessage']);
			}
			redirect(base_url().'wedding-vendor/details/'.$id_details);
		}
	}
	
	
	public function send_review($id_details='')
	{
		if($id_details =='')
		{
			redirect(base_url().'wedding-vendor/index');
		}
		$this->load->model('front_end/contact_model');
		$is_post = 0;
		if($this->input->post('is_post'))
		{
			$is_post = trim($this->input->post('is_post'));
		}
		$data = $this->contact_model->send_review($id_details);
		if($is_post ==0)
		{
			$data1['data'] = json_encode($data);
			$this->load->view('common_file_echo',$data1);
		}
		else
		{
			redirect(base_url().'wedding-vendor/index');
			/*if($data['status'] =='success')
			{
				$this->session->set_flashdata('email_success_message',$data['errmessage']);
			}
			else
			{
				$this->session->set_flashdata('email_error_message', $data['errmessage']);
			}
			redirect(base_url().'wedding-vendor/details/'.$id_details);*/
		}
	}
}