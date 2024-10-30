<?php
require_once '../../../includes/conexion.php';

$sql = 'SELECT * FROM procesoalumno as ap INNER JOIN alumnos as a ON ap.alumno_id = a.alumno_id 
INNER JOIN procesoprofesor as pm ON ap.pm_id = pm.pm_id INNER JOIN aulas as au ON pm.aula_id = au.aula_id INNER JOIN
materias as m ON pm.materia_id = m.materia_id INNER JOIN periodos as pe ON ap.periodo_id = pe.periodo_id INNER JOIN grados as g on 
pm.grado_id = g.grado_id INNER JOIN profesor as p ON pm.profesor_id = p.profesor_id WHERE ap.estadop != 0';
$query = $conn->prepare($sql); 
$query->execute();  


$consu = $query->fetchAll(PDO::FETCH_ASSOC);

for($i = 0; $i < count($consu); $i++){
        if($consu[$i]['estadop'] == 1){
            $consu[$i]['estadop'] = '<span class="badge bg-success">Activo</span>';
    }else{
            $consu[$i]['estadop'] = '<span class="badge bg-danger">Inactivo</span>';
    }
    $consu[$i]['acciones'] = '
    <button class="btn btn-primary" title="Editar" onclick="editarAlumnoProfesor('.$consu[$i]['ap_id'].')">Editar</button> 
    <button class="btn btn-danger" title="Eliminar" onclick="eliminarAlumnoProfesor('.$consu[$i]['ap_id'].')">Eliminar</button>
    ';
}

echo json_encode($consu, JSON_UNESCAPED_UNICODE);

?>