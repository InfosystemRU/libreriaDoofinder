<?php

/*
 * DAO para peticiones relacionadas con el CRUD de autores. 
 * Aquí se reciben las llamdas hechas desde la parte REST.
 * efectuarla.
 * @author jose.j.lopez.sanchez
 */
include_once 'genericoDao.php';
include_once '../modelo/autor.php';

class autorDao {

    private static $instance;

    /*
     * Función para comprobar la existencia de un autor
     * @param $id
     * @return 1 si existe, si no false.
     */

    function existsOneById($id) {
        $consulta = "SELECT * FROM autores WHERE id = " . $id;
        $resultado = genericoDao::getInstance()->consultaBD($consulta, "COUNT");

        return ($resultado > 0);
    }

    /*
     * Función para obtener los datos de un autor
     * @param $id
     * @return autor completo si existe, si no NULL.
     */

    function findOneById($id) {
        $consulta = "SELECT * FROM autores WHERE id = " . $id;
        $resultado = genericoDao::getInstance()->consultaBD($consulta, "ARRAY");

        if (count($resultado) == 0) {
            return NULL;
        }

        $autor = new autor();
        $autor->id = $resultado[0]["id"];
        $autor->nombre = $resultado[0]["nombre"];
        $autor->pseudonimo = $resultado[0]["pseudonimo"];
        $autor->fecha_nacimiento = $resultado[0]["fecha_nacimiento"];
        $autor->fecha_muerte = $resultado[0]["fecha_muerte"];

        return $autor;
    }

    /*
     * Función para obtener los datos de todos los autores
     * @return array de autores.
     */

    function findAll() {
        $consulta = "SELECT * FROM autores";
        $resultado = genericoDao::getInstance()->consultaBD($consulta, "ARRAY");

        $lista_autores = [];

        for ($i = 0; $i < count($resultado); $i++) {
            $autor = new autor();
            $autor->id = $resultado[$i]["id"];
            $autor->nombre = $resultado[$i]["nombre"];
            $autor->pseudonimo = $resultado[$i]["pseudonimo"];
            $autor->fecha_nacimiento = $resultado[$i]["fecha_nacimiento"];
            $autor->fecha_muerte = $resultado[$i]["fecha_muerte"];

            array_push($lista_autores, $autor);
        }

        return $lista_autores;
    }

    /*
     * Función para crear un autor
     * @return autor llamando a la función findOneById.
     */

    function createOne($autor) {
        $consulta = "SELECT MAX(id) AS id FROM autores";
        $resultado = genericoDao::getInstance()->consultaBD($consulta, "ARRAY");

        if (count($resultado) > 0) {
            $autor->id = $resultado[0]["id"] + 1;
        } else {
            $autor->id = 1;
        }
        $id = $autor->id;
        $nombre = $autor->nombre;
        $pseudonimo = $autor->pseudonimo;
        $fecha_nacimiento = $autor->fecha_nacimiento;
        $fecha_muerte = $autor->fecha_muerte;

        $consulta = "INSERT INTO autores (id, nombre, pseudonimo, fecha_nacimiento, fecha_muerte) VALUES ($id, '$nombre', '$pseudonimo', '$fecha_nacimiento', '$fecha_muerte')";
        $resultado = genericoDao::getInstance()->consultaBD($consulta, "NONE");

        return $this->findOneById($id);
    }

    /*
     * Función para actualizar un autor
     * @param autor a crear
     * @return autor actualizado.
     */

    function updateOne($autor) {
        $id = $autor->id;
        $nombre = $autor->nombre;
        $pseudonimo = $autor->pseudonimo;
        $fecha_nacimiento = $autor->fecha_nacimiento;
        $fecha_muerte = $autor->fecha_muerte;
        $consulta = "UPDATE autores SET nombre = '$nombre', pseudonimo = '$pseudonimo', fecha_nacimiento = '$fecha_nacimiento', fecha_muerte = '$fecha_muerte' WHERE id = $id";
        $resultado = genericoDao::getInstance()->consultaBD($consulta, "NONE");

        return $resultado;
    }

    /*
     * Función para borrar un autor
     * @param id autor a autor
     * @return boolean $resultado.
     */

    function deleteOneById($id) {
        $consulta = "DELETE * FROM relacion_categoria_libros WHERE id_libro IN(SELECT id from libros where id_autor = $id)";
        $resultado = genericoDao::getInstance()->consultaBD($consulta, "NONE");
        $consulta = "DELETE FROM libros WHERE autor = " . $id;
        $resultado = genericoDao::getInstance()->consultaBD($consulta, "NONE");
        $consulta = "DELETE FROM autores WHERE id = " . $id;
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

?>
