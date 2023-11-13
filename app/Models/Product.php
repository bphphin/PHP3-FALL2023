<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    const STATUS_DRAFF = 'DRAFF';
    const STATUS_PUBLISHED = 'PUBLISHED';
    protected $fillable = [
        'thumbnail',
        'name',
        'price',
        'sales_price',
        'status',
    ];
}
