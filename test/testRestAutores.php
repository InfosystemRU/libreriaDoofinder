<?php
/**
 * Clase de test para la rest de Autores
 *
 * @author jose.j.lopez.sanchez
 */
require_once("../dao/autorDao.php");
require_once("../modelo/autor.php");

use PHPUnit\Framework\TestCase;

class testRestAutores extends TestCase {
    /*
     * Función que llama a varias del archivo para testear el flujo de la api en lo referente a autores.
     */

    public function testAllRestAutores() {
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
     * Se crea un objeto autor de ejemplo y se pasa como parámetro al método del rest.
     */

    public function testCreateOne() {
        ob_start();
        $this->initBBDD();
        require_once '../rest/autoresRest.php';
        $autor = new autor();
        $autor->id = 1;
        $autor->nombre = "Nombre Prueba Autor";
        $autor->pseudonimo = "Pseudonimo Prueba Autor";
        $autor->fecha_nacimiento = "11-10-1975";
        $this->assertEquals($autor, createOne($autor));
    }

    /*
     * Se lanza una petición para rescatar todos los autores, asumiendo en el caso de prueba que solo exista el insertado anteriormente.
     * @todo  Es recomendable implementar transaccionalidad para poder realizar pruebas sin llegar a BBDD y poder probar mejor esta función.
     */

    public function testFindAll() {
        ob_start();
        $this->initBBDD();

        require_once '../rest/autoresRest.php';
        $array;
        $autor = new autor();
        $autor->id = 1;
        $autor->nombre = "Nombre Prueba Autor";
        $autor->pseudonimo = "Pseudonimo Prueba Autor";
        $autor->fecha_nacimiento = "11-10-1975";
        array_push($array, $autor);
        $this->assertEquals($autor, findAll());
    }

    /*
     * Se crea un objeto autor haciendo referencia a uno creado anteriormente y se cambia cualquier información.
     * Esto se manda al rest para que actualice y devuelve el objeto insertado en BBDD
     */

    public function testUpdateOne() {
        ob_start();
        $this->initBBDD();

        require_once '../rest/autoresRest.php';
        $autor = new autor();
        $autor->id = 1;
        $autor->nombre = "Nombre Prueba Autor ACTUALIZADA";
        $autor->pseudonimo = "Pseudonimo Prueba Autor";
        $autor->fecha_nacimiento = "11-10-1975";
        $this->assertEquals($autor, updateOne($autor));
    }

    /*
     * Se manda un id el metodo deleteOneById() para que elimine el autor.
     * este método devuelve true si ha ido bien.
     */

    public function testDeleteOne() {
        ob_start();
        $this->initBBDD();

        require_once '../rest/autoresRest.php';
        $this->assertEquals(true, deleteOneById(1));
    }

    /*
     * Se crea un objeto autor haciendo referencia a uno creado anteriormente. Se lanza el findOneById con el id del objeto creado,
     * considerando que exista previamente. Esto debe devolver el objeto en si.
     * @todo  Es recomendable implementar transaccionalidad para poder realizar pruebas sin llegar a BBDD y poder probar mejor esta función.
     */

    public function testFindOneById() {
        ob_start();
        $this->initBBDD();

        require_once '../rest/autoresRest.php';
        $autor = new autor();
        $autor->id = 1;
        $autor->nombre = "Nombre Prueba Autor ACTUALIZADA";
        $autor->pseudonimo = "Pseudonimo Prueba Autor";
        $autor->fecha_nacimiento = "11-10-1975";
        $this->assertEquals($autor, findOneById(1));
    }

}
