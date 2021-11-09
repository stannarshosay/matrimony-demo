<?php

require 'Joomla.php';

class Kunena extends Joomla {

    public function __construct($db) {
        //parent::__construct($db);
        $this->db = $db;
    }

//------------------------------------------------------------------------------
    public function avatar_url($res) {
        $murl = str_replace($this->to_freichat_path, "", $this->url);
        $avatar_url = $murl . 'media/kunena/avatars/resized/size36/' . $res[$this->avatar_field_name];
        return $avatar_url;
    }

//------------------------------------------------------------------------------   
    public function get_guests() {

        $query = "SELECT DISTINCT f.status_mesg,f.username,f.session_id,f.status,f.guest,f.in_room,k.avatar
                               FROM frei_session AS f
                               LEFT JOIN " . DBprefix . "kunena_users AS k ON f.session_id=k.userid
                              WHERE time>" . $this->online_time2 . "
                               AND f.session_id!=" . $_SESSION[$this->uid . 'usr_ses_id'] . "
                               AND f.status!=2
                               AND f.status!=0";
//echo $query;

        $list = $this->db->query($query)->fetchAll();
        return $list;
    }

//------------------------------------------------------------------------------ 
    public function get_users() {

        $query = "SELECT DISTINCT f.status_mesg,f.username,f.session_id,f.status,f.guest,f.in_room,k.avatar
                               FROM frei_session AS f                               
                               LEFT JOIN " . DBprefix . "kunena_users AS k ON f.session_id=k.userid
                              WHERE time>" . $this->online_time2 . "
                               AND f.session_id!=" . $_SESSION[$this->uid . 'usr_ses_id'] . "
                               AND f.guest=0
                               AND f.status!=2
                               AND f.status!=0";

        $list = $this->db->query($query)->fetchAll();

        return $list;
    }

//------------------------------------------------------------------------------    

}