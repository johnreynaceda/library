<?php

namespace App\Livewire\Admin;

use App\Models\borrowbooks as BorrowBook;
use App\Models\processed_borrowbooks as pB;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    public $totalBorrowedBooks;
    public $booksNotReturned;
    public $totalUsers;
    public $totalBooksBorrowed;
    public $actionsNeeded;
    public $topBorrower;
    public $mostBorrowedBooks;
    public $dailyBooksBorrowed;

    public function mount()
    {
        // Calculate Total Borrowed Books
        $this->totalBorrowedBooks = BorrowBook::count();

        // Calculate Books Not Returned (where status is 'Not Returned')
        $this->booksNotReturned = pB::where('status', 'Not Returned')->count();

        // Calculate Total Users
        $this->totalUsers = User::count();

        // Calculate Total Books Borrowed (where status is 'Approved')
        $this->totalBooksBorrowed = pB::where('status', 'Approved')->count();

        // Actions Needed (Books that are overdue and still marked as 'Not Returned')
        $this->actionsNeeded = pB::where('status', 'Not Returned')
            ->where('due_date', '<', Carbon::now())
            ->count();

        // Top Borrower based on 'Returned' status
        $this->topBorrower = DB::table('users')
            ->join('processed_borrowbooks', 'users.id', '=', 'processed_borrowbooks.user_id')
            ->where('processed_borrowbooks.status', 'Returned')
            ->select('users.id', 'users.name', DB::raw('COUNT(processed_borrowbooks.id) as books_returned'))
            ->groupBy('users.id', 'users.name')
            ->orderBy('books_returned', 'desc')
            ->first();

            $this->mostBorrowedBooks = DB::table('processed_borrowbooks')
            ->join('books', 'processed_borrowbooks.book_id', '=', 'books.id')
            ->select('books.title', DB::raw('COUNT(processed_borrowbooks.id) as borrow_count'))
            ->where('processed_borrowbooks.status', 'Returned')
            ->groupBy('books.id', 'books.title')
            ->orderBy('borrow_count', 'desc')
            ->limit(5)
            ->get();

            $this->dailyBooksBorrowed = pB::select(DB::raw('DATE(borrowed_at) as date'), DB::raw('COUNT(*) as borrow_count'))
            ->where('status', 'Approved')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
    }



    public function render()
    {
        return view('livewire.admin.index', [
            'totalBorrowedBooks' => $this->totalBorrowedBooks,
            'booksNotReturned' => $this->booksNotReturned,
            'totalUsers' => $this->totalUsers,
            'totalBooksBorrowed' => $this->totalBooksBorrowed,
            'actionsNeeded' => $this->actionsNeeded,
            'topBorrower' => $this->topBorrower,
            'mostBorrowedBooks' => $this->mostBorrowedBooks,
            'dailyBooksBorrowed' => $this->dailyBooksBorrowed,
        ]);
    }
}
