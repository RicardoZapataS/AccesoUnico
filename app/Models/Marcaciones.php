<?php

namespace App\Models;

use App\Events\MarcacionEvent;
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

    protected  $dispatchesEvents = [
      'created' => MarcacionEvent::class,
    ];
    public function Empleado(){
        return $this->belongsTo(Empleados::class,'codigo', 'Codigo');
    }
    public function PuntoAcceso(){
        return $this->belongsTo(PuntoAcceso::class,'punto_accesos_id', 'id');
    }
}
