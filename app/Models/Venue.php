<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;
    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'address',
        'address2',
        'zip_code',
        'city',
        'country',
    ];
}
