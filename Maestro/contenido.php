<?php
if(!empty($_GET['curso'])){
  $curso = $_GET['curso']; 

}else{
  header("Location: Maestro/"); 
}

        require_once 'includes/header.php';
        require_once '../includes/conexion.php';
        require_once '../includes/funciones.php';
        require_once 'includes/modals/modal-contenido.php';

        $idprofesor = $_SESSION['ID_MAESTRO']; 

        $sql = "SELECT * FROM contenidos as c INNER JOIN procesoprofesor as pm ON c.pm_id = pm.pm_id WHERE pm.pm_id = $curso"; 
        $query = $conn->prepare($sql);
        $query->execute();
        $row = $query->rowCount();
?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="bi bi-speedometer"></i>Contenidos</h1>
          <button class="btn btn-success" type="button" onclick="OpenModalContenido()">Nuevo Contenido</button>

        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
          <li class="breadcrumb-item"><a href="#">Lista de Contenidos</a></li>
        </ul>
      </div>
      <div class="row">
        <?php if($row >0 ){ 
          while($data = $query->fetch()){
          ?>
        <div class="col-md-12">
          <div class="tile">
          <div class="tile">
                      <div class="title-title-w-btn">
                        <h3 class="title"><?= $data ['titulo']; ?></h3>
                        <p><button class="btn btn-danger icon-btn me-2" onclick="eliminarContenido(<?= $data['contenido_id']; ?>)
                      "><i class="fa fa-trash icon-spacing"></i>Eliminar Contenido</button><a class="btn btn-warning icon-btn" href="evaluacion.php?curso=<?= 
                      $data['pm_id']; ?>&contenido=<?= $data['contenido_id']; ?>"><i class="fa fa-edit"></i>Asignar Tarea</a></p>
                      </div>
                      <div class="title-body">
                          <b><?= $data['descripcion']; ?></b>
                      </div>
                      <div class="title-footer mt-4">
                        <div class="input-group">
                        <?php if(!empty($data['material'])) { ?>
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-download"></i></div>
                          </div>
                          
                          <a class="btn btn-primary btn-sm" href="BASE_URL<?= $data['material']; ?>" target="_blank">Material de descarga</a>
                          <?php } else { ?>
                                    <button class="btn btn-primary btn-sm" onclick="Swal.fire({
                                        title: 'Sin archivo disponible',
                                        text: 'Este contenido no tiene material cargado.',
                                        icon: 'warning',
                                        confirmButtonText: 'Entendido'
                                            });">
                            <i class="fas fa-download"></i> Material no disponible
                                  </button>
                                  <?php } ?>
                        </div>
                      </div>
                      </div>
          </div>
          </div>
          <?php }} ?>
        
        </div>
      
        <div class="row">
          <a href="index.php" class="btn btn-info" style="width:100px;"> <- Volver </a>

        </div>
    </main>

<?php
require_once 'includes/footer.php';
?>
