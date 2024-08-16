<div>
    <div class="p-6 bg-white shadow-md rounded-lg mt-12 ">
        <h2 class="text-2xl font-semibold mb-4">Books List</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($books as $book)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <img src="{{ $book->image ? asset('storage/' . $book->image) : 'https://via.placeholder.com/150' }}" alt="Book Cover" class="w-full h-48 object-cover">
                    <div class="p-4 w-80">
                        <h3 class="text-xl font-semibold mb-2">{{ $book->title }}</h3>
                        <p class="text-gray-600 mb-1">ISBN: {{ $book->isbn }}</p>
                        <p class="text-gray-600 mb-1">Catalog: {{ $book->catalog }}</p>
                        <p class="text-gray-600 mb-1">Author: {{ $book->author }}</p>
                        <p class="text-gray-600 mb-1">Publisher: {{ $book->publisher }}</p>
                        <p class="text-gray-600 mb-1">Category: {{ $book->category }}</p>
                        <p class="text-gray-600 mb-1">Description: {{ $book->description }}</p>
                    </div>
                    <div class="flex justify-center p-4 border-t border-gray-200">
                        <button wire:click="openConfirmModal({{ $book->id }})" class="bg-green-500 text-white py-1 px-4 rounded hover:bg-green-600">Borrow Now</button>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500">
                    No books found.
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $books->links() }}
        </div>
    </div>

    <x-modal-card title="Borrow Book" name="confirmmodal" wire:model.defer="confirmmodal" class="max-w-lg mx-auto bg-white shadow-lg rounded-lg p-6">
        <div class="flex flex-col items-center">
            @if ($selectedBook)
                <!-- Book Cover Photo -->
                <img src="{{ $selectedBook->image ? asset('storage/' . $selectedBook->image) : 'https://via.placeholder.com/300' }}" alt="Book Cover" class="w-full h-64 object-cover rounded-md shadow-md mb-4">

                <!-- Book Details -->
                <div class="bg-gray-100 p-4 rounded-md shadow-sm w-full mb-4">
                    <p class="text-gray-700 font-semibold mb-1">Author:</p>
                    <p class="text-gray-800 mb-2">{{ $selectedBook->author }}</p>
                    <p class="text-gray-700 font-semibold mb-1">Publisher:</p>
                    <p class="text-gray-800">{{ $selectedBook->publisher }}</p>
                </div>

                <!-- Terms and Conditions -->
                <div class="w-full bg-gray-50 p-4 rounded-md shadow-sm">
                    <x-checkbox id="agree" wire:model="isAgreed" label="I agree to the terms and conditions" primary />
                    <div class="mt-4 text-gray-700">
                        <h4 class="font-semibold mb-2">Terms and Conditions</h4>
                        <div>
                            <h5 class="font-semibold">Borrowing Period</h5>
                            <p>The borrower is allowed to borrow the book for a period of one week (7 days) starting from the date of issuance.</p>
                        </div>
                        <div class="mt-2">
                            <h5 class="font-semibold">Late Return Penalty</h5>
                            <p>If the borrower fails to return the book by the due date, a penalty fee will be applied for each day the book is overdue. The penalty fee is P20.00 per day.</p>
                        </div>
                        <div class="mt-2">
                            <h5 class="font-semibold">Responsibility</h5>
                            <p>The borrower is responsible for the book during the borrowing period and must ensure that it is returned in the same condition as it was issued.</p>
                        </div>
                        <div class="mt-2">
                            <h5 class="font-semibold">Lost or Damaged Books</h5>
                            <p>In the event that the book is lost or returned damaged, the borrower will be required to pay the full replacement cost of the book.</p>
                        </div>
                    </div>
                </div>


                @if ($validationMessage)
                    <div class="w-full bg-red-100 text-red-700 p-4 rounded-md mb-4">
                        {{ $validationMessage }}
                    </div>
                @endif
            @endif
        </div>

        <x-slot name="footer">
            <div class="flex justify-end gap-x-4 p-4">
                <x-button flat label="Cancel" wire:click="closeModal" class="bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-lg px-4 py-2 transition duration-300" />
                <x-button primary label="Borrow Now" wire:click="borrow" class="bg-blue-600 hover:bg-blue-700 text-white rounded-lg px-4 py-2 transition duration-300" />
            </div>
        </x-slot>
    </x-modal-card>
</div>
