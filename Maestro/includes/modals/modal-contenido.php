
<div class="modal fade" id="modalContenido" name="modalContenido" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="tituloModal">Nueva Contenido</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formContenido" name="formContenido" enctype="multipart/form-data">
          <input type="hidden" name="idContenido" id="idContenido" value="">
          <input type="hidden" name="idCurso" id="idCurso" value="<?= $curso; ?>">
          <div class="mb-3">
            <label for="control-label" class="col-form-label">Titulo del Contenido</label>
            <input type="text" class="form-control" name="titulo" id="titulo">
          </div>
          <div class="mb-3">
            <label for="control-label" class="col-form-label">Descripcion del Contenido</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="4"></textarea>
          </div>

          <div class="mb-3">
            <label for="control-label" class="col-form-label">Agregar Material</label>
            <input type="file" class="form-control" name="file" id="file">
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