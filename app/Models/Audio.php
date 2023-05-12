<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Audio extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
        'book_id',
        'dubauthor_id',
        'url',
    ];

    public function book(){
        return $this->belongsTo(Book::class);
    }

    public function dubauthor(){
        return $this->belongsTo(Dubauthor::class);
    }



}
