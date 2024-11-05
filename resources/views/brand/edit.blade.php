@extends('adminlte::page')

@section('template_title')
    {{ __('Update') }} Brand
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Editar') }} Marca</span>

                        <div class="float-right">
                            <a href="{{ route('brands.index') }}" class="btn btn-primary btn-sm float-right"
                                data-placement="left">
                                {{ __('Regresar') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('brands.update', $brand->id) }}" role="form"
                            enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('brand.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
