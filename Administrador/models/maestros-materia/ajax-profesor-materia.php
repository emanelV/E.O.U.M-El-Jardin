<?php 
require_once '../../../includes/conexion.php'; 
if (!empty($_POST)) {
    if (empty($_POST['listProfesor']) || empty($_POST['listGrado']) || empty($_POST['listAula']) || empty($_POST['listMateria']) || empty($_POST['listPeriodo'])) {
        $respuesta = array('status' => false, 'msg' => 'Todos los campos son obligatorios');
    } else {
        $idprofesormateria = $_POST['idProfesorMateria'];
        $profesor = $_POST['listProfesor'];
        $grado = $_POST['listGrado'];
        $aula = $_POST['listAula'];
        $materia = $_POST['listMateria'];
        $periodo = $_POST['listPeriodo'];
        $status = $_POST['listEstado'];

        // Verificar si ya existe una asignación con los mismos profesor, grado, aula, materia y período
        $sql = 'SELECT * FROM procesoprofesor 
                WHERE profesor_id = ? AND grado_id = ? AND aula_id = ? AND materia_id = ? AND proceso_id = ? AND estadopm != 0';

        $query = $conn->prepare($sql);
        $query->execute(array($profesor, $grado, $aula, $materia, $periodo));
        $resultCheck = $query->fetch(PDO::FETCH_ASSOC);

        if ($resultCheck && ($idprofesormateria == 0 || $resultCheck['pm_id'] != $idprofesormateria)) {
            // Si existe una asignación exacta (mismo profesor, grado, aula, materia, y período)
            $arrResponse = array('status' => false, 'msg' => 'Este profesor ya tiene asignada esta materia en este grado, aula y período. Seleccione otra materia.');
        } else {
            if ($idprofesormateria == 0) {
                // Insertar nuevo registro
                $sql_insert = 'INSERT INTO procesoprofesor (grado_id, aula_id, profesor_id, estadopm, materia_id, proceso_id) 
                               VALUES (?, ?, ?, ?, ?, ?)';
                $query_insert = $conn->prepare($sql_insert);
                $request = $query_insert->execute(array($grado, $aula, $profesor, $status, $materia, $periodo));
                
                if ($request) {
                    $arrResponse = array('status' => true, 'msg' => 'Asignación exitosa');
                }
            } else {
                // Actualizar registro existente
                $sql_update = 'UPDATE procesoprofesor SET profesor_id = ?, grado_id = ?, aula_id = ?, materia_id = ?, proceso_id = ?, estadopm = ? 
                               WHERE pm_id = ?';
                $query_update = $conn->prepare($sql_update);
                $request2 = $query_update->execute(array($profesor, $grado, $aula, $materia, $periodo, $status, $idprofesormateria));
                
                if ($request2) {
                    $arrResponse = array('status' => true, 'msg' => 'Asignación actualizada correctamente');
                }
            }
        }
    }
    echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
}
