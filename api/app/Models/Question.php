<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Ramsey\Uuid\Uuid;

class Question extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'politician_id',
        'body',
        'rationale',
        'status',
        'published_at',
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
            'user_id' => 'integer',
            'politician_id' => 'integer',
            'published_at' => 'timestamp',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function politician(): BelongsTo
    {
        return $this->belongsTo(Politician::class);
    }

    public function answers(): HasMany
    {
        // Check if user is logged in and has role super_admin or moderator, if so, return all answers, otherwise return only published answers
        if (auth()->check() && auth()->user()->hasRole(['super_admin', 'moderator'])) {
            return $this->hasMany(Answer::class);
        } else {
            return $this->hasMany(Answer::class)->where('status', 'published');
        }
    }

    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    /**
     * Get the votes where is_upvote is true (upvotes).
     */
    public function upvotes(): HasMany
    {
        return $this->hasMany(Vote::class)->where('is_upvote', true);
    }

    /**
     * Get the votes where is_upvote is false (downvotes).
     */
    public function downvotes(): HasMany
    {
        return $this->hasMany(Vote::class)->where('is_upvote', false);
    }

     /**
     * The topics that belong to the question.
     */

    public function topics(): BelongsToMany
    {
        return $this->belongsToMany(Topic::class);
    }

    public function newUniqueId(): string
    {
        return (string) Uuid::uuid4();
    }

    public function uniqueIds(): array
    {
        return ['uuid'];
    }
}
