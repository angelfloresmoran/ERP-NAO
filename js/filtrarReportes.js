document.addEventListener("DOMContentLoaded", function() {
    const filtroFecha = document.getElementById("filtroFecha");
    const busqueda = document.getElementById("busqueda");
    const proyecto = document.getElementById("proyectos")
    const miTabla = document.getElementById("tablax");
  
    filtroFecha.addEventListener("change", actualizarTabla);
    busqueda.addEventListener("input", actualizarTabla);
    proyectos.addEventListener("change", actualizarTabla);
  
    function actualizarTabla() {
      const fechaFiltrada = filtroFecha.value;
      const textoBusqueda = busqueda.value.toLowerCase();
      const proyectoFiltrado = proyecto.value;
      filtrarTabla(fechaFiltrada, textoBusqueda, proyectoFiltrado);
    }
  
    function filtrarTabla(fechaFiltrada, textoBusqueda, proyecto) {
      const filas = miTabla.getElementsByTagName("tr");
    
      for (let i = 1; i < filas.length; i++) {
        const celdas = filas[i].getElementsByTagName("td");
    
        if (celdas.length >= 6) {
          const celdaFecha = celdas[2].textContent;
          const celdaNombre = celdas[0].textContent.toLowerCase();
          const celdaProy = celdas[1].textContent;
    
          const cumplefiltroFecha = fechaFiltrada === "" || celdaFecha === fechaFiltrada;
          const cumpleFiltroBusqueda = celdaNombre.includes(textoBusqueda);
          const cumpleFiltroProy = proyecto === "" || celdaProy === proyecto || proyecto === "Mostrar todos";
    
          if (cumplefiltroFecha && cumpleFiltroBusqueda && cumpleFiltroProy) {
            filas[i].style.display = "";
          } else {
            filas[i].style.display = "none";
          }
        }
      }
    }
  });
  