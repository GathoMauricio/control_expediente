<?php set_time_limit(3000); ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="css/alert.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/font.css">
	<link rel="stylesheet" type="text/css" href="css/google.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<title>Test Sistema</title>
</head>
<body>
	
	
	<div class="menu">
		<center>
			<h1>MENÚ</h1>
			<hr>
		</center>
		<label class="item-menu"><span class="icon-user"></span> NUEVO EXPEDIENTE</label>
		<br><br>
		<label class="item-menu"><span class="icon-users"></span> CATÁLOGO</label>
		<br><br>
		<label class="item-menu"><span class="icon-file-excel"></span> EXPORTAR</label>
		<br><br>
		<label class="item-menu"><span class="icon-cog"></span> AJUSTES</label>
		<br><br>
		<label class="item-menu"><span class="icon-exit"></span> SALIR</label>
	</div>
	<div class="buzon">
		<center>
			<h1>BUZÓN</h1>
			<hr>
		</center>
		<div class="item-box">
			<span class="icon-cross" title="Remover del buzón..." style="float:right;color:gray;cursor:pointer;"></span><br>
			<div class="item-buzon">
				MAURICIO KATZE SORIANO
				<br>
				04/10/2017 a las 9:00 Hrs.
				<br>
				(Nuevo expediente)
			</div>
			<hr>
			<div class="item-buzon">
				MAURICIO KATZE SORIANO
				<br>
				04/10/2017 a las 9:00 Hrs.
				<br>
				(Nuevo expediente)
			</div>
			<hr>
			<div class="item-buzon">
				MAURICIO KATZE SORIANO
				<br>
				04/10/2017 a las 9:00 Hrs.
				<br>
				(Nuevo expediente)
			</div>
			<hr>
			<div class="item-buzon">
				MAURICIO KATZE SORIANO
				<br>
				04/10/2017 a las 9:00 Hrs.
				<br>
				(Nuevo expediente)
			</div>
			<hr>
			<div class="item-buzon">
				MAURICIO KATZE SORIANO
				<br>
				04/10/2017 a las 9:00 Hrs.
				<br>
				(Nuevo expediente)
			</div>
			<hr>
			<div class="item-buzon">
				MAURICIO KATZE SORIANO
				<br>
				04/10/2017 a las 9:00 Hrs.
				<br>
				(Nuevo expediente)
			</div>
			<hr>
		</div>
	</div>

	<div class="contenedor">
	</div>

	<div class="buscador">
		<label style="width:100%;text-align:right;">DOCTOR: FULANO PEREZ MOTA</label>
		<input type="text" class="form-control"  id="tags" placeholder="Escriba el nombre del paciente a quien pertenece el expediente..." onkeyup="buscarExpediente(this.value);">
	</div>	
	<div class="busqueda">
		<div class="item-busqueda"><span class="icon-user"></span> FULANITO PERENGANO TEST</div>
		<div class="item-busqueda"><span class="icon-user"></span> FULANITO PERENGANO TEST</div>
		<div class="item-busqueda"><span class="icon-user"></span> FULANITO PERENGANO TEST</div>
		<div class="item-busqueda"><span class="icon-user"></span> FULANITO PERENGANO TEST</div>
	</div>

</body>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/index.js"></script>
</html>