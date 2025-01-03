@extends('adminlte::page')

@section('template_title')
    {{ __('Update') }} Maintenance Type
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Editar') }} Tipos de Mantenimiento</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('maintenance-types.update', $maintenanceType->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('maintenance-type.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
