<?php
/* CONEXION A LA BASE DE DATOS*/
$host = "localhost";
$user = "root";
$pass = "";
$db = "productos";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

?>