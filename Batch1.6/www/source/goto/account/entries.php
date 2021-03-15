<?php
require_once dirname(__FILE__) . '/../../../source/_sys/_conf/TokenConf.php';
if ($GLOBALS['loginsituation']=="login"){
require_once dirname(__FILE__) . '/../../../source/_sys/_funs/DB/DB_Table_Operation.php';
$userinfo=getOneRecord("user", "id=".$_COOKIE['login_ID']);
?>
<div class="container_b">
    <div class="entricon" onclick="location.href='?account&profile'">
        <div class="blockicon"><i class="fa fa-user-circle"></i></div>
        <div class="blocktit">PROFILE</div>
    </div>
    <div class="entricon" onclick="location.href='CP/'">
        <div class="blockicon"><i class="fa fa-globe"></i></div>
        <div class="blocktit">MY WEB</div>
    </div>
    <div class="entricon" onclick="location.href='?calendar'">
        <div class="blockicon"><i class="fa fa-calendar"></i></div>
        <div class="blocktit">CALENDAR</div>
    </div>
    <div class="entricon" onclick="location.href='?watchlist'">
        <div class="blockicon"><i class="fa fa-eye"></i></div>
        <div class="blocktit">WATCHLIST</div>
    </div>
</div>
<div class="container_b">
    <div class="entricon" onclick="location.href='?wallet'">
        <div class="blockicon"><i class="fa fa-money" aria-hidden="true"></i></div>
        <div class="blocktit">WALLET</div>
    </div>
    <div class="entricon" onclick="location.href='?bowapp'">
        <div class="blockicon"><i class="fa fa-cubes"></i></div>
        <div class="blocktit">BOW APPS</div>
    </div>
    <div class="entricon" onclick="location.href='?bowapp&addon'">
        <div class="blockicon"><i class="fa fa-plus-square"></i></div>
        <div class="blocktit">ADD ON</div>
    </div>
</div>
<?php
}else{
    require_once dirname(__FILE__) . '/../../../source/goto/signupin/nonelogin.html';
}
?>