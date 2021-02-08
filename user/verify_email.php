<?php
session_start();
if (isset($_SESSION['userId'])) {

    if ($_SESSION['Block'] == 1) {
        header("Location: ../banned.php");
        die();
    }
}

require '../includes/dbh.inc.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    //Lo que hago es ver si el usuario ya había entrado previamente al enlace para que no se autologee dando al enlace.
    //Miro el token en la BD miro si coincide, entonces si coincide con alguno miro si tiene un 1
    $verified = "SELECT * FROM users WHERE Token='$token' AND Verified=1";
    $result = mysqli_query($conn, $verified);
    if (mysqli_num_rows($result) > 0) {
        header('location: ../signup.php?verification=already-done');
        die();
    }
    //Conecto a la BD con el token
    $sql = "SELECT * FROM users WHERE Token='$token'";
    $result = mysqli_query($conn, $sql);
    // Miro si hay columnas con ese token, si no lo hay me redirecionara a ../signup.php?verification=nouser
    if (mysqli_num_rows($result) > 0) {
        // Si existe hago un update del user con verified 1, ya que 1 es cuando esta activado.
        $row = mysqli_fetch_assoc($result);
        $query = "UPDATE users SET Verified=1 WHERE Token='$token'";

        if (mysqli_query($conn, $query)) {
            //Le inicio sesion automaticamente, y le envio al index
            session_start();
            $_SESSION['Id'] = $row['id'];
            $_SESSION['userId'] = $row['idUsers'];
            $_SESSION['username'] = $row['uidUsers'];
            $_SESSION['userEmail'] = $row['emailUsers'];
            $_SESSION['Block'] = $row['Blocked'];
            $_SESSION['BlockReason'] = $row['BlockedReason'];
            $_SESSION['UserType'] = $row['UserType'];
            $_SESSION['Verified'] = $row['Verified'];


            header('location: index.php?verification=success');
            exit();
        }
    } else {
        header('location: ../signup.php?verification=nouser');
        exit();
    }
} else {
    header('location: ../signup.php?verification=notoken');
    exit();
}
