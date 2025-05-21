<?php
include("../conection/config.php");
session_start();

if ($_SESSION['id']*1<1) {
	echo json_encode(array("respuesta"=>"Sin permisos","tipo"=>"danger"));
	}
$salida=array();

// Input validation and sanitization
$evento_id = isset($_REQUEST['evento']) ? (int)$_REQUEST['evento'] : 0;
$id_servicio = isset($_REQUEST['servicio']) ? (int)$_REQUEST['servicio'] : 0;
$fecha = isset($_REQUEST['fecha']) ? $_REQUEST['fecha'] : '';
$hora = isset($_REQUEST['hora']) ? $_REQUEST['hora'] : '';
$estado_id = isset($_REQUEST['estado_evento']) ? (int)$_REQUEST['estado_evento'] : 0;
$detalle = isset($_REQUEST['detalle']) ? $mysqli->real_escape_string($_REQUEST['detalle']) : ''; // Keep escaping for free text, though prepared statements help

if (empty($id_servicio) || empty($fecha) || empty($hora) || empty($estado_id)) {
    echo json_encode(array("respuesta"=>"Datos incompletos (servicio, fecha, hora, estado son requeridos).","tipo"=>"warning"));
    exit;
}

// Fetch estado_nombre first
$estado_evento_nombre = '';
$sql_estado_nombre = "SELECT nombre FROM `estados` WHERE id = ?";
$stmt_estado_nombre = $mysqli->prepare($sql_estado_nombre);
$stmt_estado_nombre->bind_param("i", $estado_id);
$stmt_estado_nombre->execute();
$result_estado_nombre = $stmt_estado_nombre->get_result();
if ($row_estado = $result_estado_nombre->fetch_assoc()) {
    $estado_evento_nombre = $row_estado['nombre'];
}
$stmt_estado_nombre->close();

if (empty($estado_evento_nombre)) {
    echo json_encode(array("respuesta"=>"Estado no válido o no encontrado.","tipo"=>"danger"));
    exit;
}

$fecha_completa = "$fecha $hora";

$sql_insert = "INSERT INTO `servicio_eventos` (`id_servicio`, `fecha`, `estado_evento`, `detalle`, `estado_id`, `evento_id`) VALUES (?, ?, ?, ?, ?, ?)";
$stmt_insert = $mysqli->prepare($sql_insert);
$stmt_insert->bind_param("isssii", $id_servicio, $fecha_completa, $estado_evento_nombre, $detalle, $estado_id, $evento_id);

if ($stmt_insert->execute()) {
    $new_event_id = $stmt_insert->insert_id;
    $stmt_insert->close();

    if ($new_event_id > 0) {
        if ($evento_id == 0) {
            $sql_update_evento = "UPDATE `servicio_eventos` SET evento_id = ? WHERE id = ? AND evento_id = 0";
            $stmt_update_evento = $mysqli->prepare($sql_update_evento);
            $stmt_update_evento->bind_param("ii", $new_event_id, $new_event_id);
            $stmt_update_evento->execute();
            $stmt_update_evento->close();
        }

        $sql_update_servicio = "UPDATE `servicios` SET estado_id = ?, estado_servicio = ? WHERE id = ?";
        $stmt_update_servicio = $mysqli->prepare($sql_update_servicio);
        $stmt_update_servicio->bind_param("isi", $estado_id, $estado_evento_nombre, $id_servicio);
        $stmt_update_servicio->execute();
        
        if ($stmt_update_servicio->affected_rows >= 0) { // Check >=0 because it might not change if data is same
             echo json_encode(array("respuesta"=>"<strong>Exito!!</strong> Se ha ingresado el evento exitosamente!","tipo"=>"success"));
        } else {
             echo json_encode(array("respuesta"=>"Evento principal grabado, pero error al actualizar estado del servicio.","tipo"=>"warning"));
        }
        $stmt_update_servicio->close();

    } else {
        echo json_encode(array("respuesta"=>"Error al grabar el evento principal en la base de datos.","tipo"=>"danger"));
    }
} else {
    // Consider logging $stmt_insert->error
    echo json_encode(array("respuesta"=>"Error al ejecutar la inserción del evento: " . $stmt_insert->error,"tipo"=>"danger"));
}
		
?>