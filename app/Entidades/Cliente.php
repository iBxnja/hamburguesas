<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    protected $primaryKey = 'idcliente';
    public $timestamps = false;

    protected $fillable = [
        'idcliente', 'nombre', 'apellido', 'correo', 'documento', 'celular', 'clave',
    ];

    protected $hidden = [];

    public function cargarDesdeRequest($request)
    {
        $this->idcliente = $request->input('idcliente') != "0" ? $request->input('idcliente') : $this->idcliente;
        $this->nombre = $request->input('txtNombre');
        $this->apellido = $request->input('txtApellido');
        $this->correo = $request->input('txtCorreo');
        $this->documento = $request->input('txtDocumento');
        $this->celular = $request->input('txtCelular');
        $this->clave = $request->input('txtClave');
    }

    public function obtenerTodos()
    {
        $sql = "SELECT
                  A.idcliente,
                  A.nombre,
                  A.apellido,
                  A.correo,
                  A.documento,
                  A.celular,
                  A.clave
                FROM clientes A ORDER BY A.nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idCliente)
    {
        $sql = "SELECT
                  idcliente,
                  nombre,
                  apellido,
                  correo,
                  documento,
                  celular,
                  clave
                FROM clientes WHERE idcliente = $idCliente";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idcliente = $lstRetorno[0]->idcliente;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->apellido = $lstRetorno[0]->apellido;
            $this->correo = $lstRetorno[0]->correo;
            $this->documento = $lstRetorno[0]->documento;
            $this->celular = $lstRetorno[0]->celular;
            $this->clave = $lstRetorno[0]->clave;
            return $this;
        }
        return null;
    }

    public function obtenerPorMail($correo)
    {
        $sql = "SELECT
              idcliente,
              nombre,
              apellido,
              correo,
              documento,
              celular,
              clave
            FROM clientes WHERE correo = ?";
        $lstRetorno = DB::select($sql, [$correo]);

        if (count($lstRetorno) > 0) {
            $cliente = new Cliente();
            $cliente->idcliente = $lstRetorno[0]->idcliente;
            $cliente->nombre = $lstRetorno[0]->nombre;
            $cliente->apellido = $lstRetorno[0]->apellido;
            $cliente->correo = $lstRetorno[0]->correo;
            $cliente->documento = $lstRetorno[0]->documento;
            $cliente->celular = $lstRetorno[0]->celular;
            $cliente->clave = $lstRetorno[0]->clave;
            return $cliente;
        }

        return null;
    }


    public function guardar()
    {
        DB::table('clientes')
            ->where('idcliente', $this->idcliente)
            ->update(array(
                'nombre' => $this->nombre,
                'apellido' => $this->apellido,
                'correo' => $this->correo,
                'documento' => $this->documento,
                'celular' => $this->celular,
                'clave' => $this->encriptarClave($this->clave),
            ));
    }

    public function eliminar()
    {
        $sql = "DELETE FROM clientes WHERE idcliente=?";
        $affected = DB::delete($sql, [$this->idcliente]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO clientes (
                  nombre,
                  apellido,
                  correo,
                  documento,
                  celular,
                  clave
            ) VALUES (?, ?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->nombre,
            $this->apellido,
            $this->correo,
            $this->documento,
            $this->celular,
            $this->encriptarClave($this->clave)
        ]);
        return $this->idcliente = DB::getPdo()->lastInsertId();
    }

    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'A.nombre',
            1 => 'A.apellido',
            2 => 'A.correo',
            3 => 'A.documento',
            4 => 'A.celular'
        );
        $sql = "SELECT DISTINCT
                    A.idcliente,
                    A.nombre,
                    A.apellido,
                    A.documento,
                    A.correo,
                    A.celular
                    FROM clientes A
                WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( A.nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.apellido LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.documento LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.correo LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.celular LIKE '%" . $request['search']['value'] . "%' )";
        }

        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }

    function verificarMail($mail)
    {
        $sql = "SELECT   idcliente,
                        nombre,
                        apellido,
                        correo,
                        documento,
                        celular,
                        clave
                FROM clientes
                WHERE correo = '$mail'";
        $result = DB::select($sql);
        return $result;
    }

    public function encriptarClave($clave)
    {
        $claveEncriptada = password_hash($clave, PASSWORD_DEFAULT);
        return $claveEncriptada;
    }

    public function validarClave($claveIngresada, $claveBBDD)
    {
        return password_verify($claveIngresada, $claveBBDD);
    }
}
