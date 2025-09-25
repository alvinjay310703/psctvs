<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model; // ✅ this is what you missed
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_number',
        'name',
        'gender',
        'dob',
        'contact',
        'email',
        'address',
        'city',
        'province',
        'zip',
        'status',
        'plan',
    ];

    protected $casts = [
        'dob' => 'date',
    ];
}
