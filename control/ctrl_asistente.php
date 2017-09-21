<?php 
if(isset($_GET['e']))
{
switch ($_GET['e']) {
	case 'insertPaciente': insertPaciente(); break;
}	
}
function insertPaciente()
{
	include 'conexion.php';
	$con = new Conexion();
	$edad = CalcularEdad($_POST['naci_paci']);
	if($_POST['ref_exp']=='SI')
	{
		//enviar notif
		require 'ctrl_notificacion.php';
		enviarNotificacion($_POST['nombre_paci'].' '.$_POST['paterno_paci'].' '.$_POST['materno_paci']);
		date_default_timezone_set('America/Mexico_City');
  		$ref_exp=date('Y-m-d H:i:s');
	}else{
		$ref_exp=NULL;
	}
	$sql="INSERT INTO paciente (
		fecha_reg,
		nombre_paci,
		paterno_paci,
		materno_paci,
		sex_paci,
		naci_paci,
		edad_paci,
		lugar_paci,
		rfc_paci,
		curp_paci,
		titular,
		tel_cel,
		tel_cas,
		tel_ofi,
		tel_otro,
		calle,
		no_ext,
		no_int,
		col,
		mun,
		edo_dir,
		edo_exp,
		ref_exp
	) VALUES (
		'$_POST[fecha_reg]',
		'$_POST[nombre_paci]',
		'$_POST[paterno_paci]',
		'$_POST[materno_paci]',
		'$_POST[sex_paci]',
		'$_POST[naci_paci]',
		'$edad',
		'$_POST[lugar_paci]',
		'$_POST[rfc_paci]',
		'$_POST[curp_paci]',
		'$_POST[titular]',
		'$_POST[tel_cel]',
		'$_POST[tel_cas]',
		'$_POST[tel_ofi]',
		'$_POST[tel_otro]',
		'$_POST[calle]',
		'$_POST[no_ext]',
		'$_POST[no_int]',
		'$_POST[col]',
		'$_POST[mun]',
		'$_POST[edo_dir]',
		'$_POST[edo_exp]',
		'$ref_exp'
	)";
	if($con->insert($sql))
	{
		echo "El registro se insertó con éxito";
	}else{
		echo "Error: ".$sql;
	}
}
function CalcularEdad( $fecha ) {
    list($Y,$m,$d) = explode("-",$fecha);
    return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
}
 ?>