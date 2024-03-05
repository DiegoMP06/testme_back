<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\TestSala;
use Illuminate\Http\Request;
use App\Http\Resources\TestCollection;
use App\Models\Sala;

class TestSalaEduController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Sala $sala)
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
        //
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
    public function destroy(TestSala $testSala)
    {
        //
    }
}
