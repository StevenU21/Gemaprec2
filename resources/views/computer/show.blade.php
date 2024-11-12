@extends('adminlte::page')

@section('template_title')
    {{ $computer->name ?? __('Mostrar') . ' ' . __('Computadora') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Mostrar') }} Computadora</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('computers.index') }}"> {{ __('Volver') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">

                        <div class="form-group mb-2 mb20">
                            <strong>Nombre:</strong>
                            {{ $computer->name }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Descripción:</strong>
                            {{ $computer->description }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Número de Serie:</strong>
                            {{ $computer->serial_number }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Dirección MAC:</strong>
                            {{ $computer->mac_address }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Fecha de Adquisición:</strong>
                            {{ $computer->adquisition_date }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Estado:</strong>
                            {{ $computer->status }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Marca:</strong>
                            {{ $computer->brand_id }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Modelo de PC:</strong>
                            {{ $computer->pc_model_id }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Ubicación:</strong>
                            {{ $computer->ubications_id }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Tipo de PC:</strong>
                            {{ $computer->pc_type_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
