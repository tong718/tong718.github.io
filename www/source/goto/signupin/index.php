<?php
require_once dirname(__FILE__) . '/../../../source/_sys/_conf/URLprocess.php';
$querys=explode("&",url_code());
switch ($querys[0]) {
    case "signin":
        require_once dirname(__FILE__) . '/../../../source/goto/signupin/signin.html';
        break;
    case "signup":
        require_once dirname(__FILE__) . '/../../../source/goto/signupin/signup.html';
        break;
    case "forgetpw":
        require_once dirname(__FILE__) . '/../../../source/goto/signupin/forgetpw.html';
        break;
    default:
    require_once dirname(__FILE__) . '/../../../source/goto/signupin/instruction.html';
  }
?>