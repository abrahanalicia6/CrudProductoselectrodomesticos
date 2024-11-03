<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de productos electrodomésticos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="main-container">
        <form action="index.php" method="POST" enctype="multipart/form-data">
            <h1>Registro de productos electrodomésticos</h1>
            
            <label>Id:</label>
            <input type="text" name="id"><br>
            
            <label>Nombre del producto:</label>
            <input type="text" name="nombre"><br>
            
            <label>Precio:</label>
            <input type="text" name="precio"><br><br>
            
            <label>Imagen del producto:</label>
            <input type="file" name="imagen"><br><br>
            
            <input type="submit" name="insertar" value="INSERTAR">
            <input type="submit" name="consultar" value="CONSULTAR">
            <input type="submit" name="actualizar" value="ACTUALIZAR">
            <input type="submit" name="eliminar" value="ELIMINAR"><br><hr>
        </form>

        <!-- Contenedor centrado de productos -->
        <div class="product-container">
            <?php
            include '../productosTienda/conexion.php';

            // Obtener datos del formulario
            $id = isset($_POST['id']) ? $_POST['id'] : '';
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
            $precio = isset($_POST['precio']) ? $_POST['precio'] : '';

            // Insertar producto
            if (isset($_POST['insertar'])) {
                $nombreImagen = $_FILES['imagen']['name'];
                $rutaTemp = $_FILES['imagen']['tmp_name'];
                $rutaDestino = "uploads/" . $nombreImagen;

                if (move_uploaded_file($rutaTemp, $rutaDestino)) {
                    $insertar = "INSERT INTO productos (nombre, precio, imagen) VALUES ('$nombre', '$precio', '$nombreImagen')";
                    $sql = $conexion->query($insertar);
                }
            }

            // Consultar productos
            if (isset($_POST['consultar'])) {
                $consultar = "SELECT * FROM productos";
                $sql = $conexion->query($consultar);
                
                while ($ver = $sql->fetch_array()) {
                    echo "<div class='producto'>";
                    echo "<img src='uploads/" . htmlspecialchars($ver['imagen']) . "' width='100'><br>";
                    echo "ID: " . htmlspecialchars($ver['id']) . "<br>";
                    echo "Nombre: " . htmlspecialchars($ver['nombre']) . "<br>";
                    echo "Precio: $" . htmlspecialchars($ver['precio']) . "<br>";
                    echo "</div>";
                }
            }

            // Actualizar producto
            if (isset($_POST['actualizar'])) {
                $actualizar = "UPDATE productos SET nombre='$nombre', precio='$precio' WHERE id='$id'";
                $sql = $conexion->query($actualizar);
            }

            // Eliminar producto
            if (isset($_POST['eliminar'])) {
                $eliminar = "DELETE FROM productos WHERE id='$id'";
                $sql = $conexion->query($eliminar);
            }

            // Cerrar la conexión
            $conexion->close();
            ?>
        </div>
    </div>
</body>
</html>


