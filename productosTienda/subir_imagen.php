<?php
include '../productosTienda/conexion.php'; // Incluye la conexión con Alwaysdata o localhost según corresponda

if (isset($_POST['insertar']) || isset($_POST['actualizar'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $nombreImagen = $_FILES['imagen']['name'];
    $rutaTemp = $_FILES['imagen']['tmp_name'];
    $rutaDestino = "uploads/" . $nombreImagen;

    move_uploaded_file($rutaTemp, $rutaDestino);

    if (isset($_POST['insertar'])) {
        $insertar = "INSERT INTO productos (nombre, precio, imagen) VALUES ('$nombre', '$precio', '$nombreImagen')";
        $sql = mysqli_query($conexion, $insertar);
    }

    if (isset($_POST['actualizar'])) {
        $actualizar = "UPDATE productos SET nombre='$nombre', precio='$precio', imagen='$nombreImagen' WHERE id='$id'";
        $sql = mysqli_query($conexion, $actualizar);
    }
}

header("Location: index.php");
