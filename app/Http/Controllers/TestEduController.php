<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Test;
use App\Models\Visita;
use App\Models\TestVersion;
use Illuminate\Http\Request;
use App\Http\Resources\TestVersionCollection;
use App\Models\RespuestaOpcion;

class TestEduController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TestVersion $testVersion)
    {
        $this->authorize('viewAny', [Visita::class, $testVersion]);

        return new TestVersionCollection([$testVersion]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, TestVersion $testVersion)
    {
        $this->authorize('create', [Visita::class, $testVersion]);

        $datos = $this->validate($request, [
            'puntuacion' => 'required|numeric',
            'total' => 'required|numeric',
            'respuestas' => 'required|array',
        ]);
        
        $visita = auth()->user()->visitas()->create([
            'puntuacion' => $datos['puntuacion'],
            'total' => $datos['total'],
            'test_version_id' => $testVersion->id,
        ]);

        foreach($datos['respuestas'] as $respuesta) {
            $respuestasOpciones = [];
            $respuestaVisita = $visita->respuestaVisitas()->create([
                'valor' => $respuesta['valor'],
                'pregunta_id' => $respuesta['pregunta_id'],
            ]);

            foreach($respuesta['opciones_ids'] as $opcion_id) {
                $respuestasOpciones[] = [
                    'option_id' => $opcion_id,
                    'respuesta_visita_id' => $respuestaVisita->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }

            RespuestaOpcion::insert($respuestasOpciones);
        }

        return response()->json([
            'visita' => $visita,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Visita $visita)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Visita $visita)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Visita $visita)
    {
        //
    }
}
