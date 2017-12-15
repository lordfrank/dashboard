<?php 
session_start();
include("conection/config.php");

// logeo

	if(!empty($_REQUEST))
	{
		$usuario = mysqli_real_escape_string($mysqli,$_REQUEST['login']);
		$password = mysqli_real_escape_string($mysqli,$_REQUEST['password']);
		$error = '';
		
	
		
		$sql = "SELECT id, login,nombre, mail, pass FROM  usuarios  WHERE login  = '$usuario' and estado='vigente'";
		$result=$mysqli->query($sql);
		$rows = $result->num_rows;
	
		if($rows > 0) {
		 
			$row = $result->fetch_assoc();
			if (password_verify($password, $row['pass'])){
			$_SESSION['id'] = $row['id'];
			$_SESSION['usuario'] = $row['login'];
			$_SESSION['nombre'] = $row['nombre'];
			$_SESSION['mail'] = $row['mail'];
		header('Location: adminDashboard.php');
			}else
			{$error = "El nombre o contraseña son incorrectos";
				}
			} else {
			$error = "El nombre o contraseña son incorrectos";
			
		}
	}

if(isset($_SESSION["id"])){
	if ($_SESSION["id"]*1>0){
header('Location: adminDashboard.php');
	}
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
 

    <title>Monitoreo de Servicios CNR</title>

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
<?php include("include/header.php"); ?>
  <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse ">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
 
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Dashboard</a></li>
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administrar <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="login.php">Administrador</a></li>
                <li role="separator" class="divider"></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container separation" role="main">


      <div class="page-header">
        <h2>Administrador</h2>
      </div>
   

	<div> <form action="login.php" method="post"> <div class="form-group"> <label for="login">Usuario</label>
	      <input type="text" class="form-control" id="login" name="login"  placeholder="login admin"> </div> <div class="form-group"> <label for="password">Contraseña</label> <input type="password" name="password"  class="form-control" id="password" placeholder="Contraseña"> </div>    <button type="submit" class="btn btn-primary">Login</button> </form> </div> 

      


    </div> <!-- /container -->
<?php include("include/footer.php");?>

  <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="bs/assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="bs/js/bootstrap.min.js"></script>
    <script src="bs/assets/js/docs.min.js"></script>
 
  </body>
</html>
