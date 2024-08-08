<div>
    <div class="p-6 bg-white shadow-md rounded-lg mt-12">
        <h2 class="text-2xl font-semibold mb-4">Borrowed Books List</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($borrowedBooks as $borrowedBook)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="p-4">
                        <h3 class="text-xl font-semibold mb-2">{{ $borrowedBook->book->title }}</h3>
                        <p class="text-gray-600 mb-1">ISBN: {{ $borrowedBook->book->isbn }}</p>
                        <p class="text-gray-600 mb-1">Borrowed By: {{ $borrowedBook->user->name }}</p>
                        <p class="text-gray-600 mb-1">Borrowed At: {{ $borrowedBook->borrowed_at->format('Y-m-d') }}</p>
                        <p class="text-gray-600 mb-1">Due Date: {{ $borrowedBook->due_date->format('Y-m-d') }}</p>
                        <p class="text-gray-600 mb-1">Status: {{ ucfirst($borrowedBook->status) }}</p>
                        @if ($borrowedBook->book->image)
                            <img src="{{ asset('storage/' . $borrowedBook->book->image) }}" alt="Book Cover" class="w-full h-48 object-cover">
                        @else
                            <img src="https://via.placeholder.com/150" alt="No Image" class="w-full h-48 object-cover">
                        @endif
                        @if ($borrowedBook->qr_code)
                            <img src="{{ asset('storage/' . $borrowedBook->qr_code) }}" alt="QR Code" class="w-32 h-32 object-cover mt-4">
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500">
                    No borrowed books found.
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $borrowedBooks->links() }}
        </div>
    </div>

    <div class="p-6 mt-6">
        <h2 class="text-2xl font-semibold mb-4">QR Code Scanner</h2>
        <video id="camera-stream" style="width: 100%; height: 300px; border: 1px solid #ccc;"></video>
        <button id="capture-button" class="bg-blue-500 text-white py-2 px-4 rounded mt-4">Capture Photo</button>
        <canvas id="canvas" style="display: none;"></canvas>
        <div id="scan-result" class="mt-4"></div>
    </div>

    <!-- Load QR Code Scanner library -->
    <script src="https://unpkg.com/@zxing/library@latest"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const captureButton = document.getElementById('capture-button');
            const scanResult = document.getElementById('scan-result');
            const cameraStream = document.getElementById('camera-stream');
            const canvas = document.getElementById('canvas');
            const canvasContext = canvas.getContext('2d');

            let stream;

            // Start camera stream
            navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } })
                .then(function (mediaStream) {
                    stream = mediaStream;
                    cameraStream.srcObject = mediaStream;
                    cameraStream.play();
                })
                .catch(function (err) {
                    console.error('Error accessing camera:', err);
                    scanResult.innerText = 'Error accessing camera. Please check permissions.';
                });


            captureButton.addEventListener('click', function () {
                if (stream) {
                    canvas.width = cameraStream.videoWidth;
                    canvas.height = cameraStream.videoHeight;
                    canvasContext.drawImage(cameraStream, 0, 0, canvas.width, canvas.height);


                    const codeReader = new ZXing.BrowserQRCodeReader();
                    codeReader.decodeFromImage(canvas)
                        .then(result => {
                            scanResult.innerText = `QR Code Data: ${result.text}`;
                        })
                        .catch(err => {
                            console.error('Error scanning QR code:', err);
                            scanResult.innerText = 'Error scanning QR code. Please try again.';
                        });
                } else {
                    scanResult.innerText = 'No camera stream available.';
                }
            });
        });
    </script>
</div>
