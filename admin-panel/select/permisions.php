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
    <title>BlogGames - Dar permisos a Usuarios</title>
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
        <div class="atras" id="atras">

            <span><a href="../panel.php">Volver Atrás</a></span>

        </div>

        <!--Inicio sesión-->
        <div class="formulario">
            <?php
            if (isset($_GET['usertype'])) {
                if ($_GET['usertype'] == "success") {
                    echo '<br/><p class="alert alert-success text-center" role="alert"">Se le han dado los permisos Correctamente</p>';
                }
            }
            if (isset($_GET['error'])) {
                if ($_GET['error'] == "usernotexist") {
                    echo '<br/><p class="alert alert-warning text-center" role="alert"">El Usuario introducido no existe</p>';
                }
            }
            ?>

            <h2>Dar permisos a un Usuario</h2>

            <form action="../../includes/admin-panel/usertype.inc.php" method="post">

                <input type="text" name="username" placeholder="Nombre del Usuario a dar los permisos">

                <select name="usertype">
                    <option value="Defect">Normal</option>
                    <option value="Writer">Escritor</option>
                    <option value="Admin">Administrador</option>
                </select>

                <input type="submit" value="Dar Permisos" name="usertype-submit">
            </form>


        </div>


    </div>
    </form>

    </div>
    </div>

    <script>
        document.getElementById("atras").onclick = function() {
            window.location.href = "../panel.php";
        };
    </script>
</body>

</html>