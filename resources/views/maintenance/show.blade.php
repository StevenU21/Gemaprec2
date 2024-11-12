@extends('adminlte::page')

@section('template_title')
    {{ $maintenance->name ?? __('Mostrar') . ' ' . __('Mantenimiento') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Mostrar') }} Mantenimiento</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('maintenances.index') }}">
                                {{ __('Volver') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">

                        <div class="form-group mb-2 mb20">
                            <strong>Descripción:</strong>
                            {{ $maintenance->description }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Fecha de Inicio:</strong>
                            {{ $maintenance->start_date }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Fecha de Finalización:</strong>
                            {{ $maintenance->end_date }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Observaciones:</strong>
                            {{ $maintenance->observations }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Estado:</strong>
                            {{ $maintenance->status }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>ID de Computadora:</strong>
                            {{ $maintenance->computer_id }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>ID de Usuario:</strong>
                            {{ $maintenance->user_id }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>ID de Tipo de Mantenimiento:</strong>
                            {{ $maintenance->maintenance_type_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
