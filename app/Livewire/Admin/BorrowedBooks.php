<?php

namespace App\Livewire\Admin;

use App\Models\processed_borrowbooks as ProcessedBorrowBooks;
use Livewire\WithPagination;
use Livewire\Component;

class BorrowedBooks extends Component
{
    use WithPagination;

    public function render()
    {
        $borrowedBooks = ProcessedBorrowBooks::with('book', 'user')
            ->paginate(10);

        return view('livewire.admin.borrowed-books', [
            'borrowedBooks' => $borrowedBooks
        ]);
    }

}
