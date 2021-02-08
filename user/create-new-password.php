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
    <title>BlogGames - Cambiar Contraseña</title>
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
            <h2>Introduce una nueva Contraseña</h2>
            <?php
            if (isset($_GET['error'])) {
                if ($_GET["error"] == "pwdempty") {
                    echo '<p class="alert alert-danger text-center">¡No puedes dejar la contraseña vacía!</p>';
                }if ($_GET["error"] == "pwderror") {
                    echo '<p class="alert alert-info text-justify"> Recuerda que debe tener al menos 1 número, 1 letra en minúscula otra en mayúscula, y cualquiera de estos caracteres especiales: . ! @ # $ %. Y de 8-30 caracteres.</p>';
                }if ($_GET["error"] == "pwdnotsame") {
                    echo '<p class="alert alert-danger text-center">¡Las contraseñas deben de coincidir!</p>';
                }
            }

            $selector = $_GET["selector"];
            $validator = $_GET["validator"];

            if (empty($selector) || empty($validator)) {
                echo '<p class="alert alert-warning"> No hemos podido validar tu solicitud!</p>';
            } else {
                //Con el siguiente "comando", mira si lo introducido realmente es un hex
                if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
                    ?>
                    <form action="../includes/reset-password.inc.php" method="post">
                        <input type="hidden" name="selector" value="<?php echo $selector; ?>">
                        <input type="hidden" name="validator" value="<?php echo $validator; ?>">
                        <input type="password" name="pwd" placeholder="Introduce una nueva contraseña...">
                        <input type="password" name="pwd-repeat" placeholder="Repite la contraseña nueva...">
                        <input type="submit" name="reset-password-submit" value="Reiniciar la contraseña">
                    </form>

                <?php
            }
        }
        ?>

        </div>
    </div>

</body>

</html>