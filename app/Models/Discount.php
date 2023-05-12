<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discount extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'amount',
        'starts',
        'finishes',
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class,'discbooks')->as('books')->withTrashed();
    }
}
