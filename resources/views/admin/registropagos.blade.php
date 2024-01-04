@extends("theme.sneat.admin")
@section('contenido')
<!-- Content -->
<h4 class="fw-bold py-2"><span class="text-muted fw-light">General /</span> Clientes</h4>
<div class="card">
    <div class="card-header p-3">
        <div class="d-flex flex-row-reverse">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <button type="button" class="btn btn-outline-secundary" onclick="crear();">
                    <i class='tf-icons bx bx-plus-medical'></i>
                </button>
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-outline-secundary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Exportar
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" id="tabla-excel" onclick="$('.tabla_excel').trigger('click');">Excel</a>
                        <a class="dropdown-item" id="tabla-pdf" onclick="$('.tabla_pdf').trigger('click');">PDF</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <div class="table-responsive-xxl text-nowrap" style="min-height:700px;">
        <table id='tabla' class="table table-bordered border-secundary table-sm table-striped w-100">
            <thead class="table-light">
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Dirección</th>
                    <th class="text-center">Casa Matriz</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
        </table>
   </div>
</div>
<!-- / Content -->
<!-- Modal -->
<div class="modal fade" id="modalCenter" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="post" id="form" name="form">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">TITULO</h5>
                    <!-- INPUT HIDDEN -->
                        <input type="hidden" name="accion-form" id="accion-form">
                        <input type="hidden" name="id-form" id="id-form">
                    <!-- FIN INPUT HIDDEN -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl">
                            <div class="card mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Datos Generales</h5>
                                    <small class="text-muted float-end">Datos Generales</small>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="mb-3 col-md-5">
                                            <label class="form-label" for="nombre">Nombre</label>
                                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" />
                                        </div>

                                        <div class="mb-3 col-md-4">
                                            <label class="form-label" for="direccion">Dirección</label>
                                            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección" />
                                        </div>

                                        <div class="mb-3 col-md-2">
                                            <label class="form-label" for="casa_matriz">Casa Matriz</label>
                                            <select class="form-select" id="casa_matriz" name="casa_matriz" placeholder="">
                                                <option value="NO">NO</option>
                                                <option value="SI">SI</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    const titulo_singular = "Local";
    const titulo_pural = "Locales";

// TABLA    
    var table = $('#tabla').DataTable({
        processing: true,
        serverSide: true,
        lengthMenu: [[25, 50, 100, 500, 1000],[25, 50, 100, 500, "1000"]],
        dom: "rtB<'row mx-0 '<'col-sm-6'l><'col-sm-6'p>>",
        ajax: "{{ URL::to('/') }}/general/cliente/listado",
        columns: [
            { data: 'id', 'class':'text-center' },
            { data: 'nombre', 'class':'text-center' },
            { data: 'direccion', 'class':'text-center' },
            { data: 'casa_matriz', 'class':'text-center' },
            {
                "data": null,
                "width": "100px",
                "className" : "text-center",
                "render": function(data, type, row, meta) {
                    return `
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu" style="">
                                <a class="dropdown-item ver" data-id="${row.id}" href="javascript:ver(${row.id});"><i class="tf-icons bx bx-show-alt me-1"></i> Ver</a>
                                <a class="dropdown-item editar" data-id="${row.id}" href="javascript:editar(${row.id});"><i class="tf-icons bx bx-edit me-1"></i> Editar</a>
                                <a class="dropdown-item eliminar" data-id="${row.id}" href="javascript:eliminar(${row.id});"><i class="tf-icons bx bx-x me-1"></i> Eliminar</a>
                            </div>
                        </div>`;
                },
                "orderable": false
            },
        ],
        buttons: [
            {
                extend: 'excel',
                footer: true,
                exportOptions: { 
                    columns: 'th:not(:last-child)'
                },
                className: 'tabla_excel d-none',
            },
            {
                extend: 'pdfHtml5',
                footer: true,			
                exportOptions: { 
                    columns: 'th:not(:last-child)',
                },
                className: 'tabla_pdf d-none',
            }
        ],
        language: {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        initComplete: function(){
            $('.dt-buttons').hide();
        }   
    });

    $('#tabla thead tr').clone(true).find('th').removeClass('sorting_asc sorting_asc sorting').off('click').end().insertBefore('#tabla thead tr');
        
    $('#tabla thead tr:eq(0) th').each(function (i){
        var title = $(this).text();
        if(title != 'Acciones'){
            $(this).html('<input type="text" class="form-control" placeholder="'+title+'" />');
        
            $('input', this).on('keyup change', function(){
                if(table.column(i).search() !== this.value){
                    table.column(i).search(this.value).draw();
                }
            });
        }else{
            $(this).html('');
        }
    });
// FIN TABLA

// ACCIONES
    crear = function(){
        $(".modal-title").html("<strong>Crear "+titulo_singular+"</strong>");
        $("#accion-form").val("crear");
        $("#id-form").val('');
        $('#modalCenter').modal('show');
    };

    ver = function(id){
        $(".modal-title").html("<strong>Ver "+titulo_singular+" #"+id.toString().padStart(3,'0')+"</strong>");
        $("#accion-form").val("ver");
        $("#id-form").val(id);
        $('#modalCenter').modal('show');
    };

    editar = function(id){
        $(".modal-title").html("<strong>Editar "+titulo_singular+" #"+id.toString().padStart(3,'0')+"</strong>");
        $("#accion-form").val("editar");
        $("#id-form").val(id);
        $('#modalCenter').modal('show');
    };

    eliminar = function(id){
        Swal.fire({
            title: '¿ Estas seguro que desea eliminar el registro #'+(id.toString().padStart(3,'0'))+' ?',
            text: "¡ No podrás revertir esto !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡ Sí, bórralo !'
        }).then((result) => {
            if (result.isConfirmed){
                Swal.fire(
                'Eliminado!',
                'Tu registro ha sido eliminado.',
                'success'
                );
            }
        });
    };
// FIN ACCIONES
</script>
@endsection