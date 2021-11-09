<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Database_backup extends CI_Controller {
	public $data = array();
	public function __construct()
	{
		parent::__construct();
		//$this->common_model->checkLogin(); // here check for login or not
		$this->common_model->check_admin_only_access();
	}
	public function index()
	{
		
	}
	public function backup()
	{
		$hostname = $this->db->hostname;
		$username = $this->db->username;
		$password = $this->db->password;
		$database = $this->db->database;
		$char_set = $this->db->char_set;
		$dbcollat = $this->db->dbcollat;
		
		$this->db->close();
		
		$config['hostname'] = $hostname;
		$config['username'] = $username;
		$config['password'] = $password;
		$config['database'] = $database;
		$config['dbdriver'] = 'mysqli';
		$config['char_set'] = $char_set;
		$config['dbcollat'] = $dbcollat;
		
		$this->load->database($config);
		// Load the DB utility class
		$this->load->dbutil();
		// Backup your entire database and assign it to a variable
		$backup = $this->dbutil->backup();
		// Load the file helper and write the file to your server
	 	$db_name_fil = 'backup-on-'. date("Y-m-d-H-i-s") .'.gz';
		$this->load->helper('file');
		write_file("backup/$db_name_fil", $backup);
		
		// Load the download helper and send the file to your desktop
		$this->load->helper('download');
		force_download($db_name_fil, $backup);
	}
	function download_csv()
	{
		$this->load->dbutil(); // call db utility library
		$this->load->helper('download'); // call download helper
		$query = $this->db->query("SELECT * FROM register_view where is_deleted ='No' "); // whatever you want to export to CSV, just select in query
		$filename = 'registered_member_data.csv'; // name of csv file to download with data
		force_download($filename, $this->dbutil->csv_from_result($query)); // download file
	}
	function generate_backup() 
	{
		ini_set('max_execution_time', 600);
		ini_set('memory_limit','1024M');
		$source='./';
		$destination= date('ymdhis').'backup.zip';
		if (extension_loaded('zip')) {
			if (file_exists($source)) {
				$zip = new ZipArchive();
				if ($zip->open($destination, ZIPARCHIVE::CREATE)) {
					$source = realpath($source);
					if (is_dir($source)) {
						$iterator = new RecursiveDirectoryIterator($source);
						// skip dot files while iterating 
						$iterator->setFlags(RecursiveDirectoryIterator::SKIP_DOTS);
						$files = new RecursiveIteratorIterator($iterator, RecursiveIteratorIterator::SELF_FIRST);
						foreach ($files as $file) {
							$file = realpath($file);
							if (is_dir($file)) {
								$zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
							} else if (is_file($file)) {
								$zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
							}
						}
					} else if (is_file($source)) {
						$zip->addFromString(basename($source), file_get_contents($source));
					}
				}
				$zip->close();
			}
		}
		echo 'Back up created successfully on your root folder,';
		return false;
	}
}