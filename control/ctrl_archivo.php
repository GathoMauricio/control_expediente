<?php 
if(isset($_GET['e']))
{
switch ($_GET['e']) {
	case 'subirArchivo': subirArchivo(); break;
	case 'eliminarArchivo': eliminarArchivo(); break;
}	
}
function subirArchivo()
{
  echo "Guardando archivo espere por favor...";
  if ($_FILES['archivo']["error"] > 0)
  {
  echo "Error: " . $_FILES['archivo']['error'] . "<br>";
  }
  else
  {
}
  $nombreArchivo="$_POST[id_paciente]_".date('d-m-Y s')."_".$_FILES['archivo']['name'];
  move_uploaded_file($_FILES['archivo']['tmp_name'],"../archivos/".$nombreArchivo);
  date_default_timezone_set('America/Mexico_City');
  include 'conexion.php';
  $con = new Conexion();
  $sql="INSERT INTO archivo (id_paciente,fecha_arc,nom_arc,tipo_arc,ubi_arc) 
  VALUES ($_POST[id_paciente],'".date('Y-m-d')."','$_POST[nom_arc]','$_POST[tipo_arc]','$nombreArchivo') ";
  if($con->insert($sql))
  {
  	echo "Archivo subido.";
  	header("Location: ../system.php?id_expediente=".$_POST['id_paciente']);
  }else{
  	echo "Error: ".$sql;
  }
}
function eliminarArchivo()
{
	include 'conexion.php';
  	$con = new Conexion();
  	$sql="SELECT * FROM archivo WHERE id_archivo=".$_GET['id_archivo'];
  	$datos=$con->select($sql);
	if($fila=mysqli_fetch_array($datos))
	{
		if(unlink("../archivos/$fila[ubi_arc]")){
			if($con->delete("DELETE FROM archivo WHERE id_archivo=".$_GET['id_archivo']))
			{
				echo "Archivo eliminado.";
  			header("Location: ../system.php?id_expediente=".$_GET['id_expediente']);
			}
		}else{
			echo "Error: ".$sql;
		}
	}
	
}
 ?>