@section('contenido')
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Burger</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Lora:wght@600;700&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="web/lib/animate/animate.min.css" rel="stylesheet">
    <link href="web/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="web/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="web/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <div class="container-fluid fixed-top px-0 wow fadeIn" data-wow-delay="0.1s">

        <nav class="navbar navbar-expand-lg navbar-light py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
            <a href="http://127.0.0.1:8000/" class="navbar-brand ms-4 ms-lg-0">
                <h1 class="fw-bold text-primary m-0">B<span class="text-secondary">urgue</span>r</h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="/" class="nav-item nav-link active">Inicio</a>
                    <a href="/nosotros" class="nav-item nav-link">Nosotros</a>
                    <a href="/take-away" class="nav-item nav-link">Take away</a>
                    <a href="/contacto" class="nav-item nav-link">Contacto</a>
                    @if(!Session::get("idcliente"))
                    <a href="/login" class="nav-item nav-link">Ingresar</a>
                    @else
                    <a href="/logout" class="nav-item nav-link">Cerrar sesión</a>
                    @endif
                </div>
                @if(Session::get("idcliente"))
                <div class="d-none d-lg-flex ms-2">
                    <a class="btn-sm-square bg-white rounded-circle ms-3" href="/mi-cuenta">
                        <small class="fa fa-user text-body"></small>
                    </a>
                    <a class="btn-sm-square bg-white rounded-circle ms-3" href="/carrito">
                        <small class="fa fa-shopping-bag text-body"></small>
                    </a>
                </div>
                 @endif
            </div>
        </nav>
    </div>
    <!-- Navbar End -->
      @yield('contenido')

<!-- Footer Start -->
<div class="container-fluid bg-dark footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-4 col-md-6">
                <h1 class="fw-bold text-primary mb-4">B<span class="text-secondary">urgue</span>r</h1>
                <p>Burguer</p>
            </div>
            @if(isset($aSucursales) && count($aSucursales) > 0)
                @foreach($aSucursales as $sucursal)
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-light mb-4">{{ $sucursal->nombre }}</h4>
                    <p><i class="fa fa-map-marker-alt me-3"></i>{{ $sucursal->direccion }}</p>
                    <p><i class="fa fa-phone-alt me-3"></i>{{ $sucursal->telefono }}</p>
                    <p><i class="fa fa-calendar me-3"></i>{{ $sucursal->horario }}</p>
                    <p><i class="fa fa-map me-3"></i><a href="{{ $sucursal->linkmapa }}">Link mapa</a></p>
                </div>
                @endforeach
            @else
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-light mb-4">Sucursales</h4>
                    <p>No hay sucursales disponibles en este momento.</p>
                </div>
            @endif
            <div class="col-lg-4 col-md-6">
                <h4 class="text-light mb-4">Enlaces Rapidos</h4>
                <a class="btn btn-link" href="/nosotros">Nosotros</a>
                <a class="btn btn-link" href="/contacto">Contacto</a>
                <a class="btn btn-link" href="/take-away">Take-Away</a>
                <a class="btn btn-link" href="/mi-cuenta">Mi cuenta</a>
                <a class="btn btn-link" href="/carrito">Carrito</a>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="web/lib/wow/wow.min.js"></script>
    <script src="web/lib/easing/easing.min.js"></script>
    <script src="web/lib/waypoints/waypoints.min.js"></script>
    <script src="web/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="web/js/main.js"></script>
</body>

</html>
