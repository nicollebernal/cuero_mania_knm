<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'ventas';              
    protected $primaryKey = 'id_ventas';     
    public $timestamps = false;              
    protected $fillable = [
        'fecha_ventas',
        'estado_venta',
        'Total',
        'id_usuario'
    ];

    public function pagos()
    {
        return $this->hasMany(Pago::class, 'id_venta', 'id_ventas');
    }

    // Relación: una venta pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(UsuarioDAO::class, 'id_usuario', 'id_usuario');
    }
}
