<?php
 // prueba 
$dbhost = getenv("MYSQL_SERVICE_HOST");
$dbport = getenv("MYSQL_SERVICE_PORT");
$login=getenv('MYSQL_USER');
$pass=getenv('MYSQL_PASSWORD');
$basedatos=getenv('MYSQL_DATABASE');

$mysqli=new mysqli($dbhost,$login,$pass,$basedatos); 
	
if(mysqli_connect_errno()){
	echo 'Conexion Fallida : ', mysqli_connect_error();
	exit();
}

// Set the charset to utf8mb4 for proper Unicode support
if (!$mysqli->set_charset("utf8mb4")) {
    // Optionally log an error if charset setting fails, though it's rare if the server supports utf8mb4
    // printf("Error loading character set utf8mb4: %s\n", $mysqli->error);
    // For simplicity in this context, we'll assume it usually succeeds if the connection is up.
    // If it fails, the connection might still work but with potential encoding issues.
}
?>
