@extends('adminlte::page')

@section('template_title')
    Pc Types
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Tipo de PC') }}
                            </span>

                            @role('admin')
                                <div class="float-right">
                                    <a href="{{ route('pc-types.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                        {{ __('Crear Nuevo') }}
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
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Fecha de Registro</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pcTypes as $pcType)
                                        <tr>
                                            <td>{{ $pcType->id }}</td>
                                            <td>{{ $pcType->name }}</td>
                                            <td>{{ $pcType->description }}</td>
                                            <td>{{ $pcType->created_at->format('d-m-Y') }}</td>
                                            <td>
                                                <form action="{{ route('pc-types.destroy', $pcType->id) }}" method="POST">
                                                    @can('read pc_types')
                                                        <a class="btn btn-sm btn-primary" href="{{ route('pc-types.show', $pcType->id) }}">
                                                            <i class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}
                                                        </a>
                                                    @endcan

                                                    @role('admin')
                                                        <a class="btn btn-sm btn-success" href="{{ route('pc-types.edit', $pcType->id) }}">
                                                            <i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}
                                                        </a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;">
                                                            <i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}
                                                        </button>
                                                    @endrole
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {!! $pcTypes->links() !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
