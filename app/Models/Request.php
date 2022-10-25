<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Request extends Model
{
    use HasFactory;
    use AsSource;

    public const UPDATED_AT = null;
    public const TABLE = 'requests';
    protected $table = self::TABLE;

    protected $fillable = [
        'body',
        'method',
        'url',
        'code',
    ];
}
