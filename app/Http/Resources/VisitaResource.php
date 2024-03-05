<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VisitaResource extends JsonResource
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
            "test_version_id"=> $this->test_version_id,
            "created_at"=> $this->created_at,
            "updated_at"=> $this->updated_at,
            'test' => $this->when($request->wTestVersionVisita, TestVersionResource::collection([$this->testVersion])[0]),
            'respuestas' => $this->when($this->puedeVerRespuestas() || $request->wRespuestasVisita, RespuestaVisitaResource::collection($this->respuestaVisitas))
        ];
    }
}
