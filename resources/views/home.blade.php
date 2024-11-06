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

        @role('admin')
            <div class="container mt-4">
                <div class="row mb-4">
                    <div class="col-md-3">
                        <button id="btnPieChart" class="btn btn-primary btn-block">Pie Chart</button>
                    </div>
                    <div class="col-md-3">
                        <button id="btnBarChart" class="btn btn-secondary btn-block">Bar Chart</button>
                    </div>
                    <div class="col-md-3">
                        <button id="btnColumnChart" class="btn btn-success btn-block">Column Chart</button>
                    </div>
                    <div class="col-md-3">
                        <button id="btnGanttChart" class="btn btn-danger btn-block">Gantt Chart</button>
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

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div id="topEmployeesChart" style="height: 300px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div id="topClientsComputersChart" style="height: 300px;"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div id="maintenanceStatusChart" style="height: 300px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div id="maintenanceTypeCountsChart" style="height: 300px;"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div id="upcomingMaintenancesChart" style="height: 400px;"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div id="upcomingActivitiesChart" style="height: 600px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endrole

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Obtener los conteos de tipos de mantenimiento desde el servidor
            fetch('/maintenance-type-counts')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al obtener los conteos de tipos de mantenimiento');
                    }
                    return response.json();
                })
                .then(data => {
                    // Verificar los datos recibidos
                    console.log('Datos recibidos:', data);

                    // Procesar y mapear los datos
                    const maintenanceTypes = data.map((item, index) => ({
                        name: item.type,
                        y: item.count,
                        color: Highcharts.getOptions().colors[index % Highcharts.getOptions().colors
                            .length]
                    }));

                    // Verificar los datos mapeados
                    console.log('Datos mapeados:', maintenanceTypes);

                    // Configurar y renderizar el gráfico de columnas
                    Highcharts.chart('maintenanceTypeCountsChart', {
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Conteo de Tipos de Mantenimiento'
                        },
                        xAxis: {
                            type: 'category',
                            title: {
                                text: 'Tipos de Mantenimiento'
                            }
                        },
                        yAxis: {
                            title: {
                                text: 'Número de Mantenimientos'
                            }
                        },
                        series: [{
                            name: 'Mantenimientos',
                            data: maintenanceTypes
                        }],
                        tooltip: {
                            pointFormatter: function() {
                                return `<span>${this.name}</span><br/>
                                        <b>Mantenimientos:</b> ${this.y}`;
                            }
                        }
                    });
                })
                .catch(error => console.error('Error al procesar los conteos de tipos de mantenimiento:', error));
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Obtener los conteos de mantenimientos por estado desde el servidor
            fetch('/maintenance-counts')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al obtener los conteos de mantenimientos');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Datos recibidos:', data);

                    const colors = ['#FF0000', '#FFFF00', '#008000'];

                    Highcharts.chart('maintenanceStatusChart', {
                        chart: {
                            type: 'pie'
                        },
                        title: {
                            text: 'Conteo de Mantenimientos por Estado'
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        accessibility: {
                            point: {
                                valueSuffix: '%'
                            }
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
                            name: 'Mantenimientos',
                            colorByPoint: true,
                            data: [{
                                name: 'Pending',
                                y: data.pending,
                                color: colors[0] // Rojo
                            }, {
                                name: 'In Progress',
                                y: data.in_progress,
                                color: colors[1] // Amarillo
                            }, {
                                name: 'Completed',
                                y: data.completed,
                                color: colors[2] // Verde
                            }]
                        }]
                    });
                })
                .catch(error => console.error('Error al procesar los conteos de mantenimientos:', error));
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Obtener los clientes con más computadoras desde el servidor
            fetch('/top-clients-computers')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al obtener los clientes');
                    }
                    return response.json();
                })
                .then(data => {
                    // Verificar los datos recibidos
                    console.log('Datos recibidos:', data);

                    // Procesar y mapear los datos
                    const clients = data.map((item, index) => ({
                        name: item.clientName,
                        y: item.computerCount,
                        color: Highcharts.getOptions().colors[index % Highcharts.getOptions().colors
                            .length]
                    }));

                    // Verificar los datos mapeados
                    console.log('Datos mapeados:', clients);

                    // Configurar y renderizar el gráfico de columnas
                    Highcharts.chart('topClientsComputersChart', {
                        chart: {
                            type: 'bar'
                        },
                        title: {
                            text: 'Top 5 Clientes con más Computadoras'
                        },
                        xAxis: {
                            type: 'category',
                            title: {
                                text: 'Clientes'
                            }
                        },
                        yAxis: {
                            title: {
                                text: 'Número de Computadoras'
                            }
                        },
                        series: [{
                            name: 'Computadoras',
                            data: clients
                        }],
                        tooltip: {
                            pointFormatter: function() {
                                return `<span>${this.name}</span><br/>
                                        <b>Computadoras:</b> ${this.y}`;
                            }
                        }
                    });
                })
                .catch(error => console.error('Error al procesar los clientes:', error));
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Obtener los empleados con más clientes registrados desde el servidor
            fetch('/top-employees')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al obtener los empleados');
                    }
                    return response.json();
                })
                .then(data => {
                    // Contar y mostrar el número de empleados capturados
                    console.log('Número de empleados capturados:', data.length);

                    //numero de mantenimientos capturados
                    console.log('Número de mantenim capturados:', data.length);

                    // Procesar y mapear los datos
                    const employees = data.map((item, index) => ({
                        name: item.employee.name,
                        y: item.clientCount,
                        color: Highcharts.getOptions().colors[index % Highcharts.getOptions().colors
                            .length]
                    }));

                    // Configurar y renderizar el gráfico de columnas
                    Highcharts.chart('topEmployeesChart', {
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Top 5 Empleados con más Clientes Registrados'
                        },
                        xAxis: {
                            type: 'category',
                            title: {
                                text: 'Empleados'
                            }
                        },
                        yAxis: {
                            title: {
                                text: 'Número de Clientes Registrados'
                            }
                        },
                        series: [{
                            name: 'Clientes Registrados',
                            data: employees
                        }],
                        tooltip: {
                            pointFormatter: function() {
                                return `<span>${this.name}</span><br/>
                                        <b>Clientes Registrados:</b> ${this.y}`;
                            }
                        }
                    });
                })
                .catch(error => console.error('Error al procesar los empleados:', error));
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Obtener los mantenimientos desde el servidor
            fetch('/upcoming-maintenances')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al obtener los mantenimientos');
                    }
                    return response.json();
                })
                .then(data => {
                    // Contar y mostrar el número de mantenimientos capturados
                    console.log('Número de mantenimientos capturados:', data.length);

                    // Procesar y mapear los datos
                    const maintenances = data.map((maintenance, index) => ({
                        id: 'maintenance-' + index,
                        name: maintenance.description,
                        start: Date.parse(maintenance.start_date),
                        end: Date.parse(maintenance.end_date),
                        color: Highcharts.getOptions().colors[index % Highcharts.getOptions().colors
                            .length]
                    }));

                    // Configurar y renderizar el gráfico de Gantt
                    Highcharts.ganttChart('upcomingMaintenancesChart', {
                        chart: {
                            height: maintenances.length *
                                40 // Ajustar la altura del gráfico según el número de mantenimientos
                        },
                        title: {
                            text: 'Próximos Mantenimientos'
                        },
                        xAxis: {
                            min: Date.now(), // Fecha actual
                            max: new Date(new Date().setFullYear(new Date().getFullYear(), 11, 31))
                                .getTime() // 31 de diciembre
                        },
                        series: [{
                            name: 'Mantenimientos',
                            data: maintenances
                        }],
                        tooltip: {
                            pointFormatter: function() {
                                return `<span>${this.name}</span><br/>
                                        <b>Inicio:</b> ${Highcharts.dateFormat('%e %b %Y', this.start)}<br/>
                                        <b>Fin:</b> ${Highcharts.dateFormat('%e %b %Y', this.end)}`;
                            }
                        }
                    });
                })
                .catch(error => console.error('Error al procesar los mantenimientos:', error));
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Obtener las actividades desde el servidor
            fetch('/upcoming-activities')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al obtener las actividades');
                    }
                    return response.json();
                })
                .then(data => {
                    // Contar y mostrar el número de actividades capturadas
                    console.log('Número de actividades capturadas:', data.length);

                    // Procesar y mapear los datos
                    const activities = data.map((activity, index) => ({
                        id: 'activity-' + index,
                        name: activity.description,
                        start: Date.parse(activity.start_date),
                        end: Date.parse(activity.end_date),
                        color: Highcharts.getOptions().colors[index % Highcharts.getOptions().colors
                            .length]
                    }));

                    // Configurar y renderizar el gráfico de Gantt
                    Highcharts.ganttChart('upcomingActivitiesChart', {
                        chart: {
                            height: activities.length *
                                40 // Ajustar la altura del gráfico según el número de actividades
                        },
                        title: {
                            text: 'Próximas Actividades'
                        },
                        xAxis: {
                            min: Date.now(), // Fecha actual
                            max: new Date(new Date().setFullYear(new Date().getFullYear(), 11, 31))
                                .getTime() // 31 de diciembre
                        },
                        series: [{
                            name: 'Actividades',
                            data: activities
                        }],
                        tooltip: {
                            pointFormatter: function() {
                                return `<span>${this.name}</span><br/>
                                        <b>Inicio:</b> ${Highcharts.dateFormat('%e %b %Y', this.start)}<br/>
                                        <b>Fin:</b> ${Highcharts.dateFormat('%e %b %Y', this.end)}`;
                            }
                        }
                    });
                })
                .catch(error => console.error('Error al procesar las actividades:', error));
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Obtener las actividades desde el servidor
            fetch('/upcoming-activities')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al obtener las actividades');
                    }
                    return response.json();
                })
                .then(data => {
                    // Contar y mostrar el número de actividades capturadas
                    console.log('Número de actividades capturadas:', data.length);

                    // Procesar y mapear los datos
                    const activities = data.map((activity, index) => ({
                        id: 'activity-' + index,
                        name: activity.description,
                        start: Date.parse(activity.start_date),
                        end: Date.parse(activity.end_date),
                        color: Highcharts.getOptions().colors[index % Highcharts.getOptions().colors
                            .length]
                    }));

                    // Configurar y renderizar el gráfico de Gantt
                    Highcharts.ganttChart('upcomingActivitiesChart', {
                        chart: {
                            height: activities.length *
                                40 // Ajustar la altura del gráfico según el número de actividades
                        },
                        title: {
                            text: 'Próximas Actividades'
                        },
                        xAxis: {
                            min: Date.now(), // Fecha actual
                            max: new Date(new Date().setFullYear(new Date().getFullYear(), 11, 31))
                                .getTime() // 31 de diciembre
                        },
                        series: [{
                            name: 'Actividades',
                            data: activities
                        }],
                        tooltip: {
                            pointFormatter: function() {
                                return `<span>${this.name}</span><br/>
                                        <b>Inicio:</b> ${Highcharts.dateFormat('%e %b %Y', this.start)}<br/>
                                        <b>Fin:</b> ${Highcharts.dateFormat('%e %b %Y', this.end)}`;
                            }
                        }
                    });
                })
                .catch(error => console.error('Error al procesar las actividades:', error));
        });
    </script>
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
                            type: 'bar'
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
