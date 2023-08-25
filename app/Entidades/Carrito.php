<?php
namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
      protected $table = 'carritos';
      public $timestamps = false;
  
      protected $fillable = [
          'idcarrito', 'fk_idcliente'
      ];
  
      protected $hidden = [
  
      ];

    public function insertar()
    {
        $sql = "INSERT INTO carritos (
                  fk_idcliente
            ) VALUES (?);";
        $result = DB::insert($sql, [
            $this->fk_idcliente
        ]);
        return $this->idcarrito = DB::getPdo()->lastInsertId();
    }
    public function obtenerPorCliente($idCliente)
    {
        $sql = "SELECT
                  idcarrito,
                  fk_idcliente
                FROM carritos WHERE fk_idcliente = $idCliente";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idcarrito = $lstRetorno[0]->idcarrito;
            $this->fk_idcliente = $lstRetorno[0]->fk_idcliente;
            return $this;
        }
        return null;
    }

    public function obtenerTodos()
    {
        $sql = "SELECT
                  A.idcarrito,
                  A.fk_idcliente
        
                FROM carritos A ORDER BY A.idcarrito";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }



}
?>