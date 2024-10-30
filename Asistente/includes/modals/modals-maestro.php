

<div class="modal fade" id="modalProfesor" name="modalProfesor" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="tituloModal">Nuevo Maestro</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formProfesor" name="formProfesor">
          <input type="hidden" name="idProfesor" id="idProfesor" value="">
          <div class="mb-3">
            <label for="control-label" class="col-form-label">Nombres:</label>
            <input type="text" class="form-control" name="nombreProfesor" id="nombreProfesor">
          </div>
          <div class="mb-3">
            <label for="control-label" class="col-form-label">Apellidos:</label>
            <input type="text" class="form-control" name="apellidosProfesor" id="apellidosProfesor">
          </div>
          <div class="mb-3">
            <label for="control-label" class="col-form-label">Direccion:</label>
            <input type="text" class="form-control" name="direccionProfesor" id="direccionProfesor">
          </div>
          <div class="mb-3">
            <label for="control-label" class="col-form-label">DPI:</label>
            <input type="text" class="form-control" name="dpiProfesor" id="dpiProfesor">
          </div>
          <div class="mb-3">
            <label for="control-label" class="col-form-label">Contraseña:</label>
            <input type="Password" class="form-control" name="passProfesor" id="passProfesor">
          </div>
          <div class="mb-3">
            <label for="control-label" class="col-form-label">Telefono:</label>
            <input type="text" class="form-control" name="telefonoProfesor" id="telefonoProfesor">
          </div>
          <div class="mb-3">
            <label for="control-label" class="col-form-label">Correo Electronico:</label>
            <input type="email" class="form-control" name="correoProfesor" id="correoProfesor">
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