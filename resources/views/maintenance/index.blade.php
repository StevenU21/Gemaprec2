@extends('adminlte::page')

@section('template_title')
    Maintenances
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
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Codigo</th>
                                        <th>Descripción</th>
                                        <th>Fecha de Inicio</th>
                                        <th>Fecha de Finalización</th>
                                        <th>Observaciones</th>
                                        <th>Estado</th>
                                        <th>Computadora</th>
                                        <th>Tipo de Mantenimiento</th>

                                        <th>Acciones</th>
                                    </tr>
                                </thead>

                                @php
                                    use Carbon\Carbon;
                                @endphp
                                <tbody>
                                    @foreach ($maintenances as $maintenance)
                                        <tr>
                                            <td>{{ $maintenance->id }}</td>
                                            <td>{{ $maintenance->code }}</td>
                                            <td>{{ $maintenance->description }}</td>
                                            <td>{{ \Carbon\Carbon::parse($maintenance->start_date)->format('d-m-Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($maintenance->end_date)->format('d-m-Y') }}</td>
                                            <td>{{ $maintenance->observations }}</td>
                                            <td>{{ $maintenance->status }}</td>
                                            <td>{{ $maintenance->computer->name }}</td>
                                            <td>{{ $maintenance->maintenanceType->name }}</td>

                                            <td>
                                                <form action="{{ route('maintenances.destroy', $maintenance->id) }}"
                                                    method="POST">
                                                    @can('read maintenances')
                                                        <a class="btn btn-sm btn-primary "
                                                            href="{{ route('maintenances.show', $maintenance->id) }}"><i
                                                                class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}</a>
                                                    @endcan

                                                    @can('update maintenances')
                                                        <a class="btn btn-sm btn-success"
                                                            href="{{ route('maintenances.edit', $maintenance->id) }}"><i
                                                                class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    @endcan
                                                    @csrf
                                                    @method('DELETE')
                                                    @can('delete maintenances')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="event.preventDefault(); confirm('Estas seguro que deseas eliminar?') ? this.closest('form').submit() : false;"><i
                                                                class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                                    @endcan
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {!! $maintenances->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
