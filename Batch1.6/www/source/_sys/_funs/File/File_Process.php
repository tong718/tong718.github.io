<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>
    
<form action="upload_file.php" method="post"
enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="file" id="file"><br>
<input type="submit" name="submit" value="Submit">
</form>
    
<?php
/*
 * function deleteFile($filePath)
 * function renameFile(#fileName_1, $fileName_2)
 * function uploadFile()
 */

function deleteFile($filePath){
    if(file_exists($filePath)){
        unlink($filePath);
    }else{
        echo "DeleteFile Failed : File NOT Exist!";
    }
}

function renameFile($fileName_1, $fileName_2){
    if(file_exists($fileName_1)){
        rename($fileName_1, $fileName_2);
    }else{
        echo "RenameFile Failed :  File NOT Exist!";
    }
}

function uploadFile(){
    $allowedExts = array("??");
    $allowedType = array("??");
    $type = $_FILES["file"]["type"];
    $temp = explode(".", $_FILES["file"]["name"]);
    $extension = end($temp);
    //用户在上传本地文件是提示单个文件不能大于200KB
    if((in_array($type, $allowedType)) && (in_array($extension, $allowedExts)) && ($_FILES["file"]["size"] < 200000)){
        if($_FILES["file"]["error"] > 0){
            echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
        }else{
            if (file_exists("upload/" . $_FILES["file"]["name"])){
                echo $_FILES["file"]["name"] . " already exists. ";
            }else{
                move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"]);
                echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
            }
        }
    }else{
        echo "Invalid File";
    }
}

//deleteFile("");
//renameFile("./hello.txt", "./Hello.txt");
?>
<body>
</body>
</html>