<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    const IS_ACTIVE = 'IsActive';
    const IN_ACTIVE = 'InActive';

    protected $fillable = [
        'company_name',
        'account',
        'avatar',
        'project',
        'invoices',
        'tags',
        'category',
        'status',
    ];
}
