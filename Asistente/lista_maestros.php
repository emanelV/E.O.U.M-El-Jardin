<?php
require_once 'includes/header.php';
require_once 'includes/modals/modals-maestro.php';
?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="bi bi-speedometer"></i>Lista de maestros</h1>
          <button class="btn btn-success" type="button" onclick="ModalMaestro()">Nuevo Maestro</button>

        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
          <li class="breadcrumb-item"><a href="#">Lista de Maestros</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
          <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tb_maestros" Name="tb_maestros">
                  <thead>
                    <tr>
                      <th>ACCIONES</th>
                      <th>ID</th>
                      <th>NOMBRES</th>
                      <th>APELLIDOS</th>
                      <th>DIRECCION</th>
                       <th>DPI</th>
                      <th>TELEFONO</th>
                      <th>CORREO:</th>
                      <th>ACTIVO</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
    </main>

<?php
require_once 'includes/footer.php';
?>