<?php

session_start();
	$_SESSION['id'] = "";
			$_SESSION['usuario'] = "";
			$_SESSION['nombre'] = "";
			$_SESSION['mail'] ="";
header('Location: login.php');
?>