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
                    <button type="button" class="btn btn-primary" id="btnCreate">
                        <i class="bi bi-plus-circle"></i> Nuevo
                    </button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="listadoTable" class="table table-striped table-hover table-sm">
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
@include('unidades.action')
@endsection
@push('scripts')
<script src="{{ asset('datatables/jquery-3.7.1.js') }}"></script>
<script src="{{ asset('datatables/dataTables.js') }}"></script>
<script src="{{ asset('datatables/dataTables.bootstrap5.js') }}"></script>
<script src="{{asset('js/sweetalert2.js')}}"></script>
<script src="{{asset('js/crud.js')}}"></script>
<script>
    class UnidadManager extends CrudManager {
        constructor() {
            super("{{ url('unidades') }}");
            this.initializeDataTable();
        }

        initializeDataTable() {
            this.tabla = $(this.elements.table).DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: this.baseUrl,
                    type: "GET"
                },
                columns: [{
                        data: 'action',
                        name: 'action',
                        ordenable: false,
                        serchable: false
                    },
                    {
                        data: 'codigo',
                        name: 'codigo'
                    },
                    {
                        data: 'descripcion',
                        name: 'descripcion'
                    }
                ],
                columnDefs: [{
                        targets: 0,
                        width: '5%',
                        className: 'text-center'
                    },
                    {
                        targets: 1,
                        width: '15%'
                    },
                    {
                        targets: 2,
                        width: '80%'
                    }
                ],
                responsive: true,
                order: [
                    [1, 'asc']
                ]
            });
        }

        async showEditModal(id) {
            try {
                const response = await this.fetchData(`${this.baseUrl}/${id}`);

                this.isEditing = true;
                this.resetForm();

                this.elements.modalTitle.textContent = 'Editar registro';
                this.elements.methodField.value = 'PUT';

                //Llenar campos específicos
                document.getElementById('codigo').value = response.codigo || '';
                document.getElementById('descripcion').value = response.descripcion || '';

                this.form.action = `${this.baseUrl}/${id}`;

                this.modal.show();

            } catch (error) {
                this.showNotification('error', 'Error al cargar los datos');
                console.error('Error al cargar los datos: ', error);
            }
        }

        focusFirstField() {
            document.getElementById('codigo').focus();
        }
    }
    document.addEventListener('DOMContentLoaded', () => {
        new UnidadManager();
    });
</script>
@endpush
