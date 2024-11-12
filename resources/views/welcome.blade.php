<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gemaprec</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            color: #ffffff;
            background-color: #121212;
        }

        .wrapper {
            position: relative;
            z-index: 1;
        }

        #particles-js {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 0;
        }

        .main-header,
        .main-footer {
            background-color: #1f1f1f;
        }

        .jumbotron {
            background-color: transparent;
        }

        .navbar-brand,
        .nav-link,
        .jumbotron-heading,
        .lead,
        h2,
        p {
            color: #ffffff;
        }

        .feature-item i {
            font-size: 2rem;
            color: #ffffff;
        }
    </style>
</head>

<body>
    <div id="particles-js"></div>
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-dark">
            <div class="container">
                <a href="#" class="navbar-brand">
                    <span class="brand-text font-weight-light">Gemaprec</span>
                </a>
                <button class="navbar-toggler order-1" type="button" data-toggle="collapse"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#about">Acerca de</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#features">Características</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">Contacto</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Jumbotron -->
        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">Bienvenido a Gemaprec</h1>
                <p class="lead text-muted">Tu solución definitiva para gestionar y rastrear tus proyectos de manera
                    eficiente.</p>
                <p>
                    @if (Auth::check())
                        <a href="/home" class="btn btn-primary my-2">Ir a Inicio</a>
                    @else
                        <a href="/register" class="btn btn-primary my-2">Comenzar</a>
                        <a href="/login" class="btn btn-secondary my-2">Iniciar Sesión</a>
                    @endif
                </p>
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="py-5">
            <div class="container">
                <h2>Acerca de Gemaprec</h2>
                <p>Gemaprec es una herramienta integral de gestión de proyectos diseñada para ayudarte a optimizar tu
                    flujo de trabajo y aumentar la productividad, enfocándose en tareas de mantenimiento preventivo y
                    correctivo para un rendimiento óptimo.</p>
            </div>
        </section>

        <!-- Features Section with Icons -->
        <section id="features" class="py-5" style="background-color: #1f1f1f;">
            <div class="container">
                <h2 class="text-center mb-4" style="color: #ffffff;">Características</h2>
                <div id="feature-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">
                                <div class="col-md-3 feature-item text-center">
                                    <i class="fas fa-tasks" style="color: #ff6f61;"></i>
                                    <h5 style="color: #ffffff;">Gestión de Tareas</h5>
                                    <p style="color: #d3d3d3;">Organiza y asigna tareas de mantenimiento con facilidad.
                                    </p>
                                </div>
                                <div class="col-md-3 feature-item text-center">
                                    <i class="fas fa-clock" style="color: #6fa3ef;"></i>
                                    <h5 style="color: #ffffff;">Seguimiento del Tiempo</h5>
                                    <p style="color: #d3d3d3;">Monitorea el tiempo dedicado a cada tarea para una mejor
                                        eficiencia.</p>
                                </div>
                                <div class="col-md-3 feature-item text-center">
                                    <i class="fas fa-users" style="color: #f7c548;"></i>
                                    <h5 style="color: #ffffff;">Herramientas de Colaboración</h5>
                                    <p style="color: #d3d3d3;">Trabaja junto con los miembros del equipo en cada
                                        proyecto.</p>
                                </div>
                                <div class="col-md-3 feature-item text-center">
                                    <i class="fas fa-chart-line" style="color: #4caf50;"></i>
                                    <h5 style="color: #ffffff;">Informes y Análisis</h5>
                                    <p style="color: #d3d3d3;">Rastrea el progreso con informes detallados y análisis.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Add more carousel items here for more features -->
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="py-5">
            <div class="container">
                <h2>Contáctanos</h2>
                <p>Si tienes alguna pregunta o necesitas soporte, no dudes en <a
                        href="mailto:support@gemaprec.com">contactarnos</a>.</p>
            </div>
        </section>

        <!-- Footer -->
        <footer class="main-footer text-center">
            <div class="container">
                <p>&copy; 2024 Gemaprec. Todos los derechos reservados.</p>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script>
        particlesJS('particles-js', {
            "particles": {
                "number": {
                    "value": 80,
                    "density": {
                        "enable": true,
                        "value_area": 800
                    }
                },
                "color": {
                    "value": "#ffffff"
                },
                "shape": {
                    "type": "circle",
                    "stroke": {
                        "width": 0,
                        "color": "#000000"
                    },
                    "polygon": {
                        "nb_sides": 5
                    },
                    "image": {
                        "src": "img/github.svg",
                        "width": 100,
                        "height": 100
                    }
                },
                "opacity": {
                    "value": 0.5,
                    "random": false,
                    "anim": {
                        "enable": false,
                        "speed": 1,
                        "opacity_min": 0.1,
                        "sync": false
                    }
                },
                "size": {
                    "value": 3,
                    "random": true,
                    "anim": {
                        "enable": false,
                        "speed": 40,
                        "size_min": 0.1,
                        "sync": false
                    }
                },
                "line_linked": {
                    "enable": true,
                    "distance": 150,
                    "color": "#ffffff",
                    "opacity": 0.4,
                    "width": 1
                },
                "move": {
                    "enable": true,
                    "speed": 6,
                    "direction": "none",
                    "random": false,
                    "straight": false,
                    "out_mode": "out",
                    "bounce": false,
                    "attract": {
                        "enable": false,
                        "rotateX": 600,
                        "rotateY": 1200
                    }
                }
            },
            "interactivity": {
                "detect_on": "canvas",
                "events": {
                    "onhover": {
                        "enable": true,
                        "mode": "repulse"
                    },
                    "onclick": {
                        "enable": true,
                        "mode": "push"
                    },
                    "resize": true
                },
                "modes": {
                    "grab": {
                        "distance": 400,
                        "line_linked": {
                            "opacity": 1
                        }
                    },
                    "bubble": {
                        "distance": 400,
                        "size": 40,
                        "duration": 2,
                        "opacity": 8,
                        "speed": 3
                    },
                    "repulse": {
                        "distance": 200,
                        "duration": 0.4
                    },
                    "push": {
                        "particles_nb": 4
                    },
                    "remove": {
                        "particles_nb": 2
                    }
                }
            },
            "retina_detect": true
        });
    </script>
</body>

</html>
