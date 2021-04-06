<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
global $loginsituation;
require_once dirname(__FILE__).'/../_funs/DB/DB_Table_Operation.php';
if (!isset($_COOKIE['login_ID']) || !isset($_COOKIE['login_name']) || !isset($_COOKIE['login_sit'])) {
    $loginsituation="null";
    $loginmessage="none";
    setcookie("loginmessage", $loginmessage, time() + (86400 * 30), "/");
}else{
    //
    $userinfo=getOneRecord("user", "id=".$_COOKIE['login_ID']);
    if($_COOKIE['login_sit']==$userinfo["login_sit"]){
        //
        $loginsituation="login";
        $loginmessage="Hello " . $_COOKIE['login_name'];
        setcookie("loginmessage", $loginmessage, time() + (86400 * 30), "/");
    }else{
        //
        $loginsituation="loginelsewhere";
        $loginmessage="Your Login has expired!";
        setcookie("loginmessage", $loginmessage, time() + (86400 * 30), "/");
    }
}
?>