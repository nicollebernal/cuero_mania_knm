<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class genero extends Model
{
    use HasFactory;
    protected $table = 'generos';
    protected $primaryKey = 'id_genero';
    public $timestamps = false;
    protected $fillable = ['nombre_genero'];
}
