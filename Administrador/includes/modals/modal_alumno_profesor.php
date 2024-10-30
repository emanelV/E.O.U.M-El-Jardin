

<div class="modal fade" id="modalAlumnoProfesor" name="modalAlumnoProfesor" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="tituloModal">Nueva Asignacion</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formAlumnoProfesor" name="formAlumnoProfesor">
            <input type="hidden" id="idAlumnoProfesor" name="idAlumnoProfesor" value="">
            <div class="form-group">
                <label for="listProfesor">Selecione el alumno</label>
                <select class="form-control" name="listAlumno" id="listAlumno">
                    <!-- solicutd ajax -->
                </select>
            </div>
            <div class="form-group">
                <label for="listGrado">Selecione el profesor</label>
                <select class="form-control" name="listProfesorAlu" id="listProfesorAlu">
                    <!-- solicutd ajax -->
                </select>
            </div>
            <div class="form-group">
                <label for="listAula">Selecione el Periodo</label>
                <select class="form-control" name="listPeriodoAlu" id="listPeriodoAlu">
                    <!-- solicutd ajax -->
                </select>
            </div>
                <div class="form-group">
                    <label for="listEstado">Estado</label>;
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