<?php
$vehiculos = array(
    'ABC1234' => array(
        "Marca" => "Volkswagen",
        "Modelo" => 2019,
        "Tipo" => "Jetta"
    ),
    "Propietario" => array(
        "Nombre" => "Ana Saucedo",
        "Ciudad" => "Puebla",
        "Dirección" => "Calle Universidad 20"
    ),
    'XYZ5678' => array(
        "Auto" => array(
            "Marca" => "Kia",
            "Modelo" => 2024,
            "Tipo" => "Rio"
        ),
        "Propietario" => array(
            "Nombre" => "Samuel Flores",
            "Ciudad" => "Puebla",
            "Dirección" => "Calle Torres 52"
        )
    ),
    'DEF4321' => array(
        "Auto" => array(
            "Marca" => "Dodge",
            "Modelo" => 2023,
            "Tipo" => "Attitude"
        ),
        "Propietario" => array(
            "Nombre" => "Isabel Rivera",
            "Ciudad" => "Tlaxcala",
            "Dirección" => "Calle Del Trabajo 22"
        )
    ),
    'GHI8765' => array(
        "Auto" => array(
            "Marca" => "Jeep",
            "Modelo" => 2008,
            "Tipo" => "Patriot"
        ),
        "Propietario" => array(
            "Nombre" => "Jesús Lopez",
            "Ciudad" => "Monterrey",
            "Dirección" => "Blvd. Hermanos Serdán"
        )
    ),
    'JKL0987' => array(
        "Auto" => array(
            "Marca" => "Ford",
            "Modelo" => 2015,
            "Tipo" => "Focus"
        ),
        "Propietario" => array(
            "Nombre" => "Miguel Rojas",
            "Ciudad" => "Puebla",
            "Dirección" => "Calle Josefa Ortiz 324"
        )
    ),
    'MNO6543' => array(
        "Auto" => array(
            "Marca" => "Volkswagen",
            "Modelo" => 2019,
            "Tipo" => "Tiguan"
        ),
        "Propietario" => array(
            "Nombre" => "Gabriela Martínez",
            "Ciudad" => "Puebla",
            "Dirección" => "Calle Violetas 12"
        )
    ),
    'PQR8765' => array(
        "Auto" => array(
            "Marca" => "Volkswagen",
            "Modelo" => 2019,
            "Tipo" => "GOLF GTI"
        ),
        "Propietario" => array(
            "Nombre" => "Maximiliano García",
            "Ciudad" => "Puebla",
            "Dirección" => "Cerrada Ardillas 2"
        )
    ),
    'STU3210' => array(
        "Auto" => array(
            "Marca" => "Jeep",
            "Modelo" => 2020,
            "Tipo" => "Liberty"
        ),
        "Propietario" => array(
            "Nombre" => "Maximino Tenorio",
            "Ciudad" => "Puebla",
            "Dirección" => "Calle Del Valle 12"
        )
    ),
    'VWX9876' => array(
        "Auto" => array(
            "Marca" => "Honda",
            "Modelo" => 2020,
            "Tipo" => "Civic"
        ),
        "Propietario" => array(
            "Nombre" => "Jaime Rivera",
            "Ciudad" => "Tlaxcala",
            "Dirección" => "Calle Cuauhtemoc 10"
        )
    ),
    'YZA5432' => array(
        "Auto" => array(
            "Marca" => "Volkswagen",
            "Modelo" => 2018,
            "Tipo" => "Vento"
        ),
        "Propietario" => array(
            "Nombre" => "Mónica Rivera",
            "Ciudad" => "Puebla",
            "Dirección" => "Calle Lázaro Cárdenas 10"
        )
    ),
    'BCD1234' => array(
        "Auto" => array(
            "Marca" => "Volkswagen",
            "Modelo" => 2019,
            "Tipo" => "Virtus"
        ),
        "Propietario" => array(
            "Nombre" => "Iván Flores",
            "Ciudad" => "Puebla",
            "Dirección" => "Calle Bugambilias 34"
        )
    ),
    'EFG5678' => array(
        "Auto" => array(
            "Marca" => "Honda",
            "Modelo" => 2020,
            "Tipo" => "CRV"
        ),
        "Propietario" => array(
            "Nombre" => "Danae Valle",
            "Ciudad" => "Puebla",
            "Dirección" => "Av. Defensores 11"
        )
    ),
    'HIJ9012' => array(
        "Auto" => array(
            "Marca" => "Toyota",
            "Modelo" => 2014,
            "Tipo" => "Sedan"
        ),
        "Propietario" => array(
            "Nombre" => "Andrea Pérez",
            "Ciudad" => "Tlaxcala",
            "Dirección" => "Av. Insurgentes 524"
        )
    ),
    'KLM3456' => array(
        "Auto" => array(
            "Marca" => "Audi",
            "Modelo" => 2014,
            "Tipo" => "A8"
        ),
        "Propietario" => array(
            "Nombre" => "Roberto Hernández",
            "Ciudad" => "Puebla",
            "Dirección" => "Av. Matemáticas 524"
        )
    ),
    'NOP7890' => array(
        "Auto" => array(
            "Marca" => "Ford",
            "Modelo" => 2014,
            "Tipo" => "Silverado"
        ),
        "Propietario" => array(
            "Nombre" => "Eduardo García",
            "Ciudad" => "Culiacán",
            "Dirección" => "Calle Vieyra 20"
        )
    )
);

function Matricula($matricula) {
    global $vehiculos;
    if (isset($vehiculos[$matricula])) {
        echo '<h2>Información del auto con matrícula ' . $matricula . ':</h2>';
        print_r($vehiculos[$matricula]);
    } else {
        echo '<h2>No se encontró un vehículo con la matrícula ' . $matricula . '.</h2>';
    }
}

function Carros() {
    global $vehiculos;
    echo '<h2>Vehículos Registrados en la concesionaria</h2>';
    print_r($vehiculos);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parque Vehicular</title>
</head>

<body>

    <h1>Parque Vehicular</h1>

    <form action= "coches.php" method="post">
        <label for="matricula">Consulta de auto por Matrícula:</label>
        <input type="text" id="matricula" name="matricula" required>
        <button type="submit" name="consulta" value="matricula">Consultar</button>
    </form>

    <form method="post" action="">
        <button type="submit" name="consulta" value="todos">Mostrar autos registrados</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $consulta = $_POST['consulta'];

        if ($consulta === 'matricula') {
            $matricula = strtoupper($_POST['matricula']);
            Matricula($matricula);
        } elseif ($consulta === 'todos') {
            Carros();
        }
    }
    ?>

</body>

