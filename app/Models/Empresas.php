<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresas extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv2';
    protected $table = 'Empresas';
    protected $fillable = [
        'Empresa'
        ,'NombEmpresa'
        ,'Direccion'
        ,'Telefono'
        ,'Casilla'
        ,'Fax'
        ,'Email'
        ,'RepLegal'
        ,'Ruc'
        ,'Estado'
        ,'id'
    ];
}
