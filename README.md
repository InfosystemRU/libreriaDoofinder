# libreriaDoofinder
API REST con capa amigable de bootstrap para lanzar peticiones JS al REST y gestionar un CRUD de libros

Para probar la app en local es necesario:
 - Instalacion de XAMPP o similar para poder tener un servidor Apache en local
 - Colocar los archivos de la app en la ubicación del servidor (C:/xampp/htdocs en Windows)
 - Tener un servidor MySQL local y importar el archivo BBDD/libreriadoofinder.sql
 - Crear un usuario para esa base de datos, los parametros preestablecidos en la app estan en DAO/genericoDao (user: localhost, pass: localhost).

En este momento se pueden hacer pruebas ya en local de la app, pero no es necesario puesto que se encuentra alojada en el servidor hosting:
 - https://libreriaacceso.000webhostapp.com
 
Para lanzar peticiones desde POSTMAN o similar a la capa REST de la App se puede usar directamente la url del servidor de hosting:
 - https://libreriaacceso.000webhostapp.com/rest/autoresRest.php --> Crud de autores
 - https://libreriaacceso.000webhostapp.com/rest/categoriasRest.php --> Crud de categorias
 - https://libreriaacceso.000webhostapp.com/rest/librosRest.php --> Crud de libros
 
 Se pueden lanzar peticiones del tipo:
 
 {
  "accion": "findAll"
 }
 
 Esto devolvería, dependiendo del rest, toda la información de los autores, cateogiras o libros.
