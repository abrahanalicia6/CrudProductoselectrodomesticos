<?php
$servidor = 'mysql-abrahanalicia.alwaysdata.net';
$usuario = '383379';
$contrasena = 'adivina123';
$bd = 'abrahanalicia_casaelectrodomestico';

$conexion = new mysqli($servidor, $usuario, $contrasena, $bd);

if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
} else {
    echo "Conexión exitosa";
}
