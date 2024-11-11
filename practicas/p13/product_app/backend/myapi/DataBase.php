<?php

    namespace MYAPI;

    abstract class Database{
        protected $conexion;
        private $data;

        public function __construct($db, $user, $pass) {
            
            $this->conexion = @mysqli_connect("localhost", $user, $pass, $db);
            $this->data = array();
    
            
            if ($this->conexion->connect_error) {
                die("Error de conexión: " . $this->conexion->connect_error);
            }
        }

        // Método para obtener el contenido de response como un string JSON
        public function getData() {
            
        return json_encode($this->data, JSON_PRETTY_PRINT);
        }
    }

    

?>