<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    const STATUS_PUBLISHED = 'PUBLISHED';
    const STATUS_DRAFF = 'DRAFF';

    protected $table = 'posts';
    protected $fillable = [
        'title',
        'image',
        'content',
        'status',
    ];
}