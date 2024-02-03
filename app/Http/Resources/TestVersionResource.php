<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TestVersionResource extends JsonResource
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
            'respuestas' => $this->respuestas ? true : false,
            'publico' => $this->publico ? true : false,
            'version' => $this->version,
            'test_id' => $this->test_id,
            'categoria_id' => $this->categoria_id,
            'tipo_id' => $this->tipo_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'tipo' => $this->when($request->wTipo, $this->tipo),
            'categoria' => $this->when($request->wCategoria, $this->categoria),
            'instrucciones' => $this->when($request->wInstructions, $this->instructions),
            'campos' => $this->when($request->wCampos, PreguntaResource::collection($this->preguntas()->where('campo_extra', 0)->get())),
            'camposExtra' => $this->when($request->wCamposExtra, PreguntaResource::collection($this->preguntas()->where('campo_extra', 1)->get())),
            'visita' => $this->when($request->wVisita && $this->existeVisita(), $this->visitas->where('user_id', auth()->user()->id)),
            'user' => $this->when($request->wUserVersion, $this->test->user),
        ];
    }
}
