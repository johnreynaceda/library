<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class book_returns extends Model
{
    use HasFactory;

    protected $table = 'book_returns';

    protected $fillable = [
        'title',
        'isbn',
        'catalog',
        'description',
        'author',
        'publisher',
        'category',
        'image',
        'returned_at',
        'status',
        'remarks',
    ];

    public function processedBorrowBook()
    {
        return $this->belongsTo(processed_borrowbooks::class, 'borrowbook_id');
    }
}
