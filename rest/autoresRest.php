<?php

/*
 * Rest para peticiones relacionadas con el CRUD de autores. 
 * Aquí se reciben las llamdas hechas por JS desde el front. Se analiza el parámetro acción para determinar la acción a realizar y se pasa al dao lo necesario para
 * efectuarla.
 * @author jose.j.lopez.sanchez
 */
include_once '../dao/autorDao.php';
include_once '../modelo/autor.php';

//Variable que recogerá los errores para mandarlos a la salida de las funciones.
$error = "";

/*
 * Si la petición recibida tiene el parametro acción con el valor createOne se lanza la función createOne
 * @param $_POST - Array con los siguientes datos:
 *         $_POST['accion'] -> determina la acción a realizar
 *         $_POST['nombre'] -> nombre del autor a crear
 *         $_POST['pseudonimo'] -> pseudonimo del autor a crear (no obligatorio)
 *         $_POST['nacimiento'] -> fecha de nacimiento del autor a crear 
 *         $_POST['muerte'] -> pseudonimo del autor a crear (no obligatorio)
 * 
 * @return $autor si todo ha ido bien, en caso de que falte algún dato obligatorio devuelve false.
 */

if ($_POST['accion'] == 'createOne') {
    $autor = new autor();
    if (isset($_POST['nombre']) && isset($_POST['nacimiento'])) {
        $autor->nombre = $_POST['nombre'];
        $autor->pseudonimo = $_POST['pseudonimo'];
        $autor->fecha_nacimiento = $_POST['nacimiento'];
        $autor->fecha_muerte = $_POST['muerte'];
        $autorNuevo = createOne($autor);
        echo json_encode($autorNuevo);
    } else {
        echo json_encode(false);
    }
}
/*
 * Si la petición recibida tiene el parametro acción con el valor existOneById se lanza la función existsOneById
 * @param $_POST - Array con los siguientes datos:
 *         $_POST['accion'] -> determina la acción a realizar
 *         $_POST['id'] -> nombre del autor a buscar
 * 
 * @return $autor si todo ha ido bien, en caso de que falte algún dato obligatorio devuelve $error.
 */

if ($_POST['accion'] == 'existsOneById') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $exists = existsOneById($id);

        echo json_encode($exists);
    } else {
        $error = "No se ha especificado un autor, recarge la página.";
        echo json_encode($error);
    }
}
/*
 * Si la petición recibida tiene el parametro acción con el valor findOneById se lanza la función findOneById
 * @param $_POST - Array con los siguientes datos:
 *         $_POST['accion'] -> determina la acción a realizar
 *         $_POST['id'] -> nombre del autor a buscar
 * 
 * @return $autor si todo ha ido bien, en caso de que falte algún dato obligatorio devuelve false.
 */
if ($_POST['accion'] == 'findOneById') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $autor = findOneById($id);
        echo json_encode($autor);
    } else {
        echo json_encode(false);
    }
}
/*
 * Si la petición recibida tiene el parametro acción con el valor findAll se lanza la función findAll
 * @param $_POST - Array con los siguientes datos:
 *         $_POST['accion'] -> determina la acción a realizar
 * 
 * @return $autores si todo ha ido bien, un array con todos los autores existentes.
 */
if ($_POST['accion'] == 'findAll') {
    $autores = findAll();
    echo json_encode($autores);
}
/*
 * Si la petición recibida tiene el parametro acción con el valor deleteOneById se lanza la función deleteOneById
 * @param $_POST - Array con los siguientes datos:
 *         $_POST['accion'] -> determina la acción a realizar
 *         $_POST['id'] -> nombre del autor a borrar
 * 
 * @return $result si todo ha ido bien, en caso de que falte algún dato obligatorio devuelve false.
 */

if ($_POST['accion'] == 'deleteOneById') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $result = deleteOneById($id);
        echo json_encode($result);
    } else
        json_encode(false);
}

/*
 * Si la petición recibida tiene el parametro acción con el valor updateOne se lanza la función updateOne
 * @param $_POST - Array con los siguientes datos:
 *         $_POST['accion'] -> determina la acción a realizar
 *         $_POST['nombre'] -> nombre del autor a updatear
 *         $_POST['pseudonimo'] -> pseudonimo del autor a updatear (no obligatorio)
 *         $_POST['nacimiento'] -> fecha de nacimiento del autor a updatear 
 *         $_POST['muerte'] -> pseudonimo del autor a updatear (no obligatorio)
 * 
 * @return $autor si todo ha ido bien, en caso de que falte algún dato obligatorio devuelve false.
 */
if ($_POST['accion'] == 'updateOne') {
    if (isset($_POST['nombre']) && isset($_POST['nacimiento'])) {

        $autor = new autor();
        $autor->id = $_POST['id'];
        $autor->nombre = $_POST['nombre'];
        $autor->pseudonimo = $_POST['pseudonimo'];
        $autor->fecha_nacimiento = $_POST['nacimiento'];
        $autor->fecha_muerte = $_POST['muerte'];
        $autores = updateOne($autor);
        echo json_encode($autores);
    } else {
        echo json_encode(false);
    }
}

/*
 * Llamada al DAO para actualizar un autor
 * @param $autor
 * @return $resultado (autor actualizado)
 */

function updateOne($autor) {
    $autores = autorDao::getInstance()->updateOne($autor);
    return $autores;
}

/*
 * Llamada al DAO para actualizar un autor
 * @param $autor
 * @return $resultado (autor actualizado)
 */

function deleteOneById($id) {
    $autores = autorDao::getInstance()->deleteOneById($id);
    return $autores;
}

/*
 * Llamada al DAO para traer todos los autores
 * @return $resultado (array de autores)
 */

function findAll() {
    $autores = autorDao::getInstance()->findAll();
    return $autores;
}

/*
 * Llamada al DAO para encontrar un autor por id
 * @param $id
 * @return $resultado (autor)
 */

function findOneById($id) {
    $autores = autorDao::getInstance()->findOneById($id);
    return $autores;
}

/*
 * Llamada al DAO para comprobar la existencia de un autor
 * @param $id
 * @return int - valores: 1 existe, 0 no existe.
 */

function existsOneById($id) {
    $autores = autorDao::getInstance()->existsOneById($id);
    return $autores;
}

/*
 * Llamada al DAO para crear un autor
 * @param $autor
 * @return $resultado (autor creado)
 */

function createOne($autor) {
    $autores = autorDao::getInstance()->createOne($autor);
    return $autores;
}
