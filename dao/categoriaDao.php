<?php

include_once 'genericoDao.php';
include_once '../modelo/categorias.php';
/*
 * DAO para peticiones relacionadas con el CRUD de categorias. 
 * Aquí se reciben las llamdas hechas desde la parte REST.
 * efectuarla.
 * @author jose.j.lopez.sanchez
 */

class categoriaDao {

    private static $instance;

    /*
     * Función para comprobar la existencia de una categoria
     * @param $id
     * @return 1 si existe, si no false.
     */

    function existsOneById($id) {
        $consulta = "SELECT * FROM categorias WHERE id = " . $id;
        $resultado = genericoDao::getInstance()->consultaBD($consulta, "COUNT");

        return ($resultado > 0);
    }

    /*
     * Función para obtener los datos de una categoria
     * @param $id
     * @return categoria completa si existe, si no NULL.
     */

    function findOneById($id) {
        $consulta = "SELECT * FROM categorias WHERE id = " . $id;
        $resultado = genericoDao::getInstance()->consultaBD($consulta, "ARRAY");

        if (count($resultado) == 0) {
            return NULL;
        }

        $categoria = new categorias();
        $categoria->id = $resultado[0]["id"];
        $categoria->nombre = $resultado[0]["nombre"];
        $categoria->descripcion = $resultado[0]["descripcion"];

        return $categoria;
    }

    /*
     * Función para obtener las categorias del libro especificado
     * @param id libro
     * @return categorias relacionadas con el libro.
     */

    function findAllByLibro($id) {
        $consulta = "SELECT * FROM categorias WHERE id IN (SELECT id_categoria FROM relacion_categoria_libro WHERE id_libro = $id)";
        $resultado = genericoDao::getInstance()->consultaBD($consulta, "ARRAY");

        if (count($resultado) == 0) {
            return NULL;
        }

        $lista_categorias = [];
        for ($i = 0; $i < count($resultado); $i++) {
            $categoria = new categorias();
            $categoria->id = $resultado[$i]["id"];
            $categoria->nombre = $resultado[$i]["nombre"];
            $categoria->descripcion = $resultado[$i]["descripcion"];
            array_push($lista_categorias, $categoria);
        }
        return $lista_categorias;
    }

    /*
     * Función para obtener los datos de todas las categoria
     * @return array de categorias.
     */

    function findAll() {
        $consulta = "SELECT * FROM categorias";
        $resultado = genericoDao::getInstance()->consultaBD($consulta, "ARRAY");

        $lista_categorias = [];

        for ($i = 0; $i < count($resultado); $i++) {

            $categoria = new categorias();
            $categoria->id = $resultado[$i]["id"];
            $categoria->nombre = $resultado[$i]["nombre"];
            $categoria->descripcion = $resultado[$i]["descripcion"];

            array_push($lista_categorias, $categoria);
        }

        return $lista_categorias;
    }

    /*
     * Función para crear una categoria
     * @return categoria llamando a la función findOneById.
     */

    function createOne($categoria) {
        $consulta = "SELECT MAX(id) AS id FROM categorias";
        $resultado = genericoDao::getInstance()->consultaBD($consulta, "ARRAY");

        if (count($resultado) > 0) {
            $categoria->id = $resultado[0]["id"] + 1;
        } else {
            $categoria->id = 1;
        }
        $id = $categoria->id;
        $nombre = $categoria->nombre;
        $descripcion = $categoria->descripcion;

        $consulta = "INSERT INTO categorias (id, nombre, descripcion) VALUES ($id, '$nombre', '$descripcion')";
        $resultado = genericoDao::getInstance()->consultaBD($consulta, "NONE");

        return $this->findOneById($id);
    }

    /*
     * Función para crear las categorias del libro especificado
     * @param lista de categorias
     * @param id libro
     * @return categorias relacionadas con el libro.
     */

    function createAllByLibro($listaCategorias, $idLibro) {

        for ($i = 0; $i < count($listaCategorias); $i++) {
            $categoriaId = $listaCategorias[$i]->id;
            $consulta = "INSERT INTO relacion_categoria_libro (id_libro, id_categoria) VALUES ($idLibro, $categoriaId)";
            $resultado = genericoDao::getInstance()->consultaBD($consulta, "NONE");
        }

        return $this->findAllByLibro($idLibro);
    }

    /*
     * Función para actualizar las categorias del libro especificado
     * @param lista de categorias
     * @param id libro
     * @return categorias relacionadas con el libro.
     */

    function updateAllByLibro($listaCategorias, $idLibro) {
        $consulta = "DELETE FROM relacion_categoria_libro WHERE id_libro = " . $idLibro;
        $resultado = genericoDao::getInstance()->consultaBD($consulta, "NONE");
        for ($i = 0; $i < count($listaCategorias); $i++) {
            $categoriaId = $listaCategorias[$i]->id;
            $consulta = "INSERT INTO relacion_categoria_libro (id_libro, id_categoria) VALUES ($idLibro, $categoriaId)";
            $resultado = genericoDao::getInstance()->consultaBD($consulta, "NONE");
        }

        return $this->findAllByLibro($idLibro);
    }

    /*
     * Función para actualizar una categoria
     * @param categoria a crear
     * @return categoria actualizada.
     */

    function updateOne($categoria) {
        $id = $categoria->id;
        $nombre = $categoria->nombre;
        $descripcion = $categoria->descripcion;

        $consulta = "UPDATE categorias SET nombre = '$nombre', descripcion = '$descripcion' WHERE id = $id";
        $resultado = genericoDao::getInstance()->consultaBD($consulta, "NONE");

        return $resultado;
    }

    /*
     * Función para borrar una categoria
     * @param id categoria
     * @return boolean $resultado.
     */

    function deleteOneById($id) {
        $consulta = "DELETE FROM categorias WHERE id = " . $id;
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
