

<div class="modal fade" id="modalProfesorMateria" name="modalProfesorMateria" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="tituloModal">Nueva Asignacion</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formProfesorMaterias" name="formProfesorMaterias">
            <input type="hidden" id="idProfesorMateria" name="idProfesorMateria" value="">
            <div class="form-group">
                <label for="listProfesor">Selecione el Profesor</label>
                <select class="form-control" name="listProfesor" id="listProfesor">
                    <!-- solicutd ajax -->
                </select>
            </div>
            <div class="form-group">
                <label for="listGrado">Selecione el Grado</label>
                <select class="form-control" name="listGrado" id="listGrado">
                    <!-- solicutd ajax -->
                </select>
            </div>
            <div class="form-group">
                <label for="listAula">Selecione la seccion</label>
                <select class="form-control" name="listAula" id="listAula">
                    <!-- solicutd ajax -->
                </select>
            </div>
            <div class="form-group">
                <label for="listMateria">Selecione la Materia</label>
                <select class="form-control" name="listMateria" id="listMateria">
                    <!-- solicutd ajax -->
                </select>
            </div>
            <div class="form-group">
                <label for="listPeriodo">Selecione el Periodo</label>
                <select class="form-control" name="listPeriodo" id="listPeriodo">
                    <!-- solicutd ajax -->
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