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

    <div class="admin-panel-2">
        <div class="atras" id="atras">

            <span><a href="../panel.php">Volver Atrás</a></span>

        </div>

        <!--Inicio sesión-->
        <div class="formulario">

            <h2>Tabla de Usuarios</h2>
            <table class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="th-sm th">ID </th>
                        <th class="th-sm th">Usuario</th>
                        <th class="th-sm th">Correo</th>
                        <th class="th-sm th">V. de Correo</th>
                        <th class="th-sm th">Fecha Creación</th>
                        <th class="th-sm th">Ultima Conexión</th>
                        <th class="th-sm th">Tipo Usuario</th>
                        <th class="th-sm th">Baneado</th>
                        <th class="th-sm th">Causa Baneo</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                require '../../includes/dbh.inc.php';
                $sql = "SELECT id, uidUsers, emailUsers, Verified, CreatedAt, LastAccess, UserType, Blocked, BlockedReason FROM users";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '
                        <tr>
                            <td>' . $row["id"] . '</td>
                            <td>' . $row["uidUsers"] . '</td>
                            <td>' . $row["emailUsers"] . '</td>';
                        if ($row["Verified"] == 0) {
                            echo '<td>No</td>';
                        } else {
                            echo '<td>Si</td>';
                        }
                        echo '
                            <td>' . $row["CreatedAt"] . '</td>
                            <td>' . $row["LastAccess"] . '</td>
                            <td>' . $row["UserType"] . '</td>';
                        if ($row["Blocked"] == 0) {
                            echo '<td>No</td>';
                        } else {
                            echo '<td>Si</td>';
                        }
                        echo '
                            <td>' . $row["BlockedReason"] . '</td>
                        </tr>';
                    }
                }
                ?>
                

                </tbody>
                <tfoot>
                    <tr>
                        <th class="th-sm th">ID </th>
                        <th class="th-sm th">Usuario</th>
                        <th class="th-sm th">Correo</th>
                        <th class="th-sm th">V. de Correo</th>
                        <th class="th-sm th">Fecha Creación</th>
                        <th class="th-sm th">Ultima Conexión</th>
                        <th class="th-sm th">Tipo Usuario</th>
                        <th class="th-sm th">Baneado</th>
                        <th class="th-sm th">Causa Baneo</th>
                    </tr>
                </tfoot>
            </table>

        </div>


    </div>





    <script>
        document.getElementById("atras").onclick = function() {
            window.location.href = "../panel.php";
        };
    </script>
</body>

</html>