<?php

namespace App\Entidades; //espacio donde esta.

use DB; 
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table = 'sucursales';
    public $timestamps = false;

    protected $fillable = [
        'idsucursal', 'nombre', 'telefono', 'direccion', 'linkmapa', 'horario'
    ];

    protected $hidden = [

    ];

    public function cargarDesdeRequest($request)
    {
        $this->idsucursal = $request->input('id') != "0" ? $request->input('id') : $this->idsucursal;
        $this->nombre = $request->input('txtNombre');
        $this->telefono = $request->input('txtTelefono');
        $this->direccion = $request->input('txtDireccion');
        $this->linkmapa = $request->input('txtMapa');
        $this->horario = $request->input('txtHorario');
    }

    public function obtenerTodos()
    {
        $sql = "SELECT
                  A.idsucursal,
                  A.nombre,
                  A.telefono,
                  A.direccion,
                  A.linkmapa,
                  A.horario
                FROM sucursales A ORDER BY A.nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idSucursal)
    {
        $sql = "SELECT
                  idsucursal,
                  nombre,
                  telefono,
                  direccion,
                  linkmapa,
                  horario
                FROM sucursales WHERE idsucursal = $idSucursal";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idsucursal = $lstRetorno[0]->idsucursal;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->telefono = $lstRetorno[0]->telefono;
            $this->direccion = $lstRetorno[0]->direccion;
            $this->linkmapa = $lstRetorno[0]->linkmapa;
            $this->horario = $lstRetorno[0]->horario;
            return $this;
        }
        return null;
    }

    public function guardar(){
        DB::table('sucursales')
        ->where('idsucursal', $this->idsucursal)
        ->update(array(
            'nombre' => $this->nombre,
            'telefono' => $this->telefono,
            'direccion' => $this->direccion,
            'linkmapa' => $this->linkmapa,
            'horario' => $this->horario
        ));
    }

    public function eliminar()
    {
        $sql = "DELETE FROM sucursales WHERE idsucursal=?";
        $affected = DB::delete($sql, [$this->idsucursal]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO sucursales (
                  nombre,
                  telefono,
                  direccion,
                  linkmapa,
                  horario
            ) VALUES (?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->nombre,
            $this->telefono,
            $this->direccion,
            $this->linkmapa,
            $this->horario
        ]);
        return $this->idsucursal = DB::getPdo()->lastInsertId();
    }
    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'A.nombre',
            1 => 'A.telefono',
            2 => 'A.direccion',
            3 => 'A.linkmapa'
        );
        $sql = "SELECT DISTINCT
                    A.idsucursal,
                    A.nombre,
                    A.telefono,
                    A.direccion,
                    A.linkmapa                
                FROM sucursales A
                WHERE 1=1
                ";
    
        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( A.nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.telefono LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.direccion LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.linkmapa LIKE '%" . $request['search']['value'] . "%' )";
        }

        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }

    public function obtenerPorSucursal($idSucursal)
    {
        $sql = "SELECT fecha,descripcion,total,fk_idsucursal,fk_idcliente,fk_idestado 
        FROM pedidos p 
        WHERE fk_idsucursal = $idSucursal";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

}
