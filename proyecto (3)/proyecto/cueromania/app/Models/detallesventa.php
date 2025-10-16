<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detallesventa extends Model
{
    use HasFactory;

    protected $table = 'detalles_ventas';
    protected $primaryKey = 'id_detalle_venta';
    public $timestamps = false;

    protected $fillable = [
        'cantidad',
        'cantidad_pagada',
        'precio_unitario',
        'id_venta',
        'id_producto'
    ];

    
    public function producto()
    {
        return $this->belongsTo(productos::class, 'id_producto', 'id_producto');
    }

    public function venta()
    {
        return $this->belongsTo(venta::class, 'id_venta', 'id_ventas');
    }
}
