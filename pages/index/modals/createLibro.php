<div class="modal fade" id="createLibro">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Añadir Libro</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="input-group mb-3">
                        <span class="input-group-text" >Título</span>
                        <input type="text" class="form-control" id="newLibroTitulo" placeholder="Inserta un título..." required>
                    </div>
                    <p class="alert-danger" id="newLibroTituloP"></p>
                    <div class="input-group mb-3">
                        <span class="input-group-text">ISBN</span>
                        <input type="text" class="form-control"  id="newLibroIsbn" placeholder="ESXXXXXXXX" required aria-label="isbn">
                    </div>
                    <p class="alert-danger" id="newLibroIsbnP"></p>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Descripción</span>
                        <textarea class="form-control" id="newLibroDescripcion"aria-label="Descripción" required></textarea>
                    </div>
                    <p class="alert-danger" id="newLibroDescripcionP"></p>
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" >Autor</span>
                        <select id="newLibroAutor" required>
                        </select>
                    </div>
                    <p class="alert-danger" id="newLibroAutorP"></p>
                    <label class="form-label" for="customFile">Categorías:</label><br>
                    <div class="input-group mb-3 form-check" id="newLibroCategorias" required>
                    </div>
                    <p class="alert-danger" id="newLibroCategoriasP"></p>
                </form>
                <button type="" class="btn btn-dark" onclick="createOne()">Crear</button>
            </div>
        </div>
    </div>
</div>