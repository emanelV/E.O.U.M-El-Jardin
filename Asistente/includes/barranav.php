<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user">
        <div>
          <p class="app-sidebar__user-name"><?= $_SESSION['Nombre'];?></p>
          <p class="app-sidebar__user-designation"><?=  $_SESSION['Nombre_rol']?></p>
        </div>
      </div>
        <ul class="app-menu">
        <li><a class="app-menu__item" href="lista_maestros.php"><i class="fa-solid fa-chalkboard-user icon-spacing"></i><span 
        class="app-menu__label">Maestros</span></a></li>
        <li><a class="app-menu__item" href="lista_alumnos.php"><i class="fa-solid fa-graduation-cap icon-spacing"></i><span 
        class="app-menu__label">Alumnos</span></a></li>
        <li><a class="app-menu__item" href="lista_grados.php"><i class="fa-solid fa-cubes icon-spacing icon-spacing"></i><span 
        class="app-menu__label">Grados</span></a></li>
        <li><a class="app-menu__item" href="lista_materias.php"><i class="fa-solid fa-clipboard icon-spacing"></i><span 
        class="app-menu__label">Materias</span></a></li>
        <li><a class="app-menu__item" href="lista_periodos.php"><i class="fa-solid fa-calendar icon-spacing"></i><span 
        class="app-menu__label">Periodos</span></a></li>


        
        <li><a class="app-menu__item" href="../Salir.php"><i class="fa-solid fa-circle-xmark icon-spacing"></i><span 
        class="app-menu__label">Salir</span></a></li>
      </ul>
    </aside>