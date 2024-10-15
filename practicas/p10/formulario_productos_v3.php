<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>Registro de productos</title>
    <style type="text/css">
        ol, ul { list-style-type: none; }
    </style>
</head>
<body>
    <h1>Registro de producto</h1>

    <form id="formularioProductos" action="http://localhost/tecweb/practicas/p10/update_producto.php" method="post">
    <fieldset>
        <legend>Información del Producto</legend>
        <ul>
        <input type="hidden" name="id" value="<?= htmlspecialchars($_GET['id']); ?>">
        <li>
                <label for="form-name">Nombre del producto:</label>
                <input id="form-name" type="text" name="nombre_producto" value="<?= isset($_GET['nombre']) ? htmlspecialchars($_GET['nombre']) : ''; ?>">
            </li>
            <li>
                <label for="form-marca">Marca:</label>
                <select name="marca_producto" id="form-marca" required>
                    <option value="">Selecciona una marca</option>
                    <option value="Paco Rabanne" <?= (isset($_GET['marca']) && $_GET['marca'] == 'Paco Rabanne') ? 'selected' : ''; ?>>Paco Rabanne</option>
                    <option value="Jean-Paul-G" <?= (isset($_GET['marca']) && $_GET['marca'] == 'Jean-Paul-G') ? 'selected' : ''; ?>>Jean Paul Gaultier</option>
                    <option value="Dior" <?= (isset($_GET['marca']) && $_GET['marca'] == 'Dior') ? 'selected' : ''; ?>>Dior</option>
                    <option value="Versace" <?= (isset($_GET['marca']) && $_GET['marca'] == 'Versace') ? 'selected' : ''; ?>>Versace</option>
                    <option value="Halloween" <?= (isset($_GET['marca']) && $_GET['marca'] == 'Halloween') ? 'selected' : ''; ?>>Halloween</option>
                    <option value="Carolina Herrrera" <?= (isset($_GET['marca']) && $_GET['marca'] == 'Carolina Herrrera') ? 'selected' : ''; ?>>Carolina Herrrera</option>
                </select>
            </li>
            <li>
                <label for="form-modelo">Modelo:</label>
                <input type="text" id="form-modelo" name="modelo" value="<?= isset($_GET['modelo']) ? htmlspecialchars($_GET['modelo']) : ''; ?>">
            </li>
            <li>
                <label for="form-precio">Precio:</label>
                <input type="number" id="form-precio" step="0.01" name="precio" value="<?= isset($_GET['precio']) ? htmlspecialchars($_GET['precio']) : ''; ?>">
            </li>
            <li>
                <label for="form-unid">Unidades:</label>
                <input type="number" id="form-unid" name="unidades" value="<?= isset($_GET['unidades']) ? htmlspecialchars($_GET['unidades']) : ''; ?>">
            </li>
            <li>
                <label for="form-detalle">Detalles:</label>
                <textarea id="form-detalle" name="detalles" maxlength="250"><?= isset($_GET['detalles']) ? htmlspecialchars($_GET['detalles']) : ''; ?></textarea>
            </li>
            <li>
                <label for="form-img">Imagen:</label>
                <input type="text" id="form-img" name="imagen" value="<?= isset($_GET['imagen']) ? htmlspecialchars($_GET['imagen']) : ''; ?>">
            </li>
        </ul>
        <p>
            <input type="submit" value="Actualizar Producto">
        </p>
    </fieldset>
    </form>

    <script type="text/javascript">
      // Capturamos el evento submit del formulario
      document.getElementById("formularioProductos").addEventListener("submit", function(event) {
        // Prevenir el envío del formulario si alguna validación falla
        if (!Verificar()) {
          event.preventDefault(); // Detiene el envío
        }
      });

      // Función que realiza todas las validaciones
      function Verificar() {
        var valid = true;

        // Verificar Nombre
        if (document.getElementById("form-name").value.length > 100) {
          alert("El nombre es demasiado largo, intentelo de nuevo");
          valid = false;
        }
        if (document.getElementById("form-name").value === "") {
          alert("El campo de nombre está vacio");
          valid = false;
        }

        // Verificar Marca
        if (document.getElementById("form-marca").value === "") {
          alert("Debe seleccionar una marca");
          valid = false;
        }

        // Verificar Modelo
        var alfanumerico = /^[a-zA-Z0-9]+$/;
        if (document.getElementById("form-modelo").value === "") {
          alert("El campo de modelo no debe estar vacio");
          valid = false;
        }
        if (!alfanumerico.test(document.getElementById("form-modelo").value)) {
          alert("El campo de modelo solo debe contener caracteres alfanuméricos.");
          valid = false;
        }
        if ((document.getElementById("form-modelo").value.length) >= 25) {
          alert("El campo de modelo solo debe contener 25 caracteres o menos");
          valid = false;
        }

        // Verificar Precio
        if (document.getElementById("form-precio").value === "") {
          alert("El campo de precio no debe estar vacio");
          valid = false;
        }
        if (parseFloat(document.getElementById("form-precio").value) < 99.99) {
          alert("El precio no debe ser mayor a 99.99");
          valid = false;
        }

        // Verificar Detalles
        if (document.getElementById("form-detalle").value.length > 250) {
          alert("El campo de detalles no debe contener más de 250 caracteres");
          valid = false;
        }

        // Verificar Unidades
        if (document.getElementById("form-unid").value < 0 || document.getElementById("form-unid").value === "") {
          alert("Debes introducir una cantidad válida de unidades");
          valid = false;
        }

        // Verificar Imagen (asignar valor por defecto si está vacío)
        if (document.getElementById("form-img").value === "") {
          document.getElementById("form-img").value = "img/imgfallo.jpeg";
        }

        return valid; // Retorna true si todas las validaciones pasan, de lo contrario false
      }
    </script>
  </body>

</body>
</html>