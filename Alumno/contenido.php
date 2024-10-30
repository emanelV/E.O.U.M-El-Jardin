<?php
if(!empty($_GET['curso'])){
  $curso = $_GET['curso']; 

}else{
  header("Location: Alumno/"); 
}

        require_once 'includes/header.php';
        require_once '../includes/conexion.php';
        require_once '../includes/funciones.php';

        $id_alumno = $_SESSION['alumno_id']; 

        $sql = "SELECT * FROM contenidos as c INNER JOIN procesoprofesor as pm ON c.pm_id = pm.pm_id WHERE pm.pm_id = $curso"; 
        $query = $conn->prepare($sql);
        $query->execute();
        $row = $query->rowCount();
?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="bi bi-speedometer"></i>Mis Contenidos</h1>

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
                        <p><a class="btn btn-warning icon-btn" href="evaluacion.php?curso=<?= 
                      $data['pm_id']; ?>&contenido=<?= $data['contenido_id']; ?>"><i class="fa fa-edit"></i> Ver actividades</a></p>
                      </div>
                      <div class="title-body">
                          <b><?= $data['descripcion']; ?></b>
                      </div>
                      <div class="title-footer mt-4">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-download"></i></div>
                          </div>
                          <a class="btn btn-primary btn-sm" href="BAS_URL<?= $data['material']; ?>" target="_blank">Material de descarga</a>

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
