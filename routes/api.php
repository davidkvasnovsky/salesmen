<?php

declare(strict_types=1);

use Domains\Salesman\Models\Salesman;
use Illuminate\Support\Facades\Route;

Route::get('/', static fn () => ['hey' => 'there'])->name('ping');

Route::get('/token', static fn () => response()->json([
    'token' => Salesman::first()->createToken(name: 'auth-token')->plainTextToken,
]));
