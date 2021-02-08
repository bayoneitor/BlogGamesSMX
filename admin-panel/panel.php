<?php
session_start();
if (isset($_SESSION['userId'])) {

    if (($_SESSION['Block']) == 1) {
        header("Location: ../banned.php");
        die();
    } else if (($_SESSION['UserType']) == "Admin") { } else {
        header("Location: ../index.php");
    }
} else {
    header("Location: ../index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>BlogGames - Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,900" rel="stylesheet">
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap/MDB/mdb.css">
    <link rel="shortcut icon" href="../img/games.ico" type="image/x-icon">

    <link rel="stylesheet" href="../css/admin-panel.css">
    <script defer src="https://use.fontawesome.com/releases/v5.5.0/js/all.js" integrity="sha384-GqVMZRt5Gn7tB9D9q7ONtcp4gtHIUEW/yG7h98J7IpE3kpi+srfFyyB/04OV6pG0" crossorigin="anonymous"></script>
    <script src="../js/jquery-3.3.1.min.js"></script>

</head>

<body>

    <div class="admin-panel">
        <div class="atras">

            <span><a href="../index.php">Volver al Inicio</a></span>

        </div>

        <!--Inicio sesión-->
        <div class="formulario">
            <h2>Panel de Administrador</h2>

            <div class="choose" id="permisions"><a href="select/permisions.php">Dar permisos a un Usuario</a></div>
            <div class="choose" id="table"><a href="select/table.php">Ver tabla de Usuarios</a></div>
            <div class="choose" id="block"><a href="select/block.php">Bloquear un Usuario</a></div>
            <div class="choose" id="unblock"><a href="select/unblock.php">Desbloquear un Usuario</a></div>

        </div>


    </div>
    </form>

    </div>
    </div>

    <script>
        document.getElementById("permisions").onclick = function() {
            window.location.href = "select/permisions.php";
        };
        document.getElementById("table").onclick = function() {
            window.location.href = "select/table.php";
        };
        document.getElementById("block").onclick = function() {
            window.location.href = "select/block.php";
        };
        document.getElementById("unblock").onclick = function() {
            window.location.href = "select/unblock.php";
        };
        document.getElementById("atras").onclick = function() {
            window.location.href = "../index.php";
        };
    </script>
</body>

</html>