<?php
/**
 * Created by PhpStorm.
 */
header("Content-Type:text/html;charset=utf-8");//支持中文
$user=$_GET["username"];
$pwd=$_GET["phoneno"];
echo "这是从web服务器返回的消息，已经经过php处理的！<br />";
echo "您提交的用户名是：",$user,"<br />";
echo "您提交的密码是：",$pwd;
?>

