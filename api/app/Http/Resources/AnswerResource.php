<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
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
            'body' => $this->body,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'politician' => $this->whenLoaded('politician', function () {
                return new PoliticianResource($this->politician);
            }),
            'question' => $this->whenLoaded('question', function () {
                return new QuestionResource($this->question);
            }),
        ];
    }
}
