<?php

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Catalogo_de_pacientes.xls");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LISTA DE USUARIOS</title>
</head>
<body>


<?php 
include "conexion.php";
$con = new Conexion();
$datos = $con->select("SELECT * FROM paciente");
while($fila=mysqli_fetch_array($datos))
{
echo "
<table width='100%'  border='1'cellspacing='0' cellpadding='0'>
  <tr style='background-color:#5858FA'>
    <td><strong>Fecha de registro</strong></td>
    <td><strong>A. Paterno</strong></td>
    <td><strong>A.materno</strong></td>
    <td><strong>Nombre</strong></td>
    <td><strong>Sexo</strong></td>
    <td><strong>Fecha de nacimiento</strong></td>
    <td><strong>Edad</strong></td>
    <td><strong>Lugar de nacimiento</strong></td>
    <td><strong>RFC</strong></td>
    <td><strong>CURP</strong></td>
    <td><strong>Titular</strong></td>
    <td><strong>Teléfono celular</strong></td>
    <td><strong>Teléfono casa</strong></td>
    <td><strong>Teléfono oficina</strong></td>
    <td><strong>Teléfono otro</strong></td>
    <td><strong>Calle</strong></td>
    <td><strong>No exterior</strong></td>
    <td><strong>No interior</strong></td>
    <td><strong>Colonia</strong></td>
    <td><strong>Municipio</strong></td>
    <td><strong>Estado</strong></td>
    <td><strong>Escolaridad</strong></td>
    <td><strong>Ocupacion</strong></td>
    <td><strong>Edo. civil</strong></td>
    <td><strong>Comentarios</strong></td>
    <td><strong>Religion</strong></td>
    <td><strong>¿Cómo conocio el servicio?</strong></td>
    <td><strong>Correo electrónico</strong></td>
    <td><strong>Nombre del padre</strong></td>
    <td><strong>Ocupación del padre</strong></td>
    <td><strong>Edad del padre</strong></td>
    <td><strong>Teléfono de la madre</strong></td>
    <td><strong>Nombre de la madre</strong></td>
    <td><strong>Ocupación de la madre</strong></td>
    <td><strong>Edad de la madre</strong></td>
    <td><strong>Teléfono de la madre</strong></td>
    <td><strong>Nombre de cónyuge</strong></td>
    <td><strong>Ocupación de conyuge</strong></td>
    <td><strong>Edad de conyuge</strong></td>
    <td><strong>Teléfono de conyuge</strong></td>
    <td><strong>Detalles de hermanos</strong></td>
    <td><strong>Detalles de hermanas</strong></td>
    <td><strong>Detalles de hijos</strong></td>
    <td><strong>Detalles de hijas</strong></td>
    <td><strong>Alergias</strong></td>
    <td><strong>Tipo de sangre</strong></td>
    <td><strong>Contacto nombre</strong></td>
    <td><strong>Contacto dirección</strong></td>
    <td><strong>Contacto parentezco</strong></td>
    <td><strong>Contacto teléfono</strong></td>
    <td><strong>Contacto comentarios</strong></td>
    <td><strong>Id pase</strong></td>
    <td><strong>Total pases</strong></td>
    <td><strong>Part A</strong></td>
    <td><strong>Part B</strong></td>
    <td><strong>Part C</strong></td>
    <td><strong>Altec</strong></td>
    <td><strong>Altes</strong></td>
    <td><strong>Axa Santander</strong></td>
    <td><strong>Axa conducef</strong></td>
    <td><strong>Banorte</strong></td>
    <td><strong>Bansefi</strong></td>
    <td><strong>BNCI</strong></td>
    <td><strong>Emp</strong></td>
    <td><strong>Gpo Med</strong></td>
    <td><strong>Gpo Med Doctor</strong></td>
    <td><strong>Gpo Med Procesa</strong></td>
    <td><strong>GPo Med Almacen</strong></td>
    <td><strong>Insen</strong></td>
    <td><strong>S inves cob</strong></td>
    <td><strong>S inves no cob</strong></td>
    <td><strong>Serfin</strong></td>
    <td><strong>Tepeyac</strong></td>
    <td><strong>Vitamédica AFO</strong></td>
    <td><strong>Vitamédica Bancomer Operadora</strong></td>
    <td><strong>Vitamédica Banamex</strong></td>
    <td><strong>Vitamédica Bancomer SAN</strong></td>
    <td><strong>Vitamédica membresía</strong></td>
    <td><strong>Zuriich</strong></td>
    <td><strong>Dato A1</strong></td>
    <td><strong>Dato B2</strong></td>
    <td><strong>Dato C3</strong></td>
    <td><strong>Dato D4</strong></td>
    <td><strong>Dato E5</strong></td>
    <td><strong>Dato F6</strong></td>
    <td><strong>Dato G7</strong></td>
    <td><strong>Dato H8</strong></td>
    <td><strong>Dato I9</strong></td>
    <td><strong>Dato J10</strong></td>
    <td><strong>Dato K11</strong></td>
    <td><strong>Dato L12</strong></td>
    <td><strong>Dato M13</strong></td>
    <td><strong>Seguros Banorte</strong></td>
    <td><strong>Seguros Bancomer</strong></td>
    <td><strong>Mafre</strong></td>
    <td><strong>Monterrey</strong></td>
    <td><strong>Vitamédica ATA</strong></td>
    <td><strong>Gastos Mayores</strong></td>
    <td><strong>Red Plus</strong></td>
    <td><strong>MediAccess</strong></td>
    <td><strong>Vitamédica Monte de Piedad</strong></td>
    <td><strong>Asis Admin</strong></td>
    <td><strong>Código Postal</strong></td>
    <td><strong>2da Opinión</strong></td>
    <td><strong>Dirección Fiscal</strong></td>
    <td><strong>Fecha-PASE</strong></td>
    <td><strong>Vigencia-PASE</strong></td>
    <td><strong>Estado del expediente</strong></td>
    <td><strong>Referencia</strong></td>
    <td><strong>Peso</strong></td>
    <td><strong>Talla</strong></td>
    <td><strong>T.A</strong></td>
    <td><strong>F.C</strong></td>
    <td><strong>F.R</strong></td>
    <td><strong>Temperatura</strong></td>
    <td><strong>FUM</strong></td>
    <td><strong>Antecedentes familiares</strong></td>
    <td><strong>Antecedentes personales no patologicos</strong></td>
    <td><strong>Antecedentes personales patológicos</strong></td>
    <td><strong>Padecimiento actual</strong></td>
    <td><strong>Exploración física</strong></td>
     <td><strong>Otros datos</strong></td>
    <td><strong>RX</strong></td>
    <td><strong>Diagnóstico</strong></td>
    <td><strong>Tratamiento</strong></td>
  </tr>
";	
    echo 
"<tr>
    <td>".$fila['fecha_reg']."</td>
    <td>".$fila['paterno_paci']."</td>
    <td>".$fila['materno_paci']."</td>
    <td>".$fila['nombre_paci']."</td>
    <td>".$fila['sex_paci']."</td>
    <td>".$fila['naci_paci']."</td>
    <td>".$fila['edad_paci']."</td>
    <td>".$fila['lugar_paci']."</td>
    <td>".$fila['rfc_paci']."</td>
    <td>".$fila['curp_paci']."</td>
    <td>".$fila['titular']."</td>
    <td>".$fila['tel_cel']."</td>
    <td>".$fila['tel_cas']."</td>
    <td>".$fila['tel_ofi']."</td>
    <td>".$fila['tel_otro']."</td>
    <td>".$fila['calle']."</td>
    <td>".$fila['no_ext']."</td>
    <td>".$fila['no_int']."</td>
    <td>".$fila['col']."</td>
    <td>".$fila['mun']."</td>
    <td>".$fila['edo_dir']."</td>
    <td>".$fila['esco']."</td>
    <td>".$fila['ocupa']."</td>
    <td>".$fila['edo_civ']."</td>
    <td>".$fila['comenta']."</td>
    <td>".$fila['reli']."</td>
    <td>".$fila['conocio']."</td>
    <td>".$fila['correo']."</td>
    <td>".$fila['nom_pad']."</td>
    <td>".$fila['ocu_pad']."</td>
    <td>".$fila['edad_pad']."</td>
    <td>".$fila['tel_pad']."</td>
    <td>".$fila['nom_mad']."</td>
    <td>".$fila['ocu_mad']."</td>
    <td>".$fila['edad_mad']."</td>
    <td>".$fila['tel_mad']."</td>
    <td>".$fila['nom_cony']."</td>
    <td>".$fila['ocu_cony']."</td>
    <td>".$fila['edad_cony']."</td>
    <td>".$fila['tel_cony']."</td>
    <td>".$fila['det_hero']."</td>
    <td>".$fila['det_hera']."</td>
    <td>".$fila['det_hijo']."</td>
    <td>".$fila['det_hija']."</td>
    <td>".$fila['alergia']."</td>
    <td>".$fila['sangre']."</td>
    <td>".$fila['nom_cont']."</td>
    <td>".$fila['dir_cont']."</td>
    <td>".$fila['par_cont']."</td>
    <td>".$fila['tel_cont']."</td>
    <td>".$fila['com_cont']."</td>
    <td>".$fila['pase_id']."</td>
    <td>".$fila['pase_tot']."</td>
    <td>".$fila['part_a']."</td>
    <td>".$fila['part_b']."</td>
    <td>".$fila['part_c']."</td>
    <td>".$fila['altec']."</td>
    <td>".$fila['altes']."</td>
    <td>".$fila['axa_sant']."</td>
    <td>".$fila['axa_condu']."</td>
    <td>".$fila['banor']."</td>
    <td>".$fila['banse']."</td>
    <td>".$fila['bnci']."</td>
    <td>".$fila['emp']."</td>
    <td>".$fila['gpo_med']."</td>
    <td>".$fila['gpo_med_doc']."</td>
    <td>".$fila['gpo_med_pro']."</td>
    <td>".$fila['gpo_med_alm']."</td>
    <td>".$fila['inse']."</td>
    <td>".$fila['s_inves_cob']."</td>
    <td>".$fila['s_inves_no_cob']."</td>
    <td>".$fila['serfin']."</td>
    <td>".$fila['tepe']."</td>
    <td>".$fila['vita_afo']."</td>
    <td>".$fila['vita_bancom_ope']."</td>
    <td>".$fila['vita_banam']."</td>
    <td>".$fila['vita_bancom_san']."</td>
    <td>".$fila['vita_memb']."</td>
    <td>".$fila['zurich']."</td>
    <td>".$fila['d_a1']."</td>
    <td>".$fila['d_b2']."</td>
    <td>".$fila['d_c3']."</td>
    <td>".$fila['d_d4']."</td>
    <td>".$fila['d_e5']."</td>
    <td>".$fila['d_f6']."</td>
    <td>".$fila['d_g7']."</td>
    <td>".$fila['d_h8']."</td>
    <td>".$fila['d_i9']."</td>
    <td>".$fila['d_j10']."</td>
    <td>".$fila['d_k11']."</td>
    <td>".$fila['d_l12']."</td>
    <td>".$fila['d_m13']."</td>
    <td>".$fila['d_n14']."</td>
    <td>".$fila['d_o15']."</td>
    <td>".$fila['d_p16']."</td>
    <td>".$fila['d_q17']."</td>
    <td>".$fila['d_r18']."</td>
    <td>".$fila['d_s19']."</td>
    <td>".$fila['d_t20']."</td>
    <td>".$fila['d_u21']."</td>
    <td>".$fila['d_v22']."</td>
    <td>".$fila['d_x23']."</td>
    <td>".$fila['d_y24']."</td>
    <td>".$fila['d_z25']."</td>
    <td>".$fila['d_a26']."</td>
    <td>".$fila['d_b27']."</td>
    <td>".$fila['d_c28']."</td>
    <td>".$fila['edo_exp']."</td>
    <td>".$fila['ref_exp']."</td>
    <td>".$fila['hc_peso']."</td>
    <td>".$fila['hc_talla']."</td>
    <td>".$fila['hc_ta']."</td>
    <td>".$fila['hc_fc']."</td>
    <td>".$fila['hc_fr']."</td>
    <td>".$fila['hc_tem']."</td>
    <td>".$fila['hc_fum']."</td>
    <td>".$fila['hc_ant_fam']."</td>
    <td>".$fila['hc_ant_per_no_p']."</td>
    <td>".$fila['hc_ant_per_p']."</td>
    <td>".$fila['hc_pad']."</td>
    <td>".$fila['hc_exp_fis']."</td>
    <td>".$fila['hc_otros']."</td>
    <td>".$fila['hc_rx']."</td>
    <td>".$fila['hc_dx']."</td>
    <td>".$fila['hc_tx']."</td>
</tr></table>";
$sql = "SELECT * FROM consulta WHERE id_paciente = ".$fila['id_paciente'];
$datosConsulta = $con->select($sql);
echo"<table width='100%' border='1'cellspacing='0' cellpadding='0'>
<tr style='background-color:#D8D8D8' >
<td><strong>Id consulta</strong></td>
<td><strong>Fecha de consulta</strong></td>
<td><strong>N° de consulta</strong></td>
<td><strong>Edad</strong></td>
<td><strong>Pase</strong></td>
<td><strong>Fecha de última menstruación</strong></td>
<td><strong>N° de evoclución</strong></td>
<td><strong>Descripción de evolución</strong></td>
</tr>";
while($filaCosulta=mysqli_fetch_array($datosConsulta))
{
echo "
<tr>
<td>$filaCosulta[id_consulta]</td>
<td>$filaCosulta[fecha_cons]</td>
<td>$filaCosulta[no_cons]</td>
<td>$filaCosulta[edad_cons]</td>
<td>$filaCosulta[pase_cons]</td>
<td>$filaCosulta[fum_cons]</td>
<td>$filaCosulta[no_evo]</td>
<td>$filaCosulta[desc_evo]</td>
</tr>";
}

echo "</table>";
// todas sus consultas
}
 ?> 
</body>
</html>