<?php
require_once dirname(__FILE__).'/../../_sys/_class/url/URLprocess.php';
$NowDomain=rightDomain(curPageURL());
$query = url_code();	
$title = explode("&", $query);
//----------------------------------------------------------------------------------
if (!isset($_COOKIE['firstinURL'])){
    setcookie("firstinURL", curPageURL(), time() + (86400 * 30),"/");	 
}
//----------------------------------------------------------------------------------
if (!isset($_COOKIE['equipType'])) {
//==================================================================================
   ///////////////////////////////////////////////////////////////////////////// 
   if ($title[0]=="set"){
                ////////////////////////////////////////////////////////////
				switch ($title[1]) {
                case "mb":
                    setcookie("equipType", "Mobile", time() + (86400 * 30),"/");
                    break;
                case "pad":
                    setcookie("equipType", "Pad", time() + (86400 * 30),"/");
                    break;
                case "pc":
                    setcookie("equipType", "PC", time() + (86400 * 30),"/");
                    break;
                default:
                    setcookie("equipType", "PC", time() + (86400 * 30),"/");
                }
				////////////////////////////////////////////////////////////
				$gotourl=$_COOKIE['firstinURL'];
			    Header('Location:'.$gotourl);
				//echo '<script>window.location.assign("'.$gotourl.'")/script>';
    }
    /////////////////////////////////////////////////////////////////////////////  
    else{  
	            echo '<script>
                var sUserAgent = navigator.userAgent.toLowerCase();
                var bIsIpad = sUserAgent.match(/ipad/i) == "ipad";
                var bIsIphoneOs = sUserAgent.match(/iphone os/i) == "iphone os";
                var bIsMidp = sUserAgent.match(/midp/i) == "midp";
                var bIsUc7 = sUserAgent.match(/rv:1.2.3.4/i) == "rv:1.2.3.4";
                var bIsUc = sUserAgent.match(/ucweb/i) == "ucweb";
                var bIsAndroid = sUserAgent.match(/android/i) == "android";
                var bIsCE = sUserAgent.match(/windows ce/i) == "windows ce";
                var bIsWM = sUserAgent.match(/windows mobile/i) == "windows mobile";
				
                if (bIsIphoneOs || bIsMidp || bIsUc7 || bIsUc || bIsAndroid || bIsWM) {
                    window.location.assign("http://'.$NowDomain.'?set&mb");
                } else if (bIsIpad || bIsCE) {
                    window.location.assign("http://'.$NowDomain.'?set&pad");
                } else {
					window.location.assign("http://'.$NowDomain.'?set&pc");
                }
                </script>';
     } 
}
else{
	 if ($title[0]=="set"){
		 $suchdomain=rightDomain(curPageURL());
		 $gotourla=$_COOKIE['firstinURL'];
		 if ($gotourla!='' or $gotourla=='http://'.$suchdomain.'/?set&pc' or $gotourla=='http://'.$suchdomain.'/?set&mb' or $gotourla=='http://'.$suchdomain.'/?set&pad'){
			 $gotowhere='http://'.$suchdomain;
			 Header('Location:'.$gotowhere);			 
		 }
	 }
}
//================================================================================== 
?>