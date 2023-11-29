<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = [
        'airline_id',
        'name',
        'image',
        'total_passengers',
        'description',
    ];

    public function airline(): BelongsTo
    {
        return $this->belongsTo(Airline::class);
    }
}
