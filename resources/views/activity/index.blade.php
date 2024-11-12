@extends('adminlte::page')

@section('template_title')
    Actividades
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('Actividades') }}
                            </span>
                            @can('create activities')
                                <div class="float-right">
                                    <a href="{{ route('activities.create') }}" class="btn btn-primary btn-sm float-right"
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
                            <table id="activities-table" class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>ID</th>
                                        <th>Descripción</th>
                                        <th>Fecha de Inicio</th>
                                        <th>Fecha de Fin</th>
                                        <th>Tipo de Actividad</th>
                                        <th>Código de Mantenimiento</th>
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
            $('#activities-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('activities.index') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'description', name: 'description' },
                    { data: 'start_date', name: 'start_date' },
                    { data: 'end_date', name: 'end_date' },
                    { data: 'activity_type_name', name: 'activity_type_name' },
                    { data: 'maintenance_code', name: 'maintenance_code' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
                responsive: true,
                autoWidth: false
            });
        });
    </script>
@endsection
