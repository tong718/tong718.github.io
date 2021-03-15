<?php
require_once dirname(__FILE__).'/../GlobalVariables.php';
// Connect DB Server
function connectServer() {
    $connection = new mysqli($GLOBALS['server_address'], $GLOBALS['server_userName'], $GLOBALS['server_password']);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }else {
        return $connection;
        }
}
// Select DB
function selectDatabase() {
    // Create connection
    $conn = new mysqli($GLOBALS['server_address'], $GLOBALS['server_userName'], $GLOBALS['server_password'], $GLOBALS['server_databasename']);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }else{
        return $conn;  
    }
}
?>