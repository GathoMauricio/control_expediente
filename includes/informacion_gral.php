
<?php 
include '../control/conexion.php';
$con = new Conexion();
$sql="SELECT * FROM paciente WHERE id_paciente=".$_POST['id_expediente'];
$datos=$con->select($sql);
$data;
if($fila=mysqli_fetch_array($datos))
{
  $data=$fila;
  
}
$sql = "SELECT count(*) as num_cons FROM consulta WHERE id_paciente=".$_POST['id_expediente'];
$datos = $con->select($sql);
$num_cons;
if($fila=mysqli_fetch_array($datos)) $num_cons = $fila['num_cons'];
?>
<center>
<div class="info_gral">
<table style="width:100%;">
<tr>
<td> <button onclick="agregarBuzon(<?php echo $_POST['id_expediente']; ?>);" class="btn btn-primary" style="">Enviar a buzón</button> </td>
<td> <button onclick="informacionGral(<?php echo $_POST['id_expediente']; ?>);" class="btn btn-primary" style="">Información Gral</button> </td>
<?php 
session_start();
if($_SESSION['tipo_usu']=='Doctor')
{
  if($num_cons<=0)
  {
      echo'
  <td> <button onclick="iniciarConsulta('.$_POST['id_expediente'].');" class="btn btn-primary" style="">Iniciar consulta</button> </td>
  <td> <button onclick="consultas('.$_POST['id_expediente'].');"  class="btn btn-primary" style="">Consultas</button> </td>
  <td> <button onclick="archivos('.$_POST['id_expediente'].');"  class="btn btn-primary" style="">Archivos</button> </td>';
  }else{
    echo'
  <td> <button onclick="iniciarConsulta('.$_POST['id_expediente'].');" class="btn btn-primary" style="">Iniciar consulta</button> </td>
  <td> <button onclick="historiaClinica('.$_POST['id_expediente'].');" class="btn btn-primary" style="">Historia clínica</button> </td>
  <td> <button onclick="consultas('.$_POST['id_expediente'].');"  class="btn btn-primary" style="">Consultas</button> </td>
  <td> <button onclick="archivos('.$_POST['id_expediente'].');"  class="btn btn-primary" style="">Archivos</button> </td>';
  }
  
}
 ?>
 </tr>
</table>
<h4>Información general.</h4>
<form class="form" id="form_actualizar_paciente_doctor">
  <input type="hidden" name="id_paciente" value="<?php echo $data['id_paciente']; ?>">
Estatus del expediente:
<?php 
if($data['edo_exp']=="Activo")
{
  $edo_exp_activo="selected";
  $edo_exp_inactivo="";
}else{
  $edo_exp_activo="";
  $edo_exp_inactivo="selected";
}
 ?>
<select name="edo_exp" style="border:none;">
<option value="Activo" <?php echo $edo_exp_activo; ?> >Activo</option>
<option value="Inactivo" <?php echo $edo_exp_inactivo; ?> >Inactivo</option>
</select>
<br>
<label>Fecha de registro: <?php echo $data['fecha_reg']; ?> </label><br>

<table class="table" style="width:100%">
<tr>
<td>
<label>Nombre(s)</label>
<input type="text" name="nombre_paci" value="<?php echo $data['nombre_paci']; ?>" class="form-control" required>
</td>
<td>
<label>A. paterno</label>
<input type="text" name="paterno_paci" value="<?php echo $data['paterno_paci']; ?>" class="form-control" required>
</td>
<td>
<label>A. materno</label>
<input type="text" name="materno_paci" value="<?php echo $data['materno_paci']; ?>" class="form-control" required>
</td>
</tr>

<tr>
<td>
<label>Sexo</label>
<?php 
if($data['sex_paci']=='H'){
  $sex_paci_h = "selected";
  $sex_paci_m = "";
}else{
  $sex_paci_h = "";
  $sex_paci_m = "selected";
}
 ?>
<select  name="sex_paci" class="form-control">
<option value="H" <?php echo $sex_paci_h; ?>>Hombre</option><option value="M" <?php echo $sex_paci_m; ?>>Mujer</option>
</select>
</td>
<td>
<label>Fecha de nacimiento</label>
<input type="date" name="naci_paci" value="<?php echo $data['naci_paci']; ?>" class="form-control" required>
</td>
<td >
<label>Edad</label>
<input type="number" name="edad_paci" value="<?php echo $data['edad_paci']; ?>" class="form-control">
</td>
</tr>
<tr><td colspan="3">Si el campo edad se encuentra vacio, el sistema calculará la edad automáticamente...</td></tr>
<tr>
<td>
<label>Lugar de nacimiento</label>
<select name="lugar_paci" id="cbo_lugar_paci" class="form-control">
<?php include '../includes/options_estados_republica.php'; ?>
</select>
</td>
<td>
<label>RFC</label>
<input type="text"  name="rfc_paci" value="<?php echo $data['rfc_paci']; ?>" class="form-control">
</td>
<td>
<label>CURP</label>
<input type="text" name="curp_paci" value="<?php echo $data['curp_paci']; ?>" class="form-control">
</td>
</tr>
<tr>
  <td colspan="3">
    <label>Titular</label>
    <input type="text" name="titular" value="<?php echo $data['titular']; ?>" class="form-control">
  </td>
</tr>
</table>
<table class="table" style="width:100%">
<tr><td colspan="2" style="text-align:center;"><label>Teléfonos</label></td></tr>
<tr>
<td>
<label>Teléfono de casa</label>
<input type="number"  name="tel_cas" value="<?php echo $data['tel_cas']; ?>" class="form-control" >
</td>
<td>
<label>Teléfono celular</label>
<input type="number"  name="tel_cel" value="<?php echo $data['tel_cel']; ?>" class="form-control" >
</td>
</tr>
<tr>
<td>
<label>Teléfono de oficina</label>
<input type="number"  name="tel_ofi" value="<?php echo $data['tel_ofi']; ?>" class="form-control" >
</td>
<td>
<label>Teléfono otro</label>
<input type="number"  name="tel_otro" value="<?php echo $data['tel_otro']; ?>" class="form-control" >
</td>
</tr>
</table>

<table class="table" style="width:100%">
<tr><td colspan="3" style="text-align:center;"><label>Dirección</label></td></tr>
<tr>
<td>
<label>Estado</label>

<select name="edo_dir" id="cbo_edo_dir" class="form-control">
<?php include '../includes//options_estados_republica.php'; ?>
</select>
</td>
<td>
<label>Municipio</label>
<input type="text"  name="mun" value="<?php echo $data['mun']; ?>" class="form-control" >
</td>
<td>
<label>Colonia</label>
<input type="text"  name="col" value="<?php echo $data['col']; ?>" class="form-control" >
</td>
</tr>
<tr>
<td>
<label>Calle</label>
<input type="text"  name="calle" value="<?php echo $data['calle']; ?>" class="form-control" >
</td>
<td>
<label>Número Ext</label>
<input type="text"  name="no_ext" value="<?php echo $data['no_ext']; ?>" class="form-control" >
</td>
<td>
<label>Número Int</label>
<input type="text"  name="no_int" value="<?php echo $data['no_int']; ?>" class="form-control" >
</td>
</tr>
</table>
<table class="table" style="width:100%;">
<tr><td colspan="2" style="text-align:center;"><label>Otros datos</label></td></tr>
<tr>
<td>
<label>Escolaridad</label>
<input type="text"  name="esco" value="<?php echo $data['esco']; ?>" class="form-control" >
</td>
<td>
<label>Religión</label>
<input type="text"  name="reli" value="<?php echo $data['reli']; ?>" class="form-control" >
</td>
</tr>
<tr>
<td>
<label>Ocupación</label>
<input type="text"  name="ocupa" value="<?php echo $data['ocupa']; ?>" class="form-control" >
</td>
<td>
<label>¿Comó conoció?</label>
<input type="text"  name="conocio" value="<?php echo $data['conocio']; ?>" class="form-control" >
</td>
</tr>
<tr>
<td>
<label>Estado civil</label>
<input type="text"  name="edo_civ" value="<?php echo $data['edo_civ']; ?>" class="form-control" >
</td>
<td>
<label>Correo electrónico</label>
<input type="text"  name="correo" value="<?php echo $data['correo']; ?>" class="form-control" >
</td>
</tr>
<tr>
<td colspan="2">
<label>Comentarios</label>
<textarea class="form-control"  name="comenta" ><?php echo $data['comenta']; ?></textarea>
</td>
</tr>
</table>
<table class="table" style="width:100%;">
<tr><td colspan="2" style="text-align:center;"><label>Datos del padre</label></td></tr>
<tr>
<td>
<label>Nombre</label>
<input type="text"  name="nom_pad" value="<?php echo $data['nom_pad']; ?>" class="form-control" >
</td>
<td>
<label>Ocupación</label>
<input type="text"  name="ocu_pad" value="<?php echo $data['ocu_pad']; ?>" class="form-control" >
</td>
</tr>
<tr>
<td>
<label>Edad</label>
<input type="text"  name="edad_pad" value="<?php echo $data['edad_pad']; ?>" class="form-control" >
</td>
<td>
<label>Teléfono</label>
<input type="text"  name="tel_pad" value="<?php echo $data['tel_pad']; ?>" class="form-control" >
</td>
</tr>
</table>
<table class="table" style="width:100%;">
<tr><td colspan="2" style="text-align:center;"><label>Datos del madre</label></td></tr>
<tr>
<td>
<label>Nombre</label>
<input type="text"  name="nom_mad" value="<?php echo $data['nom_mad']; ?>" class="form-control" >
</td>
<td>
<label>Ocupación</label>
<input type="text"  name="ocu_mad" value="<?php echo $data['ocu_mad']; ?>" class="form-control" >
</td>
</tr>
<tr>
<td>
<label>Edad</label>
<input type="text"  name="edad_mad" value="<?php echo $data['edad_mad']; ?>" class="form-control" >
</td>
<td>
<label>Teléfono</label>
<input type="text"  name="tel_mad" value="<?php echo $data['tel_mad']; ?>" class="form-control" >
</td>
</tr>
</table>
<table class="table" style="width:100%;">
<tr><td colspan="2" style="text-align:center;"><label>Datos del cónyuge</label></td></tr>
<tr>
<td>
<label>Nombre</label>
<input type="text"  name="nom_cony" value="<?php echo $data['nom_cony']; ?>" class="form-control" >
</td>
<td>
<label>Ocupación</label>
<input type="text"  name="ocu_cony" value="<?php echo $data['ocu_cony']; ?>" class="form-control" >
</td>
</tr>
<tr>
<td>
<label>Edad</label>
<input type="text"  name="edad_cony" value="<?php echo $data['edad_cony']; ?>" class="form-control" >
</td>
<td>
<label>Teléfono</label>
<input type="text"  name="tel_cony" value="<?php echo $data['tel_cony']; ?>" class="form-control" >
</td>
</tr>
</table>

<table class="table" style="width:100%;">
<tr><td colspan="2" style="text-align:center;"><label>Hermanos</label></td></tr>
<tr>
<td>
<label>Detalle de hermanos</label>
<textarea class="form-control" name="det_hero"><?php echo $data['det_hero']; ?></textarea>
</td>
<td>
<label>Detalle de hermanas</label>
<textarea class="form-control" name="det_hera"><?php echo $data['det_hera']; ?></textarea>
</td>
</tr>
<tr><td colspan="2" style="text-align:center;"><label>Hijos</label></td></tr>
<tr>
<td>
<label>Detalle de hijos</label>
<textarea class="form-control" name="det_hijo"><?php echo $data['det_hijo']; ?></textarea>
</td>
<td>
<label>Detalle de hijas</label>
<textarea class="form-control" name="det_hija"><?php echo $data['det_hija']; ?></textarea>
</td>
</tr>
</table>

<table class="table" style="width:100%;">
<tr><td colspan="2" style="text-align:center;"><label>Sangre y alergias</label></td></tr>
<tr>
<td>
<label>Tipo de sangre</label>
<input type="text"  name="sangre" value="<?php echo $data['sangre']; ?>" class="form-control" >
</td>
<td>
<label>Alergias</label>
<input type="text"  name="alergia" value="<?php echo $data['alergia']; ?>" class="form-control" >
</td>
</tr>
<tr>
</tr>
</table>
<table class="table" style="width:100%;">
<tr><td colspan="2" style="text-align:center;"><label>Contacto en caso de urgencias</label></td></tr>
<tr>
<td colspan="2">
<label>Nombre</label>
<input type="text"  name="nom_cont" value="<?php echo $data['nom_cont']; ?>" class="form-control">
</td>
</tr>
<tr>
<td colspan="2">
<label>Dirección</label>
<textarea class="form-control"  name="dir_cont"><?php echo $data['dir_cont']; ?></textarea>
</td>
</tr>
<tr>
<td>
<label>Parentezco</label>
<input type="text"  name="par_cont" value="<?php echo $data['par_cont']; ?>" class="form-control">
</td>
<td>
<label>Teléfono</label>
<input type="text"  name="tel_cont" value="<?php echo $data['tel_cont']; ?>" class="form-control">
</td>
</tr>
<tr>
<td colspan="2">
<label>Comentarios</label>
<textarea class="form-control" name="com_cont"><?php echo $data['com_cont']; ?></textarea>
</td>
</tr>
</table>


<tr>
<td>
<label>ID pase</label>
<input type="text"  name="pase_id" value="<?php echo $data['pase_id']; ?>" placeholder="Si el pase esta vacio pasa a ser VIP..."  class="form-control">
</td>
<td>
<label>Total de Consultas Permitidas</label>
<input type="number" min="1"  name="pase_tot" value="<?php echo $data['pase_tot']; ?>"  class="form-control" required>
</td>
</tr>
</table>

<!--

<table class="table" style="width:100%" id="historia_clinica">
<tr><td colspan="3" style="text-align:center;"><label>Datos de historia clínica</label></td></tr>
<tr>
<td>
<label>Peso</label>
<input type="text"  name="hc_peso" value="<?php echo $data['hc_peso']; ?>"  class="form-control">
</td>
<td>
<label>Talla</label>
<input type="text"  name="hc_talla" value="<?php echo $data['hc_talla']; ?>"  class="form-control">
</td>
<td>
<label>T.A.</label>
<input type="text"  name="hc_ta" value="<?php echo $data['hc_ta']; ?>"  class="form-control">
</td>
</tr>
<tr>
<td>
<label>F.C.</label>
<input type="text"  name="hc_fc" value="<?php echo $data['hc_fc']; ?>"  class="form-control">
</td>
<td>
<label>F.R.</label>
<input type="text"  name="hc_fr" value="<?php echo $data['hc_fr']; ?>"  class="form-control">
</td>
<td>
<label>Temperatura</label>
<input type="text"  name="hc_tem" value="<?php echo $data['hc_tem']; ?>"  class="form-control">
</td>
</tr>
<tr>
<td colspan="3">
<label>FUM</label>
<input type="date"  name="hc_fum" value="<?php echo $data['hc_fum']; ?>"  class="form-control">
</td>
</tr>
</table>

<table class="table" style="width:100%">
<tr><td style="text-align:center;"><label>Antecedentes</label></td></tr>
<tr>
<td>
<label>Antecedentes familiares</label>
<textarea class="form-control"  name="hc_ant_fam"><?php echo $data['hc_ant_fam']; ?></textarea>
</td>
</tr>
<tr>
<td>
<label>Antecedentes personales patológicos</label>
<textarea class="form-control" name="hc_ant_per_p"><?php echo $data['hc_ant_per_p']; ?></textarea>
</td>
</tr>
<tr>
<td>
<label>Antecedentes personales no patológicos</label>
<textarea class="form-control" name="hc_ant_per_no_p"><?php echo $data['hc_ant_per_no_p']; ?></textarea>
</td>
</tr>
<tr>
<td>
<label>Padecimiento actual</label>
<textarea class="form-control" name="hc_pad"><?php echo $data['hc_pad']; ?></textarea>
</td>
</tr>
<tr>
<td>
<label>Exploración física</label>
<textarea class="form-control" name="hc_exp_fis"><?php echo $data['hc_exp_fis']; ?></textarea>
</td>
</tr>
<tr>
<td>
<label>Otros datos</label>
<textarea class="form-control" name="hc_otros"><?php echo $data['hc_otros']; ?></textarea>
</td>
</tr>
<tr>
<td>
<label>RX</label>
<textarea class="form-control" name="hc_rx"><?php echo $data['hc_rx']; ?></textarea>
</td>
</tr>
<tr>
<td>
<label>Diagnóstico</label>
<textarea class="form-control" name="hc_dx"><?php echo $data['hc_dx']; ?></textarea>
</td>
</tr>
<tr>
<td>
<label>Tratamiento</label>
<textarea class="form-control" name="hc_tx"><?php echo $data['hc_tx']; ?></textarea>
</td>
</tr>
</table>


-->
<table class="table" style="width:100%;">
<tr><td colspan="4" style="text-align:center;"><label>Datos adicionales</label></td></tr>
<tr>
<td>
<label>Part. A</label>
<input type="text" class="form-control" name="part_a" value="<?php echo $data['part_a']; ?>" />
</td>
<td>
<label>Part. B</label>
<input type="text" class="form-control" name="part_b" value="<?php echo $data['part_b']; ?>" />
</td>
<td>
<label>Part. C</label>
<input type="text" class="form-control" name="part_c" value="<?php echo $data['part_c']; ?>" />
</td>
<td>
<label>Altec</label>
<input type="text" class="form-control" name="altec" value="<?php echo $data['altec']; ?>" />
</td>
</tr>
<tr>
<td>
<label>Altes</label>
<input type="text" class="form-control" name="altes" value="<?php echo $data['altes']; ?>" />
</td>
<td>
<label>Axa. Santander</label>
<input type="text" class="form-control" name="axa_sant" value="<?php echo $data['axa_sant']; ?>" />
</td>
<td>
<label>Axa. Conducef</label>
<input type="text" class="form-control" name="axa_condu" value="<?php echo $data['axa_condu']; ?>" />
</td>
<td>
<label>Banorte</label>
<input type="text" class="form-control" name="banor" value="<?php echo $data['banor']; ?>" />
</td>
</tr>
<tr>
<td>
<label>Bansefi</label>
<input type="text" class="form-control" name="banse" value="<?php echo $data['banse']; ?>" />
</td>
<td>
<label>BNCI</label>
<input type="text" class="form-control" name="bnci" value="<?php echo $data['bnci']; ?>" />
</td>
<td>
<label>Emp</label>
<input type="text" class="form-control" name="emp" value="<?php echo $data['emp']; ?>" />
</td>
<td>
<label>Gpo. Méd</label>
<input type="text" class="form-control" name="gpo_med" value="<?php echo $data['gpo_med']; ?>" />
</td>
</tr>
<tr>
<td>
<label>Gpo. Méd doctor</label>
<input type="text" class="form-control" name="gpo_med_doc" value="<?php echo $data['gpo_med_doc']; ?>" />
</td>
<td>
<label>Gpo. Méd. procesa</label>
<input type="text" class="form-control" name="gpo_med_pro" value="<?php echo $data['gpo_med_pro']; ?>" />
</td>
<td>
<label>Gpo. Méd almacen</label>
<input type="text" class="form-control" name="gpo_med_alm" value="<?php echo $data['gpo_med_alm']; ?>" />
</td>
<td>
<label>Insen</label>
<input type="text" class="form-control" name="inse" value="<?php echo $data['inse']; ?>" />
</td>
</tr>
<tr>
<td>
<label>S inves cob</label>
<input type="text" class="form-control" name="s_inves_cob" value="<?php echo $data['s_inves_cob']; ?>" />
</td>
<td>
<label>S inves no cob</label>
<input type="text" class="form-control" name="s_inves_no_cob" value="<?php echo $data['s_inves_no_cob']; ?>" />
</td>
<td>
<label>Serfin</label>
<input type="text" class="form-control" name="serfin" value="<?php echo $data['serfin']; ?>" />
</td>
<td>
<label>Tepeyac</label>
<input type="text" class="form-control" name="tepe" value="<?php echo $data['tepe']; ?>" />
</td>
</tr>
<tr>
<td>
<label>Vitamédica AFO</label>
<input type="text" class="form-control" name="vita_afo" value="<?php echo $data['vita_afo']; ?>" />
</td>
<td>
<label>Vitamédica Bancomer operadora</label>
<input type="text" class="form-control" name="vita_bancom_ope" value="<?php echo $data['vita_bancom_ope']; ?>" />
</td>
<td>
<label>Vitamédica Banamex</label>
<input type="text" class="form-control" name="vita_banam" value="<?php echo $data['vita_banam']; ?>" />
</td>
<td>
<label>Vitamédica Bancomer SAN</label>
<input type="text" class="form-control" name="vita_bancom_san" value="<?php echo $data['vita_bancom_san']; ?>" />
</td>
</tr>
<tr>
<td>
<label>Vitamédica Membresía</label>
<input type="text" class="form-control" name="vita_memb" value="<?php echo $data['vita_memb']; ?>" />
</td>
<td>
<label>Zurich</label>
<input type="text" class="form-control" name="zurich" value="<?php echo $data['zurich']; ?>" />
</td>
<td>

</td>
<td>

</td>
</tr>
<tr>
<td>
<label>Dato A1</label>
<input type="text" class="form-control" name="d_a1" value="<?php echo $data['d_a1']; ?>" />
</td>
<td>
<label>Dato B2</label>
<input type="text" class="form-control" name="d_b2" value="<?php echo $data['d_b2']; ?>" />
</td>
<td>
<label>Dato C3</label>
<input type="text" class="form-control" name="d_c3" value="<?php echo $data['d_c3']; ?>" />
</td>
<td>
<label>Dato D4</label>
<input type="text" class="form-control" name="d_d4" value="<?php echo $data['d_d4']; ?>" />
</td>
</tr>
<tr>
<td>
<label>Dato E5</label>
<input type="text" class="form-control" name="d_e5" value="<?php echo $data['d_e5']; ?>" />
</td>
<td>
<label>Dato F6</label>
<input type="text" class="form-control" name="d_f6" value="<?php echo $data['d_f6']; ?>" />
</td>
<td>
<label>Dato G7</label>
<input type="text" class="form-control" name="d_g7" value="<?php echo $data['d_g7']; ?>" />
</td>
<td>
<label>Dato H8</label>
<input type="text" class="form-control" name="d_h8" value="<?php echo $data['d_h8']; ?>" />
</td>
</tr>

<tr>
<td>
<label>Dato I9</label>
<input type="text" class="form-control" name="d_i9" value="<?php echo $data['d_i9']; ?>" />
</td>
<td>
<label>Dato J10</label>
<input type="text" class="form-control" name="d_j10" value="<?php echo $data['d_j10']; ?>" />
</td>
<td>
<label>Dato K11</label>
<input type="text" class="form-control" name="d_k11" value="<?php echo $data['d_k11']; ?>" />
</td>
<td>
<label>Dato L12</label>
<input type="text" class="form-control" name="d_l12" value="<?php echo $data['d_l12']; ?>" />
</td>
</tr>
<tr>
<td>
<label>Dato M13</label>
<input type="text" class="form-control" name="d_m13" value="<?php echo $data['d_m13']; ?>" />
</td>
<td>
<label>Dato N14</label>
<input type="text" class="form-control" name="d_n14" value="<?php echo $data['d_n14']; ?>" />
</td>
<td>
<label>Dato O15</label>
<input type="text" class="form-control" name="d_o15" value="<?php echo $data['d_o15']; ?>" />
</td>
<td>
<label>Dato P16</label>
<input type="text" class="form-control" name="d_p16" value="<?php echo $data['d_p16']; ?>" />
</td>
</tr>
<tr>
<td>
<label>Dato Q17</label>
<input type="text" class="form-control" name="d_q17" value="<?php echo $data['d_q17']; ?>" />
</td>
<td>
<label>Dato R18</label>
<input type="text" class="form-control" name="d_r18" value="<?php echo $data['d_r18']; ?>" />
</td>
<td>
<label>Dato S19</label>
<input type="text" class="form-control" name="d_s19" value="<?php echo $data['d_s19']; ?>" />
</td>
<td>
<label>Dato T20</label>
<input type="text" class="form-control" name="d_t20" value="<?php echo $data['d_t20']; ?>" />
</td>
</tr>
<tr>
<td>
<label>Dato U21</label>
<input type="text" class="form-control" name="d_u21" value="<?php echo $data['d_u21']; ?>" />
</td>
<td>
<label>Dato V22</label>
<input type="text" class="form-control" name="d_v22" value="<?php echo $data['d_v22']; ?>" />
</td>
<td>
<label>Dato X23</label>
<input type="text" class="form-control" name="d_x23" value="<?php echo $data['d_x23']; ?>" />
</td>
<td>
<label>Dato Y24</label>
<input type="text" class="form-control" name="d_y24" value="<?php echo $data['d_y24']; ?>" />
</td>
</tr>
<tr>
<td>
<label>Dato Z25</label>
<input type="text" class="form-control" name="d_z25" value="<?php echo $data['d_z25']; ?>" />
</td>
<td>
<label>Dato A26</label>
<input type="text" class="form-control" name="d_a26" value="<?php echo $data['d_a26']; ?>" />
</td>
<td>
<label>Dato B27</label>
<input type="text" class="form-control" name="d_b27" value="<?php echo $data['d_b27']; ?>" />
</td>
<td>
<label>Dato C28</label>
<input type="text" class="form-control" name="d_c28" value="<?php echo $data['d_c28']; ?>" />
</td>
</tr>

</table>



<input type="submit" class="btn btn-primary" value="Guardar cambios" style="width:100%;">
</form>
</div>
</center>


<script type="text/javascript">
$(document).ready(function(){
  $("#cbo_lugar_paci").prop('value','<?php echo $data["lugar_paci"]; ?>');
  $("#cbo_edo_dir").prop('value','<?php echo $data["edo_dir"]; ?>');
  $("#form_actualizar_paciente_doctor").submit(function(e){
    e.preventDefault();
    $.post('control/ctrl_expediente.php?e=actualizarPaciente',$("#form_actualizar_paciente_doctor").serialize(),function(data){
      swal('',data);
      abrirExpediente(<?php echo $_POST['id_expediente']; ?>);
      window.open("control/conexion.php?e=exportarBD");
      window.open("control/lista_excel.php");
    });
  });
});
</script>