<div class="modal fade" id="createAutor">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Añadir Autor</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="input-group mb-3">
                        <span class="input-group-text" >Nombre</span>
                        <input type="text" class="form-control" id="newAutorNombre" placeholder="Inserta un nombre..." required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Pseudonimo (Opcional)</span>
                        <input type="text" class="form-control"  id="newAutorPseudonimo" placeholder="J.K" aria-label="isbn">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Nacimiento</span>
                        <input type="date" class="form-control"  id="newAutorNacimiento" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Muerte</span>
                        <input type="date" class="form-control"  id="newAutorMuerte">
                    </div>
                    <button type="submit" class="btn btn-dark" onclick="createOne()">Crear</button>
                </form>
            </div>
        </div>
    </div>
</div>