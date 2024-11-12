@extends('adminlte::page')

@section('template_title')
    Mantenimientos
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('Mantenimientos') }}
                            </span>
                            @can('create maintenances')
                                <div class="float-right">
                                    <a href="{{ route('maintenances.create') }}" class="btn btn-primary btn-sm float-right"
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
                            <table id="maintenances-table" class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>ID</th>
                                        <th>Código</th>
                                        <th>Descripción</th>
                                        <th>Fecha de Inicio</th>
                                        <th>Fecha de Fin</th>
                                        <th>Observaciones</th>
                                        <th>Estado</th>
                                        <th>Nombre del Computador</th>
                                        <th>Tipo de Mantenimiento</th>
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
    <script>
        $(document).ready(function() {
            $('#maintenances-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('maintenances.index') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'code', name: 'code' },
                    { data: 'description', name: 'description' },
                    { data: 'start_date', name: 'start_date' },
                    { data: 'end_date', name: 'end_date' },
                    { data: 'observations', name: 'observations' },
                    { data: 'status', name: 'status' },
                    { data: 'computer_name', name: 'computer_name' },
                    { data: 'maintenance_type_name', name: 'maintenance_type_name' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
                responsive: true,
                autoWidth: false
            });
        });
    </script>
@endsection
