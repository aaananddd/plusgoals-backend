<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Student extends Model
//class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email_id',
        'password',
        'remember_token', // Add remember_token to the $fillable array
    ];
}
