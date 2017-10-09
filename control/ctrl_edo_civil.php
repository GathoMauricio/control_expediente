<?php 
if(isset($_GET['e']))
{
switch ($_GET['e']) {
	case 'nuevoEdoCivil': nuevoEdoCivil(); break;
}	
}
function nuevoEdoCivil()
{
	include 'conexion.php';
	$con = new Conexion();
	$sql = "INSERT INTO edo_civil (edo_civil) VALUES ('$_POST[edo_civil]')";
	if($con->insert($sql))
	{
		echo "El estado ha sido agregado";
	}else{
		echo "Ocurrió un error en la petición: ".$sql;
	}
}
 ?>