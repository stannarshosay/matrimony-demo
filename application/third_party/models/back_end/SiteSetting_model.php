<?php defined('BASEPATH') OR exit('No direct script access allowed');
class SiteSetting_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
	/*
	public function generate_form_job_prefix($success_url='')
	{
		$ele_array = array(
			'job_prefix'=>array('is_required'=>'required')
		);
		$other_config = array('mode'=>'edit','id'=>'1','primary_key'=>$this->primary_key,'action'=>$this->action,'success_url'=>$success_url);
		$output = $this->common_model->generate_form_main($this->table_name,$ele_array,$other_config);
		return $output;
	}
	*/	

	/*public function generate_form_site_setting($success_url='')
	{
		$ele_array = array(
			'web_name'=>array('is_required'=>'required','input_type'=>'url'),
			'web_frienly_name'=>array('is_required'=>'required'),
			'website_title'=>array('is_required'=>'required'),
			'website_description'=>array('type'=>'textarea','is_required'=>'required'),
			'footer_text'=>array('is_required'=>'required'),
			'contact_no'=>array('is_required'=>'required','input_type'=>'number'),
			'website_keywords'=>array('type'=>'textarea','is_required'=>'required')
			
		);
		$other_config = array('mode'=>'edit','id'=>'1','primary_key'=>$this->primary_key,'action'=>$this->action,'success_url'=>$success_url);
		$output = $this->common_model->generate_form_main($this->table_name,$ele_array,$other_config);
		return $output;
	}*/
	/*public function generate_form_update_email($success_url='')
	{
		$ele_array = array(
			'from_email'=>array('is_required'=>'required','input_type'=>'email'),
			'to_email'=>array('is_required'=>'required','input_type'=>'email'),
			'feedback_email'=>array('is_required'=>'required','input_type'=>'email'),
			'contact_email'=>array('is_required'=>'required','input_type'=>'email')
		);
		$other_config = array('mode'=>'edit','id'=>'1','primary_key'=>'id','action'=>$this->action,'success_url'=>$success_url);
		$output = $this->common_model->generate_form_main($this->table_name,$ele_array,$other_config);
		return $output;
	}*/
	/*public function generate_form_logo_favicon($success_url='')
	{
		$extra_js = $this->common_model->extra_js;
		$extra_js[] = 'vendor/jquery-validation/dist/additional-methods.min.js';
		$this->common_model->extra_js = $extra_js;
		$ele_array = array(
			'upload_logo'=>array('type'=>'file','path_value'=>'assets/logo/'),
			'upload_favicon'=>array('type'=>'file','path_value'=>'assets/logo/')
		);
		$other_config = array('mode'=>'edit','id'=>'1','primary_key'=>$this->primary_key,'action'=>$this->action,'success_url'=>$success_url,'enctype'=>'enctype="multipart/form-data"');
		$output = $this->common_model->generate_form_main($this->table_name,$ele_array,$other_config);
		return $output;
	}*/
	/*public function generate_form_socialsite_setting($success_url='')
	{
		$ele_array = array(
			'facebook_link'=>array('input_type'=>'url'),
			'twitter_link'=>array('input_type'=>'url'),
			'linkedin_link'=>array('input_type'=>'url'),
			'google_link'=>array('input_type'=>'url')
		);
		$other_config = array('mode'=>'edit','id'=>'1','primary_key'=>'id','action'=>$this->action,'success_url'=>$success_url);
		$output = $this->common_model->generate_form_main($this->table_name,$ele_array,$other_config);
		return $output;
	}*/
/*	public function generate_form_google_analytics_setting($success_url='')
	{
		$ele_array = array(
			'google_analytics_code'=>array('type'=>'textarea')
		);
		$other_config = array('mode'=>'edit','id'=>'1','primary_key'=>$this->primary_key,'action'=>$this->action,'success_url'=>$success_url);
		$output = $this->common_model->generate_form_main($this->table_name,$ele_array,$other_config);
		return $output;
	}*/
	public function save_change_password()
	{
		if($this->input->post('success_url'))
		{
			$this->success_url = $this->input->post('success_url');
		}
		if($this->input->post('password') && $this->input->post('new_password'))
		{
			
			$user_type = $this->common_model->get_session_user_type();
			$old_pass = trim($this->input->post('password'));
			$new_pass = trim($this->input->post('new_password'));
			$table_name = 'staff';
			$where_arr_pass  = array();
			if($user_type =='admin')
			{
				$old_pass =  md5($old_pass);
				$new_pass =  md5($new_pass);
				$table_name = 'admin_user';
			}
			else if($user_type =='franchise')
			{
				$table_name = 'franchise';
			}
			else
			{
				$where_arr_pass  = array('id'=>$this->common_model->get_session_data('id'));
			}
			$where_arr = array('password' => $old_pass);
			$row_data = $this->common_model->get_count_data_manual($table_name,$where_arr,0,'id');
			if(isset($row_data) && $row_data > 0)
			{
				$data_array = array('password'=>$new_pass);
				$response = $this->common_model->update_insert_data_common($table_name,$data_array,$where_arr_pass);
				$this->session->set_flashdata('success_message', 'Your password successfully changed.');
			}
			else
			{
				$this->session->set_flashdata('error_message', 'Please enter correct old password.');
			}
		}
		else
		{
			$this->session->set_flashdata('error_message', ' Please enter password.');
		}
	}
	function update_color( )
	{
		if($this->input->post('colour_name'))
		{			
			$colour_name = trim($this->input->post('colour_name'));
			$font_color = trim($this->input->post('font_color'));
			$rgba_color = $this->hex2rgb($colour_name);
			$temp = file_get_contents("assets/front_end/css/style_scss.css");
			$rgba_color = 'rgba('.$rgba_color.',0.95)';
			$temp_arr = array("#text_color#"=>$font_color,"#bg_color#"=>$colour_name,"#bg_color_rgb#"=>$rgba_color);
			
			$final_css = strtr($temp,$temp_arr);
			file_put_contents("assets/front_end/css/style.css",$final_css);
		}
		$this->session->set_flashdata('success_message', 'Your have successfully changed color for main site.');
	}
	function hex2rgb( $colour )
	{
        if ( $colour[0] == '#' ) {
                $colour = substr( $colour, 1 );
        }
        if ( strlen( $colour ) == 6 ) {
                list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
        } elseif ( strlen( $colour ) == 3 ) {
                list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
        } else {
                return false;
        }
        $r = hexdec( $r );
        $g = hexdec( $g );
        $b = hexdec( $b );
        //return array( 'red' => $r, 'green' => $g, 'blue' => $b );
		$temp_val = $r.','.$g.','.$b;
		return $temp_val;
	}
	function font_aw_listing()
	{
		$font_data = array(
			'fa fa-500px'=>'500px',
			'fa fa-align-justify'=>'align-justify',
			'fa fa-ambulance'=>'ambulance',
			'fa fa-angle-double-left'=>'angle-double-left',
			'fa fa-angle-left'=>'angle-left',
			'fa fa-archive'=>'archive',
			'fa fa-arrow-circle-o-down'=>'arrow-circle-o-down',
			'fa fa-arrow-circle-right'=>'arrow-circle-right',
			'fa fa-arrow-right'=>'arrow-right',
			'fa fa-arrows-h'=>'arrows-h',
			'fa fa-asterisk'=>'asterisk',
			'fa fa-backward'=>'backward',
			'fa fa-bank'=>'bank',
			'fa fa-bars'=>'bars',
			'fa fa-battery-0'=>'battery-0',
			'fa fa-battery-4'=>'battery-4',
			'fa fa-battery-quarter'=>'battery-quarter',
			'fa fa-behance'=>'behance',
			'fa fa-bell-slash'=>'bell-slash',
			'fa fa-birthday-cake'=>'birthday-cake',
			'fa fa-black-tie'=>'black-tie',
			'fa fa-bold'=>'bold',
			'fa fa-bookmark'=>'bookmark',
			'fa fa-btc'=>'btc',
			'fa fa-bullhorn'=>'bullhorn',
			'fa fa-cab'=>'cab',
			'fa fa-calendar-minus-o'=>'calendar-minus-o',
			'fa fa-camera'=>'camera',
			'fa fa-caret-left'=>'caret-left',
			'fa fa-caret-square-o-right'=>'caret-square-o-right',
			'fa fa-cart-plus'=>'cart-plus',
			'fa fa-cc-discover'=>'cc-discover',
			'fa fa-cc-stripe'=>'cc-stripe',
			'fa fa-chain-broken'=>'chain-broken',
			'fa fa-check-square'=>'check-square',
			'fa fa-chevron-circle-right'=>'chevron-circle-right',
			'fa fa-chevron-right'=>'chevron-right',
			'fa fa-circle'=>'circle',
			'fa fa-clipboard'=>'clipboard',
			'fa fa-cloud'=>'cloud',
			'fa fa-code'=>'code',
			'fa fa-coffee'=>'coffee',
			'fa fa-comment'=>'comment',
			'fa fa-comments'=>'comments',
			'fa fa-connectdevelop'=>'connectdevelop',
			'fa fa-creative-commons'=>'creative',
			'fa fa-crosshairs'=>'crosshairs',
			'fa fa-cut'=>'cut',
			'fa fa-database'=>'database',
			'fa fa-delicious'=>'delicious',
			'fa fa-digg'=>'digg',
			'fa fa-dribbble'=>'dribbble',
			'fa fa-drupal'=>'drupal',
			'fa fa-eject'=>'eject',
			'fa fa-envelope'=>'envelope',
			'fa fa-envelope-square'=>'envelope-square',
			'fa fa-eur'=>'eur',
			'fa fa-exclamation-circle'=>'exclamation-circle',
			'fa fa-external-link'=>'external-link',
			'fa fa-eyedropper'=>'eyedropper',
			'fa fa-facebook-official'=>'facebook-official',
			'fa fa-fax'=>'fax',
			'fa fa-file'=>'file',
			'fa fa-file-excel-o'=>'file-excel-o',
			'fa fa-file-pdf-o'=>'file-pdf-o',
			'fa fa-file-sound-o'=>'file-sound-o',
			'fa fa-file-word-o'=>'file-word-o',
			'fa fa-filter'=>'filter',
			'fa fa-flash'=>'flash',
			'fa fa-folder'=>'folder',
			'fa fa-forumbee'=>'forumbee',
			'fa fa-frown-o'=>'frown-o',
			'fa fa-gbp'=>'gbp',
			'fa fa-genderless'=>'genderless',
			'fa fa-gift'=>'gift',
			'fa fa-github-alt'=>'github-alt',
			'fa fa-google'=>'google',
			'fa fa-google-wallet'=>'google-wallet',
			'fa fa-group'=>'group',
			'fa fa-hand-lizard-o'=>'hand-lizard-o',
			'fa fa-hand-o-up'=>'hand-o-up',
			'fa fa-hand-rock-o'=>'hand-rock-o',
			'fa fa-header'=>'header',
			'fa fa-heartbeat'=>'heartbeat',
			'fa fa-hotel'=>'hotel',
			'fa fa-hourglass-3'=>'hourglass-3',
			'fa fa-hourglass-start'=>'hourglass-start',
			'fa fa-image'=>'image',
			'fa fa-industry'=>'industry',
			'fa fa-ioxhost'=>'ioxhost',
			'fa fa-jsfiddle'=>'jsfiddle',
			'fa fa-language'=>'language',
			'fa fa-leaf'=>'leaf',
			'fa fa-level-down'=>'level-down',
			'fa fa-life-ring'=>'life-ring',
			'fa fa-link'=>'link',
			'fa fa-linux'=>'linux',
			'fa fa-list-ul'=>'list-ul',
			'fa fa-long-arrow-left'=>'long-arrow-left',
			'fa fa-magic'=>'magic',
			'fa fa-mail-reply-all'=>'mail-reply-all',
			'fa fa-map-o'=>'map-o',
			'fa fa-mars-double'=>'mars-double',
			'fa fa-maxcdn'=>'maxcdn',
			'fa fa-meetup'=>'meetup',
			'fa fa-microphone'=>'microphone',
			'fa fa-minus-square'=>'minus-square',
			'fa fa-mobile-phone'=>'mobile-phone',
			'fa fa-mortar-board'=>'board',
			'fa fa-navicon'=>'navicon',
			'fa fa-object-ungroup'=>'object-ungroup',
			'fa fa-openid'=>'openid',
			'fa fa-pagelines'=>'pagelines',
			'fa fa-paperclip'=>'paperclip',
			'fa fa-pencil'=>'pencil',
			'fa fa-phone'=>'phone',
			'fa fa-pie-chart'=>'pie-chart',
			'fa fa-pinterest'=>'pinterest',
			'fa fa-play'=>'play',
			'fa fa-plus'=>'plus',
			'fa fa-puzzle-piece'=>'puzzle-piece',
			'fa fa-question-circle'=>'question-circle',
			'fa fa-quote-right'=>'quote-right',
			'fa fa-rebel'=>'rebel',
			'fa fa-reddit-square'=>'reddit-square',
			'fa fa-renren'=>'renren',
			'fa fa-reply-all'=>'reply-all',
			'fa fa-road'=>'road',
			'fa fa-rouble'=>'rouble',
			'fa fa-ruble'=>'ruble',
			'fa fa-save'=>'save',
			'fa fa-search-minus'=>'search-minus',
			'fa fa-send-o'=>'send-o',
			'fa fa-share-alt-square'=>'share-alt-square',
			'fa fa-sheqel'=>'sheqel',
			'fa fa-sign-in'=>'sign-in',
			'fa fa-skype'=>'skype',
			'fa fa-smile-o'=>'smile-o',
			'fa fa-sort-alpha-desc'=>'sort-alpha-desc',
			'fa fa-sort-desc'=>'sort-desc',
			'fa fa-sort-up'=>'sort-up',
			'fa fa-spoon'=>'spoon',
			'fa fa-stack-exchange'=>'stack-exchange',
			'fa fa-star-half-empty'=>'star-half-empty',
			'fa fa-steam'=>'steam',
			'fa fa-stethoscope'=>'stethoscope',
			'fa fa-stumbleupon'=>'stumbleupon',
			'fa fa-suitcase'=>'suitcase',
			'fa fa-support'=>'support',
			'fa fa-tag'=>'tag',
			'fa fa-text-height'=>'text-height',
			'fa fa-th-list'=>'th-list',
			'fa fa-toggle-off'=>'toggle-off',
			'fa fa-trademark'=>'trademark',
			'fa fa-trash'=>'trash',
			'fa fa-tripadvisor'=>'tripadvisor',
			'fa fa-tty'=>'tty',
			'fa fa-tv'=>'tv',
			'fa fa-umbrella'=>'umbrella',
			'fa fa-university'=>'university',
			'fa fa-unsorted'=>'unsorted',
			'fa fa-user'=>'user',
			'fa fa-users'=>'users',
			'fa fa-venus-double'=>'venus-double',
			'fa fa-vine'=>'vine',
			'fa fa-volume-off'=>'volume-off',
			'fa fa-weibo'=>'weibo',
			'fa fa-windows'=>'windows',
			'fa fa-xing-square'=>'xing-square',
			'fa fa-yc-square'=>'yc-square',
			'fa fa-youtube'=>'youtube',
			'fa fa-adjust'=>'adjust',
			'fa fa-align-left'=>'align-left',
			'fa fa-angle-double-right'=>'angle-double-right',
			'fa fa-angle-right'=>'angle-right',
			'fa fa-area-chart'=>'area-chart',
			'fa fa-arrow-circle-o-left'=>'arrow-circle-o-left',
			'fa fa-arrow-circle-up'=>'arrow-circle-up',
			'fa fa-arrow-up'=>'arrow-up',
			'fa fa-arrows-v'=>'arrows-v',
			'fa fa-balance-scale'=>'balance-scale',
			'fa fa-battery-1'=>'battery-1',
			'fa fa-battery-empty'=>'battery-empty',
			'fa fa-battery-three-quarters'=>'battery-three-quarters',
			'fa fa-behance-square'=>'behance-square',
			'fa fa-bitbucket'=>'bitbucket',
			'fa fa-bolt'=>'bolt',
			'fa fa-bookmark-o'=>'bookmark-o',
			'fa fa-bug'=>'bug',
			'fa fa-bullseye'=>'bullseye',
			'fa fa-calculator'=>'calculator',
			'fa fa-calendar-o'=>'calendar-o',
			'fa fa-camera-retro'=>'camera-retro',
			'fa fa-caret-right'=>'caret-right',
			'fa fa-caret-square-o-up'=>'caret-square-o-up',
			'fa fa-cc'=>'cc',
			'fa fa-cc-jcb'=>'cc-jcb',
			'fa fa-cc-visa'=>'cc-visa',
			'fa fa-check'=>'check',
			'fa fa-check-square-o'=>'check-square-o',
			'fa fa-chevron-circle-up'=>'chevron-circle-up',
			'fa fa-chevron-up'=>'chevron-up',
			'fa fa-circle-o'=>'circle-o',
			'fa fa-clock-o'=>'clock-o',
			'fa fa-cloud-download'=>'cloud-download',
			'fa fa-code-fork'=>'code-fork',
			'fa fa-cog'=>'cog',
			'fa fa-comment-o'=>'comment-o',
			'fa fa-comments-o'=>'comments-o',
			'fa fa-contao'=>'contao',
			'fa fa-credit-card'=>'credit-card',
			'fa fa-css3'=>'css3',
			'fa fa-cutlery'=>'cutlery',
			'fa fa-desktop'=>'desktop',
			'fa fa-dollar'=>'dollar',
			'fa fa-edge'=>'edge',
			'fa fa-ellipsis-h'=>'ellipsis-h',
			'fa fa-envelope-o'=>'envelope-o',
			'fa fa-euro'=>'euro',
			'fa fa-exclamation-triangle'=>'exclamation-triangle',
			'fa fa-external-link-square'=>'external-link',
			'fa fa-facebook-square'=>'facebook-square',
			'fa fa-feed'=>'feed',
			'fa fa-file-archive-o'=>'file-archive-o',
			'fa fa-file-image-o'=>'file-image-o',
			'fa fa-file-photo-o'=>'file-photo-o',
			'fa fa-file-text'=>'file-text',
			'fa fa-file-zip-o'=>'file-zip-o',
			'fa fa-fire'=>'fire',
			'fa fa-flag'=>'flag',
			'fa fa-flask'=>'flask',
			'fa fa-folder-o'=>'folder-o',
			'fa fa-forward'=>'forward',
			'fa fa-futbol-o'=>'futbol-o',
			'fa fa-ge'=>'ge',
			'fa fa-get-pocket'=>'et-pocket',
			'fa fa-git'=>'git',
			'fa fa-github-square'=>'github-square',
			'fa fa-google-plus'=>'google-plus',
			'fa fa-graduation-cap'=>'graduation-cap',
			'fa fa-h-square'=>'h-square',
			'fa fa-hand-o-down'=>'hand-o-down',
			'fa fa-hand-paper-o'=>'hand-paper-o',
			'fa fa-hand-scissors-o'=>'hand-scissors-o',
			'fa fa-hard-of-hearing'=>'hard-of-hearing',
			'fa fa-headphones'=>'headphones',
			'fa fa-history'=>'history',
			'fa fa-hourglass'=>'hourglass',
			'fa fa-hourglass-end'=>'hourglass-end',
			'fa fa-houzz'=>'houzz',
			'fa fa-info'=>'info',
			'fa fa-institution'=>'institution',
			'fa fa-italic'=>'italic',
			'fa fa-key'=>'key',
			'fa fa-laptop'=>'laptop',
			'fa fa-leanpub'=>'leanpub',
			'fa fa-level-up'=>'level-up',
			'fa fa-life-saver'=>'life-saver',
			'fa fa-linkedin'=>'linkedin',
			'fa fa-list'=>'list',
			'fa fa-location-arrow'=>'location-arrow',
			'fa fa-long-arrow-right'=>'long-arrow-right',
			'fa fa-magnet'=>'magnet',
			'fa fa-male'=>'male',
			'fa fa-map-pin'=>'map-pin',
			'fa fa-mars-stroke'=>'mars-stroke',
			'fa fa-meanpath'=>'meanpath',
			'fa fa-meh-o'=>'meh-o',
			'fa fa-microphone-slash'=>'microphone-slash',
			'fa fa-minus-square-o'=>'minus-square-o',
			'fa fa-motorcycle'=>'motorcycle',
			'fa fa-neuter'=>'neuter',
			'fa fa-odnoklassniki'=>'odnoklassniki',
			'fa fa-opera'=>'opera',
			'fa fa-paint-brush'=>'paint-brush',
			'fa fa-paragraph'=>'paragraph',
			'fa fa-pencil-square'=>'pencil-square',
			'fa fa-phone-square'=>'phone-square',
			'fa fa-pinterest-p'=>'pinterest-p',
			'fa fa-play-circle'=>'play-circle',
			'fa fa-plus-circle'=>'plus-circle',
			'fa fa-power-off'=>'power-off',
			'fa fa-qq'=>'qq',
			'fa fa-ra'=>'ra',
			'fa fa-recycle'=>'recycle',
			'fa fa-refresh'=>'refresh',
			'fa fa-reorder'=>'reorder',
			'fa fa-resistance'=>'resistance',
			'fa fa-rocket'=>'rocket',
			'fa fa-rss'=>'rss',
			'fa fa-rupee'=>'rupee',
			'fa fa-scissors'=>'scissors',
			'fa fa-search-plus'=>'search-plus',
			'fa fa-server'=>'server',
			'fa fa-share-square'=>'share-square',
			'fa fa-shield'=>'shield',
			'fa fa-simplybuilt'=>'simplybuilt',
			'fa fa-slack'=>'slack',
			'fa fa-soccer-ball-o'=>'soccer-ball-o',
			'fa fa-sort-amount-asc'=>'sort-amount-asc',
			'fa fa-sort-down'=>'sort-down',
			'fa fa-soundcloud'=>'soundcloud',
			'fa fa-spotify'=>'spotify',
			'fa fa-stack-overflow'=>'stack-overflow',
			'fa fa-star-half-full'=>'star-half-full',
			'fa fa-steam-square'=>'steam-square',
			'fa fa-sticky-note'=>'sticky-note',
			'fa fa-stop-circle-o'=>'stop-circle-o',
			'fa fa-stumbleupon-circle'=>'stumbleupon-circle',
			'fa fa-sun-o'=>'sun-o',
			'fa fa-table'=>'table',
			'fa fa-tags'=>'tags',
			'fa fa-television'=>'television',
			'fa fa-text-width'=>'text-width',
			'fa fa-thumb-tack'=>'thumb-tack',
			'fa fa-thumbs-o-up'=>'thumbs-o-up',
			'fa fa-times-circle'=>'times-circle',
			'fa fa-tint'=>'tint',
			'fa fa-toggle-on'=>'toggle-on',
			'fa fa-train'=>'train',
			'fa fa-trash-o'=>'trash-o',
			'fa fa-trophy'=>'trophy',
			'fa fa-tumblr'=>'tumblr',
			'fa fa-twitch'=>'twitch',
			'fa fa-underline'=>'underline',
			'fa fa-unlink'=>'unlink',
			'fa fa-upload'=>'upload',
			'fa fa-user-plus'=>'user-plus',
			'fa fa-venus-mars'=>'venus-mars',
			'fa fa-video-camera'=>'video-camera',
			'fa fa-vk'=>'vk',
			'fa fa-volume-up'=>'volume-up',
			'fa fa-weixin'=>'weixin',
			'fa fa-wifi'=>'wifi',
			'fa fa-won'=>'won',
			'fa fa-y-combinator'=>'y-combinator',
			'fa fa-yelp'=>'yelp',
			'fa fa-youtube-play'=>'youtube-play',
			'fa fa-adn'=>'adn',
			'fa fa-align-right'=>'align-right',
			'fa fa-anchor'=>'anchor',
			'fa fa-angellist'=>'angellist',
			'fa fa-angle-double-up'=>'angle-double-up',
			'fa fa-angle-up'=>'angle-up',
			'fa fa-arrow-circle-down'=>'arrow-circle-down',
			'fa fa-arrow-circle-o-right'=>'arrow-circle-o-right',
			'fa fa-arrow-down'=>'arrow-down',
			'fa fa-arrows'=>'arrows',
			'fa fa-ban'=>'ban',
			'fa fa-bar-chart-o'=>'bar-chart-o',
			'fa fa-battery-2'=>'battery-2',
			'fa fa-battery-full'=>'battery-full',
			'fa fa-bed'=>'bed',
			'fa fa-bell'=>'bell',
			'fa fa-bicycle'=>'bicycle',
			'fa fa-bitbucket-square'=>'bitbucket-square',
			'fa fa-bomb'=>'bomb',
			'fa fa-building'=>'building',
			'fa fa-bus'=>'bus',
			'fa fa-calendar'=>'calendar',
			'fa fa-calendar-plus-o'=>'calendar-plus-o',
			'fa fa-car'=>'car',
			'fa fa-caret-square-o-down'=>'caret-square-o-down',
			'fa fa-caret-up'=>'caret-up',
			'fa fa-cc-amex'=>'cc-amex',
			'fa fa-cc-mastercard'=>'cc-mastercard',
			'fa fa-certificate'=>'certificate',
			'fa fa-check-circle'=>'check-circle',
			'fa fa-chevron-circle-down'=>'chevron-circle-down',
			'fa fa-chevron-down'=>'chevron-down',
			'fa fa-child'=>'child',
			'fa fa-circle-o-notch'=>'circle-o-notch',
			'fa fa-clone'=>'clone',
			'fa fa-cloud-upload'=>'cloud-upload',
			'fa fa-codepen'=>'codepen',
			'fa fa-cogs'=>'cogs',
			'fa fa-commenting'=>'commenting',
			'fa fa-compass'=>'compass',
			'fa fa-copy'=>'copy',
			'fa fa-cube'=>'cube',
			'fa fa-dashboard'=>'dashboard',
			'fa fa-deviantart'=>'deviantart',
			'fa fa-dot-circle-o'=>'dot-circle-o',
			'fa fa-edit'=>'edit',
			'fa fa-ellipsis-v'=>'ellipsis-v',
			'fa fa-eraser'=>'eraser',
			'fa fa-exchange'=>'exchange',
			'fa fa-expand'=>'expand',
			'fa fa-eye'=>'eye',
			'fa fa-facebook'=>'facebook',
			'fa fa-fast-backward'=>'fast-backward',
			'fa fa-female'=>'female',
			'fa fa-file-audio-o'=>'file-audio-o',
			'fa fa-file-movie-o'=>'file-movie-o',
			'fa fa-file-picture-o'=>'file-picture-o',
			'fa fa-file-text-o'=>'file-text-o',
			'fa fa-files-o'=>'files-o',
			'fa fa-fire-extinguisher'=>'fire-extinguisher',
			'fa fa-flag-checkered'=>'flag-checkered',
			'fa fa-flickr'=>'flickr',
			'fa fa-folder-open'=>'folder-open',
			'fa fa-fonticons'=>'fonticons',
			'fa fa-foursquare'=>'foursquare',
			'fa fa-gamepad'=>'gamepad',
			'fa fa-gear'=>'gear',
			'fa fa-gg'=>'gg',
			'fa fa-git-square'=>'git-square',
			'fa fa-gratipay'=>'gratipay',
			'fa fa-hacker-news'=>'hacker-news',
			'fa fa-hand-o-left'=>'hand-o-left',
			'fa fa-hand-peace-o'=>'hand-peace-o',
			'fa fa-hand-spock-o'=>'hand-spock-o',
			'fa fa-heart'=>'heart',
			'fa fa-home'=>'home',
			'fa fa-hourglass-1'=>'hourglass-1',
			'fa fa-hourglass-half'=>'hourglass-half',
			'fa fa-html5'=>'html5',
			'fa fa-inbox'=>'inbox',
			'fa fa-info-circle'=>'info-circle',
			'fa fa-internet-explorer'=>'internet-explorer',
			'fa fa-joomla'=>'joomla',
			'fa fa-keyboard-o'=>'keyboard-o',
			'fa fa-lastfm'=>'lastfm',
			'fa fa-legal'=>'legal',
			'fa fa-life-bouy'=>'life-bouy',
			'fa fa-lightbulb-o'=>'lightbulb-o',
			'fa fa-linkedin-square'=>'linkedin-square',
			'fa fa-list-alt'=>'list-alt',
			'fa fa-lock'=>'lock',
			'fa fa-long-arrow-up'=>'long-arrow-up',
			'fa fa-mail-forward'=>'mail-forward',
			'fa fa-map'=>'map',
			'fa fa-map-signs'=>'map-signs',
			'fa fa-mars-stroke-h'=>'mars-stroke-h',
			'fa fa-medium'=>'medium',
			'fa fa-mercury'=>'mercury',
			'fa fa-minus'=>'minus',
			'fa fa-money'=>'money',
			'fa fa-mouse-pointer'=>'mouse-pointer',
			'fa fa-newspaper-o'=>'newspaper-o',
			'fa fa-odnoklassniki-square'=>'odnoklassniki-square',
			'fa fa-optin-monster'=>'optin-monster',
			'fa fa-paper-plane'=>'paper-plane',
			'fa fa-paste'=>'paste',
			'fa fa-paw'=>'paw',
			'fa fa-pencil-square-o'=>'pencil-square-o',
			'fa fa-photo'=>'photo',
			'fa fa-pied-piper-alt'=>'pied-piper-alt',
			'fa fa-pinterest-square'=>'pinterest-square',
			'fa fa-play-circle-o'=>'play-circle-o',
			'fa fa-plus-square'=>'plus-square',
			'fa fa-print'=>'print',
			'fa fa-qrcode'=>'qrcode',
			'fa fa-random'=>'random',
			'fa fa-reddit'=>'reddit',
			'fa fa-registered'=>'registered',
			'fa fa-repeat'=>'repeat',
			'fa fa-retweet'=>'retweet',
			'fa fa-rotate-left'=>'rotate-left',
			'fa fa-rss-square'=>'rss-square',
			'fa fa-sellsy'=>'sellsy',
			'fa fa-share'=>'share',
			'fa fa-share-square-o'=>'share-square-o',
			'fa fa-ship'=>'ship',
			'fa fa-shopping-cart'=>'shopping-cart',
			'fa fa-sign-out'=>'sign-out',
			'fa fa-sitemap'=>'sitemap',
			'fa fa-sliders'=>'sliders',
			'fa fa-sort'=>'sort',
			'fa fa-sort-amount-desc'=>'sort-amount-desc',
			'fa fa-sort-numeric-asc'=>'sort-numeric-asc',
			'fa fa-space-shuttle'=>'space-shuttle',
			'fa fa-square'=>'square',
			'fa fa-star'=>'star',
			'fa fa-star-half-o'=>'star-half-o',
			'fa fa-step-backward'=>'step-backward',
			'fa fa-sticky-note-o'=>'sticky-note-o',
			'fa fa-street-view'=>'street-view',
			'fa fa-subscript'=>'subscript',
			'fa fa-tablet'=>'tablet',
			'fa fa-tasks'=>'tasks',
			'fa fa-tencent-weibo'=>'tencent-weibo',
			'fa fa-th'=>'th',
			'fa fa-thumbs-down'=>'thumbs-down',
			'fa fa-thumbs-up'=>'thumbs-up',
			'fa fa-times-circle-o'=>'times-circle-o',
			'fa fa-toggle-down'=>'toggle-down',
			'fa fa-toggle-right'=>'toggle-right',
			'fa fa-transgender'=>'transgender',
			'fa fa-tree'=>'tree',
			'fa fa-truck'=>'truck',
			'fa fa-tumblr-square'=>'tumblr-square',
			'fa fa-twitter'=>'twitter',
			'fa fa-undo'=>'undo',
			'fa fa-unlock'=>'unlock',
			'fa fa-user-secret'=>'user-secret',
			'fa fa-viacoin'=>'viacoin',
			'fa fa-vimeo'=>'vimeo',
			'fa fa-warning'=>'warning',
			'fa fa-whatsapp'=>'whatsapp',
			'fa fa-wikipedia-w'=>'wikipedia-w',
			'fa fa-wordpress'=>'wordpress',
			'fa fa-wrench'=>'wrench',
			'fa fa-y-combinator-square'=>'y-combinator-square',
			'fa fa-yen'=>'yen',
			'fa fa-youtube-square'=>'youtube-square',
			'fa fa-align-center'=>'align-center',
			'fa fa-amazon'=>'amazon',
			'fa fa-android'=>'android',
			'fa fa-angle-double-down'=>'angle-double-down',
			'fa fa-angle-down'=>'angle-down',
			'fa fa-apple'=>'apple',
			'fa fa-arrow-circle-left'=>'arrow-circle-left',
			'fa fa-arrow-circle-o-up'=>'arrow-circle-o-up',
			'fa fa-arrow-left'=>'arrow-left',
			'fa fa-arrows-alt'=>'arrows-alt',
			'fa fa-automobile'=>'automobile',
			'fa fa-barcode'=>'barcode',
			'fa fa-battery'=>'battery',
			'fa fa-battery-3'=>'battery-3',
			'fa fa-battery-half'=>'battery-half',
			'fa fa-beer'=>'beer',
			'fa fa-bell-o'=>'bell-o',
			'fa fa-binoculars'=>'binoculars',
			'fa fa-bitcoin'=>'bitcoin',
			'fa fa-book'=>'book',
			'fa fa-briefcase'=>'briefcase',
			'fa fa-building-o'=>'building-o',
			'fa fa-buysellads'=>'buysellads',
			'fa fa-calendar-check-o'=>'calendar-check-o',
			'fa fa-calendar-times-o'=>'calendar-times-o',
			'fa fa-caret-down'=>'caret-down',
			'fa fa-caret-square-o-left'=>'caret-square-o-left',
			'fa fa-cart-arrow-down'=>'cart-arrow-down',
			'fa fa-cc-diners-club'=>'cc-diners-club',
			'fa fa-cc-paypal'=>'cc-paypal',
			'fa fa-chain'=>'chain',
			'fa fa-check-circle-o'=>'check-circle-o',
			'fa fa-chevron-circle-left'=>'chevron-circle-left',
			'fa fa-chevron-left'=>'chevron-left',
			'fa fa-chrome'=>'chrome',
			'fa fa-circle-thin'=>'circle-thin',
			'fa fa-close'=>'close',
			'fa fa-cny'=>'cny',
			'fa fa-columns'=>'columns',
			'fa fa-commenting-o'=>'commenting-o',
			'fa fa-compress'=>'compress',
			'fa fa-copyright'=>'copyright',
			'fa fa-crop'=>'crop',
			'fa fa-cubes'=>'cubes',
			'fa fa-dashcube'=>'dashcube',
			'fa fa-dedent'=>'dedent',
			'fa fa-diamond'=>'diamond',
			'fa fa-download'=>'download',
			'fa fa-dropbox'=>'dropbox',
			'fa fa-empire'=>'empire',
			'fa fa-exclamation'=>'exclamation',
			'fa fa-expeditedssl'=>'expeditedssl',
			'fa fa-eye-slash'=>'eye-slash',
			'fa fa-facebook-f'=>'facebook-f',
			'fa fa-fast-forward'=>'fast-forward',
			'fa fa-fighter-jet'=>'fighter-jet',
			'fa fa-file-code-o'=>'file-code-o',
			'fa fa-file-o'=>'file-o',
			'fa fa-file-powerpoint-o'=>'file-powerpoint-o',
			'fa fa-file-video-o'=>'file-video-o',
			'fa fa-film'=>'film',
			'fa fa-firefox'=>'firefox',
			'fa fa-flag-o'=>'flag-o',
			'fa fa-floppy-o'=>'floppy-o',
			'fa fa-folder-open-o'=>'folder-open-o',
			'fa fa-gavel'=>'gavel',
			'fa fa-gears'=>'gears',
			'fa fa-gg-circle'=>'gg-circle',
			'fa fa-github'=>'github',
			'fa fa-gittip'=>'gittip',
			'fa fa-globe'=>'globe',
			'fa fa-google-plus-square'=>'google-plus-square',
			'fa fa-hand-grab-o'=>'hand-grab-o',
			'fa fa-hand-o-right'=>'hand-o-right',
			'fa fa-hand-pointer-o'=>'hand-pointer-o',
			'fa fa-hand-stop-o'=>'hand-stop-o',
			'fa fa-hdd-o'=>'hdd-o',
			'fa fa-heart-o'=>'heart-o',
			'fa fa-hospital-o'=>'hospital-o',
			'fa fa-hourglass-2'=>'hourglass-2',
			'fa fa-hourglass-o'=>'hourglass-o',
			'fa fa-i-cursor'=>'i-cursor',
			'fa fa-ils'=>'ils',
			'fa fa-indent'=>'indent',
			'fa fa-inr'=>'inr',
			'fa fa-intersex'=>'intersex',
			'fa fa-jpy'=>'jpy',
			'fa fa-krw'=>'krw',
			'fa fa-lastfm-square'=>'lastfm-square',
			'fa fa-lemon-o'=>'lemon-o',
			'fa fa-life-buoy'=>'life-buoy',
			'fa fa-line-chart'=>'line-chart',
			'fa fa-list-ol'=>'list-ol',
			'fa fa-long-arrow-down'=>'long-arrow-down',
			'fa fa-mail-reply'=>'mail-reply',
			'fa fa-map-marker'=>'map-marker',
			'fa fa-mars'=>'mars',
			'fa fa-mars-stroke-v'=>'mars-stroke-v',
			'fa fa-medkit'=>'medkit',
			'fa fa-minus-circle'=>'minus-circle',
			'fa fa-mobile'=>'mobile',
			'fa fa-moon-o'=>'moon-o',
			'fa fa-music'=>'music',
			'fa fa-object-group'=>'object-group',
			'fa fa-opencart'=>'opencart',
			'fa fa-outdent'=>'outdent',
			'fa fa-paper-plane-o'=>'paper-plane-o',
			'fa fa-pause'=>'pause',
			'fa fa-paypal'=>'paypal',
			'fa fa-picture-o'=>'picture-o',
			'fa fa-pied-piper-pp'=>'pied-piper-pp',
			'fa fa-plane'=>'plane',
			'fa fa-plug'=>'plug',
			'fa fa-plus-square-o'=>'plus-square-o',
			'fa fa-question'=>'question',
			'fa fa-quote-left'=>'quote-left',
			'fa fa-remove'=>'remove',
			'fa fa-reply'=>'reply',
			'fa fa-rmb'=>'rmb',
			'fa fa-rotate-right'=>'rotate-right',
			'fa fa-rub'=>'rub',
			'fa fa-safari'=>'safari',
			'fa fa-search'=>'search',
			'fa fa-send'=>'send',
			'fa fa-share-alt'=>'share-alt',
			'fa fa-shekel'=>'shekel',
			'fa fa-shirtsinbulk'=>'shirtsinbulk',
			'fa fa-signal'=>'signal',
			'fa fa-skyatlas'=>'skyatlas',
			'fa fa-slideshare'=>'slideshare',
			'fa fa-sort-alpha-asc'=>'sort-alpha-asc',
			'fa fa-sort-asc'=>'sort-asc',
			'fa fa-sort-numeric-desc'=>'sort-numeric-desc',
			'fa fa-spinner'=>'spinner',
			'fa fa-square-o'=>'square-o',
			'fa fa-star-half'=>'star-half',
			'fa fa-star-o'=>'star-o',
			'fa fa-step-forward'=>'step-forward',
			'fa fa-stop'=>'stop',
			'fa fa-strikethrough'=>'strikethrough',
			'fa fa-subway'=>'subway',
			'fa fa-superscript'=>'superscript',
			'fa fa-tachometer'=>'tachometer',
			'fa fa-taxi'=>'taxi',
			'fa fa-terminal'=>'terminal',
			'fa fa-th-large'=>'th-large',
			'fa fa-thumbs-o-down'=>'thumbs-o-down',
			'fa fa-ticket'=>'ticket',
			'fa fa-toggle-left'=>'toggle-left',
			'fa fa-toggle-right'=>'toggle-right',
			'fa fa-transgender'=>'transgender',
			'fa fa-tree'=>'tree',
			'fa fa-truck'=>'truck',
			'fa fa-tumblr-square'=>'tumblr-square',
			'fa fa-twitter'=>'twitter',
			'fa fa-undo'=>'undo',
			'fa fa-unlock'=>'unlock',
			'fa fa-user-secret'=>'user-secret',
			'fa fa-viacoin'=>'viacoin',
			'fa fa-vimeo'=>'vimeo',
			'fa fa-warning'=>'warning',
			'fa fa-whatsapp'=>'whatsapp',
			'fa fa-wikipedia-w'=>'wikipedia-w',
			'fa fa-wordpress'=>'wordpress',
			'fa fa-wrench'=>'wrench',
			'fa fa-y-combinator-square'=>'y-combinator-square',
			'fa fa-yelp'=>'yelp',
			'fa fa-youtube-play'=>'youtube-play'
		);
		return $font_data;
	}
	
	function gethashcode_font($font_cod='')
	{
		$hash_data = '';
		$font_data = array(
			'fa fa-500px'=>'&#xf26e;',
			'fa fa-align-justify'=>'&#xf039;',
			'fa fa-ambulance'=>'&#xf0f9;',
			'fa fa-angle-double-left'=>'&#xf100;',
			'fa fa-angle-left'=>'&#xf104;',
			'fa fa-archive'=>'&#xf187;',
			'fa fa-arrow-circle-o-down'=>'&#xf01a;',
			'fa fa-arrow-circle-right'=>'&#xf0a9;',
			'fa fa-arrow-right'=>'&#xf061;',
			'fa fa-arrows-h'=>'&#xf07e;',
			'fa fa-asterisk'=>'&#xf069;',
			'fa fa-backward'=>'&#xf04a;',
			'fa fa-bank'=>'&#xf19c;',
			'fa fa-bars'=>'&#xf0c9;',
			'fa fa-battery-0'=>'&#xf244;',
			'fa fa-battery-4'=>'&#xf240;',
			'fa fa-battery-quarter'=>'&#xf243;',
			'fa fa-behance'=>'&#xf1b4;',
			'fa fa-bell-slash'=>'&#xf1f6;',
			'fa fa-birthday-cake'=>'&#xf1fd;',
			'fa fa-black-tie'=>'&#xf27e;',
			'fa fa-bold'=>'&#xf032;',
			'fa fa-bookmark'=>'&#xf02e;',
			'fa fa-btc'=>'&#xf15a;',
			'fa fa-bullhorn'=>'&#xf0a1;',
			'fa fa-cab'=>'&#xf1ba;',
			'fa fa-calendar-minus-o'=>'&#xf272;',
			'fa fa-camera'=>'&#xf030;',
			'fa fa-caret-left'=>'&#xf0d9;',
			'fa fa-caret-square-o-right'=>'&#xf152;',
			'fa fa-cart-plus'=>'&#xf217;',
			'fa fa-cc-discover'=>'&#xf1f2;',
			'fa fa-cc-stripe'=>'&#xf1f5;',
			'fa fa-chain-broken'=>'&#xf127;',
			'fa fa-check-square'=>'&#xf14a;',
			'fa fa-chevron-circle-right'=>'&#xf138;',
			'fa fa-chevron-right'=>'&#xf054',
			'fa fa-circle'=>'&#xf111;',
			'fa fa-clipboard'=>'&#xf0ea;',
			'fa fa-cloud'=>'&#xf0c2;',
			'fa fa-code'=>'&#xf121;',
			'fa fa-coffee'=>'&#xf0f4;',
			'fa fa-comment'=>'&#xf075;',
			'fa fa-comments'=>'&#xf086;',
			'fa fa-connectdevelop'=>'&#xf20e;',
			'fa fa-creative-commons'=>'&#xf25e;',
			'fa fa-crosshairs'=>'&#xf05b;',
			'fa fa-cut'=>'&#xf0c4;',
			'fa fa-database'=>'&#xf1c0;',
			'fa fa-delicious'=>'&#xf1a5;',
			'fa fa-digg'=>'&#xf1a6;',
			'fa fa-dribbble'=>'&#xf17d;',
			'fa fa-drupal'=>'&#xf1a9;',
			'fa fa-eject'=>'&#xf052;',
			'fa fa-envelope'=>'&#xf0e0;',
			'fa fa-envelope-square'=>'&#xf199;',
			'fa fa-eur'=>'&#xf153;',
			'fa fa-exclamation-circle'=>'&#xf06a;',
			'fa fa-external-link'=>'&#xf08e;',
			'fa fa-eyedropper'=>'&#xf1fb;',
			'fa fa-facebook-official'=>'&#xf230;',
			'fa fa-fax'=>'&#xf1ac;',
			'fa fa-file'=>'&#xf15b;',
			'fa fa-file-excel-o'=>'&#xf1c3;',
			'fa fa-file-pdf-o'=>'&#xf1c1;',
			'fa fa-file-sound-o'=>'&#xf1c7;',
			'fa fa-file-word-o'=>'&#xf1c2;',
			'fa fa-filter'=>'&#xf0b0;',
			'fa fa-flash'=>'&#xf0e7;',
			'fa fa-folder'=>'&#xf07b;',
			'fa fa-forumbee'=>'&#xf211;',
			'fa fa-frown-o'=>'&#xf119;',
			'fa fa-gbp'=>'&#xf154;',
			'fa fa-genderless'=>'&#xf22d;',
			'fa fa-gift'=>'&#xf06b;',
			'fa fa-github-alt'=>'&#xf113;',
			'fa fa-google'=>'&#xf1a0;',
			'fa fa-google-wallet'=>'&#xf1ee;',
			'fa fa-group'=>'&#xf0c0;',
			'fa fa-hand-lizard-o'=>'&#xf258;',
			'fa fa-hand-o-up'=>'&#xf0a6;',
			'fa fa-hand-rock-o'=>'&#xf255;',
			'fa fa-header'=>'&#xf1dc;',
			'fa fa-heartbeat'=>'&#xf21e;',
			'fa fa-hotel'=>'&#xf236;',
			'fa fa-hourglass-3'=>'&#xf253;',
			'fa fa-hourglass-start'=>'&#xf251;',
			'fa fa-image'=>'&#xf03e;',
			'fa fa-industry'=>'&#xf275;',
			'fa fa-ioxhost'=>'&#xf208;',
			'fa fa-jsfiddle'=>'&#xf1cc;',
			'fa fa-language'=>'&#xf1ab;',
			'fa fa-leaf'=>'&#xf06c;',
			'fa fa-level-down'=>'&#xf149;',
			'fa fa-life-ring'=>'&#xf1cd;',
			'fa fa-link'=>'&#xf0c1;',
			'fa fa-linux'=>'&#xf17c;',
			'fa fa-list-ul'=>'&#xf0ca;',
			'fa fa-long-arrow-left'=>'&#xf177;',
			'fa fa-magic'=>'&#xf0d0;',
			'fa fa-mail-reply-all'=>'&#xf122;',
			'fa fa-map-o'=>'&#xf278;',
			'fa fa-mars-double'=>'&#xf227;',
			'fa fa-maxcdn'=>'&#xf136;',
			'fa fa-meetup'=>'&#xf2e0;',
			'fa fa-microphone'=>'&#xf130;',
			'fa fa-minus-square'=>'&#xf146;',
			'fa fa-mobile-phone'=>'&#xf10b;',
			'fa fa-mortar-board'=>'&#xf19d;',
			'fa fa-navicon'=>'&#xf0c9;',
			'fa fa-object-ungroup'=>'&#xf248;',
			'fa fa-openid'=>'&#xf19b;',
			'fa fa-pagelines'=>'&#xf18c;',
			'fa fa-paperclip'=>'&#xf0c6;',
			'fa fa-pencil'=>'&#xf040;',
			'fa fa-phone'=>'&#xf095;',
			'fa fa-pie-chart'=>'&#xf200;',
			'fa fa-pinterest'=>'&#xf0d2;',
			'fa fa-play'=>'&#xf04b;',
			'fa fa-plus'=>'&#xf067;',
			'fa fa-puzzle-piece'=>'&#xf12e;',
			'fa fa-question-circle'=>'&#xf059;',
			'fa fa-quote-right'=>'&#xf10e;',
			'fa fa-rebel'=>'&#xf1d0;',
			'fa fa-reddit-square'=>'&#xf1a2;',
			'fa fa-renren'=>'&#xf18b;',
			'fa fa-reply-all'=>'&#xf122;',
			'fa fa-road'=>'&#xf018;',
			'fa fa-rouble'=>'&#xf158;',
			'fa fa-ruble'=>'&#xf158;',
			'fa fa-save'=>'&#xf0c7;',
			'fa fa-search-minus'=>'&#xf010;',
			'fa fa-send-o'=>'&#xf1d9;',
			'fa fa-share-alt-square'=>'&#xf1e1;',
			'fa fa-sheqel'=>'&#xf20b;',
			'fa fa-sign-in'=>'&#xf090;',
			'fa fa-skype'=>'&#xf17e;',
			'fa fa-smile-o'=>'&#xf118;',
			'fa fa-sort-alpha-desc'=>'&#xf15e;',
			'fa fa-sort-desc'=>'&#xf0dd;',
			'fa fa-sort-up'=>'&#xf0de;',
			'fa fa-spoon'=>'&#xf1b1;',
			'fa fa-stack-exchange'=>'&#xf18d;',
			'fa fa-star-half-empty'=>'&#xf123;',
			'fa fa-steam'=>'&#xf1b6;',
			'fa fa-stethoscope'=>'&#xf0f1;',
			'fa fa-stumbleupon'=>'&#xf1a4;',
			'fa fa-suitcase'=>'&#xf0f2;',
			'fa fa-support'=>'&#xf1cd;',
			'fa fa-tag'=>'&#xf02b;',
			'fa fa-text-height'=>'&#xf034;',
			'fa fa-th-list'=>'&#xf00b;',
			'fa fa-toggle-off'=>'&#xf204;',
			'fa fa-trademark'=>'&#xf25c;',
			'fa fa-trash'=>'&#xf1f8;',
			'fa fa-tripadvisor'=>'&#xf262;',
			'fa fa-tty'=>'&#xf1e4;',
			'fa fa-tv'=>'&#xf26c;',
			'fa fa-umbrella'=>'&#xf0e9;',
			'fa fa-university'=>'&#xf19c;',
			'fa fa-unsorted'=>'&#xf0dc;',
			'fa fa-user'=>'&#xf007;',
			'fa fa-users'=>'&#xf0c0;',
			'fa fa-venus-double'=>'&#xf226;',
			'fa fa-vine'=>'&#xf1ca;',
			'fa fa-volume-off'=>'&#xf026;',
			'fa fa-weibo'=>'&#xf18a;',
			'fa fa-windows'=>'&#xf17a;',
			'fa fa-xing-square'=>'&#xf169;',
			'fa fa-yc-square'=>'&#xf1d4;',
			'fa fa-youtube'=>'&#xf167;',
			'fa fa-adjust'=>'&#xf042;',
			'fa fa-align-left'=>'&#xf036;',
			'fa fa-angle-double-right'=>'&#xf101;',
			'fa fa-angle-right'=>'&#xf105;',
			'fa fa-area-chart'=>'&#xf1fe;',
			'fa fa-arrow-circle-o-left'=>'&#xf190;',
			'fa fa-arrow-circle-up'=>'&#xf0aa;',
			'fa fa-arrow-up'=>'&#xf062;',
			'fa fa-arrows-v'=>'&#xf07d;',
			'fa fa-balance-scale'=>'&#xf24e;',
			'fa fa-battery-1'=>'&#xf243;',
			'fa fa-battery-empty'=>'&#xf244;',
			'fa fa-battery-three-quarters'=>'&#xf241;',
			'fa fa-behance-square'=>'&#xf1b5;',
			'fa fa-bitbucket'=>'&#xf171;',
			'fa fa-bolt'=>'&#xf0e7;',
			'fa fa-bookmark-o'=>'&#xf097;',
			'fa fa-bug'=>'&#xf188;',
			'fa fa-bullseye'=>'&#xf140;',
			'fa fa-calculator'=>'&#xf1ec;',
			'fa fa-calendar-o'=>'&#xf133;',
			'fa fa-camera-retro'=>'&#xf083;',
			'fa fa-caret-right'=>'&#xf0da;',
			'fa fa-caret-square-o-up'=>'&#xf151;',
			'fa fa-cc'=>'&#xf20a;',
			'fa fa-cc-jcb'=>'&#xf24b;',
			'fa fa-cc-visa'=>'&#xf1f0;',
			'fa fa-check'=>'&#xf00c;',
			'fa fa-check-square-o'=>'&#xf046;',
			'fa fa-chevron-circle-up'=>'&#xf139;',
			'fa fa-chevron-up'=>'&#xf077;',
			'fa fa-circle-o'=>'&#xf10c;',
			'fa fa-clock-o'=>'&#xf017;',
			'fa fa-cloud-download'=>'&#xf0ed;',
			'fa fa-code-fork'=>'&#xf126;',
			'fa fa-cog'=>'&#xf013;',
			'fa fa-comment-o'=>'&#xf0e5;',
			'fa fa-comments-o'=>'&#xf0e6;',
			'fa fa-contao'=>'&#xf26d;',
			'fa fa-credit-card'=>'&#xf09d;',
			'fa fa-css3'=>'&#xf13c;',
			'fa fa-cutlery'=>'&#xf0f5;',
			'fa fa-desktop'=>'&#xf108;',
			'fa fa-dollar'=>'&#xf155;',
			'fa fa-edge'=>'&#xf282;',
			'fa fa-ellipsis-h'=>'&#xf141;',
			'fa fa-envelope-o'=>'&#xf003;',
			'fa fa-euro'=>'&#xf153;',
			'fa fa-exclamation-triangle'=>'&#xf071;',
			'fa fa-external-link-square'=>'&#xf14c;',
			'fa fa-facebook-square'=>'&#xf082;',
			'fa fa-feed'=>'&#xf09e;',
			'fa fa-file-archive-o'=>'&#xf1c6;',
			'fa fa-file-image-o'=>'&#xf1c5;',
			'fa fa-file-photo-o'=>'&#xf1c5;',
			'fa fa-file-text'=>'&#xf15c;',
			'fa fa-file-zip-o'=>'&#xf1c6;',
			'fa fa-fire'=>'&#xf06d;',
			'fa fa-flag'=>'&#xf024;',
			'fa fa-flask'=>'&#xf0c3;',
			'fa fa-folder-o'=>'&#xf114;',
			'fa fa-forward'=>'&#xf04e;',
			'fa fa-futbol-o'=>'&#xf1e3;',
			'fa fa-ge'=>'&#xf1d1;',
			'fa fa-get-pocket'=>'&#xf265;',
			'fa fa-git'=>'&#xf1d3;',
			'fa fa-github-square'=>'&#xf092;',
			'fa fa-google-plus'=>'&#xf0d5;',
			'fa fa-graduation-cap'=>'&#xf19d;',
			'fa fa-h-square'=>'&#xf0fd;',
			'fa fa-hand-o-down'=>'&#xf0a7;',
			'fa fa-hand-paper-o'=>'&#xf256;',
			'fa fa-hand-scissors-o'=>'&#xf257;',
			'fa fa-hard-of-hearing'=>'&#xf2a4;',
			'fa fa-headphones'=>'&#xf025;',
			'fa fa-history'=>'&#xf1da;',
			'fa fa-hourglass'=>'&#xf254;',
			'fa fa-hourglass-end'=>'&#xf253;',
			'fa fa-houzz'=>'&#xf27c;',
			'fa fa-info'=>'&#xf129;',
			'fa fa-institution'=>'&#xf19c;',
			'fa fa-italic'=>'&#xf033;',
			'fa fa-key'=>'&#xf084;',
			'fa fa-laptop'=>'&#xf109;',
			'fa fa-leanpub'=>'&#xf212;',
			'fa fa-level-up'=>'&#xf148;',
			'fa fa-life-saver'=>'&#xf1cd;',
			'fa fa-linkedin'=>'&#xf0e1;',
			'fa fa-list'=>'&#xf03a;',
			'fa fa-location-arrow'=>'&#xf124;',
			'fa fa-long-arrow-right'=>'&#xf178;',
			'fa fa-magnet'=>'&#xf076;',
			'fa fa-male'=>'&#xf183;',
			'fa fa-map-pin'=>'&#xf276;',
			'fa fa-mars-stroke'=>'&#xf229;',
			'fa fa-meanpath'=>'&#xf20c;',
			'fa fa-meh-o'=>'&#xf11a;',
			'fa fa-microphone-slash'=>'&#xf131;',
			'fa fa-minus-square-o'=>'&#xf147;',
			'fa fa-motorcycle'=>'&#xf21c;',
			'fa fa-neuter'=>'&#xf22c;',
			'fa fa-odnoklassniki'=>'&#xf263;',
			'fa fa-opera'=>'&#xf26a;',
			'fa fa-paint-brush'=>'&#xf1fc;',
			'fa fa-paragraph'=>'&#xf1dd;',
			'fa fa-pencil-square'=>'&#xf14b;',
			'fa fa-phone-square'=>'&#xf098;',
			'fa fa-pinterest-p'=>'&#xf231;',
			'fa fa-play-circle'=>'&#xf144;',
			'fa fa-plus-circle'=>'&#xf055;',
			'fa fa-power-off'=>'&#xf011;',
			'fa fa-qq'=>'&#xf1d6;',
			'fa fa-ra'=>'&#xf1d0;',
			'fa fa-recycle'=>'&#xf1b8;',
			'fa fa-refresh'=>'&#xf021;',
			'fa fa-reorder'=>'&#xf0c9;',
			'fa fa-resistance'=>'&#xf1d0;',
			'fa fa-rocket'=>'&#xf135;',
			'fa fa-rss'=>'&#xf09e;',
			'fa fa-rupee'=>'&#xf156;',
			'fa fa-scissors'=>'&#xf0c4;',
			'fa fa-search-plus'=>'&#xf00e;',
			'fa fa-server'=>'&#xf233;',
			'fa fa-share-square'=>'&#xf14d;',
			'fa fa-shield'=>'&#xf132;',
			'fa fa-simplybuilt'=>'&#xf215;',
			'fa fa-slack'=>'&#xf198;',
			'fa fa-soccer-ball-o'=>'&#xf1e3;',
			'fa fa-sort-amount-asc'=>'&#xf160;',
			'fa fa-sort-down'=>'&#xf0dd;',
			'fa fa-soundcloud'=>'&#xf1be;',
			'fa fa-spotify'=>'&#xf1bc;',
			'fa fa-stack-overflow'=>'&#xf16c;',
			'fa fa-star-half-full'=>'&#xf123;',
			'fa fa-steam-square'=>'&#xf1b7;',
			'fa fa-sticky-note'=>'&#xf249;',
			'fa fa-stop-circle-o'=>'&#xf28e;',
			'fa fa-stumbleupon-circle'=>'&#xf1a3;',
			'fa fa-sun-o'=>'&#xf185;',
			'fa fa-table'=>'&#xf0ce;',
			'fa fa-tags'=>'&#xf02c;',
			'fa fa-television'=>'&#xf26c;',
			'fa fa-text-width'=>'&#xf035;',
			'fa fa-thumb-tack'=>'&#xf08d;',
			'fa fa-thumbs-o-up'=>'&#xf087;',
			'fa fa-times-circle'=>'&#xf057;',
			'fa fa-tint'=>'&#xf043;',
			'fa fa-toggle-on'=>'&#xf205;',
			'fa fa-train'=>'&#xf238;',
			'fa fa-trash-o'=>'&#xf014;',
			'fa fa-trophy'=>'&#xf091;',
			'fa fa-tumblr'=>'&#xf173;',
			'fa fa-twitch'=>'&#xf1e8;',
			'fa fa-underline'=>'&#xf0cd;',
			'fa fa-unlink'=>'&#xf127;',
			'fa fa-upload'=>'&#xf093;',
			'fa fa-user-plus'=>'&#xf234;',
			'fa fa-venus-mars'=>'&#xf228;',
			'fa fa-video-camera'=>'&#xf03d;',
			'fa fa-vk'=>'&#xf189;',
			'fa fa-volume-up'=>'&#xf028;',
			'fa fa-weixin'=>'&#xf1d7;',
			'fa fa-wifi'=>'&#xf1eb;',
			'fa fa-won'=>'&#xf159;',
			'fa fa-y-combinator'=>'&#xf23b;',
			'fa fa-yelp'=>'&#xf1e9;',
			'fa fa-youtube-play'=>'&#xf16a;',
			'fa fa-adn'=>'&#xf170;',
			'fa fa-align-right'=>'&#xf038;',
			'fa fa-anchor'=>'&#xf13d;',
			'fa fa-angellist'=>'&#xf209;',
			'fa fa-angle-double-up'=>'&#xf102;',
			'fa fa-angle-up'=>'&#xf106;',
			'fa fa-arrow-circle-down'=>'&#xf0ab;',
			'fa fa-arrow-circle-o-right'=>'&#xf18e;',
			'fa fa-arrow-down'=>'&#xf063;',
			'fa fa-arrows'=>'&#xf047;',
			'fa fa-ban'=>'&#xf05e;',
			'fa fa-bar-chart-o'=>'&#xf080;',
			'fa fa-battery-2'=>'&#xf242;',
			'fa fa-battery-full'=>'&#xf240;',
			'fa fa-bed'=>'&#xf236;',
			'fa fa-bell'=>'&#xf0f3;',
			'fa fa-bicycle'=>'&#xf206;',
			'fa fa-bitbucket-square'=>'&#xf172;',
			'fa fa-bomb'=>'&#xf1e2;',
			'fa fa-building'=>'&#xf1ad;',
			'fa fa-bus'=>'&#xf207;',
			'fa fa-calendar'=>'&#xf073;',
			'fa fa-calendar-plus-o'=>'&#xf271;',
			'fa fa-car'=>'&#xf1b9;',
			'fa fa-caret-square-o-down'=>'&#xf150;',
			'fa fa-caret-up'=>'&#xf0d8;',
			'fa fa-cc-amex'=>'&#xf1f3;',
			'fa fa-cc-mastercard'=>'&#xf1f1;',
			'fa fa-certificate'=>'&#xf0a3;',
			'fa fa-check-circle'=>'&#xf058;',
			'fa fa-chevron-circle-down'=>'&#xf13a;',
			'fa fa-chevron-down'=>'&#xf078;',
			'fa fa-child'=>'&#xf1ae;',
			'fa fa-circle-o-notch'=>'&#xf1ce;',
			'fa fa-clone'=>'&#xf24d;',
			'fa fa-cloud-upload'=>'&#xf0ee;',
			'fa fa-codepen'=>'&#xf1cb;',
			'fa fa-cogs'=>'&#xf085;',
			'fa fa-commenting'=>'&#xf27a;',
			'fa fa-compass'=>'&#xf14e;',
			'fa fa-copy'=>'&#xf0c5;',
			'fa fa-cube'=>'&#xf1b2;',
			'fa fa-dashboard'=>'&#xf0e4;',
			'fa fa-deviantart'=>'&#xf1bd;',
			'fa fa-dot-circle-o'=>'&#xf192;',
			'fa fa-edit'=>'&#xf044;',
			'fa fa-ellipsis-v'=>'&#xf142;',
			'fa fa-eraser'=>'&#xf12d;',
			'fa fa-exchange'=>'&#xf0ec;',
			'fa fa-expand'=>'&#xf065;',
			'fa fa-eye'=>'&#xf06e;',
			'fa fa-facebook'=>'&#xf09a;',
			'fa fa-fast-backward'=>'&#xf049;',
			'fa fa-female'=>'&#xf182;',
			'fa fa-file-audio-o'=>'&#xf1c7;',
			'fa fa-file-movie-o'=>'&#xf1c8;',
			'fa fa-file-picture-o'=>'&#xf1c5;',
			'fa fa-file-text-o'=>'&#xf0f6;',
			'fa fa-files-o'=>'&#xf0c5;',
			'fa fa-fire-extinguisher'=>'&#xf134;',
			'fa fa-flag-checkered'=>'&#xf11e;',
			'fa fa-flickr'=>'&#xf16e;',
			'fa fa-folder-open'=>'&#xf07c;',
			'fa fa-fonticons'=>'&#xf280;',
			'fa fa-foursquare'=>'&#xf180;',
			'fa fa-gamepad'=>'&#xf11b;',
			'fa fa-gear'=>'&#xf013;',
			'fa fa-gg'=>'&#xf260;',
			'fa fa-git-square'=>'&#xf1d2;',
			'fa fa-gratipay'=>'&#xf184;',
			'fa fa-hacker-news'=>'&#xf1d4;',
			'fa fa-hand-o-left'=>'&#xf0a5;',
			'fa fa-hand-peace-o'=>'&#xf25b;',
			'fa fa-hand-spock-o'=>'&#xf259;',
			'fa fa-heart'=>'&#xf004;',
			'fa fa-home'=>'&#xf015;',
			'fa fa-hourglass-1'=>'&#xf251;',
			'fa fa-hourglass-half'=>'&#xf252;',
			'fa fa-html5'=>'&#xf13b;',
			'fa fa-inbox'=>'&#xf01c;',
			'fa fa-info-circle'=>'&#xf05a;',
			'fa fa-internet-explorer'=>'&#xf26b;',
			'fa fa-joomla'=>'&#xf1aa;',
			'fa fa-keyboard-o'=>'&#xf11c;',
			'fa fa-lastfm'=>'&#xf202;',
			'fa fa-legal'=>'&#xf0e3;',
			'fa fa-life-bouy'=>'&#xf1cd;',
			'fa fa-lightbulb-o'=>'&#xf0eb;',
			'fa fa-linkedin-square'=>'&#xf08c;',
			'fa fa-list-alt'=>'&#xf022;',
			'fa fa-lock'=>'&#xf023;',
			'fa fa-long-arrow-up'=>'&#xf176;',
			'fa fa-mail-forward'=>'&#xf064;',
			'fa fa-map'=>'&#xf279;',
			'fa fa-map-signs'=>'&#xf277;',
			'fa fa-mars-stroke-h'=>'&#xf22b;',
			'fa fa-medium'=>'&#xf23a;',
			'fa fa-mercury'=>'&#xf223;',
			'fa fa-minus'=>'&#xf068;',
			'fa fa-money'=>'&#xf0d6;',
			'fa fa-mouse-pointer'=>'&#xf245;',
			'fa fa-newspaper-o'=>'&#xf1ea;',
			'fa fa-odnoklassniki-square'=>'&#xf264;',
			'fa fa-optin-monster'=>'&#xf23c;',
			'fa fa-paper-plane'=>'&#xf1d8;',
			'fa fa-paste'=>'&#xf0ea;',
			'fa fa-paw'=>'&#xf1b0;',
			'fa fa-pencil-square-o'=>'&#xf044;',
			'fa fa-photo'=>'&#xf03e;',
			'fa fa-pied-piper-alt'=>'&#xf1a8;',
			'fa fa-pinterest-square'=>'&#xf0d3;',
			'fa fa-play-circle-o'=>'&#xf01d;',
			'fa fa-plus-square'=>'&#xf0fe;',
			'fa fa-print'=>'&#xf02f;',
			'fa fa-qrcode'=>'&#xf029;',
			'fa fa-random'=>'&#xf074;',
			'fa fa-reddit'=>'&#xf1a1;',
			'fa fa-registered'=>'&#xf25d;',
			'fa fa-repeat'=>'&#xf01e;',
			'fa fa-retweet'=>'&#xf079;',
			'fa fa-rotate-left'=>'&#xf0e2;',
			'fa fa-rss-square'=>'&#xf143;',
			'fa fa-sellsy'=>'&#xf213;',
			'fa fa-share'=>'&#xf064;',
			'fa fa-share-square-o'=>'&#xf045;',
			'fa fa-ship'=>'&#xf21a;',
			'fa fa-shopping-cart'=>'&#xf07a;',
			'fa fa-sign-out'=>'&#xf08b;',
			'fa fa-sitemap'=>'&#xf0e8;',
			'fa fa-sliders'=>'&#xf1de;',
			'fa fa-sort'=>'&#xf0dc;',
			'fa fa-sort-amount-desc'=>'&#xf161;',
			'fa fa-sort-numeric-asc'=>'&#xf162;',
			'fa fa-space-shuttle'=>'&#xf197;',
			'fa fa-square'=>'&#xf0c8;',
			'fa fa-star'=>'&#xf005;',
			'fa fa-star-half-o'=>'&#xf123;',
			'fa fa-step-backward'=>'&#xf048;',
			'fa fa-sticky-note-o'=>'&#xf24a;',
			'fa fa-street-view'=>'&#xf21d;',
			'fa fa-subscript'=>'&#xf12c;',
			'fa fa-tablet'=>'&#xf10a;',
			'fa fa-tasks'=>'&#xf0ae;',
			'fa fa-tencent-weibo'=>'&#xf1d5;',
			'fa fa-th'=>'&#xf00a;',
			'fa fa-thumbs-down'=>'&#xf165;',
			'fa fa-thumbs-up'=>'&#xf164;',
			'fa fa-times-circle-o'=>'&#xf05c;',
			'fa fa-toggle-down'=>'&#xf150;',
			'fa fa-toggle-right'=>'&#xf152;',
			'fa fa-transgender'=>'&#xf224;',
			'fa fa-tree'=>'&#xf1bb;',
			'fa fa-truck'=>'&#xf0d1;',
			'fa fa-tumblr-square'=>'&#xf174;',
			'fa fa-twitter'=>'&#xf099;',
			'fa fa-undo'=>'&#xf0e2;',
			'fa fa-unlock'=>'&#xf09c;',
			'fa fa-user-secret'=>'&#xf21b;',
			'fa fa-viacoin'=>'&#xf237;',
			'fa fa-vimeo'=>'&#xf27d;',
			'fa fa-warning'=>'&#xf071;',
			'fa fa-whatsapp'=>'&#xf232;',
			'fa fa-wikipedia-w'=>'&#xf266;',
			'fa fa-wordpress'=>'&#xf19a;',
			'fa fa-wrench'=>'&#xf0ad;',
			'fa fa-y-combinator-square'=>'&#xf1d4;',
			'fa fa-yen'=>'&#xf157;',
			'fa fa-youtube-square'=>'&#xf166;',
			'fa fa-align-center'=>'&#xf037;',
			'fa fa-amazon'=>'&#xf270;',
			'fa fa-android'=>'&#xf17b;',
			'fa fa-angle-double-down'=>'&#xf103;',
			'fa fa-angle-down'=>'&#xf107;',
			'fa fa-apple'=>'&#xf179;',
			'fa fa-arrow-circle-left'=>'&#xf0a8;',
			'fa fa-arrow-circle-o-up'=>'&#xf01b;',
			'fa fa-arrow-left'=>'&#xf060;',
			'fa fa-arrows-alt'=>'&#xf0b2;',
			'fa fa-automobile'=>'&#xf1b9;',
			'fa fa-barcode'=>'&#xf02a;',
			'fa fa-battery'=>'&#xf240;',
			'fa fa-battery-3'=>'&#xf241;',
			'fa fa-battery-half'=>'&#xf242;',
			'fa fa-beer'=>'&#xf0fc;',
			'fa fa-bell-o'=>'&#xf0a2;',
			'fa fa-binoculars'=>'&#xf1e5;',
			'fa fa-bitcoin'=>'&#xf15a;',
			'fa fa-book'=>'&#xf02d;',
			'fa fa-briefcase'=>'&#xf0b1;',
			'fa fa-building-o'=>'&#xf0f7;',
			'fa fa-buysellads'=>'&#xf20d;',
			'fa fa-calendar-check-o'=>'&#xf274;',
			'fa fa-calendar-times-o'=>'&#xf273;',
			'fa fa-caret-down'=>'&#xf0d7;',
			'fa fa-caret-square-o-left'=>'&#xf191;',
			'fa fa-cart-arrow-down'=>'&#xf218;',
			'fa fa-cc-diners-club'=>'&#xf24c;',
			'fa fa-cc-paypal'=>'&#xf1f4;',
			'fa fa-chain'=>'&#xf0c1;',
			'fa fa-check-circle-o'=>'&#xf05d;',
			'fa fa-chevron-circle-left'=>'&#xf137;',
			'fa fa-chevron-left'=>'&#xf053;',
			'fa fa-chrome'=>'&#xf268;',
			'fa fa-circle-thin'=>'&#xf1db;',
			'fa fa-close'=>'&#xf00d;',
			'fa fa-cny'=>'&#xf157;',
			'fa fa-columns'=>'&#xf0db;',
			'fa fa-commenting-o'=>'&#xf27b;',
			'fa fa-compress'=>'&#xf066;',
			'fa fa-copyright'=>'&#xf1f9;',
			'fa fa-crop'=>'&#xf125;',
			'fa fa-cubes'=>'&#xf1b3;',
			'fa fa-dashcube'=>'&#xf210;',
			'fa fa-dedent'=>'&#xf03b;',
			'fa fa-diamond'=>'&#xf219;',
			'fa fa-download'=>'&#xf019;',
			'fa fa-dropbox'=>'&#xf16b;',
			'fa fa-empire'=>'&#xf1d1;',
			'fa fa-exclamation'=>'&#xf12a;',
			'fa fa-expeditedssl'=>'&#xf23e;',
			'fa fa-eye-slash'=>'&#xf070;',
			'fa fa-facebook-f'=>'&#xf09a;',
			'fa fa-fast-forward'=>'&#xf050;',
			'fa fa-fighter-jet'=>'&#xf0fb;',
			'fa fa-file-code-o'=>'&#xf1c9;',
			'fa fa-file-o'=>'&#xf016;',
			'fa fa-file-powerpoint-o'=>'&#xf1c4;',
			'fa fa-file-video-o'=>'&#xf1c8;',
			'fa fa-film'=>'&#xf008;',
			'fa fa-firefox'=>'&#xf269;',
			'fa fa-flag-o'=>'&#xf11d;',
			'fa fa-floppy-o'=>'&#xf0c7;',
			'fa fa-folder-open-o'=>'&#xf115;',
			'fa fa-gavel'=>'&#xf0e3;',
			'fa fa-gears'=>'&#xf085;',
			'fa fa-gg-circle'=>'&#xf261;',
			'fa fa-github'=>'&#xf09b;',
			'fa fa-gittip'=>'&#xf184;',
			'fa fa-globe'=>'&#xf0ac;',
			'fa fa-google-plus-square'=>'&#xf0d4;',
			'fa fa-hand-grab-o'=>'&#xf255;',
			'fa fa-hand-o-right'=>'&#xf0a4;',
			'fa fa-hand-pointer-o'=>'&#xf25a;',
			'fa fa-hand-stop-o'=>'&#xf256;',
			'fa fa-hdd-o'=>'&#xf0a0;',
			'fa fa-heart-o'=>'&#xf08a;',
			'fa fa-hospital-o'=>'&#xf0f8;',
			'fa fa-hourglass-2'=>'&#xf252;',
			'fa fa-hourglass-o'=>'&#xf250;',
			'fa fa-i-cursor'=>'&#xf246;',
			'fa fa-ils'=>'&#xf20b;',
			'fa fa-indent'=>'&#xf03c;',
			'fa fa-inr'=>'&#xf156;',
			'fa fa-intersex'=>'&#xf224;',
			'fa fa-jpy'=>'&#xf157;',
			'fa fa-krw'=>'&#xf159;',
			'fa fa-lastfm-square'=>'&#xf203;',
			'fa fa-lemon-o'=>'&#xf094;',
			'fa fa-life-buoy'=>'&#xf1cd;',
			'fa fa-line-chart'=>'&#xf201;',
			'fa fa-list-ol'=>'&#xf0cb;',
			'fa fa-long-arrow-down'=>'&#xf175;',
			'fa fa-mail-reply'=>'&#xf112;',
			'fa fa-map-marker'=>'&#xf041;',
			'fa fa-mars'=>'&#xf222;',
			'fa fa-mars-stroke-v'=>'&#xf22a;',
			'fa fa-medkit'=>'&#xf0fa;',
			'fa fa-minus-circle'=>'&#xf056;',
			'fa fa-mobile'=>'&#xf10b;',
			'fa fa-moon-o'=>'&#xf186;',
			'fa fa-music'=>'&#xf001;',
			'fa fa-object-group'=>'&#xf247;',
			'fa fa-opencart'=>'&#xf23d;',
			'fa fa-outdent'=>'&#xf03b;',
			'fa fa-paper-plane-o'=>'&#xf1d9;',
			'fa fa-pause'=>'&#xf04c;',
			'fa fa-paypal'=>'&#xf1ed;',
			'fa fa-picture-o'=>'&#xf03e;',
			'fa fa-pied-piper-pp'=>'&#xf1a7;',
			'fa fa-plane'=>'&#xf072;',
			'fa fa-plug'=>'&#xf1e6;',
			'fa fa-plus-square-o'=>'&#xf196;',
			'fa fa-question'=>'&#xf128;',
			'fa fa-quote-left'=>'&#xf10d;',
			'fa fa-remove'=>'&#xf00d;',
			'fa fa-reply'=>'&#xf112;',
			'fa fa-rmb'=>'&#xf157;',
			'fa fa-rotate-right'=>'&#xf01e;',
			'fa fa-rub'=>'&#xf158;',
			'fa fa-safari'=>'&#xf267;',
			'fa fa-search'=>'&#xf002;',
			'fa fa-send'=>'&#xf1d8;',
			'fa fa-share-alt'=>'&#xf1e0;',
			'fa fa-shekel'=>'&#xf20b;',
			'fa fa-shirtsinbulk'=>'&#xf214;',
			'fa fa-signal'=>'&#xf012;',
			'fa fa-skyatlas'=>'&#xf216;',
			'fa fa-slideshare'=>'&#xf1e7;',
			'fa fa-sort-alpha-asc'=>'&#xf15d;',
			'fa fa-sort-asc'=>'&#xf0de;',
			'fa fa-sort-numeric-desc'=>'&#xf163;',
			'fa fa-spinner'=>'&#xf110;',
			'fa fa-square-o'=>'&#xf096;',
			'fa fa-star-half'=>'&#xf089;',
			'fa fa-star-o'=>'&#xf006;',
			'fa fa-step-forward'=>'&#xf051;',
			'fa fa-stop'=>'&#xf04d;',
			'fa fa-strikethrough'=>'&#xf0cc;',
			'fa fa-subway'=>'&#xf239;',
			'fa fa-superscript'=>'&#xf12b;',
			'fa fa-tachometer'=>'&#xf0e4;',
			'fa fa-taxi'=>'&#xf1ba;',
			'fa fa-terminal'=>'&#xf120;',
			'fa fa-th-large'=>'&#xf009;',
			'fa fa-thumbs-o-down'=>'&#xf088;',
			'fa fa-ticket'=>'&#xf145;',
			'fa fa-toggle-left'=>'&#xf191;',
			'fa fa-toggle-right'=>'&#xf152;',
			'fa fa-transgender'=>'&#xf224;',
			'fa fa-tree'=>'&#xf1bb;',
			'fa fa-truck'=>'&#xf0d1;',
			'fa fa-tumblr-square'=>'&#xf174;',
			'fa fa-twitter'=>'&#xf099;',
			'fa fa-undo'=>'&#xf0e2;',
			'fa fa-unlock'=>'&#xf09c;',
			'fa fa-user-secret'=>'&#xf21b;',
			'fa fa-viacoin'=>'&#xf237;',
			'fa fa-vimeo'=>'&#xf27d;',
			'fa fa-warning'=>'&#xf071;',
			'fa fa-whatsapp'=>'&#xf232;',
			'fa fa-wikipedia-w'=>'&#xf266;',
			'fa fa-wordpress'=>'&#xf19a;',
			'fa fa-wrench'=>'&#xf0ad;',
			'fa fa-y-combinator-square'=>'&#xf1d4;',
			'fa fa-yelp'=>'&#xf1e9;',
			'fa fa-youtube-play'=>'&#xf16a;'
			);
		if(array_key_exists($font_cod,$font_data))
		{
			$hash_data = $font_data[$font_cod];
		}
		return $hash_data;
	}
}