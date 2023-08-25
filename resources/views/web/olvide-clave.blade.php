@extends('web.plantilla')
@section('contenido')
<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container">
        <h1 class="display-3 mb-3 animated slideInDown">¿Olvidaste tu contraseña?</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a class="text-body" href="#">Home</a></li>
                <li class="breadcrumb-item text-dark active" aria-current="page">Olvide clave</li>
            </ol>
        </nav>
    </div>
</div>

<!--Contact Start -->
<div class="container-xxl py-6">
    <div class="container">
        <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">


            <!--Si esta bien seteado se mostrara en la vista-->
            @if(isset($codigoRecu))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                Tu nueva clave es:<br> <strong>{{ $codigoRecu }}</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            @endif

            <!-- Contact End -->

            <h1 class="display-5 mb-3">Recuperar clave</h1>
            <p>Ingresa la dirección de correo con la que te registraste y te enviaremos las instrucciones para cambiar la clave</p>
        </div>
        <form name="fr" class="form-signin" method="POST" action="">
            @csrf
            <div class="row g-5 justify-content-center">
                <div class="card-body">
                    @if (isset($msg))
                    <div class="alert alert-danger text-center">
                        {{ $msg }}
                    </div>
                    @endif
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="email" id="txtCorreo" name="txtCorreo" class="form-control" placeholder="Dirección de correo" required="required" autofocus="autofocus">
                        </div>
                    </div>

                </div>
            </div>
            <div>
                <button class="btn btn-primary btn-block" type="submit">Recuperar</button>
            </div>
        </form>
        <div class="text-center">
            <a class="d-block small mt-3" href="/registrarse">Nuevo registro</a>
            <a class="d-block small" href="/login">Página Login</a>
        </div><br>
    </div>
</div>
<!-- Contact End -->
@endsection