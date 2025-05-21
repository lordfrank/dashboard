<?php
include("../conection/config.php");

$salida=array();

$id_servicio = isset($_REQUEST['servicio']) ? $_REQUEST['servicio'] : '';
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
$fechai = isset($_REQUEST['fechai']) ? $_REQUEST['fechai'] : '';

if (strlen($id_servicio) > 0) {
    $sql = "SELECT id_servicio, servicio_eventos.id, evento_id, MAX(estado_id) AS estado_id, MIN(fecha) AS fecha, MAX(fecha) AS fechafin, color, DATE(MIN(fecha)) AS original, servicio_eventos.estado, estado_evento, detalle 
            FROM `servicio_eventos`, estados 
            WHERE estado_id = estados.id AND id_servicio = ? 
            GROUP BY evento_id";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $id_servicio);
} else if (strlen($id) > 0) {
    $sql = "SELECT y.*, (SELECT servicio FROM servicios WHERE id = id_servicio) AS nombre_servicio, 
            IF(y.evento_id = y.id, 'Nuevo evento', (SELECT CONCAT(fecha, '- ', estado_evento, ' ', detalle) FROM servicio_eventos x WHERE x.id = y.evento_id)) AS nombre_evento, 
            DATE_FORMAT(fecha, '%H:%i') AS hora, DATE_FORMAT(fecha, '%Y-%m-%d') AS fechaformato 
            FROM `servicio_eventos` y, estados 
            WHERE estado_id = estados.id AND y.id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $id);
} else {
    $sql = "SELECT z.evento_id AS id, MIN(z.id_servicio) AS id_servicio, z.evento_id, z.estado_id, z.fecha, 
            (SELECT MAX(x.fecha) FROM servicio_eventos x WHERE x.evento_id = z.evento_id) AS fechafin, 
            e.color, DATE(z.fecha) AS original, z.estado 
            FROM `servicio_eventos` z, estados e 
            WHERE z.estado_id = e.id AND z.id = z.evento_id AND z.fecha > ? 
            GROUP BY z.evento_id";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $fechai);
}

		$stmt->execute();
		$result = $stmt->get_result();
		$rows = $result->num_rows;
		
		if($rows > 0) {
			while($row = $result->fetch_assoc())
			{
				$salida[]=$row;
				} 
		}
		
		
		$salida2=array();
 

 
$sql_estados = "SELECT * FROM `estados` ORDER BY id ASC";
$stmt_estados = $mysqli->prepare($sql_estados);
$stmt_estados->execute();
$result_estados = $stmt_estados->get_result();
$rows_estados = $result_estados->num_rows;

if ($rows_estados > 0) {
    while ($row = $result_estados->fetch_assoc()) {
        $salida2[] = $row;
    }
}
		setlocale(LC_ALL, 'es_CL.UTF-8');
	date_default_timezone_set("America/Santiago");
		
$sql_last_update = "SELECT IF(MAX(last) IS NULL, 'Sin eventos recientes', UNIX_TIMESTAMP(MAX(last))) AS salida FROM `servicio_eventos` WHERE estado = 'vigente'";
$stmt_last_update = $mysqli->prepare($sql_last_update);
$stmt_last_update->execute();
$result_last_update = $stmt_last_update->get_result();
$rows_last_update = $result_last_update->num_rows;
		
		if($rows_last_update > 0) {
			while($row = $result_last_update->fetch_assoc())
			{
				$salida3=$row["salida"];
				} 
		}
		if ($salida3!="Sin eventos recientes" && is_numeric($salida3)) {
            $timestamp = (int)$salida3;
            // Timezone is already set by date_default_timezone_set("America/Santiago");
            // Locale 'es_CL.UTF-8' is set by setlocale(LC_ALL, 'es_CL.UTF-8');
            // Ensure the intl extension is available.
            if (class_exists('IntlDateFormatter')) {
                $fmt = new IntlDateFormatter(
                    'es_CL',
                    IntlDateFormatter::FULL, // Date type (can be adjusted if pattern is more specific)
                    IntlDateFormatter::FULL, // Time type (can be adjusted if pattern is more specific)
                    'America/Santiago',      // Timezone
                    IntlDateFormatter::GREGORIAN,
                    " d 'de' MMMM 'de' yyyy , HH:mm:ss " // ICU pattern
                );
                if ($fmt) {
                    $formatted_date = $fmt->format($timestamp);
                    // Add leading and trailing spaces as in the original strftime format string
                    print json_encode(array("eventos"=>$salida,"estados"=>$salida2,"update"=> " " . $formatted_date . " "));
                } else {
                    // Fallback or error if IntlDateFormatter fails
                    // For simplicity, using original value or a simple date() format
                    error_log("IntlDateFormatter creation failed. Error: " . intl_get_error_message());
                    print json_encode(array("eventos"=>$salida,"estados"=>$salida2,"update"=>  date("Y-m-d H:i:s", $timestamp) ));
                }
            } else {
                // Fallback if intl extension is not loaded
                error_log("PHP intl extension is not available. Using fallback date format.");
                print json_encode(array("eventos"=>$salida,"estados"=>$salida2,"update"=> date("Y-m-d H:i:s", $timestamp) ));
            }
		} else {
            print json_encode(array("eventos"=>$salida,"estados"=>$salida2,"update"=>  $salida3 ));	
		}
		
?>