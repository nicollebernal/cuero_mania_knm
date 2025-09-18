<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class personalizacion extends Model
{
    use HasFactory;

    protected $table = 'personalizacion';
    protected $primaryKey = 'id_personalizacion';
    public $timestamps = false;
    protected $fillable = [
        'descripcion',
        'material',
        'color',
        'diseno',
        'talla',
        'cantidad',
        'precio'
    ];
}
