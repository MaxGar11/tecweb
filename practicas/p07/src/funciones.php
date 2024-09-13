<?php

    function esmultiplo($num){
        if(isset($_GET['numero']))
        {
            $num = $_GET['numero'];
            if ($num%5==0 && $num%7==0)
            {
                echo '<h3>R= El número '.$num.' SÍ es múltiplo de 5 y 7.</h3>';
            }
            else
            {
                echo '<h3>R= El número '.$num.' NO es múltiplo de 5 y 7.</h3>';
            }
        }
    }

    function matriznumeros($M){
        $valores = array();

    for ($i = 0; $i < $M; $i++) {
        do {
            $num_aleatorio1 = rand(0, 999);
        } while ($num_aleatorio1 % 2 == 0);

        do {
            $num_aleatorio2 = rand(0, 999);
        } while ($num_aleatorio2 % 2 != 0); 

        do {
            $num_aleatorio3 = rand(0, 999);
        } while ($num_aleatorio3 % 2 == 0);

        $fila = array($num_aleatorio1, $num_aleatorio2, $num_aleatorio3);

        $valores[] = $fila;
    }

    return $valores;
    }

    function multiploaleatorio1($number){

        $numero_random = rand(0,99);
        while(($numero_random%$number != 0)){        
        $numero_random = rand(0,99);
    }
    return $numero_random;
    }

    function multiploaleatorio2($number){

        do {
            $numero_random = rand(0,999);
        } while ($numero_random%$number != 0);
    
    return $numero_random;
    }

    function arregloletras()
    {
        $arreglo = array();
        for ($i=97; $i<=122 ; $i++) { 
            $arreglo[$i]= chr($i);
        }

        return $arreglo;
    }

    function identifypersona($edad, $sexo)
    {
        if($sexo == "Femenino" && ($edad >= 18 && $edad <= 35)){
            return TRUE;
        }else 
        {
            return FALSE;
        }
    }
?>