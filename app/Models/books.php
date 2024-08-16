<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class books extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'isbn',
        'catalog',
        'description',
        'author',
        'publisher',
        'category',
        'image'
    ];

    protected $table = 'books';

    public function processedBorrowBooks()
    {
        return $this->hasMany(processed_borrowbooks::class, 'book_id');
    }
}
