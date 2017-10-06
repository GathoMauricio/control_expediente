<!-- Modal -->
<div class="modal fade" id="modal_importar_bd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Seleccione el archivo(.sql) para importar.</h4>
      </div>
      <div class="modal-body">
        <form class="form" method="POST" id="form_importar_bd">
          <input type="file" class="form-control" name="archivo" id="input_importar" required><br>
          <input type="submit" class="btn btn-primary" style="width:100%;">
        </form>
      </div>
    </div>
  </div>
</div>