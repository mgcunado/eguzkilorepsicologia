var categorias = [{
  id: 1,
  subcategorias: ['Limpiar casa', 'Ordenar casa']
}, {
  id: 2,
  subcategorias: ['Recambios', 'ITV']
}, {
  id: 3,
  subcategorias: ['Administración', 'Bolsa-Horas Extras', 'Cursos de formación', 'Permisos', 'Ropa', 'Vacaciones']
}, {
  id: 4,
  subcategorias: ['Copias de Seguridad', 'MySql-Doctrine', 'Php', 'Symfony', 'Twig', 'Otras tareas']
}, {
  id: 5,
  subcategorias: ['Facturas', 'Hacienda', 'Instalaciones', 'Material de Oficina', 'Material Didáctico']
}, {
  id: 6,
  subcategorias: ['Mapas-GPS', 'Alojamiento', 'Vuelos', 'Otras actividades']
}, {
  id: 7,
  subcategorias: ['Luz-Agua-Gas', 'Movil', 'Otras facturas']
}, {
  id: 8,
  subcategorias: ['Planes', 'Música', 'Lectura']
}, {
  id: 9,
  subcategorias: ['Alimentación', 'Limpieza', 'LeroyMerlin-Bricodepo', 'Centro Eguzkilore', 'Libros-Cultura', 'Otras compras']
}, {
  id: 10,
  subcategorias: ['Compras', 'Transporte', 'Otros']
}, {
  id: 11,
  subcategorias: ['Casa', 'Eguzkilore', 'Coche', 'Viajes', 'Hegoalde', 'Otros gastos']
}];

$(document).ready(function () {

  function categoriaChanged(categoriaId) {

    // deselect subcategoria
    $('#s83f24720f6_subcategoria').val('');

    // hide all subcategorias
    $('#s83f24720f6_subcategoria option[value!=""]').hide();

    for (var i = 0; i < categorias.length; i++) {
      // if(categoriaId.indexOf(categorias[i].id) > -1){
      if (categorias[i].id == categoriaId) {
        showSubcategorias(categorias[i].subcategorias);
        return;
      }
    }
  }

  function showSubcategorias(subcategorias) {
    for (var i = 0; i < subcategorias.length; i++) {
      $('#s83f24720f6_subcategoria option[value="' + subcategorias[i] + '"]').show();
    }
  }

  //$(document).ready(function () {
  $('#s83f24720f6_subcategoria option[value!=""]').hide();

  $('#s83f24720f6_categoria ').on('change', function (e) {
    categoriaChanged(e.target.value);
  });

});

