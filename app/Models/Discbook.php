<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discbook extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'discount_id',
    ];

    public function book(){
        return $this->belongsTo(Book::class);
    }
    public function discount(){
        return $this->belongsTo(Discount::class);
    }
}
