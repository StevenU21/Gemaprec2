@extends('adminlte::page')

@section('template_title')
    Computers
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Computadoras') }}
                            </span>

                            @can('create computers')
                                <div class="float-right">
                                    <a href="{{ route('computers.create') }}" class="btn btn-primary btn-sm float-right"
                                        data-placement="left">
                                        {{ __('Crear Nuevo') }}
                                    </a>
                                </div>
                            @endcan
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table id="computers-table" class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Número de Serie</th>
                                        <th>MAC Address</th>
                                        <th>Fecha de Adquisición</th>
                                        <th>Estado</th>
                                        <th>Marca</th>
                                        <th>Modelo</th>
                                        <th>Tipo</th>
                                        <th>Cliente</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- Incluir los archivos de DataTables para Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#computers-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('computers.index') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'description', name: 'description' },
                    { data: 'serial_number', name: 'serial_number' },
                    { data: 'mac_address', name: 'mac_address' },
                    { data: 'adquisition_date', name: 'adquisition_date' },
                    { data: 'status', name: 'status' },
                    { data: 'brand.name', name: 'brand.name' },
                    { data: 'pc_model.name', name: 'pc_model.name' },
                    { data: 'pc_type.name', name: 'pc_type.name' },
                    { data: 'client.user.name', name: 'client.user.name' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
                responsive: true,
                autoWidth: false,
            });
        });
    </script>

@endsection
