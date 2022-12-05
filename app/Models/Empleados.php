<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleados extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv2';
    protected $table = 'Empleados';
    protected $fillable = [
        'Codigo'
        ,'Paterno'
        ,'Materno'
        ,'Nombre'
        ,'Cargo'
        ,'CI'
        ,'Empresa'
        ,'GSangre'
        ,'Vencimiento'
        ,'Fotografia'
        ,'HuellaDig'
        ,'Fecha'
        ,'EstCivil'
        ,'Profesion'
        ,'Direccion'
        ,'TelDom'
        ,'DirTrab'
        ,'TelTrab'
        ,'altura'
        ,'Peso'
        ,'Ojos'
        ,'Observacion'
        ,'ultFecent'
        ,'Sexo'
        ,'AreasAut'
        ,'Estado'
        ,'idEmpleado'
        ,'ColorF'
        ,'UltFechaEmi'
        ,'Tipo'
        ,'FechaNac'
        ,'NroRenovacion'
        ,'ConduccionPlataforma'
        ,'RayosX'
        ,'ColorArea6'
        ,'ColorArea5'
        ,'AreasCP'
        ,'FechaVencCP'
        ,'CategoriaLic'
        ,'Herramientas'
        ,'FechaFactura'
        ,'NroFactura'
        ,'CodigoTarjeta'
    ];
    public function Empresa(){
        return $this->belongsTo(Empresas::class, 'Empresa', 'Empresa');
    }
}
