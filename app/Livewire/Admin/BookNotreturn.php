<?php

namespace App\Livewire\Admin;
use App\Models\processed_borrowbooks as ProcessedBorrowBooks;
use Carbon\Carbon;
use Livewire\Component;

class BookNotreturn extends Component
{
    public function render()
    {

        $notReturnedBooks = ProcessedBorrowBooks::with('book', 'user')
            ->where('status', 'Not Returned')
            ->get();

        return view('livewire.admin.book-notreturn', [
            'notReturnedBooks' => $notReturnedBooks,
        ]);
    }
}
