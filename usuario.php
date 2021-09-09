<?php

// importar conexion
require 'includes/config/database.php';
$db = conectarDB();

// crear un email y password
$email = "correo@correo.com";
$password = "123456";

// query para crear el usuario
$query = "INSERT INTO usuarios (email, password) VALUES ( '${email}', '${password}'); ";
echo $query;

// Agregarlo a la base de datos
mysqli_query($db, $query);