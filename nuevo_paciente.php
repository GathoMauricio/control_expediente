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
<form class="form" id="form_nuevo_paciente_asistente">
<input type="hidden" name="edo_exp" value="Activo">
Enviar a lista de espera (Buzón):
<select name="ref_exp" style="border:none;">
<option value="SI" selected>SI</option>
<option value="NO">NO</option>
</select>
<br>
<label>Fecha de registro</label><br>
<input type="date" name="fecha_reg" style="border:none;" value="<?php echo date('Y-m-d'); ?>" readonly>
<table class="table" style="width:100%">
  <tr><td colspan="3" style="text-align:center;"><label>Información general</label></td></tr>
<tr>
<td>
<label>Nombre(s)</label>
<input type="text" name="nombre_paci" class="form-control" required>
</td>
<td>
<label>A. paterno</label>
<input type="text" name="paterno_paci" class="form-control" required>
</td>
<td>
<label>A. materno</label>
<input type="text" name="materno_paci" class="form-control" required>
</td>
</tr>

<tr>
<td>
<label>Sexo</label>
<select  name="sex_paci" class="form-control">
<option value="H">Hombre</option><option value="M">Mujer</option>
</select>
</td>
<td colspan="2">
<label>Fecha de nacimiento</label>
<input type="date" name="naci_paci" class="form-control" required>
</td>
<!--<td>
<label>Edad</label>
<input type="number" name="edad_paci" class="form-control" required>
</td>-->
</tr>

<tr>
<td>
<label>Lugar de nacimiento</label>
<select name="lugar_paci" class="form-control">
<?php include 'forms/options_estados_republica.php'; ?>
</select>
</td>
<td>
<label>RFC</label>
<input type="text"  name="rfc_paci" class="form-control">
</td>
<td>
<label>CURP</label>
<input type="text" name="curp_paci" class="form-control">
</td>
</tr>
<tr>
  <td colspan="3">
    <label>Titular</label>
    <input type="text" name="titular" class="form-control">
  </td>
</tr>
</table>
<table class="table" style="width:100%">
<tr><td colspan="2" style="text-align:center;"><label>Teléfonos</label></td></tr>
<tr>
<td>
<label>Teléfono de casa</label>
<input type="number"  name="tel_cas" class="form-control" >
</td>
<td>
<label>Teléfono celular</label>
<input type="number"  name="tel_cel" class="form-control" >
</td>
</tr>
<tr>
<td>
<label>Teléfono de oficina</label>
<input type="number"  name="tel_ofi" class="form-control" >
</td>
<td>
<label>Teléfono otro</label>
<input type="number"  name="tel_otro" class="form-control" >
</td>
</tr>
</table>

<table class="table" style="width:100%">
<tr><td colspan="3" style="text-align:center;"><label>Dirección</label></td></tr>
<tr>
<td>
<label>Estado</label>
<select name="edo_dir" class="form-control">
<?php include 'forms/options_estados_republica.php'; ?>
</select>
</td>
<td>
<label>Municipio</label>
<input type="text"  name="mun" class="form-control" >
</td>
<td>
<label>Colonia</label>
<input type="text"  name="col" class="form-control" >
</td>
</tr>
<tr>
<td>
<label>Calle</label>
<input type="text"  name="calle" class="form-control" >
</td>
<td>
<label>Número Ext</label>
<input type="text"  name="no_ext" class="form-control" >
</td>
<td>
<label>Número Int</label>
<input type="text"  name="no_int" class="form-control" >
</td>
</tr>
</table>
<table class="table" style="width:100%;">
<tr><td colspan="2" style="text-align:center;"><label>Otros datos</label></td></tr>
<tr>
<td>
<label>Escolaridad</label>
<input type="text"  name="esco" class="form-control" >
</td>
<td>
<label>Religión</label>
<input type="text"  name="reli" class="form-control" >
</td>
</tr>
<tr>
<td>
<label>Ocupación</label>
<input type="text"  name="ocupa" class="form-control" >
</td>
<td>
<label>¿Comó conoció?</label>
<input type="text"  name="conocio" class="form-control" >
</td>
</tr>
<tr>
<td>
<label>Estado civil</label>
<input type="text"  name="edo_civ" class="form-control" >
</td>
<td>
<label>Correo electrónico</label>
<input type="text"  name="correo" class="form-control" >
</td>
</tr>
<tr>
<td colspan="2">
<label>Comentarios</label>
<textarea class="form-control" name="comenta"></textarea>
</td>
</tr>
</table>
<table class="table" style="width:100%;">
<tr><td colspan="2" style="text-align:center;"><label>Datos del padre</label></td></tr>
<tr>
<td>
<label>Nombre</label>
<input type="text"  name="nom_pad" class="form-control" >
</td>
<td>
<label>Ocupación</label>
<input type="text"  name="ocu_pad" class="form-control" >
</td>
</tr>
<tr>
<td>
<label>Edad</label>
<input type="text"  name="edad_pad" class="form-control" >
</td>
<td>
<label>Teléfono</label>
<input type="text"  name="tel_pad" class="form-control" >
</td>
</tr>
</table>
<table class="table" style="width:100%;">
<tr><td colspan="2" style="text-align:center;"><label>Datos del madre</label></td></tr>
<tr>
<td>
<label>Nombre</label>
<input type="text"  name="nom_mad" class="form-control" >
</td>
<td>
<label>Ocupación</label>
<input type="text"  name="ocu_mad" class="form-control" >
</td>
</tr>
<tr>
<td>
<label>Edad</label>
<input type="text"  name="edad_mad" class="form-control" >
</td>
<td>
<label>Teléfono</label>
<input type="text"  name="tel_mad" class="form-control" >
</td>
</tr>
</table>
<table class="table" style="width:100%;">
<tr><td colspan="2" style="text-align:center;"><label>Datos del cónyuge</label></td></tr>
<tr>
<td>
<label>Nombre</label>
<input type="text"  name="nom_cony" class="form-control" >
</td>
<td>
<label>Ocupación</label>
<input type="text"  name="ocu_cony" class="form-control" >
</td>
</tr>
<tr>
<td>
<label>Edad</label>
<input type="text"  name="edad_cony" class="form-control" >
</td>
<td>
<label>Teléfono</label>
<input type="text"  name="tel_cony" class="form-control" >
</td>
</tr>
</table>

<table class="table" style="width:100%;">
<tr><td colspan="2" style="text-align:center;"><label>Hermanos</label></td></tr>
<tr>
<td>
<label>Detalle de hermanos</label>
<textarea class="form-control" name="det_hero"></textarea>
</td>
<td>
<label>Detalle de hermanas</label>
<textarea class="form-control" name="det_hera"></textarea>
</td>
</tr>
<tr><td colspan="2" style="text-align:center;"><label>Hijos</label></td></tr>
<tr>
<td>
<label>Detalle de hijos</label>
<textarea class="form-control" name="det_hijo"></textarea>
</td>
<td>
<label>Detalle de hijas</label>
<textarea class="form-control" name="det_hija"></textarea>
</td>
</tr>
</table>

<table class="table" style="width:100%;">
<tr><td colspan="2" style="text-align:center;"><label>Sangre y alergias</label></td></tr>
<tr>
<td>
<label>Tipo de sangre</label>
<input type="text"  name="sangre" class="form-control" >
</td>
<td>
<label>Alergias</label>
<input type="text"  name="alergia" class="form-control" >
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
<input type="text"  name="nom_cont" class="form-control">
</td>
</tr>
<tr>
<td colspan="2">
<label>Dirección</label>
<textarea class="form-control" name="dir_cont"></textarea>
</td>
</tr>
<tr>
<td>
<label>Parentezco</label>
<input type="text"  name="par_cont" class="form-control">
</td>
<td>
<label>Teléfono</label>
<input type="text"  name="tel_cont" class="form-control">
</td>
</tr>
<tr>
<td colspan="2">
<label>Comentarios</label>
<textarea class="form-control" name="com_cont"></textarea>
</td>
</tr>
</table>
<input type="submit" class="btn btn-primary" style="width:100%;">
</form>
<?php include 'footer.php'; ?> 
<script type="text/javascript">
$(document).ready(function(){
  $("#form_nuevo_paciente_asistente").submit(function(e){
    e.preventDefault();
    $.post('control/ctrl_asistente.php?e=insertPaciente',$("#form_nuevo_paciente_asistente").serialize(),function(data){
      swal('Aviso',data);
      //console.log(data);
      $("#form_nuevo_paciente_asistente")[0].reset();
    });
  });
});
</script>