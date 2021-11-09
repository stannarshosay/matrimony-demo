<?php

require 'base.php';

class Humhub extends base {

    public $set_file = 'protected/config/dynamic.php';
    public $redir = false;

    public function info($path_host) {

        $url = str_replace("installation/integ", "", str_replace('\\', '/', dirname(__FILE__)));


        $this->info['jsloc'] = 'head.php in themes/your_theme/views/layouts ';
        $this->info['phpcode'] = '<!--===============FreiChatX========START========================-->
<!--	For uninstalling ME , first remove/comment all FreiChatX related code i.e below code
	 Then remove FreiChatX tables frei_session & frei_chat if necessary
         The best/recommended way is using the module for installation                         -->

<?php
if(Yii::$app->user->isGuest)
{ 

    $ses = null; //tell freichat that the current user is a guest

    setcookie("freichat_user", null, time()+3600, "/"); // *do not change -> freichat code
}
else {

    $ses = Yii::$app->user->getIdentity()->id; //tell freichat the userid of the current user

    setcookie("freichat_user", "LOGGED_IN", time()+3600, "/"); // *do not change -> freichat code
} 

if(!function_exists("freichatx_get_hash")){
function freichatx_get_hash($ses){

       if(is_file("' . $url . 'hardcode.php")){

               require "' . $url . 'hardcode.php";

               $temp_id =  $ses . $uid;

               return md5($temp_id);

       }
       else
       {
               echo "<script>alert(\'module freichatx says: hardcode.php file not found!\');</script>";
       }

       return 0;
}
}
?>
';
        $this->info['jscode'] = '<script type="text/javascript" language="javascipt"
src="' . $path_host . 'client/main.php?id=<?php echo $ses;?>&xhash=<?php echo freichatx_get_hash($ses); ?>">
</script>';
        $this->info['csscode'] = '<link rel="stylesheet" href="' . $path_host . 'client/jquery/freichat_themes/freichatcss.php" type="text/css">
<!--===========================FreiChatX=======END=========================-->';

        //$this->info["integ_url"] = $this->get_integ_module_url();

        $this->info['js_where'] = '';
        $this->info["integ_url"] = $this->get_integ_module_url();

        return $this->info;
    }

    function get_integ_module_url(){
        return "https://bitbucket.org/evnix/freichat-free-chat-script/downloads/humhub_freichat.zip";
    }

    function get_config() {

        $comp = require_once $_SESSION['config_path'];

        $arr = $comp['components'];
        $config = $arr['db'];

        $dsn = $config['dsn'];

        //'mysql:host=localhost;dbname=humhub
        list($partA, $partB) = explode(';', $dsn);

        list(, $host) = explode('=', $partA);
        list(, $dbname) = explode('=', $partB);

        $conf[0] = $host;
        $conf[1] = $config['username'];
        $conf[2] = $config['password'];
        $conf[3] = $dbname;
        $conf[4] = '';

        return $conf;
    }

}
