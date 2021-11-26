<?php

/*
 * Rest para peticiones relacionadas con el CRUD de libros. 
 * Aquí se reciben las llamdas hechas por JS desde el front. Se analiza el parámetro acción para determinar la acción a realizar y se pasa al dao lo necesario para
 * efectuarla.
 * @author jose.j.lopez.sanchez
 */
include_once '../dao/libroDao.php';
include_once '../modelo/libro.php';
include_once '../modelo/autor.php';
include_once '../modelo/categorias.php';
/*
 * Si la petición recibida tiene el parametro acción con el valor findAll se lanza la función findAll
 * @param $_POST - Array con los siguientes datos:
 *         $_POST['accion'] -> determina la acción a realizar
 * 
 * @return $libros si todo ha ido bien, un array con todos los libros existentes.
 */
if ($_POST['accion'] == 'findAll') {
    $libros = findAll();
    echo json_encode($libros);
}
/*
 * Si la petición recibida tiene el parametro acción con el valor createOne se lanza la función createOne
 * Esta función es para la creación de un nuevo libro
 * @param $_POST - Array con los siguientes datos:
 *         $_POST['accion'] -> determina la acción a realizar
 *         $_POST['autor'] -> id del autor del libro
 *         $_POST['categoria'] -> id de la categoría del libro
 *         $_POST['isbn'] -> isbn del libro
 *         $_POST['titulo'] -> título del libro
 *         $_POST['descripcion'] -> descripción del libro
 * 
 * @return $libros si todo ha ido bien, es el libro ya creado. En caso contrario o si faltan atributos de entrada devuelve false.
 */
if ($_POST['accion'] == 'createOne') {
    if (isset($_POST['autor']) && isset($_POST['categoria']) && isset($_POST['descripcion']) && isset($_POST['isbn']) && isset($_POST['titulo'])) {
        $arrayCat = [];
        for ($i = 0; $i < count($_POST['categoria']); $i++) {
            $cat = new categorias();
            $cat->id = $_POST['categoria'][$i];
            array_push($arrayCat, $cat);
        }
        $autor = new autor();
        $autor->id = $_POST['autor'];

        $libro = new libro();
        $libro->autor = $autor;
        $libro->categoria = $arrayCat;
        $libro->descripcion = $_POST['descripcion'];
        $libro->isbn = $_POST['isbn'];
        $libro->titulo = $_POST['titulo'];
        $libros = createOne($libro);

        echo json_encode($libros);
    } else {
        echo json_encode(false);
    }
}
/*
 * Si la petición recibida tiene el parametro acción con el valor updateOne se lanza la función updateOne
 * Esta función es para la actualización de un libro existente
 * @param $_POST - Array con los siguientes datos:
 *         $_POST['accion'] -> determina la acción a realizar
 *         $_POST['id'] -> id del libro
 *         $_POST['autor'] -> id del autor del libro
 *         $_POST['categoria'] -> id de la categoría del libro
 *         $_POST['isbn'] -> isbn del libro
 *         $_POST['titulo'] -> título del libro
 *         $_POST['descripcion'] -> descripción del libro
 * 
 * @return $libros si todo ha ido bien, es el libro ya creado. En caso contrario o si faltan atributos de entrada devuelve false.
 */
if ($_POST['accion'] == 'updateOne') {
    if (isset($_POST['autor']) && isset($_POST['categoria']) && isset($_POST['descripcion']) && isset($_POST['isbn']) && isset($_POST['titulo'])) {
        //Creación del array de categorias
        $arrayCat = [];
        //Se recorre para añadir las categorias seleccionadas al array
        for ($i = 0; $i < count($_POST['categoria']); $i++) {
            $cat = new categorias();
            $cat->id = $_POST['categoria'][$i];
            array_push($arrayCat, $cat);
        }
        //Creación del objeto autor
        $autor = new autor();
        $autor->id = $_POST['autor'];
        //Creacion del libro
        $libro = new libro();
        $libro->id = $_POST['id'];
        $libro->autor = $autor;
        $libro->categoria = $arrayCat;
        $libro->descripcion = $_POST['descripcion'];
        $libro->isbn = $_POST['isbn'];
        $libro->titulo = $_POST['titulo'];
        $libros = updateOne($libro);
        echo json_encode($libros);
    } else {
        echo json_encode(false);
    }
}
/*
 * Si la petición recibida tiene el parametro acción con el valor findOneById se lanza la función findOneById
 * Esta función es para traer un libro 
 * @param $_POST - Array con los siguientes datos:
 *         $_POST['accion'] -> determina la acción a realizar
 *         $_POST['id'] -> id del libro
 * 
 * @return $libros si todo ha ido bien, es el libro referenciado. En caso contrario o si faltan atributos de entrada devuelve false.
 */
if ($_POST['accion'] == 'findOneById') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $libros = findOneById($id);
        echo json_encode($libros);
    } else {
        echo json_encode(false);
    }
}
/*
 * Si la petición recibida tiene el parametro acción con el valor deleteOneById se lanza la función deleteOneById
 * Esta función es para borrar un libro 
 * @param $_POST - Array con los siguientes datos:
 *         $_POST['accion'] -> determina la acción a realizar
 *         $_POST['id'] -> id del libro
 * 
 * @return $libros si todo ha ido bien, true si ha sido borrado. En caso contrario o si faltan atributos de entrada devuelve false.
 */
if ($_POST['accion'] == 'deleteOneById') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $libros = deleteOneById($id);
        echo json_encode($libros);
    } else {
        echo json_encode(false);
    }
}

/*
 * Llamada al DAO para updatear un libro
 * @param $libro
 * @return $lib (libro actualizado)
 */
function updateOne($libro) {
    $lib = libroDao::getInstance()->updateOne($libro);
    return $lib;
}
/*
 * Llamada al DAO para borrar un libro
 * @param $id
 * @return $lib (booleano)
 */
function deleteOneById($id) {
    $lib = libroDao::getInstance()->deleteOneById($id);
    return $lib;
}
/*
 * Llamada al DAO para traer todos los libros
 * @return $lib (array de libros)
 */
function findAll() {
    $lib = libroDao::getInstance()->findAll();
    return $lib;
}
/*
 * Llamada al DAO para traer un libro
 * @param $id
 * @return $lib (libro referenciado)
 */
function findOneById($id) {
    $lib = libroDao::getInstance()->findOneById($id);
    return $lib;
}
/*
 * Llamada al DAO para saber si existe un libro
 * @param $id
 * @return $lib (COUNT)
 */
function existsOneById($id) {
    $lib = libroDao::getInstance()->existsOneById($id);
    return $lib;
}
/*
 * Llamada al DAO para crear un libro
 * @param $libro
 * @return $lib (libro creado)
 */
function createOne($libro) {
    $lib = libroDao::getInstance()->createOne($libro);
    return $lib;
}
