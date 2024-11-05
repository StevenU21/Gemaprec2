<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gemaprec</title>
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://adminlte.io/themes/v3/dist/css/adminlte.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-dark navbar-dark">
            <div class="container">
                <a href="#" class="navbar-brand">
                    <span class="brand-text font-weight-light">Gemaprec</span>
                </a>
                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#features">Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <div class="container">
                        <section class="jumbotron text-center mt-5">
                        <div class="container">
                            <h1 class="jumbotron-heading">Welcome to Gemaprec</h1>
                            <p class="lead text-muted">Your ultimate solution for managing and tracking your projects efficiently.</p>
                            <p>
                                @if (Auth::check())
                                    <a href="/home" class="btn btn-primary my-2">Go to Home</a>
                                @else
                                    <a href="/register" class="btn btn-primary my-2">Get Started</a>
                                    <a href="/login" class="btn btn-secondary my-2">Login</a>
                                @endif
                            </p>
                        </div>
                    </section>
                    <section id="about" class="py-5">
                        <div class="container">
                            <h2>About Gemaprec</h2>
                            <p>Gemaprec is a comprehensive project management tool designed to help you streamline your workflow and increase productivity.</p>
                        </div>
                    </section>
                    <section id="features" class="py-5 bg-light">
                        <div class="container">
                            <h2>Features</h2>
                            <ul>
                                <li>Task Management</li>
                                <li>Time Tracking</li>
                                <li>Collaboration Tools</li>
                                <li>Reporting and Analytics</li>
                            </ul>
                        </div>
                    </section>
                    <section id="contact" class="py-5">
                        <div class="container">
                            <h2>Contact Us</h2>
                            <p>If you have any questions or need support, feel free to <a href="mailto:support@gemaprec.com">contact us</a>.</p>
                        </div>
                    </section>
                </div>
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer text-center">
            <div class="container">
                <p>&copy; 2024 Gemaprec. All rights reserved.</p>
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://adminlte.io/themes/v3/dist/js/adminlte.min.js"></script>
</body>

</html>
