<?php

namespace App\Http\Controllers;

use App\Http\Resources\VisitaSalaCollection;
use App\Models\TestSala;
use App\Models\TestVersion;
use App\Models\VisitaSala;
use Illuminate\Http\Request;

class VisitaSalaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, TestVersion $testVersion, TestSala $testSala)
    {
        $this->authorize('viewAny', [VisitaSala::class, $testVersion, $testSala, true]);

        return new VisitaSalaCollection(
            VisitaSala::when($request->busqueda, function($query, $busqueda) {
                    $query->where('created_at', 'LIKE', '%' . $busqueda . '%');
                })
                ->where('test_sala_id', $testSala->id)
                ->orderBy('id', 'DESC')->paginate(20)
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
    public function show(TestVersion $testVersion, TestSala $testSala, VisitaSala $visitaSala)
    {
        $this->authorize('view', [$visitaSala, $testVersion, $testSala]);

        return new VisitaSalaCollection([$visitaSala]);
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
