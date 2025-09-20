<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class color extends Model
{
    use HasFactory;
    protected $table = 'colores';
    protected $primaryKey = 'id_color';
    public $timestamps = false;
    protected $fillable = ['nombre_color'];
}
