<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'name',
        'email',
        'address',
        'birthday',
        'extra'
    ];

    protected $casts = [
        'birthday' => 'datetime',
        'extra' => 'array'
    ];
}
