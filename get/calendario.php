<?php

// Safely get 'dia' from $_REQUEST, default to null if not set
$dia = $_REQUEST["dia"] ?? null;

// Determine the base date $f
if (empty($dia)) { // Checks for null, empty string, '0', 0, false
    $f = date("Y-m-d"); // Default to today if 'dia' is not provided or empty
} else {
    // Attempt to parse the provided 'dia' string
    $timestamp = strtotime($dia);
    if ($timestamp === false) {
        // Handle invalid date string, default to today or an error response
        $f = date("Y-m-d"); 
        // Optionally, log an error or return a specific JSON error
        // For now, mimics original behavior of falling back if $dia is unusable by strtotime
    } else {
        $f = date("Y-m-d", $timestamp);
    }
}

$fo = date("d/m/y", strtotime($f)); // Formatted date for the current $f

$salida = array();
for ($i = 6; $i > 0; $i--) {
    $salida[] = array(
        "fecha" => date("d/m/y", strtotime("$f -$i day")),
        "original" => date("Y-m-d", strtotime("$f -$i day"))
    );
}
$salida[] = array("fecha" => $fo, "original" => $f);

$response_data = array(
    "calendario" => $salida,
    "fechas" => array(
        "hoy" => date("Y-m-d"),
        "anterior" => date("Y-m-d", strtotime("$f -7 day")),
        "siguiente" => "" // Default to no 'siguiente'
    )
);

// If $f is not today, then set the 'siguiente' date
if (date("Y-m-d") != $f) {
    $response_data["fechas"]["siguiente"] = date("Y-m-d", strtotime("$f +7 day"));
}

echo json_encode($response_data);

?>