<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="faqModal" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title" id="modalLabel">¿Cómo funciona?</h4>
		</div>
			<div class="modal-body">
				  Esta aplicación es una pequeña API REST con interfaz web para lanzar las peticiones. Se puede observar el CRUD de cada uno de los objetos necesarios para la prueba. Se ha implementado paginación en las tablas
				  usando una pequeña librería js de Datatables de Bootstrap.</br>
				  La interfaz gráfica es responsive gracias a Bootstrap 5.</br></br>
				  Toda la aplicación utiliza javascript puro para lanzar las peticiones a la capa REST, no obstante se puede usar POSTMAN o similares para lanzar peticiones directas contra la capa REST y que nos devuelva los datos.
				  Se controlan los parámetros obligatorios tanto a nivel javascript como dentro de la API antes de llamar al DAO, para evitar que se produzcan errores.</br></br>
				  
				  Los test de la aplicación estan montados siguiendo el framework de PHP Unit para realizar asserts y mock si es necesario.</br></br>
				  En esta primera instancia ejecuta todas o la mayoría de las funciones de la API lanzando peticiones,
				  pero modifica los parámetros de conexion de BBDD para trabajar sobre una de prueba. Si la app se va escalando, sería necesario implementar transaccionalidad para no llegar a BBDD y poder probar la funcionalidad de una forma
				  más directa.</br></br>
				  
				  Un saludo,</br>
				  
				  José López
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
