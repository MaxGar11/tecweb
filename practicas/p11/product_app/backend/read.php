<?php
    include_once __DIR__.'/database.php';

    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array();
    // SE VERIFICA HABER RECIBIDO EL ID
    if(isset($_POST['marca']) || isset($_POST['id'])) {
        $marca = isset($_POST['marca']) ? mysqli_real_escape_string($conexion, $_POST['marca']) : null;
        $id = isset($_POST['id']) ? mysqli_real_escape_string($conexion, $_POST['id']) : null;

        //mysqli_real_escape_string ayuda que el navegador no envie datos especiales evitando que afecte la query con datos innecesarios
        //Mas información en: https://www.php.net/manual/en/function.mysql-real-escape-string.php 


        // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS

        if ($result = $conexion->query("SELECT * FROM productos WHERE marca LIKE '%$marca%'")) {
            // SE OBTIENEN LOS RESULTADOS
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                $data[] = array_map('utf8_encode', $row);
            }
			$result->free();
		} else {
            die('Query Error: '.mysqli_error($conexion));
        }

        if ( $result2 = $conexion->query("SELECT * FROM productos WHERE id = '{$id}'") ) {
            // SE OBTIENEN LOS RESULTADOS
			$row = $result2->fetch_array(MYSQLI_ASSOC);

            if(!is_null($row)) {
                // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                foreach($row as $key => $value) {
                    $data[$key] = utf8_encode($value);
                }
            }
			$result2->free();
		} else {
            die('Query Error: '.mysqli_error($conexion));
        }

		$conexion->close();
    }
    
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>