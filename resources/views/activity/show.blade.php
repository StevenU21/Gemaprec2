@extends('adminlte::page')

@section('template_title')
    {{ $activity->name ?? __('Show') . ' ' . __('Activity') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Activity</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('activities.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">

                        <div class="form-group mb-2 mb20">
                            <strong>Message:</strong>
                            {{ $activity->message }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Type:</strong>
                            {{ $activity->type }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Fecha de Inicio:</strong>
                            {{ $activity->start_date }}
                        </div>

                        <div class="form-group mb-2 mb20">
                            <strong>Fecha de Finalizacion:</strong>
                            {{ $activity->end_date }}
                        </div>
                        
                        <div class="form-group mb-2 mb20">
                            <strong>User Id:</strong>
                            {{ $activity->user_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
