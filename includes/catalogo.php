<br><br>
<center> <h3>CATÁLOGO DE EXPEDIENTES</h3> </center>
<table class="table table-hover">
<tr>
<th>N° Expediente</th>
<th>Nombre</th>
<th>Fecha de nacimiento</th>
<th>Edad</th>
<th>Total de consultas</th>
<th>Estatus</th>
</tr>
<?php 
include '../control/conexion.php';
$con = new Conexion();
$sql = "SELECT * FROM paciente ";
$datos = $con->select($sql);
while($fila=mysqli_fetch_array($datos))
{
$sql = "SELECT count(*) as num FROM consulta WHERE id_paciente=".$fila['id_paciente'];	
$datos2 = $con->select($sql);
if($fila2=mysqli_fetch_array($datos2))
{
	$numCons=$fila2['num'];
}
$fecha=explode('-',$fila['naci_paci']);
$fecha=$fecha[2].'-'.$fecha[1].'-'.$fecha[0];
echo'
<tr style="cursor:pointer;" onclick="abrirExpediente('.$fila['id_paciente'].');">
<td>'.$fila['id_paciente'].'</td>
<td>'.$fila['nombre_paci'].' '.$fila['paterno_paci'].' '.$fila['materno_paci'].'</td>
<td>'.$fecha.'</td>
<td>'.$fila['edad_paci'].'</td>
<td>'.$numCons.'</td>
<td>'.$fila['edo_exp'].'</td>
</tr>
';
}
 ?>
</table>