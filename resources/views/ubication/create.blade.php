@extends('adminlte::page')

@section('template_title')
    {{ __('Create') }} Ubication
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Crear') }} Ubicationes</span>

                        <div class="float-right">
                            <a href="{{ route('ubications.index') }}" class="btn btn-primary btn-sm float-right"
                                data-placement="left">
                                {{ __('Regresar') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('ubications.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('ubication.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
