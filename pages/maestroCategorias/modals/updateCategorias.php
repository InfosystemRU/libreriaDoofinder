<div class="modal fade" id="updateCategoria">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Añadir Categoría</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="input-group mb-3">
                        <span class="input-group-text" >Nombre</span>
                        <input type="text" class="form-control" id="updateCategoriaNombre" placeholder="Inserta un nombre..." required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Descripcion (Opcional)</span>
                        <input type="text" class="form-control"  id="updateCategoriaDescripcion" placeholder="">
                    </div>
                    <button type="submit" class="btn btn-dark" onclick="createOne()" id="updateCategoriaSubmit">Crear</button>
                </form>
            </div>
        </div>
    </div>
</div>