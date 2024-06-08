<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // Add user_id to the fillable array
        'model',
        'brand',
        'registration_number',
        'picture',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
