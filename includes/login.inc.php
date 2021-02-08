<?php
session_start();
if (isset($_SESSION['userId'])) {
    header("Location: ../signup.php?login=success");
}
// Miramos que el Usuario haya Clickado el boton de iniciar sesion, si no, no pude acceder a esta pagina.
if (isset($_POST['login-submit'])) {

    require "dbh.inc.php";

    $mailuid = $_POST['mailuid'];
    $password = $_POST['pwd'];

    if (empty($mailuid) || empty($password)) {
        header("Location: ../signup.php?lerror=emptyfields");
        exit();
    } else {
        //se concta a la BD para ver si es correcto el logeo con usuario o correo
        $sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?";

        $stmt = mysqli_stmt_init($conn);
        //Miramos si no funciona
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?lerror=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                //Miramos si las contraseña introducida es correcta
                $pwdCheck = password_verify($password, $row['pwdUsers']);
                if ($pwdCheck == false) {
                    header("Location: ../signup.php?lerror=wrongpwd");
                    exit();
                } else if ($pwdCheck == true) {
                    //iniciamo la sesion con todos los parametros que vayamos a utilizar
                    session_start();
                    $_SESSION['Id'] = $row['id'];
                    $_SESSION['userId'] = $row['idUsers'];
                    $_SESSION['username'] = $row['uidUsers'];
                    $_SESSION['userEmail'] = $row['emailUsers'];
                    $_SESSION['Block'] = $row['Blocked'];
                    $_SESSION['BlockReason'] = $row['BlockedReason'];
                    $_SESSION['UserType'] = $row['UserType'];
                    $_SESSION['Verified'] = $row['Verified'];
                   
                    
                    header("Location: ../index.php");
                    exit();
                }
            } else {
                //Si no existe el usuario hace eso
                header("Location: ../signup.php?lerror=nouser");
                exit();
            }
        }
    }
} else {
    //Aquí lo que hacemos es que si intenta acceder a la pagina sin ser desde el formulario, le lleva al inicio/formulario
    header("Location: ../signup.php");
    exit();
}
