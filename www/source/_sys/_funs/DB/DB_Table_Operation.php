<?php
// Operate Record ---
// insertData($tableName, $fieldValue)
// deleteData($tableName, $id_value)
// updateData($tableName, $idValue, $fieldName, $fieldType, $fieldValue)
// Get Record ---
// getOneRecord($tableName, $condition)
// getAFieldValue($tableName, $id_value, $fieldName)
// Set up
// getFields($tableName)
// getFieldsByIndex($databaseName, $tableName,$indexArray)
// getFieldsType($tableName)
// getConditions($fields, $fieldsType, $fieldsValue)
require_once dirname(__FILE__).'/../GlobalVariables.php';
require_once dirname(__FILE__).'/../DB/DB_Operation.php';
require_once dirname(__FILE__).'/../Data/Data_Process.php';
require_once dirname(__FILE__).'/../../_conf/URLprocess.php';
////////////////////////////////////////////////////////////////////////---Process
function insertData($tableName, $fieldValue) {
    $con = selectDatabase();
    $fieldArray = getFields($tableName);
    unset($fieldArray[0]);
    $fieldArray = array_values($fieldArray);
    $fields = implode(", ", $fieldArray);

    $fieldtypeArray = getFieldsType($tableName);
    $howmany=count($fieldtypeArray);
    for ($i=0;$i<$howmany;$i++){
        //if ($fieldtypeArray[$i]=="isstring"){
            $fieldValue[$i]="'".$fieldValue[$i]."'";
        //}
    }

    $fieldValues=implode(", ", $fieldValue);

    $sql = "INSERT INTO $tableName (".$fields.") VALUES (".$fieldValues.")";
   // echo $sql;
    if (!$con->query($sql)) {
        echo "You Failed To Insert Data: " . $con->error;
    }
}
////////////////////////////////////////////////////////////////////////////
function deleteData($tableName, $id_value) {
    $con = selectDatabase();
    $sql = "DELETE FROM $tableName WHERE id = '$id_value'";
    if (!$con->query($sql)) {
//            echo "Delete Data Successfully!<br>";
    } else {
    echo "You Failed To Delete Data: " . $con->error;
    }
}
////////////////////////////////////////////////////////////////////////////
function updateData($tableName, $idValue, $fieldName, $fieldType, $fieldValue) {
    $con = selectDatabase();
    $updateOption = getConditions($fieldName, $fieldType, $fieldValue);
    $updateOption = str_replace("AND", ",", $updateOption);
    $sql = "UPDATE $tableName SET $updateOption WHERE id = $idValue";
    //echo "to update: sql=".$sql."<br/>";;
    if (!$con->query($sql)) {
        echo "You Failed To Update Data: " . $con->error;
    } else {
        return TRUE;
    }
}

////////////////////////////////////////////////////////////////////////////---Get data
function getOneRecord($tableName, $condition) {
    $con = selectDatabase();
    $sql = "SELECT * FROM $tableName WHERE $condition";
    if ($con->connect_error) {die("Connection failed: " . $con->connect_error);}
      if (!$con->query($sql)){
          echo("Error description: " . $con->error);
        } else{
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();              
            } else {
                $row ='';
            }
            $con->close();
            return $row;
        }
}
////////////////////////////////////////////////////////////////////////////
function getAFieldValue($tableName, $id_value, $fieldName) {
    $con = selectDatabase();
    $sql = "SELECT * FROM $tableName WHERE id = '$id_value'";
    if ($con->connect_error) {die("Connection failed: " . $con->connect_error);}
      if (!$con->query($sql)){
          echo("Error description: " . $con->error);
        } else{
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();              
            } else {
                $row ='';
            }
            $con->close();
            return $row[$fieldName];
        }
}
////////////////////////////////////////////////////////////////////////////---Set Sections
function getFields($tableName) {
    $ConnDB=selectDatabase();
    if ($ConnDB->connect_errno){
        echo "Failed to connect to MySQL: " . $ConnDB -> connect_error;
        exit();
    }
    $sqlstr="SELECT * FROM ".$tableName;  
    if ($result = $ConnDB -> query($sqlstr)) {
        // Get field information for all fields
        $fieldArray = array();
        $a=null;
        while ($fieldinfo = $result -> fetch_field()) {
            if (is_null($a)){
                $a=0;                
            }else{
                $a=$a+1;
            }
            if ($a>0){
                $fieldArray[$a]=$fieldinfo -> name;
            }            
        }
        $result -> free_result();
      }
    $ConnDB -> close();
    return $fieldArray;
}
////////////////////////////////////////////////////////////////////////////
function getFieldsByIndex($databaseName, $tableName,$indexArray) {
    $link = connectServer();
    $fields = mysql_list_fields($databaseName, $tableName, $link);
    $columns = mysql_num_fields($fields);
    $fieldArray = array();
    $someFields=array();
    $j=0;
    for ($i = 0; $i < $columns; $i++) {
        $fieldArray[$i] = mysql_field_name($fields, $i);
        if(in_array($i, $indexArray))
        {
        $someFields[$j++]=$fieldArray[$i];
        }
    }
    /* for ($i = 0; $i < count($fieldArray); $i++) {
       echo $fieldArray[$i] . "<br>";
    } */
    return $someFields;
}
////////////////////////////////////////////////////////////////////////////
function getFieldsType($tableName) {
    $ConnDB=selectDatabase();
    if ($ConnDB->connect_errno){
        echo "Failed to connect to MySQL: " . $ConnDB -> connect_error;
        exit();
    }
    $sqlstr="SELECT * FROM ".$tableName;  
    if ($result = $ConnDB -> query($sqlstr)) {
        // Get field information for all fields
        $fieldArray = array();
        $a=null;
        while ($fieldinfo = $result -> fetch_field()) {
            if (is_null($a)){
                $a=0;                
            }else{
                $a=$a+1;
            }
            if ($a>0){
                $fieldArray[$a]=$fieldinfo -> type;
                if ($fieldArray[$a]==253 or $fieldArray[$a]==252){
                    $fieldArray[$a]='isstring';
                }else{
                    $fieldArray[$a]='isnum';
                }
            }            
        }
        $result -> free_result();
      }
    $ConnDB -> close();
    return $fieldArray;
}
////////////////////////////////////////////////////////////////////////////
function getConditions($fields, $fieldsType, $fieldsValue) {
    $num_fields = count($fields);
    $num_fieldsType = count($fieldsType);
    $num_fieldsValue = count($fieldsValue);
    $conditon = array();
    if ($num_fields > 0 && $num_fieldsType > 0) {
        if (($num_fields == $num_fieldsType) && ($num_fieldsType == $num_fieldsValue)) {
            for ($i = 0; $i < $num_fields; $i++) {
                if (($fieldsType[$i] == "int") || ($fieldsType[$i] == "real")) {
                    $conditon[$i] = $fields[$i] . " = " . $fieldsValue[$i];
                } else {
                    $conditon[$i] = $fields[$i] . " = '" . $fieldsValue[$i] . "'";
                }
            }
            $condition_output = implode(" AND ", $conditon);
            return $condition_output;
        } else {
            echo "Get Condition Failed: Failed Match Field, Field Type, Field Value!";
        }
    }
}
?>