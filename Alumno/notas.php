<?php

        require_once 'includes/header.php';
        require_once '../includes/conexion.php';

        $id_alumno = $_SESSION['alumno_id']; 

        $sqlc = "SELECT m.nombre_materia, SUM(n.valor_nota) AS suma_total_notas FROM notas AS n INNER JOIN env_entregadas AS ev_e ON n.ev_entregada_id = ev_e.ev_entregada_id INNER JOIN alumnos AS al ON ev_e.alumno_id = al.alumno_id INNER JOIN evaluaciones AS ev ON ev_e.evaluacion_id = ev.evaluacion_id INNER JOIN contenidos AS c ON ev.contenido_id = c.contenido_id INNER JOIN procesoprofesor AS pm ON c.pm_id = pm.pm_id INNER JOIN materias 
        AS m ON pm.materia_id = m.materia_id WHERE al.alumno_id = $id_alumno GROUP BY m.nombre_materia;"; 
        $queryc = $conn->prepare($sqlc);
        $queryc->execute();
        $rown = $queryc->rowCount();
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
                                <th>Materia</th>
                                <th>Punteo Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($rown > 0){
                                while($data = $queryc->fetch()){
                                    ?>
                                    <tr>
                                        <td><?= $data['nombre_materia'] ?></td>
                                        <td><?= $data['suma_total_notas'] ?></td>
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
