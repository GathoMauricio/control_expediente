<?php date_default_timezone_set('America/Mexico_City'); ?>
<script type="text/javascript">
$(function(){

	$("#form_nuevo_paciente").submit(function(e){
    e.preventDefault();
    $.post('control/ctrl_expediente.php?e=nuevoExpediente',$("#form_nuevo_paciente").serialize(),function(data){
      var json = JSON.parse(data);
      if(json.error>0)
      {
      	swal('Aviso',);
      	console.log(json.msg);
      }else{
      	swal({
      	  html:true,	
		  title: "Aviso",
		  text: json.msg,
		  showCancelButton: true,
		  confirmButtonClass: "btn-primary",
		  confirmButtonText: "Enviar",
		  cancelButtonText:"Cancelar",
		  closeOnConfirm: true
		},
		function(){
		  agregarBuzon(json.insert_id);
		});
      }
      abrirExpediente(json.insert_id);
      window.open("control/conexion.php?e=exportarBD");
      window.open("control/lista_excel.php");
      //$("#form_nuevo_paciente")[0].reset();
      });
  	});
});
</script>
<h4 id="up">NUEVO EXPEDIENTE.</h4>
<form class="form" id="form_nuevo_paciente">
<input type="hidden" name="edo_exp" value="Activo">
<label>Fecha de registro</label><br>
<input type="date" class="form-control" name="fecha_reg" style="width:30%;" value="<?php echo date('Y-m-d'); ?>" >
<br><br>
<table class="table" style="width:100%">
  <tr><td colspan="3" style="text-align:center;"><label>Información general</label></td></tr>
<tr>
<td>
<label>Nombre(s)</label>
<input type="text" name="nombre_paci" id="txt_nombre_paci"  class="form-control" style="border:solid 3px green" required>
</td>
<td>
<label>A. paterno</label>
<input type="text" name="paterno_paci" id="txt_paterno_paci" class="form-control"style="border:solid 3px green"  required>
</td>
<td>
<label>A. materno</label>
<input type="text" name="materno_paci" id="txt_materno_paci" class="form-control"style="border:solid 3px green"  required>
</td>
</tr>

<tr>
<td>
<label>Sexo</label>
<select  name="sex_paci" class="form-control">
<option value="H">Hombre</option><option value="M">Mujer</option>
</select>
</td>
<td >
<label>Fecha de nacimiento</label>
<input type="date" name="naci_paci" id="cbo_fecha_nacimiento" style="border:solid 3px green" onchange="calcularEdad(this.value);"  class="form-control" required>
</td>
<td >
<label>Edad</label>
<input type="number" name="edad_paci" id="txt_edad_generar" class="form-control">
</td>
</tr>
<tr><td colspan="3">Si el campo edad se encuentra vacio, el sistema calculará la edad automáticamente...</td></tr>
<tr>
<td>
<label>Lugar de nacimiento</label>
<select name="lugar_paci" class="form-control" >
<?php include 'options_estados_republica.php'; ?>
</select>
</td>
<td>
<label>RFC</label>
<input type="text"  name="rfc_paci" id="txt_rfc_paci" class="form-control">
</td>
<td>
<label>CURP</label>
<input type="text" name="curp_paci"  id="txt_curp_paci" class="form-control">
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
<?php include 'options_estados_republica.php'; ?>
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
<select name="reli" class="form-control" id="cbo_religion_nuevo" onchange="agregarReligion(this.value);">
<?php include "options_religiones.php";  ?>
</select>
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
<select name="edo_civ" class="form-control" id="cbo_edo_civ_nuevo" onchange="agregarEdoCiv(this.value);">
<?php include "options_edo_civil.php";  ?>
</select>
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

<tr>
<td>
<label>ID pase</label>
<input type="text"  name="pase_id" class="form-control" placeholder="Si el pase esta vacio pasa a ser VIP...">
</td>
<td>
<label>Total de Consultas Permitidas</label>
<input type="number" min="1" value="1"  name="pase_tot" class="form-control" style="border:solid 3px green" required>
</td>
</tr>
</table>
<!--
<table class="table" style="width:100%">
<tr><td colspan="3" style="text-align:center;"><label>Datos de historia clínica</label></td></tr>
<tr>
<td>
<label>Peso</label>
<input type="text"  name="hc_peso" class="form-control">
</td>
<td>
<label>Talla</label>
<input type="text"  name="hc_talla" class="form-control">
</td>
<td>
<label>T.A.</label>
<input type="text"  name="hc_ta" class="form-control">
</td>
</tr>
<tr>
<td>
<label>F.C.</label>
<input type="text"  name="hc_fc" class="form-control">
</td>
<td>
<label>F.R.</label>
<input type="text"  name="hc_fr" class="form-control">
</td>
<td>
<label>Temperatura</label>
<input type="text"  name="hc_tem" class="form-control">
</td>
</tr>
<tr>
<td colspan="3">
<label>FUM</label>
<input type="date"  name="hc_fum" class="form-control">
</td>
</tr>
</table>

<table class="table" style="width:100%">
<tr><tdstyle="text-align:center;"><label>Antecedentes</label></td></tr>
<tr>
<td>
<label>Antecedentes familiares</label>
<textarea class="form-control" name="hc_ant_fam"></textarea>
</td>
</tr>
<tr>
<td>
<label>Antecedentes personales patológicos</label>
<textarea class="form-control" name="hc_ant_per_p"></textarea>
</td>
</tr>
<tr>
<td>
<label>Antecedentes personales no patológicos</label>
<textarea class="form-control" name="hc_ant_per_no_p"></textarea>
</td>
</tr>
<tr>
<td>
<label>Padecimiento actual</label>
<textarea class="form-control" name="hc_pad"></textarea>
</td>
</tr>
<tr>
<td>
<label>Exploración física</label>
<textarea class="form-control" name="hc_exp_fis"></textarea>
</td>
</tr>
<tr>
<td>
<label>Otros datos</label>
<textarea class="form-control" name="hc_otros"></textarea>
</td>
</tr>
<tr>
<td>
<label>RX</label>
<textarea class="form-control" name="hc_rx"></textarea>
</td>
</tr>
<tr>
<td>
<label>Diagnóstico</label>
<textarea class="form-control" name="hc_dx"></textarea>
</td>
</tr>
<tr>
<td>
<label>Tratamiento</label>
<textarea class="form-control" name="hc_tx"></textarea>
</td>
</tr>
</table>

-->

<table class="table" style="width:100%;">
<tr><td colspan="4" style="text-align:center;"><label>Datos adicionales</label></td></tr>
<tr>
<td>
<label>Part. A</label>
<input type="text" class="form-control" name="part_a"/>
</td>
<td>
<label>Part. B</label>
<input type="text" class="form-control" name="part_b"/>
</td>
<td>
<label>Part. C</label>
<input type="text" class="form-control" name="part_c"/>
</td>
<td>
<label>Altec</label>
<input type="text" class="form-control" name="altec"/>
</td>
</tr>
<tr>
<td>
<label>Altes</label>
<input type="text" class="form-control" name="altes"/>
</td>
<td>
<label>Axa. Santander</label>
<input type="text" class="form-control" name="axa_sant"/>
</td>
<td>
<label>Axa. Conducef</label>
<input type="text" class="form-control" name="axa_condu"/>
</td>
<td>
<label>Banorte</label>
<input type="text" class="form-control" name="banor"/>
</td>
</tr>
<tr>
<td>
<label>Bansefi</label>
<input type="text" class="form-control" name="banse"/>
</td>
<td>
<label>BNCI</label>
<input type="text" class="form-control" name="bnci"/>
</td>
<td>
<label>Emp</label>
<input type="text" class="form-control" name="emp"/>
</td>
<td>
<label>Gpo. Méd</label>
<input type="text" class="form-control" name="gpo_med"/>
</td>
</tr>
<tr>
<td>
<label>Gpo. Méd doctor</label>
<input type="text" class="form-control" name="gpo_med_doc"/>
</td>
<td>
<label>Gpo. Méd. procesa</label>
<input type="text" class="form-control" name="gpo_med_pro"/>
</td>
<td>
<label>Gpo. Méd almacen</label>
<input type="text" class="form-control" name="gpo_med_alm"/>
</td>
<td>
<label>Insen</label>
<input type="text" class="form-control" name="inse"/>
</td>
</tr>
<tr>
<td>
<label>S inves cob</label>
<input type="text" class="form-control" name="s_inves_cob"/>
</td>
<td>
<label>S inves no cob</label>
<input type="text" class="form-control" name="s_inves_no_cob"/>
</td>
<td>
<label>Serfin</label>
<input type="text" class="form-control" name="serfin"/>
</td>
<td>
<label>Tepeyac</label>
<input type="text" class="form-control" name="tepe"/>
</td>
</tr>
<tr>
<td>
<label>Vitamédica AFO</label>
<input type="text" class="form-control" name="vita_afo"/>
</td>
<td>
<label>Vitamédica Bancomer operadora</label>
<input type="text" class="form-control" name="vita_bancom_ope"/>
</td>
<td>
<label>Vitamédica Banamex</label>
<input type="text" class="form-control" name="vita_banam"/>
</td>
<td>
<label>Vitamédica Bancomer SAN</label>
<input type="text" class="form-control" name="vita_bancom_san"/>
</td>
</tr>
<tr>
<td>
<label>Vitamédica Membresía</label>
<input type="text" class="form-control" name="vita_memb"/>
</td>
<td>
<label>Zurich</label>
<input type="text" class="form-control" name="zurich"/>
</td>
<td>

</td>
<td>

</td>
</tr>
<tr>
<td>
<label>Dato A1</label>
<input type="text" class="form-control" name="d_a1"/>
</td>
<td>
<label>Dato B2</label>
<input type="text" class="form-control" name="d_b2"/>
</td>
<td>
<label>Dato C3</label>
<input type="text" class="form-control" name="d_c3"/>
</td>
<td>
<label>Dato D4</label>
<input type="text" class="form-control" name="d_d4"/>
</td>
</tr>
<tr>
<td>
<label>Dato E5</label>
<input type="text" class="form-control" name="d_e5"/>
</td>
<td>
<label>Dato F6</label>
<input type="text" class="form-control" name="d_f6"/>
</td>
<td>
<label>Dato G7</label>
<input type="text" class="form-control" name="d_g7"/>
</td>
<td>
<label>Dato H8</label>
<input type="text" class="form-control" name="d_h8"/>
</td>
</tr>

<tr>
<td>
<label>Dato I9</label>
<input type="text" class="form-control" name="d_i9"/>
</td>
<td>
<label>Dato J10</label>
<input type="text" class="form-control" name="d_j10"/>
</td>
<td>
<label>Dato K11</label>
<input type="text" class="form-control" name="d_k11"/>
</td>
<td>
<label>Dato L12</label>
<input type="text" class="form-control" name="d_l12"/>
</td>
</tr>
<tr>
<td>
<label>Dato M13</label>
<input type="text" class="form-control" name="d_m13"/>
</td>
<td>
<label>Dato N14</label>
<input type="text" class="form-control" name="d_n14"/>
</td>
<td>
<label>Dato O15</label>
<input type="text" class="form-control" name="d_o15"/>
</td>
<td>
<label>Dato P16</label>
<input type="text" class="form-control" name="d_p16"/>
</td>
</tr>
<tr>
<td>
<label>Dato Q17</label>
<input type="text" class="form-control" name="d_q17"/>
</td>
<td>
<label>Dato R18</label>
<input type="text" class="form-control" name="d_r18"/>
</td>
<td>
<label>Dato S19</label>
<input type="text" class="form-control" name="d_s19"/>
</td>
<td>
<label>Dato T20</label>
<input type="text" class="form-control" name="d_t20"/>
</td>
</tr>
<tr>
<td>
<label>Dato U21</label>
<input type="text" class="form-control" name="d_u21"/>
</td>
<td>
<label>Dato V22</label>
<input type="text" class="form-control" name="d_v22"/>
</td>
<td>
<label>Dato X23</label>
<input type="text" class="form-control" name="d_x23"/>
</td>
<td>
<label>Dato Y24</label>
<input type="text" class="form-control" name="d_y24"/>
</td>
</tr>
<tr>
<td>
<label>Dato Z25</label>
<input type="text" class="form-control" name="d_z25"/>
</td>
<td>
<label>Dato A26</label>
<input type="text" class="form-control" name="d_a26"/>
</td>
<td>
<label>Dato B27</label>
<input type="text" class="form-control" name="d_b27"/>
</td>
<td>
<label>Dato C28</label>
<input type="text" class="form-control" name="d_c28"/>
</td>
</tr>

</table>

<input type="submit" class="btn btn-primary" value="Guardar expediente" style="width:100%;">
</form>

