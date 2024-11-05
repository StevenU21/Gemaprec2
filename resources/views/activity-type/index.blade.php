@extends('adminlte::page')

@section('template_title')
    Activity Types
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Activity Types') }}
                            </span>

                            @role('admin')
                                <div class="float-right">
                                    <a href="{{ route('activity-types.create') }}" class="btn btn-primary btn-sm float-right"
                                        data-placement="left">
                                        {{ __('Create New') }}
                                    </a>
                                </div>
                            @endrole
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
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Fecha de Registro</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($activityTypes as $activityType)
                                        <tr>
                                            <td>{{ $activityType->id }}</td>
                                            <td>{{ $activityType->name }}</td>
                                            <td>{{ $activityType->description }}</td>
                                            <td>{{ $activityType->created_at->format('d-m-Y') }}</td>

                                            <td>
                                                <form
                                                    action="{{ route('activity-types.destroy', $activityType->id) }} "method="POST">
                                                    @can('read brands')
                                                        <a class="btn btn-sm btn-primary "
                                                            href="{{ route('activity-types.show', $activityType->id) }}"><i
                                                                class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    @endcan

                                                    @role('admin')
                                                        <a class="btn btn-sm btn-success"
                                                            href="{{ route('activity-types.edit', $activityType->id) }}"><i
                                                                class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>

                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i
                                                                class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                    @endrole
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {!! $activityTypes->links() !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
