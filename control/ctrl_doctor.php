<?php 
if(isset($_GET['e']))
{
switch ($_GET['e']) {
	case 'insertPaciente': insertPaciente(); break;
	case 'getBuzon': getBuzon(); break;
	case 'updatePaciente': updatePaciente(); break;
	case 'buscarPaciente': buscarPaciente(); break;
	case 'removerBuzon' : removerBuzon(); break;
}	
}
function removerBuzon()
{
	include "conexion.php";
	$con = new Conexion();
	$sql = "UPDATE paciente SET ref_exp=NULL WHERE id_paciente=$_POST[id_paciente]";
	if($con->update($sql))
	{
		echo "Paciente memovido!!";
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
	      <button class="btn btn-default" title="Enviar a buzón de espera..." onclick="enviarBuzon('.$fila['id_paciente'].');"><span class="icon-envelop"></span></button>
	      <button class="btn btn-default" title="Ver consultas..." onclick="verConsultas('.$fila['id_paciente'].');"><span class="icon-share"></span></button>
	      <button class="btn btn-default" title="Subir archivo..." onclick="subirArchivo('.$fila['id_paciente'].');"><span class="icon-cloud-upload"></span></button>
	      <button class="btn btn-default" title="Ver archivos..." onclick="verArchivos('.$fila['id_paciente'].');"><span class="icon-cloud-download"></span></button>
	      <button class="btn btn-default" title="Editar paciente..." onclick="editarPacienteAsistente('.$fila['id_paciente'].');"><span class="icon-pencil"></span></button>
	      <button class="btn btn-default" title="Eliminar paciente..." onclick="eliminarPacienteAsistente('.$fila['id_paciente'].');"><span class="icon-bin"></span></button>
	    </td>
	 </tr>
	  ';
	  $contador++;
	}
	if($contador<=0){ echo '<tr><td colspan="5">No se encontraron coincidencias....</td></tr>'; }
}
function getBuzon()
{
	include 'conexion.php';
	$con = new Conexion();
	$sql="SELECT * FROM paciente WHERE ref_exp != '' ORDER BY ref_exp";
	$datos=$con->select($sql);
	echo "<table class='table' style='width:100%;'>";
	echo'
	<tr>
	<th>Nombre</th>
	<th>A. paterno</th>
	<th>A. materno</th>
	<th>Referencia</th>
	<th></th>
	<th>Opciones</th>
	</tr>';
	while($fila=mysqli_fetch_array($datos))
	{
		$sql2="SELECT count(*) as total_consultas FROM consulta WHERE id_paciente=".$fila['id_paciente'];
		$total_consultas='';
		$datos2=$con->select($sql2);
		$link = '"editarPasienteAsistenteDoc.php?id_paciente='.$fila['id_paciente'].'#historia_clinica"';
		$link2 = '"editarPasienteAsistenteDoc.php?id_paciente='.$fila['id_paciente'].'"';
		if($fila2=mysqli_fetch_array($datos2))
		{
			if($fila2['total_consultas']<=0){
				
				$total_consultas = "<a href='#' title='Abrir expediente...' onclick='window.location=$link '><span class='icon-user-check'></span>Nuevo!!!</a>";
			}
		}

		echo "
		<tr>
			<td>$fila[nombre_paci]</td>
			<td>$fila[paterno_paci]</td>
			<td>$fila[materno_paci]</td>
			<td>$fila[ref_exp]</td>
			<td>$total_consultas</td>
			<td>
			<button onclick='window.location=$link2 ' title='Ver expediente...' class='btn btn-default'><span class='icon-user'></span></button>
			<button onclick='iniciarConsulta($fila[id_paciente]);' title='Iniciar consulta...' class='btn btn-default'><span class='icon-share'></span></button>
			<button onclick='removerBuzon($fila[id_paciente]);' title='Remover del buzón...' class='btn btn-default'><span class='icon-bin'></span></button>
			</td>
		</tr>";
	}
	echo "</table>";
}
function insertPaciente()
{
	include 'conexion.php';
	$con = new Conexion();
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

		edo_exp,
		ref_exp,

		hc_peso,
		hc_talla,
		hc_ta,
		hc_fc,
		hc_fr,
		hc_tem,
		hc_fum,
		hc_ant_fam,
		hc_ant_per_no_p,
		hc_ant_per_p,
		hc_pad,
		hc_exp_fis,
		hc_otros,
		hc_rx,
		hc_dx,
		hc_tx

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

		'$_POST[pase_id]',
		'$_POST[pase_tot]',

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

		'$_POST[edo_exp]',
		'$ref_exp',

		'$_POST[hc_peso]',
		'$_POST[hc_talla]',
		'$_POST[hc_ta]',
		'$_POST[hc_fc]',
		'$_POST[hc_fr]',
		'$_POST[hc_tem]',
		'$_POST[hc_fum]',
		'$_POST[hc_ant_fam]',
		'$_POST[hc_ant_per_no_p]',
		'$_POST[hc_ant_per_p]',
		'$_POST[hc_pad]',
		'$_POST[hc_exp_fis]',
		'$_POST[hc_otros]',
		'$_POST[hc_rx]',
		'$_POST[hc_dx]',
		'$_POST[hc_tx]'
	)";
	if($con->insert($sql))
	{
		echo "El registro se insertó con éxito";
	}else{
		echo "Error: ".$sql;
	}
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

		edo_exp='$_POST[edo_exp]',

		hc_peso='$_POST[hc_peso]',
		hc_talla='$_POST[hc_talla]',
		hc_ta='$_POST[hc_ta]',
		hc_fc='$_POST[hc_fc]',
		hc_fr='$_POST[hc_fr]',
		hc_tem='$_POST[hc_tem]',
		hc_fum='$_POST[hc_fum]',
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
function CalcularEdad( $fecha ) {
    list($Y,$m,$d) = explode("-",$fecha);
    return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
}
 ?>