@extends('adminlte::page')

@section('template_title')
    {{ $pcModel->name ?? __('Show') . ' ' . __('Pc Model') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Mostrar') }} Modelos de PC</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('pc-models.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">

                        <div class="form-group mb-2 mb20">
                            <strong>Nombre:</strong>
                            {{ $pcModel->name }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Descripción:</strong>
                            {{ $pcModel->description }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
