<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=> $this->id,
            "name"=> $this->name,
            "apellido_paterno"=> $this->apellido_paterno,
            "apellido_materno"=> $this->apellido_materno,
            "usuario"=> $this->usuario,
            'imagen' => $this->imagen,
            "email"=> $this->when(json_decode($this->perfil)->email, $this->email),
            "telefono"=> $this->when(json_decode($this->perfil)->telefono, $this->telefono),
            "biografia"=> $this->biografia,
            'cargo' => CargoResource::collection([$this->cargo])[0],
            'admin' => $this->admin ? true : false,
            'cargo_id' => $this->cargo_id,
            'email_verified_at' => $this->email_verified_at,
            'salas' => $this->when($request->wSalasUser, SalaResource::collection($this->salas()->where('acceso', 1)->limit(10)->get())),
            'enlacesSalas' => $this->when($request->wSalasUser, SalaResource::collection($this->enlaceSalas()->where('acceso', 1)->limit(10)->get())),
            'enlazado' => $this->when($request->sala && $request->wEnlaceUser, $this->estaEnlazado($request->sala->id ?? null)),
            "created_at"=> $this->when(json_decode($this->created_at), $this->created_at),
            'pivot' => $this->when($this->pivot, $this->pivot ?? null),
        ];
    }
}
