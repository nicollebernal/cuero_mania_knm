<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $table = 'pagos';
    protected $primaryKey = 'id_pagos';
    public $timestamps = true;

    protected $fillable = [
        'precio',
        'estado_pago',
        'metodo_pagos',
        'opcion_pagos',
        'id_venta'
    ];

    public function venta()
    {
        return $this->belongsTo(Venta::class, 'id_venta', 'id_ventas');
    }
}


