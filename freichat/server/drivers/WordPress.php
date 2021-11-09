<?php

require 'base.php';

class WordPress extends driver_base {

    public function __construct($db) {
        //parent::__construct();
        $this->db = $db;
    }

//------------------------------------------------------------------------------
    public function getDBdata($session_id, $first) {
        if ($session_id == 0) {
            $_SESSION[$this->uid . 'is_guest'] = 1;
        } else {
            $_SESSION[$this->uid . 'is_guest'] = 0;
        }
        if ($_SESSION[$this->uid . 'is_guest'] == 0) {
            if ($_SESSION[$this->uid . 'time'] < $this->online_time || isset($_SESSION[$this->uid . 'usr_name']) == false || $first == 'false') { //To consume less resources , now the query is made only once in 15 seconds
                $query = "SELECT user_login FROM " . DBprefix . "users WHERE ID=?  LIMIT 1";
            $res_obj = $this->db->prepare($query);                       
            $res_obj->execute( array($session_id) );// var_dump($res_obj);
            $res = $res_obj->fetchAll();

                if ($res == null) {
                    $this->freichat_debug("Incorrect Query :  " . $query . " \n session id:  ". $session_id ."\n PDO error: ".print_r($this->db->errorInfo(),true));
                }
//var_dump($res);
                foreach ($res as $result) {
                    if (isset($result['user_login'])) { //To avoid undefined index error. Because empty results were shown sometimes
                        $_SESSION[$this->uid . 'usr_name'] = $result['user_login'];
                        $_SESSION[$this->uid . 'usr_ses_id'] = $session_id;
                    }
                }
            }
        } else {
            $_SESSION[$this->uid . 'usr_name'] = $_SESSION[$this->uid . 'gst_nam'];
            $_SESSION[$this->uid . 'usr_ses_id'] = $_SESSION[$this->uid . 'gst_ses_id'];
        }
    }

//------------------------------------------------------------------------------   
    public function avatar_url($res) {

        $murl = str_replace($this->to_freichat_path, "", $this->url);

		$directory = "../../wp-content/uploads/avatars/".$res['session_id']."/";
		
		if(!file_exists($directory)) { return "http://www.gravatar.com/avatar/" . md5($res['username']) . "?s=24&d=wavatar"; }		
		$files = scandir ($directory);
		$firstFile = $files[2];



        $avatar_url = $murl . "wp-content/uploads/avatars/".$res['session_id']."/" . $firstFile;
        return $avatar_url;
    }

//------------------------------------------------------------------------------
    public function getList() {

        $user_list = null;

        if ($this->show_name == 'guest') {
            $user_list = $this->get_guests();
        } else if ($this->show_name == 'user') {
            $user_list = $this->get_users();
        } else {
            $this->freichat_debug('USER parameters for show_name are wrong.');
        }
        return $user_list;
    }

//------------------------------------------------------------------------------ 
    public function load_driver() {

        //define("DBprefix", $this->db_prefix);
        $session_id = $this->options['id'];
        $custom_mesg = $this->options['custom_mesg'];
        $first = $this->options['first'];

// 1. Connect The DB
//      DONE
// 2. Basic Build the blocks        
        $this->createFreiChatXsession();
// 3. Get Required Data from client DB
        $this->getDBdata($session_id, $first);
        $this->check_ban();
// 4. Insert user data in FreiChatX Table Or Recreate Him if necessary
        $this->createFreiChatXdb();
// 5. Update user data in FreiChatX Table
        $this->updateFreiChatXdb($first, $custom_mesg);
// 6. Delete user data in FreiChatX Table
        $this->deleteFreiChatXdb();
// 7. Get Appropriate UserData from FreiChatX Table
        if ($this->usr_list_wanted == true) {
            $result = $this->getList();
            return $result;
        }
// 8. Send The final Data back
        return true;
    }

}
