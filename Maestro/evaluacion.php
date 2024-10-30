<?php
if(!empty($_GET['curso']) || empty($_GET['contenido'])){
  $curso = $_GET['curso']; 
  $contenido = $_GET['contenido'];

}else{
  header("Location: Maestro/"); 
}

        require_once 'includes/header.php';
        require_once '../includes/conexion.php';
        require_once 'includes/modals/modal-evaluacion.php';

        $idprofesor = $_SESSION['ID_MAESTRO']; 

        $sql = "SELECT *, date_format(fecha, '%d/%m/%y') as fecha FROM evaluaciones where contenido_id = $contenido"; 
        $query = $conn->prepare($sql);
        $query->execute();
        $row = $query->rowCount();
?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="bi bi-speedometer"></i>Asignar Actividad</h1>
          <button class="btn btn-success" type="button" onclick="OpenModalEvaluacion()">Crear nueva actividad</button>

        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
          <li class="breadcrumb-item"><a href="#">Asignar Actividad</a></li>
        </ul>
      </div>
      <div class="row">
        <?php if($row >0 ){ 
          while($data = $query->fetch()){
          ?>
        <div class="col-md-12">
          <div class="tile">
                      <div class="title-title-w-btn">
                        <h3 class="title"><?= $data ['titulo_eva']; ?></h3>
                        <p><button class="btn btn-info icon-btn me-2" onclick="editarEvaluacion(<?= $data['evaluacion_id']; ?>)"><i class="fa fa-edit"></i>
                      Editar Actividad</button> <button class="btn btn-danger icon-btn me-2" onclick="eliminarEvaluacion(<?= $data['evaluacion_id']; ?>)
                      "><i class="fa fa-trash"></i>Eliminar Actividad</button> <a class="btn btn-warning icon-btn" href="entregas.php?curso=<?=$curso; 
                      ?>&contenido=<?= $data['contenido_id']; ?>&eva=<?= $data['evaluacion_id']; ?>"><i class="fa fa-edit"></i>
                      Calificar Actividad</a></p>
                      </div>
                      <div class="title-body">
                          <b><?= $data['descripcion']; ?></b><br><br>
                          <b>Fecha: <kbd class="bg-info"><?= $data['fecha']; ?></kbd></b><br><br>
                          <b>Valor: <?= $data['porcentaje']; ?></b><br><br>
                      </div>
                      </div>


          </div>
          <?php }} ?>
        </div>
        <div class="row">
          <a href="contenido.php?curso=<?= $curso ?>" class="btn btn-info" style="width:100px;"> <- Volver </a>

        </div>

    </main>

<?php
require_once 'includes/footer.php';
?>
