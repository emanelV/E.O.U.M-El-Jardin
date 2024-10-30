<?php 

require_once 'includes/header.php'; 

?>




<main class="app-content">


  <div class="app-title">
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body d-flex justify-content-between align-items-center">
          <h5>Reporte de Alumnos</h5> 
          <a href="reportes/reporte_alumnos.php" class="btn btn-primary"><i class="fa-regular fa-file-excel icon-spacing"></i>Descargar</a> <!-- Botón que redirige -->
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body d-flex justify-content-between align-items-center">
          <h5>Reporte de Maestros</h5> 
          <a href="reportes/reporte_profesores.php" class="btn btn-primary"><i class="fa-regular fa-file-excel icon-spacing"></i>Descargar</a> <!-- Botón que redirige -->
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
      <h5>Generar Boleta de calificaciones</h5> 
        <div class="tile-body d-flex justify-content-between align-items-center">
        
            <select id="listAlumno" name="listAlumno" class="form-select" style="width: 300px; height: 50px;"  aria-label="Selecciona un Alumno">
            <!-- Agrega más opciones según tus alumnos -->
            </select>
            <button id="generatePDF" class="btn btn-danger"><i class="fa-regular fa-file-pdf icon-spacing"></i>Descargar</button>
        </div>
      </div>
    </div>
  </div>

</main>





<?php 
require_once 'includes/footer.php'; 
?>