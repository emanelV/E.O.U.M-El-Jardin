<?php
if(!empty($_GET['curso'])){
  $curso = $_GET['curso']; 

}else{
  header("Location: Maestro/"); 
}

        require_once 'includes/header.php';
        require_once '../includes/conexion.php';

        $idprofesor = $_SESSION['ID_MAESTRO']; 

        $sqlc = "SELECT * FROM procesoalumno as ap INNER JOIN procesoprofesor as pm ON ap.pm_id = pm.pm_id INNER JOIN alumnos as al ON  ap.alumno_id = al.
        alumno_id WHERE pm.profesor_id = $idprofesor AND pm.pm_id = $curso GROUP BY al.alumno_id"; 
        $queryc = $conn->prepare($sqlc);
        $queryc->execute();
        $rowc = $queryc->rowCount();
?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="bi bi-speedometer"></i>Notas Ingresadas</h1>

        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
          <li class="breadcrumb-item"><a href="#">Notas Ingresadas</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="title-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Alumno</th>
                                <th>Apellidos</th>
                                <th>Ver Notas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($rowc > 0){
                                while($data = $queryc->fetch()){
                                    ?>
                                    <tr>
                                        <td><?= $data['nombre_alumno'] ?></td>
                                        <td><?= $data['apellidos_alumno'] ?></td>
                                        <td><a class="btn btn-primary btn-sm" title = "Ver calificaciones" href="list-notas.php?alumno=<?= $data['alumno_id'] ?>&curso=<?= $data['pm_id'] ?>">
                                        <i class="fas fa-list"></i>
                                    </a></td>
                                    </tr>
                            <?php }} ?>

                        </tbody>

                    </table>

                </div>

                </div>

            </div>


          </div>
        </div>
        <div class="row">
          <a href="index.php" class="btn btn-info" style="width:100px;"> <- Volver </a>

        </div>

    </main>

<?php
require_once 'includes/footer.php';
?>
