@extends('adminlte::page')

@section('template_title')
    {{ $computer->name ?? __('Show') . " " . __('Computer') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Computer</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('computers.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">

                                <div class="form-group mb-2 mb20">
                                    <strong>Name:</strong>
                                    {{ $computer->name }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Description:</strong>
                                    {{ $computer->description }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Serial Number:</strong>
                                    {{ $computer->serial_number }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Mac Address:</strong>
                                    {{ $computer->mac_address }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Adquisition Date:</strong>
                                    {{ $computer->adquisition_date }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Status:</strong>
                                    {{ $computer->status }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Brand Id:</strong>
                                    {{ $computer->brand_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Pc Model Id:</strong>
                                    {{ $computer->pc_model_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Ubications Id:</strong>
                                    {{ $computer->ubications_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Pc Type Id:</strong>
                                    {{ $computer->pc_type_id }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
