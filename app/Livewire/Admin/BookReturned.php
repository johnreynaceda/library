<?php

namespace App\Livewire\Admin;
use App\Models\processed_borrowbooks;
use Livewire\Component;

class BookReturned extends Component
{
    public function render()
    {

        $returnedBooks = processed_borrowbooks::with('book', 'user')
            ->where('status', 'Returned')
            ->get();

        return view('livewire.admin.book-returned', [
            'returnedBooks' => $returnedBooks,
        ]);
    }
}
