<br><br>
<center>
<h2>EXPEDIENTE</h2>
<div class="expediente">
<table style="width:100%;">
<tr>
	<td> <button onclick="iniciarConsulta(<?php echo $_GET['id_expediente']; ?>);" class="btn btn-primary" style="">Iniciar consulta</button> </td>
<td> <button onclick="agregarBuzon(<?php echo $_GET['id_expediente']; ?>);" class="btn btn-primary" style="">Enviar a buzón</button> </td>
<td> <button onclick="informacionGral(<?php echo $_GET['id_expediente']; ?>);" class="btn btn-primary" style="">Información Gral</button> </td>
<?php 
session_start();
if($_SESSION['tipo_usu']=='Doctor')echo'

<td> <button onclick="historiaClinica('.$_GET['id_expediente'].');" class="btn btn-primary" style="">Historia clínica</button> </td>
<td> <button onclick="consultas('.$_GET['id_expediente'].');"  class="btn btn-primary" style="">Consultas</button> </td>
<td> <button onclick="archivos('.$_GET['id_expediente'].');"  class="btn btn-primary" style="">Archivos</button> </td>';
 ?>
 <?php 
include "../control/conexion.php";
$con = new Conexion();
$sql = "SELECT * FROM paciente WHERE id_paciente=".$_GET['id_expediente'];
$datos = $con->select($sql);
$data;
if($fila=mysqli_fetch_array($datos)) $data = $fila;

$sql = "SELECT count(*) as num_cons FROM consulta WHERE id_paciente=".$_GET['id_expediente'];
$datos = $con->select($sql);
$num_cons;
if($fila=mysqli_fetch_array($datos)) $num_cons = $fila['num_cons'];

$sql = "SELECT count(*) as num_pase FROM consulta WHERE pase_cons = '".$data['pase_id']."'";
$datos = $con->select($sql);
$num_pase;
if($fila=mysqli_fetch_array($datos)) $num_pase = $fila['num_pase'].' de '.$data['pase_tot'];
 ?>
</tr>
</table>
<br><br>
<table>
<tr>
<td style="padding:20px;"><label style="color:blue;">Numero de expediente: </label></td><td><?php echo $data['id_paciente']; ?></td>
</tr>
<tr>
<td style="padding:20px;"><label style="color:blue;">Nombre: </label></td><td><?php echo $data['nombre_paci']; ?> <?php echo $data['paterno_paci']; ?> <?php echo $data['materno_paci']; ?></td>
</tr>
<tr>
<td style="padding:20px;"><label style="color:blue;">Total de visitas: </label></td><td><?php echo $num_cons; ?></td>
</tr>
<tr>
<td style="padding:20px;"><label style="color:blue;">Estado: </label> </td><td><?php echo $data['edo_exp']; ?></td>
</tr>
<tr>
<td style="padding:20px;"><label style="color:blue;">Pases usados: </label></td><td><?php echo $num_pase; ?></td>
</tr>
</table>
<a href="#" style="float:right;color:red;" onclick="eliminarExpediente(<?php echo $data['id_paciente']; ?>);">[Eliminar expediente]</a>
<br>
</center>
