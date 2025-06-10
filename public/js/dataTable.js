$(document).ready(function() {

    var table = $('#infoTable').DataTable({

        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": false, 
        "info": true,
        "pageLength": 10,
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ registros en total)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });

    $('#tablePagination').append($('.dataTables_paginate'));
    $('#tableInfo').append($('.dataTables_info'));

    $('#infoTable thead .search-column').on('keyup change', function() {

        let colIndex = $(this).parent().index();
        table.column(colIndex).search(this.value).draw();

    });

    $('#entries').on('change', function() {

        var value = $(this).val();
        table.page.len(value === "todos" ? -1 : parseInt(value)).draw();
        
    });
});
