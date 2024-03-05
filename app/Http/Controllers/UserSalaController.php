<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use App\Models\User;
use App\Models\UserSala;
use Illuminate\Http\Request;
use App\Http\Resources\SalaCollection;
use App\Http\Resources\UserCollection;
use App\Notifications\UsuarioExpulsado;

class UserSalaController extends Controller
{
    public $busqueda;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Sala $sala)
    {
        $this->authorize('viewAny', [UserSala::class, $sala]);

        return new UserCollection($sala->usuarios()->where('profesor', $request->wProfesoresSala)->orderBy('name', 'ASC')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Sala $sala)
    {
        $this->authorize('view', $sala);

        $this->busqueda = $request->busqueda;

        return new UserCollection(User::when($this->busqueda, function($query, $busqueda) {
                $query->where(function($query) {
                    $query
                        ->where('name', 'LIKE', "%" . $this->busqueda . "%")
                        ->orWhere('apellido_paterno', 'LIKE', '%' . $this->busqueda . '%')
                        ->orWhere('apellido_materno', 'LIKE', '%' . $this->busqueda . '%')
                        ->orWhere('usuario', 'LIKE', '%' . $this->busqueda . '%');
                });
            })
            ->whereNotNull("email_verified_at")
            ->where(function($query) {  
                $query
                    ->where('cargo_id', 2)
                    ->orWhere('cargo_id', 3);
            })
            ->orderBy('id', 'DESC')
            ->paginate(40)
        );
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
        $this->authorize("delete", $sala);

        $user = $userSala->user;
        $profesor =  $userSala->profesor;

        $userSala->delete();

        $user->notify(new UsuarioExpulsado(
            $sala->id, 
            $sala->nombre, 
            $user->id, $user->name . ' ' . $user->apellido_paterno . ' ' . $user->apellido_materno, 
            $user->usuario
        ));

        return [
            'dataSala' => new SalaCollection([$sala]),
            'dataUsuarios' => new UserCollection($sala->usuarios()->where('profesor', $profesor)->orderBy('name', 'ASC')->get())
        ];
    }
}
