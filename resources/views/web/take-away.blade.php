@extends('web.plantilla')
@section('contenido')
<script src="https://kit.fontawesome.com/5aac904b55.js" crossorigin="anonymous"></script>
    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <h1 class="display-3 mb-3 animated slideInDown">Take Away</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a class="text-body" href="#">Inicio</a></li>
                    <li class="breadcrumb-item text-dark active" aria-current="page">Take Away</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->
    <!-- Product Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-0 gx-5 align-items-end">
                <div class="col-lg-6">
                    <div class="section-header text-start mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                        <h1 class="display-5 mb-3">Realiza tu pedido</h1>
                        <p>No te quedes con las ganas, tu mejor opción esta acá.</p>
                    </div>
                </div>
                <div class="col-lg-6 text-start text-lg-end wow slideInRight" data-wow-delay="0.1s">
                    <ul class="nav nav-pills d-inline-flex justify-content-end mb-5">
                        <li class="nav-item me-2">
                            <a class="btn btn-outline-primary border-2 active" data-bs-toggle="pill" href="#tab-1">Todos</a>
                        </li>
                        <li class="nav-item me-2">
                            <a class="btn btn-outline-primary border-2" data-bs-toggle="pill" href="#tab-2">Papas</a>
                        </li>
                        <li class="nav-item me-2">
                            <a class="btn btn-outline-primary border-2" data-bs-toggle="pill" href="#tab-2">Hamburguesas</a>
                        </li>
                        <li class="nav-item me-0">
                            <a class="btn btn-outline-primary border-2" data-bs-toggle="pill" href="#tab-3">Bebidas</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                    <?php foreach ($aProductos as $producto): ?>

                        <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <form action="" method="POST">
                                @csrf
                                <div class="product-item">
                                    <div class="position-relative bg-light overflow-hidden">
                                        <img class="img-thumbnail" src="/files/{{ $producto->imagen }}" alt="">
                                        <div class="bg-secondary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">Nuevo</div>
                                    </div>
                                    <div class="text-center p-4">
                                        <a class="d-block h5 mb-2">{{ $producto->nombre }}</a>
                                        <span class="text-primary me-1">{{ $producto->precio }}</span>
                                    </div>
                                    <div class="d-flex border-top d-flex justify-content-center align-items-center">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <input type="hidden" value="{{ $producto->idproducto }}" name="txtIdProducto">
                                            <button type="submit" class="btn btn-danger rounded-circle m-2" name="btnDisminuir">‒</button>
                                            <?php $encontrado = false; ?>
                                            @if(isset($aCarritoProductos))
                                                @foreach($aCarritoProductos as $carritoProducto)
                                                    @if($carritoProducto->fk_idproducto == $producto->idproducto)
                                                        <input type="hidden" name="txtCantidad" id="txtCantidad" class="form-control m-2" value="{{$carritoProducto->cantidad}}">
                                                        <input class="form-control m-2" disabled value="{{$carritoProducto->cantidad}}">
                                                        <?php $encontrado = true; ?>
                                                    @endif
                                                @endforeach
                                            @endif
                                            @if(!$encontrado)
                                                <input type="hidden" name="txtCantidad" id="txtCantidad" class="form-control m-2" value="0">
                                                <input class="form-control m-2" disabled value="0">
                                            @endif
                                    

                                            <button type="submit" class="btn btn-success rounded-circle m-2" name="btnAumentar">+</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product End -->


@endsection