<?php

namespace App\Http\Controllers;

use App\Http\Resources\TestSalaCollection;
use App\Http\Resources\VisitaSalaCollection;
use Carbon\Carbon;
use App\Models\VisitaSala;
use Illuminate\Http\Request;
use App\Models\RespuestaOptionSala;
use App\Models\Sala;
use App\Models\TestSala;

class SalaTestEduController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Sala $sala, TestSala $testSala)
    {
        $this->authorize('viewAny', [VisitaSala::class, $sala, $testSala]);
        
        return new TestSalaCollection([$testSala]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Sala $sala, TestSala $testSala)
    {
        $this->authorize('create', [VisitaSala::class, $sala, $testSala]);

        $datos = $this->validate($request, [
            'puntuacion' => 'required|numeric',
            'total' => 'required|numeric',
            'respuestas' => 'required|array',
        ]);
        
        $visita = auth()->user()->visitaSalas()->create([
            'puntuacion' => $datos['puntuacion'],
            'total' => $datos['total'],
            'test_sala_id' => $testSala->id,
        ]);

        foreach($datos['respuestas'] as $respuesta) {
            $respuestasOpciones = [];
            $respuestaVisita = $visita->respuestaVisitaSalas()->create([
                'valor' => $respuesta['valor'],
                'pregunta_id' => $respuesta['pregunta_id'],
            ]);

            foreach($respuesta['opciones_ids'] as $opcion_id) {
                $respuestasOpciones[] = [
                    'option_id' => $opcion_id,
                    'respuesta_visita_sala_id' => $respuestaVisita->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }

            RespuestaOptionSala::insert($respuestasOpciones);
        }

        return new VisitaSalaCollection([$visita]);
    }

    /**
     * Display the specified resource.
     */
    public function show(VisitaSala $visitaSala)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VisitaSala $visitaSala)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VisitaSala $visitaSala)
    {
        //
    }
}
