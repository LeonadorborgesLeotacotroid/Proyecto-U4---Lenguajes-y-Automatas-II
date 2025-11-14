$(document).ready(function() {

    function initDataTable(selector, ajaxUrl, columns, order = [[0, 'asc']]) {
    $(selector).DataTable({
        ajax: {
            url: ajaxUrl,
            dataSrc: ""
        },
        columns: columns,
        paging: true,
        searching: true,
        ordering: true,
        order: order,
        dom: 'Bfrtip', // Habilita la barra de botones arriba de la tabla
        buttons: [
            { extend: 'excel', text: '<i class="fa fa-file-excel"></i> Excel', className: 'btn btn-success btn-sm' },
            { extend: 'pdf', text: '<i class="fa fa-file-pdf"></i> PDF', className: 'btn btn-danger btn-sm' },
            { extend: 'print', text: '<i class="fa fa-print"></i> Imprimir', className: 'btn btn-primary btn-sm' }
        ],
        language: {
            decimal: ",",
            thousands: ".",
            lengthMenu: "Mostrar _MENU_ registros por página",
            zeroRecords: "No se encontraron resultados",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            },
            buttons: {
                copyTitle: 'Copiado al portapapeles',
                copySuccess: {
                    _: '%d filas copiadas',
                    1: '1 fila copiada'
                }
            }
        }
    });
}


    // Inicializar tabla de todos los alumnos con calificación y estado
    initDataTable('#tabla_todos', 'controller/alumno.php?op=estado', [
        { data: 'id' },
        { data: 'nombre_completo' },
    ]);

    // Inicializar tabla de alumnos aprobados
    initDataTable('#tabla_aprobados', 'controller/alumno.php?op=aprobados', [
        { data: 'id' },
        { data: 'nombre_completo' },
        { data: 'calificacion_final' }
    ]);

    // Inicializar tabla de alumnos reprobados
    initDataTable('#tabla_reprobados', 'controller/alumno.php?op=reprobados', [
        { data: 'id' },
        { data: 'nombre_completo' },
        { data: 'calificacion_final' }
    ]);

    // Inicializar tabla de estado de alumnos
    initDataTable('#tabla_estado', 'controller/alumno.php?op=estado', [
        { data: 'id' },
        { data: 'nombre_completo' },
        { data: 'calificacion_final' },
        { data: 'estado' }
    ]);
});
