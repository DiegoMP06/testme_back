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
            "test_sala_id"=> $this->test_version_id,
            "created_at"=> $this->created_at,
            "updated_at"=> $this->updated_at,
            'respuestas' => $this->when($this->puedeVerRespuestas(), RespuestaVisitaSalaResource::collection($this->respuestaVisitaSalas)),
        ];
    }
}
