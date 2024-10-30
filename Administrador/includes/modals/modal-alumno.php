

<div class="modal fade" id="modalAlumno" name="modalAlumno" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="tituloModal">Inscripcion de Alumno</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formAlumno" name="formAlumno">
          <input type="hidden" name="idAlumno" id="idAlumno" value="">
          <input type="hidden" name="idEncargado" id="idEncargado" value="">
          <div class="mb-3">
            <h5>Alumno</h5>
            <label for="control-label" class="col-form-label">Codigo Personal:</label>
            <input type="text" class="form-control" name="codAlumno" id="codAlumno">
          </div>
          <div class="mb-3">
            <label for="control-label" class="col-form-label">Nombres:</label>
            <input type="text" class="form-control" name="nombreAlumno" id="nombreAlumno">
          </div>
          <div class="mb-3">
            <label for="control-label" class="col-form-label">Apellidos:</label>
            <input type="text" class="form-control" name="apellidosAlumno" id="apellidosAlumno">
          </div>
          <div class="mb-3">
            <label for="control-label" class="col-form-label">Direccion:</label>
            <input type="text" class="form-control" name="direccionAlumno" id="direccionAlumno">
          </div>
          <div class="mb-3">
            <label for="control-label" class="col-form-label">CUI:</label>
            <input type="text" class="form-control" name="dpiAlumno" id="dpiAlumno">
          </div>
          <div class="mb-3">
            <label for="control-label" class="col-form-label">Fecha de Nacimiento:</label>
            <input type="date" class="form-control" name="fechaNacAlumno" id="fechaNacAlumno">
          </div>
          <div class="mb-3">
          <label for="listgenero">Genero</label>
            <select class="form-control" name="listgenero" id="listgenero">
                <option value ="1" selected>Masculino</option>
                <option value ="2">Femenino</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="control-label" class="col-form-label">Fecha de Inscripcion:</label>
            <input type="date" class="form-control" name="fechaRecAlumno" id="fechaRecAlumno">
          </div>
          <div class="form-group">
            <label for="listEstado">Estado</label>
            <select class="form-control" name="listEstado" id="listEstado">
                <option value ="1">Activo</option>
                <option value ="2">Inactivo</option>
            </select>
          </div>
          <div class="mb-3">
            <br>
            <h5>Encargado</h5>
            <label for="control-label" class="col-form-label">Nombres:</label>
            <input type="text" class="form-control" name="nombreEncargado" id="nombreEncargado">
          </div>
          <div class="mb-3">
            <label for="control-label" class="col-form-label">Apellidos:</label>
            <input type="text" class="form-control" name="apellidosEncargado" id="apellidosEncargado">
          </div>
          <div class="mb-3">
            <label for="control-label" class="col-form-label">Telefono:</label>
            <input type="text" class="form-control" name="telefonoEncargado" id="telefonoEncargado">
          </div>
          <div class="mb-3">
            <label for="control-label" class="col-form-label">Dpi:</label>
            <input type="text" class="form-control" name="dpiEncargado" id="dpiEncargado">
          </div>
          <div class="mb-3">
            <label for="control-label" class="col-form-label">Clave:</label>
            <input type="password" class="form-control" name="claveEnc" id="claveEnc">
          </div>
          <div class="mb-3">
            <label for="control-label" class="col-form-label">Parentesco:</label>
            <input type="text" class="form-control" name="parentesco" id="parentesco">
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