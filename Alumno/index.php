<?php
require_once 'includes/header.php'; 
require_once '../includes/conexion.php';

$id_alumno = $_SESSION['alumno_id']; 
$sql = "SELECT * FROM procesoalumno as ap INNER JOIN alumnos as al ON ap.alumno_id = al.alumno_id INNER JOIN procesoprofesor as pm ON ap.pm_id = pm.pm_id
INNER JOIN grados as g ON pm.grado_id = g.grado_id INNER JOIN aulas as a ON pm.aula_id = a.aula_id INNER JOIN profesor as p ON pm.profesor_id = p.profesor_id
INNER JOIN materias as m ON pm.materia_id = m.materia_id WHERE al.alumno_id = $id_alumno"; 

$query = $conn->prepare($sql);
$query->execute();
$row = $query->rowCount();

?>

    <main class="app-content">
      <div class="row">
        <div class="col-md-12 text-center border shadow p-2 bg-secondary text-white">
            <h5>Escuela Oficial Urbana Mixta El Jardin, Coatepeque</h5>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-center border mt-2 p-1 bg-light">
          <h4>Mis Cursos</h4>
        </div>
      </div>
      <div class="row">
        <?php
        if($row>0){
          while($data = $query->fetch()){ 
        ?>
          <div class="col-md-3 text-center border mt-3 p-2 bg-light">
            <div class="card m-3 shadow" style="width: 18rem;">
              <img src="../images/logeljardin.jpg" class="card-img-top" alt="...">
               <h4 class="card-title text-center"><?= $data['nombre_materia'] ?></h4>
               <div class="card-body">
               <h5 class="card-title">Grado: <kbd class="bg-info"><?= $data['nombre_grado'] ?></kbd> - Seccion: <kbd class="bg-info">
                <?= $data['nombre_aula'] ?></kbd></h5>
                <a href="contenido.php?curso=<?= $data ['pm_id'] ?>" class="btn btn-secondary">Acceder</a>

             </div>
            </div>
          </div>
        <?php } } ?>
      </div>



    </main>
<?php
require_once 'includes/footer.php'; 
?>