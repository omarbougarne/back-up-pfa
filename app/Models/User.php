<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable // Extend Authenticatable directly
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'email', 'password','avatar'];

    public function animes()
    {
        return $this->belongsToMany(Anime::class)->withPivot('rating')->withTimestamps();
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
