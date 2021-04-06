 <?php
    /* forHtml($str) 把纯文字转换问HTML格式的文字
     * function unicode($input)
     * formatePrice($inputPrice) 
     * function cutstr_html($string, $length = 0, $ellipsis = '...') PHP清除html、css、js格式并去除空格的PHP函数
     * function clearHtml($content)  php 去除html标签 js 和 css样式
     * 
     */

    function forHtml($str) {
        $returnstr = htmlspecialchars($str);
        $returnstr = str_replace(' ', '&nbsp;', $returnstr);
        $returnstr = str_replace(chr(10), '<br/>', $returnstr);
        return $returnstr;
    }

    function formatePrice($inputPrice) {
        $formatedPrice = number_format($inputPrice, 2, ".", ",");
        return $formatedPrice;
//    echo $formatedPrice;
    }

    function unicode($input) {
        if (empty($input)) {
            exit("Error: Input String is Empty!");
        } else {
            $output = mb_convert_encoding($input, 'HTML-ENTITIES', 'UTF-8');
            return $output;
        }
    }

    //PHP清除html、css、js格式并去除空格的PHP函数
    function cutstr_html($string, $length = 0, $ellipsis = '...') {
        $string = strip_tags($string);
        $string = preg_replace('/\n/is', '', $string);
        $string = preg_replace('/ |　/is', '', $string);
        $string = preg_replace('/&nbsp;/is', '', $string);
        preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/",
                $string, $string);
        if (is_array($string) && !empty($string[0])) {
            if (is_numeric($length) && $length) {
                $string = join('', array_slice($string[0], 0, $length)) . $ellipsis;
            } else {
                $string = implode('', $string[0]);
            }
        } else {
            $string = '';
        }
        return $string;
    }

//php 去除html标签 js 和 css样式
    function clearHtml($content) {
        $content = preg_replace("/<a[^>]*>/i", "", $content);
        $content = preg_replace("/<\/a>/i", "", $content);
        $content = preg_replace("/<div[^>]*>/i", "", $content);
        $content = preg_replace("/<\/div>/i", "", $content);
        $content = preg_replace("/<!--[^>]*-->/i", "", $content); //注释内容     
        $content = preg_replace("/style=.+?['|\"]/i", '', $content); //去除样式     
        $content = preg_replace("/class=.+?['|\"]/i", '', $content); //去除样式     
        $content = preg_replace("/id=.+?['|\"]/i", '', $content); //去除样式        
        $content = preg_replace("/lang=.+?['|\"]/i", '', $content); //去除样式         
        $content = preg_replace("/width=.+?['|\"]/i", '', $content); //去除样式      
        $content = preg_replace("/height=.+?['|\"]/i", '', $content); //去除样式      
        $content = preg_replace("/border=.+?['|\"]/i", '', $content); //去除样式      
        $content = preg_replace("/face=.+?['|\"]/i", '', $content); //去除样式      
        $content = preg_replace("/face=.+?['|\"]/", '', $content); //去除样式 只允许小写 正则匹配没有带 i 参数   
        return $content;
    }

//unicode("我们");
//formatePrice("2");
//print_r(forHtml("dmsikfcnsd     cfsdnjovnjdf"));

     function generateRandomString($length = 10) {
          $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
          $charactersLength = strlen($characters);
          $randomString = '';
          for ($i = 0; $i < $length; $i++) {
              $randomString .= $characters[rand(0, $charactersLength - 1)];
          }
          return $randomString;
      }
?>