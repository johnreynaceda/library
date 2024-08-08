<div>
    <div class="p-6 bg-white shadow-md rounded-lg mt-12">
        <h2 class="text-2xl font-semibold mb-4">Books List</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($books as $book)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <img src="{{ $book->image ? asset('storage/' . $book->image) : 'https://via.placeholder.com/150' }}" alt="Book Cover" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-xl font-semibold mb-2">{{ $book->title }}</h3>
                        <p class="text-gray-600 mb-1">ISBN: {{ $book->isbn }}</p>
                        <p class="text-gray-600 mb-1">Catalog: {{ $book->catalog }}</p>
                        <p class="text-gray-600 mb-1">Author: {{ $book->author }}</p>
                        <p class="text-gray-600 mb-1">Publisher: {{ $book->publisher }}</p>
                        <p class="text-gray-600 mb-1">Category: {{ $book->category }}</p>
                        <p class="text-gray-600 mb-1">Description: {{ $book->description }}</p>
                    </div>
                    <div class="flex justify-center p-4 border-t border-gray-200">
                        <button wire:click="borrow({{ $book->id }})" class="bg-green-500 text-white py-1 px-4 rounded hover:bg-green-600">Borrow Now</button>
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

    <!-- QR Code Modal -->
    <x-modal-card title="QR Code" name="qr_modal" wire:model.defer="qr_modal">
        <div class="p-4 text-center">
            @if ($qrCode)
                <img src="data:image/png;base64,{{ $qrCode }}" alt="QR Code" class="w-48 h-48 mx-auto mb-4">
                <a href="{{ $qrCodePath }}" download="qr_code.png" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Download QR Code</a>
            @else
                <p>No QR code available.</p>
            @endif
        </div>

        <x-slot name="footer">
            <div class="flex justify-end gap-x-4">
                <x-button flat label="Close" wire:click="closeModal" />
            </div>
        </x-slot>
    </x-modal-card>
</div>
