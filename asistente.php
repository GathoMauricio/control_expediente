<?php include 'head.php'; ?>
<?php 
session_start();
if(isset($_SESSION['tipo_usu']))
{
	switch($_SESSION['tipo_usu'])
	{
		case 'Doctor': header('Location: doctor.php'); break;
		case 'Administrador': header('Location: administrador.php'); break;
	}
}else{
	header('Location: index.php');
}
 ?>
<style type="text/css">
.contenedor_menu_asistente{
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
<div class="contenedor_menu_asistente">
<label style="float:right;color:red;cursor:pointer;" title="Cerrar sesión" onclick="cerrarSesion();"><span class='icon-exit'></span></label><br>
<label style="float:right;"><?php echo $_SESSION['tipo_usu'].': '.$_SESSION['nombre']; ?></label><br><br>
<h4>Menú de Asistente.</h4>
Estas son las opciones  disponibles para el menú de asistente.
<br><br><br>
<button style="width:100%;" class="btn btn-primary" onclick="openNuevoPaciente();">Nuevo paciente</button>
<br><br>
<button style="width:100%;" class="btn btn-primary" onclick="expedientes();">Enviar a buzón</button>
<br><br><br>
</div>
</center>
  <?php include 'footer.php'; ?>	
  <script type="text/javascript">
function openNuevoPaciente()
{
  window.location="nuevo_paciente.php";
}
function expedientes()
{
  window.location="expedientes.php";
}
  </script>