<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class pagos extends Model
{
    use HasFactory;

    protected $fillable = [' precio','metodo_pagos','opcion_pagos'];
}
