<?php
if(!empty($_GET['curso']) || !empty($_GET['alumno'])){
  $curso = $_GET['curso']; 
  $alumno = $_GET['alumno'];

}else{
  header("Location: Maestro/"); 
}

        require_once 'includes/header.php';
        require_once '../includes/conexion.php';
        require_once '../includes/funciones.php';

        $idprofesor = $_SESSION['ID_MAESTRO']; 

        $sql = "SELECT * FROM notas as n INNER JOIN env_entregadas  as ev_e ON n.ev_entregada_id = ev_e.ev_entregada_id INNER JOIN alumnos as al ON ev_e.alumno_id = 
        al.alumno_id INNER JOIN evaluaciones as ev ON ev_e.evaluacion_id = ev.evaluacion_id INNER JOIN contenidos as c ON ev.contenido_id = c.contenido_id 
        INNER JOIN procesoprofesor as pm on c.pm_id = pm.pm_id where al.alumno_id = $alumno and pm.pm_id = $curso"; 
        $query = $conn->prepare($sql);
        $query->execute();
        $row = $query->rowCount();
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
                                <th>Actividad</th>
                                <th>Nota</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($row > 0){
                                while($data = $query->fetch()){
                                    ?>
                                    <tr>
                                        <td><?= $data['titulo_eva'] ?></td>
                                        <td><?= $data['valor_nota'] ?></td>
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
            <div class="col-lg-12">
                <div class="bs-component">
                    <ul class="list-group">
                        <li class="list-group-item"><span class="tag tag-default tag-pill float-xs-rigth">
                            <strong>TOTAL: <?= formatoNota(promedio($alumno,$curso)); ?></strong>
                        </span>
                            
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row mt-3">
          <a href="notas.php?curso=<?= $curso; ?>" class="btn btn-info" style="width:100px;"> <- Volver </a>

        </div>

    </main>

<?php
require_once 'includes/footer.php';
?>