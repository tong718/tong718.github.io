<?php

require 'template.php';

global $server_address;
global $server_userName;
global $server_password;
global $server_databasename;

$server_address = "tangren1.mysql5.webhost.co.nz";
$server_userName = "jilajial";
$server_password = "jian1980";
$server_databasename = "webcenter";

function selectDatabase($databaseName) {
    $connection = mysql_connect($GLOBALS['server_address'], $GLOBALS['server_userName'], $GLOBALS['server_password']);
    //Check connection
    if ($connection) {
        //echo "Connect Server Successfully!<br>";
        //Select Database
        $con_db = mysql_select_db($databaseName, $connection);
        if ($con_db) {
            //echo "Select Database Successfully!<br>";
            mysql_query("SET CHARACTER_SET_CLIENT='utf8'");
            mysql_query("SET CHARACTER_SET_RESULTS='utf8'");
            mysql_query("SET CHARACTER_SET_CONNECTION='utf8'");
            return $connection;
        } else {
            die("You Failed To Select Database: " . mysql_error());
        }
    } else {
        die("Failed to connect to MySQL: " . mysql_error());
    }
}

function countRow($tableName, $condition) {
    $con = selectDatabase($GLOBALS['server_databasename']);
    $sql = "SELECT count(*) FROM $tableName $condition";
    $result = mysql_query($sql, $con);
    $num = mysql_fetch_array($result);
    $rowNumber = $num[0];
    return $rowNumber;
}

function getOneValueByCondition($tableName, $fieldName, $condition, $orderBy, $offset, $pageSize) {
    $con = selectDatabase($GLOBALS['server_databasename']);
    $sql = "SELECT * FROM $tableName $condition $orderBy LIMIT $offset, $pageSize";
    $outputs = array();
    $num = 0;
    $result = mysql_query($sql, $con);
    while ($row = mysql_fetch_array($result)) {
        $output = "";
        for ($i = 0; $i < count($fieldName); $i++) {
            $output = $output . $row["id"] . "<|>";
            $output = $output . $row[$fieldName[$i]] . "<|>";
        }
        $outputs[$num++] = $output;
    }
    return $outputs;
}

//****THE FUNCTIONS ABOVE ARE ABOUT DATABASE AND TABLE OPERATIONS****//

function listTemplate($tableName, $fieldName, $condition, $orderBy, $templateName, $pageSize) {
    $number = countRow($tableName, $condition);
    if ($number % $pageSize) {
        $pages = intval($number / $pageSize) + 1;
    } else {
        $pages = intval($number / $pageSize);
    }
    if (isset($_GET['page'])) {
        $page = intval($_GET['page']);
    } else {
        $page = 1;
    }
    $offset = $pageSize * ($page - 1);
    $displayList = getOneValueByCondition($tableName, $fieldName, $condition, $orderBy, $offset, $pageSize);
    for($i = 0; $i < count($displayList); $i++){
        $temp = explode("<|>", $displayList[$i]);
        $id = $temp[0];
        unset($temp[0]);
        $output = array_values($temp);
        showListedTemplate($templateName, $output, $tableName, $id);
    }
    pageNumberTemplate($page, $pages);
}

// $tableName = "products";
// $fieldName = array("Product_Name", "Retail_Price");
// $condition = "WHERE belong_site='www.kingdomtour.co.nz'";
// $orderBy = "ORDER BY Retail_Price DESC";

// $templateName = "";
// $pageSize = 10;
// listTemplate($tableName, $fieldName, $condition, $orderBy, $templateName, $pageSize);
?>
