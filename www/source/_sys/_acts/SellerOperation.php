<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <!--<img src="http://localhost/real/download/image/">-->
        <?php
        /*test file
         * 拿到 seller 页面中DESCRIPTION 部分 text area 的内容并存入database
         * 
         */
        require_once dirname(__FILE__).'/../data/dataProcess.php';
        require_once dirname(__FILE__).'/../database/databaseOperation.php';
         function setItemDescription($detailTextareaName,$tableName,$ID) {
            $detail = $_POST[$detailTextareaName];
            if (updateData($tableName, $ID, array("DESCRIPTION"),
                            array("string"), array($detail))) {
                return TRUE;
            }
        }
        ?>
    </body>
</html>
