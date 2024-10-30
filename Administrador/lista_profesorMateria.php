<?php
require_once 'includes/header.php';
require_once 'includes/modals/modal_profesor_materia.php';
?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="bi bi-speedometer"></i>Asignaciones de los Maestros</h1>
          <button class="btn btn-success" type="button" onclick="ModalProfesorMateria()">Nueva Asignacion</button>

        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
          <li class="breadcrumb-item"><a href="#">Lista de Asignaciones</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
          <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tableProfesorMateria" Name="tableProfesorMateria">
                  <thead>
                    <tr>
                      <th>ACCIONES</th>
                      <th>ID</th>
                      <th>MAESTRO ASIGNADO</th>
                      <th>GRADO</th>
                      <th>SECCION</th>
                       <th>MATERIA</th>
                      <th>PERIODO</th>
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