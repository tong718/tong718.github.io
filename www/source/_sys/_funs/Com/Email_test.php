
<?php 
require_once dirname(__FILE__).'/EmailOperation.php';
$smtpserver = "ssl://smtp.gmail.com";//您的smtp服务器的地址
$port = 465 ; //smtp服务器的端口，一般是 25
$smtpuser = "clyde1229@gmail.com"; //您登录smtp服务器的用户名
$smtppwd = "wd575859"; //您登录smtp服务器的密码
$mailtype = "HTML"; //邮件的类型，可选值是 TXT 或 HTML ,TXT 表示是纯文本的邮件,HTML 表示是 html格式的邮件
$sender = "clyde1229@gmail.com"; //发件人,一般要与您登录smtp服务器的用户名($smtpuser)相同,否则可能会因为smtp服务器的设置导致发送失败
$smtp  =   new smtp($smtpserver,$port,true,$smtpuser,$smtppwd,$sender);
//$smtp->debug = FALSE; //是否开启调试,只在测试程序时使用，正式使用时请将此行注释
$to = "clyde1229@gmail.com"; //收件人
$subject = "你好";
$body = "<h1>这是一个用 <font color='red'><b> php socket </b></font> 发邮件的测试8。
   支持SMTP认证！</h1>
";
$send=$smtp->sendmail($to,$sender,$subject,$body,$mailtype);
if($send==1){
   echo "邮件发送成功";
}else{
   echo "邮件发送失败<br>";
   echo "原因：".$smtp->logs;
}
?>
