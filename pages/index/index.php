<!doctype html>
<html lang="en">
    <?php
    include_once '../common-components/header-links.php';
    include_once '../common-components/navbar.php';
    include_once 'modals/createLibro.php';
    include_once 'modals/updateLibro.php';
	include_once '../common-components/modal-faq.php';
    ?>
    <body>
        <main class="container">
            <h1>Gestión de Libros</h1>
            <div class="row ">
                <div class="col-md-12 ">
                    <button class="btn btn-success right" data-bs-toggle="modal" data-bs-target="#createLibro" onclick="updateModalCreate()">
                        <span class="material-icons inline-icon">add</span>
                        Añadir libro
                    </button>
                </div>
            </div>
            <div class="row mt-3">
                <div class="bg-light p-5 rounded table-responsive">
                    <table class="table " id="tableLibros">
                        <thead>
                            <tr>
                                <th>Titulo</th>
                                <th>Descripción</th>
                                <th>Autor</th>
                                <th>Categoría</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbodyAllLibros">
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </body>
</html>
