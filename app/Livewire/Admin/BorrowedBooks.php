<?php

namespace App\Livewire\Admin;

use App\Models\processed_borrowbooks as ProcessedBorrowBooks;
use App\Models\Return_Books as Bookre;
use Carbon\Carbon;
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
    public function markAsReturned($borrowbookId)
    {
        $borrowedBook = ProcessedBorrowBooks::with('book')->find($borrowbookId);

        if ($borrowedBook && $borrowedBook->book) {
          Bookre::create([
                'title' => $borrowedBook->book->title,
                'isbn' => $borrowedBook->book->isbn,
                'catalog' => $borrowedBook->book->catalog,
                'description' => $borrowedBook->book->description,
                'author' => $borrowedBook->book->author,
                'publisher' => $borrowedBook->book->publisher,
                'category' => $borrowedBook->book->category,
                'image' => $borrowedBook->book->image,
                'returned_at' => now(),
                'status' => 'Returned',
                'remarks' => 'Book returned successfully',
            ]);

            $borrowedBook->update(['status' => 'Returned']);

          flash( 'Book marked as returned successfully.');
        } else {
            flash( 'Borrowed book or associated book details not found.');
        }


    }


    public function markAsNotReturned($borrowbookId)
    {
        $borrowedBook = ProcessedBorrowBooks::find($borrowbookId);

        if ($borrowedBook) {
            $borrowedBook->update(['status' => 'Not Returned']);
           flash( 'Book marked as not returned.');
        } else {
         flash( 'Borrowed book not found.');
        }
    }

}
