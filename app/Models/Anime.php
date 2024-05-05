<?php

namespace App\Models;

use App\Models\Episode;
use App\Models\Manga;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'synopsis',
        'score',
        'status',
        'category'
    ];

    //..eager loading
    protected $with = ['studio'];

    //..define the relationship with Studio
    public function studio(){
        return $this->belongsTo(Studio::class);
    }

    // public function users(){
    //     return $this->belongsToMany(User::class);
    // }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function episodes()
{
    return $this->hasMany(Episode::class);
}
public function users()
    {
        return $this->belongsToMany(User::class)->withPivot( 'rating')->withTimestamps();
    }
    public function manga()
    {
        return $this->belongsTo(Manga::class);
    }

}
