@extends('web.plantilla')

<!--
imagen//nombre

total

sucursal
input donde retirar


continuar y finalizar pedido

-->
    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <h1 class="display-3 mb-3 animated slideInDown">Carrito</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a class="text-body" href="#">Inicio</a></li>
                    <li class="breadcrumb-item text-dark active" aria-current="page">Carrito</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->
<div class="container container-fluid">
<div class="border-bottom border-dark mt-5">
      <div class="row">
            <div class="col-12 mt-5 border-bottom border-dark mt-5">
                  <h2>Carrito De Compras</h2>
            </div>
      </div>
      <?php $total = 0?>;
      @foreach($aCarritoProductos as $carritoProducto)
      <?php $total += $carritoProducto->precio * $carritoProducto->cantidad;?>
      <form action="" method="POST">
      @csrf
      <div class="row m-5 d-flex justify-content-center align-items-center">
            <div class="col-2">
                  <img class="img-fluid w-100" src="files/{{$carritoProducto->imagen}}" alt="">
            </div>
            <div class="col-6 d-flex justify-content-center align-items-start flex-column">
                  <h2>{{$carritoProducto->nombre}}</h2>
                  <h6>Total: ${{ number_format($carritoProducto->precio * $carritoProducto->cantidad, 2, ",", ".") }}</h6>
            </div>
            <div class="col-2 d-flex justify-content-center align-items-start">
                  <button type="submit" name="btnDisminuir" class="btn btn-danger rounded-circle m-2">‒</button>
                  <input type="hidden" name="txtIdProducto" id="txtIdProducto" class="form-control w-50 m-2" value="{{$carritoProducto->fk_idproducto}}">
                  <input type="hidden" name="txtCantidad" id="txtCantidad" class="form-control w-50 m-2" value="{{$carritoProducto->cantidad}}">
                  <input type="text" class="form-control w-50 m-2" disabled value="{{$carritoProducto->cantidad}}">
                  <button type="submit" name="btnAumentar" class="btn btn-success rounded-circle m-2">+</button>
            </div>
      </div>
      </form>
      @endforeach
      <form action="" method="POST">
      @csrf
      <div class="row">
            <div class="col-6">
                  <label>Sucursal:</label>
                  <select name="lstSucursal" id="lstSucursal" class="form-select" aria-label="Default select example" required>
                        <option value="" disabled selected>Seleccionar</option>
                        @foreach($aSucursales as $sucursal)
                              <option value="{{ $sucursal->idsucursal }}">{{ $sucursal->nombre }} </option>
                        @endforeach
                  </select>
            </div>
            <div class="col-6">
                  <label>Medio de pago:</label>
                  <select name="lstMedioDePago" id="" class="form-control text-dark bg-white">
                        <option value="efectivo">Efectivo</option>
                        <option value="mercadopago">Mercado Pago</option>
                  </select>
            </div>
            <div class="col-12 pt-3">
                  <label>Descripción:</label>
                  <textarea name="txtDescripcion" class="form-control"></textarea>
            </div>
      </div>
      <div class="row d-flex justify-content-center align-items-center m-5">
            <div class="col-6 d-flex justify-content-center align-items-center">
                  <h3 class="bg-white text-dark" disabled>Total: ${{number_format($total, 2, ",", ".")}}</h3>
            </div>
      </div>
      <div class="row d-flex justify-content-center align-items-center mb-5">
            <div class="col-6 d-flex justify-content-center align-items-center">
                  <a href="/take-away" class="btn btn-warning w-50">Seguir comprando</a>
            </div>
            <div class="col-6 d-flex justify-content-center align-items-center">
                  <button type="submit" name="btnFinalizar" class="btn btn-warning w-50">Finalizar el pedido</button>
            </div>
      </div>
      </form>
</div>
</div>
