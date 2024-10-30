
<div class="modal fade" id="modalEvaluacion" name="modalEvaluacion" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="tituloModal">Nueva Actividad</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formEvaluacion" name="formEvaluacion">
          <input type="hidden" name="idevaluacion" id="idevaluacion" value="">
          <input type="hidden" name="idcontenido" id="idcontenido" value="<?= $contenido; ?>">
          <div class="mb-3">
            <label for="control-label" class="col-form-label">Nombre de la Activiad</label>
            <input type="text" class="form-control" name="titulo" id="titulo">
          </div>
          <div class="mb-3">
            <label for="control-label" class="col-form-label">Descripcion de la Actividad</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="4"></textarea>
          </div>

          <div class="mb-3">
            <label for="control-label" class="col-form-label">Fecha limite de Entrega</label>
            <input type="date" class="form-control" name="fecha" id="fecha">
          </div>
          <div class="mb-3">
            <label for="control-label" class="col-form-label">Punteo</label>
            <input type="text" class="form-control" name="valor" id="valor">
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