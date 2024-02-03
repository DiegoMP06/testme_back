<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function register(RegisterRequest $request) 
    {
        $request->request->add([
            'usuario' => Str::slug($request->usuario),
        ]);

        $datos = $request->validated();

        $user = User::create([
            'name' => $datos['name'],
            'email' => $datos['email'],
            'password' => bcrypt($datos['password']),
            'apellido_paterno' => $datos['apellido_paterno'],
            'apellido_materno' => $datos['apellido_materno'],
            'usuario' => $datos['usuario'],
            'perfil' => '{"email":false,"created_at":false,"telefono":false,"biografia":false,"rol":true}',
        ]);

        return [
            'AUTH_TOKEN' => $user->createToken('AUTH_TOKEN')->plainTextToken,
            'user' => $user,
        ];
    }

    public function login(LoginRequest $request) 
    {
        
        $datos = $request->validated();

        if(!auth()->attempt($datos, $request->remember)) {
            return response([
                'errors' => ['email' => ['Correo Electronico o Contraseña Incorrectos']]
            ], 422);
        }

        $user = auth()->user();

        return [
            'AUTH_TOKEN' => $user->createToken('AUTH_TOKEN')->plainTextToken,
            'user' => $user,
        ];
    } 

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();

        return [
            'user' => null,
        ];
    }
}
