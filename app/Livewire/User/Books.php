<?php

namespace App\Livewire\User;

use App\Models\books as Book;
use App\Models\borrowbooks as BorrowBook;
use Livewire\WithPagination;
use Livewire\Component;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Storage;

class Books extends Component
{
    use WithPagination;
    public $qrCode;
    public $qrCodePath;
    public $qr_modal = false;
    public function render()
    {
        $books = Book::paginate(10);
        return view('livewire.user.books', ['books' => $books]);
    }

    public function borrow($bookId)
    {
        $userId = auth()->id();
        $book = Book::find($bookId);

        if ($book) {
            $borrowedBook = BorrowBook::create([
                'book_id' => $book->id,
                'user_id' => $userId,
                'borrowed_at' => now(),
                'due_date' => now()->addWeeks(1),
                'returned_at' => null,
                'status' => 'borrowed',
            ]);


            $qrCode = new QrCode($borrowedBook->id);
            $qrCode->setSize(250);
            $writer = new PngWriter();
            $result = $writer->write($qrCode);


            $filePath = 'public/qr_codes/' . $borrowedBook->id . '.png';
            Storage::put($filePath, $result->getString());


            $this->qrCode = base64_encode($result->getString());
            $this->qrCodePath = Storage::url($filePath);


            $this->qr_modal = true;
        } else {
      flash('error', 'Book not found.');
        }
    }

    public function closeModal()
    {
        $this->qr_modal = false;
    }
    }

