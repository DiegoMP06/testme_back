<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RespuestaVisitaResource extends JsonResource
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
            "valor"=> $this->valor,
            "pregunta_id"=> $this->pregunta_id,
            "visita_id"=> $this->visita_id,
            "created_at"=> $this->created_at,
            "updated_at"=> $this->updated_at,
            'pregunta' => PreguntaResource::collection([$this->pregunta])[0],
            'options' => $this->options,
        ];
    }
}
