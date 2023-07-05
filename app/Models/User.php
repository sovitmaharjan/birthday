<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'email',
        'address',
        'dob',
        'extra'
    ];

    protected $casts = [
        'dob' => 'date',
        'extra' => 'array'
    ];

    public function getDobAttribute($value)
    {
        return $value;
    }
}
