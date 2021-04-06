<?php
require_once dirname(__FILE__) . '/../../../source/_sys/_conf/TokenConf.php';
if ($GLOBALS['loginsituation']=="login"){
require_once dirname(__FILE__) . '/../../../source/_sys/_funs/DB/DB_Table_Operation.php';
$userinfo=getOneRecord("user", "id=".$_COOKIE['login_ID']);
?>
<div style="width:100%;height:100px;max-width:500px;margin:50px auto;padding:0;line-height:100px;text-align:center;font-size:33px">
Account profile</div>
<div style="width:100%;height:auto;overflow:auto;max-width:500px;margin:50px auto;padding:0;line-height:30px;text-align:left;font-size:15px">
<strong>Username:</strong> <?=$userinfo["username"] ?><br/>
<strong>Google:</strong> <?=$userinfo["google"] ?><br/>
<strong>Facebook:</strong> <?=$userinfo["facebook"] ?><br/>
<strong>Wechat:</strong> <?=$userinfo["wechat"] ?><br/>
<strong>Twitter:</strong> <?=$userinfo["twitter"] ?><br/>
<strong>Email:</strong> <?=$userinfo["email"] ?><br/>
<strong>Mobile:</strong> <?=$userinfo["mobile"] ?><br/>
<strong>Usertype:</strong> <?=$userinfo["usertype"] ?><br/>
<strong>Access:</strong> <?=$userinfo["access"] ?><br/>
-----------------------------------------------------
</div>
<?php
}else{
    require_once dirname(__FILE__) . '/../../../source/goto/signupin/nonelogin.html';
}
?>