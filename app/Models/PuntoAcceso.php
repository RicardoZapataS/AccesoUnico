<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PuntoAcceso extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv';
    protected $fillable = [
        'nombre_punto',
        'areas_solicitadas',
        'ip_lector',
    ];

}
