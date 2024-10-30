<?php
require_once '../../../includes/conexion.php';

$sql = 'SELECT * FROM procesoprofesor as pm INNER JOIN profesor as p ON pm.profesor_id = p.profesor_id 
INNER JOIN grados as g ON pm.grado_id = g.grado_id INNER JOIN aulas as a ON pm.aula_id = a.aula_id INNER JOIN
materias as m ON pm.materia_id = m.materia_id INNER JOIN periodos as pe ON pm.proceso_id = pe.periodo_id
WHERE pm.estadopm != 0';
$query = $conn->prepare($sql); 
$query->execute();  


$consu = $query->fetchAll(PDO::FETCH_ASSOC);

for($i = 0; $i < count($consu); $i++){
        if($consu[$i]['estadopm'] == 1){
            $consu[$i]['estadopm'] = '<span class="badge bg-success">Activo</span>';
    }else{
            $consu[$i]['estadopm'] = '<span class="badge bg-danger">Inactivo</span>';
    }
    $consu[$i]['acciones'] = '
    <button class="btn btn-primary" title="Editar" onclick="editarProfesorMateria('.$consu[$i]['pm_id'].')">Editar</button> 
    <button class="btn btn-danger" title="Eliminar" onclick="eliminarProfesorMateria('.$consu[$i]['pm_id'].')">Eliminar</button>
    ';
}

echo json_encode($consu, JSON_UNESCAPED_UNICODE);

?>