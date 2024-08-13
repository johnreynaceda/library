<div>
    @if ($qr_code == null)
        <div class="w-96">
            <div id="reader"></div>
        </div>
    @endif

    <script>
        document.addEventListener('livewire:load', function () {
            const scanner = new Html5QrcodeScanner('reader', {
                qrbox: {
                    width: 250,
                    height: 250,
                },
                fps: 20,
            });

            scanner.render(success, error);

            function success(result) {
                Livewire.emit('qrScanned', result);
            }

            function error(err) {
                console.error(err);
            }
        });
    </script>

    <div class="flex justify-between items-center">
        <div class="flex space-x-2 items-end">
            <x-button label="SCAN QR" wire:click.prevent="scanNow" sm positive right-icon="qrcode" />
        </div>
        <x-button label="ATTENDANCE LISTS" href="" icon="document-text" slate class="font-medium" />
    </div>
</div>
