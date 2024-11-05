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
                                {{ __('Activities') }}
                            </span>

                            <div class="float-right">
                                @can('create activities')
                                    <a href="{{ route('activities.create') }}" class="btn btn-primary btn-sm float-right"
                                        data-placement="left">
                                        {{ __('Create New') }}
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
                                <tbody>
                                    @foreach ($activities as $activity)
                                        <tr>

                                            <td>{{ $activity->id }}</td>
                                            <td>{{ $activity->description }}</td>
                                            <td>{{ $activity->start_date }}</td>
                                            <td>{{ $activity->end_date }}</td>
                                            <td>{{ $activity->activityType->name }}</td>
                                            <td>{{ $activity->maintenance->code }}</td>

                                            <td>
                                                <form action="{{ route('activities.destroy', $activity->id) }}"
                                                    method="POST">
                                                    @can('read activities')
                                                        <a class="btn btn-sm btn-primary "
                                                            href="{{ route('activities.show', $activity->id) }}"><i
                                                                class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    @endcan

                                                    @can('update activities')
                                                        <a class="btn btn-sm btn-success"
                                                            href="{{ route('activities.edit', $activity->id) }}"><i
                                                                class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @endcan
                                                    @csrf
                                                    @method('DELETE')

                                                    @can('delete activities')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i
                                                                class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
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
