<?php
require_once dirname(__FILE__) . '/../../source/_sys/_conf/URLprocess.php';
require_once dirname(__FILE__) . '/../../source/_sys/_funs/DB/DB_Table_Operation.php';
require_once dirname(__FILE__) . '/../../source/_sys/_funs/Data/Data_Process.php';
$userName = $_POST['userName'];
$securityCode = "";
$loginTime = "";
$loginIP = "";
$randomStream = "";
if (filter_var($userName, FILTER_VALIDATE_EMAIL)) {
    $condition = getConditions(array("email"), array("string"), array($userName));
} else {
    $condition = getConditions(array("login_name"), array("string"), array($userName));
}
$allResult = getOneRecord("member", $condition);
date_default_timezone_set("Pacific/Auckland");
$loginTime = date("Y-m-d G:i:s", time());
$loginIP = get_client_ip();
$randomStream = generateRandomString();
$securityCode = $allResult[0][1] . "<#>" . $loginTime . "<#>" . $loginIP . "<#>" . $randomStream . "<#>" . $allResult[0][0]."<#>".$_COOKIE["equipType"];
updateData("member", $allResult[0][0], array("login_situ"), array("string"), array($securityCode));
$newCondition = getConditions(array("LoginName", "LoginMonth"), array("string", "string"), array($userName, date("Y-m", time())));
$newResult = getOneRecord("LoginHistory", $newCondition);
if (empty($newResult)) {
    $fieldValues = array($allResult[0][1], $allResult[0][0], date("Y-m", time()), $loginTime . " " . $loginIP ." ".$_COOKIE["equipType"]. "<#>Force-Logout<*>" . $loginTime . "" . $loginIP ." ".$_COOKIE["equipType"]. "<#>Login<*>");
    insertData("LoginHistory", $fieldValues);
} else {
    updateData("LoginHistory", $newResult[0][0], array("LoginRc"), array("string"), array($newResult[0][4] . $loginTime . " " . $loginIP ." ".$_COOKIE["equipType"]. "<#>Force-Logout<*>" . $loginTime . "" . $loginIP ." ".$_COOKIE["equipType"]. "<#>Login<*>"));
}
setcookie("login_ID", $allResult[0][0], time() + (86400 * 30),"/");
setcookie("login_name", $allResult[0][1], time() + (86400 * 30),"/");
setcookie("login_sit", $securityCode, time() + (86400 * 30),"/");
setcookie("adminType", $allResult[0][9], time() + (86400 * 30),"/");
setcookie("websites", $allResult[0][6], time() + (86400 * 30),"/");
setcookie("Features", $allResult[0][8], time() + (86400 * 30),"/");
echo "/?signupin&signin";
?>