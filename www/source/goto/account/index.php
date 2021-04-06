<?php
require_once dirname(__FILE__) . '/../../../source/_sys/_conf/URLprocess.php';
$querys=explode("&",url_code());
switch ($querys[0]) {
    case "profile":
        require_once dirname(__FILE__) . '/../../../source/goto/account/profile.php';
        break;
    case "chengepw":
        echo "<br/><br/><br/><br/><br/>chengepw<br/><br/><br/>".url_code();
        break;
    default:
        require_once dirname(__FILE__) . '/../../../source/goto/account/entries.php';
  }
?>