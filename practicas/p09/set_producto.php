<?php
// Obtener los valores del formulario
$nombre   = $_POST['nombre_producto'] ?? '';
$marca    = $_POST['marca_producto'] ?? '';
$modelo   = $_POST['modelo_producto'] ?? '';
$precio   = $_POST['precio'] ?? 0.0;
$detalles = $_POST['detalles_producto'] ?? '';
$unidades = $_POST['unidades'] ?? 1;
$imagen   = $_POST['imagen'] ?? 'img/imagen.png';

/** SE CREA EL OBJETO DE CONEXION */
@$link = new mysqli('localhost', 'root', '', 'marketzone');    

/** comprobar la conexión */
if ($link->connect_errno) 
{
    die('Falló la conexión: '.$link->connect_error.'<br/>');
}

/** Crear una tabla que no devuelve un conjunto de resultados */
$sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $link->prepare($sql);
$stmt->bind_param("sssdsis", $nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen);

if ($stmt->execute()) 
{
    echo 'Producto insertado con ID: '.$stmt->insert_id;
}
else
{
    echo 'El Producto no pudo ser insertado =(';
}

$stmt->close();
$link->close();
?>
