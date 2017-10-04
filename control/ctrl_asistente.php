<?php 
if(isset($_GET['e']))
{
switch ($_GET['e']) {
	case 'insertPaciente': insertPaciente(); break;
	case 'buscarPaciente': buscarPaciente(); break;
	case 'enviarBuzon': enviarBuzon(); break;
	case 'updatePaciente': updatePaciente(); break;
	case 'deletePaciente': deletePaciente(); break;
}	
}
function deletePaciente(){
	include "conexion.php";
	$con = new Conexion();
	$sql="DELETE FROM paciente WHERE id_paciente=".$_POST['id_paciente'];
	if($con->delete($sql))
	{
		echo "Registro eliminado";
	}else{
		echo 'error: '.$sql;
	}
}
function enviarBuzon(){
	include "conexion.php";
	$con = new Conexion();
	date_default_timezone_set('America/Mexico_City');
  	$ref_exp=date('Y-m-d H:i:s');
	$sql = "UPDATE paciente SET ref_exp='".$ref_exp."' WHERE id_paciente=".$_POST['id_paciente'];
	if($con->update($sql))
	{
		$sql = "SELECT * FROM paciente WHERE id_paciente=".$_POST['id_paciente'];
		$datos = $con->select($sql);
		if($fila=mysqli_fetch_array($datos))
		{
			require 'ctrl_notificacion.php';
			enviarNotificacion($fila['nombre_paci'].' '.$fila['paterno_paci'].' '.$fila['materno_paci']);
			echo "Expediente agregado a la lista de espera.";
		}else{
			echo "Error: ".$sql;
		}
		
	}else{
		echo "Error: ".$sql;
	}
}
function buscarPaciente()
{
include "conexion.php";
$con = new Conexion();
$sql = "SELECT * FROM paciente WHERE nombre_paci LIKE '%$_POST[valor]%' OR paterno_paci LIKE '%$_POST[valor]%' OR materno_paci LIKE '%$_POST[valor]%'";
$datos=$con->select($sql);
$contador=0;
while ($fila=mysqli_fetch_array($datos)) {
  echo '
  <tr>
    <td>'.$fila['nombre_paci'].'</td>
    <td>'.$fila['paterno_paci'].'</td>
    <td>'.$fila['materno_paci'].'</td>
    <td>'.$fila['edo_exp'].'</td>
    <td>
      <button class="btn btn-default" title="Enviar a buzón de espera..." onclick="enviarBuzon('.$fila['id_paciente'].');"><span class="icon-share"></span></button>
      <button class="btn btn-default" title="Editar paciente..." onclick="editarPacienteAsistente('.$fila['id_paciente'].');"><span class="icon-pencil"></span></button>
      <button class="btn btn-default" title="Eliminar paciente..." onclick="eliminarPacienteAsistente('.$fila['id_paciente'].');"><span class="icon-bin"></span></button>
    </td>
 </tr>
  ';
  $contador++;
}
if($contador<=0){ echo '<tr><td colspan="5">No se encontraron coincidencias....</td></tr>'; }
}
function updatePaciente()
{
	include 'conexion.php';
	$con = new Conexion();
	if(strlen($_POST['edad_paci'])>0)
	{
		$edad=$_POST['edad_paci'];
	}else{
		$edad = CalcularEdad($_POST['naci_paci']);
	}
	$sql="UPDATE paciente SET
		nombre_paci='$_POST[nombre_paci]',
		paterno_paci='$_POST[paterno_paci]',
		materno_paci='$_POST[materno_paci]',
		sex_paci='$_POST[sex_paci]',
		naci_paci='$_POST[naci_paci]',
		edad_paci='$edad',
		lugar_paci='$_POST[lugar_paci]',
		rfc_paci='$_POST[rfc_paci]',
		curp_paci='$_POST[curp_paci]',
		titular='$_POST[titular]',
		tel_cel='$_POST[tel_cel]',
		tel_cas='$_POST[tel_cas]',
		tel_ofi='$_POST[tel_ofi]',
		tel_otro='$_POST[tel_otro]',
		calle='$_POST[calle]',
		no_ext='$_POST[no_ext]',
		no_int='$_POST[no_int]',
		col='$_POST[col]',
		mun='$_POST[mun]',
		edo_dir='$_POST[edo_dir]',
		esco='$_POST[esco]',
		ocupa='$_POST[ocupa]',
		edo_civ='$_POST[edo_civ]',
		comenta='$_POST[comenta]',
		reli='$_POST[reli]',
		conocio='$_POST[conocio]',
		correo='$_POST[correo]',
		nom_pad='$_POST[nom_pad]',
		ocu_pad='$_POST[ocu_pad]',
		edad_pad='$_POST[edad_pad]',
		tel_pad='$_POST[tel_pad]',
		nom_mad='$_POST[nom_mad]',
		ocu_mad='$_POST[ocu_mad]',
		edad_mad='$_POST[edad_mad]',
		tel_mad='$_POST[tel_mad]',
		nom_cony='$_POST[nom_cony]',
		ocu_cony='$_POST[ocu_cony]',
		edad_cony='$_POST[edad_cony]',
		tel_cony='$_POST[tel_cony]',
		det_hero='$_POST[det_hero]',
		det_hera='$_POST[det_hera]',
		det_hijo='$_POST[det_hijo]',
		det_hija='$_POST[det_hija]',
		sangre='$_POST[sangre]',
		alergia='$_POST[alergia]',
		nom_cont='$_POST[nom_cont]',
		dir_cont='$_POST[dir_cont]',
		par_cont='$_POST[par_cont]',
		tel_cont='$_POST[tel_cont]',
		com_cont='$_POST[com_cont]',
		edo_exp='$_POST[edo_exp]'
		WHERE id_paciente=".$_POST['id_paciente'];
		if($con->update($sql))
		{
			echo "Información actualizada!";
		}else{
			echo 'error: '.$sql;
		}

}
function insertPaciente()
{
	include 'conexion.php';
	$con = new Conexion();
	if(strlen($_POST['edad_paci'])>0)
	{
		$edad=$_POST['edad_paci'];
	}else{
		$edad = CalcularEdad($_POST['naci_paci']);
	}
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
		esco,
		ocupa,
		edo_civ,
		comenta,
		reli,
		conocio,
		correo,
		nom_pad,
		ocu_pad,
		edad_pad,
		tel_pad,
		nom_mad,
		ocu_mad,
		edad_mad,
		tel_mad,
		nom_cony,
		ocu_cony,
		edad_cony,
		tel_cony,
		det_hero,
		det_hera,
		det_hijo,
		det_hija,
		sangre,
		alergia,
		nom_cont,
		dir_cont,
		par_cont,
		tel_cont,
		com_cont,
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
		'$_POST[esco]',
		'$_POST[ocupa]',
		'$_POST[edo_civ]',
		'$_POST[comenta]',
		'$_POST[reli]',
		'$_POST[conocio]',
		'$_POST[correo]',
		'$_POST[nom_pad]',
		'$_POST[ocu_pad]',
		'$_POST[edad_pad]',
		'$_POST[tel_pad]',
		'$_POST[nom_mad]',
		'$_POST[ocu_mad]',
		'$_POST[edad_mad]',
		'$_POST[tel_mad]',
		'$_POST[nom_cony]',
		'$_POST[ocu_cony]',
		'$_POST[edad_cony]',
		'$_POST[tel_cony]',
		'$_POST[det_hero]',
		'$_POST[det_hera]',
		'$_POST[det_hijo]',
		'$_POST[det_hija]',
		'$_POST[alergia]',
		'$_POST[sangre]',
		'$_POST[nom_cont]',
		'$_POST[dir_cont]',
		'$_POST[par_cont]',
		'$_POST[tel_cont]',
		'$_POST[com_cont]',
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