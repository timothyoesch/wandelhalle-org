<?php

namespace App\Models;

use App\Models\Scopes\PublishedStatusScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ScopedBy(PublishedStatusScope::class)]
class Answer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question_id',
        'politician_id',
        'body',
        'status',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'question_id' => 'integer',
            'politician_id' => 'integer',
        ];
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function politician(): BelongsTo
    {
        return $this->belongsTo(Politician::class);
    }
}
