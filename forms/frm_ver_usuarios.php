<!-- Modal -->
<div class="modal fade" id="modal_ver_usuarios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Usuarios registrados</h4>
        <input type="text" class="form-control" onkeyup="buscarUsuario(this.value);" placeholder="Burcar..."/>
      </div>
      <div class="modal-body" id="contenedor_ver_usuarios" style="height:400px;overflow: scroll; overflow-x:hidden;">
        
      </div>
    </div>
  </div>
</div>