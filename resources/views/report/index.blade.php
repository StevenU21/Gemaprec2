@extends('adminlte::page')
@section('template_title')
    Reports
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Reports') }}
                            </span>

                            <a href="{{ route('reports.exportAll') }}" class="btn btn-danger"> <i
                                    class="fas fa-file-excel"></i> Export All to Excel</a>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Code</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Client</th>
                                            <th>Mantenimiento</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reports as $report)
                                            <tr>
                                                <td>{{ $report->id }}</td>
                                                <td>{{ $report->code }}</td>
                                                <td>
                                                    <ul>
                                                        @foreach (explode("\n", $report->description) as $line)
                                                            <li>{{ Str::limit($line, 8) }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>{{ $report->maintenance->status }}</td>
                                                <td>{{ $report->client->user->name }}</td>
                                                <td>{{ $report->maintenance->code }}</td>
                                                <td>
                                                    <a class="btn btn-sm btn-primary"
                                                        href="{{ route('reports.show', $report->id) }}">
                                                        <i class="fa fa-fw fa-eye"></i> {{ __('Show') }}
                                                    </a>
                                                    <a href="{{ route('reports.export', $report->id) }}"
                                                        class="btn btn-sm btn-success">
                                                        <i class="fas fa-file-excel"></i> Export to Excel
                                                    </a>

                                                    <a href="{{ route('exports.reportPDF', $report->id) }}"
                                                        class="btn btn-sm btn-danger">
                                                        <i class="fas fa-file-pdf"></i> Export to PDF
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {!! $reports->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
