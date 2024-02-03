<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PreguntaResource extends JsonResource
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
            'token' => $this->token,
            'pregunta' => $this->pregunta,
            'type' => $this->type,
            'required' => $this->required ? true: false,
            'campo_extra' => $this->campo_extra ? true : false,
            'extras' => json_decode($this->extras),
            'test_version_id' => $this->test_version_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'opciones' => $this->options,
        ];
    }
}
