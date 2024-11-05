@extends('adminlte::page')

@section('template_title')
    {{ __('Update') }} Pc Type
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Pc Type</span>

                        <div class="float-right">
                            <a href="{{ route('pc-types.index') }}" class="btn btn-primary btn-sm float-right"
                                data-placement="left">
                                {{ __('Regresar') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('pc-types.update', $pcType->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('pc-type.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
