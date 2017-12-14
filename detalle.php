
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="dashboard">
    <meta name="author" content="i-technology">
 

    <title>CNR APP STATUS Dashboard</title>

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
<?php include("include/header.php");?>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse">
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
            <li class="active"><a href="index.php">Dashboard</a></li>
            
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
        <h1>Detalles del servicio <span id="s1"></span></h1>
        <div class="col-md-12 separation">
          <table style="display:none" id="render">
            <tbody id="cuerpo">
              <tr>
                <td><span class="badge" id="estado">&nbsp;</span> <span id="s1"></span></td>
                <td id="e1">&nbsp;</td>
              </tr>
            </tbody>
          </table>

          <table class="table " id="dash">
            <thead>
              <tr>
                <th>Hora</th>
                <th>Descripción</th>
              </tr>
            </thead>
            <tbody id="cuerpo">
            </tbody>
          </table>
        </div>
      </div>
      <div class="row"></div>

      
 <div class="col-md-12">
          <div id="status">cargando ...</div>
          </div>

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
<script>

getEstados();
					
 $.ajax({
                url:   "get/evento_detalle.php",
                type:  "POST",
                dataType: "json",
				data:"codigo="+<?php echo $_REQUEST["codigo"]*1?>,
                success:  function (r) 
                {  
					var j=1;
		            var salida="";
					var s1="";
					for(var i = 0; i < r.eventos.length; i++) 
					{
						var cuerpo=$("#render").html();
					      var aux=$(cuerpo);
						
						var v = r.eventos[i];
						if (v.estado="vigente") {
				$("#s1",aux).html(v.fecha);
				$("#e1",aux).html(v.detalle);
						$("#estado",aux).addClass("badge-"+v.color);
						salida=salida+"<tr>"+$(aux).html()+"</tr>";
						}
						s1=v.servicio;
					}	
					$("#cuerpo",$("#dash")).html(salida);
					$("#s1").html(s1);
					$("#dash").show('slow');
					 
					   
				  },
                error: function(e)
                {
                    alert("Ocurrio un error en el servidor .."+e);
                }
            });
			
										function getEstados()
			{
				 $.ajax({
                url:   "get/estados.php",
                type:  "POST",
                dataType: "json",
                success:  function (r) 
                {  
					var salida="";
					arr_estados=new Array();
					for(var i = 0; i < r.estados.length; i++) 
					{		 
					     
					 
					 
						var v = r.estados[i];

						 if (v.estado=="vigente"){
						salida=salida+'&nbsp;<span class="badge badge-'+v.color+'">&nbsp;</span>&nbsp;'+v.nombre+'&nbsp;';
						 }
						
								 		
					}	
				   $("#status").html(salida);
				 
					 			  
				  },
                error: function(e)
                {
                    alert("Ocurrio un error en el servidor .."+e);
                }
            });
				
				}
</script>
