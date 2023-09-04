<?php

declare(strict_types=1);

namespace Domains\Salesman\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\LaravelData\WithData;

final class Salesman extends Authenticatable
{
    use HasApiTokens;
    use HasUuids;
    use WithData;

    protected $fillable = [
        'first_name',
        'last_name',
        'titles_before',
        'titles_after',
        'prosight_id',
        'email',
        'phone',
        'gender',
        'marital_status',
    ];

    protected $casts = [
        'titles_before' => 'array',
        'titles_after' => 'array',
        'created_at' => 'immutable_datetime',
        'updated_at' => 'immutable_datetime',
    ];
}
