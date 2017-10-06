<?php set_time_limit(3000); ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/font.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<title>Test Sistema</title>
</head>
<body>
	
	
	<div class="menu" style="background-color:transparent;">
		
	</div>
	<div class="buzon" style="background-color:transparent;">

	</div>

	<div class="contenedor" id="contenedor" style="background-color:white;">
		<center>
			<br><br><br><br>
			<div class="login">
				<h3 style="color:white;">ACCESO</h3>
				<label style="color:white;text-align:left;">Bienvenido al sistema por favor ingrese sus credenciales de acceso a continuación...</label>
				<form id="form_login" class="form" method="POST">
					<label style="color:white;text-align:left;"><span class="icon-user"></span> Ingrese su nombre de usuario.</label>
					<input type="text" name="usuario" class="form-control" required>
					<label style="color:white;text-align:left;"><span class="icon-lock"></span> Ingrese su contraseña.</label>
					<input type="password" name="contrasena" class="form-control" required>
					<br>
					<input type="submit" class="btn btn-primary" style="width:100%;" value="Iniciar sesión">
				</form>
			</div>
		</center>
	</div>

	<div class="buscador">
		<center><h3>SISTEMA DE CONTROL DE EXPEDIENTES MÉDICOS</h3></center>
	</div>	
</body>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="dist/sweetalert.js"></script>
<script type="text/javascript" src="js/index.js"></script>
<script type="text/javascript">
$(document).ready(function(){

		$.post('control/conexion.php?e=existeBD',{},function(data){
		if(data > 0)
		{
			//console.log("La base de datos ya existe!");
		}else{
			$.post('includes/instalacion.php',{},function(data){ $("#contenedor").html(data); });
		}
		});

	$("#form_login").submit(function(e){
		e.preventDefault();
		$.post('control/ctrl_usuario.php?e=iniciarSesion',$("#form_login").serialize(),function(data){
			var json = JSON.parse(data);
			if(json.error>0)
			{
				swal('Aviso',json.mensaje);
			}else{
				window.location='doctor.php';
			}
		});
	});
	
});
</script>
</html>