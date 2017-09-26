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
.contenedor_nuevo_paciente{
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
<div class="contenedor_nuevo_paciente">
<label style="float:left;color:blue;cursor:pointer;" title="Inicio" onclick="window.history.back();"><span class='icon-home'></span></label>
<label style="float:right;color:red;cursor:pointer;" title="Cerrar sesión" onclick="cerrarSesion();"><span class='icon-exit'></span></label><br>
<label style="float:right;"><?php echo $_SESSION['tipo_usu'].': '.$_SESSION['nombre']; ?></label><br><br>
<h4>Archivos.</h4>

<label>Paciente: </label> <?php echo $data['nombre_paci']." ".$data['paterno_paci']." ".$data['materno_paci']; ?>

<table class="table" style="width:100%;">
<tr>
<th>Fecha de subida</th>
<th>Nombre del archivo</th>
<th>Tipo de archivo</th>
<th>Opciones</th>
</tr>
<?php 
$sql="SELECT * FROM archivo WHERE id_paciente=".$_GET['id_paciente'];
$datos = $con->select($sql);
while($fila=mysqli_fetch_array($datos))
{
  echo "
  <tr>
  <th>$fila[fecha_arc]</th>
  <th>$fila[nom_arc]</th>
  <th>$fila[tipo_arc]</th>
  <th>
  <a href='archivos/$fila[ubi_arc]' target='_BLANK'><span class='icon-download2'></span> Ver archivo</a>
  <a href='#' onclick='eliminarArchivo($fila[id_archivo]);' style='color:red'><span class='icon-bin'></span> Eliminar</a>
  </th>
  </tr>
  ";
}
 ?>
</table>

</div>
</center>
  <?php include 'forms/frm_buzon.php'; ?>
  <?php include 'forms/frm_subir_archivo.php'; ?>
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
        abrirBuzon();
      });
      //setTimeout(notif.close, 3000);
      });
    </script>
  <?php include 'footer.php'; ?>  
<script type="text/javascript">
$(document).ready(function(){
  pedirPermisoNotificar();
});
function buscarExpedienteAsistente(valor)
{
  $.post('control/ctrl_asistente.php?e=buscarPaciente',{valor:valor},function(data){ $("#tb_expedientes_asistente").html(data); })
}
function enviarBuzon(id_paciente)
{
  if(confirm("¿Enviar a la lista de espera?"))
  {
    $.post('control/ctrl_asistente.php?e=enviarBuzon',{id_paciente:id_paciente},function(data){ swal('Aviso',data); })
  }
}
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
  function eliminarArchivo(id_archivo)
  {
    if(confirm('¿Eliminar archivo?'))
    {
      window.location="control/ctrl_archivo.php?e=eliminarArchivo&id_archivo="+id_archivo;
    }
  }
</script>