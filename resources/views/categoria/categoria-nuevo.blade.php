@extends('plantilla')
@section('titulo', $titulo)
@section('scripts')
<script>
    globalId = '<?php echo isset($categoria->idcategoria) && $categoria->idcategoria > 0 ? $categoria->idcategoria : 0; ?>';
    <?php $globalId = isset($categoria->idcategoria) ? $categoria->idcategoria : "0";?>
</script>

@endsection
@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/admin/home">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/admin/categorias">Categoria</a></li>
    <li class="breadcrumb-item active">Modificar</li>
</ol>
<ol class="toolbar">
    <li class="btn-item"><a title="Nuevo" href="/admin/categoria/nuevo" class="fa fa-plus-circle" aria-hidden="true"><span>Nuevo</span></a></li>
    <li class="btn-item"><a title="Guardar" href="#" class="fa fa-floppy-o" aria-hidden="true" onclick="javascript: $('#modalGuardar').modal('toggle');"><span>Guardar</span></a>
    </li>
    @if($globalId > 0)
    <li class="btn-item"><a title="Eliminar" href="#" class="fa fa-trash-o" aria-hidden="true" onclick="javascript: $('#mdlEliminar').modal('toggle');"><span>Eliminar</span></a></li>
    @endif
    <li class="btn-item"><a title="Salir" href="#" class="fa fa-arrow-circle-o-left" aria-hidden="true" onclick="javascript: $('#modalSalir').modal('toggle');"><span>Salir</span></a></li>
</ol>
<script>
function fsalir(){
    location.href ="/admin/categoria";
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
            <label>Nombre: *</label>
            <input type="text" id="txtNombre" name="txtNombre" class="form-control" value="{{ $categoria->nombre }}" required>
        </div>
    </div>

</form>
<script>
    $("#form1").validate();

    function guardar(){
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
                url: "{{ asset('admin/categoria/eliminar') }}",
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