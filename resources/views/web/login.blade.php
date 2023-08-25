@extends('web.plantilla')
@section('contenido')

<!-- Contact Start -->
<div class="container-xxl py-6">
    <div class="container">
        <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <h1 class="display-5 mb-3">Login</h1>
            <p>Ingresa y disfruta las mejores hamburguesas.</p>
        </div>
        <div class="row g-5 justify-content-center">
            <div class="col-lg-7 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                <form action="" method="POST">
                    @csrf
                    @if(isset($msg))
                        <div class="row g-3">
                            <div class="alert alert-danger" role="alert">
                                {{ $msg }}
                            </div>
                        </div>
                    @endif
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="txtCorreo" name="txtCorreo" placeholder="Correo" required>
                                <label for="txtCorreo">Correo</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="password" class="form-control" id="txtClave" name="txtClave" required>
                                <label for="txtClave">Clave</label>
                            </div>
                        </div>
                        <div class="col-12">
                                <button class="btn btn-primary rounded-pill py-3 px-5" type="submit">Ingresar</button>
                                <a href="/take-away"> </a>
                                <a href="/registrarse"> ¡No tenes cuenta? <span>Registrate</span>.</a>
                                <a href="/olvide-clave"> Recupera tú contraseña acá!</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->
@endsection
