<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VisitaSalaResource extends JsonResource
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
            "puntuacion"=> $this->puntuacion,
            "total"=> $this->total,
            "user_id"=> $this->user_id,
            "test_sala_id"=> $this->test_sala_id,
            "created_at"=> $this->created_at,
            "updated_at"=> $this->updated_at,
            'user' => $this->when($request->wUserVisitaSala, UserResource::collection([$this->user])[0]),
            'test' => $this->when($request->wTestVersionVisitaSala, TestVersionResource::collection([$this->testSala->testVersion])[0]),
            'sala' => $this->when($request->wSalaVisitaSala, SalaResource::collection([$this->testSala->sala])[0]),
            'respuestas' => $this->when($this->puedeVerRespuestas() || $request->wRespuestasVisitaSala, RespuestaVisitaSalaResource::collection($this->respuestaVisitaSalas)),
        ];
    }
}
