<?php 
if(isset($_GET['e']))
{
switch ($_GET['e']) {
	case 'nuevaReligion': nuevaReligion(); break;
}	
}
function nuevaReligion()
{
	include 'conexion.php';
	$con = new Conexion();
	$sql = "INSERT INTO religion (religion) VALUES ('$_POST[religion]')";
	if($con->insert($sql))
	{
		echo "La religión ha sido agregada";
	}else{
		echo "Ocurrió un error en la petición: ".$sql;
	}
}
 ?>