<?php
if (isset($_POST['usertype-submit'])) {
    $username = $_POST['username'];
    $usertype = $_POST['usertype'];
    require '../dbh.inc.php';

    $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
    $stmt = mysqli_stmt_init($conn);
    //---Si falla, hace lo siguiente

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../../admin-panel/select/permisions.php?rerror=sqlerror");
        exit();
    } else {
        //Una vez miramos todo lo anterior, pasamos la informacion a la base de datos
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        //Coge los resultados de la base de datos y lo envia con la variable STMT
        mysqli_stmt_store_result($stmt);
        //Nos da un 0 si no hay ningúno, y si nos da un 1 es que existe este usuario
        $resultCheck = mysqli_stmt_num_rows($stmt);
        //Por eso creamos un if en el cual le decimos que si es que existe
        if ($resultCheck > 0) {
            $query = "UPDATE users SET usertype='$usertype' WHERE uidUsers='$username'";

            if (mysqli_query($conn, $query)) {
                header("Location: ../../admin-panel/select/permisions.php?usertype=success");
            }
        } else {
            header("Location: ../../admin-panel/select/permisions.php?error=usernotexist");
            exit();
        }
    }
} else {
    header("Location: ../../admin-panel/panel.php");
}
