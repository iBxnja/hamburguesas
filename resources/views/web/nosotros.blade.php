@extends('web.plantilla')
@section('contenido')
    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <h1 class="display-3 mb-3 animated slideInDown">Nosotros</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a class="text-body" href="#">Inicio</a></li>
                    <li class="breadcrumb-item"><a class="text-body" href="#">Productos</a></li>
                    <li class="breadcrumb-item text-dark active" aria-current="page">Sobre Nosotros</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="about-img position-relative overflow-hidden p-5 pe-0">
                        <img class="img-fluid w-100" src="web/img/hamburguesa.jpg">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <h1 class="display-5 mb-4">Las mejores hamburguesas del universo</h1>
                    <p class="mb-4">Somos una hamburguesería con ganas de hacer las cosas de manera diferente. En este lugar vas a encontrar hamburguesas increíbles. Nuestras cocinas están siempre a la vista para que puedas ver el proceso de todo lo que comés. ¡Queremos que te sientas como en tu casa!</p>
                    <a class="btn btn-primary rounded-pill py-3 px-5 mt-3" href="/take-away">¡Pedí lo tuyo!</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid bg-light bg-icon py-6">
        <div class="container">
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                <div class="testimonial-item position-relative bg-white p-5 mt-4">
                    <i class="fa fa-quote-left fa-3x text-primary position-absolute top-0 start-0 mt-n4 ms-5"></i>
                    <p class="mb-4">Carnes verificadas de primera calidad.</p>
                </div>
                <div class="testimonial-item position-relative bg-white p-5 mt-4">
                    <i class="fa fa-quote-left fa-3x text-primary position-absolute top-0 start-0 mt-n4 ms-5"></i>
                    <p class="mb-4">Para las mejores hamburguesas, las mejores bebidas.</p>
                </div>
                <div class="testimonial-item position-relative bg-white p-5 mt-4">
                    <i class="fa fa-quote-left fa-3x text-primary position-absolute top-0 start-0 mt-n4 ms-5"></i>
                    <p class="mb-4">Los mejores locales de la ciudad.</p>
                </div>
                <div class="testimonial-item position-relative bg-white p-5 mt-4">
                    <i class="fa fa-quote-left fa-3x text-primary position-absolute top-0 start-0 mt-n4 ms-5"></i>
                    <p class="mb-4">Sabores como las comidas de la abuela.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- About End -->


    <!-- Firm Visit Start -->
    <div class="container-fluid bg-primary bg-icon mt-5 py-6">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-md-12 wow fadeIn" data-wow-delay="0.1s">
                    <h1 class="display-5 text-white text-center mb-3">Trabaja con nosotros</h1>
                    <p class="text-white text-center mb-0">Mandanos tus datos para contactarnos con vos.</p>
                </div>
                <div class="col-md-12 text-center wow fadeIn" data-wow-delay="0.5s">
                    <form  action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>    
                    <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="txtNombre" name="txtNombre" placeholder="Tu Nombre" required>
                                    <label for="txtNombre">Nombre</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="txtApellido" name="txtApellido" placeholder="Tu Apellido" required>
                                    <label for="txtApellido">Apellido</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="mail" class="form-control" id="txtCorreo" name="txtCorreo" placeholder="Tu correo" required>
                                    <label for="txtCorreo">Correo</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="tel" class="form-control" id="txtCelular" name="txtCelular" placeholder="Tu celular" required>
                                    <label for="txtCelular">Celular</label>
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-3">
                                <div class="form-floating">
                                    
                                    <div class="mb-3">
                                        <label for="archivoCV" class="form-label">
                                            <p class="text-white text-center mb-1">Envianos tu CV:</p>
                                        </label>
                                        <input class="form-control form-control-lg" type="file" id="archivoCV" name="archivoCV" accept=".pdf, .doc, .docx">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 text-center wow fadeIn" data-wow-delay="0.5s">
                                <button class="btn btn-lg btn-secondary rounded-pill py-3 px-5" id="btnEnviar" type="submit">Enviar datos</button>
                            </div>
                        </div>
                    </form>
                </div>                
            </div>
        </div>
    </div>
    <!-- Firm Visit End -->


    <!-- Feature Start -->
    
    <!-- Feature End -->
@endsection