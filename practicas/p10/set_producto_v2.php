<?php
// Obtener los valores del formulario
$nombre   = $_POST['nombre_producto'] ?? '';
$marca    = $_POST['marca_producto'] ?? '';
$modelo   = $_POST['modelo_producto'] ?? '';
$precio   = $_POST['precio'] ?? 0.0;
$detalles = $_POST['detalles_producto'] ?? '';
$eliminado = $_POST['eliminado'] ?? 0;  // Para que sea dinámico
$unidades = $_POST['unidades'] ?? 1;
$imagen   = $_POST['imagen'] ?? 'img/imagen.png';

/** SE CREA EL OBJETO DE CONEXION */
@$link = new mysqli('localhost', 'root', '', 'marketzone');

/** comprobar la conexión */
if ($link->connect_errno) 
{
    die('Falló la conexión: '.$link->connect_error.'<br/>');
}

// Validar que nombre, modelo y marca no existan en la BD
$sql_check = "SELECT * FROM productos WHERE nombre = ? AND marca = ? AND modelo = ?";
$stmt_check = $link->prepare($sql_check);
$stmt_check->bind_param("sss", $nombre, $marca, $modelo);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows > 0) {
    // Si ya existe el producto
    echo "<h2>Error: El producto con el nombre, marca y modelo ya existe en la base de datos.</h2>";
    echo "<p>Nombre: {$nombre}</p>";
    echo "<p>Marca: {$marca}</p>";
    echo "<p>Modelo: {$modelo}</p>";
} else {
    // Si el producto no existe, proceder a la inserción
    $sql_insert = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, eliminado, unidades, imagen) 
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_insert = $link->prepare($sql_insert);
    $stmt_insert->bind_param("sssdsiss", $nombre, $marca, $modelo, $precio, $detalles, $eliminado, $unidades, $imagen);

    if ($stmt_insert->execute()) {
        // Mostrar resumen de los datos insertados
        echo "<h2>Producto insertado correctamente con ID: ".$stmt_insert->insert_id."</h2>";
        echo "<p><strong>Nombre:</strong> {$nombre}</p>";
        echo "<p><strong>Marca:</strong> {$marca}</p>";
        echo "<p><strong>Modelo:</strong> {$modelo}</p>";
        echo "<p><strong>Precio:</strong> {$precio}</p>";
        echo "<p><strong>Detalles:</strong> {$detalles}</p>";
        echo "<p><strong>Unidades:</strong> {$unidades}</p>";
        echo "<p><strong>Imagen:</strong> {$imagen}</p>";
    } else {
        // Mostrar mensaje de error si no se puede insertar el producto
        echo "<h2>Error: El producto no pudo ser insertado en la base de datos.</h2>";
    }

    $stmt_insert->close();
}

$stmt_check->close();
$link->close();
?>
