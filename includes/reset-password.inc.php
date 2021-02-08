<?php
//Para mas seguridad siempre hay que poner el isset, para que solo puedan acceder solo si le ha dado clic al boton.
if (isset($_POST["reset-password-submit"])) {

    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $password = $_POST["pwd"];
    $passwordRepeat = $_POST["pwd-repeat"];

    //errores de contraseña
    
    if (empty($password) || empty($passwordRepeat)) {
        header("Location: ../user/create-new-password.php?selector=$selector&validator=$validator&error=pwdempty");
        exit();
    } elseif (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])(?=.*[!@#$%])[0-9A-Za-z!@#$%]{8,30}$/', $password)) {
        header("Location: ../user/create-new-password.php?selector=$selector&validator=$validator&error=pwderror");
        exit();
        //Mira que las contraseñas sean iguales
    } elseif ($password !== $passwordRepeat) {
        header("Location: ../user/create-new-password.php?selector=$selector&validator=$validator&error=pwdnotsame");
        exit();
    }
    //Miramos el tiempo para ver si ha expirado el tiempo
    //date("U") --> lo que hace es ver los segundos pasados desde el año 1970
    $currentDate = date("U");

    require 'dbh.inc.php';

    $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector=? AND pwdResetExpires >= ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location:  ../user/reset-password.php?error=sql");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        if (!$row = mysqli_fetch_assoc($result)) {
            header("Location: ../user/reset-password.php?error=exceeded-time");
            echo "Necesitas re-enviar el formulario, ya ha pasado el tiempo de espera.";
            exit();
        } else {

            $tokenBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);

            if ($tokenCheck == false) {
                header("Location:  ../user/reset-password.php?error=token");
                exit();
            } elseif ($tokenCheck === true) {
                $tokenEmail = $row['pwdResetEmail'];

                $sql = "SELECT * FROM users WHERE emailUsers=?;";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location:  ../user/reset-password.php?error=sql");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if (!$row = mysqli_fetch_assoc($result)) {
                        header("Location:  ../user/reset-password.php?error=reloadpwd");
                        exit();
                    } else {
                        $sql = "UPDATE users SET pwdUSers=? WHERE emailUsers=?";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            header("Location:  ../user/reset-password.php?error=sql");
                            exit();
                        } else {
                            $newPwdHash = password_hash($password, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt, "ss", $newPwdHash, $tokenEmail);
                            mysqli_stmt_execute($stmt);

                            $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
                            $stmt = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                                header("Location:  ../user/reset-password.php?error=sql");
                                exit();
                            } else {
                                $sql = "UPDATE pwdreset SET pwdUsesOnce=1 WHERE pwdResetEmail=?";
                                $stmt = mysqli_stmt_init($conn);
                                if (!mysqli_stmt_prepare($stmt, $sql)) {
                                    header("Location:  ../user/reset-password.php?error=sql");
                                    exit();
                                } else {
                                    mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                                    mysqli_stmt_execute($stmt);
                                    header("Location:  ../signup.php?newpwd=passwordupdated");
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header("Location: index.php");
}
