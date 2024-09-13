<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 4</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Escribir programa para comprobar si un número es un múltiplo de 5 y 7</p>
    <form action="index.php" method="get">
        Número: <input type="text" name="numero">
        <input type="submit" value="Conocer">
    </form>

    <?php
    include_once 'C:\xampp\htdocs\tecweb\practicas\p07\src\funciones.php';
        if(isset($_GET['numero'])){
            $num = $_GET['numero'];
            echo '<h3>', esmultiplo($num). '<h3>';
        }
    ?>

    <h2>Ejercicio 2</h2>
    <p>Crea un programa para la generación repetitiva de 3 números aleatorios hasta obtener una
    secuencia compuesta por impar, par, impar</p>
    <form action="http://localhost/tecweb/practicas/p07/index.php" method="get">
        Número de iteraciones:<input type="text" name="itera"><br>
        <input type="submit" value="Crear">
    </form>
    <br>
    <?php
    include_once 'C:\xampp\htdocs\tecweb\practicas\p07\src\funciones.php';
        if(isset($_GET['itera']))
        {
            $M = $_GET['itera'];
            $numero_iteraciones = $_GET['itera'];
            $valores = matriznumeros($M);
            $total_elementos = 0;
            foreach ($valores as $M) {
                $total_elementos += count($M);
            }
            echo "<pre>";
            print_r($valores);
            echo "<pre>";
            echo $total_elementos . " números obtenidos en " . $numero_iteraciones . " iteraciones";
        }
    ?>


    <h2>Ejercicio 3.1</h2>
    <p>Utiliza un ciclo while para encontrar el primer número entero obtenido aleatoriamente,
    pero que además sea múltiplo de un número dado.</p>
    <form action="http://localhost/tecweb/practicas/p07/index.php" method="get">
        Número:<input type="text" name="number"><br>
        <input type="submit" value="Crear">
    </form>
    <br>
    <?php
    include_once 'C:\xampp\htdocs\tecweb\practicas\p07\src\funciones.php';
        if(isset($_GET['number']))
        {
            $number = $_GET['number'];
            $numero_correcto = multiploaleatorio1($number);
            echo "<pre>";
            print_r($numero_correcto);
            echo "<pre>";
        }
    ?>

    <h2>Ejercicio 3.2</h2>
    <p>Crear una variante de este script utilizando el ciclo do-while.</p>
    <form action="http://localhost/tecweb/practicas/p07/index.php" method="get">
        Otro Número:<input type="text" name="number1"><br>
        <input type="submit" value="Crear">
    </form>
    <?php
    include_once 'C:\xampp\htdocs\tecweb\practicas\p07\src\funciones.php';
        if(isset($_GET['number1']))
        {
            $number = $_GET['number1'];
            $numero_correcto = multiploaleatorio2($number);
            echo "<pre>";
            print_r($numero_correcto);
            echo "<pre>";
        }
    ?>

    <h2>Ejercicio 4</h2>
    <p>Crear un arreglo cuyos índices van de 97 a 122 y cuyos valores son las letras de la ‘a’
    a la ‘z’. Usa la función chr(n) que devuelve el caracter cuyo código ASCII es n para poner
    el valor en cada índice.</p>
    <br>
    <?php
    include_once 'C:\xampp\htdocs\tecweb\practicas\p07\src\funciones.php';
    
        $arreglo = arregloletras();
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
        echo '<html xmlns="http://www.w3.org/1999/xhtml">';
        echo '<head>';
        echo '<title>Tabla con Arreglo</title>';
        echo '</head>';
        echo '<body>';

        echo '<table border="1">';

        foreach ($arreglo as $key => $value) {
       
           echo '<tr>';
           echo '<td>' . $key . '</td>';
           echo '<td>' . $value . '</td>';
          echo '</tr>';
        }

        echo '</table>';
        echo '</body>';
        echo '</html>';
    ?>

    <h2>Ejercicio 5</h2>
    <p>Usar las variables $edad y $sexo en una instrucción if para identificar una persona de
    sexo “femenino”, cuya edad oscile entre los 18 y 35 años y mostrar un mensaje de
    bienvenida apropiado.</p>
    <form action="http://localhost/tecweb/practicas/p07/index.php" method="get">
        Edad:<input type="text" name="edad"><br>
        <br>
        Sexo: <select name="base">
            <option value="Error">Seleccionar-</option>
            <option value="Masculino">Masculino</option>
            <option value="Femenino">Femenino</option>
        </select> <br>
        <br>
        <input type="submit" value="Aceptar">
    </form>
    
    <?php
    include_once 'C:\xampp\htdocs\tecweb\practicas\p07\src\funciones.php';
        if (isset($_GET['base']) && isset($_GET['edad'])){
            $edad = $_GET['edad'];
            $sexo = $_GET['base'];

            $valor = identifypersona($edad,$sexo);
            
            if($valor == TRUE){
                $mensaje = "Bienvenida, usted está en el rango de edad permitido";
            }else if($valor == FALSE) 
            {
                $mensaje = "Usted no está en el rango";
            }

            echo '<?xml version="1.0" encoding="UTF-8"?>';
            echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
            echo '<html xmlns="http://www.w3.org/1999/xhtml">';
            echo '<head>';
            echo '<title>Resultado</title>';
            echo '</head>';
            echo '<body>';
            echo '<h1>' . htmlspecialchars($mensaje) . '</h1>';
            echo '</body>';
            echo '</html>'; 
        }
 
    ?>

    <h2>Ejemplo de POST</h2>
    <form action="http://localhost/tecweb/practicas/p07/index.php" method="post">
        Name: <input type="text" name="name"><br>
        E-mail: <input type="text" name="email"><br>
        <input type="submit">
    </form>
    <br>
    <?php
        if(isset($_POST["name"]) && isset($_POST["email"]))
        {
            echo $_POST["name"];
            echo '<br>';
            echo $_POST["email"];
        }
    ?>
</body>
</html>