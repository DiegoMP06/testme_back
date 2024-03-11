<?php

namespace App\Http\Controllers;

use App\Models\Visita;
use Illuminate\Http\Request;
use App\Http\Resources\VisitaCollection;
use App\Models\TestVersion;

class VisitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, TestVersion $testVersion)
    {
        $this->authorize('viewAny', [Visita::class, $testVersion]);

        return new VisitaCollection(
            Visita::when($request->busqueda, function($query, $busqueda) {
                    $query->where('created_at', 'LIKE', '%' . $busqueda . '%');
                })
                ->where('test_version_id', $testVersion->id)
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
    public function show(TestVersion $testVersion, Visita $visita)
    {
        $this->authorize('view', [$visita, $testVersion]);

        return new VisitaCollection([$visita]);
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
