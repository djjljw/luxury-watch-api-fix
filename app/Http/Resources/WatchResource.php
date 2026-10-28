<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WatchResource extends JsonResource
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
            'nama' => $this->nama,
            'brand' => $this->brand,
            'harga' => (int) $this->harga,
            'tahun_rilis' => (int) $this->tahun_rilis,
            'tipe_gerakan' => $this->tipe_gerakan,
            'material' => $this->material,
            'status' => $this->status,
            'foto' => $this->foto,
        ];
    }
}
