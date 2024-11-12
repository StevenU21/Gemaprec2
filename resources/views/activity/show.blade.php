@extends('adminlte::page')

@section('template_title')
    {{ $activity->name ?? __('Mostrar') . ' ' . __('Actividad') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Mostrar') }} Actividad</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('activities.index') }}"> {{ __('Volver') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">

                        <div class="form-group mb-2 mb20">
                            <strong>Descripción:</strong>
                            {{ $activity->description }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Tipo:</strong>
                            {{ $activity->activityType->name }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Fecha de Inicio:</strong>
                            {{ $activity->start_date }}
                        </div>

                        <div class="form-group mb-2 mb20">
                            <strong>Fecha de Finalización:</strong>
                            {{ $activity->end_date }}
                        </div>

                        <div class="form-group mb-2 mb20">
                            <strong>Mantenimiento:</strong>
                            {{ $activity->maintenance->code . ' - ' . $activity->maintenance->computer->name . ' - ' . $activity->maintenance->computer->client->user->name }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
