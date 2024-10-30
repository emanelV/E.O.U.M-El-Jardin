<!-- Sidebar menu-->
 <?php
 require_once '../includes/conexion.php';

 $id_alumno = $_SESSION['alumno_id']; 
 $sql = "SELECT * FROM procesoalumno as ap INNER JOIN alumnos as al ON ap.alumno_id = al.alumno_id INNER JOIN procesoprofesor as pm ON ap.pm_id = pm.pm_id
 INNER JOIN grados as g ON pm.grado_id = g.grado_id INNER JOIN aulas as a ON pm.aula_id = a.aula_id INNER JOIN profesor as p ON pm.profesor_id = p.profesor_id
 INNER JOIN materias as m ON pm.materia_id = m.materia_id WHERE al.alumno_id = $id_alumno"; 

$query = $conn->prepare($sql);
$query->execute();
$row = $query->rowCount();


 ?>
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user">
        <div>
        <p class="app-sidebar__user-name"><?= $_SESSION['nombre_enc'];?></p>
        <p class="app-sidebar__user-name"><?= $_SESSION['apellidos_enc'];?></p>
          <p class="app-sidebar__user-designation">Encargado</p>
        </div>
      </div>
      <div class="app-sidebar__user">
        <div>
        <p class="app-sidebar__user-name"><?= $_SESSION['nombre_alumno'];?></p>
        <p class="app-sidebar__user-name"><?= $_SESSION['apellidos_alumno'];?></p>
          <p class="app-sidebar__user-designation">Alumno</p>
        </div>
      </div>
      <ul class="app-menu">
      <li><a class="app-menu__item" href="index.php"><i class="fa-solid fa-house-user icon-spacing"></i><span class="app-menu__label">Inicio</span></a></li>
        <li class="treeview">
          <a class="app-menu__item" href="#" data-toggle="treeview">
          <i class="app-menu__icon fa fa-laptop"></i>
          <span class="app-menu__label">Mis Cursos</span>
          <i class="treeview-indicator fa fa-angle-right"></i>
          </a>
          <ul class="treeview-menu">
            <?php if($row > 0){
              while($data = $query->fetch()){
              ?>
              <li><a class="treeview-item" href="contenido.php?curso=<?= $data['pm_id'] ?>"><i class=""></i>
              <?= $data['nombre_materia']; ?> - <?= $data ['nombre_grado']; ?> - <?= $data['nombre_aula']; ?></a></li>

            <?php }} ?>

          </ul>
          <li><a class="app-menu__item" href="notas.php"><i class="fa-solid fa-award icon-spacing"></i><span 
          class="app-menu__label">Notas</span></a></li>
        </li>
        

        <li><a class="app-menu__item" href="../salir.php"><i class="fa-solid fa-circle-xmark icon-spacing"></i><span class="app-menu__label">salir</span></a></li>
      </ul>
    </aside>