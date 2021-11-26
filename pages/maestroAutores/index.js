window.onload = function () {
    init();
};
//Inicializa el contenido al cargar la página
function init() {
    $.ajax({
        type: 'POST',
        url: '../../rest/autoresRest.php',
        dataType: 'json',
        data: {accion: "findAll"},
        success: function (data) {
            //Rescato el body de la tabla genérica y la limpio
            document.getElementById('tbodyAllAutores').innerHTML = "";
            var tbodyAllAutores = document.getElementById('tbodyAllAutores');
            //Recorro el resultado y relleno la tabla
            for (var i = 0; i < data.length; i++) {
                var newtr = document.createElement("tr");
                var nombre = document.createElement("td");
                nombre.innerHTML = data[i].nombre;
                var pseudonimo = document.createElement("td");
                if (data[i].pseudonimo != "") {
                    pseudonimo.innerHTML = data[i].pseudonimo;
                } else {
                    pseudonimo.innerHTML = "-Ninguno-";

                }
                var nacimiento = document.createElement("td");
                nacimiento.innerHTML = data[i].fecha_nacimiento;
                var muerte = document.createElement("td");
                muerte.innerHTML = data[i].fecha_muerte;


                var acciones = document.createElement("td");
                acciones.className = "btn-toolbar";

                var deleteAutor = document.createElement("button");
                deleteAutor.className = "btn btn-danger mr-3";
                deleteAutor.setAttribute("data-toggle", "modal");
                deleteAutor.setAttribute("data-target", "#deleteLibro");

                var spanD = document.createElement("span");
                spanD.className = "material-icons inline-icon";
                spanD.innerHTML = "delete";

                deleteAutor.setAttribute("onclick", "deleteOneById(" + data[i].id + ")");
                deleteAutor.innerHTML = "";
                deleteAutor.appendChild(spanD);
                acciones.appendChild(deleteAutor);

                var updateAutor = document.createElement("button");
                updateAutor.className = "btn btn-warning mr-3";
                updateAutor.setAttribute("data-toggle", "modal");
                updateAutor.setAttribute("data-target", "#updateLibro");

                var spanU = document.createElement("span");
                spanU.className = "material-icons inline-icon";
                spanU.innerHTML = "edit";

                updateAutor.setAttribute("onclick", "updateAutorOpen(" + data[i].id + ")");
                updateAutor.innerHTML = "";
                updateAutor.appendChild(spanU);
                acciones.appendChild(updateAutor);

                newtr.appendChild(nombre);
                newtr.appendChild(pseudonimo);
                newtr.appendChild(nacimiento);
                newtr.appendChild(muerte);
                newtr.appendChild(acciones);
                tbodyAllAutores.appendChild(newtr);
            }
            //Actualizo paginacion
            $('#tableAutores').DataTable();

        },
        error: function (data) {
            console.log(data);
        }
    });
}
//Funcion para actualizar el modal de update Autores pasando el id del referenciado
function updateAutorOpen(id) {
    //LLamo al rest para obtener la información
    $.ajax({
        type: 'POST', //aqui puede ser igual get
        url: '../../rest/autoresRest.php', //aqui va tu direccion donde esta tu funcion php
        dataType: 'json',
        data: {accion: "findOneById", id: id},
        success: function (data) {
            //Pongo la información en el modal
            document.getElementById('updateAutorNombre').value = data.nombre;
            document.getElementById('updateAutorPseudonimo').value = data.pseudonimo;
            document.getElementById('updateAutorNacimiento').value = data.fecha_nacimiento;
            document.getElementById('updateAutorMuerte').value = data.fecha_muerte;
        },
        error: function (data) {
            console.log(data);
        }
    });
    //Actualizo la función del onclick añadiendo el id
    document.getElementById('updateAutorSubmit').setAttribute('onclick', 'updateOne(' + id + ')');
    //Muestro el modal
    $("#updateAutor").modal("show");
}
//Función final de actualización del autor (viene del modal)
function updateOne(id) {
    //Rescato campos para actualizar
    var nombre = document.getElementById('updateAutorNombre').value;
    var pseudonimo = document.getElementById('updateAutorPseudonimo').value;
    var nacimiento = document.getElementById('updateAutorNacimiento').value;
    var muerte = document.getElementById('updateAutorMuerte').value;
    //Valido el formulario
    if (nombre == "" || nacimiento == "") {
        return;
    }
    $.ajax({
        type: 'POST', //aqui puede ser igual get
        url: '../../rest/autoresRest.php', //aqui va tu direccion donde esta tu funcion php
        dataType: 'json',
        data: {accion: "updateOne", id: id, nombre: nombre, pseudonimo: pseudonimo, nacimiento: nacimiento, muerte: muerte}
        ,
        success: function (data) {
            console.log(data);
        },
        error: function (data) {
            console.log(data);
        }
    });

}
//Función para crear un autor
function createOne() {
    //Rescato los valores
    var nombre = document.getElementById('newAutorNombre').value;
    var pseudonimo = document.getElementById('newAutorPseudonimo').value;
    var nacimiento = document.getElementById('newAutorNacimiento').value;
    var muerte = document.getElementById('newAutorMuerte').value;
    //Valido datos
    if (nombre == "" || nacimiento == "") {
        return;
    }
    //LLamo al rest para la inserción
    $.ajax({
        type: 'POST', //aqui puede ser igual get
        url: '../../rest/autoresRest.php', //aqui va tu direccion donde esta tu funcion php
        dataType: 'json',
        data: {accion: "createOne", nombre: nombre, pseudonimo: pseudonimo, nacimiento: nacimiento, muerte: muerte}
        ,
        success: function (data) {
            console.log(data);
        },
        error: function (data) {
            console.log(data);
        }
    });

}
//Funcion para borrar un autor pasando el id
function deleteOneById(id) {
    $.ajax({
        type: 'POST', //aqui puede ser igual get
        url: '../../rest/autoresRest.php', //aqui va tu direccion donde esta tu funcion php
        dataType: 'json',
        data: {accion: "deleteOneById", id: id}
        ,
        success: function (data) {
            //Si va bien recargo datos
            init()
        },
        error: function (data) {
            console.log(data);
        }
    });

}

