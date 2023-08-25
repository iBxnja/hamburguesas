<?php
namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Carrito_Producto extends Model
{
    protected $table = 'carrito_productos';
    public $timestamps = false;

    protected $fillable = [
        'idcarrito_producto', 'fk_idproducto', 'fk_idcarrito', 'cantidad',
    ];

    protected $hidden = [

    ];
    public function insertar()
    {
        $sql = "INSERT INTO carrito_productos (
                   fk_idproducto,
                   fk_idcarrito,
                   cantidad
            ) VALUES (?,?,?);";
        $result = DB::insert($sql, [
            $this->fk_idproducto,
            $this->fk_idcarrito,
            $this->cantidad,
        ]);
        return $this->idcarrito_producto = DB::getPdo()->lastInsertId();
    }

    public function guardar()
    {
        DB::table('carrito_productos')
            ->where('idcarrito_producto', $this->idcarrito_producto)
            ->update(array(
                'fk_idcarrito' => $this->fk_idcarrito,
                'fk_idproducto' => $this->fk_idproducto,
                'cantidad' => $this->cantidad,

            ));
    }

    public function obtenerPorCarritoProducto($idCarrito, $idProducto)
    {
        $sql = "SELECT
                    idcarrito_producto,
                    fk_idproducto,
                    fk_idcarrito,
                    cantidad
                  FROM carrito_productos WHERE fk_idcarrito = $idCarrito AND fk_idproducto = $idProducto";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idcarrito_producto = $lstRetorno[0]->idcarrito_producto;
            $this->fk_idproducto = $lstRetorno[0]->fk_idproducto;
            $this->fk_idcarrito = $lstRetorno[0]->fk_idcarrito;
            $this->cantidad = $lstRetorno[0]->cantidad;
            return $this;
        }
        return null;

    }
    public function obtenerPorCarrito($idCarrito)
    {
        $sql = "SELECT
                    A.idcarrito_producto,
                    A.fk_idproducto,
                    A.fk_idcarrito,
                    A.cantidad,
                    B.nombre,
                    B.imagen,
                    B.cantidad as stock,
                    B.precio
                  FROM carrito_productos A
                  INNER JOIN productos B ON A.fk_idproducto = B.idproducto
                  WHERE fk_idcarrito = $idCarrito";
        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }

    public function eliminar()
    {
        $sql = "DELETE FROM carrito_productos WHERE idcarrito_producto=?";
        $affected = DB::delete($sql, [$this->idcarrito_producto]);
    }


}
