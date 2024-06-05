<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Show extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function performances(): HasMany
    {
        return $this->hasMany(Performance::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    protected function deadline(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => Carbon::parse($value),
            set: fn(string $value) => Carbon::parse($value)->addHours(23)->addMinutes(59)->addseconds(59),
        );
    }
}
