  <?php 
include '../control/conexion.php';
$con = new Conexion();
//Obtener datos
$id_expediente;
if(isset($_POST['id_expediente']))
{
  $id_expediente=$_POST['id_expediente'];
}else{
  $id_expediente=$_GET['id_expediente'];
} 

$datos=$con->select("SELECT * FROM paciente  WHERE id_paciente=".$id_expediente);
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
<div class="archivos">
<table style="width:100%;">
<tr>
  <td> <button onclick="iniciarConsulta(<?php echo $_POST['id_expediente']; ?>);" class="btn btn-primary" style="">Iniciar consulta</button> </td>
<td> <button onclick="agregarBuzon(<?php echo $_POST['id_expediente']; ?>);" class="btn btn-primary" style="">Enviar a buzón</button> </td>
<td> <button onclick="informacionGral(<?php echo $_POST['id_expediente']; ?>);" class="btn btn-primary" style="">Información Gral</button> </td>
<?php 
session_start();
if($_SESSION['tipo_usu']=='Doctor')echo'

<td> <button onclick="historiaClinica('.$_POST['id_expediente'].');" class="btn btn-primary" style="">Historia clínica</button> </td>
<td> <button onclick="consultas('.$_POST['id_expediente'].');"  class="btn btn-primary" style="">Consultas</button> </td>
<td> <button onclick="archivos('.$_POST['id_expediente'].');"  class="btn btn-primary" style="">Archivos</button> </td>';
 ?>
 </tr>
</table>
<h4>Archivos.</h4>

<label>Paciente: </label> <?php echo $data['nombre_paci']." ".$data['paterno_paci']." ".$data['materno_paci']; ?>
<br>
<center> <h3>Subir archivo</h3> </center>
<form class="form" id="form_subir_archivos" action="control/ctrl_archivo.php?e=subirArchivo" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="id_paciente" value="<?php echo $_POST['id_expediente']; ?>"/>
          <label>Nombre del archivo</label>
          <input type="text" class="form-control" name="nom_arc" required>
          <label>Tipo de archivo</label>
          <input type="text" class="form-control" name="tipo_arc" required>
          <label>Archivo</label>
          <input type="file" class="form-control" name="archivo" required>
          <br><br>
          <input type="submit" class="btn btn-primary" style="width:100%;">
</form>
<center> <h3>Archivos disponibles</h3> </center>
<table class="table" style="width:100%;">
<tr>
<th>Fecha de subida</th>
<th>Nombre del archivo</th>
<th>Tipo de archivo</th>
<th>Opciones</th>
</tr>
<?php 
$sql="SELECT * FROM archivo WHERE id_paciente=".$id_expediente;
$datos = $con->select($sql);
while($fila=mysqli_fetch_array($datos))
{
  echo "
  <tr>
  <th>$fila[fecha_arc]</th>
  <th>$fila[nom_arc]</th>
  <th>$fila[tipo_arc]</th>
  <th>
  <a href='archivos/$fila[ubi_arc]' target='_BLANK' style='color:white;'><span class='icon-download2'></span> Ver archivo</a>
  <a href='#' onclick='eliminarArchivo($fila[id_archivo],$id_expediente);' style='color:red'><span class='icon-bin'></span> Eliminar</a>
  </th>
  </tr>
  ";
}
 ?>
</table>

</div>
</center>