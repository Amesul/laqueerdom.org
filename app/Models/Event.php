<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var string[]
     */
    protected $guarded = [];

    /**
     * @return BelongsToMany
     * Get all Users associated with this Event
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * @return BelongsTo
     * Get the Venue associated with this Event
     */
    public function venue(): BelongsTo
    {
        return $this->belongsTo(Venue::class);
    }

    /**
     * @return HasOne
     */
    public function show(): HasOne
    {
        return $this->hasOne(Show::class);
    }

    /**
     * @return string[]
     */
    protected function casts(): array
    {
        return [
            'date' => 'datetime',
        ];
    }
}
