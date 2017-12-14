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
	#dash{ display:none;}
			.badge-red {
  background-color: red;
}
.badge-red:hover {
  background-color: #880202;
}

.badge-yellow {
  background-color: yellow;
}
.badge-yellow:hover {
  background-color: #8c8c01;
}
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
    <div class="container" role="main">
      <div class="page-header">
        <h1>CNR APP STATUS Dashboard</h1>
      </div>
      <div class="row">
      <div class"col-md-12">
        <p>En esta página proporciona información sobre el estado de los servicios de CNR,  esta información de estado se refiere a los servicios para todos los usuarios que  requieran utilizar servicios en CNR. En cualquier momento puede consultar el  estado actual de los servicios que se muestran a continuación siendo estos  productos cubiertos de disponibilidad de CNR. Para obtener más información,  comunicarse con CNR al teléfono (56-2) 2 425 7990.<br>
          Si desea contactarse con un servicio específico, se detalla a continuación:<br>
        </p>
        <button type="button" class="btn btn-primary pull-left"   data-toggle="modal" data-target="#detalle" >Ver Servicios</button><br>
        <div id="detalle" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Detalle Servicios CNR</h4>
      </div>
      <div class="modal-body">
       <ul>
          <li>SEP:</li>
          <ul>
            <li>Proyectos  postulados a la ley18450:  revisionley18450@cnr.gob.cl</li>
            <li>Proyectos ante  de postular a la ley18450:   </li>
            <li>http://www3.cnr.gob.cl/entradadocal.aspx</li>
            <li>Incidente/Requerimiento/Consulta  de sistema: Ingresar al SEP, ir a Consultas-&gt;Soporte-&gt;Nuevo Soporte</li>
          </ul>
          <li>ESIIR: </li>
          <ul>
            <li>Comunicarse  con CNR al teléfono (56-2) 2 425 7990 </li>
          </ul>
          <li>Unibox: </li>
          <ul>
            <li>Comunicarse  con CNR al teléfono (56-2) 2 425 7990 </li>
          </ul>
          <li>Intranet: </li>
          <ul>
            <li>Comunicarse  con CNR al teléfono (56-2) 2 425 7990 </li>
          </ul>
          <li>Aula  Virtual: </li>
          <ul>
            <li>Comunicarse  con CNR al teléfono (56-2) 2 425 7990 </li>
          </ul>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>
      </div>
      </div>
      <div class="row">
      <div class="col-md-12 text-center" >
      Última actualización: <span id="actualizacion">*</span>
      </div>
      </div>
      <div class="row   separation">
        <div class="col-md-12">
        <table style="display:none" id="render"><tbody id="cuerpo"><tr>
       
                <td><span class="badge" id="estado">&nbsp;</span> <span id="s1"></span></td>
                <td id="e1">&nbsp;</td>
                <td id="e2">&nbsp;</td>
                <td id="e3">&nbsp;</td>
                <td id="e4">&nbsp;</td>
                <td id="e5">&nbsp;</td>
                <td id="e6">&nbsp;</td>
                <td id="e7">&nbsp;</td>
              </tr>
              </tbody>
              </table>
              <div style="display:none" id="render_evento">
              <div><a href="detalle.php" id="link" title=""><span title="" class="badge" id="estado">&nbsp;</span></a></div>
              </div>
          <table class="table " id="dash">
            <thead>
              <tr>
                <th>Estado Actual</th>
                <th id="d1"></th>
                <th id="d2"></th>
                <th id="d3"></th>
                <th id="d4"></th>
                <th id="d5"></th>
                <th id="d6"></th>
                <th id="d7"></th>
              </tr>
            </thead>
            <tbody id="cuerpo">           
            </tbody>
            <tfoot>
            <tr>
            <td colspan=8>  <button id="siguiente" type="button" class="btn btn-default pull-right" onClick="fx_siguiente()">Siguiente >></button> <button type="button" class="btn btn-default pull-right" onClick="fx_anterior()" id="anterior"><< Anterior </button> </td>
              </tr>
            </tfoot>
          </table>      
        </div>
          <div class="col-md-12">
          <div id="status">cargando ...</div>
          </div>
      </div>
<?php include("include/footer.php");?>
  </div> 
  
  <!-- /container -->
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
var fechas=new Array();
var calendario=new Array();
var calendarioIndice=new Array();
	getEstados();				
 $.ajax({
                url:   "get/calendario.php",
                type:  "POST",
                dataType: "json",
                success:  function (r) 
                {  
					var j=1;
				    calendarioIndice=new Array();
				    calendario=new Array();
					for(var i = 0; i < r.calendario.length; i++) 
					{
						var v = r.calendario[i];
						calendario[j]=v;
						calendarioIndice[v.original]=j;
						$("#d"+j++).html(v.fecha);
								 		
					}	
					$("#dash").show('slow');
					fechas=r.fechas;
					if (fechas.siguiente == "")
					{
					$("#siguiente").addClass("disabled");	
					}
					getServicios();	  
				  },
                error: function(e)
                {
                    alert("Ocurrio un error en el servidor .."+e);
                }
            });
			
		function fx_anterior()
		{
			getCalendario(fechas.anterior);
			}
			
			function fx_siguiente()
		{
			getCalendario(fechas.siguiente);
			}
			
			function getCalendario(fecha)
			{
				 $.ajax({
                url:   "get/calendario.php",
                type:  "POST",
                dataType: "json",
				data: "dia="+fecha,
                success:  function (r) 
                {  
					var j=1;
				    $(".evento").html("&nbsp;");
				   $(".evento").removeClass("evento");
					calendarioIndice=new Array();
				    calendario=new Array();
					for(var i = 0; i < r.calendario.length; i++) 
					{
						var v = r.calendario[i];
						calendario[j]=v;
						calendarioIndice[v.original]=j;
						$("#d"+j++).html(v.fecha);
								 		
					}	
				 $("#siguiente").removeClass("disabled");	
					fechas=r.fechas;
					if (fechas.siguiente == "")
					{
					$("#siguiente").addClass("disabled");	
					}
				     getEventos();	 			  
				  },
                error: function(e)
                {
                    alert("Ocurrio un error en el servidor .."+e);
                }
            });
				
				}	
							
			function getServicios()
			{
				 $.ajax({
                url:   "get/servicios.php",
                type:  "POST",
                dataType: "json",
                success:  function (r) 
                {  
					var salida=""
					for(var i = 0; i < r.servicios.length; i++) 
					{	
					    var v = r.servicios[i];
						if (v.estado=="vigente"){
							var cuerpo=$("#cuerpo",$("#render")).html();
							var aux=$(cuerpo);
							$("#s1",aux).html(v.servicio);
							$("#estado",aux).addClass("badge-"+v.color);
							salida=salida+"<tr id='servicio"+v.id+"'>"+$(aux).html()+"</tr>";	
						}
					}	
				   $("#cuerpo",$("#dash")).html(salida);
				getEventos();
					 			  
				  },
                error: function(e)
                {
                    alert("Ocurrio un error en el servidor .."+e);
                }
            });
				
				}
				
			function getEventos()
			{
				 $.ajax({
                url:   "get/eventos.php",
                type:  "POST",
                dataType: "json",
				data: "fechai="+ fechas.anterior,
                success:  function (r) 
                {  
					var salida="";
					$("#actualizacion").html(r.update);
					for(var i = 0; i < r.eventos.length; i++) 
					{	
						var v = r.eventos[i];
						if (v.estado=="vigente"){
							var cuerpo=$("#render_evento").html();
							var aux=$(cuerpo);						
							indice=calendarioIndice[v.original];
							servicio=v.id_servicio;
							$("#estado",aux).addClass("badge-"+v.color);
							$("#estado",aux).attr("title",v.fecha+" - "+v.fechafin );
							$("#link",aux).attr("href","detalle.php?codigo="+v.id);
							$("#e"+indice,$("#servicio"+servicio)).html($("#e"+indice,$("#servicio"+servicio)).html()+$(aux).html());
							$("#e"+indice,$("#servicio"+servicio)).addClass("evento");	
						}
					}						  
				  },
                error: function(e)
                {
                    alert("Ocurrio un error en el servidor .."+e);
                }
            });
				
				}
				
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
