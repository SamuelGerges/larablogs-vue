<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
    ];


    protected $hidden = [
        'password',
    ];

    public function setPasswordAttribute($password)
    {
       return  $this->attributes['password'] = Hash::make($password);
    }
    public function posts()
    {
        return $this->hasMany(User::class,'user_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class,'user_id');
    }
}
