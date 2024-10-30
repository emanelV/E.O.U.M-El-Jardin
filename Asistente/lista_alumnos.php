<?php
require_once'includes/header.php';
require_once 'includes/modals/modal-alumno.php';
?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="bi bi-speedometer"></i>Lista de Alumnos</h1>
          <button class="btn btn-success" type="button" onclick="ModalAlumno()">Inscribir Alumno</button>

        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
          <li class="breadcrumb-item"><a href="#">Lista de Alumnos</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
          <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tb_alumnos" Name="tb_alumnos">
                  <thead>
                      <th>ACCIONES</th>
                      <th>ID</th>
                      <th>CODIGO PERSONAL</th>
                      <th>APELLIDOS</th>
                      <th>NOMBRE</th>
                       <th>DIRECCION</th>
                       <th>ESTADO</th>
                      <th>ENCARGADO</th>
                      <th>APELLIDOS</th>
                      <th>TELEFONO</th>
                      <th>PARENTESCO</th>
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
require_once'includes/footer.php';
?>