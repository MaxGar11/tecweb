<?php
    class Cabecera{
        private $titulo;

        public function __contruct($title){
            $this->titulo = $tittle;
        }

        public function graficar(){
            $estilo = 'text-align: center';
            echo '<h1 style="'.$estilo.'">', $this->titulo.'</h1>';
        }
    }
?>