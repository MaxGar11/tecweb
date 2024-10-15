// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
  };

// FUNCIÓN CALLBACK DE BOTÓN "Buscar"
function buscarID(e) {
    /**
     * Revisar la siguiente información para entender porqué usar event.preventDefault();
     * http://qbit.com.mx/blog/2013/01/07/la-diferencia-entre-return-false-preventdefault-y-stoppropagation-en-jquery/#:~:text=PreventDefault()%20se%20utiliza%20para,escuche%20a%20trav%C3%A9s%20del%20DOM
     * https://www.geeksforgeeks.org/when-to-use-preventdefault-vs-return-false-in-javascript/
     */
    e.preventDefault();

    // SE OBTIENE EL ID A BUSCAR
    var id = document.getElementById('search').value;

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    client.open('POST', './backend/read.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    client.onreadystatechange = function () {
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            console.log('[CLIENTE]\n'+client.responseText);
            
            // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
            let productos = JSON.parse(client.responseText);    // similar a eval('('+client.responseText+')');
            
            // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
            if(Object.keys(productos).length > 0) {
                // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                let descripcion = '';
                    descripcion += '<li>precio: '+productos.precio+'</li>';
                    descripcion += '<li>unidades: '+productos.unidades+'</li>';
                    descripcion += '<li>modelo: '+productos.modelo+'</li>';
                    descripcion += '<li>marca: '+productos.marca+'</li>';
                    descripcion += '<li>detalles: '+productos.detalles+'</li>';
                
                // SE CREA UNA PLANTILLA PARA CREAR LA(S) FILA(S) A INSERTAR EN EL DOCUMENTO HTML
                let template = '';
                    template += `
                        <tr>
                            <td>${productos.id}</td>
                            <td>${productos.nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                        </tr>
                    `;

                // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                document.getElementById("productos").innerHTML = template;
            }
        }
    };
    client.send("id="+id);
}

// FUNCIÓN CALLBACK DE BOTÓN "Agregar Producto"
function agregarProducto(e) {
    e.preventDefault();

    // SE OBTIENE DESDE EL FORMULARIO EL JSON A ENVIAR
    var productoJsonString = document.getElementById('description').value;
    // SE CONVIERTE EL JSON DE STRING A OBJETO
    var finalJSON = JSON.parse(productoJsonString);
    try {
        // SE CONVIERTE EL JSON DE STRING A OBJETO
        var finalJSON = JSON.parse(productoJsonString);

        var errores = [];

        finalJSON.precio = parseFloat(finalJSON.precio);
        finalJSON.unidades = parseInt(finalJSON.unidades, 10);

        // Validar nombre 
        finalJSON['nombre'] = document.getElementById('name').value;
        if (!finalJSON['nombre'] || finalJSON['nombre'].trim() === '' || finalJSON['nombre'].length > 100) {
            errores.push('El nombre del producto es obligatorio y debe tener 100 caracteres o menos.');
        }

        // Validar precio
        if (isNaN(finalJSON.precio) || finalJSON.precio <= 99.99) {
            errores.push('Obligatoriamente debe asignar un precio y este debe ser mayor a 99.99');
        }

        // Validar unidades
        if (isNaN(finalJSON.unidades) || finalJSON.unidades < 0) {
            errores.push('Obligatoriamente debe asignar la cantidad de unidades y deben ser un número entero positivo.');
        }

        // Validar modelo
        let modelPattern = /^[a-zA-Z0-9]+$/;
        if (!finalJSON.modelo || finalJSON.modelo.trim() === '' || !modelPattern.test(finalJSON.modelo) || finalJSON.modelo >25) {
            errores.push('Obligatoriamente debe asignar el modelo del producto, debe ser alfanumérico y tener 25 caracteres o menos.');
        }

        // Validar marca
        if (!finalJSON.marca || finalJSON.marca.trim() === '') {
            errores.push('Obligatoriamente debe asignar la marca del producto');
        }

        // Validar detalles
        if (finalJSON.detalles && finalJSON.detalles.length > 250) {
            errores.push('Los detalles no pueden tener más de 250 caracteres.');
        }

        // Validar imagen 
        let defaultImagen = "img/imgfallo.jpeg"; 
        if (!finalJSON.imagen || finalJSON.imagen.trim() === '') {
            finalJSON.imagen = defaultImagen;
        }

        // Ventana con la existencia de errores
        if (errores.length > 0) {
            alert('No se realizó la inserción del producto debido a:\n' + errores.join('\n'));
            return; // Detener la ejecución de la función
        }  
        // SE OBTIENE EL STRING DEL JSON FINAL
        productoJsonString = JSON.stringify(finalJSON, null, 2);

        // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
        var client = getXMLHttpRequest();
        client.open('POST', './backend/create.php', true);
        client.setRequestHeader('Content-Type', "application/json;charset=UTF-8");
        client.onreadystatechange = function () {
            // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
            if (client.readyState == 4 && client.status == 200) {
                console.log(client.responseText);
                alert(client.responseText);
            }
        };
        client.send(productoJsonString);
    } catch (e) {
        // Manejar errores de parseo de JSON
        alert('Error al procesar el JSON: ' + e.message);
    }
}

// SE CREA EL OBJETO DE CONEXIÓN COMPATIBLE CON EL NAVEGADOR
function getXMLHttpRequest() {
    var objetoAjax;

    try{
        objetoAjax = new XMLHttpRequest();
    }catch(err1){
        /**
         * NOTA: Las siguientes formas de crear el objeto ya son obsoletas
         *       pero se comparten por motivos historico-académicos.
         */
        try{
            // IE7 y IE8
            objetoAjax = new ActiveXObject("Msxml2.XMLHTTP");
        }catch(err2){
            try{
                // IE5 y IE6
                objetoAjax = new ActiveXObject("Microsoft.XMLHTTP");
            }catch(err3){
                objetoAjax = false;
            }
        }
    }
    return objetoAjax;
}

function buscarProducto(e) {
    /**
     * Revisar la siguiente información para entender porqué usar event.preventDefault();
     * http://qbit.com.mx/blog/2013/01/07/la-diferencia-entre-return-false-preventdefault-y-stoppropagation-en-jquery/#:~:text=PreventDefault()%20se%20utiliza%20para,escuche%20a%20trav%C3%A9s%20del%20DOM
     * https://www.geeksforgeeks.org/when-to-use-preventdefault-vs-return-false-in-javascript/
     */
    e.preventDefault();

    // SE OBTIENE LA MARCA A BUSCAR
    var marca = document.getElementById('searchmarca').value;

    console.log("Marca: " + marca);

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    client.open('POST', './backend/read.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    client.onreadystatechange = function () {
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            console.log('[CLIENTE]\n'+client.responseText);
            
            // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
            let productos = JSON.parse(client.responseText);    // similar a eval('('+client.responseText+')');
            
            if (Array.isArray(productos) && productos.length > 0) {
                // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                let template = '';
                productos.forEach(producto => {
                    let descripcion = '';
                    descripcion += `<li>precio: ${producto.precio}</li>`;
                    descripcion += `<li>unidades: ${producto.unidades}</li>`;
                    descripcion += `<li>modelo: ${producto.modelo}</li>`;
                    descripcion += `<li>marca: ${producto.marca}</li>`;
                    descripcion += `<li>detalles: ${producto.detalles}</li>`;
                    
                    // SE CREA UNA PLANTILLA PARA CREAR LA FILA A INSERTAR EN EL DOCUMENTO HTML
                    template += `
                        <tr>
                            <td>${producto.id}</td>
                            <td>${producto.nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                        </tr>
                    `;
                });

                // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON marca "productos"
                document.getElementById("productos").innerHTML = template;
            }
        }
        
    };
    client.send("marca=" + marca);
}

function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;
}