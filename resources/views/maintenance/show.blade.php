@extends('adminlte::page')

@section('template_title')
    {{ $maintenance->name ?? __('Show') . ' ' . __('Maintenance') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Maintenance</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('maintenances.index') }}">
                                {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">

                        <div class="form-group mb-2 mb20">
                            <strong>Description:</strong>
                            {{ $maintenance->description }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Start Date:</strong>
                            {{ $maintenance->start_date }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>End Date:</strong>
                            {{ $maintenance->end_date }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Observations:</strong>
                            {{ $maintenance->observations }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Status:</strong>
                            {{ $maintenance->status }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Computer Id:</strong>
                            {{ $maintenance->computer_id }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>User Id:</strong>
                            {{ $maintenance->user_id }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Maintenance Type Id:</strong>
                            {{ $maintenance->maintenance_type_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
