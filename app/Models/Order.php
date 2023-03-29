<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable=[
        'admin_id',
        'user_id',
        'book_id',
        'status',
    ];

    public function books(){
        return $this->belongsToMany(Book::class,'orders')->as('books')->withTrashed();
    }
}
