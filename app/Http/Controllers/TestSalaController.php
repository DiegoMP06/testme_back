<?php

namespace App\Http\Controllers;

use App\Http\Resources\TestVersionCollection;
use App\Models\Sala;
use App\Models\TestSala;
use Illuminate\Http\Request;

class TestSalaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Sala $sala)
    {
        $this->authorize("viewAny", [TestSala::class, $sala, false]);

        return new TestVersionCollection($sala->tests);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Sala $sala)
    {
        $this->authorize('create', [TestSala::class, $sala, $request->test_id]);

        TestSala::create([
            'test_version_id'=> $request->test_id,
            'sala_id'=> $sala->id,
        ]);

        return response()->noContent();
    }

    /**
     * Display the specified resource.
     */
    public function show(TestSala $testSala)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TestSala $testSala)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sala $sala, TestSala $testSala)
    {
        $this->authorize('delete', [$testSala, $sala, false]);

        $testSala->delete();

        return response()->noContent();
    }
}
