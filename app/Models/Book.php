<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory,SoftDeletes;

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

    public function users(){
        return $this->belongsToMany(User::class,'orders')->as('orders')->withTrashed();
    }

    public function photo(){
        return $this->morphOne(Image::class,'imageable');
    }

}
