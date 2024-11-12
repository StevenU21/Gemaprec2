@extends('adminlte::page')

@section('template_title')
    {{ $maintenanceType->name ?? __('Show') . ' ' . __('Maintenance Type') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Mostrar') }} Tipos de Mantenimiento</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('maintenance-types.index') }}">
                                {{ __('Regresar') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">

                        <div class="form-group mb-2 mb20">
                            <strong>Nombe:</strong>
                            {{ $maintenanceType->name }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Descripción:</strong>
                            {{ $maintenanceType->description }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
