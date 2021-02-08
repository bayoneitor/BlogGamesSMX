<?php
if (isset($_POST["reset-request-submit"])) {

    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    $url = "http://25.63.114.63/BlogGames/user/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);

    //Le decimos el timepo que queremos que tenga en este caso 1200s (20min) hasta que expire
    //date("U") --> lo que hace es ver los segundos pasados desde el año 1970
    $expires = date("U") + 1200;

    require 'dbh.inc.php';
    require 'email/emailController.php';

    $userEmail = $_POST["email"];
    //---ERRORES
    //Primero vamos a mirar si el correo existe
    if (empty($userEmail)) {
        header("Location: ../user/reset-password.php?error=emptyemail");
    }
    if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../user/reset-password.php?error=invalidmail");
        exit();
    } else {
        //Lo que hago es consultar a la base de datos si exite alguna columna con ese correo
        $sql = "SELECT emailUsers FROM users WHERE emailUsers=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../user/reset-password.php?error=sql");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $userEmail);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck == 0) {
                header("Location: ../user/reset-password.php?error=notexist");
                exit();
            }
        }
    }


    //---FIN ERRORES
    
    $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../user/reset-password.php?error=sql");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $userEmail);
        mysqli_stmt_execute($stmt);
    }
    $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires, pwdUsesOnce) VALUES (?, ?, ?, ?, ?);";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../user/reset-password.php?error=sql");
        exit();
    } else {
        $hashedToken =  password_hash($token, PASSWORD_DEFAULT);
        $uses = 0;
        mysqli_stmt_bind_param($stmt, "ssssb", $userEmail, $selector, $hashedToken, $expires, $uses);
        mysqli_stmt_execute($stmt);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    //Indicamos la funcion del envio de correo desde emailController.php
    sendRecoveryPasswordEmail($userEmail, $url);

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    header("Location: ../user/reset-password.php?reset=success");
} else {
    header("Location: index.php");
}
