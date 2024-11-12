@extends('adminlte::page')

@section('template_title')
    {{ __('Create') }} Computer
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Crear') }} Computadora</span>

                        <div class="float-right">
                            <a href="{{ route('computers.index') }}" class="btn btn-primary btn-sm float-right"
                                data-placement="left">
                                {{ __('Regresar') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('computers.store') }}" role="form"
                            enctype="multipart/form-data">
                            @csrf

                            @include('computer.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
