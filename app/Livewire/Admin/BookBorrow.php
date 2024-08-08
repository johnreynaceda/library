<?php

namespace App\Livewire\Admin;
use App\Models\borrowbooks as BorrowBook;
use Livewire\Component;

class BookBorrow extends Component
{
    public function render()
    {

        $borrowedBooks = BorrowBook::with('book', 'user')
                                    ->paginate(10);

        return view('livewire.admin.book-borrow', ['borrowedBooks' => $borrowedBooks]);
    }
}
