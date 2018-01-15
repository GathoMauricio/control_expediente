<?php 
if(isset($_GET['e']))
{
switch ($_GET['e']) {
	case 'nuevaConsulta': nuevaConsulta(); break;
	case 'actualizarConsulta': actualizarConsulta(); break;
	case 'eliminarConsulta': eliminarConsulta(); break;
}	
}
function actualizarConsulta()
{
	include 'conexion.php';
	$con = new Conexion();
	if (isset($_POST['fum_cons'])) {
		$fum_cons=$_POST['fum_cons'];
	}else{
		$fum_cons=NULL;
	}
	if($_POST['tipo_consulta']=="primera"){
		$sql="UPDATE consulta SET
		edad_cons = '$_POST[edad_cons]' 
		WHERE id_consulta=$_POST[id_consulta]
		";
	}else{
		$sql="UPDATE consulta SET
			fecha_cons='$_POST[fecha_cons]',
			edad_cons='$_POST[edad_cons]',
			fum_cons='$fum_cons',
			desc_evo='$_POST[desc_evo]'
			WHERE id_consulta=$_POST[id_consulta]
			";
	}
	

	if($con->update($sql))
	{
		$sql="UPDATE paciente SET 
		hc_peso ='$_POST[hc_peso]',
		hc_talla ='$_POST[hc_talla]',
		hc_ta ='$_POST[hc_ta]',
		hc_fc ='$_POST[hc_fc]',
		hc_fr ='$_POST[hc_fr]',
		hc_tem ='$_POST[hc_tem]',
		hc_fum ='$fum_cons',
		hc_ant_fam ='$_POST[hc_ant_fam]',
		hc_ant_per_no_p ='$_POST[hc_ant_per_no_p]',
		hc_ant_per_p ='$_POST[hc_ant_per_p]',
		hc_pad ='$_POST[hc_pad]',
		hc_exp_fis ='$_POST[hc_exp_fis]',
		hc_otros ='$_POST[hc_otros]',
		hc_rx ='$_POST[hc_rx]',
		hc_dx ='$_POST[hc_dx]',
		hc_tx ='$_POST[hc_tx]'
		WHERE id_paciente=".$_POST['id_paciente'];
		if($con->update($sql))
		{
			echo "La información se almacenó con éxito.";
		}
	}else{
		echo "Error: ".$sql;
	}
}
function nuevaConsulta()
{
	include 'conexion.php';
	$con = new Conexion();
	if (isset($_POST['fum_cons'])) {
		$fum_cons=$_POST['fum_cons'];
	}else{
		$fum_cons=NULL;
	}
	if($_POST['tipo_consulta']=="primera"){
		$sql="INSERT INTO consulta 
		(
			id_paciente,
			fecha_cons,
			no_cons,
			edad_cons,
			pase_cons
			) VALUES(
		$_POST[id_paciente],
		'$_POST[fecha_cons]',
		$_POST[no_cons],
		'$_POST[edad_cons]',
		'$_POST[pase_cons]'
	)";
	}else{
		$sql="INSERT INTO consulta 
		(
			id_paciente,
			fecha_cons,
			no_cons,
			edad_cons,
			pase_cons,
			fum_cons,
			no_evo,
			desc_evo
			) VALUES(
		$_POST[id_paciente],
		'$_POST[fecha_cons]',
		$_POST[no_cons],
		'$_POST[edad_cons]',
		'$_POST[pase_cons]',
		'$fum_cons',
		$_POST[no_evo],
		'$_POST[desc_evo]'
	)";
	}
	

	if($con->insert($sql))
	{
		$sql="UPDATE paciente SET 
		hc_peso ='$_POST[hc_peso]',
		hc_talla ='$_POST[hc_talla]',
		hc_ta ='$_POST[hc_ta]',
		hc_fc ='$_POST[hc_fc]',
		hc_fr ='$_POST[hc_fr]',
		hc_tem ='$_POST[hc_tem]',
		hc_fum ='$fum_cons',
		hc_ant_fam ='$_POST[hc_ant_fam]',
		hc_ant_per_no_p ='$_POST[hc_ant_per_no_p]',
		hc_ant_per_p ='$_POST[hc_ant_per_p]',
		hc_pad ='$_POST[hc_pad]',
		hc_exp_fis ='$_POST[hc_exp_fis]',
		hc_otros ='$_POST[hc_otros]',
		hc_rx ='$_POST[hc_rx]',
		hc_dx ='$_POST[hc_dx]',
		hc_tx ='$_POST[hc_tx]'
		WHERE id_paciente=".$_POST['id_paciente'];
		if($con->update($sql))
		{
			echo json_encode(array('id_expediente'=>$_POST['id_paciente'],'msj'=>"La información se almacenó con éxito."));
		}
	}else{
		echo json_encode(array('id_expediente'=>$_POST['id_paciente'],'msj'=>"Error: ".$sql));
	}
	
}
function eliminarConsulta()
{
	include 'conexion.php';
	$con = new Conexion();
	if($con->delete("DELETE FROM consulta WHERE id_consulta=".$_POST['id_consulta']))
	{
		echo "Registro eliminado";
	}else{
		echo "Ocurrió un error durante la operación";
	}
} 
?>
