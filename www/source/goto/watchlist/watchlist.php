<?php

setcookie("showdetail", "0", time() + (86400 * 30));


$uname= $_POST['uname'] ;
$phone=$_POST['phone'] ;
$address=$_POST['address'] ;
$message= $_POST['message'] ;
echo "Thanks for your feedback!";

$result='';

require_once("email.php");
$flag = sendMail($uname,$phone,$address,$message,$result);
echo $result;


?>