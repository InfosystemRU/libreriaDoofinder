<?php

/*
 * DAO para peticiones genéricas a BBDD
 * Aquí se reciben las consultas, se establece la conexión a BBDD y se pueden cambiar las variables por defecto de conexión.
 * @author jose.j.lopez.sanchez
 */

class genericoDao {

    private static $instance;
    private static $db_host = "localhost";
    private static $db_user = "root";
    private static $db_pass = "";
    private static $db_name = "libreriadoofinder";

    /*
     * Función para conectar con BBDD. Si no se setean otras, las variables usadas seran las declaradas al inicio de la clase.
     * @return conexión o errores en su defecto
     */

    function conexionBD() {
        $conexion = mysqli_connect(self::$db_host, self::$db_user, self::$db_pass, self::$db_name);

        if (!$conexion) {
            die("imposible conectarse: " . mysqli_error($conexion));
        }

        if (mysqli_connect_errno()) {
            die("Conexión falló: " . mysqli_connect_errno() . " : " . mysqli_connect_error());
        }

        return $conexion;
    }

    /*
     * Función para consultar en BBDD. 
     * @param $consulta - la query a ejecutar
     * @param $tipo - la respuesta, si es un COUNT será solo el número de registros, si es un ARRAY será asociativo.
     * @return resultado de la query
     */

    function consultaBD($consulta, $tipo) {
        $resultado = "";

        $conexion = $this->conexionBD();

        $sql = mysqli_query($conexion, $consulta);

        if (strtoupper($tipo) == "ARRAY") {
            $resultado = mysqli_fetch_all($sql, MYSQLI_ASSOC);
        }

        if (strtoupper($tipo) == "COUNT") {
            $resultado = mysqli_num_rows($sql);
        }

        if (strtoupper($tipo) == "NONE") {
            $resultado = $sql;
        }

        mysqli_close($conexion);

        return $resultado;
    }

    //INICIO - Funciones para setear las variables de conexión de BBDD
    public static function getDb_host() {
        return self::$db_host;
    }

    public static function getDb_user() {
        return self::$db_user;
    }

    public static function getDb_pass() {
        return self::$db_pass;
    }

    public static function getDb_name() {
        return self::$db_name;
    }

    public static function setDb_host($db_host): void {
        self::$db_host = $db_host;
    }

    public static function setDb_user($db_user): void {
        self::$db_user = $db_user;
    }

    public static function setDb_pass($db_pass): void {
        self::$db_pass = $db_pass;
    }

    public static function setDb_name($db_name): void {
        self::$db_name = $db_name;
    }

    //FIN - Funciones para setear las variables de conexión de BBDD

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
