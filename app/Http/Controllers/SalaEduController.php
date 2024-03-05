<?php

namespace App\Http\Controllers;

use App\Http\Resources\SalaCollection;
use App\Models\Sala;
use App\Models\UserSala;
use App\Notifications\NuevoAlumno;
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
    public function store(Request $request, Sala $sala)
    {
        $this->authorize('create', [UserSala::class, $sala]);

        if(!$sala->publico && !password_verify($request->password, $sala->password)) {
            return response([
                'errors' => ['password' => ['Clave de Ingreso Incorrecta']]
            ], 422);
        }

        UserSala::create([
            'profesor' => 0,
            'user_id' => auth()->user()->id,
            'sala_id' => $sala->id,
        ]);

        $sala->user->notify(new NuevoAlumno(
            $sala->id, 
            $sala->nombre, 
            auth()->user()->id, 
            auth()->user()->name . ' ' . auth()->user()->apellido_paterno . ' ' . auth()->user()->apellido_materno,
            auth()->user()->usuario
        ));

        return new SalaCollection([Sala::find($sala->id)]);
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
    public function destroy(Sala $sala, UserSala $userSala)
    {
        $this->authorize('delete', [$userSala, $sala]);
        $userSala->delete();
        return new SalaCollection([Sala::find($sala->id)]);
    }
}
