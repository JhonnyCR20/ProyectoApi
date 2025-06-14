<?php

    require_once '../../controller/ClientesController.php';

    $controller = new ClientesController();

    $clientes = $controller->obtenerDatos();

    //print_r($clientes);

?>

<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
     
    <div
        class="container"
    >
        <h1>Lista Clientes</h1>

            <!-- Button trigger modal -->
            <button
                type="button"
                class="btn btn-primary btn-lg"
                data-bs-toggle="modal"
                data-bs-target="#modalId"
            >
                Nuevo
            </button>

        <div
            class="table-responsive"
        >
            <table
                class="table table-primary"
            >

                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">nombre</th>
                        <th scope="col">apellidos</th>
                        <th scope="col">telefono</th>
                    </tr>
                </thead>
                <tbody>

<!-- $clientes -->
<!-- public $id ;    
    public $nombre ;
    public $apellidos ;
    public $telefono ; -->

            <?php

                foreach ($clientes as $key ) {
                    # code...
                    //print_r($key);
                    // echo '
                    //     <tr class="">
                    //         <td scope="row">$key->id</td>
                    //         <td>R1C2</td>
                    //         <td>R1C3</td>
                    //         <td>R1C3</td>
                    //     </tr>';


                    echo "
                        <tr class=''>
                            <td scope='row'>$key->id</td>
                            <td>$key->nombre</td>
                            <td>$key->apellidos</td>
                            <td>$key->telefono</td>
                        </tr>";

                }



            ?>

                   
                </tbody>
            </table>
        </div>
        
    </div>
    


<!-- Modal -->
<div
    class="modal fade"
    id="modalId"
    tabindex="-1"
    role="dialog"
    aria-labelledby="modalTitleId"
    aria-hidden="true"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    Modal title
                </h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
<form method="post" action="../../controller/ClientesController.php">
    <div class="mb-3">
        <label for="" class="form-label">Nombre</label>
        <input
            type="text"
            class="form-control"
            name="nombre"
            id="nombre"
            aria-describedby="helpId"
            placeholder=""
            required
        />
        <small id="helpId" class="form-text text-muted">Help text</small>
    </div>
    
    <div class="mb-3">
        <label for="" class="form-label">Apellidos</label>
        <input
            type="text"
            class="form-control"
            name="apellidos"
            id="apellidos"
            aria-describedby="helpId"
            placeholder=""
            required
        />
        <small id="helpId" class="form-text text-muted">Help text</small>
    </div>
    

    <div class="mb-3">
        <label for="" class="form-label">Telefono</label>
        <input
            type="text"
            class="form-control"
            name="telefono"
            id="telefono"
            aria-describedby="helpId"
            placeholder=""
            required
        />
        <small id="helpId" class="form-text text-muted">Help text</small>
    </div>
        
                <div
                    class="row justify-content-center align-items-center g-2"
                >
                    <div class="col">
                        
                <button
                    type="reset"
                    class="btn btn-danger"
                >
                    Reset
                </button>
                
                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Enviar
                </button>
                

                    </div>

                </div>
                

</form>
                </div>
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                >
                    Close
                </button>                
            </div>
        </div>
    </div>
</div>

<script>
    var modalId = document.getElementById('modalId');

    modalId.addEventListener('show.bs.modal', function (event) {
          // Button that triggered the modal
          let button = event.relatedTarget;
          // Extract info from data-bs-* attributes
          let recipient = button.getAttribute('data-bs-whatever');

        // Use above variables to manipulate the DOM
    });
</script>





        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
