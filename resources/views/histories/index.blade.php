@extends('adminlte::page')

@section('template_title')
    Historial
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">Historial</h3>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col"><i class="fas fa-hashtag"></i> ID</th>
                                <th scope="col"><i class="fas fa-toggle-on"></i> Empleado</th>
                                <th scope="col"><i class="fas fa-toggle-on"></i> Acción</th>
                                <th scope="col"><i class="fas fa-toggle-on"></i> Tabla</th>
                                <th scope="col"><i class="fas fa-toggle-on"></i> Descripción</th>
                                <th scope="col"><i class="fas fa-calendar-alt"></i> Fecha de Registro</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($histories as $history)
                                <tr>
                                    <td>
                                        <span class="badge badge-pill badge-primary">{{ $history->id }}</span>
                                    </td>
                                    <td>{{ $history->causer->name }}</td>
                                    <td>{{ $history->description }}</td>
                                    <td>{{ class_basename($history->subject_type) }}</td>
                                    <td>
                                        @empty($history->old)
                                        @else
                                            <strong>Old:</strong>
                                            <ul>
                                                @foreach ($history->old as $key => $value)
                                                    <li>{{ $key }}: {{ $value }}</li>
                                                @endforeach
                                            </ul>
                                        @endempty

                                        @empty($history->new)
                                        @else
                                            <strong>New:</strong>
                                            <ul>
                                                @foreach ($history->new as $key => $value)
                                                    @if (isset($history->old[$key]) && $history->old[$key] != $value)
                                                        <li><strong>{{ $key }}: {{ $value }}</strong></li>
                                                    @else
                                                        <li>{{ $key }}: {{ $value }}</li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        @endempty
                                    </td>
                                    <td>{{ $history->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <nav aria-label="...">
                        {{ $histories->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
