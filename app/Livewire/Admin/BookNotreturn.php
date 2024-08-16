<?php

namespace App\Livewire\Admin;

use App\Models\processed_borrowbooks as ProcessedBorrowBooks;
use Carbon\Carbon;
use Livewire\Component;

class BookNotreturn extends Component
{
    public function render()
    {
        $oneWeekAgo = Carbon::now()->subWeek();

        // Fetch books borrowed more than a week ago and not yet returned
        $notReturnedBooks = ProcessedBorrowBooks::with('book', 'user')
            ->where('borrowed_at', '<', $oneWeekAgo)
            // Exclude this line if `returned_at` column doesn't exist
            // ->whereNull('returned_at')
            ->get();

        return view('livewire.admin.book-notreturn', [
            'notReturnedBooks' => $notReturnedBooks,
        ]);
    }
}
