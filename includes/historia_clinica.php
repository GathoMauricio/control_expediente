
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
?>
<center>
<div class="info_gral">
<h4>Historia clínica.</h4>
<form class="form" id="form_historia_clinica">
<input type="hidden" name="id_paciente" value="<?php echo $data['id_paciente']; ?>">
<table class="table" style="width:100%" id="historia_clinica">
<tr><td colspan="3" style="text-align:center;"><label>Datos de historia clínica</label></td></tr>
<tr>
<td colspan="3">
<?php if ($data['sex_paci']=='M'): ?>
<label>Fecha de última menstruación: </label><input type="date" name="hc_fum" value="<?php echo $data['hc_fum']; ?>">
<?php endif ?>
</td>
</tr>
<tr>
<td>
<label>Peso</label>
<input type="number"  name="hc_peso" value="<?php echo $data['hc_peso']; ?>"  class="form-control">
</td>
<td>
<label>Talla</label>
<input type="number"  name="hc_talla" value="<?php echo $data['hc_talla']; ?>"  class="form-control">
</td>
<td>
<label>T.A.</label>
<input type="number"  name="hc_ta" value="<?php echo $data['hc_ta']; ?>"  class="form-control">
</td>
</tr>
<tr>
<td>
<label>F.C.</label>
<input type="number"  name="hc_fc" value="<?php echo $data['hc_fc']; ?>"  class="form-control">
</td>
<td>
<label>F.R.</label>
<input type="number"  name="hc_fr" value="<?php echo $data['hc_fr']; ?>"  class="form-control">
</td>
<td>
<label>Temperatura</label>
<input type="number"  name="hc_tem" value="<?php echo $data['hc_tem']; ?>"  class="form-control">
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
<input type="submit" class="btn btn-primary" value="Guardar cambios" style="width:100%;">
</form>
</div>
</center>
<script type="text/javascript">
$(document).ready(function(){
  $("#form_historia_clinica").submit(function(e){
    e.preventDefault();
    $.post('control/ctrl_expediente.php?e=actualizarPacienteHc',$("#form_historia_clinica").serialize(),function(data){
      swal('',data);
    });
  });
});
</script>