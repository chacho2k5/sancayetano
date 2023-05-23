<x-app-layout>

    <x-slot name='css'>
        <link rel="stylesheet" href="{{ asset('css/datatables.custom.css') }}" class="rel">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.3/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.6/sb-1.3.3/sp-2.0.1/sl-1.4.0/datatables.min.css"/>
    </x-slot>

    <div class="content-header">
        <div class="container-fluid">
            <div class="mb-2 row">
                <div class="col-sm-6">
                    <h3 class="m-0">
                        Listado de Categorias
                    </h3>
                </div>
            </div>

            @if ($message = Session::get('success'))
                <div class="alert alert-success mt-3">
                    <span>{{ $message }}</span>
                </div>
            @endif
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="table" class="table pt-1 table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Factor (x)</th>
                                        <th width="100px">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name='js'>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.3/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.6/sb-1.3.3/sp-2.0.1/sl-1.4.0/datatables.min.js"></script>

        <script>
            // Este function capaz q ni hace falta #chacho
            $(function() {
                // Setting defaults
                $.extend( $.fn.dataTable.defaults, {
                    searching: true,
                    ordering:  true,
                    // "language": {
                    //    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                    // }
                    "language": {
                        "info": "_TOTAL_ registros",
                        "search": "Buscar",
                        "paginate": {
                            "next": "Sig.",
                            "previous": "Ant.",
                            "first": "Primero",
                            "last": "Último"
                        },
                        "lengthMenu": 'Mostrar <select>'+
                            '<option value="10">10</option>'+
                            '<option value="30">30</option>'+
                            '<option value="-1">Todos</option>'+
                            '</select> registros',
                        "loadingRecords": "Cargando...",
                        "processing": "Procesando...",
                        "emptyTable": "No hay datos",
                        "zeroRecords": "No hay conincidencias",
                        "infoEmpty": "",
                        "infoFiltered": ""
                    }

                } );
            });

            $(document).ready(function() {
                $('#table').DataTable({
                    "processing": true,
                    "responsive": true,
                    "autoWidth": false,
                    "serverSide": true,
                    "pageLength": 30,
                    // "dom": 'Bfrtilp',
                    // "dom": '<"top"Bf>rt<"bottom"p><"clear">',
                    dom: 'Bfrtip',
            select: true,
                    "buttons":[
                        {
                            name: 'btnAgregar',
                            text: 'Agregar Categoria',
                            action: function ( e, dt, node, conf ) {
                                location.href = "{{ route('categorias.create') }}";
                            },
                            // className: 'btn btn-primary btn-sm rounded opacity-75'
                            className: 'btnAgregar text-white btn-sm rounded opacity-75'
                        },
                        {
                            name: 'btngrupo',
                            extend: 'excelHtml5',
                            text:   '<i class="fas fa-file-excel"></i>&nbsp;&nbsp;Excel',
                            titleAttr: 'Exportar a Excel',
                            // className: 'btn btn-outline-info btn-sm rounded opacity-75'
                            className: 'btn btn-success btn-sm rounded opacity-75'
                        },
                        // {
                        //     extend: 'spacer',
                        //     style: '',
                        //     text: ''
                        // },
                        {
                            // extend: 'pdfHtml5',
                            name: 'btngrupo',
                            extend: 'pdf',
                            text:   '<i class="fas fa-file-pdf"></i>&nbsp;&nbsp;PDF',
                            titleAttr: 'Exportar a PDF',
                            // className: 'btn btn-outline-danger btn-sm rounded opacity-75'
                            className: 'btn btn-danger btn-sm rounded opacity-75'
                        },
                        // {
                        //     extend: 'spacer',
                        //     style: 'bar',
                        //     text: ''
                        // },
                        {
                            // name: 'btnPrint',
                            extend: 'print',
                            text:   '<i class="fa fa-print"></i>&nbsp;&nbsp;Imprimir',
                            titleAttr: 'Imprimir',
                            className: 'btn btn-warning btn-sm rounded opacity-75'
                        }
                    ],

                    // "dataType": json,
                    // type: POST,
                    "ajax": "{{ route('dt.categorias') }}",
                    "columns": [
                        {data: 'descripcion', name: 'decripcion'},
                        {data: 'factor', name: 'factor'},
                        {data: 'actions', name: 'actions', searchable: false, orderable: false, className: ''},
                    ],
                    order: [[1, 'asc']],
                    "scrollY": '45vh',
                    "scrollCollapse": true,
                    "pagingType": "full_numbers",
                });

            });    //////////// document.ready principal

        </script>
    </x-slot>

</x-app-layout>
