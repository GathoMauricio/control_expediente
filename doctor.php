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
 <audio id="tono_mensaje" src="sound/tono.mp3"></audio>
<script src="https://js.pusher.com/4.1/pusher.min.js"></script>
  <script>
    // Enable pusher logging - don't include this in production
    //Pusher.logToConsole = true;
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
  </script>