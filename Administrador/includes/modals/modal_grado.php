
<div class="modal fade" id="modalGrado" name="modalGrado" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="tituloModal">Nuevo Grado</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formGrado" name="formGrado">
          <input type="hidden" name="idGrado" id="idGrado" value="">
          <div class="mb-3">
            <label for="control-label" class="col-form-label">Nombre del grado:</label>
            <input type="text" class="form-control" name="nombreGrado" id="nombreGrado">
          </div>
          <div class="form-group">
            <label for="listEstado">Estado</label>
            <select class="form-control" name="listEstado" id="listEstado">
                <option value ="1">Activo</option>
                <option value ="2">Inactivo</option>
            </select>
          </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type = "submit" id="action" class="btn btn-primary">Guardar</button>
            </div>
            </form>
        </div>
    </div>
  </div>
</div>