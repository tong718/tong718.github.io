<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';


function sendMail($uname,$phone,$address,$message,$result){
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //服务器配置
        $mail->CharSet ="UTF-8";                     //设定邮件编码
        $mail->SMTPDebug = 0;                        // 调试模式输出
        $mail->isSMTP();                             // 使用SMTP
        $mail->Host = 'smtp.gmail.com';                // SMTP服务器
        $mail->SMTPAuth = true;                      // 允许 SMTP 认证
        $mail->Username = 'suntongecho718@gmail.com';                // SMTP 用户名  即邮箱的用户名
        $mail->Password = 'yvigoqfnxjtfwurz';             // SMTP 密码  部分邮箱是授权码(例如163邮箱) Gmail是应用专用密码
        $mail->SMTPSecure = 'ssl';                    // 允许 TLS 或者ssl协议
        $mail->Port = 465;                  // 服务器端口 25 或者465 具体要看邮箱服务器支持



        $mail->setFrom('suntongecho718@gmail.com', 'Mailer');  //发件人
        $mail->addAddress('suntongecho718@gmail.com', 'Joe');  // 收件人
        //$mail->addAddress('ellen@example.com');  // 可添加多个收件人
        $mail->addReplyTo('suntongecho718@gmail.com', 'info'); //回复的时候回复给哪个邮箱 建议和发件人一致
        //$mail->addCC('cc@example.com');                    //抄送
        //$mail->addBCC('bcc@example.com');                    //密送

        //发送附件
        // $mail->addAttachment('../xy.zip');         // 添加附件
        // $mail->addAttachment('../thumb-1.jpg', 'new.jpg');    // 发送附件并且重命名

        //Content
        $mail->isHTML(true);                                  // 是否以HTML文档格式发送  发送后客户端可直接显示对应HTML内容
        $mail->Subject = 'Feedback from users' . time();
        $mail->Body    ="用户名：". $uname.'<br>'."电话号".$phone."<br>"."邮箱".$address."<br>"."留言".$message."<br>". date('Y-m-d H:i:s');
        $mail->AltBody = '如果邮件客户端不支持HTML则显示此内容';

        $mail->send();

        $result='邮件发送成功';
    } catch (Exception $e) {
        $result= '邮件发送失败 ';

        //Google邮箱发送失败时
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
    }
}

?>
