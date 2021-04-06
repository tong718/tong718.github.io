
        <?php

       require_once  dirname(__FILE__).'/../database/tableOperation.php';
       require_once  dirname(__FILE__).'/../data/dataProcess.php';
       
        itemTemplateHead("水果");
        itemTemplateBody();
        
        function itemTemplateHead($title) {
            echo '<head>';
            echo ' <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
            echo '<title>' . $title . '</title>';
            echo '<style type="text/css">
            .page
            {
                width: 670px;
                height: 800px;
                overflow: visible;
                /*background-color: yellowgreen;*/
                margin-left: auto;
                margin-right: auto;
                text-align: center;

            }
            .item {
                border-top-width: 1px;
                border-right-width: 1px;
                border-bottom-width: 1px;
                border-left-width: 1px;
                border-top-style: solid;
                border-right-style: solid;
                border-bottom-style: solid;
                border-left-style: solid;
                width:200px;
                height:280px;
                float: left;
                margin: 10px;
            }
            .itemImg{
                position: relative;
                width: 200px;
                height: 200px;
                overflow: hidden;

            }

            .name
            {
                position: relative;
                width: 200px;
                height: 30px;
                text-align: center;
            }
            .detail{
                position: relative;
                width: 200px;
                height: 50px;
                background-color: lightgray;

            }
            .description{position: relative;
                         width: 120px;
                         height: 50px;
                         text-align: left;
                         float: left;
            }
            .price{position: relative;
                   width: 80px;
                   height: 50px;
                   text-align: right;
                   float: right;
            }

        </style>';

            echo '</head>';
        }

        function itemTemplateBody() {
            echo '<body>';
            echo '<div class = "page">';
            getItems("fruit", "ID");
            echo '</div>';
            echo '</body>';
        }

        function getItem($tableName, $itemID) {

            $item = getValue($tableName, $itemID);
            $ID = $item["ID"];
            $name = $item["NAME"];
            $price = $item["PRICE"];
            $price = formatePrice($price);
            $img = $item["IMAGE"];
            $imgs = spliteImgValue($img);
            $des = $item["DESCRIPTION"];
            $url = "http://localhost/ganji/itemDetails.php?ID=" . $ID;
            echo '<div class="item">
            <div class="itemImg">
                <a href="' . $url . '"  target="blank"><img width="200px" height="200px" src="'.$imgs[0].'"></img></a>
            </div>
            <div class="name"><a href="' . $url . '" target="blank">
              ' . $name . '
            </a></div>
            <div class="detail">
                <div class="description">' . $des . '</div>
                <div class="price">' . $price . '</div>
            </div>
        </div>';
        }

        function getItems($tableName, $filed) {
            $items = getValuesByField($tableName, $filed);
            $num = count($items);

            for ($i = 0; $i < $num; $i++) {
                getItem($tableName, $items[$i]);
            }
        }
        ?>