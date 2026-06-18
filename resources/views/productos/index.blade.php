@extends('plantilla.app')
@push('estilos')

@endpush
@section('content')
<!--begin::Container-->
<div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center">
                    <h3 class="card-title flex-grow-1">Productos</h3>
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
                                    <th>Unidad</th>
                                    <th>Afectación Tipo</th>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Precio Unitario</th>
                                    <th>Imagen</th>
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
@include('productos.action')
@endsection
@push('scripts')
<script>
    class ProductoManager extends CrudManager {
        constructor() {
            super("{{ url('productos') }}");
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
                        data: 'unidad_codigo',
                        name: 'unidad_codigo'
                    },
                    {
                        data: 'afectacion_tipo_codigo',
                        name: 'afectacion_tipo_codigo'
                    },
                    {
                        data: 'codigo',
                        name: 'codigo'
                    },
                    {
                        data: 'nombre',
                        name: 'nombre'
                    },
                    {
                        data: 'precio_unitario',
                        name: 'precio_unitario'
                    },
                    {
                        data: 'imagen',
                        name: 'imagen'
                    }
                ],
                columnDefs: [{
                        targets: 0,
                        width: '15%',
                        className: 'text-center'
                    },
                    {
                        targets: 1,
                        width: '10%'
                    },
                    {
                        targets: 2,
                        width: '10%'
                    },
                    {
                        targets: 3,
                        width: '10%'
                    },
                    {
                        targets: 4,
                        width: '20%'
                    },
                    {
                        targets: 5,
                        width: '15%'
                    },
                    {
                        targets: 6,
                        width: '20%'
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
        new ProductoManager();
    });
</script>
@endpush
