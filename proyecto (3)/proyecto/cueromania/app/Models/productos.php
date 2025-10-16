<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productos extends Model
{
    use HasFactory;

    protected $table = 'productos';
    protected $primaryKey = 'id_producto';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'precio',
        'talla',
        'estado',
        'stock_producto',
        'descripcion',
        'id_tipo_cierre',
        'id_marca',
        'id_color',
        'id_genero',
        'id_categoria'
    ];

    public function detallesventas()
    {
        return $this->hasMany(detallesventa::class, 'id_producto', 'id_producto');
    }
}
