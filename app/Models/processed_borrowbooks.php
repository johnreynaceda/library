<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class processed_borrowbooks extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'book_id', 'status', 'borrowed_at', 'due_date'];

    public function book()
    {
        return $this->belongsTo(books::class, 'book_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bookReturns()
    {
        return $this->hasMany(book_returns::class, 'borrowbook_id');
    }
}
