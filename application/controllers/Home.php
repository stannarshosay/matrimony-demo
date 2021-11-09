<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
	public $data = array();
	public function __construct()
	{ 
		parent::__construct();
		$this->base_url = base_url();
		$this->data['base_url'] = $this->base_url;		
		$this->common_front_model->last_member_activity();
	}
	public function admin()
	{
		$admin_path = $this->common_model->getconfingValue('admin_path');
		redirect($this->base_url.$admin_path);
	}
	public function index()
	{
		$is_login = $this->common_front_model->checkLogin('return');
		if($is_login == true)
		{
			redirect($this->base_url.'my-dashboard');
		}
		$this->common_model->is_home_page = 'Yes';
		$this->common_model->extra_css_fr= array('css/chosen.css');
		
		$this->common_model->extra_js_fr= array('js/owl.carousel.min.js','js/chosen.jquery.js');

		$seo_data = $this->common_model->get_count_data_manual('seo_page_data',array('status'=>'APPROVED','page_title'=>'Home'),1,'*','','');
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
// 		$this->common_model->front_load_header('','',$seo_title,$seo_description,$seo_keywords,$og_title,$og_description,$og_image);
// 		$this->load->view('front_end/home');
// 		$this->common_model->front_load_footer();
	}
	
}