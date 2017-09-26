<!-- Modal -->
<div class="modal fade" id="modal_subir_archivo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Subir archivo</h4>
      </div>
      <div class="modal-body">
        <form class="form" id="form_subir_archivos" action="control/ctrl_archivo.php?e=subirArchivo" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="id_paciente" id="txt_id_paciente_subir_archivo" />
          <label>Nombre del archivo</label>
          <input type="text" class="form-control" name="nom_arc" required>
          <label>Tipo de archivo</label>
          <input type="text" class="form-control" name="tipo_arc" required>
          <label>Archivo</label>
          <input type="file" class="form-control" name="archivo" required>
          <br><br>
          <input type="submit" class="btn btn-primary" style="width:100%;">
        </form>
      </div>
    </div>
  </div>
</div>