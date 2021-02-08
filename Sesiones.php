<?php
 $_SESSION['Id'] = $row['id'];
 $_SESSION['userId'] = $row['idUsers'];
 $_SESSION['username'] = $row['uidUsers'];
 $_SESSION['userEmail'] = $row['emailUsers'];
 $_SESSION['Block'] = $row['Blocked'];
 $_SESSION['BlockReason'] = $row['BlockedReason'];
 $_SESSION['UserType'] = $row['UserType'];
 $_SESSION['Verified'] = $row['Verified'];
 
 /* 
    Tipos de usuarios:
        - Admin         -> Acceso a Panel de Administrador
        - Default       -> Acceso normal
        - Writer        -> Puede Crear Posts
 */