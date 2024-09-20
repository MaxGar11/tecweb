<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8" />
    <title>Práctica 5 - Manejo de Variables</title>
</head>
<body>

<h1>Resultados de la Práctica 5</h1>

<h1>Ejercicio 1</h1>
<?php
    # EJERCICIO 1
    $variables = [
        '$_myvar' => 'valida',
        '$_7var' => 'valida',
        'myvar' => 'invalida',
        '$myvar' => 'valida',
        '$var7' => 'valida',
        '$_element1' => 'valida',
        '$house*5' => 'inválida'
    ];
?>

<h1>Ejercicio 2</h1>
<?php
    # EJERCICIO 2

    $a = "ManejadorSQL";
    $b = 'MySQL';
    $c = &$a;

    print_r($a);
    echo '<br>';
    print_r($b);
    echo '<br>';
    print_r($c);
    echo '<br>';


    #  inciso b

    $a = "PHP server";
    $b = &$a;

    echo $a. '<br>';
    echo $b. '<br>';

?>

<h1>Ejercicio 3</h1>
<?php
    # EJERCICIO 3
    echo '<br>';
    $a = "PHP5";
    print_r($a);
    echo '<br>';
    $z[] = &$a;
    print_r($z);
    echo '<br>';
    $b = "5a version de PHP";
    print_r($b);
    echo '<br>';
    $c = $b*10;
    print_r($c);
    echo '<br>';
    $a .= $b;
    print_r($a);
    echo '<br>';
    $b *= $c;
    print_r($b);
    echo '<br>';
    $z[0] = "MySQL";
    print_r($z);
    echo '<br>';
    echo '<br>';
?>

<h1>Ejercicio 4</h1>
<?php
    # EJERCICIO 4

    global $a, $b, $c, $z;

    echo 'Valor de $a en E3: ' . $a . '<br>';
    echo 'Valor de $b en E3: ' . $b . '<br>';
    echo 'Valor de $c en E3: ' . $c . '<br>';
    echo 'Valor de $z en E3: ';
    print_r($z);
    echo '<br>';

    $a = "N4";
    $b = "N4";
    $c = 500;
    $z[0] = "MySQL2";

    echo '<br>';
    echo 'Valor de $a: ' . $a . '<br>';
    echo 'Valor de $b: ' . $b . '<br>';
    echo 'Valor de $c: ' . $c . '<br>';
    echo 'Valor de $z: ';
    print_r($z);
    echo '<br>';
?>


<h1>Ejercicio 5</h1>
<?php
    # EJERCICIO 5

    $a = "7 personas";
    $b = (integer) $a;
    $a = "9E3";
    $c = (double) $a;

    echo '<br>';
    echo 'Valor de $a: ' . $a . '<br>'; 
    echo 'Valor de $b: ' . $b . '<br>'; 
    echo 'Valor de $c: ' . $c . '<br>'; 
?>


<h1>Ejercicio 6</h1>
<?php
    # EJERCICIO 6

    # definicion variables
    $a = false;  
    $b = true;            
    $c = false;             
    $d = false;             
    $e = true;          
    $f = true;

    echo '<br>';
    echo 'Valor de $a: ';   
    var_dump($a); 
    echo '<br>';

    echo 'Valor de $b: ';
    var_dump($b); 
    echo '<br>';

    echo 'Valor de $c: ';
    var_dump($c); 
    echo '<br>';

    echo 'Valor de $d: ';
    var_dump($d); 
    echo '<br>';

    echo 'Valor de $e: ';
    var_dump($e); 
    echo '<br>';

    echo 'Valor de $f: ';
    var_dump($f); 
    echo '<br>';
?>


<h1>Ejercicio 7</h1>
<?php
    # EJERCICIO 7

    echo '<br>';
    if (isset($_SERVER['SERVER_SOFTWARE'])) {
        echo 'Versión de Apache: ' . $_SERVER['SERVER_SOFTWARE'] . '<br>';
    } else {
        echo 'No se pudo determinar la versión de Apache.<br>';
    }

    echo 'Versión de PHP: ' . phpversion() . '<br>';


    if (isset($_SERVER['SERVER_SOFTWARE'])) {
        echo 'Nombre del sistema operativo del servidor: ' . php_uname() . '<br>';
    } else {
        echo 'No se pudo determinar el nombre del sistema operativo del servidor.<br>';
    }


    if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
        echo 'Idioma del navegador (cliente): ' . $_SERVER['HTTP_ACCEPT_LANGUAGE'] . '<br>';
    } else {
        echo 'No se pudo determinar el idioma del navegador.<br>';
    }
?>

</body>
</html>