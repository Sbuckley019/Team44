<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable, HasFactory; // Use the HasFactory trait here

    protected $table = 'admins';

    protected $fillable = [
        'username',
        'password',
        'first_name',
        'last_name',
    ];

    protected $hidden = [
        'password',
    ];

    public $timestamps = true;
}