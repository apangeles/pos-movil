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
                <div class="card-header">
                    <h3 class="card-title">Listado</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tablaListado" class="table table-striped table-hover table-sm">
                            <thead>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>NIU-1</td>
                                    <td>Unidades</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>NIU-2</td>
                                    <td>Unidades</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>NIU-3</td>
                                    <td>Unidades</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>NIU-4</td>
                                    <td>Unidades</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>NIU-5</td>
                                    <td>Unidades</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>NIU-6</td>
                                    <td>Unidades</td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>NIU-7</td>
                                    <td>Unidades</td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>NIU-8</td>
                                    <td>Unidades</td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td>NIU-9</td>
                                    <td>Unidades</td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td>NIU-10</td>
                                    <td>Unidades</td>
                                </tr>
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
@endsection
@push('scripts')
<script src="{{ asset('datatables/jquery-3.7.1.js') }}"></script>
<script src="{{ asset('datatables/dataTables.js') }}"></script>
<script src="{{ asset('datatables/dataTables.bootstrap5.js') }}"></script>
<script>
    new DataTable('#tablaListado');
</script>
@endpush
