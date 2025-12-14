<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author', 'year', 'stock', 'synopsis', 'admin_id', 'image_cover'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'book_categories');
    }

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
}
