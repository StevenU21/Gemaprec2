@extends('adminlte::page')

@section('template_title')
    {{ $report->name ?? __('Show') . ' ' . __('Report') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Report</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('reports.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">

                        <div class="form-group mb-2 mb20">
                            <strong>Name:</strong>
                            {{ $report->code }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Description:</strong>
                            <ul>
                                @foreach (explode("\n", $report->description) as $line)
                                    <li>{{ $line }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="form-group mb-2 mb20">
                            <strong>Status:</strong>
                            {{ $report->maintenance->status }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Cliente:</strong>
                            {{ $report->client->user->name }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Mantenimiento:</strong>
                            {{ $report->maintenance->code }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
