<?php
namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Pedido_Producto extends Model
{
    protected $table = 'pedidos_productos';
    public $timestamps = false;

    protected $fillable = [
        'idpedidoproducto', 'cantidad', 'precio_unitario', 'total', 'fk_idpedido', 'fk_idproducto'
    ];

    protected $hidden = [

    ];
    public function insertar()
    {
        $sql = "INSERT INTO pedidos_productos (
                  cantidad,
                  precio_unitario,
                  total,
                  fk_idpedido,
                  fk_idproducto

            ) VALUES (?,?,?,?,?);";
        $result = DB::insert($sql, [
            $this->cantidad,
            $this->precio_unitario,
            $this->total,
            $this->fk_idpedido,
            $this->fk_idproducto
        ]);
        return $this->idpedidoproducto = DB::getPdo()->lastInsertId();
    }

}