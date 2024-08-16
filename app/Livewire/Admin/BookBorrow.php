<?php

namespace App\Livewire\Admin;

use App\Models\borrowbooks as BorrowBook;
use App\Models\processed_borrowbooks as ProcessedBorrowBook;
use Livewire\WithPagination;
use Livewire\Component;

class BookBorrow extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $borrowedBooks = BorrowBook::with('book', 'user')
            ->whereHas('book', function($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->orWhereHas('user', function($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->paginate(10);

        return view('livewire.admin.book-borrow', ['borrowedBooks' => $borrowedBooks]);
    }

    public function searchBooks()
    {
        $this->render();
    }

    public function approve($borrowId)
    {
        $borrow = BorrowBook::find($borrowId);
        if ($borrow) {

            ProcessedBorrowBook::create([
                'user_id' => $borrow->user_id,
                'book_id' => $borrow->book_id,
                'status' => 'approved',
                'borrowed_at' => $borrow->borrowed_at,
                'due_date' => now()->addWeeks(1),
            ]);


            $borrow->delete();

        flash('message', 'Borrow request approved successfully.');
        } else {
        flash('error', 'Borrow request not found.');
        }
    }

    public function decline($borrowId)
    {
        $borrow = BorrowBook::find($borrowId);
        if ($borrow) {

            ProcessedBorrowBook::create([
                'user_id' => $borrow->user_id,
                'book_id' => $borrow->book_id,
                'status' => 'declined',
                'borrowed_at' => $borrow->borrowed_at,
            ]);


            $borrow->delete();

       flash('message', 'Borrow request declined successfully.');
        } else {
          flash('error', 'Borrow request not found.');
        }
    }
}
