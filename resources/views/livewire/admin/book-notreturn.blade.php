<div class="p-6 bg-white shadow-md rounded-lg mt-12">
    <h2 class="text-2xl font-semibold mb-4">Books Not Returned</h2>

    <table class="min-w-full leading-normal">
        <thead>
            <tr>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Book Title
                </th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Borrower
                </th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Borrowed At
                </th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Due Date
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($notReturnedBooks as $borrow)
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        {{ $borrow->book->title ?? 'N/A' }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        {{ $borrow->user->name ?? 'N/A' }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        {{ \Carbon\Carbon::parse($borrow->borrowed_at)->format('M d, Y') }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        {{ \Carbon\Carbon::parse($borrow->due_date)->format('M d, Y') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
