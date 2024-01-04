@extends("theme.sneat.admin")
@section('contenido')
<!-- Content -->
<h4 class="fw-bold py-2"><span class="text-muted fw-light">Admin /</span> Lista Del Personal   ({{App\Models\personal::count();}})</h4>
<button class="btn btn-primary btn-sm:" data-bs-toggle="modal" data-bs-target="#regisModal">Añadir Personal</button>

<!-- Modal -->
<div class="modal fade" id="regisModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir Personal</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
            <form action="{{route("admin.personal.guardar")}}" method="POST">
                @csrf
                <div class="mb-3 col-md-5">
                    <label class="form-label" for="cedula">Cedula</label>
                    <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Cedula" />
                </div>
                <div class="mb-3 col-md-5">
                    <label class="form-label" for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" />
                </div>
                <div class="mb-3 col-md-4">
                    <label class="form-label" for="apellido">Apellido</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" />
                </div>
                <div class="mb-3 col-md-4">
                    <label class="form-label" for="telefono">Telefono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Telefono" />
                </div>
                <div class="mb-3 col-md-4">
                    <label class="form-label" for="correo">Correo</label>
                    <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo" />
                </div>
                <div class="mb-3 col-md-4">
                    <label class="form-label" for="trabajo">Trabajo</label>
                    <input type="text" class="form-control" id="trabajo" name="trabajo" placeholder="trabajo" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    </div>
</div>
<div class="card">
   <div class="table-responsive-xxl text-nowrap" style="min-height:700px;">
    @if(session("correcto"))
    <div class="alert alert-success">{{session("correcto")}}</div>
    @endif
    @if(session("error"))
    <div class="alert alert-danger">{{session("error")}}</div>
    @endif
        <table id='tabla' class="table table-bordered border-secundary table-sm table-striped w-100">
            <thead class="table-light">
                <tr>
                    <th class="text-center">Cedula</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Apellido</th>
                    <th class="text-center">Telefono</th>
                    <th class="text-center">Correo</th>
                    <th class="text-center">Trabajo</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $item)
                <tr>
                    <td class="text-center">{{$item->cedula}}</td>
                    <td class="text-center">{{$item->nombre}}</td>
                    <td class="text-center">{{$item->apellido}}</td>
                    <td class="text-center">{{$item->telefono}}</td>
                    <td class="text-center">{{$item->correo}}</td>
                    <td class="text-center">{{$item->trabajo}}</td>
                    <td>
                        <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal{{$item->cedula}}" class="btn btn-warning btn-san"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="{{route("admin.personal.eliminar",$item->id)}}" class="btn btn-danger btn-san"><i class="fa-solid fa-trash-can"></i></a>
                        <a href="" data-bs-toggle="modal" data-bs-target="#exampleModaldas{{$item->cedula}}" class="btn btn-success btn-san"><i class="fa-solid fa-magnifying-glass"></i></a>
                    </td>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{$item->cedula}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar Cliente</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                        <form action="{{ route('admin.personal.editar', $item->id) }}"method="POST">
                                            @method('PUT')
                                            @csrf
                                            <div class="mb-3 col-md-5">
                                                <label class="form-label" for="cedula">Cedula</label>
                                                <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Cedula" value="{{$item->cedula}}"/>
                                            </div>
                                            <div class="mb-3 col-md-5">
                                                <label class="form-label" for="nombre">Nombre</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre"  value="{{$item->nombre}}"/>
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label class="form-label" for="apellido">Apellido</label>
                                                <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" value="{{$item->apellido}}"/>
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label class="form-label" for="telefono">Telefono</label>
                                                <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Telefono" value="{{$item->telefono}}"/>
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label class="form-label" for="correo">Correo</label>
                                                <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo" value="{{$item->correo}}"/>
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label class="form-label" for="trabajo">Trabajo</label>
                                                <input type="text" class="form-control" id="trabajo" name="trabajo" placeholder="trabajo" value="{{$item->trabajo}}"/>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-primary">Guardar</button>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            
                            <!-- Modal VER-->
                            <div class="modal fade" id="exampleModaldas{{$item->cedula}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ver datos Maestro</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                        <form>
                                            @csrf
                                            <div class="mb-3 col-md-5">
                                                <label class="form-label" for="cedula">Cedula</label>
                                                <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Cedula" value="{{$item->cedula}}" readonly/>
                                            </div>
                                            <div class="mb-3 col-md-5">
                                                <label class="form-label" for="nombre">Nombre</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre"  value="{{$item->nombre}}" readonly/>
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label class="form-label" for="apellido">Apellido</label>
                                                <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" value="{{$item->apellido}}" readonly/>
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label class="form-label" for="telefono">Telefono</label>
                                                <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Telefono" value="{{$item->telefono}}" readonly/>
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label class="form-label" for="correo">Correo</label>
                                                <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo" value="{{$item->correo}}" readonly/>
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label class="form-label" for="trabajo">Trabajo</label>
                                                <input type="text" class="form-control" id="trabajo" name="trabajo" placeholder="trabajo" value="{{$item->trabajo}}" readonly/>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                </tr>    
            </tbody>
            @endforeach
        </table>
   </div>
</div>
@endsection
@section('scripts')
<script>
    new DataTable('#tabla', {
        dom: 'B<"clear">lfrtip',
    buttons: [ 'pdf', 'csv', 'excel' ],
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
        }

    });
</script>
@endsection