<?php
session_start();
require "dbh.inc.php";
$id =  $_SESSION['userId'];

if (isset($_POST['submit-profile'])) {
    $file = $_FILES['archivo'];

    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0){
            if ($fileSize < 1000000) {
                $fileNameNew = "profile".$id.".".$fileActualExt;
                $fileDestination = '../img/Avatar/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                $sql = "UPDATE users SET statusImg=0 WHERE idUsers='$id';";
                $result = mysqli_query($conn, $sql);
                header("Location: ../user/avatar.php?uploadsuccess");
            } else {
                echo "¡El archivo es demasiado grande!";
            }
        }else{
            echo"Ha habido un error al subir el archivo";
        }
    }else {
        echo"¡No puedes subir archivos de este tipo!";
    }
}
