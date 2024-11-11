<?php
    namespace MYAPI\Update;
    require_once __DIR__ ."/../DataBase.php";
    use MYAPI\Database;

    class Update extends DataBase {

        public function __construct($db,$user = 'root', $pass = '') {
            parent::__construct($db,$user,$pass);
        }

        public function edit($productoJSON) {
            $this->data = array(
                'status'  => 'error',
                'message' => 'Error en la actualización del producto'
            );

            // Verificamos que el JSON recibido no esté vacío
            if (!empty($productoJSON)) {
                // Decodificamos el JSON recibido
                $jsonOBJ = json_decode($productoJSON);

                // Verificamos que los datos necesarios estén presentes
                if (isset($jsonOBJ->id) && isset($jsonOBJ->nombre) && isset($jsonOBJ->marca) && isset($jsonOBJ->modelo) && isset($jsonOBJ->precio) && isset($jsonOBJ->unidades)) {
                    // Establecemos el charset de la conexión
                    $this->conexion->set_charset("utf8");

                    // Preparamos la consulta SQL para actualizar el producto
                    $sql = "UPDATE productos 
                            SET nombre = '{$jsonOBJ->nombre}', 
                                marca = '{$jsonOBJ->marca}', 
                                modelo = '{$jsonOBJ->modelo}', 
                                precio = {$jsonOBJ->precio}, 
                                detalles = '{$jsonOBJ->detalles}', 
                                unidades = {$jsonOBJ->unidades}, 
                                imagen = '{$jsonOBJ->imagen}' 
                            WHERE id = '{$jsonOBJ->id}' AND eliminado = 0";

                    // Ejecutamos la consulta
                    if ($this->conexion->query($sql)) {
                        $this->data['status'] = "success";
                        $this->data['message'] = "Producto actualizado correctamente";
                    } else {
                        $this->data['message'] = "ERROR: No se ejecutó la consulta $sql. " . mysqli_error($this->conexion);
                    }
                } else {
                    $this->data['message'] = 'Datos incompletos para la actualización';
                }
            } else {
                $this->data['message'] = 'No se recibió información para actualizar';
            }
        }
    }
?>

