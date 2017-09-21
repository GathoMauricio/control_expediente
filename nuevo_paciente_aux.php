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
<form>
Estado:
<select name="edo_exp" style="border:none;">
<option value="Activo">Activo</option>
<option value="Inactivo">Inactivo</option>
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
<td>
<label>Fecha de nacimiento</label>
<input type="date" name="naci_paci" class="form-control" required>
</td>
<td>
<label>Edad</label>
<input type="number" name="edad_paci" class="form-control" required>
</td>
</tr>

<tr>
<td>
<label>Lugar de nacimiento</label>
<select name="lugar_paci" class="form-control">
<?php  ?>
</select>
</td>
<td>
<label>RFC</label>
<input type="text"  name="rfc_paci" class="form-control" required>
</td>
<td>
<label>CURP</label>
<input type="text" name="curp_paci" class="form-control" required>
</td>
</tr>
<tr>
  <td colspan="3">
    <label>Titular</label>
    <input type="text" name="titular" class="form-control" required>
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
<?php  ?>
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
<tr><td colspan="3" style="text-align:center;"><label>Datos adicionales - Sección I</label></td></tr>
<tr>
<td>
<label>Escolaridad</label>
<input type="text"  name="esco" class="form-control" >
</td>
<td>
<label>Ocupación</label>
<input type="text"  name="ocupa" class="form-control" >
</td>
<td>
<label>Estado civil</label>
<select  name="edo_civ" class="form-control" >
</select>
</td>
</tr>
<tr>
<td colspan="3">
<label>Comentarios sobre escolaridad u ocupación</label>
<textarea class="form-control" name="comenta"></textarea>
</td>
</tr>
<tr>
<td>
<label>Religión</label>
<select  name="reli" class="form-control" >
</select>
</td>
<td>
<label>¿Cómo conocio el servicio?</label>
<select  name="conocio" class="form-control" >
</select>
</td>
<td>
<label>E-mail</label>
<input type="email"  name="correo" class="form-control" >
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
<input type="number"  name="edad_pad" class="form-control" >
</td>
<td>
<label>Teléfono</label>
<input type="numbre"  name="tel_pad" class="form-control" >
</td>
</tr>
<tr><td colspan="2" style="text-align:center;"><label>Datos de la madre</label></td></tr>
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
<input type="number"  name="edad_mad" class="form-control" >
</td>
<td>
<label>Teléfono</label>
<input type="numbre"  name="tel_mad" class="form-control" >
</td>
</tr>
<tr><td colspan="2" style="text-align:center;"><label>Datos del conyuge</label></td></tr>
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
<input type="number"  name="edad_cony" class="form-control" >
</td>
<td>
<label>Teléfono</label>
<input type="numbre"  name="tel_cony" class="form-control" >
</td>
</tr>
</table>
<table class="table" style="width:100%;">
<tr><td colspan="1" style="text-align:center;"><label>Detalles de hijos</label></td></tr>
<tr>
<td>
<label>Hijos</label>
<textarea   name="det_hijo" class="form-control" ></textarea>
</td>
</tr>
<tr>
<td>
<label>Hijas</label>
<textarea   name="det_hija" class="form-control" ></textarea>
</td>
</tr>
<tr><td colspan="1" style="text-align:center;"><label>Alergias y tipo de sangre</label></td></tr>
<tr>
<td>
<label>Alergias</label>
<textarea   name="alergia" class="form-control" ></textarea>
</td>
</tr>
<tr>
<td>
<label>Tipo de sangre</label>
<input type="text"  name="sangre" class="form-control" >
</td>
</tr>
</table>
<table class="table" style="width:100%;">
<tr><td colspan="2" style="text-align:center;"><label>Contacto en caso de urgencia</label></td></tr>
<tr>
<td colspan="2">
<label>Nombre</label>
<input type="text"  name="nom_cont" class="form-control" >
</td>
</tr>
<tr>
<td colspan="2">
<label>Dirección</label>
<textarea name="dir_cont" class="form-control" ></textarea>
</td>
</tr>
<tr>
<td>
<label>Parentesco</label>
<input type="text"  name="par_cont" class="form-control" >
</td>
<td>
<label>Teléfono</label>
<input type="text"  name="tel_cont" class="form-control" >
</td>
</tr>
<tr>
<td colspan="2">
<label>Comentarios</label>
<textarea name="com_cont" class="form-control" ></textarea>
</td>
</tr>
</table>
<table class="table" style="width:100%;">
<tr><td colspan="2" style="text-align:center;"><label>Datos adicionales del paciente</label></td></tr>
<tr>
<td>
<label>Id Pase</label>
<input type="text"  name="pase_id" class="form-control" >
</td>
<td>
<label>Total de pases</label>
<input type="text"  name="pase_tot" class="form-control" >
</td>
</tr>
</table>
<table class="table" style="width:100%;">
<tr>
<td>
<label>Part. A</label>
<input type="text"  name="part_a" class="form-control" >
</td>
<td>
<label>Part. B</label>
<input type="text"  name="part_b" class="form-control" >
</td>
<td>
<label>Part. C</label>
<input type="text"  name="part_c" class="form-control" >
</td>
<td>
<label>Altec</label>
<input type="text"  name="altec" class="form-control" >
</td>
<td>
<label>Altes</label>
<input type="text"  name="altes" class="form-control" >
</td>
</tr>
<tr>
<td>
<label>Axa. Santander</label>
<input type="text"  name="axa_sant" class="form-control" >
</td>
<td>
<label>Axa. Conducef</label>
<input type="text"  name="axa_condu" class="form-control" >
</td>
<td>
<label>Banorte</label>
<input type="text"  name="banor" class="form-control" >
</td>
<td>
<label>Bansefi</label>
<input type="text"  name="bance" class="form-control" >
</td>
<td>
<label>BNCI</label>
<input type="text"  name="bnci" class="form-control" >
</td>
</tr>
<tr>
<td>
<label>Emp</label>
<input type="text"  name="emp" class="form-control" >
</td>
<td>
<label>Gpo. Méd</label>
<input type="text"  name="gpo_med" class="form-control" >
</td>
<td>
<label>Gpo. Méd Doctor</label>
<input type="text"  name="gpo_med_doc" class="form-control" >
</td>
<td>
<label>Gpo. Méd Procesa</label>
<input type="text"  name="gpo_med_pro" class="form-control" >
</td>
<td>
<label>Gpo Med Almacen</label>
<input type="text"  name="gpo_med_alm" class="form-control" >
</td>
</tr>
<tr>
<td>
<label>Insen</label>
<input type="text"  name="inse" class="form-control" >
</td>
<td>
<label>S Inves Cob</label>
<input type="text"  name="s_inves_cob" class="form-control" >
</td>
<td>
<label>S Inves No Cob</label>
<input type="text"  name="s_inves_no_cob" class="form-control" >
</td>
<td>
<label>Serfin</label>
<input type="text"  name="serfin" class="form-control" >
</td>
<td>
<label>Tepeyac</label>
<input type="text"  name="tepe" class="form-control" >
</td>
</tr>
<tr>
<td>
<label>Vitamédica<BR>AFO</label>
<input type="text"  name="vita_afo" class="form-control" >
</td>
<td>
<label>Vitamédica Bancomer Operadora</label>
<input type="text"  name="vita_bancom_ope" class="form-control" >
</td>
<td>
<label>Vitamédica Banamex</label>
<input type="text"  name="vita_banam" class="form-control" >
</td>
<td>
<label>Vitamédica Bancomer SA</label>
<input type="text"  name="vita_bancom_san" class="form-control" >
</td>
<td>
<label>Vitamédica Membresía</label>
<input type="text"  name="vita_memb" class="form-control" >
</td>
</tr>
<tr>
<td>
<label>Zurich</label>
<input type="text"  name="zurich" class="form-control" >
</td>
<td>
<label>DATO A1</label>
<input type="text"  name="d_a1" class="form-control" >
</td>
<td>
<label>DATO B2</label>
<input type="text"  name="d_b2" class="form-control" >
</td>
<td>
<label>DATO C3</label>
<input type="text"  name="d_c3" class="form-control" >
</td>
<td>
<label>DATO D4</label>
<input type="text"  name="d_d4" class="form-control" >
</td>
</tr>
<tr>
<td>
<label>DATO E5</label>
<input type="text"  name="d_e5" class="form-control" >
</td>
<td>
<label>DATO F6</label>
<input type="text"  name="d_f6" class="form-control" >
</td>
<td>
<label>DATO G7</label>
<input type="text"  name="d_g7" class="form-control" >
</td>
<td>
<label>DATO H8</label>
<input type="text"  name="d_h8" class="form-control" >
</td>
<td>
<label>DATO I9</label>
<input type="text"  name="d_i9" class="form-control" >
</td>
</tr>
<tr>
<td>
<label>DATO J10</label>
<input type="text"  name="d_j10" class="form-control" >
</td>
<td>
<label>DATO K11</label>
<input type="text"  name="d_k11" class="form-control" >
</td>
<td>
<label>DATO L12</label>
<input type="text"  name="d_l12" class="form-control" >
</td>
<td>
<label>DATO M13</label>
<input type="text"  name="d_m13" class="form-control" >
</td>
<td>
<label>DATO N14</label>
<input type="text"  name="d_n14" class="form-control" >
</td>
</tr>
<tr>
<td>
<label>DATO O15</label>
<input type="text"  name="d_o15" class="form-control" >
</td>
<td>
<label>DATO P16</label>
<input type="text"  name="d_p16" class="form-control" >
</td>
<td>
<label>DATO Q17</label>
<input type="text"  name="d_q17" class="form-control" >
</td>
<td>
<label>DATO R18</label>
<input type="text"  name="d_r18" class="form-control" >
</td>
<td>
<label>DATO S19</label>
<input type="text"  name="d_s19" class="form-control" >
</td>
</tr>
<tr>
<td>
<label>DATO T20</label>
<input type="text"  name="d_t20" class="form-control" >
</td>
<td>
<label>DATO U21</label>
<input type="text"  name="d_u21" class="form-control" >
</td>
<td>
<label>DATO V22</label>
<input type="text"  name="d_v22" class="form-control" >
</td>
<td>
<label>DATO X23</label>
<input type="text"  name="d_x23" class="form-control" >
</td>
<td>
<label>DATO Y24</label>
<input type="text"  name="d_y24" class="form-control" >
</td>
</tr>
<tr>
<td>
<label>DATO Z25</label>
<input type="text"  name="d_z25" class="form-control" >
</td>
<td>
<label>DATO A26</label>
<input type="text"  name="d_a26" class="form-control" >
</td>
<td>
<label>DATO B27</label>
<input type="text"  name="d_b27" class="form-control" >
</td>
<td>
<label>DATO C28</label>
<input type="text"  name="d_c28" class="form-control" >
</td>
<td>
<label></label>
</td>
</tr>
</table>
<table class>

</table>
</form>
</div>
</center>
  <?php include 'footer.php'; ?>	
