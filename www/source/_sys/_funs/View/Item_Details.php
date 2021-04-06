
    <?php
    require_once dirname(__FILE__).'/../database/tableOperation.php';
    require_once dirname(__FILE__).'/../data/dataProcess.php';
    require_once dirname(__FILE__).'/../url/URLprocess.php';
    
    itemDetailAllPage("fruit");
    /* itemDetailAllPage() 加载全部页面内容并生成页面title
     * itemDetailHead() 加载header部分
     * itemDetailsBody() 加载body部分
     * 
     */

    function itemDetailAllPage($tableName) {
        $QUERY = url_code();
        $id = str_replace("ID=", "", $QUERY);
        $all = getValue($tableName, $id);
        $title = $all["NAME"];
        itemDetailHead($title);
        itemDetailsBody($id);
//        itemDetailHead("111");
//        itemDetailsBody("001");
    }

    function itemDetailHead($titel) {
        echo '<Head>';
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        echo '<title>' . $titel . '</title>';
        echo '<link rel="stylesheet" type="text/css" href="css/main.css">';
        echo '<link rel="stylesheet" type="text/css" href="css/description.css">';
        echo '<link href="css/share.css" rel="stylesheet" type="text/css">';
        echo '<script type="text/javascript" src="js/jquery-1.8.3.js"></script>';
        echo '<script src="js/jquery.zoombie.js"></script>';
        echo '<script>
                    $(document).ready(function() {
                        $(".zoom").zoombie({on: "click"});
                    });
                </script>';
        echo '<script type="text/javascript">
                    $(function() {
                        var pic_length = $("#gd li").length;
                        var n = 0;
                        $("#toleft").click(function() {
                            if (!$("#gd").is(":animated") && n) {
                                $("#gd").animate({left: "+=600px"}, 500);
                                n--;
                            }
                        });
                        $("#toright").click(function() {
                            if (!$("#gd").is(":animated") && pic_length > n + 1) {
                                $("#gd").animate({left: "-=600px"}, 500);
                                n++;
                            }
                        })
                    })
                </script>';
        echo '<style>
                    .zoom {
                        display:inline-block;
                    }
                    .zoom img::selection { background-color: transparent; }
                </style>';
        echo '<script src="js/jquery.msAccordion.js"></script>';
        echo '<style type="text/css">
                    .set{border-bottom:1px solid #000}
                </style>';
        echo '<script language = "javascript" type = "text/javascript">
        $(document).ready(function() {$("#accordion3").msAccordion({vertical: true});
        })
        </script>';
        echo '<script type="text/javascript" src="js/smohan.pop&share.js">
                        $(document).ready(function() {
                            $(".share").SmohanPopLayer({
                                Shade: true, //是否显示遮罩层 <br/>
                                Event: "click", //触发事件 <br/>
                                Content: "Share", //内容DIV ID <br/>
                                Title: "分享到各大社区网站" //显示标题 <br/>
                            });
                        });
                    </script>';
        echo'</Head>';
    }

    function itemDetailsBody($id) {
        echo '<body>';
        echo '<div class="page">
            <div class="item">';
//            getItem("fruitdetails", "0001");
//            getItemDescriptions("fruitdetails", "0001");
        getItem("fruitdetails", $id);
        getItemDescriptions("fruitdetails", $id);

        echo '</div>
        </div>';

        echo'</body>';
    }

    function getItem($tableName, $itemID) {
        $item = getValue($tableName, $itemID);
        $name = $item["NAME"];
        $price = $item["PRICE"];
        $price = formatePrice($price);
        $quan = $item["QUANTITY"];
        $loca = $item["LOCATION"];
        $available = $item["AVAILABLEFROM"];
        $qDate = $item["QUALITYDATE"];
        $ref = $item["#REF"];
        echo ' <div class="itemView">';
        getDetailImages($tableName, $itemID);
        echo '<div class="itemName"><br>' . $name . '<br><br>ASKING PRICE: $' . $price . '</div>
                            <div class="itemDetails">     <table width="400px" height="240px"border="0" align="center" >
                        <tr>
                          <th scope="row" align="left">Odometer: &nbsp;</th>
                          <td align="left" >' . $quan . '&nbsp;</td>
                        </tr>
                        <tr>
                          <th scope="row" align="left">Location: &nbsp;</th>
                          <td align="left">' . $loca . '&nbsp;</td>
                        </tr>
                        <tr>
                          <th scope="row" align="left">Available from: &nbsp;</th>
                          <td align="left">' . $available . '&nbsp;</td>
                        </tr>
                        <tr>
                          <th scope="row" align="left">Listed: &nbsp;</th>
                          <td align="left">' . $qDate . '&nbsp;</td>
                        </tr>
                        <tr>
                          <th scope="row" align="left">#REF: &nbsp;</th>
                          <td align="left">' . $ref . '&nbsp;</td>
                        </tr>
                      </table>
                      </div>
                      <div class="sharepage"><a class="share" href="javascript:void(0)" >分享连接</a>
                                      </div>';
    }
    
    function getItemDescriptions($tableName, $ID) {
        $field = getFieldsByIndex($GLOBALS['server_databasename'], $tableName, array(9, 10, 11, 12));
        echo '
                        <div class="itemDescription">
                            <div id="accordion3" class="accordionWrapper" style="width:1000px;">';
        for ($i = 0; $i < count($field); $i++) {
            $fieldName = $field[$i];
            $description = getOneFieldValue($tableName, $ID, $fieldName);
            $description = forHtml($description);
            getItemDescription($fieldName, $description);
        }
        echo'
                            </div>
                        </div>
                        ';
    }

    function getItemDescription($fieldName, $description) {
        echo '<div class="set">
                           <div class="title">' . $fieldName . '</div>
                           <div class="content">
                               ' . $description . '

                           </div>
                       </div>';
    }

    function getDetailImage($imgAddress) {
        echo '<li class="zoom"><img height="350px" width="580px" src="' . $imgAddress . '"></li>';
    }

    function getDetailImages($tableName, $ID) {
        $item = getValue($tableName, $ID);
        $img = $item["IMAGE"];
        $imgs = spliteImgValue($img);
        echo '<div id="box">';
        if (count($imgs) > 1) {
            echo '<div id="toleft"></div>';
        }
        echo '<div id="main"> 
                         <ul id="gd">';
        for ($i = 0; $i < count($imgs); $i++) {
            getDetailImage($imgs[$i]);
        }
        echo '</ul>
                         </div>';
        if (count($imgs) > 1) {
            echo ' <div id="toright"></div>';
        }
        echo ' </div>';
    }
    ?>