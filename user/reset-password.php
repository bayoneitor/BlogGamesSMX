<?php
session_start();
if (isset($_SESSION['userId'])) {

    if ($_SESSION['Block'] == 1) {
        header("Location: ../banned.php");
        die();
    } else { 
        header("Location: already-logged.php");
        die();
    }
} 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>BlogGames - Recuperar Contraseña</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,900" rel="stylesheet">
    <link rel="shortcut icon" href="../img/games.ico" type="image/x-icon">
    
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap/MDB/mdb.css">
    <link rel="stylesheet" href="../css/signup.css">
    <script defer src="https://use.fontawesome.com/releases/v5.5.0/js/all.js" integrity="sha384-GqVMZRt5Gn7tB9D9q7ONtcp4gtHIUEW/yG7h98J7IpE3kpi+srfFyyB/04OV6pG0" crossorigin="anonymous"></script>
    <script src="../js/jquery-3.3.1.min.js"></script>

</head>

<body>

    <div class="contenedor-form">
        <div class="arriba">
            <a href="../signup.php">Volver Atrás</a>
        </div>

        <!--Inicio sesión-->
        <div class="formulario">
            <h2>Recuperar Contraseña</h2>
            <?php
            if (isset($_GET["reset"]) || isset($_GET["error"])) {
                if (isset($_GET["reset"])) {
                    if ($_GET["reset"] == "success") {
                        echo '<p class="alert alert-success text-center">Te hemos enviado el correo satisfactoriamente.</p>';
                    }
                }
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "emptyemail") {
                        echo '<p class="alert alert-danger text-center">¡No puedes dejar el campo vacío!</p>';
                    } else if ($_GET["error"] == "invalidmail") {
                        echo '<p class="alert alert-danger text-center">¡El correo introducido no es válido!</p>';
                    } else if ($_GET["error"] == "notexist") {
                        echo '<p class="alert alert-danger text-center">¡El correo introducido no está en nuestra base de datos!</p>';
                    } else if ($_GET["error"] == "sql") {
                        echo '<p class="alert alert-warning text-center">Estamos teniendo problemas, prueba más tarde. Gracias.</p>';
                    } else if ($_GET["error"] == "exceeded-time") {
                        echo '<p class="alert alert-danger text-center">¡Ha excedido el tiempo de espera!</p>';
                        echo '<p class="alert alert-info text-center">Reenvíe el formulario por favor.</p>';
                    } else if ($_GET["error"] == "token") {
                        echo '<p class="alert alert-warning text-center">¡Ha habido un problema. Envíe de nuevo el formulario por favor!</p>';
                    } else if ($_GET["error"] == "reloadpwd") {
                        echo '<p class="alert alert-warning text-center">¡Hubo un error al actualizar la contraseña!</p>';
                    }
                }
            } else {
                echo '<div class="alert alert-info"><ul><li>Te enviaremos un correo con las instrucciones para reiniciar tu contraseña.</li><li> Una vez enviado tendrá 20 minutos para validarlo.</li></ul></div>';
            }
            ?>

            <form action="../includes/reset-request.inc.php" method="post">
                <input type="text" placeholder="Introduce tu Correo Electrónico" name="email">

                <input type="submit" value="Enviar Correo" name="reset-request-submit">

            </form>

        </div>
    </div>


</body>

</html>