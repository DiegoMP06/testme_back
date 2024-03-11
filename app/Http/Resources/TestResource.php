<?php

namespace App\Http\Resources;

use App\Models\TestVersion;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TestResource extends JsonResource
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
            'ultima_version' => $this->ultima_version,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'versiones' => $this->when($request->wVersiones, $this->testVersions()->count()),
            'versionesCollection' => $this->when($request->wCollVersiones, TestVersionResource::collection($this->testVersions)),
            'version' => $this->when($request->wVersion, TestVersionResource::collection([$this->testVersions[$this->testVersions->count() - 1]])),
            'user' => $this->when($request->wUserTest, UserResource::collection([$this->user])[0]),
        ];
    }
}
