<?php
session_start();
if (isset($_SESSION['userId'])) {

    if ($_SESSION['Block'] == 1) {
        header("Location: banned.php");
        die();
    } else { 
        header("Location: user/already-logged.php");
        die();
    }
} 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registrate</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/games.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,900" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap/MDB/mdb.css">
    <link rel="stylesheet" href="css/signup.css">
    <script defer src="https://use.fontawesome.com/releases/v5.5.0/js/all.js" integrity="sha384-GqVMZRt5Gn7tB9D9q7ONtcp4gtHIUEW/yG7h98J7IpE3kpi+srfFyyB/04OV6pG0" crossorigin="anonymous"></script>
    <script src="js/jquery-3.3.1.min.js"></script>

</head>

<body>

    <div class="contenedor-form">
        <div class="toggle">
            <span>Crear Cuenta</span>
        </div>

        <!--Inicio sesión-->
        <div class="formulario">
            <?php
            if (isset($_GET['signup'])) {
                if ($_GET['signup'] == 'waiting-confirmation') {
                    echo '<br/><p class="alert alert-warning text-center" role="alert">Te hemos enviado un email de verificación al Correo introducido anteriormente.</p>';
                }
            }
            if (isset($_GET['newpwd'])) {
                if ($_GET['newpwd'] == 'passwordupdated') {
                    echo '<br/><p class="alert alert-success text-center" role="alert">Tu contraseña ha sido cambiada satisfactoriamente.</p>';
                    echo '<div class="alert alert-info text-center" role="alert">Puedes iniciar sesión normal.</div>';
                }
            }
            //Verificacion
            if (isset($_GET['verification'])) {
                //Le decimos que ya esta su cuenta creada y verificada y auto logeada.
                if ($_GET['verification'] == 'success') {
                    echo '<br/><p class="alert alert-success text-center" role="alert">¡Has verificado la cuenta correctamente!</p>';
                    echo '<div class="alert alert-info text-left" role="alert"><ul><li>Sesión automaticamente logeada.</li></br><li>Vamos a redirigirte en 5 segundos a la página principal.</li></ul></div>';
                    header("Refresh: 5; URL= index.php");
                }
                if ($_GET['verification'] == 'already-done') {
                    echo '<br/><p class="alert alert-warning text-center" role="alert">¡Tu cuenta ha sido verificada anteriormente!</p>';
                    echo '<div class="alert alert-info text-center" role="alert">Puedes iniciar sesion normal</div>';
                }
                if ($_GET['verification'] == 'nouser') {
                    echo '<br/><p class="alert alert-warning text-center" role="alert">¡Usuario no encontrado!</p>';
                }
                if ($_GET['verification'] == 'notoken') {
                    echo '<br/><p class="alert alert-warning text-center" role="alert">¡No hay token proporcionado!</p>';
                }
            }

            //Iniciamos la sesion y redirige solo al index.php
            if (isset($_GET['login']) == 'success') {
                echo '<br/><p class="alert alert-success text-center" role="alert">¡Has iniciado sesión correctamente!</p>';
                echo '<p class="alert alert-info text-center" role="alert">Vamos a redirigirte en 5 segundos a la página principal.</p>';
                header("Refresh: 5; URL= index.php");
            }

            //Aquí decimos que si tiene un "error" del registro, al recargar se cambie solo otra vez a la ventana de crear cuenta.
            if (isset($_GET['rerror'])) {
                echo "<script> 
                window.onload = function cambiar(){
                        $('.formulario').animate({
                            height: 'toggle',
                            'padding-top': 'toggle',
                            'padding-bottom': 'toggle',
                            opacity: 'toggle'
                        }, 'slow');   
                }
               </script>";
            }
            ?>

            <h2>Iniciar Sesión</h2>
            <?php
            //Errores Login
            if (isset($_GET['lerror'])) {
                if ($_GET["lerror"] == "emptyfields") {
                    echo '<p class="alert alert-danger text-center"> ¡No dejes campos vacíos!</p>';
                } else if ($_GET["lerror"] == "wrongpwd") {
                    echo '<p class="alert alert-danger text-center"> ¡La contraseña introducida no es correcta!</p>';
                } else if ($_GET["lerror"] == "nouser") {
                    echo '<p class="alert alert-danger text-center"> ¡El Usuario/Correo introducido no existe!</p>';
                }
            }
            ?>
            <form action="includes/login.inc.php" method="post">
                <input type="text" placeholder="Usuario / Correo Electrónico" name="mailuid">

                <input type="password" placeholder="Contraseña" name="pwd">

                <input type="submit" value="Iniciar Sesión" name="login-submit">

            </form>

        </div>

        <!--Resgistrarse-->
        <div class="formulario">
            <h2>Crea tu Cuenta</h2>
            <?php
            if (isset($_GET['rerror'])) {
                if ($_GET['rerror'] == "emptyfields") {
                    echo '<p class="alert alert-danger text-center"> ¡No dejes campos vacíos!</p>';
                } else if ($_GET['rerror'] == "invalidmailuid") {
                    echo '<p class="alert alert-danger text-center"> ¡El correo ni el usuario son válidos!</p>';
                } else if ($_GET['rerror'] == "invalidmail") {
                    echo '<p class="alert alert-danger text-center"> ¡El correo introducido no es válido!</p>';
                } else if ($_GET['rerror'] == "invaliduid") {
                    echo '<p class="alert alert-danger text-center"> ¡El usuario introducido no es válido!</p>';
                } else if ($_GET['rerror'] == "uidlenght") {
                    echo '<p class="alert alert-danger text-center"> ¡El usuario introducido no es válido!</p>';
                } else if ($_GET['rerror'] == "pwderror") {
                    echo '<p class="alert alert-danger text-center"> ¡La contraseña introducida no es válida!</p>';
                } else if ($_GET['rerror'] == "passwordcheck") {
                    echo '<p class="alert alert-danger text-center"> ¡Las contraseñas introducidas no coinciden!</p>';
                } else if ($_GET['rerror'] == "usertaken") {
                    echo '<p class="alert alert-warning text-center"> ¡Usuario ya existente!</p>';
                } else if ($_GET['rerror'] == "emailtaken") {
                    echo '<p class="alert alert-warning text-center"> ¡Correo ya existente!</p>';
                }
            }
            ?>
            <form action="includes/signup.inc.php" method="post">
                <input type="text" placeholder="Usuario" name="uid">
                <?php
                if (isset($_GET['rerror'])) {
                    if ($_GET['rerror'] == "invaliduid" || $_GET['rerror'] == "invalidmailuid" || $_GET['rerror'] == "uidlenght") {
                        echo '<p class="alert alert-info  text-center"> Recuerda que el usuario no puede contener caracteres especiales. Y tiene que tener entre 8-24 caracteres (a-z,A-Z,0-9).</p>';
                    }
                }
                ?>
                <input type="text" placeholder="Correo Electrónico" name="mail">

                <input type="password" placeholder="Contraseña" name="pwd">
                <?php
                if (isset($_GET['rerror'])) {
                    if ($_GET['rerror'] == "pwderror") {
                        echo '<p class="alert alert-info text-center"> Recuerda que debe tener al menos 1 número, 1 letra en minúscula otra en mayúscula, y cualquiera de estos caracteres especiales: . ! @ # $ %. Y de 8-30 caracteres.</p>';
                    }
                }
                ?>
                <input type="password" placeholder="Confirmar Contraseña" name="pwd-repeat">

                <input type="submit" value="Registrarse" name="signup-submit">
            </form>
        </div>
        <div class="reset-password">
            <a href="user/reset-password.php">Olvide mi Contraseña?</a>
        </div>
    </div>
    <script src="js/register.js"></script>
</body>

</html>