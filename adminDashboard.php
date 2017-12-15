<?php 

session_start();
if(isset($_SESSION["id"])){

}else{
	
	header('Location: login.php');
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
    <link id="bsdp-css" href="bs/css/bootstrap-datepicker3.min.css" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="bs/css/bootstrap-clockpicker.min.css">
    <!-- Custom styles for this template -->
    <link href="bs/theme/theme.css" rel="stylesheet">



    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
	h1{
     word-wrap: break-word;
     -webkit-hyphens: auto;
     -moz-hyphens: auto;
     -ms-hyphens: auto;
     -o-hyphens: auto;
     hyphens: auto;
}
	#dash{  }
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
    <nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar" id="menu">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
         <a class="navbar-brand" href="#"><span class=" glyphicon glyphicon-user"></span> <?php echo $_SESSION["usuario"];?></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav  " id="menu">
            <li><a href="index.php">Dashboard</a></li>
            <li class="active"><a href="#" onclick="servicios(this)"  id="m1" >Servicios</a> </li>
            <li><a href="#"  id="m2" onclick="estados(this)">Estados</a></li>
            <li><a href="#"  id="m3"  onclick="eventos(this)">Eventos</a></li>
            <li><a href="#"  id="m4"  onclick="usuarios(this)">Usuarios</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administrar <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="login.php">Administrador</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="salir.php">Salir</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container separation" role="main">
      <div class="page-header">
        <h3>Monitoreo de Servicios CNR Administrador</h3>
      </div>
      <div class="row" id="divservicios">
     <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12"> <h3>Servicios</h3></div>
     
     
     <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12" ><button type="button" class="btn btn-success  " onclick="add_servicio()"  >Nuevo</button></div>
        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <table style="display:none" id="renderServicio"><tbody id="cuerpo"><tr>
        <td id="e1"></td>
                <td id="e2"></td>
                <td id="e3"></td>
                <td id="e4"></td>
                <td id="e5"><span class="btn btn-default glyphicon glyphicon-cog" onclick="form_servicio(this)"></span></td>
              </tr>
              </tbody>
              </table>
              <div class="table-responsive">
          <table class="table " id="dash">
            <thead>
              <tr class="panel-footer">
                <th>Codigo</th>
                <th>Servicio</th>
                <th>Estado  actual</th>
                <th>Estado</th>
                <th>Configuración</th>
              </tr>
            </thead>
            <tbody id="cuerpotabla">           
            </tbody>
          </table>
          </div>
        </div>
      </div>
    <div class="row" id="divestados" style="display:none" >
     <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12"> <h3>Estados</h3></div>
        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12" ><button type="button" class="btn btn-success" onclick="add_estado()" >Nuevo</button></div>
        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <table style="display:none" id="renderEstado"><tbody id="cuerpo"><tr>
        <td id="e1"></td>
                <td id="e2"></td>
                <td id="e3"></td>
                <td id="e4"></td>
                <td id="e5"><span class="btn btn-default glyphicon glyphicon-cog" onclick="form_estado(this)"></span></td>
              </tr>
              </tbody>
              </table>
              <div class="table-responsive">
          <table class="table " id="dash">
            <thead>
              <tr class="panel-footer">
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Color</th>
                <th>Estado</th>
                <th>Configuración</th>
              </tr>
            </thead>
            <tbody id="cuerpotabla">           
            </tbody>
          </table>
          </div>
        </div>
      </div>
                     
    <div class="row" id="diveventos" style="display:none" >
     <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12"> <h3>Eventos</h3></div>
        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12" ><button type="button" class="btn btn-success" onclick="add_evento()">Nuevo</button></div>
        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <table style="display:none" id="renderEvento"><tbody id="cuerpo"><tr>
        <td id="e1"></td>
                <td id="e2"></td>
                <td id="e3"></td>
                <td id="e4"></td>
                 <td id="e5"></td>
                  <td id="e8"></td>
                 
                  
                <td id="e7"><span class="btn btn-default glyphicon glyphicon-cog" onclick="form_evento(this)"></span> <span class="btn btn-default glyphicon glyphicon-plus" onclick="form_evento_add(this)" id="plus"></span></td>
              </tr>
              </tbody>
              </table>
              <div class="table-responsive">
          <table class="table " id="dash">
            <thead>
              <tr class="panel-footer">
                <th>Codigo</th>
                <th>Servicio</th>
                <th>Detalle</th>
                <th>Fecha</th>
                <th>Estado Evento</th>
                <th>Tipo</th>
                     
                <th>Configuracion</th>
              </tr>
            </thead>
            <tbody id="cuerpotabla">           
            </tbody>
          </table>
          </div>
        </div>
      </div>
          <div class="row" id="divusuarios" style="display:none" >
     <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12"> <h3>Usuarios</h3></div>
        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12" ><button type="button" class="btn btn-success " onclick="add_usuario()"  >Nuevo</button></div>
        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <table style="display:none" id="renderUsuario"><tbody id="cuerpo"><tr>
        <td id="e1"></td>
                <td id="e2"></td>
                <td id="e3"></td>
                <td id="e4"></td>
                 <td id="e5"></td>
                <td id="e6"><span class="btn btn-default glyphicon glyphicon-cog" onclick="form_usuario(this)"></span></td>
              </tr>
              </tbody>
              </table>
              <div class="table-responsive">
          <table class="table " id="dash">
            <thead>
              <tr class="panel-footer">
                <th>Codigo</th>
                <th>Login</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Estado</th>
                <th>Configuración</th>
              </tr>
            </thead>
            <tbody id="cuerpotabla">           
            </tbody>
          </table>
          </div>
        </div>
      </div>
      
     	<div id="formservicio" style="display:none"> 
         <div class="col-md-12"> <h3>Servicios</h3></div>
          <div class="col-md-12">
         <form action="post/servicio.php" method="post" id="form"> <div class="form-group"> <label for="login">Nombre</label>
	      <input type="text" class="form-control" id="nombre" name="nombre"  placeholder="servicio"> </div>   
            <div class="form-group update" > <label for="login">Estado</label>
	      <select class="form-control" id="estado" name="estado">
          <option value="vigente">vigente</option>
          <option value="no vigente">no vigente</option>
          </select> </div>   
         <input type="hidden"  name="id"  class="form-control" id="id"  >  
          <button type="button" class="btn btn-primary"  onClick="grabar_servicio()">Grabar</button>
           <button type="button" class="btn btn-deafult" onClick="servicios($('#m1'))">Cancelar</button></form>  
           </div>
           </div>  
          
     <div id="formestado" style="display:none"> 
        <div class="col-md-12"> <h3>Estados</h3></div>
          <div class="col-md-12">
        <form action="post/estado.php" method="post" id="form">
        <div class="form-group"> <label for="login">Nombre</label>
	      <input type="text" class="form-control" id="nombre" name="nombre"  placeholder="Nombre del estado"> </div>
        <div class="form-group"> <label for="">Color</label> <span  class="badge badge-error" onclick="fsc('error')" >&nbsp;</span> <span  class="badge badge-warning"  onclick="fsc('warning')" >&nbsp;</span> <span  class="badge badge-success"  onclick="fsc('success')">&nbsp;</span> <span  class="badge badge-info"  onclick="fsc('info')" >&nbsp;</span> <span  class="badge badge-inverse"  onclick="fsc('inverse')">&nbsp;</span> <span  class="badge badge-red"  onclick="fsc('red')">&nbsp;</span> <span  class="badge badge-yellow"  onclick="fsc('yellow')" >&nbsp;</span> <- click para seleccionar<br>
       seleccion: <span  class="badge badge-error"  id="selcolor" >&nbsp;</span> 
         <input type="hidden"  name="color"  class="form-control" id="color" placeholder="color" > 
          </div> 
          <div class="form-group update" > <label for="login">Estado</label>
	      <select class="form-control" id="estado" name="estado">
          <option value="vigente">vigente</option>
          <option value="no vigente">no vigente</option>
          </select> </div>   
         <input type="hidden"  name="id"  class="form-control" id="id"  >  
        <button type="button" class="btn btn-primary"  onClick="grabar_estado()">Grabar</button> 
        <button type="button" class="btn btn-deafult" onClick="estados($('#m2'))">Cancelar</button>
        </form>
        </div> 
        </div>
                
    <div id="formevento" style="display:none">
          <div class="col-md-12"> <h3>Eventos</h3></div>
          <div class="col-md-12">
           <form action="post/evento.php" method="post" id="form"> 
           <div class="form-group"> 
           <label for="login">Servicio</label>
	      <select class="form-control" id="servicio" name="servicio" onchange="cambioServicio(this)" ></select> </div> 
          <div class="form-group"> <label for="">Evento</label> <select name="evento"  class="form-control" id="evento" placeholder="evento"><option value="">Nuevo evento</option> </select></div> 
               <div class="form-group"> <label for="">Detalle</label> <textarea name="detalle"  class="form-control" id="detalle" placeholder="detalle"></textarea> </div>    
              <div class="form-group"> <label for="">Fecha</label> 
              (aaaa-mm-dd)
                <input type="text" name="fecha"  readonly="true" class="form-control" id="fecha"  > </div>
               <div class="form-group"> <label for="">Hora</label> 
               (hh:mm)
               <input type="text" name="hora" readonly class="form-control" id="hora"  > </div>
                 <div class="form-group"> 
           <label for="estado_servicio">Estado Evento</label>
	      <select class="form-control" id="estado_evento" name="estado_evento"   ></select> </div> 
           <div class="form-group update2"  style="display:none"> <label  >Estado</label>
	      <select class="form-control" id="estado" name="estado">
          <option value="vigente">vigente</option>
          <option value="no vigente">no vigente</option>
          </select> </div>   
         <input type="hidden"  name="id"  class="form-control" id="id"  > 
          <button type="button" class="btn btn-primary" onClick="grabar_evento()">Grabar</button>
          <button type="button" class="btn btn-deafult" onClick="eventos($('#m3'))">Cancelar</button> </form></div>      
      </div>  
      	<div id="formusuario" style="display:none"> 
         <div class="col-md-12"> <h3>Usuarios</h3></div>
          <div class="col-md-12">
         <form action="post/usuario.php" method="post" id="form"> 
         <div class="form-group"> <label for="login">Login</label>
	      <input type="text" class="form-control" id="login" name="login"  placeholder="login"> </div> 
          <div class="form-group"> <label for="password">Password</label>
	      <input type="text" class="form-control" id="password" name="password"  placeholder="contraseña"> </div> 
         <div class="form-group"> <label for="nombre">Nombre</label>
	      <input type="text" class="form-control" id="nombre" name="nombre"  placeholder="nombre"> </div>   
               <div class="form-group"> <label for="email">Email</label>
	      <input type="text" class="form-control" id="mail" name="mail"  placeholder="correo electronico"> </div>   
            <div class="form-group update" > <label for="login">Estado</label>
	      <select class="form-control" id="estado" name="estado">
          <option value="vigente">vigente</option>
          <option value="no vigente">no vigente</option>
          </select> </div>   
         <input type="hidden"  name="id"  class="form-control" id="id"  >  
          <button type="button" class="btn btn-primary"  onClick="grabar_usuario()">Grabar</button>
           <button type="button" class="btn btn-deafult" onClick="usuarios($('#m4'))">Cancelar</button></form>  
           </div>
           </div>
    </div> <!-- /container -->
  <div class="modal fade" id="alert" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div class="alert alert-succcess" id="msg">
		  </div>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <?php include("include/footer.php"); ?>
</div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="bs/assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="bs/js/bootstrap.min.js"></script>
    <script src="bs/assets/js/docs.min.js"></script>
  <script src="bs/js/bootstrap-datepicker.min.js"></script>
    <script src="bs/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
	<script src="bs/js/bootstrap-clockpicker.min.js"></script>
  </body>
</html>
<script>

var arr_servicios=new Array();
var arr_estados=new Array();
var arr_eventos=new Array();
					
getServicios();	

function estados(data){
	$(".active").removeClass("active");
	$(data).parent().addClass("active");
	getEstados();
	fx_div("#divestados");
	$("#navbar").removeClass("in");
	
	}
function servicios(data){
	$(".active").removeClass("active");
	$(data).parent().addClass("active");
	getServicios();
	fx_div("#divservicios");
	$("#navbar").removeClass("in");

	
	}	
function eventos(data){
	$(".active").removeClass("active");
	$(data).parent().addClass("active");
	getEventos();
	fx_div("#diveventos");
	$("#navbar").removeClass("in");

	}
	function usuarios(data){
	$(".active").removeClass("active");
	$(data).parent().addClass("active");
	getUsuarios();
	fx_div("#divusuarios");
	$("#navbar").removeClass("in");

	}
function fx_div(data)
{
	$("#diveventos").hide();
	$("#divestados").hide();
	$("#divservicios").hide();
	$("#divusuarios").hide();
	$("#formevento").hide();
	$("#formestado").hide();
	$("#formservicio").hide();
	$("#formusuario").hide();
	
	$(data).show();
	}	
	
function form_servicio(data)	 
{
	aux=$(data).parent().parent();

 
		 $.ajax({
                url:   "get/servicios.php",
                type:  "POST",
                dataType: "json",
				data: "id="+$("#e1",$(aux)).html(),
                success:  function (r) 
                {   
					 
				
					for(var i = 0; i < r.servicios.length; i++) 
					{		
					   
					 
					 
						var v = r.servicios[i];

						
						$("#id",$("#formservicio")).val(v.id);
						$("#nombre",$("#formservicio")).val(v.servicio);
						$("#estado",$("#formservicio")).val(v.estado); 
	
								 		
					}	
				  
				 	 $(".update",$("#formservicio")).show();
					fx_div("#formservicio"); 			  
				  },
                error: function(e)
                {
                    fx_alert("danger","Ocurrio un error en el servidor ..");
					 $("#msg").removeClass().addClass("alert alert-info").html("error no se pudo ingresar a la BD");
 $('#alert').modal("show");
                }
            });
	
}

function form_estado(data)	 
{
	aux=$(data).parent().parent();

		 $.ajax({
                url:   "get/estados.php",
                type:  "POST",
                dataType: "json",
				data: "id="+$("#e1",$(aux)).html(),
                success:  function (r) 
                {   
					 
				
					for(var i = 0; i < r.estados.length; i++) 
					{		
					   
					 
					 
						var v = r.estados[i];

						
						$("#id",$("#formestado")).val(v.id);
						$("#nombre",$("#formestado")).val(v.nombre);
						$("#estado",$("#formestado")).val(v.estado); 
	                    $("#color",$("#formestado")).val(v.color);
						fsc(v.color);		 		
					}	
				  
				 	 $(".update",$("#formestado")).show();
					fx_div("#formestado"); 			  
				  },
                error: function(e)
                {
                    fx_alert("danger","Ocurrio un error en el servidor .."+e);
                }
            });
			
}

function form_evento(data)	 
{
	aux=$(data).parent().parent();


	
			 $.ajax({
                url:   "get/eventos.php",
                type:  "POST",
                dataType: "json",
				data: "id="+$("#e1",$(aux)).html(),
                success:  function (r) 
                {   
					
					
					for(var i = 0; i < r.eventos.length; i++) 
					{		
					   
					 
					 
						var v = r.eventos[i];
                salida=""; 
				for(var i = 0; i < r.estados.length; i++) 
					{
						var e = r.estados[i];
						if (v.estado_id==e.id) {
						salida=salida+"<option value='"+e.id+"'>"+e.nombre+"</option>";
						}
						
					}
					$("#estado_evento",$("#formevento")).html(salida);
						
						$("#id",$("#formevento")).val(v.id);
						$("#servicio",$("#formevento")).html("<option value="+v.id_servicio+">"+v.nombre_servicio+"</option>");
						
						$("#servicio",$("#formevento")).val(v.id_servicio);
						$("#evento",$("#formevento")).html("<option value="+v.evento_id+">"+v.nombre_evento +"</option>");
						$("#evento",$("#formevento")).val(v.evento_id); 
	                    $("#detalle",$("#formevento")).val(v.detalle);
						$("#fecha",$("#formevento")).val(v.fechaformato);
						$('#fecha').datepicker('update');
						$("#hora",$("#formevento")).val(v.hora);
						$("#estado_evento",$("#formevento")).val(v.estado_id);
						 		 		
					}	
				  
				 	 $(".update",$("#formevento")).show();
					fx_div("#formevento"); 			  
				  },
                error: function(e)
                {
                    fx_alert("danger","Ocurrio un error en el servidor .."+e);
                }
            });
}

function form_usuario(data)	 
{
	aux=$(data).parent().parent();

		 $.ajax({
                url:   "get/usuarios.php",
                type:  "POST",
                dataType: "json",
				data: "id="+$("#e1",$(aux)).html(),
                success:  function (r) 
                {   
					 
				
					for(var i = 0; i < r.usuarios.length; i++) 
					{		
					   
					 
					 
						var v = r.usuarios[i];

						
						$("#id",$("#formusuario")).val(v.id);
						$("#nombre",$("#formusuario")).val(v.nombre);
						$("#estado",$("#formusuario")).val(v.estado); 
	                    $("#login",$("#formusuario")).val(v.login);
						$("#mail",$("#formusuario")).val(v.mail);

					}	
				  
				 	 $(".update",$("#formusuario")).show();
					fx_div("#formusuario"); 			  
				  },
                error: function(e)
                {
                    fx_alert("danger","Ocurrio un error en el servidor .."+e);
                }
            });
			
}

function form_evento_add(data)	 
{
	aux=$(data).parent().parent();


	
			 $.ajax({
                url:   "get/eventos.php",
                type:  "POST",
                dataType: "json",
				data: "id="+$("#e1",$(aux)).html(),
                success:  function (r) 
                {   
					      salida=""; 
				     for(var i = 0; i < r.estados.length; i++) 
					{
						var e = r.estados[i];
						
						salida=salida+"<option value='"+e.id+"'>"+e.nombre+"</option>";
						
						
					}
					$("#estado_evento",$("#formevento")).html(salida);
					
					for(var i = 0; i < r.eventos.length; i++) 
					{		
					   
					 
					 
						var v = r.eventos[i];
          
						
						$("#id",$("#formevento")).val("");
						$("#servicio",$("#formevento")).html("<option value="+v.id_servicio+">"+v.nombre_servicio+"</option>");
						
						$("#servicio",$("#formevento")).val(v.id_servicio);
						$("#evento",$("#formevento")).html("<option value="+v.id+">"+v.fecha+ " "+ v.estado_evento+" "+ v.detalle +"</option>");
						$("#evento",$("#formevento")).val(v.evento_id); 
	                    $("#detalle",$("#formevento")).val("");
						$("#fecha",$("#formevento")).val(v.fechaformato);
						$("#hora",$("#formevento")).val("");
						$("#estado_evento",$("#formevento")).val("");
						 		 		
					}	
				  
				 	 $(".update",$("#formevento")).show();
					fx_div("#formevento"); 			  
				  },
                error: function(e)
                {
                    fx_alert("danger","Ocurrio un error en el servidor .."+e);
                }
            });
}


function add_servicio()	 
{
	$(".update",$("#formservicio")).hide();
	$("#id",$("#formservicio")).val("");
	$("#nombre",$("#formservicio")).val("");
	$("#estado",$("#formservicio")).val("vigente"); 
	fx_div("#formservicio");
}
function add_estado(data)	 
{
$('#color').val("error");
fsc("error");	
 $(".update",$("#formestado")).hide();
 $("#id",$("#formestado")).val("");
 $("#nombre",$("#formestado")).val("");
  $("#estado",$("#formestado")).val("");
 fx_div("#formestado");
}
function add_evento(data)	 
{ $(".update",$("#formevento")).hide();

  $("#id",$("#formevento")).val("");
  $("#detalle",$("#formevento")).val("");
  $("#fecha",$("#formevento")).val("");
  $("#hora",$("#formevento")).val("");
	
 			 $.ajax({
                url:   "get/servicios.php",
                type:  "POST",
                dataType: "json",
                success:  function (r) 
                {  
					var salida="<option value=''>Seleccione Servicio</option>";
					
					for(var i = 0; i < r.servicios.length; i++) 
					{		
						var v = r.servicios[i];

						if (v.estado=='vigente'){
				 
						salida=salida+"<option value='"+v.id+"'>"+v.servicio+"</option>";
						}							 		
					}	
				   $("#servicio").html(salida);
			 			 $.ajax({
                url:   "get/estados.php",
                type:  "POST",
                dataType: "json",
                success:  function (r) 
                {  
					var salida="<option value=''>seleccione un estado</option>";
					
					for(var i = 0; i < r.estados.length; i++) 
					{		
						var v = r.estados[i];

						if (v.estado=='vigente'){
				 
						salida=salida+"<option value='"+v.id+"'>"+v.nombre+"</option>";
						}
						
						
						
								 		
					}	
				   $("#estado_evento").html(salida);
				 fx_div("#formevento");
					 			  
				  },
                error: function(e)
                {
                    fx_alert("danger","Ocurrio un error en el servidor .."+e);
                }
            })
					 			  
				  },
                error: function(e)
                {
                    fx_alert("danger","Ocurrio un error en el servidor .."+e);
                }
            })
	
}
function add_usuario()	 
{
	$(".update",$("#formusuario")).hide();
	$("#id",$("#formusuario")).val("");
	$("#nombre",$("#formusuario")).val("");
	$("#login",$("#formusuario")).val("");
	$("#mail",$("#formusuario")).val("");
	$("#password",$("#formusuario")).val("");
	$("#estado",$("#formusuario")).val("vigente"); 
	fx_div("#formusuario");
}
function fsc(data)
{   $('#color').val(data);
	$("#selcolor").removeClass();
	$("#selcolor").addClass("badge");
	$("#selcolor").addClass("badge-"+data);
	
	}
		
		
		function grabar_estado()
			{
				
				id=$("#id",$("#formestado")).val();
				url="post/estado.php";
				
				if (id*1>0) {
					url="update/estado.php";
	
			       }
			if ( $("#nombre",$("#formestado")).val()=="")
			{
				fx_alert("info","Complete el campo nombre , gracias");
				return false;
				}
				
				 $.ajax({
                url:   url,
                type:  "POST",
                dataType: "json",
				data: $("#form",$("#formestado")).serialize(),
                success:  function (r) 
                {  
				estados($('#m2'));	
				 fx_alert(r.tipo,r.respuesta);
					 			  
				  },
                error: function(e)
                {
                    fx_alert("danger","Ocurrio un error en el servidor .."+e);
                }
            });
				
			}
				function grabar_servicio()
			{
				
				
				id=$("#id",$("#formservicio")).val();
				url="post/servicio.php";
				
				if (id*1>0) {
					url="update/servicio.php";
	
			}
			
				if ( $("#nombre",$("#formservicio")).val()=="")
			{
				fx_alert("info","Complete el campo nombre , gracias");
				return false;
				}
				 $.ajax({
                url:  url ,
                type:  "POST",
                dataType: "json",
				data: $("#form",$("#formservicio")).serialize(),
                success:  function (r) 
                {  
				 
				servicios($('#m1'));	
				 fx_alert(r.tipo,r.respuesta);
					 			  
				  },
                error: function(e)
                {
                    fx_alert("danger","Ocurrio un error en el servidor .."+e);
                }
            });
				
	
				
			}
			
					function grabar_evento()
			{
				
				id=$("#id",$("#formevento")).val();
				url="post/evento.php";
				
				if (id*1>0) {
					url="update/evento.php";
	
			}
			
			if ( $("#servicio",$("#formevento")).val()=="")
			{
				fx_alert("info","Complete el campo servicio , gracias");
				return false;
			}
			if ( $("#detalle",$("#formevento")).val()=="")
			{
				fx_alert("info","Complete el campo detalle , gracias");
				return false;
			}
		 	if ( $("#fecha",$("#formevento")).val()=="")
			{
				fx_alert("info","Complete el campo fecha , gracias");
				return false;
			}
			if ( $("#hora",$("#formevento")).val()=="")
			{
				fx_alert("info","Complete el campo hora , gracias");
				return false;
			}
			
				if ( $("#estado_evento",$("#formevento")).val()=="")
			{
				fx_alert("info","Complete el campo Estado evento , gracias");
				return false;
			}
			
				 $.ajax({
                url:  url,
                type:  "POST",
                dataType: "json",
				data: $("#form",$("#formevento")).serialize(),
                success:  function (r) 
                {  
				 getServicios();
				eventos($('#m3'));	
				 fx_alert(r.tipo,r.respuesta);
					 			  
				  },
                error: function(e)
                {
                   fx_alert("danger","Ocurrio un error en el servidor .."+e);
                }
            });
				
			}
				
	function grabar_usuario()
			{
				
				
				id=$("#id",$("#formusuario")).val();
				url="post/usuario.php";
				
				if (id*1>0) {
					url="update/usuario.php";
	
			}
			
				if ( $("#login",$("#formusuario")).val()=="")
			{
				fx_alert("info","Complete el campo login , gracias");
				return false;
			}
				
					if (id*1==0) {
					if ( $("#password",$("#formusuario")).val()=="")
			{
				fx_alert("info","Complete el campo password , gracias");
				return false;
			}
	
			}
				if ( $("#nombre",$("#formusuario")).val()=="")
			{
				fx_alert("info","Complete el campo nombre , gracias");
				return false;
			}
				 $.ajax({
                url:  url ,
                type:  "POST",
                dataType: "json",
				data: $("#form",$("#formusuario")).serialize(),
                success:  function (r) 
                {  
				 
				usuarios($('#m4'));	
				 fx_alert(r.tipo,r.respuesta);
					 			  
				  },
                error: function(e)
                {
                    fx_alert("danger","Ocurrio un error en el servidor .."+e);
                }
            });
				
	
				
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
                    fx_alert("danger","Ocurrio un error en el servidor .."+e);
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
					var salida="";
					arr_servicios=new Array();
					for(var i = 0; i < r.servicios.length; i++) 
					{		var cuerpo=$("#cuerpo",$("#renderServicio")).html();
					      var aux=$(cuerpo);
					 
					 
						var v = r.servicios[i];

						
						$("#e1",aux).html(v.id);
						$("#e2",aux).html(v.servicio);
						$("#e3",aux).html('<span class="badge badge-'+v.color+'">&nbsp;</span> ' + v.estado_servicio);
						$("#e4",aux).html(v.estado);
						arr_servicios[v.id]=v;
						
						salida=salida+"<tr id='servicio"+v.id+"'>"+$(aux).html()+"</tr>";
						
								 		
					}	
				   $("#cuerpotabla",$("#divservicios")).html(salida);
				 
					 			  
				  },
                error: function(e)
                {
                    fx_alert("danger","Ocurrio un error en el servidor .."+e);
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
					{		var cuerpo=$("#cuerpo",$("#renderEstado")).html();
					      var aux=$(cuerpo);
					 
					 
						var v = r.estados[i];

						
						$("#e1",aux).html(v.id);
						$("#e2",aux).html(v.nombre);
						$("#e3",aux).html('<span class="badge badge-'+v.color+'">&nbsp;</span>');
						$("#e4",aux).html(v.estado);
						arr_estados[v.id]=v;
						
						salida=salida+"<tr>"+$(aux).html()+"</tr>";
						
								 		
					}	
				   $("#cuerpotabla",$("#divestados")).html(salida);
				 
					 			  
				  },
                error: function(e)
                {
                    fx_alert("danger","Ocurrio un error en el servidor .."+e);
                }
            });
				
				}
		function getEventos()
			{
				 $.ajax({
                url:   "get/evento_detalle.php",
                type:  "POST",
                dataType: "json",
                success:  function (r) 
                {  
					var salida="";
					for(var i = 0; i < r.eventos.length; i++) 
					{		var cuerpo=$("#cuerpo",$("#renderEvento")).html()
					      var aux=$(cuerpo);
					 
					 
						var v = r.eventos[i];

						$("#e1",aux).html(v.id);

						$("#e3",aux).html(v.detalle);
						$("#e4",aux).html(v.fecha);
						$("#e5",aux).html(v.estado_evento);
						$("#e6",aux).html(v.estado);
						if (v.id==v.evento_id){
						$("#e8",aux).html("Nuevo evento");
						
						}else {
						$("#e8",aux).html("Detalle");
						$("#plus",aux).remove();
						}
						arr_eventos[v.id]=v;	 										                        $("#e2",aux).html("<span class='badge badge-"+arr_servicios[v.id_servicio].color+"' >&nbsp;</span> "+ arr_servicios[v.id_servicio].servicio);	
						salida=salida+"<tr>"+$(aux).html()+"</tr>";
					}	
				  
				 $("#cuerpotabla",$("#diveventos")).html(salida);
					 			  
				  },
                error: function(e)
                {
                    fx_alert("danger","Ocurrio un error en el servidor .."+e);
                }
            });
				
				}
				
					function getUsuarios()
			{
				 $.ajax({
                url:   "get/usuarios.php",
                type:  "POST",
                dataType: "json",
                success:  function (r) 
                {  
					var salida="";
					 
					for(var i = 0; i < r.usuarios.length; i++) 
					{		var cuerpo=$("#cuerpo",$("#renderUsuario")).html();
					      var aux=$(cuerpo);
					 
					 
						var v = r.usuarios[i];

						
						$("#e1",aux).html(v.id);
						$("#e2",aux).html(v.login);
						$("#e3",aux).html(v.nombre);
						$("#e4",aux).html(v.mail);
						$("#e5",aux).html(v.estado);
					 
						
						salida=salida+"<tr>"+$(aux).html()+"</tr>";
						
							 		
					}	
				   $("#cuerpotabla",$("#divusuarios")).html(salida);
				 
					 			  
				  },
                error: function(e)
                {
                    fx_alert("danger","Ocurrio un error en el servidor .."+e);
                }
            });
				
				}
				function cambioServicio(data)
				{
									 $.ajax({
                url:   "get/eventos.php",
                type:  "POST",
                dataType: "json",
				data:"servicio="+$(data).val(),
                success:  function (r) 
                {  
					var salida="<option value=''>Nuevo Evento</option>";
					for(var i = 0; i < r.eventos.length; i++) 
					{		 
					 
						var v = r.eventos[i];

				 
						salida=salida+"<option value="+v.evento_id+">"+v.original+"- "+v.estado_evento+" "+ v.detalle +"</tr>";
					}	
				  
				 $("#evento",$("#formevento")).html(salida);
					 			  
				  },
                error: function(e)
                {
                    fx_alert("danger","Ocurrio un error en el servidor .."+e);
                }
            });
				
				}
				
function fx_alert(tipo,texto)
{
 $("#msg").removeClass().addClass("alert alert-"+tipo).html(texto);
 $('#alert').modal("show");
}

$('#fecha').datepicker({
	format: "yyyy-mm-dd",
    todayBtn: "linked",
    language: "es",
	todayHighlight: true,
    autoclose: true
});
$('#hora').clockpicker({
    donetext: 'Listo'
});
</script>
