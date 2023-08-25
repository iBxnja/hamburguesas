<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';
    public $timestamps = false;

    protected $fillable = [
        'idpedido', 'fecha', 'descripcion', 'total', 'fk_idsucursal', 'fk_idcliente', 'fk_idestado',
    ];

    protected $hidden = [

    ];

    public function cargarDesdeRequest($request)
    {
        $this->idpedido = $request->input('id') != "0" ? $request->input('id') : $this->idpedido;
        $this->fecha = $request->input('txtFecha');
        $this->descripcion = $request->input('txtDescripcion');
        $this->total = $request->input('txtTotal');
        $this->fk_idsucursal = $request->input('lstPedidoSucursal');
        $this->fk_idcliente = $request->input('lstPedidoCliente');
        $this->fk_idestado = $request->input('lstEstado');
    }

    public function obtenerTodos()
    {
        $sql = "SELECT
                  A.idpedido,
                  A.fecha,
                  A.descripcion,
                  A.total,
                  A.fk_idsucursal,
                  A.fk_idcliente,
                  A.fk_idestado
                FROM pedidos A ORDER BY A.fecha";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idPedido)
    {
        $sql = "SELECT
                  idpedido,
                  fecha,
                  descripcion,
                  total,
                  fk_idsucursal,
                  fk_idcliente,
                  fk_idestado
                FROM pedidos WHERE idpedido = $idPedido";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idpedido = $lstRetorno[0]->idpedido;
            $this->fecha = $lstRetorno[0]->fecha;
            $this->descripcion = $lstRetorno[0]->descripcion;
            $this->total = $lstRetorno[0]->total;
            $this->fk_idsucursal = $lstRetorno[0]->fk_idsucursal;
            $this->fk_idcliente = $lstRetorno[0]->fk_idcliente;
            $this->fk_idestado = $lstRetorno[0]->fk_idestado;
            return $this;
        }
        return null;
    }

    public function guardar()
    {
        $sql = "UPDATE pedidos SET
            fecha='?',
            descripcion='?',
            total=?,
            fk_idsucursal=?,
            fk_idcliente=?,
            fk_idestado=?
            WHERE idpedido=?";
        $affected = DB::update($sql, [
            $this->fecha, 
            $this->descripcion, 
            $this->total, 
            $this->fk_idsucursal, 
            $this->fk_idcliente, 
            $this->fk_idestado, 
            $this->idpedido]);
    }
    public function guardarEstado()
    {
        $sql = "UPDATE pedidos SET
            fk_idestado=?
            WHERE idpedido=?";
        $affected = DB::update($sql, [
            $this->fk_idestado, 
            $this->idpedido]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM pedidos WHERE idpedido=?";
        $affected = DB::delete($sql, [$this->idpedido]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO pedidos (
                  fecha,
                  descripcion,
                  total,
                  fk_idsucursal,
                  fk_idcliente,
                  fk_idestado
            ) VALUES (?, ?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->fecha,
            $this->descripcion,
            $this->total,
            $this->fk_idsucursal,
            $this->fk_idcliente,
            $this->fk_idestado
        ]);
        return $this->idpedido = DB::getPdo()->lastInsertId();
    }

    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'P.fecha',
            1 => 'P.descripcion',
            2 => 'p.total',
            3 => 'S.direccion',
            4 => 'C.nombre',
            5 => 'E.nombre'
        );
        $sql = "SELECT DISTINCT
                    P.idpedido,
                    P.fecha,
                    P.descripcion,
                    P.total,
                    S.direccion AS direccion_sucursal,
                    C.nombre AS nombre_cliente,
                    E.nombre AS nombre_estado
                FROM pedidos P
                JOIN sucursales S 
                ON P.fk_idsucursal = S.idsucursal 
                JOIN clientes C
                ON P.fk_idcliente = C.idcliente
                JOIN estados E
                ON P.fk_idestado  = E.idestado 
                WHERE 1=1";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( P.fecha LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR P.descripcion LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR P.total LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR S.direccion LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR C.nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR E.nombre LIKE '%" . $request['search']['value'] . "%' )";
        }
   
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }

    public function obtenerPorSucursal($idSucursal)
    {
        $sql = "SELECT idpedido,fecha,descripcion,total,fk_idsucursal,fk_idcliente,fk_idestado 
        FROM pedidos p 
        WHERE fk_idsucursal = $idSucursal";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorCliente($idCliente)
    {
        $sql = "SELECT  idpedido,
                        fecha,
                        descripcion,
                        total,
                        fk_idsucursal,
                        fk_idcliente,
                        fk_idestado, 
                        e.nombre as estado
        FROM pedidos p 
        INNER JOIN estados e ON p.fk_idestado = e.idestado
        WHERE fk_idcliente = $idCliente
        ORDER BY idpedido DESC";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

}