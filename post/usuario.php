<?php
include("../conection/config.php");
session_start();

if (!isset($_SESSION['id']) || (int)$_SESSION['id'] < 1) {
    echo json_encode(array("respuesta"=>"Sin permisos","tipo"=>"danger"));
    exit; 
}
$salida=array();

$nombre = isset($_REQUEST['nombre']) ? $_REQUEST['nombre'] : ''; // mysqli_real_escape_string removed
$login = isset($_REQUEST['login']) ? $_REQUEST['login'] : ''; // mysqli_real_escape_string removed
$password = isset($_REQUEST['password']) ? $_REQUEST['password'] : ''; // Do not escape password before hashing
$mail = isset($_REQUEST['mail']) ? $_REQUEST['mail'] : ''; // mysqli_real_escape_string removed

if (empty($nombre) || empty($login) || empty($password) || empty($mail)) {
    echo json_encode(array("respuesta"=>"Todos los campos (nombre, login, password, mail) son requeridos.","tipo"=>"warning"));
    exit;
}

// Validate email format (basic)
if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(array("respuesta"=>"Formato de correo electrónico no válido.","tipo"=>"warning"));
    exit;
}

$pass_hashed = password_hash($password, PASSWORD_DEFAULT);

if ($pass_hashed === false) {
    echo json_encode(array("respuesta"=>"Error al procesar la contraseña.","tipo"=>"danger"));
    exit;
}

$sql = "INSERT INTO `usuarios` (`login`, `pass`, `nombre`, `mail`) VALUES (?, ?, ?, ?)";
$stmt = $mysqli->prepare($sql);

if ($stmt) {
    // Bind parameters: login (string), pass_hashed (string), nombre (string), mail (string)
    $stmt->bind_param("ssss", $login, $pass_hashed, $nombre, $mail);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode(array("respuesta"=>"<strong>Exito!!</strong> Se ha ingresado el usuario exitosamente!","tipo"=>"success"));
        } else {
            // This case might occur if the query executes but no row is inserted (e.g., unique constraint violation on login or mail if they exist)
            echo json_encode(array("respuesta"=>"Usuario no ingresado, es posible que el login o email ya existan.","tipo"=>"warning"));
        }
    } else {
        // Provide more specific error if possible, otherwise generic. $mysqli->error might refer to $mysqli object state, $stmt->error for statement specific
        echo json_encode(array("respuesta"=>"Error al grabar en la base de datos: " . $stmt->error,"tipo"=>"danger"));
    }
    $stmt->close();
} else {
    // Error in preparing the statement
     echo json_encode(array("respuesta"=>"Error al preparar la consulta: " . $mysqli->error,"tipo"=>"danger"));
}
		
?>