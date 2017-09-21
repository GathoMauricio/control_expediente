<?php include 'head.php'; ?>
<center>
<br><br><br><br>
<div class="contenedor_instalacion">
<h4>Bievenido al sistema de control de expedientes.</h4>
Antes de comenzar necesitamos prepararnos para el primer uso para lo cual vamos a crear un administrador de sistema por favor rellena a continuación los siguientes campos. <br><br>
<form id="form_crear_administrador" class="form" method="POST">
	<input type="hidden" name="tipo_usuario" value="Administrador">
	<label><span class="icon-user"></span> Ingrese un nombre de usuario.</label>
	<input type="text" name="usuario" class="form-control" required>
	<label><span class="icon-lock"></span> Ingrese una contraseña segura.</label>
	<input type="password" id="txt_contrasena_admin" name="contrasena" class="form-control" required>
	<label> <span class="icon-lock"></span> Repita la contraseña.</label>
	<input type="password" id="txt_recontrasena_admin" name="recontrasena" class="form-control" required>
	<label><span class="icon-profile"></span> Ingrese su nombre.</label>
	<input type="text" name="nombre" class="form-control" required>
	<label><span class="icon-profile"></span> Ingrese su apellido paterno.</label>
	<input type="text" name="apaterno" class="form-control" required>
	<label><span class="icon-profile"></span> Ingrese su apellido materno.</label>
	<input type="text" name="amaterno" class="form-control" required>
	<br><br>
	<input type="submit" class="btn btn-primary" style="width:100%;" value="Registrar cuenta de administrador">
</form>
</div>
</center>
<?php include 'footer.php'; ?>	
<script type="text/javascript">
$(document).ready(function(e){
	$("#form_crear_administrador").submit(function(e){
		e.preventDefault();
		var contrasena = $("#txt_contrasena_admin").prop('value');
		var recontrasena = $("#txt_recontrasena_admin").prop('value');
		if(contrasena==recontrasena)
		{
			swal({
				title:'Espere',
				text:'Enviando información y creando la base de datos',
				showConfirmButton:false
			});
			$.post('control/conexion.php?e=crearBase',$("#form_crear_administrador").serialize(),function(data){
				console.log(data);
				var json = JSON.parse(data);
				if(json.error>0){
					swal("Aviso",json.mensaje);
				}else{
					alert(json.mensaje);
					window.location='index.php';
				}
				
			});
		}else{
			swal('Aviso',"Las contraseñas deben coincidir",'error');
		}
	});
});
</script>