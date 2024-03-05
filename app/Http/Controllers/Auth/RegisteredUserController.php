<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request) : Response
    {
        $request->request->add([
            'usuario' => Str::slug($request->usuario),
        ]);

        $datos = $request->validated();

        $user = User::create([
            'name' => $datos['name'],
            'email' => $datos['email'],
            'password' => Hash::make($datos['password']),
            'apellido_paterno' => $datos['apellido_paterno'],
            'apellido_materno' => $datos['apellido_materno'],
            'usuario' => $datos['usuario'],
            'perfil' => '{"email":false,"created_at":false,"telefono":false}',
        ]);

        event(new Registered($user));

        Auth::login($user);

        return response([
            'AUTH_TOKEN' => $user->createToken('AUTH_TOKEN')->plainTextToken,
            'user' => $user,
        ]);
    }
}
