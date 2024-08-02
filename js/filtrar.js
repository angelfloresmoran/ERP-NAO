  document.addEventListener("DOMContentLoaded", function() {
    const filtroArea = document.getElementById("filtroArea");
    const busqueda = document.getElementById("busqueda");
    const miTabla = document.getElementById("tablax");
  
    filtroArea.addEventListener("change", actualizarTabla);
    busqueda.addEventListener("input", actualizarTabla);
  
    function actualizarTabla() {
      const areaSeleccionada = filtroArea.value;
      const textoBusqueda = busqueda.value.toLowerCase();
      filtrarTabla(areaSeleccionada, textoBusqueda);
    }
  
    function filtrarTabla(area, textoBusqueda) {
      const filas = miTabla.getElementsByTagName("tr");
    
      for (let i = 1; i < filas.length; i++) {
        const celdas = filas[i].getElementsByTagName("td");
    
        if (celdas.length >= 6) {
          const celdaArea = celdas[5].textContent;
          const celdaNombre = celdas[0].textContent.toLowerCase();
    
          const cumpleFiltroArea = area === "" || celdaArea === area || area === "Mostrar todos";
          const cumpleFiltroBusqueda = celdaNombre.includes(textoBusqueda);
    
          if (cumpleFiltroArea && cumpleFiltroBusqueda) {
            filas[i].style.display = "";
          } else {
            filas[i].style.display = "none";
          }
        }
      }
    }
  });
  