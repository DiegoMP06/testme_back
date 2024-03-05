<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserSalaResource extends JsonResource
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
            'profesor' => $this->profesor ? true : false,
            'user_id' => $this->user_id,
            'sala_id' => $this->sala_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'sala' => SalaResource::collection([$this->sala])[0],
        ];
    }
}
