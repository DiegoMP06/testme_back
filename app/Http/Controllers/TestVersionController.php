<?php

namespace App\Http\Controllers;

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
        //
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
    public function update(Request $request, TestVersion $testVersion, Test $test)
    {
        $this->authorize('update', $test);

        $datos = $this->validate($request, [
            'respuestas' => 'nullable|boolean',
            'publico' => 'nullable|boolean',
        ]);

        $testVersion->respuestas  = isset($datos['respuestas']) ? $datos['respuestas'] : $testVersion->respuestas;
        $testVersion->publico  = isset($datos['publico']) ? $datos['publico'] : $testVersion->publico;
        $testVersion->save();

        return response()->json([
            'version' => $testVersion,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TestVersion $testVersion, Test $test)
    {
        $this->authorize('delete', $test);

        $testVersion->delete();

        return response()->json(['version' => null]);
    }
}
