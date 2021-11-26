<div class="modal fade" id="updateLibro">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Actualizar Libro</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="input-group mb-3">
                        <span class="input-group-text" >Título</span>
                        <input type="text" class="form-control" id="updateLibroTitulo" placeholder="Inserta un título..." required>
                    </div>
                    <p class="alert-danger" id="updateLibroTituloP"></p>
                    <div class="input-group mb-3">
                        <span class="input-group-text">ISBN</span>
                        <input type="text" class="form-control"  id="updateLibroIsbn" placeholder="ESXXXXXXXX" required aria-label="isbn">
                    </div>
                    <p class="alert-danger" id="updateLibroIsbnP"></p>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Descripción</span>
                        <textarea class="form-control" id="updateLibroDescripcion"aria-label="Descripción" required></textarea>
                    </div>
                    <p class="alert-danger" id="updateLibroDescripcionP"></p>
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" >Autor</span>
                        <select id="updateLibroAutor" required>

                        </select>
                    </div>
                    <p class="alert-danger" id="updateLibroAutorP"></p>
                    <label class="form-label" for="customFile">Categorías:</label><br>
                    <div class="input-group mb-3 form-check" id="updateLibroCategorias" required>
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1"> Categoria 1</label>     
                    </div>
                    <p class="alert-danger" id="updateLibroCategoriasP"></p>
                </form>
                <button type="" class="btn btn-dark" id="updateLibroSubmit" onclick="">Crear</button>
            </div>
        </div>
    </div>
</div>