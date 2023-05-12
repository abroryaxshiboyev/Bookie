<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'folder',
        'file'
    ];




public function imageable() {
    return $this->morphTo();
}
}
