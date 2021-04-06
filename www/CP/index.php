<?php
require_once dirname(__FILE__) . '/../source/_sys/_conf/TokenConf.php';
require_once dirname(__FILE__) . '/../source/_sys/_funs/DB/DB_Table_Operation.php';
$userinfo=getOneRecord("user", "id=".$_COOKIE['login_ID']);

if ($GLOBALS['loginsituation']=="login"){
  require_once dirname(__FILE__) . '/../CP/layout/header.html';
  require_once dirname(__FILE__) . '/../CP/layout/top.php';
  require_once dirname(__FILE__) . '/../CP/layout/menu.php';
  require_once dirname(__FILE__) . '/../CP/layout/mainframe.html';
  require_once dirname(__FILE__) . '/../CP/layout/footer.html';
}else{
  header('Location: ../?signupin&signin');
  exit;
}
?>

    
    

      

      
      
    