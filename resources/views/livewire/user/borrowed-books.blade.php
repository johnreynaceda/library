<div class="p-6 bg-white shadow-md rounded-lg mt-12 w-7/12">
    <h2 class="text-2xl font-semibold mb-4">My Borrowed Books</h2>

    <table class="w-full leading-normal">
        <thead>
            <tr>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Book Title
                </th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Borrowed At
                </th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Due Date
                </th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Status
                </th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Penalty
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($borrowedBooks as $borrow)
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        {{ $borrow->book->title ?? 'N/A' }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        {{ \Carbon\Carbon::parse($borrow->borrowed_at)->format('M d, Y') }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        {{ \Carbon\Carbon::parse($borrow->due_date)->format('M d, Y') }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        {{ ucfirst($borrow->status) }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        @if (strtolower($borrow->status) === 'returned')
                            No

                        @elseif (strtolower($borrow->status) === 'approved')
                            No
                        @else
                            Yes
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($borrowedBooks->isEmpty())
        <p class="mt-4 text-center">You have not borrowed any books yet.</p>
    @endif
</div>
