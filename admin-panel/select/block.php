<?php
session_start();
if (isset($_SESSION['userId'])) {

    if (($_SESSION['Block']) == 1) {
        header("Location: ../../banned.php");
        die();
    } else if (($_SESSION['UserType']) == "Admin") { } else {
        header("Location: ../../index.php");
    }
} else {
    header("Location: ../../index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>BlogGames - Bloquear Usuario</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,900" rel="stylesheet">
    <link rel="stylesheet" href="../../css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="../../css/bootstrap/MDB/mdb.css">
    <link rel="shortcut icon" href="../../img/games.ico" type="image/x-icon">

    <link rel="stylesheet" href="../../css/admin-panel.css">
    <script defer src="https://use.fontawesome.com/releases/v5.5.0/js/all.js" integrity="sha384-GqVMZRt5Gn7tB9D9q7ONtcp4gtHIUEW/yG7h98J7IpE3kpi+srfFyyB/04OV6pG0" crossorigin="anonymous"></script>
    <script src="../../js/jquery-3.3.1.min.js"></script>

</head>

<body>

    <div class="admin-panel">
        <div class="atras"  id="atras">

            <span><a href="../panel.php">Volver Atras</a></span>

        </div>

        <!--Inicio sesión-->
        <div class="formulario">
            <?php
            if (isset($_GET['userbanned'])) {
                if ($_GET['userbanned'] == "success") {
                    echo '<br/><p class="alert alert-success text-center" role="alert"">Usuario Baneado Correctamente</p>';
                }
            }
            if (isset($_GET['error'])) { 
                if ($_GET['error'] == "usernotexist") {
                    echo '<br/><p class="alert alert-warning text-center" role="alert"">El Usuario introducido no existe</p>';
                }
            }
            ?>
            <h2>Banear a un Usuario</h2>

            <form action="../../includes/admin-panel/block.inc.php" method="post">

                <input type="text" name="username" placeholder="Nombre del Usuario a Banear">

                <textarea name="cause" cols="30" rows="10" placeholder="Causa del baneo..."></textarea>

                <input type="submit" value="Banear" name="ban-submit">
            </form>


        </div>


    </div>
    </form>

    </div>
    </div>


</body>

</html>