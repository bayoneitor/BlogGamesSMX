<?php
session_start();
if (isset($_SESSION['userId'])) {

    if (($_SESSION['Block']) == 1) {
        header("Location: ../banned.php");
        die();
    }
} else {
    header("Location: ../signup.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>BlogGames - Sesión ya iniciada</title>
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
            <a href="../index.php">Volver al Inicio</a>
        </div>

        <!--Inicio sesión-->
        <div class="formulario">
            <h2>Sesión ya iniciada</h2>
            <p class="alert alert-warning text-center">Si quiere iniciar sesión con otra cuenta, primero cierre la sesión actual.</p>
            <form action="../includes/logout.inc.php" method="post">

                <input type="submit" value="Cerrar Sesión">

            </form>

        </div>
    </div>


</body>

</html>