<?php

require 'base.php';

class Humhub extends Moderation {
    

    public function set_db_data() {
        $this->usertable = 'user';
        $this->row_username = 'username';
        $this->row_userid = 'id';
    }
    
}
