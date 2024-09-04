<div>
    <div>
        <div class="p-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-green-700">Number of Borrow Books</h3>
                    <p class="text-2xl font-bold text-gray-800 mt-2">{{ $totalBorrowedBooks }}</p>
                    <p class="text-sm text-gray-500 mt-1">Updated as of today</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-green-700">Books Not Returned</h3>
                    <p class="text-2xl font-bold text-gray-800 mt-2">{{ $booksNotReturned }}</p>
                    <p class="text-sm text-gray-500 mt-1">Updated as of today</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-green-700">Total Users</h3>
                    <p class="text-2xl font-bold text-gray-800 mt-2">{{ $totalUsers }}</p>
                    <p class="text-sm text-gray-500 mt-1">Updated as of today</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-green-700">Total Books Borrowed</h3>
                    <p class="text-2xl font-bold text-gray-800 mt-2">{{ $totalBooksBorrowed }}</p>
                    <p class="text-sm text-gray-500 mt-1">Updated as of today</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-green-700">Actions Needed</h3>
                    <p class="text-2xl font-bold text-gray-800 mt-2">{{ $actionsNeeded }}</p>
                    <p class="text-sm text-gray-500 mt-1">Updated as of today</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-green-700">Top Borrower</h3>
                    @if($topBorrower)
                        <p class="text-2xl font-bold text-gray-800 mt-2">{{ $topBorrower->name }}</p>
                        <p class="text-sm text-gray-500 mt-1">Returned {{ $topBorrower->books_returned }} books</p>
                    @else
                        <p class="text-2xl font-bold text-gray-800 mt-2">No data available</p>
                    @endif
                </div>
            </div>
        </div>
    </div>


        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-4">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-green-700">Daily Books Borrowed</h3>
                <div class="mt-4 h-64 bg-gray-100 rounded-lg">
                    <canvas id="dailyBooksBorrowedChart"></canvas>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-green-700">Most Borrowed Books</h3>
                <ul class="mt-4 space-y-2">
                    @forelse($mostBorrowedBooks as $book)
                    <li class="flex justify-between text-gray-800">
                        <span>{{ $book->title }}</span>
                        <span>{{ $book->borrow_count }} times</span>
                    </li>
                @empty
                    <li class="text-gray-800">No data available</li>
                @endforelse
                </ul>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
         document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('dailyBooksBorrowedChart').getContext('2d');
    var dailyBooksBorrowedChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($dailyBooksBorrowed->pluck('date')),
            datasets: [{
                label: 'Books Borrowed',
                data: @json($dailyBooksBorrowed->pluck('borrow_count')),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});

        </script>
    </div>

