<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo 3</title>
</head>
<body>
    <?php
        use EJEMPLOSJS\POO\Cabecera2 as Cabecera;
        require_once __DIR__ . '/cabecera.php';

        $cab = new Cabecera('El rincon del programador', 'center', 'https://cs.buap.mx/');
        $cab->graficar();
    ?>
</body>
</html>