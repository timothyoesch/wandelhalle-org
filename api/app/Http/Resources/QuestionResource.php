<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "uuid" => $this->uuid,
            "body" => $this->body,
            "rationale" => $this->rationale,
            "status" => $this->status,
            "created_at" => $this->created_at,
            'user' => $this->whenLoaded('user', function () {
                return new UserResource($this->user);
            }),
            'politician' => $this->whenLoaded('politician', function () {
                return new PoliticianResource($this->politician);
            }),
            'topics' => $this->whenLoaded('topics', function () {
                return $this->topics->pluck('name');
            }),
            "answers" => $this->whenLoaded('answers', function () {
                return AnswerResource::collection($this->answers);
            }),
            "upvotes_count" => $this->whenCounted('upvotes'),
            "downvotes_count" => $this->whenCounted('downvotes'),
            "upvoted" => (bool) $this->upvoted,
            "downvoted" => (bool) $this->downvoted,
        ];
    }
}
