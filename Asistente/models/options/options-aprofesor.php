

<?php

require_once '../../../includes/conexion.php';

$sql = 'SELECT * FROM procesoprofesor as pm INNER JOIN profesor as p ON pm.profesor_id = p.profesor_id 
INNER JOIN grados as g ON pm.grado_id = g.grado_id INNER JOIN aulas as a ON pm.aula_id = a.aula_id INNER JOIN
materias as m ON pm.materia_id = m.materia_id INNER JOIN periodos as pe ON pm.proceso_id = pe.periodo_id
WHERE pm.estadopm = 1';
$query = $conn-> prepare($sql);
$query->execute();
$data = $query->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data, JSON_UNESCAPED_UNICODE);






