@extends('web.plantilla')
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/funciones_generales.js') }}"></script>
@section('contenido')

<div class="container-xxl py-6">
    <div class="container">
        <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <h1 class="display-5 mb-3">Registrarse</h1>
            <p>Estas a un paso de disfrutar nuestras hamburguesas.</p>
        </div>
        <div class="row justify-content-center mb-3" >

            <?php
            if (isset($msg)) {
                echo '<div id = "msg"></div>';
                echo '<script>msgShow("' . $msg["MSG"] . '", "' . $msg["ESTADO"] . '")</script>';
            }
            ?>
        </div>
        <div class="row">
        </div>
        <div class="row g-5 justify-content-center">
            <div class="col-lg-7 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                <form method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"></input> 
                      <div class="row g-3">
                        <div class="col-12">
                              <div class="form-floating">
                                        <input type="text" class="form-control" id="txtNombre" name="txtNombre" value="{{$request->txtNombre }}" placeholder="Tu nombre" require>
                                        <label for="name">Nombre</label>
                              </div>
                        </div>
                        <div class="col-12">
                              <div class="form-floating">
                                    <input type="text" class="form-control" id="txtApellido" name="txtApellido" value="{{$request->txtApellido }}" placeholder="Tu apellido" require>
                                    <label for="apellido">Apellido</label>
                              </div>
                        </div>
                        <div class="col-12">
                              <div class="form-floating">
                                  <input type="text" class="form-control" id="txtDocumento" name="txtDocumento" value="{{$request->txtDocumento }}" placeholder="Tu documento" >
                                  <label for="txtDocumento">Documento</label>
                              </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="txtCorreo" name="txtCorreo" value="{{$request->txtCorreo }}" placeholder="Tu correo" require>
                                <label for="txtCorre">Correo</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="txtCelular" name="txtCelular" value="{{$request->txtCelular }}" placeholder="Tu telefono" >
                                <label for="txtCelular">Teléfono</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="password" class="form-control" id="txtClave" name="txtClave" placeholder="Tu clave" require>
                                <label for="txtClave">Clave</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="password" class="form-control" id="txtRepetir" name="txtRepetir" placeholder="Repeti la clave" require>
                                <label for="txtRepetir">Repetir clave</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary rounded-pill py-3 px-5" type="submit">Registrarse</button>
                            <a href="/login">¿Ya tenes cuenta? Inicia sesion.</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection