<?php
header("content-type:text/html;charset=utf-8");
session_start();

setcookie("showdetail", "0", time() + (86400 * 30));

$uname= $_POST['uname'] ;
$phone=$_POST['phone'] ;
$address=$_POST['address'] ;
$message= $_POST['message'] ;
echo "Thanks for your feedback!";

$tmpFile = tempnam('/H:/XAMPP/htdocs/www/source/goto/TEST/table.txt', 'testtmp');

$f = fopen($tmpFile, "w");

fwrite($f, "I'm tmp file.");
$result='';

require_once("../watchlist/email.php");
$flag = sendMail($uname,$phone,$address,$message,$result);
echo $result;

//通过php连接到mysql数据库
//$conn=mysql_connect("localhost","test","920718.com");
$servername = "localhost";
$username = "root";
$password = "920718.com";

$conn=new PDO("mysql:host=$servername;dbname=test;port=3306", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare("SELECT * FROM test");
$stmt->execute();

e

?>