<?php
session_start();
if (isset($_SESSION['userId'])) {

    if ($_SESSION['Block'] == 0) {
        header("Location: index.php");
        die();
    }
} else {
    header("Location: index.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>BlogGames - Baneado</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,900" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap/MDB/mdb.css">
    <link rel="shortcut icon" href="img/games.ico" type="image/x-icon">

    <link rel="stylesheet" href="css/banned.css">
    <script defer src="https://use.fontawesome.com/releases/v5.5.0/js/all.js" integrity="sha384-GqVMZRt5Gn7tB9D9q7ONtcp4gtHIUEW/yG7h98J7IpE3kpi+srfFyyB/04OV6pG0" crossorigin="anonymous"></script>
    <script src="js/jquery-3.3.1.min.js"></script>



</head>

<body class="fondo">

    <div class="admin-panel-2">
        <div>



        </div>

        <!--Inicio sesión-->
        <div class="formulario">

            <h1 class="align-center">Usted <b><?php echo $_SESSION['username']; ?></b>, ha sido Baneado.</h1>
            <br>
            <h3><b>CAUSA</b></h3>
            <br>
            <h5><?php echo $_SESSION['BlockReason']; ?></h5>
            <br>
            <div class="choose" id="cerrar"><a href="includes/logout.inc.php">Cerrar Sesión</a></div>

        </div>


    </div>



    <script>
        document.getElementById("cerrar").onclick = function() {
            window.location.href = "includes/logout.inc.php";
        };
    </script>
</body>

</html>