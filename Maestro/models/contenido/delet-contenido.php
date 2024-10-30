<?php 

require_once '../../../includes/conexion.php';

if ($_POST) {
    $idcontenido = $_POST['idcontenido'];

    // Consulta para verificar si el contenido existe
    $sql = "SELECT * FROM contenidos WHERE contenido_id = ?";
    $query = $conn->prepare($sql);
    $query->execute(array($idcontenido));
    $data = $query->fetch(PDO::FETCH_ASSOC);

    // Verificar si se encontró el contenido
    if ($data) {
        // Consulta para verificar si existen evaluaciones asociadas
        $sqle = "SELECT * FROM evaluaciones WHERE contenido_id = ?";
        $querye = $conn->prepare($sqle);
        $querye->execute(array($idcontenido));
        $data2 = $querye->fetch(PDO::FETCH_ASSOC);

        if (empty($data2)) {
            // Eliminar contenido
            $sql_delete = "DELETE FROM contenidos WHERE contenido_id = ?";
            $query_delete = $conn->prepare($sql_delete);
            $result = $query_delete->execute(array($idcontenido));

            if ($result) {
                // Eliminar el archivo de material asociado, si existe
                if (!empty($data['material']) && file_exists($data['material'])) {
                    unlink($data['material']);
                }

                $arrResponse = array('status' => true, 'msg' => 'Eliminado Correctamente');
            } else {
                $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el contenido');
            }
        } else {
            $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar porque tiene una evaluación asignada');
        }
    } else {
        $arrResponse = array('status' => false, 'msg' => 'Contenido no encontrado');
    }

    echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
}
