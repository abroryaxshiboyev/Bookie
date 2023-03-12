<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'author_name',
        'title',
        'price',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class,'category_books')->as('categories')->withTrashed();
    }
}
