<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;
    public const UPDATED_AT = null;

    protected $fillable = [
        'body',
        'method',
        'url',
        'code',
    ];
}
