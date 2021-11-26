window.onload = function () {
    init();
};
//Inicializa el contenido al cargar la página
function init() {
    $.ajax({
        type: 'POST',
        url: '../../rest/librosRest.php',
        dataType: 'json',
        data: {accion: "findAll"},
        success: function (data) {
            //Rescato el body de la tabla genérica
            document.getElementById('tbodyAllLibros').innerHTML = "";
            var tbodyAllLibros = document.getElementById('tbodyAllLibros');
            //Recorro todos los libros para crear la fila en la tabla con los datos
            for (var i = 0; i < data.length; i++) {
                var newtr = document.createElement("tr");
                var titulo = document.createElement("td");
                titulo.innerHTML = data[i].titulo;
                var desc = document.createElement("td");
                desc.innerHTML = data[i].descripcion;
                var autor = document.createElement("td");
                autor.innerHTML = data[i].autor.nombre;
                var cat = document.createElement("td");
                if (data[i].categoria != null) {
                    for (var x = 0; x < data[i].categoria.length; x++) {
                        var categoria = data[i].categoria[x].nombre;
                        if (data[i].categoria.length > 0 && x < data[i].categoria.length - 1) {
                            categoria = data[i].categoria[x].nombre + ", ";
                        }
                        cat.innerHTML += categoria;
                    }
                } else {
                    cat.innerHTML = "null";
                }
                var acciones = document.createElement("td");
                acciones.className = "btn-toolbar";

                var spanD = document.createElement("span");
                spanD.className = "material-icons inline-icon";
                spanD.innerHTML = "delete";

                var spanU = document.createElement("span");
                spanU.className = "material-icons inline-icon";
                spanU.innerHTML = "edit";

                var deleteLibro = document.createElement("button");
                deleteLibro.className = "btn btn-danger mr-3";
                deleteLibro.setAttribute("data-toggle", "modal");
                deleteLibro.setAttribute("data-target", "#deleteLibro");

                deleteLibro.setAttribute("onclick", "deleteOneById(" + data[i].id + ")");
                deleteLibro.appendChild(spanD);
                acciones.appendChild(deleteLibro);

                var updateLibro = document.createElement("button");
                updateLibro.className = "btn btn-warning mr-3";
                updateLibro.setAttribute("data-toggle", "modal");
                updateLibro.setAttribute("data-target", "#updateLibro");

                updateLibro.setAttribute("onclick", "updateLibroOpen(" + data[i].id + ")");
                updateLibro.appendChild(spanU)
                acciones.appendChild(updateLibro);

                newtr.appendChild(titulo);
                newtr.appendChild(desc);
                newtr.appendChild(autor);
                newtr.appendChild(cat);
                newtr.appendChild(acciones);
                tbodyAllLibros.appendChild(newtr);
            }
            //Actualizo la paginación
            $('#tableLibros').DataTable();

        },
        error: function (data) {
            console.log(data);
        }
    });

}
//Actualiza los datos del modal con las categorias y los autores disponibles
function updateModalCreate() {

    $.ajax({
        type: 'POST', 
        url: '../../rest/autoresRest.php', 
        dataType: 'json',
        data: {accion: "findAll"},
        success: function (data) {
            //Rescato los datos y se los seteo a los campos del modal
            var newLibroAutor = document.getElementById('newLibroAutor');
            newLibroAutor.innerHTML = "";
            var first = document.createElement("option");
            first.innerHTML = "--Escoja uno--";
            first.value = "";
            newLibroAutor.appendChild(first);
            for (var i = 0; i < data.length; i++) {
                var newOption = document.createElement("option");
                newOption.value = data[i].id;
                newOption.innerHTML = data[i].nombre;
                newLibroAutor.appendChild(newOption);
            }

        },
        error: function (data) {
            console.log(data);
        }

    });
    //Llamo para traer las categorias al modal
    $.ajax({
        type: 'POST',
        url: '../../rest/categoriasRest.php',
        dataType: 'json',
        data: {accion: "findAll"}
        ,
        success: function (data) {
            var newLibroCategorias = document.getElementById('newLibroCategorias');
            newLibroCategorias.innerHTML = "";
            //recorro todas para crear los checkbox
            for (var i = 0; i < data.length; i++) {
                var div = document.createElement("div");
                div.className = "form-check";
                var input = document.createElement("input");
                input.type = "checkbox";
                input.className = "form-check-inpu";
                input.id = "cat_checkbox_" + data[i].id;
                input.setAttribute("idCategoria", data[i].id);
                var label = document.createElement("label");
                label.className = "form-check-label";
                label.for = "cat_checkbox_" + data[i].id;
                label.innerHTML = data[i].nombre;
                var br = document.createElement("br");


                div.appendChild(input);
                div.appendChild(label);
                newLibroCategorias.appendChild(div);
                newLibroCategorias.appendChild(br);
            }
        },
        error: function (data) {
            console.log(data);
        }
    });
}
//Funcion para crear un libro, rescato los datos del modal
function createOne() {
    //Reseteo los campos de validacion para quitar los errores antiguos
    document.getElementById('newLibroTituloP').innerHTML = "";
    document.getElementById('newLibroIsbnP').innerHTML = "";
    document.getElementById('newLibroDescripcionP').innerHTML = "";
    document.getElementById('newLibroAutorP').innerHTML = "";
    //rescato todos los datos necesarios
    var titulo = document.getElementById('newLibroTitulo').value;
    var isbn = document.getElementById('newLibroIsbn').value;
    var desc = document.getElementById('newLibroDescripcion').value;
    var autor = document.getElementById('newLibroAutor').value;
    var categorias = $('[id^="cat_checkbox_"]');
    var arrayCat = [];
    for (var i = 0; i < categorias.length; i++) {
        if (categorias[i].checked == true) {
            arrayCat.push(categorias[i].attributes.idCategoria.value);
        }
    }
    //valido el formulario
    if (titulo == "") {
        document.getElementById('newLibroTituloP').innerHTML = "Debes introducir un título";
        return;
    }
    if (isbn == "") {
        document.getElementById('newLibroIsbnP').innerHTML = "Debes introducir un ISBN";
        return;
    }
    if (desc == "") {
        document.getElementById('newLibroDescripcionP').innerHTML = "Debes poner al menos una descripción";
        return;
    }
    if (autor == "") {
        document.getElementById('newLibroAutorP').innerHTML = "Debes escoger al menos un autor";
        return;
    }
    if (arrayCat.length == 0) {
        document.getElementById('newLibroCategoriasP').innerHTML = "Debes escoger al menos una categoría";
        return;
    }
    //llamo al rest con los datos
    $.ajax({
        type: 'POST', 
        url: '../../rest/librosRest.php', 
        dataType: 'json',
        data: {accion: "createOne", titulo: titulo, descripcion: desc, autor: autor, categoria: arrayCat, isbn: isbn}
        ,
        success: function (data) {
            location.reload();
        },
        error: function (data) {
            console.log(data);
        }
    });
}

//Funcion que actualiza los datos del modal de actualizacion de libros metiendo los datos del libro seleccionado
function updateLibroOpen(id) {
    var libro = "";
    //Llamo al librosRest para encontrar los datos del libro (id)
    $.ajax({
        type: 'POST', 
        url: '../../rest/librosRest.php',
        dataType: 'json',
        data: {accion: "findOneById", id: id},
        success: function (data) {
            libro = data;
            $.ajax({
                type: 'POST',
                url: '../../rest/autoresRest.php',
                dataType: 'json',
                data: {accion: "findAll"},
                success: function (data) {
                    //Meto los datos en los campos del modal
                    var updateLibroAutor = document.getElementById('updateLibroAutor');
                    updateLibroAutor.innerHTML = "";
                    var first = document.createElement("option");
                    first.innerHTML = "--Escoja uno--";
                    first.value = "";
                    updateLibroAutor.appendChild(first);
                    for (var i = 0; i < data.length; i++) {
                        var updateOption = document.createElement("option");
                        updateOption.value = data[i].id;
                        updateOption.innerHTML = data[i].nombre;
                        if (libro.autor.id == data[i].id) {
                            updateOption.selected = true;
                        }
                        updateLibroAutor.appendChild(updateOption);
                    }

                },
                error: function (data) {
                    console.log(data);
                }

            });
            //Me traigo todas las categorias
            $.ajax({
                type: 'POST', 
                url: '../../rest/categoriasRest.php', 
                dataType: 'json',
                data: {accion: "findAll"}
                ,
                success: function (data) {
                    var updateLibroCategorias = document.getElementById('updateLibroCategorias');
                    updateLibroCategorias.innerHTML = "";
                    //Las recorro para mirar el array que tiene el libro y poner a checked las que ya tenía en BBDD
                    for (var i = 0; i < data.length; i++) {
                        var div = document.createElement("div");
                        div.className = "form-check";
                        var input = document.createElement("input");
                        input.type = "checkbox";
                        input.className = "form-check-inpu";
                        if (libro.categoria != null) {
                            for (var t = 0; t < libro.categoria.length; t++) {
                                if (libro.categoria[t].id == data[i].id) {
                                    input.checked = true;
                                    break;
                                }
                            }
                        }
                        input.id = "update_cat_checkbox_" + data[i].id;
                        input.setAttribute("updateIdCategoria", data[i].id);
                        var label = document.createElement("label");
                        label.className = "form-check-label";
                        label.for = "cat_checkbox_" + data[i].id;
                        label.innerHTML = data[i].nombre;
                        var br = document.createElement("br");


                        div.appendChild(input);
                        div.appendChild(label);
                        updateLibroCategorias.appendChild(div);
                        updateLibroCategorias.appendChild(br);
                    }
                },
                error: function (data) {
                    console.log(data);
                }
            });
            //Meto los datos en los campos del modal
            document.getElementById('updateLibroTitulo').value = libro.titulo;
            document.getElementById('updateLibroIsbn').value = libro.isbn;
            document.getElementById('updateLibroDescripcion').value = libro.descripcion
            document.getElementById('updateLibroSubmit').setAttribute('onclick', 'updateOne(' + id + ')');
        },
        error: function (data) {
            console.log(data);
        }
    });
    //Muestro el modal con todos los datos
    $("#updateLibro").modal("show");
}
//Funcion para actualizar el libro
function updateOne(id) {
    //Reseteo los campos de validacion para eliminar errores anteriores
    document.getElementById('updateLibroTituloP').innerHTML = "";
    document.getElementById('updateLibroIsbnP').innerHTML = "";
    document.getElementById('updateLibroDescripcionP').innerHTML = "";
    document.getElementById('updateLibroAutorP').innerHTML = "";
    //Rescato los datos
    var titulo = document.getElementById('updateLibroTitulo').value;
    var isbn = document.getElementById('updateLibroIsbn').value;
    var desc = document.getElementById('updateLibroDescripcion').value;
    var autor = document.getElementById('updateLibroAutor').value;
    var categorias = $('[id^="update_cat_checkbox_"]');
    var arrayCat = [];
    for (var i = 0; i < categorias.length; i++) {
        if (categorias[i].checked == true) {
            arrayCat.push(categorias[i].attributes.updateIdCategoria.value);
        }
    }
    //Valido el formulario
    if (titulo == "") {
        document.getElementById('updateLibroTituloP').innerHTML = "Debes introducir un título";
        return;
    }
    if (isbn == "") {
        document.getElementById('updateLibroIsbnP').innerHTML = "Debes introducir un ISBN";
        return;
    }
    if (desc == "") {
        document.getElementById('updateLibroDescripcionP').innerHTML = "Debes poner al menos una descripción";
        return;
    }
    if (autor == "") {
        document.getElementById('updateLibroAutorP').innerHTML = "Debes escoger al menos un autor";
        return;
    }
    if (arrayCat.length == 0) {
        document.getElementById('updateLibroCategoriasP').innerHTML = "Debes escoger al menos una categoría";
        return;
    }
    //LLamo al rest para actualizar el libro
    $.ajax({
        type: 'POST', 
        url: '../../rest/librosRest.php',
        dataType: 'json',
        data: {accion: "updateOne", id: id, titulo: titulo, descripcion: desc, autor: autor, categoria: arrayCat, isbn: isbn}
        ,
        success: function (data) {
            location.reload();
        },
        error: function (data) {
            console.log(data);
        }
    });

}
//Funcion para borrar el libro (id)
function deleteOneById(id) {
    $.ajax({
        type: 'POST', 
        url: '../../rest/librosRest.php', 
        dataType: 'json',
        data: {accion: "deleteOneById", id: id}
        ,
        success: function (data) {
            //Si todo ha ido bien, recargo los datos.
            init();
        },
        error: function (data) {
            console.log(data);
        }
    });

}




