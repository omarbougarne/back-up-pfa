<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    protected $table = 'episodes';
    protected $fillable = ['title', 'number', 'air_date', 'summary', 'anime_id'];

    public function anime()
    {
        return $this->belongsTo(Anime::class);
    }
}
