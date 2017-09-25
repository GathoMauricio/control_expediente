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
//Remover de la lista de espera
$con->update("UPDATE paciente SET ref_exp=NULL WHERE id_paciente=".$_GET['id_paciente']);
//Obtener datos
$datos=$con->select("SELECT * FROM paciente WHERE id_paciente=".$_GET['id_paciente']);
$data;
if($fila=mysqli_fetch_array($datos))
{
  $data=$fila;
}
//Obtener numero de consultas
$datos=$con->select("SELECT count(*) AS numero_consultas FROM consulta WHERE id_paciente=".$_GET['id_paciente']);
$numero_consultas;
if($fila=mysqli_fetch_array($datos))
{
  $numero_consultas=$fila['numero_consultas'];
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
<h4>Nueva consulta.</h4>
<form class="form" id="form_consulta">
<input type="hidden" name="id_paciente" value="<?php echo $_GET['id_paciente']; ?>">
<label>Fecha de consulta</label><br>
<input type="date" name="fecha_cons" style="border:none;" value="<?php echo date('Y-m-d'); ?>" readonly>
<br>
<label>Paciente: </label><?php echo $data['nombre_paci']." ".$data['paterno_paci']." ".$data['materno_paci']; ?>
<br>
<label>N° de consulta</label>
<input type="number" name="no_cons" value="<?php echo ($numero_consultas+1); ?>" class="form-control" readonly>
<label>Edad</label>
<input type="number" name="edad_cons" class="form-control">
<label>Pase</label>
<input type="text" name="pase_cons" class="form-control">
<?php 
if($data['sex_paci']=='M')
{
  echo '<label>Fecha de última menstruación</label>';
  echo '<input type="date" name="fum_cons" class="form-control">';
}else{
    echo '<input type="hidden" name="fum_cons" class="form-control">';
}
 ?>
 <label>N° de Evolución</label>
<input type="text" name="no_evo" value="<?php echo $numero_consultas; ?>" class="form-control" readonly>
 <label>Descripcion de Evolución</label>
<textarea  name="desc_evo" class="form-control"></textarea><br><br>
<input type="submit" class="btn btn-primary" style="width:100%;">
<br><br>
</form>
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
        abrirBuzon();
      });
      //setTimeout(notif.close, 3000);
      });
    </script>
</div>
</center>
<?php include 'footer.php'; ?>

<script type="text/javascript">
$(document).ready(function(){
  $("#form_consulta").submit(function(e){
    e.preventDefault();
    if(confirm("¿Guardar consulta?"))
    {
      $.post('control/ctrl_consulta.php?e=insertConsulta',$("#form_consulta").serialize(),function(data){
        alert(data);
        console.log(data);
        window.location="doctor.php";
      });
    }
  });
  pedirPermisoNotificar();
});
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
</script>