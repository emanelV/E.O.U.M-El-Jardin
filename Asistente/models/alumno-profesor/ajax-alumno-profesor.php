<?php 
require_once '../../../includes/conexion.php'; 
if (!empty($_POST)) {
    if (empty($_POST['listAlumno']) || empty($_POST['listProfesorAlu']) || empty($_POST['listPeriodoAlu'])) {
        $arrResponse = array('status' => false, 'msg' => 'Todos los campos son obligatorios');
    } else {
        $idalumnoprofesor = $_POST['idAlumnoProfesor'];
        $profesor = $_POST['listProfesorAlu'];
        $alumno = $_POST['listAlumno'];
        $periodo = $_POST['listPeriodoAlu'];
        $status = $_POST['listEstado'];

        // CONSULTA PARA INSERTAR
        $sql = 'SELECT * FROM procesoalumno WHERE alumno_id = ? AND pm_id = ? AND periodo_id = ? AND estadop != 0';
        $query = $conn->prepare($sql);
        $query->execute(array($alumno, $profesor, $periodo));
        $resultInsert = $query->fetch(PDO::FETCH_ASSOC);

        // CONSULTA PARA INSERTAR
        $sql2 = 'SELECT * FROM procesoalumno WHERE alumno_id = ? AND pm_id = ? AND periodo_id = ? AND estadop != 0 and pm_id != ?';
        $query2 = $conn->prepare($sql2);
        $query2->execute(array($profesor,$alumno, $periodo, $idalumnoprofesor));
        $resultUpdate = $query2->fetch(PDO::FETCH_ASSOC);

        if($resultInsert > 0 ){
            $arrResponse = array( 'status'=> false,'msg'=> 'El alumno ya tiene el grado y el profesor asignado');
        }else{
            if($idalumnoprofesor == 0){
                $sql_insert = 'INSERT INTO procesoalumno (alumno_id, pm_id, periodo_id, estadop) values (?,?,?,?)';
                $query_insert = $conn->prepare($sql_insert);
                $request = $query_insert->execute(  array($alumno, $profesor,$periodo,$status));
                if($request){
                    $arrResponse = array( 'status'=> true,'msg'=> 'Alumno asignado correctamente');
                }

            }
        }
        if($resultUpdate > 0){
            $arrResponse = array( 'status'=> false,'msg'=> 'El alumno ya tiene el grado y el profesor asignado');
        }else{
            if($idalumnoprofesor > 0){
                $sql_update = 'UPDATE procesoalumno SET alumno_id = ?, pm_id = ?, periodo_id = ?, estadop = ? WHERE ap_id = ?';
                $query_update = $conn->prepare($sql_update);    
                $request2 = $query_update->execute(array($alumno, $profesor, $periodo, $status, $idalumnoprofesor));
                if($request2){
                    $arrResponse = array( 'status'=> true,'msg'=> 'asignacion actualizada satisfactoriamente');
                }

            }
        }
    }
    echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
}
