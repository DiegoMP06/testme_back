<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SalaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'num_alumnos' => $this->num_alumnos,
            'num_profesores' => $this->num_profesores,
            'publico' => $this->publico ? true : false,
            'acceso' => $this->acceso ? true : false,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => $this->when($request->wUserSala, $this->user),
            'alumnos' => $this->when($request->wAlumnosSala, $this->usuarios()->where('profesor', 0)->get()),
            'profesores' => $this->when($request->wProfesoresSala, $this->usuarios()->where('profesor', 1)->get()),
            'enlace' => $this->when($request->wEnlace && $this->existeEnlace(), $this->usuarios()->where('user_id', auth()->user()->id)->get()),
        ];
    }
}
