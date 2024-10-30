<?php
if(!empty($_GET['curso'])){
  $curso = $_GET['curso']; 

}else{
  header("Location: Maestro/"); 
}

        require_once 'includes/header.php';
        require_once '../includes/conexion.php';

        $idprofesor = $_SESSION['ID_MAESTRO']; 

        $sql = "SELECT * FROM procesoalumno as ap INNER JOIN procesoprofesor as pm ON ap.pm_id = pm.pm_id 
        INNER JOIN alumnos as a ON ap.alumno_id = a. alumno_id INNER JOIN encargado as e ON e.alumno_id = a.alumno_id 
        where pm.pm_id = $curso"; 
        $query = $conn->prepare($sql);
        $query->execute();
        $row = $query->rowCount();
?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="bi bi-speedometer"></i>Lista de alumnos</h1>

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
                <table class="table table-hover table-bordered" id="tableactividades" Name="tablealumnos">
                  <thead>
                    <tr>
                      <th>NOMBRE</th>
                      <th>APELLIDOS</th>
                      <th>CODIGO PERSONAL</th>
                      <th>ENCARGADO</th>
                      <th>APELLIDOS</th>
                      <th>TELEFONO</th>
                      <th>ULTIMO ACCESO AL SISTEMA</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php if($row >0 ){ 
                        while($data = $query->fetch()){
                            $codalumno = $data['alumno_id'];
                            $sql_acceso = "SELECT u_acceso FROM alumnos where alumno_id = $codalumno";
                            $query_acceso = $conn->prepare($sql_acceso);
                            $query_acceso->execute();
                            $res_acceso = $query_acceso->fetch();   

                            ?>

                                <tr>
                                    <td><?= $data['nombre_alumno'] ?></td>
                                    <td><?= $data['apellidos_alumno'] ?></td>
                                    <td><?= $data['cod_personal'] ?></td>
                                    <td><?= $data['nombre_enc'] ?></td>
                                    <td><?= $data['apellidos_enc'] ?></td>
                                    <td><?= $data['telefono_enc'] ?></td>
                                    <td>
                                        <?php

                                        if($res_acceso['u_acceso']== null){
                                            echo '<kbd class="badge badge-danger">Nunca</kbd>';
                                        }else{
                                            echo $res_acceso['u_acceso'];
                                        }

                                        ?>

                                    </td>
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
