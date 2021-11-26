<?php

include_once 'genericoDao.php';
include_once 'autorDao.php';
include_once 'categoriaDao.php';
include_once '../modelo/libro.php';
/*
 * DAO para peticiones relacionadas con el CRUD de libros. 
 * Aquí se reciben las llamdas hechas desde la parte REST.
 * efectuarla.
 * @author jose.j.lopez.sanchez
 */

class libroDao {

    private static $instance;

    /*
     * Función para comprobar la existencia de un libro
     * @param $id
     * @return 1 si existe, si no false.
     */

    function existsOneById($id) {
        $consulta = "SELECT * FROM libros WHERE id = " . $id;
        $resultado = genericoDao::getInstance()->consultaBD($consulta, "COUNT");

        return ($resultado > 0);
    }

    /*
     * Función para obtener los datos de un libro
     * @param $id
     * @return libro completa si existe, si no NULL.
     */

    function findOneById($id) {
        $consulta = "SELECT * FROM libros WHERE id = " . $id;
        $resultado = genericoDao::getInstance()->consultaBD($consulta, "ARRAY");

        if (count($resultado) == 0) {
            return NULL;
        }

        $libro = new libro();
        $libro->id = $resultado[0]["id"];
        $libro->titulo = $resultado[0]["titulo"];
        $libro->isbn = $resultado[0]["isbn"];
        $libro->descripcion = $resultado[0]["descripcion"];
        $libro->autor = autorDao::getInstance()->findOneById($resultado[0]["autor"]);
        $libro->categoria = categoriaDao::getInstance()->findAllByLibro($resultado[0]["id"]);
        return $libro;
    }

    /*
     * Función para obtener los datos de todos los libros
     * @param $id
     * @return array de libros.
     */

    function findAll() {
        $consulta = "SELECT * FROM libros";
        $resultado = genericoDao::getInstance()->consultaBD($consulta, "ARRAY");

        $lista_libros = [];

        for ($i = 0; $i < count($resultado); $i++) {

            $libro = new libro();
            $libro->id = $resultado[$i]["id"];
            $libro->titulo = $resultado[$i]["titulo"];
            $libro->isbn = $resultado[$i]["isbn"];
            $libro->descripcion = $resultado[$i]["descripcion"];
            $libro->autor = autorDao::getInstance()->findOneById($resultado[$i]["autor"]);
            $libro->categoria = categoriaDao::getInstance()->findAllByLibro($resultado[$i]["id"]);

            array_push($lista_libros, $libro);
        }

        return $lista_libros;
    }

    /*
     * Función para crearun libro
     * @param $libro
     * @return libro creado llamando al método findByIdF.
     */

    function createOne($libro) {
        $consulta = "SELECT MAX(id) AS id FROM libros";
        $resultado = genericoDao::getInstance()->consultaBD($consulta, "ARRAY");

        if (count($resultado) > 0) {
            $libro->id = $resultado[0]["id"] + 1;
        } else {
            $libro->id = 1;
        }
        $id = $libro->id;
        $titulo = $libro->titulo;
        $isbn = $libro->isbn;
        $descripcion = $libro->descripcion;
        $autor = $libro->autor->id;

        $consulta = "INSERT INTO libros (id, titulo, isbn, descripcion, autor) VALUES ($id, '$titulo', '$isbn','$descripcion', $autor)";
        $resultado = genericoDao::getInstance()->consultaBD($consulta, "NONE");

        categoriaDao::getInstance()->createAllByLibro($libro->categoria, $libro->id);

        return $this->findOneById($id);
    }

    /*
     * Función para actualizar un libro
     * @param $libro
     * @return libro actualizado
     */

    function updateOne($libro) {
        $id = $libro->id;
        $titulo = $libro->titulo;
        $isbn = $libro->isbn;
        $descripcion = $libro->descripcion;
        $autor = $libro->autor->id;

        $consulta = "UPDATE libros SET titulo = '$titulo', isbn = '$isbn', descripcion = '$descripcion', autor = $autor WHERE id = $id";
        $resultado = genericoDao::getInstance()->consultaBD($consulta, "NONE");

        categoriaDao::getInstance()->updateAllByLibro($libro->categoria, $libro->id);
        return $resultado;
    }

    /*
     * Función para borrar un libro
     * @param $id del libro
     * @return boolean
     */

    function deleteOneById($id) {
        $consulta = "DELETE FROM relacion_categoria_libro WHERE id_libro = " . $id;
        $resultado = genericoDao::getInstance()->consultaBD($consulta, "NONE");

        $consulta = "DELETE FROM libros WHERE id = " . $id;
        $resultado = genericoDao::getInstance()->consultaBD($consulta, "NONE");

        return $resultado;
    }

    /*
     * Función para obtener la instancia de la clase 
     */

    public static function getInstance() {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }
        return self::$instance;
    }

}
