<?php
    class Persona {
        private $nombre; //Define la variable su acceso por cada atributo

        public function inicializar($name){
            $this->nombre = $name;
        }

        public function mostrar(){
            echo "<p>",$this->nombre.'</p>';
        }
    }

?>