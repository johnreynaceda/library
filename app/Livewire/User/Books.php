<?php

namespace App\Livewire\User;

use App\Models\books as Book;
use App\Models\borrowbooks as BorrowBook;
use Livewire\WithPagination;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Books extends Component
{
    use WithPagination;

    public $confirmmodal = false;
    public $selectedBookId = null;
    public $selectedBook = null;
    public $isAgreed = false;
    public $validationMessage = '';  // New property for validation message

    protected $listeners = ['openConfirmModal'];

    public function render()
    {
        $books = Book::paginate(10);
        return view('livewire.user.books', ['books' => $books]);
    }

    public function openConfirmModal($bookId)
    {
        $this->selectedBookId = $bookId;
        $this->selectedBook = Book::find($bookId);
        $this->confirmmodal = true;
        $this->isAgreed = false;
        $this->validationMessage = '';
    }

    public function closeModal()
    {
        $this->confirmmodal = false;
    }

    public function borrow()
    {
        if (!$this->isAgreed) {
            $this->validationMessage = 'You must agree to the terms and conditions.';
            return;
        }

        if ($this->selectedBookId) {
            $userId = Auth::id();
            $book = Book::find($this->selectedBookId);

            if ($book) {
                try {
                    BorrowBook::create([
                        'book_id' => $book->id,
                        'user_id' => $userId,
                        'borrowed_at' => now(),
                        'due_date' => now()->addWeeks(1),
                        'returned_at' => null,
                        'status' => 'borrowed',
                    ]);
                    flash()->success('Book borrowed successfully!', [
                        'message' => 'Book borrowed successfully!.',
                        'title' => 'Success',
                    ]);

                    $this->closeModal();
                } catch (\Exception $e) {
                    Log::error('Error borrowing book: ' . $e->getMessage());
                    session()->flash('error', 'Error borrowing book. Please try again later.');
                }
            } else {
                session()->flash('error', 'Book not found.');
            }
        } else {
            session()->flash('error', 'No book selected.');
        }
    }
}
