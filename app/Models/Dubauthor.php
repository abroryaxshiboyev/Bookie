<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
