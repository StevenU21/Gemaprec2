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
                                <a href="{{ route('computers.create') }}" class="btn btn-primary btn-sm float-right"
                                    data-placement="left">
                                    {{ __('Crear Nuevo') }}
                                </a>
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

                                        <th>Name</th>
                                        <th>Descripción</th>
                                        <th>Número Serial</th>
                                        <th>Dirección Mac</th>
                                        <th>Fecha de Adquisión</th>
                                        <th>Estado</th>
                                        <th>Marca</th>
                                        <th>Modelo</th>
                                        <th>Tipo</th>
                                        <th>Cliente</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($computers as $computer)
                                        <tr>
                                            <td>{{ $computer->id }}</td>
                                            <td>{{ $computer->name }}</td>
                                            <td>{{ $computer->description }}</td>
                                            <td>{{ $computer->serial_number }}</td>
                                            <td>{{ $computer->mac_address }}</td>
                                            <td>{{ $computer->adquisition_date }}</td>
                                            <td>{{ $computer->status }}</td>
                                            <td>{{ $computer->brand->name }}</td>
                                            <td>{{ $computer->pcModel->name }}</td>
                                            <td>{{ $computer->pcType->name }}</td>
                                            <td>{{ $computer->client->user->name }}</td>

                                            <td>
                                                <form action="{{ route('computers.destroy', $computer->id) }}"
                                                    method="POST">
                                                    @can('read computers')
                                                        <a class="btn btn-sm btn-primary "
                                                            href="{{ route('computers.show', $computer->id) }}"><i
                                                                class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}</a>
                                                    @endcan
                                                    @can('update computers')
                                                        <a class="btn btn-sm btn-success"
                                                            href="{{ route('computers.edit', $computer->id) }}"><i
                                                                class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    @endcan
                                                    @csrf
                                                    @method('DELETE')
                                                    @can('delete computers')
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
                            {!! $computers->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
