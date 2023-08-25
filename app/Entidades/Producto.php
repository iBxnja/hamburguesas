<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    public $timestamps = false; //por si queremos que el framework escriba la fecha de modif en las tablas//

    protected $fillable = [
        'idproducto', 'nombre', 'cantidad', 'precio', 'imagen', 'fk_idcategoria', 'descripcion', 'fk_idmarca',
    ];

    protected $hidden = [

    ];

    public function cargarDesdeRequest($request)
    {
        $this->idproducto = $request->input('id') != "0" ? $request->input('id') : $this->idproducto;
        $this->nombre = $request->input('txtNombre');
        $this->cantidad = $request->input('txtCantidad');
        $this->precio = $request->input('txtPrecio');
        $this->imagen = $request->input('txtImagen');
        $this->fk_idcategoria = $request->input('lstCategoria');
        $this->descripcion = $request->input('txtDescripcion');
        $this->fk_idmarca = $request->input('lstMarca');
    }

    public function obtenerTodos()
    {
        $sql = "SELECT
                  idproducto,
                  nombre,
                  cantidad,
                  precio,
                  imagen,
                  fk_idcategoria,
                  descripcion,
                  fk_idmarca
                FROM productos ORDER BY idproducto";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorCategoria($idCategoria)
    {
        $sql = "SELECT
                  idproducto,
                  nombre,
                  cantidad,
                  precio,
                  imagen,
                  fk_idcategoria,
                  descripcion,
                  fk_idmarca
                FROM productos WHERE fk_idcategoria=$idCategoria";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idProducto)
    {
        $sql = "SELECT
                  idproducto,
                  nombre,
                  cantidad,
                  precio,
                  imagen,
                  fk_idcategoria,
                  descripcion,
                  fk_idmarca
                FROM productos WHERE idproducto = $idProducto";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idproducto = $lstRetorno[0]->idproducto;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->cantidad = $lstRetorno[0]->cantidad;
            $this->precio = $lstRetorno[0]->precio;
            $this->imagen = $lstRetorno[0]->imagen;
            $this->fk_idcategoria = $lstRetorno[0]->fk_idcategoria;
            $this->descripcion = $lstRetorno[0]->descripcion;
            $this->fk_idmarca = $lstRetorno[0]->fk_idmarca;
            return $this;
        }
        return null;
    }

    public function guardar()
    {
        DB::table('productos')
        ->where('idproducto', $this->idproducto)
        ->update(array(
            'nombre' => $this->nombre,
            'cantidad' => $this->cantidad,
            'precio' => $this->precio,
            'imagen' => $this->imagen,
            'fk_idcategoria' => $this->fk_idcategoria,
            'descripcion' => $this->descripcion,
            'fk_idmarca' => $this->fk_idmarca,
        ));
    }

    public function eliminar()
    {
        $sql = "DELETE FROM productos WHERE idproducto=?";
        $affected = DB::delete($sql, [$this->idproducto]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO productos (
                  nombre,
                  cantidad,
                  precio,
                  imagen,
                  fk_idcategoria, 
                  descripcion, 
                  fk_idmarca
            ) VALUES (?, ?, ?, ?, ?, ?, ?);";

        $result = DB::insert($sql, [
            $this->nombre,
            $this->cantidad,
            $this->precio,
            $this->imagen,
            $this->fk_idcategoria,
            $this->descripcion,
            $this->fk_idmarca
        ]);
        return $this->idproducto = DB::getPdo()->lastInsertId();
    }



    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'A.nombre',
            1 => 'A.cantidad',
            2 => 'A.precio',
            3 => 'A.imagen',
            4 => 'A.decripcion'
        );
        $sql = "SELECT DISTINCT
                    A.idproducto,
                    A.nombre,
                    A.cantidad,
                    A.precio,
                    A.imagen,
                    a.descripcion
                    FROM productos A
                WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( A.nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.cantidad LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.precio LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.imagen LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.descripcion LIKE '%" . $request['search']['value'] . "%' ";
           
        }
   
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }

    public function obtenerPorMarca($idMarca)
    {
        $sql = "SELECT
                    P.idproducto,
                    P.nombre, 
                    P.cantidad,
                    P.precio,
                    P.imagen,
                    P.fk_idcategoria,
                    P.descripcion,
                    P.fk_idmarca
                FROM productos P
                INNER JOIN marcas M
                ON P.fk_idmarca = M.idmarca
                where P.fk_idmarca = $idMarca";

        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }
}