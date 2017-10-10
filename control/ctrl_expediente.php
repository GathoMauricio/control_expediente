<?php 
date_default_timezone_set('America/Mexico_City');
if(isset($_GET['e']))
{
	switch ($_GET['e']) {
		case 'cargarNumBuzon': cargarNumBuzon(); break;
		case 'calcularRfc': calcularRfc(); break;
		case 'CalcularEdad': echo CalcularEdad($_POST['value']); break;
		case 'eliminarExpediente': eliminarExpediente(); break;
		case 'actualizarPacienteHc': actualizarPacienteHc(); break;
		case 'actualizarPaciente': actualizarPaciente(); break;
		case 'validarPase': validarPase(); break;
		case 'buscarExpediente': buscarExpediente(); break;
		case 'removerBuzon': removerBuzon(); break;
		case 'agregarBuzon': agregarBuzon(); break;
		case 'cargarBuzon': cargarBuzon(); break;
		case 'nuevoExpediente': nuevoExpediente(); break;
	}
}
function cargarNumBuzon()
{
	include 'conexion.php';
	$con = new Conexion();
	$sql="SELECT count(*) as contador FROM paciente WHERE ref_exp != '' ORDER BY ref_exp";
	$datos=$con->select($sql);
	$contador="";
	while($fila=mysqli_fetch_array($datos))
	{
		if($fila['contador']>0)
		{
			$contador="( ".$fila['contador']." ) ";
		}
	}
	echo $contador;
}
function calcularRfc()
{
	require_once 'Unirest.php';
	$response = Unirest\Request::get("https://jfhe88-rfc-generator-mexico.p.mashape.com/rest1/rfc/get?apellido_materno=".urlencode($_POST['materno_paci'])."&apellido_paterno=".urlencode($_POST['paterno_paci'])."&fecha=".urlencode($_POST['fecha_paci'])."&nombre=".urlencode($_POST['nombre_paci'])."&solo_homoclave=0",
	  array(
	    "X-Mashape-Key" => "7oBF4jVvEymshc41oYkO1Zdyim3tp1e42hCjsnyZCOv2m6ohc7",
	    "Accept" => "application/json"
	  )
	);
	echo json_encode($response);
}
function eliminarExpediente()
{
	include "conexion.php";
	$con = new Conexion();
	$sql="DELETE FROM paciente WHERE id_paciente=".$_POST['id_expediente'];
	if($con->delete($sql))
	{
		echo "Registro eliminado";
	}else{
		echo 'error: '.$sql;
	}
}
function actualizarPacienteHc()
{
	include 'conexion.php';
	$con = new Conexion();
	if(isset($_POST['hc_fum'])>0)
	{
		$hc_fum = $_POST['hc_fum'];
	}else{
		$hc_fum = NULL;
	}
	$sql="UPDATE paciente SET
		hc_peso='$_POST[hc_peso]',
		hc_talla='$_POST[hc_talla]',
		hc_ta='$_POST[hc_ta]',
		hc_fc='$_POST[hc_fc]',
		hc_fr='$_POST[hc_fr]',
		hc_tem='$_POST[hc_tem]',
		hc_fum='$hc_fum',
		hc_ant_fam='$_POST[hc_ant_fam]',
		hc_ant_per_no_p='$_POST[hc_ant_per_no_p]',
		hc_ant_per_p='$_POST[hc_ant_per_p]',
		hc_pad='$_POST[hc_pad]',
		hc_exp_fis='$_POST[hc_exp_fis]',
		hc_otros='$_POST[hc_otros]',
		hc_rx='$_POST[hc_rx]',
		hc_dx='$_POST[hc_dx]',
		hc_tx='$_POST[hc_tx]'
		WHERE id_paciente=".$_POST['id_paciente'];
		if($con->update($sql))
		{
			echo "Información actualizada!";
		}else{
			echo 'error: '.$sql;
		}
}
function actualizarPaciente()
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

		pase_id='$_POST[pase_id]',
		pase_tot='$_POST[pase_tot]',

		part_a='$_POST[part_a]',
		part_b='$_POST[part_b]',
		part_c='$_POST[part_c]',
		altec='$_POST[altec]',
		altes='$_POST[altes]',
		axa_sant='$_POST[axa_sant]',
		axa_condu='$_POST[axa_condu]',
		banor='$_POST[banor]',
		banse='$_POST[banse]',
		bnci='$_POST[bnci]',
		emp='$_POST[emp]',
		gpo_med='$_POST[gpo_med]',
		gpo_med_doc='$_POST[gpo_med_doc]',
		gpo_med_pro='$_POST[gpo_med_pro]',
		gpo_med_alm='$_POST[gpo_med_alm]',
		inse='$_POST[inse]',
		s_inves_cob='$_POST[s_inves_cob]',
		s_inves_no_cob='$_POST[s_inves_no_cob]',
		serfin='$_POST[serfin]',
		tepe='$_POST[tepe]',
		vita_afo='$_POST[vita_afo]',
		vita_bancom_ope='$_POST[vita_bancom_ope]',
		vita_banam='$_POST[vita_banam]',
		vita_bancom_san='$_POST[vita_bancom_san]',
		vita_memb='$_POST[vita_memb]',
		zurich='$_POST[zurich]',

		d_a1='$_POST[d_a1]',
		d_b2='$_POST[d_b2]',
		d_c3='$_POST[d_c3]',
		d_d4='$_POST[d_d4]',
		d_e5='$_POST[d_e5]',
		d_f6='$_POST[d_f6]',
		d_g7='$_POST[d_g7]',
		d_h8='$_POST[d_h8]',
		d_i9='$_POST[d_i9]',
		d_j10='$_POST[d_j10]',
		d_k11='$_POST[d_k11]',
		d_l12='$_POST[d_l12]',
		d_m13='$_POST[d_m13]',
		d_n14='$_POST[d_n14]',
		d_o15='$_POST[d_o15]',
		d_p16='$_POST[d_p16]',
		d_q17='$_POST[d_q17]',
		d_r18='$_POST[d_r18]',
		d_s19='$_POST[d_s19]',
		d_t20='$_POST[d_t20]',
		d_u21='$_POST[d_u21]',
		d_v22='$_POST[d_v22]',
		d_x23='$_POST[d_x23]',
		d_y24='$_POST[d_y24]',
		d_z25='$_POST[d_z25]',
		d_a26='$_POST[d_a26]',
		d_b27='$_POST[d_b27]',
		d_c28='$_POST[d_c28]',

		edo_exp='$_POST[edo_exp]'

		
		WHERE id_paciente=".$_POST['id_paciente'];
		if($con->update($sql))
		{
			echo "Información actualizada!";
		}else{
			echo 'error: '.$sql;
		}

}
function validarPase()
{
	include "conexion.php";
	$con = new Conexion();
	$sql = "SELECT * FROM paciente WHERE id_paciente=".$_POST['id_expediente'];
	$datos = $con->select($sql);
	$data;
	if($fila=mysqli_fetch_array($datos)) $data = $fila;
	$sql = "SELECT count(*) as num_pase FROM consulta WHERE pase_cons = '".$data['pase_id']."'";
	$datos = $con->select($sql);
	$num_pase;
	if($fila=mysqli_fetch_array($datos))
	{
		$total=$fila['num_pase'].' de '.$data['pase_tot'];
		if($fila['num_pase']>=$data['pase_tot'])
		{
			echo json_encode(array('pase'=>0,'total'=>$total));
		}else{
			echo json_encode(array('pase'=>1,'total'=>$total));
		}
	}
}
function buscarExpediente()
{
	include "conexion.php";
	$con = new Conexion();
	$sql = "SELECT * FROM paciente WHERE nombre_paci  LIKE '%$_POST[value]%'  OR paterno_paci LIKE '%$_POST[value]%' OR materno_paci LIKE '%$_POST[value]%'";
	$datos=$con->select($sql);
	$contador=0;
	while ($fila=mysqli_fetch_array($datos))
	{
		echo '<div onclick="abrirExpediente('.$fila['id_paciente'].');" class="item-busqueda"><span class="icon-user"></span> '.$fila['nombre_paci'].' '.$fila['paterno_paci'].' '.$fila['materno_paci'].'</div>';
		$contador++;
	}
	if($contador<=0){ echo '<div class="item-busqueda"><span class="icon-cross"></span> No se encontraron resultados...</div>'; }
}
function removerBuzon()
{
	include 'conexion.php';
	$con = new Conexion();
	$sql = "UPDATE paciente SET ref_exp=NULL WHERE id_paciente=".$_POST['id_expediente'];
	if($con->update($sql))
	{
		require 'ctrl_notificacion.php';
		enviarNotificacion('');
		echo "Expediente removido del buzón.";
	}else{
		echo "Error: ".$sql;
	}
}
function agregarBuzon()
{
	include 'conexion.php';
	$con = new Conexion();
	$ref_exp=date('Y-m-d H:i:s');
	$sql = "UPDATE paciente SET ref_exp='".$ref_exp."' WHERE id_paciente=".$_POST['insert_id'];
	if($con->update($sql))
	{
		require 'ctrl_notificacion.php';
		enviarNotificacion('');
		echo "Expediente agregado a la lista de espera.";
	}else{
		echo "Error: ".$sql;
	}
}
function numConsultas($id_paciente,$con)
{
	$sql="SELECT * FROM consulta WHERE id_paciente=".$id_paciente;
	$datos=$con->select($sql);
	$contador=0;
	while($fila=mysqli_fetch_array($datos))
	{
		$contador++;
	}
	return $contador;
}
function cargarBuzon()
{
	include 'conexion.php';
	$con = new Conexion();
	$sql="SELECT * FROM paciente WHERE ref_exp != '' ORDER BY ref_exp";
	$datos=$con->select($sql);
	$contador=0;
	while($fila=mysqli_fetch_array($datos))
	{
		if(numConsultas($fila['id_paciente'],$con)<=0)
		{
			$opciones = '
			(Primer consulta)<br>
			<table style="width:100%;">
			<tr>
			<td><a href="#" onclick="iniciarConsulta('.$fila['id_paciente'].');">Iniciar consulta</a></td>
			</tr>
			</table>
			';
		}else{
			$opciones = '
			<table style="width:100%;">
			<tr>
			<td><a href="#" onclick="iniciarConsulta('.$fila['id_paciente'].');">Iniciar consulta</a></td></tr>
			</table>
			';
		}
		$dateTime = explode(' ',$fila['ref_exp']);
		$date =explode('-',$dateTime[0]);
		$time = explode(':',$dateTime[1]);
		echo '
		<span onclick="removerBuzon('.$fila['id_paciente'].');" class="icon-cross" title="Remover del buzón..." style="float:right;color:gray;cursor:pointer;"></span><br>
		<div class="item-buzon">
			<label>'.$fila['nombre_paci'].' '.$fila['paterno_paci'].' '.$fila['materno_paci'].' </label>
		<br>
			'.$date[2].'-'.$date[1].'-'.$date[0].' a las '.$time[0].':'.$time[1].' Hrs.
		<br>
		'.$opciones.'
		</div>
		<hr>
		';
		$contador++;
	}
	if($contador<=0)
	{
		echo '<center><label>AÚN NO HAY EXPEDIENTES</label></center>';
	}
}
function nuevoExpediente()
{
	include 'conexion.php';
	$con = new Conexion();

	if(strlen($_POST['pase_id'])>0)
	{
		$pase_id=$_POST['pase_id'];
		$pase_tot=$_POST['pase_tot'];
	}else{
		$pase_id = "VIP_".date('His');
		$pase_tot='10000';
	}
	if(strlen($_POST['edad_paci'])>0)
	{
		$edad=$_POST['edad_paci'];
	}else{
		$edad = CalcularEdad($_POST['naci_paci']);
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

		pase_id,
		pase_tot,

		part_a,
		part_b,
		part_c,
		altec,
		altes,
		axa_sant,
		axa_condu,
		banor,
		banse,
		bnci,
		emp,
		gpo_med,
		gpo_med_doc,
		gpo_med_pro,
		gpo_med_alm,
		inse,
		s_inves_cob,
		s_inves_no_cob,
		serfin,
		tepe,
		vita_afo,
		vita_bancom_ope,
		vita_banam,
		vita_bancom_san,
		vita_memb,
		zurich,

		d_a1,
		d_b2,
		d_c3,
		d_d4,
		d_e5,
		d_f6,
		d_g7,
		d_h8,
		d_i9,
		d_j10,
		d_k11,
		d_l12,
		d_m13,
		d_n14,
		d_o15,
		d_p16,
		d_q17,
		d_r18,
		d_s19,
		d_t20,
		d_u21,
		d_v22,
		d_x23,
		d_y24,
		d_z25,
		d_a26,
		d_b27,
		d_c28,
		edo_exp

	) VALUES (
		'$_POST[fecha_reg]',
		'".strtoupper($_POST['nombre_paci'])."',
		'".strtoupper($_POST['paterno_paci'])."',
		'".strtoupper($_POST['materno_paci'])."',
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

		'$pase_id',
		'$pase_tot',

		'$_POST[part_a]',
		'$_POST[part_b]',
		'$_POST[part_c]',
		'$_POST[altec]',
		'$_POST[altes]',
		'$_POST[axa_sant]',
		'$_POST[axa_condu]',
		'$_POST[banor]',
		'$_POST[banse]',
		'$_POST[bnci]',
		'$_POST[emp]',
		'$_POST[gpo_med]',
		'$_POST[gpo_med_doc]',
		'$_POST[gpo_med_pro]',
		'$_POST[gpo_med_alm]',
		'$_POST[inse]',
		'$_POST[s_inves_cob]',
		'$_POST[s_inves_no_cob]',
		'$_POST[serfin]',
		'$_POST[tepe]',
		'$_POST[vita_afo]',
		'$_POST[vita_bancom_ope]',
		'$_POST[vita_banam]',
		'$_POST[vita_bancom_san]',
		'$_POST[vita_memb]',
		'$_POST[zurich]',

		'$_POST[d_a1]',
		'$_POST[d_b2]',
		'$_POST[d_c3]',
		'$_POST[d_d4]',
		'$_POST[d_e5]',
		'$_POST[d_f6]',
		'$_POST[d_g7]',
		'$_POST[d_h8]',
		'$_POST[d_i9]',
		'$_POST[d_j10]',
		'$_POST[d_k11]',
		'$_POST[d_l12]',
		'$_POST[d_m13]',
		'$_POST[d_n14]',
		'$_POST[d_o15]',
		'$_POST[d_p16]',
		'$_POST[d_q17]',
		'$_POST[d_r18]',
		'$_POST[d_s19]',
		'$_POST[d_t20]',
		'$_POST[d_u21]',
		'$_POST[d_v22]',
		'$_POST[d_x23]',
		'$_POST[d_y24]',
		'$_POST[d_z25]',
		'$_POST[d_a26]',
		'$_POST[d_b27]',
		'$_POST[d_c28]',
		'Activo'
	)";
	$insert_id = $con->insert($sql);
	//echo "Cons ".$insert_id;
	if($insert_id > 0)
	{
		echo json_encode(array('error'=>0,'msg'=>'Se insertó el expediente con éxito<br>¿Desea enviar este expediente al buzón?','insert_id'=>$insert_id));
	}else{
		echo json_encode(array('error'=>1,'msg'=>'Ocurrió un error en la petición a la base de datos: '.$sql,'insert_id'=>0));
	}
}



function CalcularEdad( $fecha ) {
    list($Y,$m,$d) = explode("-",$fecha);
    return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
}

function normaliza ($cadena){
    $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ
ßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuy
bsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
    $cadena = utf8_decode($cadena);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    $cadena = strtolower($cadena);
    return utf8_encode($cadena);
}
 ?>