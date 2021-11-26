<?php

/*
 * Rest para peticiones relacionadas con el CRUD de categorias. 
 * Aquí se reciben las llamdas hechas por JS desde el front. Se analiza el parámetro acción para determinar la acción a realizar y se pasa al dao lo necesario para
 * efectuarla.
 * @author jose.j.lopez.sanchez
 */
include_once '../dao/categoriaDao.php';
include_once '../modelo/categorias.php';
//Variable que recogerá los errores para mandarlos a la salida de las funciones.
$error = "";

/*
 * Si la petición recibida tiene el parametro acción con el valor findAll se lanza la función findAll
 * @param $_POST - Array con los siguientes datos:
 *         $_POST['accion'] -> determina la acción a realizar
 * 
 * @return $cat si todo ha ido bien, un array con todas las categorias existentes.
 */
if ($_POST['accion'] == 'findAll') {
    $cat = findAll();
    echo json_encode($cat);
}
/*
 * Si la petición recibida tiene el parametro acción con el valor createOne se lanza la función createOne
 * @param $_POST - Array con los siguientes datos:
 *         $_POST['accion'] -> determina la acción a realizar
 *         $_POST['nombre'] -> nombre la categoria a crear
 *         $_POST['descripcion'] -> descripcion de la categoria a crear (no obligatorio)
 * 
 * @return $autor si todo ha ido bien, en caso de que falte algún dato obligatorio devuelve false.
 */
if ($_POST['accion'] == 'createOne') {
    if (isset($_POST['nombre'])) {
        $categorias = new categorias();
        $categorias->nombre = $_POST['nombre'];
        $categorias->descripcion = $_POST['descripcion'];

        $cateogriaNueva = createOne($categorias);

        echo json_encode($cateogriaNueva);
    } else {
        echo json_encode(false);
    }
}
/*
 * Si la petición recibida tiene el parametro acción con el valor existsOneById se lanza la función existsOneById
 * @param $_POST - Array con los siguientes datos:
 *         $_POST['accion'] -> determina la acción a realizar
 *         $_POST['id'] -> id la categoria a buscar
 * 
 * @return $exists si todo ha ido bien, en caso de que falte algún dato obligatorio devuelve false.
 */
if ($_POST['accion'] == 'existsOneById') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $exists = existsOneById($id);
        echo json_encode($exists);
    } else {
        echo json_encode(false);
    }
}
/*
 * Si la petición recibida tiene el parametro acción con el valor findOneById se lanza la función findOneById
 * @param $_POST - Array con los siguientes datos:
 *         $_POST['accion'] -> determina la acción a realizar
 *         $_POST['id'] -> id la categoria a buscar
 * 
 * @return $categoria si todo ha ido bien, en caso de que falte algún dato obligatorio devuelve false.
 */
if ($_POST['accion'] == 'findOneById') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $categoria = findOneById($id);
        echo json_encode($categoria);
    } else {
        echo json_encode(false);
    }
}
/*
 * Si la petición recibida tiene el parametro acción con el valor deleteOneById se lanza la función deleteOneById
 * @param $_POST - Array con los siguientes datos:
 *         $_POST['accion'] -> determina la acción a realizar
 *         $_POST['id'] -> id la categoria a borrar
 * 
 * @return $categoria = 1 si todo ha ido bien, en caso de que falte algún dato obligatorio devuelve false.
 */
if ($_POST['accion'] == 'deleteOneById') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $categoria = deleteOneById($id);
        echo json_encode($categoria);
    } else {
        echo json_encode(false);
    }
}
/*
 * Si la petición recibida tiene el parametro acción con el valor createOne se lanza la función updateOne
 * @param $_POST - Array con los siguientes datos:
 *         $_POST['accion'] -> determina la acción a realizar
 *         $_POST['id'] -> id la categoria a borrar
 *         $_POST['nombre'] -> nombre la categoria a crear
 *         $_POST['descripcion'] -> descripcion de la categoria a crear (no obligatorio)
 * 
 * @return $categoria (la updateada) si todo ha ido bien, en caso de que falte algún dato obligatorio devuelve false.
 */
if ($_POST['accion'] == 'updateOne') {
    if (isset($_POST['nombre']) && isset($_POST['id'])) {
        $categoria = new categorias();
        $categoria->id = $_POST['id'];
        $categoria->nombre = $_POST['nombre'];
        $categoria->descripcion = $_POST['descripcion'];
        $categorias = updateOne($categoria);

        echo json_encode($categorias);
    } else {
        echo json_encode(false);
    }
}
/*
 * Llamada al DAO para actualizar una categoria
 * @param $categoria
 * @return $cat (categoria actualizado)
 */

function updateOne($categoria) {
    $cat = categoriaDao::getInstance()->updateOne($categoria);
    return $cat;
}

/*
 * Llamada al DAO para borrar una categoria
 * @param $id
 * @return $cat (true or false)
 */

function deleteOneById($id) {
    $cat = categoriaDao::getInstance()->deleteOneById($id);
    return $cat;
}

/*
 * Llamada al DAO para encontrar todas las categorias
 * @return $cat (array de categorías)
 */

function findAll() {
    $cat = categoriaDao::getInstance()->findAll();
    return $cat;
}

/*
 * Llamada al DAO para traer una categoria
 * @param $id
 * @return $cat (categoria completa)
 */

function findOneById($id) {
    $cat = categoriaDao::getInstance()->findOneById($id);
    return $cat;
}

/*
 * Llamada al DAO para comprobar la existencia de una categoria
 * @param $id
 * @return $cat (count de categoría $id)
 */

function existsOneById($id) {
    $cat = categoriaDao::getInstance()->existsOneById($id);
    return $cat;
}

/*
 * Llamada al DAO para crear una categoria
 * @param $categoria
 * @return $cat (categoria creada)
 */

function createOne($categoria) {
    $cat = categoriaDao::getInstance()->createOne($categoria);
    return $cat;
}
