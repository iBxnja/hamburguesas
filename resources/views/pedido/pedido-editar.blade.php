@extends('plantilla')
@section('titulo', $titulo)
@section('scripts')
<script>
      globalId = '<?php echo isset($pedido->idpedido) && $pedido->idpedido > 0 ? $pedido->idpedido : 0; ?>';
      <?php $globalId = isset($pedido->idpedido) ? $pedido->idpedido : "0"; ?>
</script>
@endsection
@section('breadcrumb')
<ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/admin/home">Inicio</a></li>
      <li class="breadcrumb-item"><a href="/admin/pedidos">Pedidos</a></li>
      <li class="breadcrumb-item active">Modificar</li>
</ol>
<ol class="toolbar">
      <li class="btn-item"><a title="Guardar" href="#" class="fa fa-floppy-o" aria-hidden="true" onclick="javascript: $('#modalGuardar').modal('toggle');"><span>Guardar</span></a>
      </li>
      @if($globalId > 0)
      <li class="btn-item"><a title="Eliminar" href="#" class="fa fa-trash-o" aria-hidden="true" onclick="javascript: $('#mdlEliminar').modal('toggle');"><span>Eliminar</span></a></li>
      @endif
      <li class="btn-item"><a title="Salir" href="#" class="fa fa-arrow-circle-o-left" aria-hidden="true" onclick="javascript: $('#modalSalir').modal('toggle');"><span>Salir</span></a></li>
</ol>
<script>
      function fsalir() {
            location.href = "/admin/pedidos";
      }
</script>
@endsection
@section('contenido')
<div class="panel-body">
        <div id="msg"></div>
        <?php
if (isset($msg)) {
    echo '<script>msgShow("' . $msg["MSG"] . '", "' . $msg["ESTADO"] . '")</script>';
}
?>
<form id="form1" action="" method="POST">
      <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
      <input type="hidden" id="id" name="id" class="form-control" value="{{$globalId}}" required>
      <div class="row">
            <div class="form-group col-lg-6">
                  <label>Descripcion: *</label>
                  <input disabled type="text" id="txtDescripcion" name="txtDescripcion" class="form-control" value="{{ $pedido->descripcion }}" required>
            </div>

            <div class="form-group col-lg-6">
                  <label>Total: *</label>
                  <input disabled type="mail" id="txtTotal" name="txtTotal" class="form-control" value="{{ $pedido->total }}" required>
            </div>

            <div class="form-group col-lg-6">
                  <label>Sucursal: *</label>
                  @foreach ($array_sucursales as $sucursal)
                              @if ($pedido->fk_idsucursal == $sucursal->idsucursal)
                              <input disabled type="text" id="txtCliente" name="txtCliente" class="form-control" value="{{ $sucursal->direccion }}">
                              @endif
                        @endforeach
                  </div>

            <div class="form-group col-lg-6" >
                        <label>Cliente: *</label>
                        @foreach ($array_clientes as $cliente)
                              @if ($pedido->fk_idcliente == $cliente->idcliente)
                              <input disabled type="text" id="txtCliente" name="txtCliente" class="form-control" value="{{ $cliente->nombre }}">
                              @endif
                        @endforeach
            </div>
            <div class="form-group col-lg-6">
                  <label>Estado: *</label>
                  <select name="lstEstado" id="lstEstado" class="form-control" required>
                  @foreach ($array_estados as $estado)
                        @if ($pedido->fk_idestado == $estado->idestado)
                        <option value="{{ $estado->idestado }}" selected>{{ $estado->nombre }}</option>
                        @else
                        <option value="{{ $estado->idestado }}" >{{ $estado->nombre }}</option>
                        @endif
                  @endforeach
                  </select>
            </div>
      </div>

</form>
<script>
      $("#form1").validate();

      function guardar() {
            if ($("#form1").valid()) {
                  modificado = false;
                  form1.submit();
            } else {
                  $("#modalGuardar").modal('toggle');
                  msgShow("Corrija los errores e intente nuevamente.", "danger");
                  return false;
            }
      }
</script>
@endsection