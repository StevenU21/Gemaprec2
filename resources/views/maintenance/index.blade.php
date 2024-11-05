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
                                {{ __('Maintenances') }}
                            </span>

                            @can('create maintenances')
                                <div class="float-right">
                                    <a href="{{ route('maintenances.create') }}" class="btn btn-primary btn-sm float-right"
                                        data-placement="left">
                                        {{ __('Create New') }}
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
                                        <th>Code</th>
                                        <th>Description</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Observations</th>
                                        <th>Status</th>
                                        <th>Computer</th>
                                        <th>Maintenance Type</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($maintenances as $maintenance)
                                        <tr>
                                            <td>{{ $maintenance->id }}</td>
                                            <td>{{ $maintenance->code }}</td>
                                            <td>{{ $maintenance->description }}</td>
                                            <td>{{ $maintenance->start_date }}</td>
                                            <td>{{ $maintenance->end_date }}</td>
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
                                                                class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    @endcan

                                                    @can('update maintenances')
                                                        <a class="btn btn-sm btn-success"
                                                            href="{{ route('maintenances.edit', $maintenance->id) }}"><i
                                                                class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @endcan
                                                    @csrf
                                                    @method('DELETE')
                                                    @can('delete maintenances')
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
                            {!! $maintenances->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
