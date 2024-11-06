@extends('adminlte::page')

@section('title', 'Bienvenido')

@section('content_header')
    <h1 class="m-0 text-dark">Bienvenido</h1>
@stop

@section('content')
    <div class="container-fluid bg-light">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center">
                        <h2 class="mb-3">¡Bienvenido a nuestro sistema!</h2>
                        <p class="mb-0">Estamos encantados de tenerte aquí. Explora las funcionalidades y aprovecha al
                            máximo
                            nuestra plataforma.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-4">
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <!-- Espacio para contenido futuro -->
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <!-- Espacio para contenido futuro -->
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <!-- Espacio para contenido futuro -->
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <!-- Espacio para contenido futuro -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div id="catalogCountsChart" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div id="anotherChart" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $.ajax({
                url: '/catalog-counts',
                method: 'GET',
                success: function(data) {
                    const colors = Highcharts.getOptions().colors;

                    Highcharts.chart('catalogCountsChart', {
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Contador de Tablas Catalogo'
                        },
                        xAxis: {
                            categories: ['Brands', 'PC Models', 'PC Types', 'Activity Types',
                                'Ubications', 'Maintenance Types'
                            ]
                        },
                        yAxis: {
                            title: {
                                text: 'Count'
                            }
                        },
                        series: [{
                            name: 'Counts',
                            data: [{
                                    y: data.brandCount,
                                    color: colors[0]
                                },
                                {
                                    y: data.pcModelCount,
                                    color: colors[1]
                                },
                                {
                                    y: data.pcTypeCount,
                                    color: colors[2]
                                },
                                {
                                    y: data.activityTypeCount,
                                    color: colors[3]
                                },
                                {
                                    y: data.ubicationsCount,
                                    color: colors[4]
                                },
                                {
                                    y: data.maintenanceTypeCount,
                                    color: colors[5]
                                }
                            ]
                        }]
                    });

                    Highcharts.chart('anotherChart', {
                        chart: {
                            type: 'pie'
                        },
                        title: {
                            text: 'Tablas Catalogo por Porcentaje'
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                                }
                            }
                        },
                        series: [{
                            name: 'Counts',
                            colorByPoint: true,
                            data: [{
                                    name: 'Brands',
                                    y: data.brandCount,
                                    color: colors[0]
                                },
                                {
                                    name: 'PC Models',
                                    y: data.pcModelCount,
                                    color: colors[1]
                                },
                                {
                                    name: 'PC Types',
                                    y: data.pcTypeCount,
                                    color: colors[2]
                                },
                                {
                                    name: 'Activity Types',
                                    y: data.activityTypeCount,
                                    color: colors[3]
                                },
                                {
                                    name: 'Ubications',
                                    y: data.ubicationsCount,
                                    color: colors[4]
                                },
                                {
                                    name: 'Maintenance Types',
                                    y: data.maintenanceTypeCount,
                                    color: colors[5]
                                }
                            ]
                        }]
                    });
                },
                error: function(error) {
                    console.error('Error fetching catalog counts:', error);
                }
            });
        });
    </script>
@stop
