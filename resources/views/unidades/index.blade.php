@extends('plantilla.app')
@push('estilos')
<link rel="stylesheet" href="{{ asset('datatables/dataTables.bootstrap5.css') }}">
@endpush
@section('content')
<!--begin::Container-->
<div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center">
                    <h3 class="card-title flex-grow-1">Unidades</h3>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalUpdate">
                        <i class="bi bi-plus-circle"></i> Nuevo
                    </button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tablaListado" class="table table-striped table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Código</th>
                                    <th>Descripción</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">

                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!--end::Row-->
</div>
<!--end::Container-->
@include('plantilla.action')
@endsection
@push('scripts')
<script src="{{ asset('datatables/jquery-3.7.1.js') }}"></script>
<script src="{{ asset('datatables/dataTables.js') }}"></script>
<script src="{{ asset('datatables/dataTables.bootstrap5.js') }}"></script>
<script src="{{asset('js/sweetalert2.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#tablaListado').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("unidades.index") }}',
            columns: [{
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'codigo',
                    name: 'codigo'
                },
                {
                    data: 'descripcion',
                    name: 'descripcion '
                }
            ]
        });
    });

    function eliminar() {
        Swal.fire({
            title: '¿Está seguro de eliminar el registro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminarlo!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: '¡Eliminado!',
                    text: 'El registro ha sido eliminado.',
                    icon: 'success',
                });
            }
        });
    }
</script>
@endpush
