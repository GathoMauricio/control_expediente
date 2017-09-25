<?php 
if(isset($_GET['e']))
{
switch ($_GET['e']) {
	case 'insertConsulta': insertConsulta(); break;
}	
}
function insertConsulta()
{
	include 'conexion.php';
	$con = new Conexion();
	$sql="INSERT INTO consulta (id_paciente,fecha_cons,no_cons,edad_cons,pase_cons,fum_cons,no_evo,desc_evo) VALUES(
		$_POST[id_paciente],'$_POST[fecha_cons]',$_POST[no_cons],'$_POST[edad_cons]','$_POST[pase_cons]','$_POST[fum_cons]',$_POST[no_evo],'$_POST[desc_evo]'
	)";
	if($con->insert($sql))
	{
		echo "Consulta guardada";
	}else{
		echo "Error: ".$sql;
	}
}
 ?>