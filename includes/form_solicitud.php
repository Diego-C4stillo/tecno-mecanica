<?php
require "../includes/_sesion/validar.php";
if ($rolSesion != "Estudiante" && $rolSesion != "Docente") {
  header("Location: 404.php");
  exit;
}
include "../includes/header.php";
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <form action="functions.php" method="POST" class="needs-validation" novalidate>
        <input type="hidden" name="accion" value="insert_solicitud">
        <div class="card shadow mb-4">
          <div class="card-header py-1">
            <div class="row mt-2 mb-2 mr-1 ml-1" style="display: flex; align-items: center;">
              <h5 class="m-0 font-weight-bold text-primary">Solicitud para talleres y laboratorios</h5>
              <div style="margin-left: auto;">
                <img src="../assets/img/newlogotecno.png" alt="logo_tecnoecuatoriano" width="220" height="50">
              </div>
            </div>
          </div>
          <div class="card-body">
            <input type="hidden" name="txtIdUsuario" value="<?php echo htmlentities($idUsuarioSesion); ?>">
            <div class="table-responsive">
              <table class="table table-bordered" width="100%" cellspacing="0">
                <tbody>
                  <tr>
                    <th>Nivel</th>
                    <th>Jornada</th>
                    <th>Carrera</th>
                    <th>Asignatura</th>
                    <th>Sede</th>
                    <th>Fecha y horario de práctica</th>
                    <th>Docente a cargo</th>
                  </tr>
                  <tr>
                    <td>
                      <select name="txtNivel" id="txtNivel" class="form-control">
                        <option value="">-- Seleccionar nivel --</option>
                        <option value="1">Primero</option>
                        <option value="2">Segundo</option>
                        <option value="3">Tercero</option>
                        <option value="4">Cuarto</option>
                      </select>
                      <div class="invalid-feedback">
                        Ingresa un nivel.
                      </div>
                    </td>
                    <td>
                      <select name="txtJornada" id="txtJornada" class="form-control">
                        <option value="">-- Seleccionar jornada --</option>
                        <option value="Matutina">Matutina</option>
                        <option value="Nocturna">Nocturna</option>
                        <option value="Intensiva">Intensiva</option>
                      </select>
                      <div class="invalid-feedback">
                        Ingresa una jornada.
                      </div>
                    </td>
                    <td>
                      <select name="txtCarrera" id="txtCarrera" class="form-control">
                        <option value="">-- Seleccionar carrera --</option>
                        <?php

                        include "../includes/db.php";
                        $sql = "SELECT * FROM carreras ORDER BY NombreCarrera";
                        $resultado = mysqli_query($conexion, $sql);
                        while ($consulta = mysqli_fetch_array($resultado)) {
                          echo '<option value="' . $consulta['IdCarrera'] . '">' . $consulta['NombreCarrera'] . '</option>';
                        }
                        mysqli_close($conexion);

                        ?>
                      </select>
                      <div class="invalid-feedback">
                        Ingresa una carrera.
                      </div>
                    </td>
                    <td>
                      <input type="text" name="txtAsignatura" id="txtAsignatura" placeholder="Ingrese el nombre de tu asignatura" class="form-control">
                      <div class="invalid-feedback">
                        Ingresa solo letras y signos de puntuación.
                      </div>
                    </td>
                    <td>
                      <select name="txtSede" id="txtSede" class="form-control">
                        <option value="">-- Seleccionar sede --</option>
                        <option value="Calderón">Calderón</option>
                        <option value="Eloy Alfaro">Eloy Alfaro</option>
                        <option value="Magdalena">Magdalena</option>
                      </select>
                      <div class="invalid-feedback">
                        Ingresa una sede.
                      </div>
                    </td>
                    <td>
                      <input type="text" name="txtFecha" id="datetimepicker" class="form-control">
                      <div class="invalid-feedback">
                        Ingresa una fecha y hora.
                      </div>
                    </td>
                    <td>
                      <div class="docente">
                        <ul name="txtDocente" id="docenteSolicitud"></ul>
                        <div class="invalid-feedback">
                          Selecciona un docente.
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <th colspan="3">Actividades</th>
                    <th colspan="3">Herramientas y equipos</th>
                    <th colspan="2">Materiales</th>
                  </tr>
                  <tr>
                    <th colspan="3">
                      <input type="text" name="txtActividades" id="txtActividades" placeholder="Actividades a realizar" class="form-control">
                      <div class="invalid-feedback">
                        Ingresa solo letras y signos de puntuación.
                      </div>
                    </th>
                    <th colspan="3">
                      <input type="text" name="txtImplementos" id="txtImplementos" placeholder="Herramientas y equipos a utilizar" class="form-control">
                      <div class="invalid-feedback">
                        Ingresa solo letras y signos de puntuación.
                      </div>
                    </th>
                    <th colspan="2">
                      <input type="text" name="txtMateriales" id="txtMateriales" placeholder="Materiales a utilizar" class="form-control">
                      <div class="invalid-feedback">
                        Ingresa solo letras y signos de puntuación.
                      </div>
                    </th>
                  </tr>
                  <tr>
                    <th class="text-center" colspan="12">Manuales</th>
                  </tr>
                  <tr>
                    <th colspan="12">
                      <div class="row">
                        <div class="col">
                          <a id="enlaceManual" class="btn btn-primary btn-block" href="#">Revisar manual</a>
                        </div>
                        <div class="col">
                          <a id="enlaceInventario" class="btn btn-success btn-block" href="#">Revisar inventario</a>
                        </div>
                      </div>
                    </th>
                  </tr>
                  <tr>
                    <th colspan="1">Área</th>
                    <td colspan="7">
                      <select name="txtArea" id="txtArea" class="form-control">
                        <option value="">-- Seleccionar un área- -</option>
                        <option value="Taller de mecánica">Taller de mecánica</option>
                        <option value="Laboratorio de electrónica">Laboratorio de electrónica</option>
                        <option value="Laboratorio de computación">Laboratorio de computación</option>
                      </select>
                      <div class="invalid-feedback">
                        Ingresa un área.
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <th class="text-center" colspan="12">Lista de estudiantes</th>
                  </tr>
                  <tr>
                    <td colspan="8">
                      <div class="lista-estudiante" style="overflow-x: auto; white-space: nowrap;">
                        <ul id="listaEstudiantesAgregados" class="text-center" style="list-style:none"></ul>
                        <div class="invalid-feedback">
                          Selecciona un mínimo de 2 estudiantes.
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr class="text-center">
                    <td colspan="12">
                      <strong>Responsables</strong>
                      <div class="row mt-3">
                        <div class="col-4">
                          Ing. Christian Echeverría
                          <br>
                          <strong>Profesor</strong>
                        </div>
                        <div class="col-4">
                          Tnlg. Rodrigo Aucapiña
                          <br>
                          <strong>Administrador taller</strong>
                        </div>
                        <div class="col-4">
                          Ing. Christian Echeverría, Esp
                          <br>
                          <strong>Coordinador de carrera</strong>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="container-fluid text-center mt-3 mb-2">
              <button type="submit" class="btn btn-success" data-toggle="modal">
                <span class="glyphicon glyphicon-plus"></span>Generar nueva solicitud <i class="fa fa-plus-circle" aria-hidden="true"></i></a>
              </button>
            </div>
          </div>
        </div>
      </form>
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h5 class="m-0 font-weight-bold text-primary">Lista de Docentes</h5>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTableDocentes" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>#</th>
                  <?php
                  if ($rolSesion == 'Docente') {
                    echo '<th>Nro. Cédula</th>';
                  }
                  ?>
                  <th>Nombres</th>
                  <th>Apellidos</th>
                  <th>Carrera</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php
                include "../includes/db.php";
                $result = mysqli_query($conexion, "SELECT *, NombreCarrera FROM usuarios
                  INNER JOIN carreras ON usuarios.IdCarrera = carreras.IdCarrera WHERE Rol = 'Docente'");
                $contador = 1;
                while ($fila = mysqli_fetch_assoc($result)) :
                ?>
                  <tr>
                    <td><?php echo $contador; ?></td>
                    <?php
                    if ($rolSesion == 'Docente') {
                      echo '<td>' . $fila['Cedula'] . '</td>';
                    }
                    ?>
                    <td><?php echo $fila['Nombres']; ?></td>
                    <td><?php echo $fila['Apellidos']; ?></td>
                    <td><?php echo $fila['NombreCarrera']; ?></td>
                    <td class="text-center">
                      <div class="d-flex justify-content-center">
                        <button class="btn btn-success btn-add-docente" data-id="<?php echo $fila['IdUsuario']; ?>" data-cedula="<?php echo $fila['Cedula']; ?>" data-nombres="<?php echo $fila['Nombres']; ?>" data-apellidos="<?php echo $fila['Apellidos']; ?>" data-carrera="<?php echo $fila['NombreCarrera']; ?>">Agregar</button>
                      </div>
                    </td>
                  </tr>
                <?php
                  $contador++;
                endwhile;
                ?>
              </tbody>
            </table>
            <?php mysqli_close($conexion) ?>
          </div>
        </div>
      </div>
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h5 class="m-0 font-weight-bold text-primary">Lista de Estudiantes</h5>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTableEstudiantes" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>#</th>
                  <?php
                  if ($rolSesion == 'Docente') {
                    echo '<th>Nro. Cédula</th>';
                  }
                  ?>
                  <th>Nombres</th>
                  <th>Apellidos</th>
                  <th>Carrera</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php
                include "../includes/db.php";
                $result = mysqli_query($conexion, "SELECT *, NombreCarrera FROM usuarios
                        INNER JOIN carreras ON usuarios.IdCarrera = carreras.IdCarrera WHERE Rol = 'Estudiante'");
                $contador = 1;
                while ($fila = mysqli_fetch_assoc($result)) :
                ?>
                  <tr>
                    <td><?php echo $contador; ?></td>
                    <?php
                    if ($rolSesion == 'Docente') {
                      echo '<td>' . $fila['Cedula'] . '</td>';
                    }
                    ?>
                    <td><?php echo $fila['Nombres']; ?></td>
                    <td><?php echo $fila['Apellidos']; ?></td>
                    <td><?php echo $fila['NombreCarrera']; ?></td>
                    <td class="text-center">
                      <div class="d-flex justify-content-center">
                        <button class="btn btn-success btn-add-estudiante" data-id="<?php echo $fila['IdUsuario']; ?>" data-cedula="<?php echo $fila['Cedula']; ?>" data-nombres="<?php echo $fila['Nombres']; ?>" data-apellidos="<?php echo $fila['Apellidos']; ?>" data-carrera="<?php echo $fila['NombreCarrera']; ?>">Agregar</button>
                      </div>
                    </td>
                  </tr>
                <?php
                  $contador++;
                endwhile;
                ?>
              </tbody>
            </table>
            <?php mysqli_close($conexion) ?>
          </div>
        </div>
      </div>
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h5 class="m-0 font-weight-bold text-primary">Lista de Estudiantes por periodo y semestre</h5>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTableEstudiantesPeriodoSemestre" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>#</th>
                  <?php
                  if ($rolSesion == 'Docente') {
                    echo '<th>Nro. Cédula</th>';
                  }
                  ?>
                  <th>Nombres</th>
                  <th>Apellidos</th>
                  <th>Periodo</th>
                  <th>Semestre</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php
                include "../includes/db.php";
                $result = mysqli_query($conexion, "SELECT *, NombreCarrera FROM usuarios
                INNER JOIN carreras ON usuarios.IdCarrera = carreras.IdCarrera WHERE Rol = 'Estudiante'");
                $contador = 1;
                while ($fila = mysqli_fetch_assoc($result)) :
                ?>
                  <tr>
                    <td><?php echo $contador; ?></td>
                    <?php
                    if ($rolSesion == 'Docente') {
                      echo '<td>' . $fila['Cedula'] . '</td>';
                    }
                    ?>
                    <td><?php echo $fila['Nombres']; ?></td>
                    <td><?php echo $fila['Apellidos']; ?></td>
                    <td><?php echo "P".$fila['Periodo']; ?></td>
                    <td><?php echo $fila['Semestre']; ?></td>
                    <td class="text-center">
                      <div class="d-flex justify-content-center">
                        <button class="btn btn-success btn-add-estudiante" data-id="<?php echo $fila['IdUsuario']; ?>" data-cedula="<?php echo $fila['Cedula']; ?>" data-nombres="<?php echo $fila['Nombres']; ?>" data-apellidos="<?php echo $fila['Apellidos']; ?>" data-carrera="<?php echo $fila['NombreCarrera']; ?>">Agregar</button>
                      </div>
                    </td>
                  </tr>
                <?php
                  $contador++;
                endwhile;
                ?>
              </tbody>
            </table>
            <?php mysqli_close($conexion) ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<script>
  const enlaceManual = document.getElementById('enlaceManual');
  const rutaManual = '../assets/manuales/manual.pdf';

  fetch(rutaManual)
    .then(response => {
      if (!response.ok) {
        enlaceManual.classList.add('btn-disabled');
        enlaceManual.removeAttribute('href');
      }
    })
    .catch(error => {
      console.error('Error al verificar la existencia del documento manual:', error);
    });

  enlaceManual.addEventListener('click', (event) => {
    if (enlaceManual.getAttribute('href')) {
      event.preventDefault();
      window.open(rutaManual, '_blank');
    } else {
      event.preventDefault();
    }
  });
</script>
<script>
  const enlaceInventario = document.getElementById('enlaceInventario');
  const rutaInventario = '../assets/manuales/inventario.pdf';

  fetch(rutaInventario)
    .then(response => {
      if (!response.ok) {
        enlaceInventario.classList.add('btn-disabled');
        enlaceInventario.removeAttribute('href');
      }
    })
    .catch(error => {
      console.error('Error al verificar la existencia del documento inventario:', error);
    });

  enlaceInventario.addEventListener('click', (event) => {
    if (enlaceInventario.getAttribute('href')) {
      event.preventDefault();
      window.open(rutaInventario, '_blank');
    } else {
      event.preventDefault();
    }
  });
</script>
<?php include "../includes/footer.php"; ?>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
</div>
<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->
<script>
  $(document).ready(function() {
    // Inicializar DataTables para la tabla de estudiantes
    $('#dataTableEstudiantes').DataTable({
      "lengthMenu": [
        [3, 10, 15],
        ["3", "10", "15"]
      ]
    });

    // Inicializar DataTables para la tabla de docentes
    $('#dataTableDocentes').DataTable({
      "lengthMenu": [
        [3, 10, 15],
        ["3", "10", "15"]
      ]
    });

    // Inicializar DataTables para la tabla de estudiantes por periodo y semestre
    $('#dataTableEstudiantesPeriodoSemestre').DataTable({
      "lengthMenu": [
        [10, 20, 30],
        ["10", "20", "30"]
      ]
    });
  });
</script>


<script>
  function agregarEstudiante(cedula, nombres, apellidos, carrera) {
    var listaEstudiantes = document.getElementById('listaEstudiantesAgregados');

    var estudiantes = listaEstudiantes.getElementsByTagName('li');
    for (var i = 0; i < estudiantes.length; i++) {
      var estudiante = estudiantes[i];
      var cedulaEstudiante = estudiante.querySelector('input[data-cedula]').getAttribute('data-cedula');
      if (cedulaEstudiante === cedula) {
        alert('El estudiante ya ha sido agregado a la lista.');
        return;
      }
    }

    var nuevoEstudiante = document.createElement('li');

    var nuevoEstudianteCedula = document.createElement('input');
    nuevoEstudianteCedula.setAttribute('type', 'text');
    nuevoEstudianteCedula.setAttribute('name', 'estudiante_cedula[]');
    nuevoEstudianteCedula.setAttribute('value', cedula);
    nuevoEstudianteCedula.setAttribute('readonly', true);
    nuevoEstudianteCedula.setAttribute('data-cedula', cedula);
    nuevoEstudiante.appendChild(nuevoEstudianteCedula);

    var nuevoEstudianteNombres = document.createElement('input');
    nuevoEstudianteNombres.setAttribute('type', 'text');
    nuevoEstudianteNombres.setAttribute('name', 'estudiante_nombres[]');
    nuevoEstudianteNombres.setAttribute('value', nombres);
    nuevoEstudianteNombres.setAttribute('readonly', true);
    nuevoEstudiante.appendChild(nuevoEstudianteNombres);

    var nuevoEstudianteApellidos = document.createElement('input');
    nuevoEstudianteApellidos.setAttribute('type', 'text');
    nuevoEstudianteApellidos.setAttribute('name', 'estudiante_apellidos[]');
    nuevoEstudianteApellidos.setAttribute('value', apellidos);
    nuevoEstudianteApellidos.setAttribute('readonly', true);
    nuevoEstudiante.appendChild(nuevoEstudianteApellidos);

    var nuevoEstudianteCarrera = document.createElement('input');
    nuevoEstudianteCarrera.setAttribute('type', 'text');
    nuevoEstudianteCarrera.setAttribute('name', 'estudiante_carrera[]');
    nuevoEstudianteCarrera.setAttribute('value', carrera);
    nuevoEstudianteCarrera.setAttribute('readonly', true);
    nuevoEstudiante.appendChild(nuevoEstudianteCarrera);

    var btnEliminar = document.createElement('button');
    btnEliminar.textContent = 'X';
    btnEliminar.classList.add('btn', 'btn-secondary', 'btn-sm', 'ml-2');
    btnEliminar.addEventListener('click', function() {
      listaEstudiantes.removeChild(nuevoEstudiante);
    });
    nuevoEstudiante.appendChild(btnEliminar);

    listaEstudiantes.appendChild(nuevoEstudiante);

    var invalidFeedback = listaEstudiantes.parentNode.querySelector('.invalid-feedback');
    if (listaEstudiantes.children.length < 2) {
      invalidFeedback.style.display = 'block';
      return false;
    } else {
      invalidFeedback.style.display = 'none';
      return true;
    }
  }

  var btnsAgregar = document.querySelectorAll('.btn-add-estudiante');
  btnsAgregar.forEach(function(btn) {
    btn.addEventListener('click', function() {
      var cedula = this.getAttribute('data-cedula');
      var nombres = this.getAttribute('data-nombres');
      var apellidos = this.getAttribute('data-apellidos');
      var carrera = this.getAttribute('data-carrera');
      agregarEstudiante(cedula, nombres, apellidos, carrera);
    });
  });
</script>

<script>
  var docenteAgregado = null;

  function agregarDocente(cedula, nombres, apellidos, carrera) {
    var docenteSolicitud = document.getElementById('docenteSolicitud');

    var docentes = docenteSolicitud.getElementsByTagName('input');
    if (docentes.length > 0) {
      alert('Ya se ha agregado un docente a la solicitud.');
      return;
    }

    var nuevoDocenteCedula = document.createElement('input');
    nuevoDocenteCedula.setAttribute('type', 'text');
    nuevoDocenteCedula.setAttribute('name', 'docente_cedula');
    nuevoDocenteCedula.setAttribute('value', cedula);
    nuevoDocenteCedula.setAttribute('readonly', true);
    docenteSolicitud.appendChild(nuevoDocenteCedula);

    var nuevoDocenteNombres = document.createElement('input');
    nuevoDocenteNombres.setAttribute('type', 'text');
    nuevoDocenteNombres.setAttribute('name', 'docente_nombres');
    nuevoDocenteNombres.setAttribute('value', nombres);
    nuevoDocenteNombres.setAttribute('readonly', true);
    docenteSolicitud.appendChild(nuevoDocenteNombres);

    var nuevoDocenteApellidos = document.createElement('input');
    nuevoDocenteApellidos.setAttribute('type', 'text');
    nuevoDocenteApellidos.setAttribute('name', 'docente_apellidos');
    nuevoDocenteApellidos.setAttribute('value', apellidos);
    nuevoDocenteApellidos.setAttribute('readonly', true);
    docenteSolicitud.appendChild(nuevoDocenteApellidos);

    var nuevoDocenteCarrera = document.createElement('input');
    nuevoDocenteCarrera.setAttribute('type', 'text');
    nuevoDocenteCarrera.setAttribute('name', 'docente_carrera');
    nuevoDocenteCarrera.setAttribute('value', carrera);
    nuevoDocenteCarrera.setAttribute('readonly', true);
    docenteSolicitud.appendChild(nuevoDocenteCarrera);

    var btnEliminar = document.createElement('button');
    btnEliminar.textContent = 'X';
    btnEliminar.classList.add('btn', 'btn-secondary', 'btn-sm', 'ml-2');
    btnEliminar.addEventListener('click', function() {
      docenteSolicitud.removeChild(nuevoDocenteCedula);
      docenteSolicitud.removeChild(nuevoDocenteNombres);
      docenteSolicitud.removeChild(nuevoDocenteApellidos);
      docenteSolicitud.removeChild(nuevoDocenteCarrera);
      docenteSolicitud.removeChild(btnEliminar);
    });
    docenteSolicitud.appendChild(btnEliminar);

    var invalidFeedback = docenteSolicitud.parentNode.querySelector('.invalid-feedback');
    if (docenteSolicitud.children.length == 0) {
      invalidFeedback.style.display = 'block';
      return false;
    } else {
      invalidFeedback.style.display = 'none';
      return true;
    }

  }

  var btnsAgregarDocente = document.querySelectorAll('.btn-add-docente');
  btnsAgregarDocente.forEach(function(btn) {
    btn.addEventListener('click', function() {

      var docente = document.getElementById('docenteSolicitud');
      var docenteList = docente.getElementsByTagName('li');

      var cedula = this.getAttribute('data-cedula');
      var nombres = this.getAttribute('data-nombres');
      var apellidos = this.getAttribute('data-apellidos');
      var carrera = this.getAttribute('data-carrera');
      agregarDocente(cedula, nombres, apellidos, carrera);

    });
  });
</script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>
<script>
  var now = new Date();
  var formattedNow = now.getFullYear() + "-" + (now.getMonth() + 1).toString().padStart(2, "0") + "-" + now.getDate().toString().padStart(2, "0") + " " + now.getHours().toString().padStart(2, "0") + ":" + now.getMinutes().toString().padStart(2, "0");
  var minTime = "08:30";
  var maxTime = "22:00";
  var defaultDateTime;

  if (formattedNow >= now.getFullYear() + "-" + (now.getMonth() + 1).toString().padStart(2, "0") + "-" + now.getDate().toString().padStart(2, "0") + " " + minTime && formattedNow <= now.getFullYear() + "-" + (now.getMonth() + 1).toString().padStart(2, "0") + "-" + now.getDate().toString().padStart(2, "0") + " " + maxTime) {
    defaultDateTime = formattedNow;
  } else {
    defaultDateTime = now.getFullYear() + "-" + (now.getMonth() + 1).toString().padStart(2, "0") + "-" + now.getDate().toString().padStart(2, "0") + " 08:30";
  }

  flatpickr("#datetimepicker", {
    enableTime: true,
    minDate: "today",
    minTime: "8:30",
    maxTime: maxTime,
    time_24hr: false,
    dateFormat: "Y-m-d H:i",
    defaultDate: defaultDateTime,
    locale: "es"
  });
</script>

<script src="../assets/js/validator-solicitud.js"></script>