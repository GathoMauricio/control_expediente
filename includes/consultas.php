 <?php 
include '../control/conexion.php';
$con = new Conexion();
//Obtener datos
$datos=$con->select("SELECT * FROM paciente  WHERE id_paciente=".$_POST['id_expediente']);
$data;
if($fila=mysqli_fetch_array($datos))
{
  $data=$fila;
}
$sql = "SELECT count(*) as num_cons FROM consulta WHERE id_paciente=".$_POST['id_expediente'];
$datos = $con->select($sql);
$num_cons;
if($fila=mysqli_fetch_array($datos)) $num_cons = $fila['num_cons'];
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

<div class="consultas">
<table style="width:100%;">
<tr>
<td> <button onclick="agregarBuzon(<?php echo $_POST['id_expediente']; ?>);" class="btn btn-primary" style="">Enviar a buzón</button> </td>
<td> <button onclick="informacionGral(<?php echo $_POST['id_expediente']; ?>);" class="btn btn-primary" style="">Información Gral</button> </td>
<?php 
session_start();
if($_SESSION['tipo_usu']=='Doctor')
{
  if($num_cons<=0)
  {
      echo'
  <td> <button onclick="iniciarConsulta('.$_POST['id_expediente'].');" class="btn btn-primary" style="">Iniciar consulta</button> </td>
  <td> <button onclick="consultas('.$_POST['id_expediente'].');"  class="btn btn-primary" style="">Consultas</button> </td>
  <td> <button onclick="archivos('.$_POST['id_expediente'].');"  class="btn btn-primary" style="">Archivos</button> </td>';
  }else{
    echo'
  <td> <button onclick="iniciarConsulta('.$_POST['id_expediente'].');" class="btn btn-primary" style="">Iniciar consulta</button> </td>
  <td> <button onclick="historiaClinica('.$_POST['id_expediente'].');" class="btn btn-primary" style="">Historia clínica</button> </td>
  <td> <button onclick="consultas('.$_POST['id_expediente'].');"  class="btn btn-primary" style="">Consultas</button> </td>
  <td> <button onclick="archivos('.$_POST['id_expediente'].');"  class="btn btn-primary" style="">Archivos</button> </td>';
  }
  
}
echo '<td> <button onclick="cerrarExpediente();"  class="btn btn-primary" style="">Cerrar expediente</button> </td>';
 ?>
 </tr>
</table>
<center><h2 id="up">CONSULTAS.</h2></center>
<br>
<label>Paciente: </label> <?php echo $data['nombre_paci']." ".$data['paterno_paci']." ".$data['materno_paci']; ?>
<br>
<table class="table" style="width:100%;">
<tr>
<th>Fecha de consulta</th><th>Número de consulta</th><th>Número de evolución</th><th>Opciones</th>
</tr>
<?php 
$sql = "SELECT * FROM consulta WHERE id_paciente=".$_POST['id_expediente']." ORDER BY no_cons DESC";
$datos = $con->select($sql);
while($fila=mysqli_fetch_array($datos))
{
  echo "
  <tr>
  <th>$fila[fecha_cons]</th>
  <th>$fila[no_cons]</th>
  <th>$fila[no_evo]</th>
  <th><button onclick='infoConsulta($fila[id_consulta]);' title='Abrir datos de la consulta...' class='btn btn-default'><span class='icon-folder'></span></button></th>
  <th><button onclick='eliminarConsulta($fila[id_paciente],$fila[id_consulta]);' title='Eliminar la consulta...' class='btn btn-default'><span class='icon-bin'></span></button></th>
  </tr>";
}
 ?>
</table>
</div>
</center>