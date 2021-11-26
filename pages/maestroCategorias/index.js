window.onload = function () {
    init();
};
//Inicializa el contenido al cargar la página
function init() {
    $.ajax({
        type: 'POST', 
        url: '../../rest/categoriasRest.php', 
        dataType: 'json',
        data: {accion: "findAll"},
        success: function (data) {
            document.getElementById('tbodyAllCategorias').innerHTML = "";
            var tbodyAllAutores = document.getElementById('tbodyAllCategorias');
            for (var i = 0; i < data.length; i++) {
                var newtr = document.createElement("tr");
                var nombre = document.createElement("td");
                nombre.innerHTML = data[i].nombre;
                var desc = document.createElement("td");
                desc.innerHTML = data[i].descripcion;

                var acciones = document.createElement("td");
                acciones.className = "btn-toolbar";

                var deleteCategoria = document.createElement("button");
                deleteCategoria.className = "btn btn-danger mr-3 right";
                deleteCategoria.setAttribute("data-toggle", "modal");
                deleteCategoria.setAttribute("data-target", "#deleteLibro");

                var spanD = document.createElement("span");
                spanD.className = "material-icons inline-icon";
                spanD.innerHTML = "delete";

                var spanU = document.createElement("span");
                spanU.className = "material-icons inline-icon";
                spanU.innerHTML = "edit";

                deleteCategoria.setAttribute("onclick", "deleteOneById(" + data[i].id + ")");
                deleteCategoria.innerHTML = "";
                deleteCategoria.appendChild(spanD);
                acciones.appendChild(deleteCategoria);

                var updateCategoria = document.createElement("button");
                updateCategoria.className = "btn btn-warning mr-3 right";
                updateCategoria.setAttribute("data-toggle", "modal");
                updateCategoria.setAttribute("data-target", "#updateLibro");

                updateCategoria.setAttribute("onclick", "updateCategoriaOpen(" + data[i].id + ")");
                updateCategoria.innerHTML = "";
                updateCategoria.appendChild(spanU);
                acciones.appendChild(updateCategoria);

                newtr.appendChild(nombre);
                newtr.appendChild(desc);
                newtr.appendChild(acciones);
                tbodyAllAutores.appendChild(newtr);
            }
            $('#tableCategorias').DataTable();


        },
        error: function (data) {
            console.log(data);
        }
    });
}
//funcion para cargar los datos del modal de actualizacion de la categoria (id)
function updateCategoriaOpen(id) {
    $.ajax({
        type: 'POST', 
        url: '../../rest/categoriasRest.php',
        dataType: 'json',
        data: {accion: "findOneById", id: id},
        success: function (data) {
            //Meto los datos en el modal de actualizacion
            document.getElementById('updateCategoriaNombre').value = data.nombre;
            document.getElementById('updateCategoriaDescripcion').value = data.descripcion;
        },
        error: function (data) {
            console.log(data);
        }
    });
    //Cambio el onclick de update para que ejecute la funcion pasando el id de la categoria
    document.getElementById('updateCategoriaSubmit').setAttribute('onclick', 'updateOne(' + id + ')');
    //abro el modal
    $("#updateCategoria").modal("show");
}
//Funcion final para actualizar la categoria id
function updateOne(id) {
    //rescato los datos
    var nombre = document.getElementById('updateCategoriaNombre').value;
    var descripcion = document.getElementById('updateCategoriaDescripcion').value;
    //valido que todo esten completos pese al required
    if (nombre == "") {
        return
    }
    $.ajax({
        type: 'POST', 
        url: '../../rest/categoriasRest.php', 
        dataType: 'json',
        data: {accion: "updateOne", id: id, nombre: nombre, descripcion: descripcion}
        ,
        success: function (data) {
            console.log(data);
        },
        error: function (data) {
            console.log(data);
        }
    });

}
//Funcion para crear una categoria
function createOne() {
    //Rescato los datos
    var nombre = document.getElementById('newCategoriaNombre').value;
    var descripcion = document.getElementById('newCategoriaDescripcion').value;
    //Valido los datos
    if (nombre == "") {
        return
    }
    //Llamo al rest
    $.ajax({
        type: 'POST', 
        url: '../../rest/categoriasRest.php', 
        dataType: 'json',
        data: {accion: "createOne", nombre: nombre, descripcion: descripcion}
        ,
        success: function (data) {
            console.log(data);
        },
        error: function (data) {
            console.log(data);
        }
    });

}
//Funcion para borrar una cateoria (id)
function deleteOneById(id) {
    $.ajax({
        type: 'POST',
        url: '../../rest/categoriasRest.php', 
        dataType: 'json',
        data: {accion: "deleteOneById", id: id}
        ,
        success: function (data) {
            //Si va bien actualizo la tabla principal
            init()
        },
        error: function (data) {
            console.log(data);
        }
    });

}

