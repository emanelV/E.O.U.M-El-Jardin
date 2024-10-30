

<div class="modal fade" id="modaluser" name="modaluser" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="tituloModal">Nuevo Usuario</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formUser" name="formUser">
          <input type="hidden" name="idusuario" id="idusuario" value="">
          <div class="mb-3">
            <label for="control-label" class="col-form-label">Nombres:</label>
            <input type="text" class="form-control" name="NombreUser" id="NombreUser">
          </div>
          <div class="mb-3">
            <label for="control-label" class="col-form-label">Apellidos:</label>
            <input type="text" class="form-control" name="ApellidosUser" id="ApellidosUser">
          </div>
          <div class="mb-3">
            <label for="control-label" class="col-form-label">Usuario:</label>
            <input type="text" class="form-control" name="User" id="User">
          </div>
          <div class="mb-3">
            <label for="control-label" class="col-form-label">Contraseña:</label>
            <input type="password" class="form-control" name="clave" id="clave">
          </div>
          <div class="form-group">
            <label for="listRol">Rol</label>
            <select class="form-control" name="listRol" id="listRol">
                <option value ="1">Administrador</option>
                <option value ="2">Asistente</option>
            </select>
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