<?php

//Este archivo sirve para conectar y pasar datos a la BD
    //Ponemos el nombre/enlace del servidor
$servername = "localhost";
//Usuario y contraseña para entrar a la BD
$dBUsername = "root";
$dbPassword = "1234";
//Nombre de la tabla
$dbName = "pruebas";

$conn = mysqli_connect($servername, $dBUsername, $dbPassword, $dbName);

define('EMAIL', 'bayonaclase@gmail.com');
define('PASSWORD', 'Ii123456');

if (!$conn) {
    die("Conexión fallida: " .mysqli_connect_error());
}