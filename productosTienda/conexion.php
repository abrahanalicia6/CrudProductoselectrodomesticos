<?php
// Detecta si estás en un entorno local o en Alwaysdata
if (strpos($_SERVER['SERVER_NAME'], 'localhost') !== false) {
    // Configuración para el entorno local (XAMPP)
    $servidor = 'localhost';
    $usuario = 'root';
    $contrasena = '';
    $bd = 'productostienda';
} else {
    // Configuración para el entorno de Alwaysdata
    $servidor = 'mysql-abrahanalicia.alwaysdata.net';
    $usuario = '383379';
    $contrasena = 'adivina123';
    $bd = 'abrahanalicia_casaelectrodomestico';
}

// Conexión a la base de datos
$conexion = new mysqli($servidor, $usuario, $contrasena, $bd);

// Verificar si la conexión es exitosa
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Pruebas de permisos (sin mostrar mensajes)
// Intento de operación SELECT
$query = "SELECT * FROM productos LIMIT 1";
$conexion->query($query);

// Intento de operación INSERT
$query = "INSERT INTO productos (nombre, precio) VALUES ('Prueba', 0)";
if ($conexion->query($query)) {
    $conexion->query("DELETE FROM productos WHERE nombre = 'Prueba'"); // Eliminar registro de prueba
}

// Intento de operación UPDATE
$query = "UPDATE productos SET precio = 100 WHERE nombre = 'Prueba'";
$conexion->query($query);

// Intento de operación DELETE
$query = "DELETE FROM productos WHERE nombre = 'Prueba'";
$conexion->query($query);

// Cierra la conexión de prueba para no interferir con las operaciones de CRUD en otros archivos
//$conexion->close();


