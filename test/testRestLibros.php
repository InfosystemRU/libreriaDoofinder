<?php
/**
 * Clase de test para la rest de Libros
 *
 * @author jose.j.lopez.sanchez
 */
require_once("../dao/libroDao.php");
require_once("../modelo/autor.php");
require_once("../modelo/categorias.php");
require_once("../modelo/libro.php");

use PHPUnit\Framework\TestCase;

class testRestLibros extends TestCase {
    /*
     * Función que llama a varias del archivo para testear el flujo de la api en lo referente a libros.
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
     * Se crea un objeto libro de ejemplo y se pasa como parámetro al método del rest.
     */

    public function testCreateOne() {
        ob_start();
        require_once '../rest/librosRest.php';
        $libro = new libro();
        $categorias[];
        $categoria = new categorias();
        $categoria->id = 1;
        array_push($categorias, $categorias);
        $autor = new autor();
        $autor->id = 1;
        $libro->autor = $autor;
        $libro->categoria = $categorias;
        $libro->descripcion = "DescPrueba";
        $libro->isbn = "ES12345678";
        $libro->titulo = "Titulo libro pruebas";
        $this->assertEquals($libro, createOne($libro));
    }

    /*
     * Se lanza una petición para rescatar todos los libros, asumiendo en el caso de prueba que solo exista el insertado anteriormente.
     * @todo  Es recomendable implementar transaccionalidad para poder realizar pruebas sin llegar a BBDD y poder probar mejor esta función.
     */

    public function testFindAll() {
        ob_start();
        require_once '../rest/librosRest.php';
        $array;
        $libro = new libro();
        $categorias[];
        $categoria = new categorias();
        $categoria->id = 1;
        $categoria->nombre = "CategoriaPruebasGen";
        array_push($categorias, $categorias);
        $autor = new autor();
        $autor->id = 1;
        $autor->fecha_nacimiento = "2021-11-23";
        $autor->nombre = "AutorPruebasGen";
        $libro->autor = $autor;
        $libro->categoria = $categorias;
        $libro->descripcion = "DescPrueba";
        $libro->isbn = "ES12345678";
        $libro->titulo = "Titulo libro pruebas";
        array_push($array, $libro);
        $this->assertEquals($array, findAll());
    }

    /*
     * Se crea un objeto libro haciendo referencia a uno creado anteriormente. Se lanza el findOneById con el id del objeto creado,
     * considerando que exista previamente. Esto debe devolver el objeto en si.
     * @todo  Es recomendable implementar transaccionalidad para poder realizar pruebas sin llegar a BBDD y poder probar mejor esta función.
     */

    public function testFindOneById() {
        ob_start();
        require_once '../rest/librosRest.php';
        $libro = new libro();
        $categorias[];
        $categoria = new categorias();
        $categoria->id = 1;
        array_push($categorias, $categorias);
        $autor = new autor();
        $autor->id = 1;
        $libro->autor = $autor;
        $libro->categoria = $categorias;
        $libro->descripcion = "DescPrueba";
        $libro->isbn = "ES12345678";
        $libro->titulo = "Titulo libro pruebas";
        $this->assertEquals($libro, findOneById(1));
    }

    /*
     * Se crea un objeto libro haciendo referencia a uno creado anteriormente y se cambia cualquier información.
     * Esto se manda al rest para que actualice y devuelve el objeto insertado en BBDD
     */

    public function testUpdateOne() {
        ob_start();
        require_once '../rest/librosRest.php';
        $libro = new libro();
        $categorias[];
        $categoria = new categorias();
        $categoria->id = 1;
        array_push($categorias, $categorias);
        $autor = new autor();
        $autor->id = 1;
        $libro->autor = $autor;
        $libro->categoria = $categorias;
        $libro->descripcion = "DescPrueba";
        $libro->isbn = "ES12345678";
        $libro->titulo = "Titulo libro pruebas ACTUALIZADO";
        $this->assertEquals($libro, createOne($libro));
    }

    /*
     * Se manda un id el metodo deleteOneById() para que elimine el libro.
     * este método devuelve true si ha ido bien.
     */

    public function testDeleteOne() {
        ob_start();
        require_once '../rest/librosRest.php';
        $libro = new libro();
        $this->assertEquals(true, deleteOneById(1));
    }

}
