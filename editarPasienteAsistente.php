<?php include 'head.php'; ?>
<?php 
session_start();
if(isset($_SESSION['tipo_usu']))
{
	switch($_SESSION['tipo_usu'])
	{
		case 'Administrador': header('Location: administrador.php'); break;
	}
}else{
	header('Location: index.php');
}
 ?>
<?php 
include 'control/conexion.php';
$con = new Conexion();
$sql="SELECT * FROM paciente WHERE id_paciente=".$_GET['id_paciente'];
$datos=$con->select($sql);
$data;
if($fila=mysqli_fetch_array($datos))
{
  $data=$fila;
}
?>
<style type="text/css">
.contenedor_nuevo_paciente{
  padding: 20px;
  width: 60%;
  background-color: white;
  text-align: left;
  opacity: 0.9;
  box-shadow: 5px 5px 15px #0080FF;
  border-style: outset;
}
</style>
<center>
<br><br><br><br>
<div class="contenedor_nuevo_paciente">
<label style="float:left;color:blue;cursor:pointer;" title="Inicio" onclick="window.history.back();"><span class='icon-home'></span></label>
<label style="float:right;color:red;cursor:pointer;" title="Cerrar sesión" onclick="cerrarSesion();"><span class='icon-exit'></span></label><br>
<label style="float:right;"><?php echo $_SESSION['tipo_usu'].': '.$_SESSION['nombre']; ?></label><br><br>
<h4>Nuevo paciente.</h4>
<form class="form" id="form_actualizar_paciente_asistente">
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
<label>Fecha de registro</label><br>
<input type="date" name="fecha_reg" style="border:none;" value="<?php echo $data['fecha_reg']; ?>" readonly>
<table class="table" style="width:100%">
  <tr><td colspan="3" style="text-align:center;"><label>Información general</label></td></tr>
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
<td>
<label>Edad</label>
<input type="number" name="edad_paci" value="<?php echo $data['edad_paci']; ?>" class="form-control">
</td>
</tr>
<tr><td colspan="3">Si el campo edad se encuentra vacio, el sistema calculará la edad automáticamente...</td></tr>
<tr>
<td>
<label>Lugar de nacimiento</label>
<select name="lugar_paci" id="cbo_lugar_paci" class="form-control">
<?php include 'forms/options_estados_republica.php'; ?>
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
<?php include 'forms/options_estados_republica.php'; ?>
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
<input type="submit" class="btn btn-primary" style="width:100%;">
</form>
<?php include 'footer.php'; ?> 
<script type="text/javascript">
$(document).ready(function(){
  $("#cbo_lugar_paci").prop('value','<?php echo $data["lugar_paci"]; ?>');
  $("#cbo_edo_dir").prop('value','<?php echo $data["edo_dir"]; ?>');
  $("#form_actualizar_paciente_asistente").submit(function(e){
    e.preventDefault();
    $.post('control/ctrl_asistente.php?e=updatePaciente',$("#form_actualizar_paciente_asistente").serialize(),function(data){
      alert(data);
      window.history.back()
    });
  });
});
</script>