<?php include 'head.php'; ?>
<?php 
session_start();
if(isset($_SESSION['tipo_usu']))
{
	switch($_SESSION['tipo_usu'])
	{
		case 'Administrador': header('Location: administrador.php'); break;
		case 'Doctor': header('Location: doctor.php'); break;
		case 'Asistente': header('Location: asistente.php'); break;
	}
}
 ?>
<style type="text/css">
.contenedor_login{
  padding: 20px;
  width: 60%;
  background-color: white;
  text-align: left;
  opacity: 0.9;
  box-shadow: 5px 5px 15px #0080FF;
  border-style: outset;
}
</style>
<center>
<br><br><br><br>
<div class="contenedor_login">
<h4>Bievenido al sistema de control de expedientes.</h4>
Por favor ingrese sus datos de acceso a continuación.
<form id="form_login" class="form" method="POST">
	<label><span class="icon-user"></span> Ingrese su nombre de usuario.</label>
	<input type="text" name="usuario" class="form-control" required>
	<label><span class="icon-lock"></span> Ingrese su contraseña.</label>
	<input type="password" name="contrasena" class="form-control" required>
	<br><br>
	<input type="submit" class="btn btn-primary" style="width:100%;" value="Iniciar sesión">
</form>
</div>
</center>
<?php include 'footer.php'; ?>	
<script type="text/javascript">
$(document).ready(function(){

		$.post('control/conexion.php?e=existeBD',{},function(data){
		if(data > 0)
		{
			//console.log("La base de datos ya existe!");
		}else{
			window.location="instalacion.php";
		}
		});

	$("#form_login").submit(function(e){
		e.preventDefault();
		$.post('control/ctrl_usuario.php?e=iniciarSesion',$("#form_login").serialize(),function(data){
			console.log(data);
			var json = JSON.parse(data);
			if(json.error>0)
			{
				swal('Aviso',json.mensaje);
			}else{
				switch(json.tipo_usuario)
				{
					case 'Administrador': window.location='administrador.php'; break;
					case 'Doctor': window.location='doctor.php'; break;
					case 'Asistente': window.location='asistente.php'; break;
				}
			}
		});
	});
	
});
</script>