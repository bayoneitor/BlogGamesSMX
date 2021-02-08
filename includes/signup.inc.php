<?php
session_start();
// Miramos que el Usuario haya Clickado el boton de enviar, si no, no pude acceder a esta pagina.
// Miramos que le haya dado al boton, con el nombre signup-submit
if (isset($_POST['signup-submit'])) {

    //Añadimos el archivo de conexión
    require "dbh.inc.php";
    require_once "email/emailController.php";

    //Con las siguientes variables, cogemos los datos introducidos del registro
    $username = $_POST['uid'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];

    //Ahora vamos a introducir posibles errores al intentar registrarse un usuario
    //En este caso miramos que este todo rellenado.
    if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
        header("Location: ../signup.php?rerror=emptyfields&uid=" . $username . "&mail=" . $email);
        //Cada vez que tenga un error se saldra del codigo
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?rerror=invalidmailuid");
        exit();
    }
    //Si no ha introducido un *correo* valido
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?rerror=invalidmail&uid=" . $username);
        exit();
    }
    //Si no ha introducido un *usuario* valido
    elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?rerror=invaliduid&mail=" . $email);
        exit();
    }
    //Miramos que el usuario contenga X caracteres
    elseif (strlen($username) <= 8 || strlen($username) >= 24) {
        header("Location: ../signup.php?rerror=uidlenght&mail=" . $email);
        exit();
        //Ahora les decimos a las contraseñas que tengan que tener al menos 1 número y 1 letra en minúscula, cualquiera de estos caracteres !@#$%.,
        // y debe tener entre 8-30 caracteres
    } elseif (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])(?=.*[!@#$%])[0-9A-Za-z!@#$%]{8,30}$/', $password)) {
        header("Location: ../signup.php?rerror=pwderror&uid=" . $username . "&mail=" . $email);
        exit();
        //Mira que las contraseñas sean iguales
    } elseif ($password !== $passwordRepeat) {
        header("Location: ../signup.php?rerror=passwordcheck&uid=" . $username . "&mail=" . $email);
        exit();
        /*Miramos que el usuario no se repita!!!!!!! */
    } else {
        //Miramos que no se repitan los usuarios ni el correo
        $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
        $stmt = mysqli_stmt_init($conn);
        //---Si falla, hace lo siguiente
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?rerror=sqlerror");
            exit();
        } else {
            //Una vez miramos todo lo anterior, pasamos la informacion a la base de datos
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            //Coge los resultados de la base de datos y lo envia con la variable STMT
            mysqli_stmt_store_result($stmt);
            //Nos da un 0 si no hay ningúno, y si nos da un 1 es que ya existe
            $resultCheck = mysqli_stmt_num_rows($stmt);
            //Por eso creamos un if en el cual le decimos que si es mas grande que 0 que de error
            if ($resultCheck > 0) {
                header("Location: ../signup.php?rerror=usertaken&mail=" . $email);
                exit();
                /*HACEMOS LO MISMO PERO AHORA CON EL CORREO*/
            } else {
                $sql = "SELECT emailUsers FROM users WHERE emailUsers=?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../signup.php?rerror=sqlerror");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $email);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    $resultCheck = mysqli_stmt_num_rows($stmt);
                    if ($resultCheck > 0) {
                        header("Location: ../signup.php?rerror=emailtaken&uid=" . $username);
                        exit();
                    } else {
                        $sql = "INSERT INTO users (idUsers ,uidUsers, emailUsers, pwdUsers, verified, token) VALUES (?, ?, ?, ?, ?, ?)";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            header("Location: ../signup.php?rerror=sqlerror");
                            exit();
                        } else {
                            //Vamos a crear un hash para la contraseña
                            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                            //Ahora vamos a crear el token s la verificacion de correo
                            $token = bin2hex(random_bytes(50));
                            $verified = false;
                            $idusers = bin2hex(random_bytes(8));

                            mysqli_stmt_bind_param($stmt, "ssssbs", $idusers, $username, $email, $hashedPwd, $verified, $token);
                            mysqli_stmt_execute($stmt);

                        }


                        //Envio de Correo

                        sendVerificationEmail($email, $token);

                        header("Location: ../signup.php?signup=waiting-confirmation");
                        exit();
                    }
                }
            }
        }
    }
    //Cerramos la conexion a la BD
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    //Aquí lo que hacemos es que si intenta acceder a la pagina sin ser desde el formulario, le lleva al inicio/formulario
    header("Location: ../signup.php");
    exit();
}
