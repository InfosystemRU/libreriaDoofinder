<?php
/**
 * Clase de test para la rest de Categorias
 *
 * @author jose.j.lopez.sanchez
 */
require_once("../dao/autorDao.php");
require_once("../modelo/categorias.php");

use PHPUnit\Framework\TestCase;

class testRestCategorias extends TestCase {
    /*
     * Función que llama a varias del archivo para testear el flujo de la api en lo referente a categorias.
     */

    public function testAllRestLibros() {
        $this->initBBDD();
        $this->testCreateOne();
        $this->testFindOneById();
        $this->testUpdateOne();
        $this->testDeleteOne();
    }

    /*
     * Función para inicicializar la base de datos con los parámetros para autentificar en la base de datos testLibreria, para 
     * no alterar los datos reales
     */

    public function initBBDD() {
        genericoDao::setDb_host('localhost');
        genericoDao::setDb_name('testLibreria');
        genericoDao::getDb_pass('localhost');
        genericoDao::getDb_user('localhost');
    }

    /*
     * Se crea un objeto categoría de ejemplo y se pasa como parámetro al método del rest.
     */

    public function testCreateOne() {
        ob_start();
        $this->initBBDD();
        require_once '../rest/categoriasRest.php';
        $categoria = new categorias();
        $categoria->nombre = "Categoria Prueba";
        $categoria->descripcion = "Categoria Prueba Descripcion";
        $autor->fecha_nacimiento = "11-10-1975";
        $this->assertEquals($categoria, createOne($categoria));
    }

    /*
     * Se lanza una petición para rescatar todas las categorias, asumiendo en el caso de prueba que solo exista el insertado anteriormente.
     * @todo  Es recomendable implementar transaccionalidad para poder realizar pruebas sin llegar a BBDD y poder probar mejor esta función.
     */

    public function testFindAll() {
        ob_start();
        $this->initBBDD();
        require_once '../rest/categoriasRest.php';
        $array;
        $categoria = new categorias();
        $categoria->nombre = "Categoria Prueba";
        $categoria->descripcion = "Categoria Prueba Descripcion";
        array_push($array, $categoria);
        $this->assertEquals($array, findAll());
    }

    /*
     * Se crea un objeto categoría haciendo referencia a uno creado anteriormente y se cambia cualquier información.
     * Esto se manda al rest para que actualice y devuelve el objeto insertado en BBDD
     */

    public function testUpdateOne() {
        ob_start();
        $this->initBBDD();
        require_once '../rest/categoriasRest.php';
        $categoria = new categorias();
        $categoria->id = 1;
        $categoria->nombre = "Categoria Prueba ACTUALIZADO";
        $categoria->descripcion = "Categoria Prueba Descripcion";
        $this->assertEquals($categoria, updateOne($categoria));
    }

    /*
     * Se manda un id el metodo deleteOneById() para que elimine la categoría.
     * este método devuelve true si ha ido bien.
     */

    public function testDeleteOne() {
        ob_start();
        $this->initBBDD();
        require_once '../rest/categoriasRest.php';
        $this->assertEquals(true, deleteOneById(1));
    }

}
