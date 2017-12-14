<?php 
session_start();
include("conection/config.php");

	
$go=mysqli_real_escape_string($mysqli,$_REQUEST['go']);

if ($go=="go")
{
	$salida="<br>comenzando ...";
$_SESSION['id'] = "";
			$_SESSION['usuario'] = "";
			$_SESSION['nombre'] = "";
			$_SESSION['mail'] ="";
 
 
$sql="DROP TABLE `estados`, `servicios`, `servicio_eventos`, `usuarios`;";
 $result=$mysqli->query($sql);
 
$sql="CREATE TABLE `estados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'vigente'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

 $result=$mysqli->query($sql);
 $salida=$salida."<br>creando tablas ...";
$sql="INSERT INTO `estados` (`id`, `nombre`, `color`, `estado`) VALUES
(1, 'Sin problemas', 'success', 'vigente'),
(2, 'Interrupción del servicio', 'warning', 'vigente'),
(3, 'Suspensión temporal del servicio', 'error', 'vigente');";

$result=$mysqli->query($sql); 
$sql="CREATE TABLE `servicios` (
  `id` int(10) UNSIGNED NOT NULL,
  `servicio` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado_servicio` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'vigente',
  `estado_id` int(9) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

 $result=$mysqli->query($sql);
$sql="CREATE TABLE `servicio_eventos` (
  `id` int(9) UNSIGNED NOT NULL,
  `id_servicio` int(9) UNSIGNED NOT NULL,
  `fecha` datetime NOT NULL,
  `estado_evento` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detalle` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'vigente',
  `estado_id` int(11) NOT NULL,
  `evento_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

 
$result=$mysqli->query($sql);
$sql="CREATE TABLE `usuarios` (
  `id` int(9) UNSIGNED NOT NULL,
  `login` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'vigente',
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci  NULL,
  `mail` varchar(100) COLLATE utf8mb4_unicode_ci  NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
$result=$mysqli->query($sql);
 
$sql="INSERT INTO `usuarios` (`id`, `login`, `pass`, `estado`,`nombre`) VALUES (1, 'admin', '".password_hash("temporal2017", PASSWORD_DEFAULT)."', 'vigente','super admin');";
$salida=$salida."<br>insertando data  ...";
 $result=$mysqli->query($sql);
$sql="ALTER TABLE `estados`
  ADD UNIQUE KEY `id` (`id`);";

 $result=$mysqli->query($sql);
$sql="ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estado_id` (`estado_id`);";
$result=$mysqli->query($sql);
 
$sql="ALTER TABLE `servicio_eventos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_servicio` (`id_servicio`),
  ADD KEY `evento_id` (`evento_id`),
  ADD KEY `estado_id` (`estado_id`),
  ADD KEY `fecha` (`fecha`);";
$result=$mysqli->query($sql);
 
$sql="ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `login` (`login`),
  ADD KEY `pass` (`pass`);";
$result=$mysqli->query($sql);
 $salida=$salida."<br>indices  ...";
$sql="ALTER TABLE `estados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;";
 $result=$mysqli->query($sql);
$sql="ALTER TABLE `servicios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;";
 $result=$mysqli->query($sql);
$sql="ALTER TABLE `servicio_eventos`
  MODIFY `id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT;";
 $result=$mysqli->query($sql);
$sql="ALTER TABLE `usuarios`
  MODIFY `id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;";
 $result=$mysqli->query($sql);


$salida=$salida."<br>fin rutina";
$exito=1;
}
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="dashboard">
    <meta name="author" content="i-technology">
 

    <title>DashBoard</title>

    <!-- Bootstrap core CSS -->
    <link href="bs/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="bs/css/bootstrap-theme.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="bs/theme/theme.css" rel="stylesheet">

 

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
	#dash{ display:1none;}
	.badge-error {
  background-color: #b94a48;
}
.badge-error:hover {
  background-color: #953b39;
}
.badge-warning {
  background-color: #f89406;
}
.badge-warning:hover {
  background-color: #c67605;
}
.badge-success {
  background-color: #468847;
}
.badge-success:hover {
  background-color: #356635;
}
.badge-info {
  background-color: #3a87ad;
}
.badge-info:hover {
  background-color: #2d6987;
}
.badge-inverse {
  background-color: #333333;
}
.badge-inverse:hover {
  background-color: #1a1a1a;
}
	</style>
  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse ">
      <div class="container">
        <div class="navbar-header">
 
          <a class="navbar-brand" href="#">DashBoard</a>
        </div>
 
      </div>
    </nav>

    <div class="container" role="main">


      <div class="page-header">
        <h1>Configuración</h1>
      </div>
   

	<div><form method="post" action="install.php"><input type="hidden" name="go" value="go"> </input> <input type="submit" class="btn btn-success"   id="anterior" value="Instalar"></input></form></div> 
<div class="alert-info">
<?php echo $salida ?>
</div>
      


    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="bs/assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="bs/js/bootstrap.min.js"></script>
    <script src="bs/assets/js/docs.min.js"></script>
 
  </body>
</html>
<script>


					

			
		
</script>
 