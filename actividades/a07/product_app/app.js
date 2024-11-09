/*
// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
  precio: 0.0,
  unidades: 1,
  modelo: "XX-000",
  marca: "NA",
  detalles: "NA",
  imagen: "img/default.png",
};
*/

function init() {
  /**
   * Convierte el JSON a string para poder mostrarlo
   * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
   
  var JsonString = JSON.stringify(baseJSON, null, 2);
  document.getElementById("description").value = JsonString;
  */
}

$(document).ready(function () {
  let edit = false;

  console.log("jQuery is working");
  ListaProductos();
  //Función para buscar productos
  $("#search").keyup(function (e) {
    let search = $("#search").val();
    $.ajax({
      url: 'backend/product-search.php',
      type: 'POST',
      data: { search },
      success: function (response) {
        console.log(response);
        let productos = JSON.parse(response);
        let template = "";

        productos.forEach((producto) => {
          template += `<li>
                        ${producto.nombre}
                    </li>`;
        });

        if (productos.length > 0) {
          $("#product-result").removeClass("d-none");
        }

        $("#container").html(template);
      },
    });
  });

  /*
  //Envio de productos
  $("#product-form").submit(function (e) {
    e.preventDefault();
    let errores = [];
    let id = $("#productId").val();
    let nombre = $("#name").val();
    let productData = JSON.parse($("#description").val());

    let marca = productData.marca;
    let modelo = productData.modelo;
    let precio = productData.precio;
    let detalles = productData.detalles;
    let unidades = productData.unidades;
    let imagen = productData.imagen;

    // Validar nombre
    if (nombre.length === 0 || nombre.length > 100) {
      errores.push(
        "El nombre del producto es obligatorio y debe tener 100 caracteres o menos."
      );
    }

    // Validar precio
    if (isNaN(precio) || precio <= 99.99) {
      errores.push(
        "Obligatoriamente debe asignar un precio y este debe ser mayor a 99.99"
      );
    }

    // Validar unidades
    if (isNaN(unidades) || unidades < 0) {
      errores.push(
        "Obligatoriamente debe asignar la cantidad de unidades y deben ser un número entero positivo."
      );
    }

    // Validar modelo
    let modelPattern = /^[a-zA-Z0-9]+$/;
    if (modelo === "" || !modelPattern.test(modelo) || modelo > 25) {
      errores.push(
        "Obligatoriamente debe asignar el modelo del producto, debe ser alfanumérico y tener 25 caracteres o menos."
      );
    }

    // Validar marca
    if (marca === "") {
      errores.push("Obligatoriamente debe asignar la marca del producto");
    }

    // Validar detalles
    if (detalles.length > 250) {
      errores.push("Los detalles no pueden tener más de 250 caracteres.");
    }

    // Validar imagen
    if (imagen === "") {
      imagen = "img/imgfallo.jpeg";
    }

    // Errores
    if (errores.length > 0) {
      alert(
        "No se realizó la inserción del producto debido a:\n" +
          errores.join("\n")
      );
      return;
    }

    const finalProductData = {
      id: id,
      nombre: nombre,
      marca: marca,
      modelo: modelo,
      precio: precio,
      detalles: detalles,
      unidades: unidades,
      imagen: imagen,
    };

    let url_1 =
      edit === false ? "backend/product-add.php" : "backend/product-edit.php";

    $.ajax({
      url: url_1,
      type: "POST",
      ContentType: "application/json",
      data: JSON.stringify(finalProductData),
      success: function (response) {
        ListaProductos();
        let message = JSON.parse(response);
        let template = "";
        template = `<p>
                    ${message.message}
                </p>`;
        // Mostrar el contenedor si hay productos
        if (message.message.length > 0) {
          $("#product-result").removeClass("d-none");
        }

        $("#container").html(template);
      },
      error: function (err) {
        console.error("Error al agregar producto:", err);
      },
    });
  });
  */

  //Envio de productos NUEVO P12 COMPLEMENTO
  $(document).ready(function(){
    let imgdef = "img/imgfallo.jpeg"

    //mensaje de error en cada campo
    function errorValidation(campo, mensaje){
      $(campo).next('.error-message').remove();
      $(campo).next('.correct-message').remove(); // Elimina el mensaje de correcto si existía
      $(campo).after(`<span class="error-message" style="color: red;">${mensaje}</span>`);
    }

    function successValidation(campo, mensaje){
      $(campo).next('.error-message').remove(); // Elimina el mensaje de error si existía
      $(campo).next('.correct-message').remove(); // Evita duplicados del mensaje de correcto
      $(campo).after(`<span class="correct-message" style="color: #33FF00;">${mensaje}</span>`);
    }

    function warningValidation(campo, mensaje){
      $(campo).next('.error-message').remove();
      $(campo).after(`<span class="error-message" style="color: yellow;">${mensaje}</span>`)
    }

    function clean(campo){
      $(campo).next('.error-message').remove();
      $(campo).next('.correct-message').remove();
    }

    function validarCampo(campo){
      let valido = true;
      let valor = $(campo).val();
      clean(campo);

      switch (campo.id) {
        case 'name':
          if (valor.length === 0) {
            errorValidation(campo, 'El nombre del producto es obligatorio');
            valido = false;
          } else if (valor.length > 100) {
            errorValidation(campo, 'El nombre del producto debe tener 100 caracteres o menos');
            valido = false;
          } else {
            successValidation(campo, 'Nombre correcto');
          }
          break;
        case 'marcajs':
          if (valor === '') {
            errorValidation(campo, 'El campo de marca es obligatorio');
            valido = false;
          } else {
            successValidation(campo, 'Marca correcta');
          }
          break;
        case 'modelojs':
          let patron = /^[a-zA-Z0-9]+$/;
          if (valor === '') {
            errorValidation(campo, 'El campo de modelo es obligatorio');
            valido = false;
          } else if (!patron.test(valor)) {
            errorValidation(campo, 'El modelo debe contener caracteres alfanuméricos');
            valido = false;
          } else if (valor.length > 25) {
            errorValidation(campo, 'El modelo debe tener 25 caracteres o menos');
            valido = false;
          } else {
            successValidation(campo, 'Modelo correcto');
          }
          break;
        case 'preciojs':
          if (isNaN(valor)) {
            errorValidation(campo, 'El precio debe ser numérico');
            valido = false;
          } else if (valor <= 99.99) {
            errorValidation(campo, 'El campo de precio es obligatorio y este debe ser mayor a 99.99');
            valido = false;
          } else{
            successValidation(campo, 'Precio correto');
          }
          break;
        case 'unidadjs':
          if (isNaN(valor)) {
            errorValidation(campo, 'La cantidad de unidades deben ser numéricas');
            valido = false;
          } else if (valor <= 1) {
            errorValidation(campo, 'La campop de unidades es obligatorio y este debe ser mayor a 1');
            valido = false;
          } else{
            successValidation(campo, 'Unidades correctas');
          }
          break;
        case 'detallesjs':
          if (valor.length > 250) {
            errorValidation(campo, 'Los detalles del producto no pueden contener más de 250 caracteres');
            valido = false;
          } else if(valor === '') {
            warningValidation(campo, 'Está enviando un producto sin detalles');
          } else{
            successValidation(campo, 'Detalles correctos');
          }
          break;
        case 'imagenjs':
          if (valor === '') {
            warningValidation(campo, 'Si el campo de imagen se deja vacío se colocará una imagen predeterminada');
          } else {
            successValidation(campo, 'Imagen correcta');
          }
          break;
      }
      return valido;
    }

    // Validación en tiempo real 
    $('#product-form input, #product-form textarea').on('input blur', function() {
      validarCampo(this);
    });

    // Validación final y envío del formulario
    $('#product-form').submit(function(e) {
      e.preventDefault();
      let valido = true;

      // Validar cada campo al enviar el formulario
      $('#product-form input, #product-form textarea').each(function() {
          if (!validarCampo(this)) {
              valido = false;
          }
      });
      
      // Detener el envío si hay errores
      if (!valido) return;

      // Crear el objeto de datos finales
      const finalProductData = {
          id: $('#productId').val(),
          nombre: $('#name').val(),
          marca: $('#marcajs').val(),
          modelo: $('#modelojs').val(),
          precio: $('#preciojs').val(),
          detalles: $('#detallesjs').val(),
          unidades: $('#unidadjs').val(),
          imagen: $('#imagenjs').val() || imgdef
      };

      let url_unic = edit === false ? 'backend/product-add.php' : 'backend/product-edit.php';
  
      // Enviar los datos vía AJAX
      $.ajax({
          url: url_unic,
          type: 'POST',
          ContentType: 'application/json',
          data: JSON.stringify(finalProductData),
          success: function(response) {
            console.log(response);
              ListaProductos();
              let message = JSON.parse(response);
              let template = '';
              template = `<p>${message.message}</p>`;
              
              if (message.message.length > 0) {
                  $('#product-result').removeClass('d-none');
              }
              $('#container').html(template);
          },
          error: function(err) {
              console.error('Error al agregar producto:', err);
          }
      });
  });

  })


  //Borrado
  $(document).on("click", ".product-delete", function () {
    if (confirm("¿Estas seguro de querer eliminar el producto?")) {
      let element = $(this)[0].parentElement.parentElement;
      let id = $(element).attr("productId");
      $.post("backend/product-delete.php", { id }, function (response) {
        ListaProductos();
        let message = JSON.parse(response);
        let template = "";
        template = `<p>
                    ${message.message}
                </p>`;

        if (message.message.length > 0) {
          $("#product-result").removeClass("d-none");
        }

        $("#container").html(template);
      });
    }
  });


  function ListaProductos() {
  $.ajax({
    url: "backend/product-list.php",
    type: "GET",
    success: function (response) {
      let products = JSON.parse(response);
      let template = "";
      products.forEach((product) => {
        template += `
                    <tr productId="${product.id}">
                        <td>${product.id}</td>
                        <td>
                            <a href="#" class="product-item" 
                               data-id="${product.id}" 
                               data-nombre="${product.nombre}" 
                               data-precio="${product.precio}" 
                               data-unidades="${product.unidades}" 
                               data-modelo="${product.modelo}" 
                               data-marca="${product.marca}" 
                               data-detalles="${product.detalles}" 
                               data-imagen="${product.imagen}">
                                ${product.nombre}
                            </a>
                        </td>
                        <td>${product.detalles}</td>
                        <td>
                              <button class="product-delete btn btn-danger">
                                  Eliminar
                              </button>  
                        </td>
                    </tr>
                    
                `;
      });
      $("#products").html(template);

      // Agregar evento al hacer clic en un producto
      $(".product-item").on("click", function (e) {
        e.preventDefault(); // Evitar la acción por defecto del enlace
        
        // Obtener los datos del producto
        const id = $(this).data("id");
        const nombre = $(this).data("nombre");
        const precio = $(this).data("precio");
        const unidades = $(this).data("unidades");
        const modelo = $(this).data("modelo");
        const marca = $(this).data("marca");
        const detalles = $(this).data("detalles");
        const imagen = $(this).data("imagen");

        // Llenar el formulario de edición con los datos del producto
        $("#productId").val(id);
        $("#name").val(nombre);
        $("#preciojs").val(precio);
        $("#unidadjs").val(unidades);
        $("#modelojs").val(modelo);
        $("#marcajs").val(marca);
        $("#detallesjs").val(detalles);
        $("#imagenjs").val(imagen);
        
        // Cambiar el texto del botón
        $("#botonagregar").text("Actualizar Producto");
      });
    },
  });
}


  //Editar producto
  $(document).on("click", ".product-item", function () {
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr("productId");
    $.post("backend/product-single.php", { id }, function (response) {
      const product = JSON.parse(response);
      $("#name").val(product.nombre);
      var updatedJSON = {
        precio: Number(product.precio),
        unidades: Number(product.unidades),
        modelo: product.modelo,
        marca: product.marca,
        detalles: product.detalles || baseJSON.detalles,
        imagen: product.imagen || baseJSON.imagen,
      };
      
      $("#description").val(JSON.stringify(updatedJSON, null, 2));
      $("#productId").val(product.id);
      edit = true;
    });
  });
  
});

