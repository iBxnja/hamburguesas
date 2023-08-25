@extends('web.plantilla')
@section('contenido')
    <!-- Page Header Start -->
    <div class="container-fluid page-header wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <h1 class="display-3 mb-3 animated slideInDown">Mi cuenta</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a class="text-body" href="#">Inicio</a></li>
                    <li class="breadcrumb-item"><a class="text-body" href="#">paginas</a></li>
                    <li class="breadcrumb-item text-dark active" aria-current="page">contacto</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Contact Start -->
    <div class="container-xxl py-6">
        <div class="container">
            <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-5 mb-3">Mi cuenta</h1>
                <p></p>
            </div>
            <div class="row g-5 justify-content-center">
                
                <div class="col-lg-7 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                    <p class="mb-4">Datos del Usuario </p>
                    @if(isset($msg))
                        <div class="alert alert-{{$msg['ESTADO']}}" role="alert">
                            {{$msg["MSG"]}}
                        </div>
                    @endif
                    <form method="POST" name="frm" action="">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                <input type="text" class="form-control" name="txtNombre" id="txtNombre" placeholder="Nombre" value="{{ $cliente->nombre }}" required>
                                <label for="txtNombre">Nombre</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="txtApellido" id="txtApellido" placeholder="Apellido" value="{{ $cliente->apellido }}" required>
                                    <label for="txtApellido:">Apellido</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                <input type="email" class="form-control" name="txtCorreo" id="txtCorreo" placeholder="Correo" value="{{ $cliente->correo }}" required>
                                <label for="txtCorreo">Correo</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="txtDocumento" id="txtDocumento" placeholder="Documento" value="{{ $cliente->documento }}" required>
                                    <label for="txtDocumento">Documento</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="txtTelefono" id="txtTelefono" placeholder="Tu Celular" value="{{ $cliente->celular }}" required>
                                    <label for="txtTelefono">Celular</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="password" class="form-control" name="txtClave" id="txtClave" placeholder="Clave" value="" required>
                                    <label for="txtClave">Clave</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary rounded-pill py-3 px-5" type="submit">Guardar los cambios</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="container">
    <div class="table-responsive">
        @if(count($aPedidos))
        <table class="table table-bordered table-hover table-striped">
             <thead class="table-dark">
                <tr>
                     <th>Número de Pedido</th>
                     <th>Fecha</th>
                     <th>Total</th>
                     <th>Descripción</th>
                </tr>
        </thead>
        <tbody>
            @foreach($aPedidos as $pedido) 
            <tr>
                <td>{{ $pedido->idpedido }}</td>
                <td>{{ date_format(date_create($pedido->fecha),"d/m/Y H:m") }}</td>
                <td>${{ number_format($pedido->total, 2, ",", ".") }}</td>
                <td>{{ $pedido->estado }}</td>
            </tr>
            @endforeach
             </tbody>
         </table>
         @else
         <p>Aún no has realizado pedidos</p>
         @endif
    </div>
</div>

@endsection
