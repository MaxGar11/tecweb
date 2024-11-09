<?php

    namespace TECWEB\MYAPI;

    abstract class Database{
        protected $conexion;

        public function __construct($db, $user, $pass) {
            
            $this->conexion = @mysqli_connect("localhost", $user, $pass, $db);
    
            
            if ($this->conexion->connect_error) {
                die("Error de conexión: " . $this->conexion->connect_error);
            }
        }
    }

    

?>