<!-- Modal -->
<div class="modal fade" id="modal_nuevo_usuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Nuevo usuario</h4>
      </div>
      <div class="modal-body">
        <form method="POST" id="frm_nuevo_usuario" class="form" >
          <label>Tipo de usuario</label>
          <select class="form-control" name="tipo_usu">
            <option value="Asistente">Asistente</option>
            <option value="Doctor">Doctor</option>
          </select>
          <label>Nombre de usuario</label>
          <input type="text" name="nom_usu" class="form-control" required>
          <table style="width:100%;">
            <tr>
              <td>
                <label>Contraseña de usuario</label>
                <input type="password" name="con_usu" id="txt_contrasena_usuario_nuevo" class="form-control" required>
              </td>
              <td>
                <label>Repetir contraseña de usuario</label>
                <input type="password" name="recon_usu" id="txt_recontrasena_usuario_nuevo" class="form-control" required>
              </td>
            </tr>
          </table>
          <label>Curp</label>
          <input type="text" name="curp" class="form-control">
          <table style="width:100%">
            <tr>
              <td>
                <label>Nombre(s)</label>
                <input type="text" name="nombre_usu" class="form-control" required>
              </td>
              <td>
                <label>A. Paterno</label>
                <input type="text" name="ape_pat" class="form-control" required>
              </td>
              <td>
                <label>A. Materno</label>
                <input type="text" name="ape_mat" class="form-control" required>
              </td>
            </tr>
          </table>
		      <table style="width:100%">
            <tr>
              <td>
                <label>Profesión</label>
                <input type="text" name="prof" class="form-control" >
              </td>
              <td>
                <label>Sexo</label>
                <select class="form-control" name="sex">
                  <option value="M">Marculino</option>
                  <option value="F">Femenino</option>
                </select>
              </td>
              <td>
                <label>Cédula profecional</label>
                <input type="text" name="cedula_p" class="form-control" >
              </td>
            </tr>
          </table>
          <table style="width:100%">
            <tr>
              <td>
                <label>Matrícula</label>
                <input type="text" name="matricula" class="form-control" >
              </td>
              <td>
                <label>Fecha de nacimiento</label>
                <input type="date" name="fecha_naci" class="form-control">
              </td>
              <td>
                <label>Cédula especialista</label>
                <input type="text" name="cedula_esp" class="form-control" >
              </td>
            </tr>
          </table>
        <br>
		    <input type="submit" class="btn btn-primary" style="width:100%">
		</form>
      </div>
    </div>
  </div>
</div>