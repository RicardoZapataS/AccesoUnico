<?php

namespace App\Http\Controllers;

use App\Models\Empleados;
use App\Models\Marcaciones;
use App\Models\PuntoAcceso;
use Illuminate\Http\Request;

class MarcacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $lecturas = Marcaciones::where('punto_accesos_id', $id)->orderBy('id', 'DESC')->take(10)->get();

        $t = Marcaciones::where('punto_accesos_id', $id)->orderBy('id', 'DESC')->get()->first();
        $last_person = Empleados::where('CodigoTarjeta', $t->codigo_tarjeta)->get()->first();
        $punto = PuntoAcceso::find($id);
        $mes = "";
        switch (substr($last_person->Vencimiento, 5, 2)){
            case "01":
                $mes = "ENE";
                break;
            case "02":
                $mes = "FEB";
                break;
            case "03":
                $mes = "MAR";
                break;
            case "04":
                $mes = "ABR";
                break;
            case "05":
                $mes = "MAY";
                break;
            case "06":
                $mes = "JUN";
                break;
            case "07":
                $mes = "JUL";
                break;
            case "08":
                $mes = "AGO";
                break;
            case "09":
                $mes = "SEP";
                break;
            case "10":
                $mes = "OCT";
                break;
            case "11":
                $mes = "NOV";
                break;
            case "12":
                $mes = "DEC";
                break;
        }
        //dd($last_person->empleado);
        return view('screen-acces', compact('lecturas', 'last_person', 'punto', 'mes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $codigo_tarjeta)
    {
        $clientIP = request()->ip();
        //dd($clientIP);
        $client = PuntoAcceso::where('ip_lector', $clientIP)->get();
        if (count($client)>0) {
            $empleado = Empleados::where('CodigoTarjeta', 'like',  '%' . hexdec($codigo_tarjeta) . '%')->get()->first();
            $id_cliente = $client[0]->id;
            $areas_permitidas = str_replace('-', '', $empleado->AreasAut);
            //dd($areas_permitidas);
            $areas_solicitadas = str_replace('-', '', $client[0]->areas_solicitadas);
            $permitido = (str_contains($areas_permitidas, $areas_solicitadas));
            Marcaciones::create([
                'codigo'=>$empleado->Codigo,
                'codigo_tarjeta'=>$empleado->CodigoTarjeta,
                'areas_acceso'=>$areas_permitidas,
                'areas_solicitadas'=>$areas_solicitadas,
                'punto_accesos_id'=>$id_cliente,
                'permitido'=> $permitido,
            ]);
            return $permitido;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Marcaciones  $marcaciones
     * @return \Illuminate\Http\Response
     */
    public function show(Marcaciones $marcaciones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Marcaciones  $marcaciones
     * @return \Illuminate\Http\Response
     */
    public function edit(Marcaciones $marcaciones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Marcaciones  $marcaciones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Marcaciones $marcaciones)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marcaciones  $marcaciones
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marcaciones $marcaciones)
    {
        //
    }
}
