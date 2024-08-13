<?php

namespace App\Livewire\Admin;

use App\Models\borrowbooks as BorrowBook;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Blade;
use Livewire\Component;

class BookBorrow extends Component
{
    use WithPagination;


    use WithPagination;

    public $qr_code;
    public $form; // Define the $form property

    protected $listeners = ['qrScanned' => 'handleQrScanned'];

    public function mount()
    {
        $this->form = 'Your default form content'; // Initialize with default value if needed
    }

    public function handleQrScanned($result)
    {
        $this->qr_code = $result;

        Log::info('QR Code scanned: ', ['result' => $result]);
    }

    public function render()
    {
        $borrowedBooks = BorrowBook::with('book', 'user')->paginate(10);
        return view('livewire.admin.book-borrow', ['borrowedBooks' => $borrowedBooks]);
    }
}
