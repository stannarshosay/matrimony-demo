<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Success_story extends CI_Controller {

	public $data = array();

	public function __construct()

	{

		parent::__construct();

		$this->base_url = base_url();

		$this->data['base_url'] = $this->base_url;

		$this->load->model('front_end/success_story_model');

		$this->common_front_model->last_member_activity();

	}	

	public function index($page=1)

	{	

		$data['base_url']=$this->data['base_url'];	

		$this->common_model->limit_per_page = '3';

		$where_arra = array('is_deleted'=>'No','status'=>'APPROVED');

		$this->data['success_story'] = $this->common_model->get_count_data_manual('success_story',$where_arra,2,'*','id desc',$page,'','','');

		$this->data['success_story_data_count'] = $this->common_model->get_count_data_manual('success_story',$where_arra,0,'id');

		$seo_data = $this->common_model->get_count_data_manual('seo_page_data',array('status'=>'APPROVED','page_title'=>'Success Story'),1,'*','','');

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

		$this->common_model->front_load_header('Success Stories','',$seo_title,$seo_description,$seo_keywords,$og_title,$og_description,$og_image);

		$this->load->view('front_end/success_story_listing',$this->data);

		$this->common_model->front_load_footer();

	}

	public function details($id='',$groomname='',$bridename='')

	{	

		// print_r($id);exit;

		$id = $this->common_model->descrypt_id($id);



		if($id!='')

		{				

			$where_success_story=array(" (id ='".$id."')",'status'=>'APPROVED');

			$success_story_arr = $this->common_model->get_count_data_manual('success_story',$where_success_story,1,'id,weddingphoto,weddingphoto_type,bridename,groomname,marriagedate,successmessage,created_on','','','',"");

			// $this->db->last_query();exit;

			if(isset($success_story_arr) && $success_story_arr !='' && count($success_story_arr) > 0)

			{



			$seo_data = $this->common_model->get_count_data_manual('success_story',array('status'=>'APPROVED','id'=>$id),1,'*','','');

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

		

			$success_story_data['success_story_item']= $success_story_arr;

			//$this->common_model->front_load_header('Success Story Details');

			$this->common_model->front_load_header($title,'',$seo_title,$seo_description,$seo_keywords,$og_title,$og_description,$og_image);

			$this->load->view('front_end/success_story_details',$success_story_data);

			$this->common_model->front_load_footer();

			}

			else

			{

				redirect($this->common_model->base_url.'success_story');

			}

		}

		else

		{

			

			redirect($this->common_model->base_url.'success_story');

		}

	}

// changes for shakil 18-12-2020

	public function add_story()

	{	

		$this->common_model->extra_css_fr= array('css/date-picker.css');

		$this->common_model->extra_js_fr= array('js/date-picker.js','js/jquery.validate.min.js','js/additional-methods.min.js');



		$seo_data = $this->common_model->get_count_data_manual('seo_page_data',array('status'=>'APPROVED','page_title'=>'Add Story'),1,'*','','');

		//$this->common_model->extra_css_fr= array('css/select2.min.css');

		//$this->common_model->css_extra_code_fr.='';

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



		$this->common_model->front_load_header('Submit Success Story','',$seo_title,$seo_description,$seo_keywords,$og_title,$og_description,$og_image);

		//$this->common_model->front_load_header('Submit Success Story');

		$this->load->view('front_end/add_success_story',$this->data);

		$this->common_model->front_load_footer();

	}

	

		// public function add_story()

		// {	

		// 	$this->common_model->extra_css_fr= array('css/date-picker.css');

		// 	$this->common_model->extra_js_fr= array('js/date-picker.js','js/jquery.validate.min.js','js/additional-methods.min.js');

		// 	$this->common_model->front_load_header('Submit Success Story');

		// 	$this->load->view('front_end/add_success_story',$this->data);

		// 	$this->common_model->front_load_footer();

		// }

	public function check_bride_groom()

	{	
		$this->common_front_model->set_orgin();

		$this->success_story_model->check_bride_groom();

	}

	public function save_story()

	{
	   $this->common_front_model->set_orgin();

	   $this->success_story_model->add_success_story();

	}

}