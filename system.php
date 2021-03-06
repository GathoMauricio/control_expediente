<?php set_time_limit(3000); ?>
<?php date_default_timezone_set('America/Mexico_City'); ?>
<?php session_start(); ?>
<?php 
if(!isset($_SESSION['tipo_usu']))
{
	header('Location: index.php');
}
 ?>
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
	<link href="css/jplayer.blue.monday.min.css" rel="stylesheet" type="text/css" />
	<title>Control expedientes</title>
</head>
<body>
	<input type="hidden" id="id_expediente" value="0">
	<div class="menu">
		<center>
			<h1>MENÚ</h1>
			<hr>
		</center>
		<label class="item-menu" onclick="nuevoExpediente();"><span class="icon-user"></span> NUEVO EXPEDIENTE</label>
		<br><br>
		<label class="item-menu" onclick="catalogo();"><span class="icon-users"></span> CATÁLOGO</label>
		<br><br>
		<?php if ($_SESSION['tipo_usu']=='Doctor'): ?>
		<label class="item-menu" onclick="exportar();"><span class="icon-file-excel"></span> EXPORTAR</label>
		<br><br>
		<label class="item-menu" onclick="ajustes();"><span class="icon-cog"></span> AJUSTES</label>
		<br><br>
		<?php endif ?>
		<label class="item-menu" onclick="cerrarSesion();"><span class="icon-exit"></span> SALIR</label>
	</div>
	<div class="buzon">
		<center>
			<h1>BUZÓN</h1>
			<hr>
		</center>
		<div class="item-box" id="buzon">
			<!--Carga de items del buzón-->
		</div>
	</div>

	<div class="contenedor" id="contenedor">
		<!--Carga de contenido seleccionado-->
	</div>

	<div class="buscador">
		<label style="width:100%;text-align:right;"><?php echo $_SESSION['tipo_usu'].': '.$_SESSION['nombre']; ?></label>
		<input type="text" class="form-control"  id="tags" placeholder="Escriba el nombre del paciente a quien pertenece el expediente..." onkeyup="buscarExpediente(this.value);">
	</div>	
	<div class="busqueda">
	</div>
<?php include 'forms/frm_ver_usuarios.php'; ?>
<?php include 'forms/frm_nuevo_usuario.php'; ?>
<?php include 'forms/frm_actualizar_usuario.php'; ?>
<?php include 'forms/frm_importar_bd.php'; ?>
<?php include 'forms/frm_load.php'; ?>

<div class="backdrop"></div>
<div class="box"><div class="close"><span class="icon-cross"></span></div>
<label id="title_ligth_box">Title</label>
<div id="content_ligth_box">
<img src="img/fondo.jpg" style="width:100%;height:90%;">
</div>

<audio id="tono_mensaje" src="sound/tono.mp3"></audio>
</body>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="dist/sweetalert.js"></script>
<script type="text/javascript" src="js/index.js"></script>
<script src="https://js.pusher.com/4.1/pusher.min.js"></script>
  <script>
    Pusher.logToConsole = false;
    var notif;
    var pusher = new Pusher('be16aa8bec249ddd5126', {
      cluster: 'us2',
      encrypted: true
    });
	var channel = pusher.subscribe('canal_doctor');
    channel.bind('e_nuevo_paciente', function(data) {
      	document.getElementById('tono_mensaje').play();
 		cargarBuzon();
	});
  </script>
<script type="text/javascript">
$(document).ready(function(){
	inicio();
	cargarBuzon();
});
</script>

<?php if (isset($_GET['id_expediente'])): ?>
<script type="text/javascript">
$(function(){
	swal('Aviso','Se proceso el archivo con éxito');
	archivos(<?php echo $_GET['id_expediente']; ?>);
});
</script>	
<?php endif ?>
</html>