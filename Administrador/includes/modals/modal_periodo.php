<div class="modal fade" id="modalPeriodo" name="modalPeriodo" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="tituloModal">Nueva Materia</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formPeriodo" name="formPeriodo">
          <input type="hidden" name="idPeriodo" id="idPeriodo" value="">
          <div class="mb-3">
            <label for="control-label" class="col-form-label">Nombre del Periodo:</label>
            <input type="text" class="form-control" name="nombrePeriodo" id="nombrePeriodo">
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