<?php

namespace App\Livewire\Admin;

use App\Models\borrowbooks as BorrowBook;
use App\Models\User;
use Carbon\Carbon;
use App\Models\books as Book;
use Livewire\Component;

class Index extends Component
{
    public $totalBorrowedBooks;
    public $booksNotReturned;
    public $totalUsers;
    public $totalBooksBorrowed;
    public $actionsNeeded;
    public $topBorrower;

    public function mount()
    {
        // Calculate Total Borrowed Books (Assuming you track 'quantity' in the table)
        $this->totalBorrowedBooks = BorrowBook::count();

        // Calculate Books Not Returned after 1 week
        $oneWeekAgo = Carbon::now()->subWeek();
        $this->booksNotReturned = BorrowBook::where('status', 'Borrowed')
            ->where('borrowed_at', '<', $oneWeekAgo)
            ->count();

        // Calculate Total Users
        $this->totalUsers = User::count();

        // Calculate Total Books Borrowed (assuming there's no quantity field and you just count the records)
        $this->totalBooksBorrowed = BorrowBook::where('status', 'Borrowed')->count();

        // Actions Needed (Assuming actions needed are the books that haven't been returned after due date)
        $this->actionsNeeded = BorrowBook::where('status', 'Borrowed')
            ->where('due_date', '<', Carbon::now())
            ->count();

        // Top Borrower (Assuming top borrower is the one who borrowed the most books)
        // $this->topBorrower = User::withCount('borrowbooks')
        //     ->orderBy('borrowbooks_count', 'desc')
        //     ->first();
    }

    public function render()
    {
        return view('livewire.admin.index', [
            'totalBorrowedBooks' => $this->totalBorrowedBooks,
            'booksNotReturned' => $this->booksNotReturned,
            'totalUsers' => $this->totalUsers,
            'totalBooksBorrowed' => $this->totalBooksBorrowed,
            'actionsNeeded' => $this->actionsNeeded,
            // 'topBorrower' => $this->topBorrower,
        ]);
    }
}
