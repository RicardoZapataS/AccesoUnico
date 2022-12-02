<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marcaciones extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv';

    protected $fillable = [
        'codigo',
        'codigo_tarjeta',
        'areas_acceso',
        'areas_solicitadas',
        'permitido',
        'punto_accesos_id',
    ];

}
