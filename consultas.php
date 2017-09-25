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
 <?php 
include 'control/conexion.php';
$con = new Conexion();
//Obtener datos
$datos=$con->select("SELECT * FROM paciente  WHERE id_paciente=".$_GET['id_paciente']);
$data;
if($fila=mysqli_fetch_array($datos))
{
  $data=$fila;
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
<h4>Consultas.</h4>
<br>
<label>Paciente: </label> <?php echo $data['nombre_paci']." ".$data['paterno_paci']." ".$data['materno_paci']; ?>
<br>
<table class="table" style="width:100%;">
<tr>
<th>Fecha de consulta</th><th>Número de consulta</th><th>Número de evolución</th><th>Opciones</th>
</tr>
<?php 
$sql = "SELECT * FROM consulta WHERE id_paciente=".$_GET['id_paciente']." ORDER BY no_cons DESC";
$datos = $con->select($sql);
while($fila=mysqli_fetch_array($datos))
{
  echo "
  <tr>
  <th>$fila[fecha_cons]</th>
  <th>$fila[no_cons]</th>
  <th>$fila[no_evo]</th>
  <th><button onclick='abrirConsulta($fila[id_consulta]);' title='Abrir datos de la consulta...' class='btn btn-default'><span class='icon-folder'></span></button></th>
  </tr>";
}
 ?>
</table>
</div>
</center>
<?php include 'forms/frm_buzon.php'; ?>
<?php include 'forms/frm_consulta.php'; ?>
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
  function abrirBuzon()
  {
    $.post('control/ctrl_doctor.php?e=getBuzon',{},function(data){  
      $("#contenedor_buzon").html(data);
      $("#modal_buzon").modal('show');
    });
    
  }
  function abrirConsulta(id_consulta)
  {
    $.post('control/ctrl_consulta.php?e=getConsulta',{id_consulta},function(data){
      $("#modal_consulta").modal('show');
    });
  }
  </script>