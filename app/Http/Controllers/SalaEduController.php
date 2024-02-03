<?php

namespace App\Http\Controllers;

use App\Http\Resources\SalaCollection;
use App\Models\Sala;
use App\Models\UserSala;
use Illuminate\Http\Request;

class SalaEduController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Sala $sala)
    {
        $this->authorize('viewAny', [UserSala::class, $sala]);

        return new SalaCollection([$sala]);
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
    public function show(UserSala $userSala)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserSala $userSala)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserSala $userSala)
    {
        //
    }
}
