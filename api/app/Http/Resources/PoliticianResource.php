<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PoliticianResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'avatar_url' => $this->avatar_url,
            'party_name' => $this->currentMandate?->party?->name,
            'party_color' => $this->currentMandate?->party?->color,
            'party_abbreviation' => $this->currentMandate?->party?->abbreviation,
            'council_name' => $this->currentMandate?->council?->name ?? 'Ehemaliges Mitglied',
        ];
    }
}
