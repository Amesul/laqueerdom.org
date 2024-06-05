<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Performance extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * @var string[]
     */
    protected $guarded = [];


    public function advancement(): Attribute
    {
        return new Attribute(
            get: fn() => $this->calculateAdvancement()
        );
    }

    private function calculateAdvancement(): int
    {
        $percent = 0;
        if ($this->title) {
            $percent += 15;
        }
        if ($this->description) {
            $percent += 30;
        }
        if ($this->stage_requirements) {
            $percent += 10;
        }
        if ($this->duration) {
            $percent += 15;
        }
        if ($this->file) {
            $percent += 15;
        }
        if ($this->triggerWarnings) {
            $percent += 15;
        }
        return $percent;
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function show(): BelongsTo
    {
        return $this->belongsTo(Show::class);
    }

    /**
     * @return BelongsToMany
     */
    public function triggerWarnings(): BelongsToMany
    {
        return $this->belongsToMany(TriggerWarning::class);
    }
}
