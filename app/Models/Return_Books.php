<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Return_Books extends Model
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
