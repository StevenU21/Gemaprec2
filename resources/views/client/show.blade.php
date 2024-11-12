@extends('adminlte::page')

@section('template_title')
    {{ $client->name ?? __('Show') . " " . __('Client') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Mostrar') }} Cliente</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('clients.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">

                                <div class="form-group mb-2 mb20">
                                    <strong>Nombre:</strong>
                                    {{ $client->name }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Correo:</strong>
                                    {{ $client->email }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Telefono:</strong>
                                    {{ $client->phone }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Dirección:</strong>
                                    {{ $client->address }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Ciudad:</strong>
                                    {{ $client->city }}
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
