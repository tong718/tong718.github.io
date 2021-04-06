<?php
require_once dirname(__FILE__) . '/../../source/_sys/_conf/URLprocess.php';
require_once dirname(__FILE__) . '/../../source/_sys/_funs/DB/DB_Table_Operation.php';
require_once dirname(__FILE__) . '/../../source/_sys/_funs/Data/Data_Process.php';
setcookie("showdetail", "0", time() + (86400 * 30));
$userName = $_POST['userName'];
$password = $_POST['password'];
$securityCode = "";
$loginTime = "";
$loginIP = "";
$randomStream = "";
$equipType = "";

//----------------------------------------------------------------------------------------------
if (filter_var($userName, FILTER_VALIDATE_EMAIL)) {
    $condition = getConditions(array("email"), array("string"), array($userName));
} else {
    $condition = getConditions(array("username"), array("string"), array($userName));
}
//----------------------------------------------------------------------------------------------
$allResult = getOneRecord("user", $condition);//getOneRecord("user", $condition);
//----------------------------------------------------------------------------------------------
if (empty($allResult)) {
    echo "*Your user name is incorrect* " . $condition;
} else {
    if ($password==$allResult['password']){
        date_default_timezone_set("Pacific/Auckland");
        $loginTime = date("Y-m-d G:i:s", time());
        $loginIP = get_client_ip();
        $randomStream = generateRandomString();
        $securityCode = $allResult["username"] . "<#>" . $loginTime . "<#>" . $loginIP . "<#>" . $randomStream ;
        updateData("user", $allResult["id"], array("login_sit"), array("string"), array($securityCode));        
        setcookie("login_ID", $allResult["id"], time() + (86400 * 30), "/");
        setcookie("login_name", $allResult["username"], time() + (86400 * 30), "/");
        setcookie("login_sit", $securityCode, time() + (86400 * 30), "/");
        setcookie("adminType", $allResult["usertype"], time() + (86400 * 30), "/");
        setcookie("websites", $allResult["id"], time() + (86400 * 30), "/");
        setcookie("Features", $allResult["id"], time() + (86400 * 30), "/");
        echo "CorrectUserName&Password";
    }else {
        echo "*Your password is incorrect*";
    }
    //------------------------------------------------------------------------------------------
}
//----------------------------------------------------------------------------------------------	
?>