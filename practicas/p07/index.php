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