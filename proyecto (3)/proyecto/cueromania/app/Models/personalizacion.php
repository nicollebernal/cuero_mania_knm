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
        'imagen_personalizacion',
        'feccha_solicitud',
        'id_usuario',
        'id_categoria',
        'id_color',
        'id_marca',
        'id_genero',
    ];

    public function usuario()
    {
        return $this->belongsTo(UsuarioDAO::class, 'id_usuario', 'id_usuario');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'id_color', 'id_color');
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'id_marca', 'id_marca');
    }

    public function genero()
    {
        return $this->belongsTo(Genero::class, 'id_genero', 'id_genero');
    }
}
