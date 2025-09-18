<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ventas extends Model
{
    use HasFactory;

    protected $table = 'ventas';
    protected $primaryKey = 'id_venta';
    public $timestamps = false;
    protected $fillable = [
        'fecha_ventas',
        'estado_ventas',
        'total',
        'id_usuario'
    ];
}
