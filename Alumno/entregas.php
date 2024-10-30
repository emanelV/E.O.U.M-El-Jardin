<?php 
if (!empty($_GET['curso']) || !empty($_GET['contenido'])){

    $curso = $_GET['curso']; 
    $contenido = $_GET['contenido']; 
    $evaluacion = $_GET['eva']; 
    }else{ 
        header("Location: Alumno/"); 
    }

    require_once 'includes/header.php'; 
    require_once '../includes/conexion.php';

    $id_alumno = $_SESSION['alumno_id']; 

    $sqla = "SELECT * FROM env_entregadas as ev INNER JOIN alumnos as a ON ev.alumno_id = a.alumno_id INNER JOIN evaluaciones as eva ON ev.evaluacion_id = eva.
    evaluacion_id INNER JOIN contenidos as c ON eva.contenido_id = c.contenido_id WHERE ev.evaluacion_id = ? and a.alumno_id = ?"; 
    $querya = $conn->prepare($sqla); 
    $querya->execute(array($evaluacion,$id_alumno)); 
    $rowa = $querya->rowCount(); 

    date_default_timezone_set("America/Guatemala"); 
    $fecha = date('Y-m-d'); 

    $sqlf = "SELECT * FROM evaluaciones where contenido_id = $contenido AND evaluacion_id = $evaluacion "; 
    $queryf = $conn->prepare($sqlf); 
    $queryf->execute(); 
    $result = $queryf->fetch(); 
    $fechaLimite = $result['fecha']; 

    ?>

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="bi bi-speedometer"></i>Entregar Actividad</h1>

        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
          <li class="breadcrumb-item"><a href="#"> Ver Actividad</a></li>
        </ul>
      </div>
        <?php if($rowa >0 ){ 
          while($data = $querya->fetch()){
            $valor = ''; 
            $calificacion = ''; 
            $ev_entregada = $data['ev_entregada_id']; 

            $sqln = "SELECT *FROM notas as n INNER JOIN env_entregadas as ev ON n.ev_entregada_id = ev.ev_entregada_id INNER JOIN alumnos as a ON ev.
            alumno_id = a.alumno_id where n.ev_entregada_id = $ev_entregada AND a.alumno_id = $id_alumno"; 
            $queryn = $conn->prepare($sqln); 
            $queryn->execute(); 
            $datan = $queryn->rowCount(); 
            $nota = $queryn->fetch(); 
            if($datan>0){
                $valor = '<kbd class="bg-success">Calificado</kbd>'; 
                $calificacion = $nota['valor_nota']; 
            }else{
                $valor = '<kbd class="bg-danger">Sin calificar</kbd>'; 
                $calificacion = ''; 
            }

            }
          ?>
                <div class="row mt-2 bg-success text-white p-3 text-center">
                    <h3>Entrega realizada con éxito</h3>
                </div>

                <div class="row mt-4">
                    <table class="table table-bordered text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Estado</th>
                                <th scope="col">Calificación</th>
                            </tr>
                        </thead>
                            <tbody>
                            <tr>
                                <td><span class="badge badge-info p-2"><?= $valor; ?></span></td>
                                <td><span class="badge badge-warning p-2" style="background-color: black; color: white;"><?= $calificacion; ?></span></td>
                            </tr>
                            </tbody>
                     </table> 
                    </div>




          <?php }else{ ?>
            <?php if($fecha < $fechaLimite){ ?>
                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="tile">
                            <h3 class="tile-title">Realizar Entrega</h3>
                            <div class="tile-body">
                                <form class="form-horizontal" id = "formEntrega" name =  "formEntrega" enctype="multipart/form-data"> 
                                    <input type="hidden" name="idevaluacion" id="idevaluacion" value="<?= $evaluacion; ?>">
                                    <input type="hidden" name="idalumno" id="idalumno" value="<?= $id_alumno; ?>">
                                    <div class="mb-3 row">
                                    <label class="form-label col-md-3">Descripcion</label>
                                    <div class="col-md-8">
                                    <textarea class="form-control" name = "observacion" id = "observacion" rows="4" placeholder="Descripcion de la actividad"></textarea>
                                    </div>
                                    </div>
                                    <div class="mb-3 row">
                                    <label class="form-label col-md-3">Adjuntar actividad</label>
                                    <div class="col-md-8">
                                    <input type="file" class="form-control" name = "file" id ="file">
                                    </div>
                                    </div>
                                    <div class="tile-footer">
                                    <div class="row">
                                    <div class="col-md-8 col-md-offset-3">
                                    <button class="btn btn-primary" type="submit"><i class="fa-regular fa-circle-check icon-spacing"></i>Enviar</button>&nbsp;&nbsp;&nbsp;
                                    </div>
                                </div>
                                </div>

                                </form>
                            </div>
                    
                        </div>

                    </div>
                </div>





                <?php } else{ ?>
                    <div class="row bg-danger p-3 text-white text-center">
                        <h5><i class="fa-solid fa-circle-xmark icon-spacing"></i>Entrega no disponible. Fecha límite: <strong><?= $fechaLimite; ?></strong></h5>
                    </div>


                    <?php }?>
            <?php }?>

        <div class="row">
          <a href="contenido.php?curso=<?= $curso ?>&contenido=<?= $contenido ?>" class="btn btn-info mt-2" style="width:100px;"> <- Volver </a>

        </div>

    </main>

<?php
require_once 'includes/footer.php';
?>
