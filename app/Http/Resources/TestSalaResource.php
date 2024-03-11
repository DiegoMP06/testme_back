<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TestSalaResource extends JsonResource
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
            "sala_id"=> $this->sala_id,
            "test_version_id"=> $this->test_version_id,
            'sala' => $this->when($request->wSalaTestSala, SalaResource::collection([$this->sala])[0]),
            'test_version'=> $this->when($request->wTestVersionTestSala, TestVersionResource::collection([$this->testVersion])[0]),
            'visitaSala' => $this->when($request->wVisitaSala && $this->existeVisitaSala(), VisitaSalaResource::collection($this->visitaSalas()->where('user_id', auth()->user()->id)->get()))
        ];
    }
}
