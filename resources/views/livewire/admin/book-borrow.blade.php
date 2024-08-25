<div class="p-6 bg-white shadow-md rounded-lg mt-12">
    <h2 class="text-2xl font-semibold mb-4">Borrowed Books List</h2>

    <!-- Search Input and Button -->
    <div class="mb-4 flex">
        <input type="text" wire:model.defer="search" placeholder="Search by book title or borrower name..." class="px-4 py-2 border rounded-l-lg w-full">
        <button wire:click="searchBooks" class="bg-blue-500 text-white px-4 py-2 rounded-r-lg hover:bg-blue-600">Search</button>
    </div>

    <table class="min-w-full leading-normal">
        <thead>
            <tr>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Book Title</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Borrower</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Borrowed At</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date Return</th>
                {{-- <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th> --}}
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($borrowedBooks as $borrow)
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        {{ $borrow->book->title }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        {{ $borrow->user->name }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        {{ $borrow->borrowed_at->format('M d, Y') }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        {{ $borrow->due_date->format('M d, Y') }}
                    </td>
                    {{-- <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        {{ ucfirst($borrow->status) }}
                    </td> --}}
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <button wire:click="approve({{ $borrow->id }})" class="bg-green-500 text-white py-1 px-4 rounded hover:bg-green-600">Approve</button>
                        <button wire:click="decline({{ $borrow->id }})" class="bg-red-500 text-white py-1 px-4 rounded hover:bg-red-600">Decline</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $borrowedBooks->links() }}
    </div>
</div>
