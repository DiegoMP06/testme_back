<?php

namespace App\Http\Controllers;

use App\Http\Resources\TestVersionCollection;
use App\Models\Test;
use App\Models\TestVersion;
use Illuminate\Http\Request;
use Illuminate\Foundation\Console\LangPublishCommand;

class TestVersionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Test $test)
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Test $test)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TestVersion $testVersion, Test $test)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Test $test, TestVersion $testVersion)
    {
        $this->authorize('update', $test);

        $datos = $this->validate($request, [
            'nombre' => 'nullable|max:100',
            'descripcion' => 'nullable|min:50|max:1000',
            'categoria_id' => 'nullable|numeric',
            'respuestas' => 'nullable|boolean',
            'publico' => 'nullable|boolean',
        ]);

        $testVersion->nombre  = isset($datos['nombre']) ? $datos['nombre'] : $testVersion->nombre;
        $testVersion->descripcion  = isset($datos['descripcion']) ? $datos['descripcion'] : $testVersion->descripcion;
        $testVersion->categoria_id  = isset($datos['categoria_id']) ? $datos['categoria_id'] : $testVersion->categoria_id;
        $testVersion->respuestas  = isset($datos['respuestas']) ? $datos['respuestas'] : $testVersion->respuestas;
        $testVersion->publico  = isset($datos['publico']) ? $datos['publico'] : $testVersion->publico;
        $testVersion->save();

        return new TestVersionCollection([$testVersion]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Test $test, TestVersion $testVersion)
    {
        $this->authorize('delete', $test);

        $testVersion->delete();

        return response()->json(['version' => null]);
    }
}
