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
$sql = "SELECT count(*) as num_cons FROM consulta WHERE id_paciente=".$_POST['id_expediente'];
$datos = $con->select($sql);
$num_cons;
if($fila=mysqli_fetch_array($datos)) $num_cons = $fila['num_cons'];
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
          <select class="form-control" id="tipo_archivo" name="tipo_arc">
            <option value="1">Imagen</option>
            <option value="2">Video</option>
            <option value="3">Audio</option>
          </select>
          <label>Archivo</label>
          <input type="file" id="archivo_subir" class="form-control" name="archivo" required>
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
  switch ($fila['tipo_arc']) {
    case 1:$span = '<span class="icon-image"></span> Imagen'; $tipo='Imagen';break;
    case 2:$span = '<span class="icon-film"></span> Video'; $tipo='Video';break;
    case 3:$span = '<span class="icon-music"></span> Audio'; $tipo='Audio';break;
  }
  $fecha = explode('-', $fila['fecha_arc']);
  $fecha = $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
  echo "
  <tr>
  <th>$fila[fecha_arc]</th>
  <th>$fila[nom_arc]</th>
  <th>$span</th>
  <th>
  <a href='#' onclick='abrirReproductor(\"$fila[tipo_arc]\",\"$tipo - $fila[nom_arc] - $fecha\",\"archivos/$fila[ubi_arc]\");' id='archivos/$fila[ubi_arc]'  style='color:blue;'><span class='icon-download2'></span> Ver archivo</a><br>
  <a href='#' onclick='eliminarArchivo($fila[id_archivo],$id_expediente);' style='color:red'><span class='icon-bin'></span> Eliminar</a><br>
  <a href='#' onclick='window.open(\"archivos/$fila[ubi_arc]\");' style='color:black'><span class='icon-download'></span> Descargar</a>
  </th>
  </tr>
  ";
}
 ?>
</table>

</div>
</center>
<script type="text/javascript">
$(document).ready(function(){
  $("#form_subir_archivos").submit(function(e){
    var archivo = $("#archivo_subir")[0].files[0];
    var nombre = archivo.name;
    var extension = nombre.substring(nombre.lastIndexOf('.') + 1);
    var tipo = $("#tipo_archivo").prop('value');
    switch(tipo)
    {
      case '1':
        if(!isImagen(extension))
        {
          e.preventDefault();
          swal("Tipo de imagen inválida","Los formatos de imagen permitidos son: jpg, jpeg, png y gif");
        }
      break;
      case '2':
        if(!isVideo(extension))
        {
          e.preventDefault();
          swal("Tipo de video inválido","Los formatos de video permitidos son: mp4, webm, m4v y ogv");
        }
      break;
      case '3':
        if(!isAudio(extension))
        {
          e.preventDefault();
          swal("Tipo de audio inválido","Los formatos de audio permitidos son: mp3, oga, m4a y wav");
        }
      break;
    }
  });
});
</script>