document.addEventListener("DOMContentLoaded", function() {
  const filtroFecha = document.getElementById("filtroFecha");
  const busqueda = document.getElementById("busqueda");
  const miTabla = document.getElementById("tablax");

  filtroFecha.addEventListener("change", actualizarTabla);
  busqueda.addEventListener("input", actualizarTabla);

  function actualizarTabla() {
    const fechaFiltrada = filtroFecha.value;
    const textoBusqueda = busqueda.value.toLowerCase();
    filtrarTabla(fechaFiltrada, textoBusqueda);
  }

  function filtrarTabla(fechaFiltrada, textoBusqueda) {
    const filas = miTabla.getElementsByTagName("tr");
  
    for (let i = 1; i < filas.length; i++) {
      const celdas = filas[i].getElementsByTagName("td");
  
      if (celdas.length >= 6) {
        const celdaFecha = celdas[2].textContent;
        const celdaNombre = celdas[0].textContent.toLowerCase();
  
        const cumplefiltroFecha = fechaFiltrada === "" || celdaFecha === fechaFiltrada;
        const cumpleFiltroBusqueda = celdaNombre.includes(textoBusqueda);
  
        if (cumplefiltroFecha && cumpleFiltroBusqueda) {
          filas[i].style.display = "";
        } else {
          filas[i].style.display = "none";
        }
      }
    }
  }
});
