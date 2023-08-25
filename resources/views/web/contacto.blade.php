@extends('web.plantilla')
@section('contenido')
<!-- Page Header Start -->
    <div class="container-fluid page-header wow fadeIn" data-wow-delay="0.1s"> 
    <h1 class="display-3 mb-3 animated slideInDown">Contacto</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a class="text-body" href="/">Inicio</a></li>
                <li class="breadcrumb-item text-dark active" aria-current="/contacto">Contacto</li>
            </ol>
        </nav>
    </div>
<!-- Page Header End -->

                
<!-- Contact Start -->
<div class="container-xxl py-6">
    <div class="container">
        <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <h1 class="display-5 mb-3">Contacto</h1>
            <p>Envianos tu consulta o sugerencia.</p>
        </div>
        
        <div class="row g-5 justify-content-center">
            <div class="col-lg-5 col-md-12 wow fadeInUp" data-wow-delay="0.1s">
                <div class="bg-primary text-white d-flex flex-column justify-content-center h-100 p-5">
                    <h4 class="text-white mb-5">CONTACTANOS</h4>
                    <h5 class="text-white">Correo Electrónico</h5>
                    <p class="mb-5"><i class="fa fa-envelope me-3"></i>info@burguer.com</p>
                </div>
            </div>
            <div class="col-lg-7 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                <p class="mb-4">Completá este breve formulario.</p>
                <form method="POST" name="frm" action="">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>    
                  
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="txtNombre" name="txtNombre" placeholder="Tu Nombre" required>
                                <label for="txtNombre">Tu Nombre</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="txtCorreo" name="txtCorreo" placeholder="Tu Correo" required>
                                <label for="txtCorreo">Tu Correo</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="txtTelefono" name="txtTelefono" placeholder="Asunto" required>
                                <label for="txtTelefono">Tu Celular</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Deja un mensaje aqui..." id="txtMensaje" name="txtMensaje" style="height: 200px" required></textarea>
                                <label for="txtMensaje">Deja un mensaje aqui...</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary rounded-pill py-3 px-5" type="submit" name="btnEnviar">Enviar mensaje</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->




@endsection


