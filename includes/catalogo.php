<br><br>
<center> <h3>CATÁLOGO DE EXPEDIENTES</h3> </center>
<table class="table table-hover">
<tr>
<th>N° Expediente</th>
<td>Nombre</th>
<th>Fecha de nacimiento</th>
<th>Edad</th>
<th>Total de consulta</th>
<th>Estatus</th>
</tr>
<?php 
include '../control/conexion.php';
$con = new Conexion();
$sql = "SELECT * FROM paciente ";
$datos = $con->select($sql);
while($fila=mysqli_fetch_array($datos))
{
echo'
<tr style="cursor:pointer;" onclick="abrirExpediente('.$fila['id_paciente'].');">
<td>'.$fila['id_paciente'].'</td>
<td>'.$fila['nombre_paci'].' '.$fila['paterno_paci'].' '.$fila['materno_paci'].'</td>
<td>'.$fila['naci_paci'].'</td>
<td>'.$fila['edad_paci'].'</td>
<td>Total de consulta</td>
<td>'.$fila['edo_exp'].'</td>
</tr>
';
}
 ?>
</table>