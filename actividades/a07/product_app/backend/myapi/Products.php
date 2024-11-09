<?php

    namespace Products;
    
    use TECWEB\MYAPI\DataBase;
    require_once __DIR__ . '/DataBase.php';
    
    class Products extends DataBase {
        
        private $data;
    
        // Constructor 
        public function __construct($db, $user='root', $pass = '') {
            parent::__construct($db, $user, $pass);
            $this->data = array();
        }
    
        // Método para añadir un producto
        public function add($jprod) {
            $jsonOBJ=  json_decode($jprod);
            // SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
            $this->data = array(
                'status'  => 'error',
                'message' => 'Ya existe un producto con ese nombre'
            );
            if(isset($jsonOBJ->nombre)) {
                // SE ASUME QUE LOS DATOS YA FUERON VALIDADOS ANTES DE ENVIARSE
                $sql = "SELECT * FROM productos WHERE nombre = '{$jsonOBJ->nombre}' AND eliminado = 0";
                $result = $this->conexion->query($sql);
                
                if ($result->num_rows == 0) {
                    $this->conexion->set_charset("utf8");
                    $sql = "INSERT INTO productos VALUES (null, '{$jsonOBJ->nombre}', '{$jsonOBJ->marca}', '{$jsonOBJ->modelo}', {$jsonOBJ->precio}, '{$jsonOBJ->detalles}', 0, {$jsonOBJ->unidades}, '{$jsonOBJ->imagen}')";
                    if($this->conexion->query($sql)){
                        $this->data['status'] =  "success";
                        $this->data['message'] =  "Producto agregado";
                    } else {
                        $this->data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
                    }
                }
    
                $result->free();
                // Cierra la conexion
                $this->conexion->close();
            }
        }
        
    
        // Método para eliminar un producto por ID
        public function delete($id) {
                // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
            $this->data = array(
                'status'  => 'error',
                'message' => 'La consulta falló'
            );
            // SE VERIFICA HABER RECIBIDO EL ID
            if( isset($id) ) {
                // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
                $sql = "UPDATE productos SET eliminado=1 WHERE id = {$id}";
                if ( $this->conexion->query($sql) ) {
                    $this->data['status'] =  "success";
                    $this->data['message'] =  "Producto eliminado";
                } else {
                    $this->data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
                }
                $this->conexion->close();
            } 
        }
    
    
        // Método para editar un producto
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
    
        // Método para listar todos los productos
        public function list() {
            // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
            if ( $result = $this->conexion->query("SELECT * FROM productos WHERE eliminado = 0") ) {
                // SE OBTIENEN LOS RESULTADOS
                $rows = $result->fetch_all(MYSQLI_ASSOC);

                if(!is_null($rows)) {
                    // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                    foreach($rows as $num => $row) {
                        foreach($row as $key => $value) {
                            $this->data[$num][$key] = $value;
                        }
                    }
                }
                $result->free();
            } else {
                die('Query Error: '.mysqli_error($this->conexion));
            }
            $this->conexion->close();
        }
    
        // Método para buscar un producto por ID
        public function search($search) {
            $this->data = [];

            // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
                $sql = "SELECT * FROM productos WHERE (id = '{$search}' OR nombre LIKE '%{$search}%' OR marca LIKE '%{$search}%' OR detalles LIKE '%{$search}%') AND eliminado = 0";
                if ( $result = $this->conexion->query($sql) ) {
                    // SE OBTIENEN LOS RESULTADOS
                    $rows = $result->fetch_all(MYSQLI_ASSOC);

                    if(!is_null($rows)) {
                        // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                        foreach($rows as $num => $row) {
                            foreach($row as $key => $value) {
                                $this->data[$num][$key] = utf8_encode($value);
                            }
                        }
                    }
                    $result->free();
                } else {
                    die('Query Error: '.$this->conexion->error);
                }
                $this->conexion->close();

        }
    
        public function single($id) {
            if( isset($id) ) {
                // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
                if ( $result = $this->conexion->query("SELECT * FROM productos WHERE id = {$id}") ) {
                    // SE OBTIENEN LOS RESULTADOS
                    $row = $result->fetch_assoc();
        
                    if(!is_null($row)) {
                        // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                        foreach($row as $key => $value) {
                            $this->data[$key] = $value;
                        }
                    }
                    $result->free();
                } else {
                    die('Query Error: '.mysqli_error($this->conexion));
                }
                $this->conexion->close();
            }
        }

        // Método para obtener un solo producto por nombre
        public function singleByName($nombre) {
            if( isset($nombre) ) {
                // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
                if ( $result = $this->conexion->query("SELECT * FROM productos WHERE nombre = {$nombre}") ) {
                    // SE OBTIENEN LOS RESULTADOS
                    $row = $result->fetch_assoc();
        
                    if(!is_null($row)) {
                        // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                        foreach($row as $key => $value) {
                            $this->data[$key] = $value;
                        }
                    }
                    $result->free();
                } else {
                    die('Query Error: '.mysqli_error($this->conexion));
                }
                $this->conexion->close();
            }
        }
    
        // Método para obtener el contenido de response como un string JSON
        public function getData() {
            // SE HACE LA CONVERSIÓN DE ARRAY A JSON
        return json_encode($this->data, JSON_PRETTY_PRINT);
        }
    }
    
?>