<?php

namespace App\Http\Controllers;

use App\Http\Resources\SalaCollection;
use App\Models\Sala;
use Illuminate\Http\Request;

class SalaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Sala::class);

        return new SalaCollection(
            Sala::where('user_id', auth()->user()->id)
            ->orderBy('id', 'DESC')
            ->paginate(30)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Sala::class);

        $datos = $this->validate($request, [
            'nombre' => 'required|max:100',
            'descripcion' => 'required|min:50|max:1000',
            'num_alumnos' => 'required|integer|min:1|max:1000',
            'num_profesores' => 'required|integer|min:0|max:20',
            'publico' => 'required|boolean',
            'password' => 'nullable|min:6|max:20'
        ]);

        $sala = auth()->user()->salas()->create([
            'nombre' => $datos['nombre'],
            'descripcion' => $datos['descripcion'],
            'num_alumnos' => $datos['num_alumnos'],
            'num_profesores' => $datos['num_profesores'],
            'password' => bcrypt($datos['password']),
            'publico' => $datos['publico'],
        ]);

        return response()->json([
            'sala' => $sala,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Sala $sala)
    {
        $this->authorize('view', $sala);

        return new SalaCollection([$sala]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sala $sala)
    {
        $this->authorize('update', $sala);

        $datos = $this->validate($request, [
            'nombre' => 'nullable|max:100',
            'descripcion' => 'nullable|min:50|max:1000',
            'num_alumnos' => 'nullable|integer|min:1|max:1000',
            'num_profesores' => 'nullable|integer|min:0|max:20',
            'publico' => 'nullable|boolean',
            'acceso' => 'nullable|boolean',
            'password' => 'nullable|min:6|max:20'
        ]);

        $sala->nombre = isset($datos['nombre']) ? $datos['nombre'] : $sala->nombre;
        $sala->descripcion = isset($datos['descripcion']) ? $datos['descripcion'] : $sala->descripcion;
        $sala->num_alumnos = isset($datos['num_alumnos']) ? $datos['num_alumnos'] : $sala->num_alumnos;
        $sala->num_profesores = isset($datos['num_profesores']) ? $datos['num_profesores'] : $sala->num_profesores;
        $sala->publico = isset($datos['publico']) ? $datos['publico'] : $sala->publico;
        $sala->acceso = isset($datos['acceso']) ? $datos['acceso'] : $sala->acceso;
        $sala->password = isset($datos['password']) ? bcrypt($datos['password']) : $sala->password;
        $sala->save();

        return new SalaCollection([$sala]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sala $sala)
    {
        $this->authorize('delete', $sala);

        $sala->delete();    

        return response()->json(['sala' => null]);
    }
}