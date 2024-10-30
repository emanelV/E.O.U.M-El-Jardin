
<div class="modal fade" id="modalNota" name="modalNota" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="tituloModal">Cargar Nota</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formNota" name="formNota">
          <input type="hidden" name="ideventregada" id="ideventregada" value="<?= $ev_entregada; ?>">
          <div class="mb-3">
            <label for="control-label" class="col-form-label">Nota</label>
            <input type="number" class="form-control" name="nota" id="nota">
          </div>

          <div class="mb-3">
            <label for="control-label" class="col-form-label">Nota.</label>
            <p>Al ingresar una nota, no podra ser editada</p>
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