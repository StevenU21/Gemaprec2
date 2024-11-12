@extends('adminlte::page')

@section('template_title')
    Activities
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

                            <div class="float-right">
                                @can('create activities')
                                    <a href="{{ route('activities.create') }}" class="btn btn-primary btn-sm float-right"
                                        data-placement="left">
                                        {{ __('Crear Nuevo') }}
                                    </a>
                                @endcan
                            </div>
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

                                        <th>Description</th>
                                        <th>Fecha de Inicio</th>
                                        <th>Fecha de Finalizacion</th>
                                        <th>Tipo de Actividad</th>
                                        <th>Mantenimiento</th>

                                        <th>Acciones</th>
                                    </tr>
                                </thead>

                                @php
                                    use Carbon\Carbon;
                                @endphp
                                <tbody>
                                    @foreach ($activities as $activity)
                                        <tr>

                                            <td>{{ $activity->id }}</td>
                                            <td>{{ $activity->description }}</td>
                                            <td>{{ \Carbon\Carbon::parse($activity->start_date)->format('d-m-Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($activity->end_date)->format('d-m-Y') }}</td>
                                            <td>{{ $activity->activityType->name }}</td>
                                            <td>{{ $activity->maintenance->code }}</td>

                                            <td>
                                                <form action="{{ route('activities.destroy', $activity->id) }}"
                                                    method="POST">
                                                    @can('read activities')
                                                        <a class="btn btn-sm btn-primary "
                                                            href="{{ route('activities.show', $activity->id) }}"><i
                                                                class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}</a>
                                                    @endcan

                                                    @can('update activities')
                                                        <a class="btn btn-sm btn-success"
                                                            href="{{ route('activities.edit', $activity->id) }}"><i
                                                                class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    @endcan
                                                    @csrf
                                                    @method('DELETE')

                                                    @can('delete activities')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="event.preventDefault(); confirm('Estas seguro que quieres borrar?') ? this.closest('form').submit() : false;"><i
                                                                class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                                    @endcan
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $activities->links() !!}
            </div>
        </div>
    </div>
@endsection
