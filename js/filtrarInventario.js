document.addEventListener("DOMContentLoaded", function() {
    const busqueda = document.getElementById("busqueda");
    const material = document.getElementById("tipoMaterial");
    const marca = document.getElementById("marca");
    const estatus = document.getElementById("estatus");
    const miTabla = document.getElementById("tablax");
  
    material.addEventListener("change", actualizarTabla);
    busqueda.addEventListener("input", actualizarTabla);
    marca.addEventListener("change", actualizarTabla);
    estatus.addEventListener("change", actualizarTabla);
  
    function actualizarTabla() {
      const materialFiltrado = material.value;
      const textoBusqueda = busqueda.value.toLowerCase();
      const marcaFiltrada = marca.value;
      const estatusFiltrado = estatus.value;
      filtrarTabla(materialFiltrado, textoBusqueda, marcaFiltrada, estatusFiltrado);
    }
  
    function filtrarTabla(materialFiltrado, textoBusqueda, marcaFiltrada, estatusFiltrado) {
      const filas = miTabla.getElementsByTagName("tr");
    
      for (let i = 1; i < filas.length; i++) {
        const celdas = filas[i].getElementsByTagName("td");
    
        if (celdas.length >= 6) {
          const celdaMaterial = celdas[1].textContent;
          const celdaNombre = celdas[0].textContent.toLowerCase();
          const celdaMarca = celdas[2].textContent;
          const celdaEstatus = celdas[4].textContent;
    
          const cumpleFiltroBusqueda = celdaNombre.includes(textoBusqueda);
          const cumpleMaterial = materialFiltrado === "" || celdaMaterial === materialFiltrado || materialFiltrado === "Mostrar todos";
          const cumpleMarca = marcaFiltrada === "" || celdaMarca === marcaFiltrada || marcaFiltrada === "Mostrar todos";
          const cumpleEstatus = estatusFiltrado === "" || celdaEstatus === estatusFiltrado || estatus === "Mostrar todos";
    
          if (cumpleMaterial && cumpleFiltroBusqueda && cumpleMarca && cumpleEstatus) {
            filas[i].style.display = "";
          } else {
            filas[i].style.display = "none";
          }
        }
      }
    }
  });
  