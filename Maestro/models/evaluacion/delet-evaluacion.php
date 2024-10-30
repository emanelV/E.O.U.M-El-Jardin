<?php 

require_once '../../../includes/conexion.php';

if ($_POST) {

    // Verificar si se encontró el contenido
        $idevaluacion = $_POST['idevaluacion'];


            // Eliminar actividad o evaluacion 

            $sql_update = "DELETE FROM evaluaciones WHERE evaluacion_id = ?";
            $query_update = $conn->prepare($sql_update);
            $result = $query_update->execute(array($idevaluacion));

            if ($result) {

                $arrResponse = array('status' => true, 'msg' => 'Eliminado Correctamente');
            } else {
                $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el contenido');
            }

    echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
}
