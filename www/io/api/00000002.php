<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
require_once dirname(__FILE__) . '/../../source/_sys/_conf/URLprocess.php';
require_once dirname(__FILE__) . '/../../source/_sys/_funs/DB/DB_Table_Operation.php';
require_once dirname(__FILE__) . '/../../source/_sys/_funs/Data/Data_Process.php';
    $userID = $_COOKIE['login_ID'];
    date_default_timezone_set("Pacific/Auckland");
    updateData("user", $userID, array("login_sit"), array("string"), array("none"));
    setcookie("login_ID", "", time() - 3600,"/");
    setcookie("login_name", "", time() - 3600,"/");
    setcookie("adminType", "", time() - 3600,"/");
    setcookie("login_sit", "", time() - 3600,"/");
    setcookie("websites", "", time() - 3600,"/");
    setcookie("Features", "", time() - 3600,"/");
    echo "/?signupin&signin";
?>