<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use App\Models\User;
use App\Models\UserSala;
use Illuminate\Http\Request;
use App\Models\SolicitudSala;
use App\Notifications\SolicitudProfesor;
use App\Http\Resources\SolicitudSalaCollection;
use App\Notifications\SolicitudAceptada;

class SolicitudSalaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, User $user, Sala $sala)
    {
        $this->authorize('create', [SolicitudSala::class, $user, $sala]);

        $solicitud = SolicitudSala::create([
            'sala_id'=> $sala->id,
            'user_id'=> $user->id,
        ]);

        $user->notify(new SolicitudProfesor(
            $sala->id, 
            $sala->nombre,
            $user->id,
            $user->name . ' ' . $user->apellido_paterno . ' ' . $user->apellido_materno,
            $user->usuario,
            $solicitud->id,
        ));

        return response()->noContent();
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user, Sala $sala, SolicitudSala $solicitudSala)
    {
        $this->authorize('view', [$solicitudSala, $sala]);

        return new SolicitudSalaCollection(SolicitudSala::where('id', $solicitudSala->id)->with('sala')->get());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SolicitudSala $solicitudSala)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, Sala $sala, SolicitudSala $solicitudSala)
    {
        $this->authorize('delete', [$solicitudSala, $sala]);

        UserSala::create([
            'profesor' => 1,
            'user_id' => auth()->user()->id,
            'sala_id' => $sala->id,
        ]);

        $sala->user->notify(new SolicitudAceptada(
            $sala->id, 
            $sala->nombre, 
            auth()->user()->id, 
            auth()->user()->name . ' ' . auth()->user()->apellido_paterno . ' ' . auth()->user()->apellido_materno,
            auth()->user()->usuario
        ));

        $solicitudSala->delete();

        return response()->noContent();
    }
}
