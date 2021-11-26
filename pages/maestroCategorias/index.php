<!doctype html>
<html lang="en">
    <?php
    include_once '../common-components/header-links.php';
    include_once '../common-components/navbar.php';
    include_once './modals/createCategorias.php';
    include_once './modals/updateCategorias.php';
	include_once '../common-components/modal-faq.php';
    ?>
    <body>
        <main class="container">
            <h1>Gestión de Categorias</h1>
            <div class="row ">
                <div class="col-md-12 ">
                    <button class="btn btn-success right" data-bs-toggle="modal" data-bs-target="#createCategoria" onclick="updateModalCreate()">
                        <span class="material-icons inline-icon">add</span>
                        Añadir Categoría
                    </button>
                </div>
            </div>
            <div class="row mt-3">
                <div class="bg-light p-5 rounded table-responsive">
                    <table class="table" id="tableCategorias">
                        <thead>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Acciones</th>
                        </thead>
                        <tbody id="tbodyAllCategorias">
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </body>
</html>
