<?php include 'head.php'; ?>
<?php 
session_start();
if(isset($_SESSION['tipo_usu']))
{
	switch($_SESSION['tipo_usu'])
	{
		case 'Asistente': header('Location: asistente.php'); break;
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
<h4>Menú de Doctor.</h4>
Estas son las opciones  disponibles para el menú de doctor.
<br><br><br>
<button style="width:100%;" class="btn btn-primary" onclick="openNuevoPaciente();">
  <span class="icon-user-plus"></span> 
  Nuevo paciente
</button>
<br><br>
<button style="width:100%;" class="btn btn-primary" onclick="expedientes();">
  <span class="icon-users"></span> 
  Catálogo de pacientes
</button>
<br><br>
<button style="width:100%;" class="btn btn-primary" onclick="abrirBuzon();">
  <span class="icon-envelop"></span> 
  Buzón de pacientes (Lista de espera)
</button>
<br><br>
<button style="width:100%;" class="btn btn-primary" onclick="exportarListaPacientes();">
  <span class="icon-file-excel"></span> 
  Exportar lista de pacientes
</button>
<br><br><br>
</div>
</center>
<?php include 'forms/frm_buzon.php'; ?>

<audio id="tono_mensaje" src="sound/tono.mp3"></audio>
<script src="https://js.pusher.com/4.1/pusher.min.js"></script>
  <script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;
    var notif;
    var pusher = new Pusher('be16aa8bec249ddd5126', {
      cluster: 'us2',
      encrypted: true
    });

    var channel = pusher.subscribe('canal_doctor');
    channel.bind('e_nuevo_paciente', function(data) {
      //actualizar lista de buzon (lista de espera)

      var options = {
	    body: data.mensaje,
	    icon: "img/fondo.jpg"
		};
		document.getElementById('tono_mensaje').play();
 		notif = new Notification("Nuevo paciente en espera", options);
		notif.addEventListener("click",function(){
			alert("Abrir buzón (Lista de espera)");
		});
		//setTimeout(notif.close, 3000);
    });
  </script>
  <?php include 'footer.php'; ?>
  <script type="text/javascript">
	$(document).ready(function(){
		pedirPermisoNotificar();
	});
	function pedirPermisoNotificar()
	{
		Notification.requestPermission( function(status) {
    		if (status == "granted"){
         		//console.log("permiso concedido");
			}
			if (status == "denied"){
         		alert("Considere activar las notificaciones en la configuración del navegador para un correcto funcionamiento.");
			}
			if (status == "default"){
         		//console.log("no ha respondido explicar y mostrar de nuevo");
         		alert("Para que el sistema funcione de manera correcta se necesitan los permisos de Notification");
         		pedirPermisoNotificar();
			}
		});
	}
	function openNuevoPaciente()
	{
	  window.location="nuevo_paciente_doc.php";
	}
	function expedientes()
	{
	  window.location="expedientes_doc.php";
	}
  function abrirBuzon()
  {
    $.post('control/ctrl_doctor.php',{},function(data){  
      $("#contenedor_buzon").html(data);
      $("#modal_buzon").modal('show');
    });
    
  }
  function exportarListaPacientes()
  {
    window.open('lista_pacientes.php');
  }
  </script>