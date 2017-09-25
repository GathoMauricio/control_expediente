<?php 
if(isset($_GET['e']))
{
switch ($_GET['e']) {
	case 'insertConsulta': insertConsulta(); break;
	case 'getConsulta': getConsulta(); break;
}	
}
function getConsulta(){
	include 'conexion.php';
	$con = new Conexion();
	$sql = "SELECT * FROM paciente p LEFT JOIN consulta c ON p.id_paciente=c.id_paciente WHERE c.id_consulta=".$_POST['id_consulta'];
	$datos=$con->select($sql);
	if($fila=mysqli_fetch_array($datos))
	{
		echo json_encode(array(
			'nombre_paci'=>$fila['nombre_paci'].' '.$fila['paterno_paci'].' '.$fila['materno_paci'],
			'fecha_cons'=>$fila['fecha_cons'],
			'no_cons'=>$fila['no_cons'],
			'edad_cons'=>$fila['edad_cons'],
			'pase_cons'=>$fila['pase_cons'],
			'fum_cons'=>$fila['fum_cons'],
			'no_evo'=>$fila['no_evo'],
			'desc_evo'=>$fila['desc_evo']
		));
	}else{
		echo json_encode(array(
			'error'=>'1',
			'sql'=>$sql
		));
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