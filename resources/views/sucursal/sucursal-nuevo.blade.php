<!--Agregar el campo de "nombre" a la tabla de sucursales-->

<!--Las diferentes sections se pueden ver en la plantilla.blade.php
todo lo que pongamos dentro del section('(Section)') se agregara en la plantilla

los section se designan en la plantilla.blade.php y se trabajan en las carpetas 
que se encuentran en views.
-->

@extends('plantilla')<!-- Busca la plantilla (plantilla.blade.php en view.)-->
@section('titulo', $titulo) <!--Pone el titulo de la variable "$titulo"-->
@section('scripts')<!--Las sectiones son los "yield" de la plantilla.blade.php-->

<script>
    globalId = '<?php echo isset($sucursal->idsucursal) && $sucursal->idsucursal > 0 ? $sucursal->idsucursal : 0; ?>';
    <?php $globalId = isset($sucursal->idsucursal) ? $sucursal->idsucursal : "0";?>
</script>
@endsection
@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/admin/home">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/admin/sucursales">Sucursales</a></li>
    <li class="breadcrumb-item active">Modificar</li>
</ol>
<ol class="toolbar">
    <li class="btn-item"><a title="Nuevo" href="/admin/sucursal/nuevo" class="fa fa-plus-circle" aria-hidden="true"><span>Nuevo</span></a></li>
    <li class="btn-item"><a title="Guardar" href="#" class="fa fa-floppy-o" aria-hidden="true" onclick="javascript: $('#modalGuardar').modal('toggle');"><span>Guardar</span></a>
    </li>
    @if($globalId > 0)
    <li class="btn-item"><a title="Eliminar" href="#" class="fa fa-trash-o" aria-hidden="true" onclick="javascript: $('#mdlEliminar').modal('toggle');"><span>Eliminar</span></a></li>
    @endif
    <li class="btn-item"><a title="Salir" href="#" class="fa fa-arrow-circle-o-left" aria-hidden="true" onclick="javascript: $('#modalSalir').modal('toggle');"><span>Salir</span></a></li>
</ol>
<script>
function fsalir(){
    location.href ="/admin/sucursales";
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
                        <label for="txtNombre">Nombre: *</label>
                        <input type="text" id="txtNombre" name="txtNombre" class="form-control" value="{{ $sucursal->nombre }}" required>
                  </div>
                  <div class="form-group col-lg-6">
                        <label for="txtTelefono">Telefono: *</label>
                        <input type="text" id="txtTelefono" name="txtTelefono" class="form-control" value="{{ $sucursal->telefono }}" required>
                  </div>
                  <div class="form-group col-lg-6">
                      <label for="txtDireccion">Dirección: *</label>
                      <input type="text" id="txtDireccion" name="txtDireccion" class="form-control" value="{{ $sucursal->direccion }}" required>
                  </div>
                  <div class="form-group col-lg-6">
                      <label for="txtHorario">Horario: *</label>
                      <input type="text" id="txtHorario" name="txtHorario" class="form-control" value="{{ $sucursal->horario }}" required>
                  </div>
                  <div class="col-12">
                      <label for="txtMapa">URL Google Maps</label>
                      <input type="url" name="txtMapa" id="txtMapa" class="form-control" value="{{ $sucursal->linkmapa }}">
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


    function eliminar() {
        $.ajax({
            type: "GET",
            url: "{{ asset('admin/sucursal/eliminar') }}",
            data: { id:globalId },
            async: true,
            dataType: "json",
            success: function (data) {
                if (data.err == "0") {
                    msgShow("Registro eliminado exitosamente.", "success");
                } else {
                    msgShow(data.err, "danger");

                }
                $('#mdlEliminar').modal('toggle');
            }
        });
    }

    </script>
@endsection