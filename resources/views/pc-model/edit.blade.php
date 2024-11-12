@extends('adminlte::page')

@section('template_title')
    {{ __('Update') }} Pc Model
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Editar') }} Modelos de PC</span>

                        <div class="float-right">
                            <a href="{{ route('pc-models.index') }}" class="btn btn-primary btn-sm float-right"
                                data-placement="left">
                                {{ __('Regresar') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('pc-models.update', $pcModel->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('pc-model.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
