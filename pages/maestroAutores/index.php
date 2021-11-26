<!doctype html>
<html lang="en">
    <?php
    include_once '../common-components/header-links.php';
    include_once '../common-components/navbar.php';
    include_once './modals/createAutor.php';
    include_once './modals/updateAutor.php';
	include_once '../common-components/modal-faq.php';
    ?>
    <body>
        <main class="container">
            <div class="row mt-3">
                <h1>Gestión de Autores</h1>
                <div class="row ">
                    <div class="col-md-12 ">
                        <button class="btn btn-success right" data-bs-toggle="modal" data-bs-target="#createAutor" onclick="updateModalCreate()">
                            <span class="material-icons inline-icon">add</span>
                            Añadir autor
                        </button>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="bg-light p-5 rounded table-responsive">
                        <table class="table" id="tableAutores">
                            <thead>
                            <th>Nombre</th>
                            <th>Pseudonimo</th>
                            <th>Nacimiento</th>
                            <th>Muerte</th>
                            <th>Acciones</th>
                            </thead>
                            <tbody id="tbodyAllAutores">
                            </tbody>
                        </table>
                    </div>
                </div>
        </main>
	</body>
</html>
