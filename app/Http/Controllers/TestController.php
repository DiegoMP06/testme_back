<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Test;
use App\Models\Instruction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\TestCollection;
use App\Models\PreguntasOption;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Test::class);

        return new TestCollection(
            Test::where('user_id', auth()->user()->id)
                ->orderBy('id', 'DESC')
                ->paginate(30)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Test::class);

        $datos = $this->validate($request, [
            'nombre' => 'required|max:100',
            'descripcion' => 'required|min:50|max:1000',
            'categoria_id' => 'required|numeric',
            'tipo_id' => 'required|numeric',
            'instrucciones' => 'required|array',
            'campos' => 'required|array',
            'camposExtra' => 'required|array',
        ]);

        $test = Auth::user()->tests()->create([
            'ultima_version' => 1.0,
        ]);

        $versionTest = $test->testVersions()->create([
            'nombre' => $datos['nombre'],
            'descripcion' => $datos['descripcion'],
            'version' => 1.0,
            'categoria_id' => $datos['categoria_id'],
            'tipo_id' => $datos['tipo_id'],
        ]);

        $instrucciones = [];

        foreach($datos['instrucciones'] as $instruccion) {
            $instrucciones[] = [
                'token' => $instruccion['token'],
                'titulo' => $instruccion['titulo'],
                'instruccion' => $instruccion['instruccion'],
                'max' => $instruccion['max'],
                'min' => $instruccion['min'],
                'test_version_id' => $versionTest->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        Instruction::insert($instrucciones);

        if($versionTest->tipo_id === 1) {
            $preguntasOpciones = [];
            $preguntas = [];
            $opciones = [];

            foreach($datos['campos']['preguntas'] as $pregunta) {
                $preguntas[] = $versionTest->preguntas()->create([
                    'token' => $pregunta['token'],
                    'pregunta' => $pregunta['pregunta'],
                    'type' => $pregunta['type'],
                    'required' => $pregunta['required'],
                    'campo_extra' => $pregunta['campo_extra'],
                    'extras' => json_encode($pregunta['extras']),
                ]);
            }

            foreach($datos['campos']['opciones'] as $opcion) {
                $opciones[] = $versionTest->options()->create([
                    'token' => $opcion['token'],
                    'opcion' => $opcion['opcion'],
                    'valor' => $opcion['valor'],
                ]);
            }
            
            foreach($preguntas as $pregunta) {
                foreach($opciones as $opcion) {
                    $preguntasOpciones[] = [
                        'pregunta_id' => $pregunta->id,
                        'option_id' => $opcion->id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                }
            }

            PreguntasOption::insert($preguntasOpciones);
        } else {

            foreach($datos['campos'] as $campo) {
                $preguntaCampo = $campo['pregunta'];
                $opcionesCampo = $campo['opciones'];

                $pregunta = $versionTest->preguntas()->create([
                    'token' => $preguntaCampo['token'],
                    'pregunta' => $preguntaCampo['pregunta'],
                    'type' => $preguntaCampo['type'],
                    'required' => $preguntaCampo['required'],
                    'campo_extra' => $preguntaCampo['campo_extra'],
                    'extras' => json_encode($preguntaCampo['extras']),
                ]);

                foreach($opcionesCampo as $opcion) {
                    $pregunta->options()->create([
                        'token' => $opcion['token'],
                        'opcion' => $opcion['opcion'],
                        'valor' => $opcion['valor'],
                        'test_version_id' => $versionTest->id,
                    ]);
                }
            }
        }

        foreach($datos['camposExtra'] as $campo) {
            $preguntaCampo = $campo['pregunta'];

            $pregunta = $versionTest->preguntas()->create([
                'token' => $preguntaCampo['token'],
                'pregunta' => $preguntaCampo['pregunta'],
                'type' => $preguntaCampo['type'],
                'required' => $preguntaCampo['required'],
                'campo_extra' => $preguntaCampo['campo_extra'],
                'extras' => json_encode($preguntaCampo['extras']),
            ]);

            if($pregunta->type === 'radio' || $pregunta->type === 'select' || $pregunta->type === 'checkbox') {
                $opcionesCampo = $campo['opciones'];
                
                foreach($opcionesCampo as $opcion) {
                    $pregunta->options()->create([
                        'token' => $opcion['token'],
                        'opcion' => $opcion['opcion'],
                        'valor' => $opcion['valor'],
                        'test_version_id' => $versionTest->id,
                    ]);
                }
            }
        }

        return response()->json([
            'test' => $test,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Test $test)
    {
        $this->authorize('view', $test);

        return new TestCollection([$test]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Test $test)
    {
        $this->authorize('update', $test);

        $datos = $this->validate($request, [
            'test' => 'required|array',
            'instrucciones' => 'required|array',
            'campos' => 'required|array',
            'camposExtra' => 'required|array',
        ]);

        $test->ultima_version = floatval($test->ultima_version) + 0.1;
        $test->save();

        $versionTest = $test->testVersions()->create([
            'nombre' => $datos['test']['nombre'],
            'descripcion' => $datos['test']['descripcion'],
            'version' => $test->ultima_version,
            'categoria_id' => $datos['test']['categoria_id'],
            'tipo_id' => $datos['test']['tipo_id'],
        ]);

        $instrucciones = [];

        foreach($datos['instrucciones'] as $instruccion) {
            $instrucciones[] = [
                'token' => $instruccion['token'],
                'titulo' => $instruccion['titulo'],
                'instruccion' => $instruccion['instruccion'],
                'max' => $instruccion['max'],
                'min' => $instruccion['min'],
                'test_version_id' => $versionTest->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        Instruction::insert($instrucciones);

        if($versionTest->tipo_id === 1) {
            $preguntasOpciones = [];
            $preguntas = [];
            $opciones = [];

            foreach($datos['campos']['preguntas'] as $pregunta) {
                $preguntas[] = $versionTest->preguntas()->create([
                    'token' => $pregunta['token'],
                    'pregunta' => $pregunta['pregunta'],
                    'type' => $pregunta['type'],
                    'required' => $pregunta['required'],
                    'campo_extra' => $pregunta['campo_extra'],
                    'extras' => json_encode($pregunta['extras']),
                ]);
            }

            foreach($datos['campos']['opciones'] as $opcion) {
                $opciones[] = $versionTest->options()->create([
                    'token' => $opcion['token'],
                    'opcion' => $opcion['opcion'],
                    'valor' => $opcion['valor'],
                ]);
            }
            
            foreach($preguntas as $pregunta) {
                foreach($opciones as $opcion) {
                    $preguntasOpciones[] = [
                        'pregunta_id' => $pregunta->id,
                        'option_id' => $opcion->id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                }
            }

            PreguntasOption::insert($preguntasOpciones);
        } else {

            foreach($datos['campos'] as $campo) {
                $preguntaCampo = $campo['pregunta'];
                $opcionesCampo = $campo['opciones'];

                $pregunta = $versionTest->preguntas()->create([
                    'token' => $preguntaCampo['token'],
                    'pregunta' => $preguntaCampo['pregunta'],
                    'type' => $preguntaCampo['type'],
                    'required' => $preguntaCampo['required'],
                    'campo_extra' => $preguntaCampo['campo_extra'],
                    'extras' => json_encode($preguntaCampo['extras']),
                ]);

                foreach($opcionesCampo as $opcion) {
                    $pregunta->options()->create([
                        'token' => $opcion['token'],
                        'opcion' => $opcion['opcion'],
                        'valor' => $opcion['valor'],
                        'test_version_id' => $versionTest->id,
                    ]);
                }
            }
        }

        foreach($datos['camposExtra'] as $campo) {
            $preguntaCampo = $campo['pregunta'];

            $pregunta = $versionTest->preguntas()->create([
                'token' => $preguntaCampo['token'],
                'pregunta' => $preguntaCampo['pregunta'],
                'type' => $preguntaCampo['type'],
                'required' => $preguntaCampo['required'],
                'campo_extra' => $preguntaCampo['campo_extra'],
                'extras' => json_encode($preguntaCampo['extras']),
            ]);

            if($pregunta->type === 'radio' || $pregunta->type === 'select' || $pregunta->type === 'checkbox') {
                $opcionesCampo = $campo['opciones'];
                
                foreach($opcionesCampo as $opcion) {
                    $pregunta->options()->create([
                        'token' => $opcion['token'],
                        'opcion' => $opcion['opcion'],
                        'valor' => $opcion['valor'],
                        'test_version_id' => $versionTest->id,
                    ]);
                }
            }
        }

        return response()->json([
            'test' => $test,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Test $test)
    {
        $this->authorize('delete', $test);

        $test->delete();

        return response()->json(['test' => null]);
    }
}
