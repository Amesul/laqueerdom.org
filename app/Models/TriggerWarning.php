<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TriggerWarning extends Model
{
    use HasFactory;
    protected $fillable = [
        'slug',
        'name',
    ];

    public function performances(): BelongsToMany
    {
        return $this->belongsToMany(Performance::class);
    }
}
