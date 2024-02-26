document.getElementById("nombreGrupoForm").addEventListener("submit", function (event) {
  var cuatrimestre = document.getElementById("cuatrimestre").value;
  var carrera = document.getElementById("carrera").value;

  var nombreGrupo = cuatrimestre + " - " + carrera;
  document.getElementById("nombreGrupo").value = nombreGrupo;
});

function validarTexto(input) {
  input.value = input.value.replace(/[^A-Za-záéíóúüñÁÉÍÓÚÜÑ,]/g, "");
}

document.addEventListener("click", function (event) {
  var accionesContainers = document.querySelectorAll(".acciones");
  var grupoContainers = document.querySelectorAll(".grupo-container");

  accionesContainers.forEach(function (acciones) {
      if (!event.target.closest(".acciones") && !event.target.closest(".grupo-container")) {
          acciones.style.display = "none";
      }
  });
});

function toggleAcciones(element) {
  var acciones = element.querySelector(".acciones");
  acciones.style.display = acciones.style.display === "block" ? "none" : "block";

  // Ocultar otras acciones
  var otrosAcciones = document.querySelectorAll(".acciones");
  otrosAcciones.forEach(function (otrasAcciones) {
      if (otrasAcciones !== acciones) {
          otrasAcciones.style.display = "none";
      }
  });
}

function buscarGrupos() {
  var input, filter, rows, cells, i, txtValue;
  input = document.getElementById("buscarNombre");
  filter = input.value.toUpperCase();
  rows = document.querySelectorAll("tbody tr");

  rows.forEach(function (row) {
      var display = false;

      cells = row.getElementsByTagName("td");
      for (i = 0; i < cells.length; i++) {
          txtValue = cells[i].textContent || cells[i].innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
              display = true;
              break;
          }
      }
      row.style.display = display ? "" : "none";
  });
}

function confirmarEliminar(grupoID) {
  Swal.fire({
      title: '¿Estás seguro?',
      text: 'Esta acción no se puede deshacer',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Sí, eliminar',
      cancelButtonText: 'Cancelar'
  }).then((result) => {
      if (result.isConfirmed) {
          window.location.href = 'functions/eliminar.php?id=' + grupoID;
      }
  });
}

function reloadPage() {
  location.reload();
}

function validarTexto(inputElement) {
  var inputValue = inputElement.value;

  var cleanedValue = inputValue.replace(/[^a-zA-Z,]/g, '');

  inputElement.value = cleanedValue;
}