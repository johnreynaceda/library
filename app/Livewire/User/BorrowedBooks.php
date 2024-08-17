<?php

namespace App\Livewire\User;
use App\Models\processed_borrowbooks;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BorrowedBooks extends Component
{
    public function render()
    {

        $user = Auth::user();


        $borrowedBooks = processed_borrowbooks::where('user_id', $user->id)
            ->with('book')
            ->get();

        return view('livewire.user.borrowed-books', [
            'borrowedBooks' => $borrowedBooks,
        ]);
    }
}
