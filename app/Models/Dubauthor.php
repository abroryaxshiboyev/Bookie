<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dubauthor extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
    ];

    public function audios()
    {
        return $this->hasMany(Audio::class);
    }
}
