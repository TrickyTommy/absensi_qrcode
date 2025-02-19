<x-filament::widget>
    <div class="p-4 space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-medium">
                Scan Barcode Siswa
            </h2>
        </div>
        
        <div class="relative">
            <input type="text"
                   id="barcode-input"
                   class="block w-full transition duration-75 rounded-lg shadow-sm focus:border-primary-600 focus:ring-1 focus:ring-inset focus:ring-primary-600 disabled:opacity-70 border-gray-300"
                   placeholder="Scan barcode atau ketik manual disini..."
                   wire:model.lazy="barcodeInput"
                   autocomplete="off"
                   autofocus>
        </div>

        <div class="mt-2">
            @livewire('scan-barcode-form')
        </div>
    </div>
</x-filament::widget>

@pushonce('scripts')
<script>
document.addEventListener('livewire:load', function() {
    let timeoutId;
    const TIMEOUT_MS = 50;
    const input = document.getElementById('barcode-input');

    if (input) {
        let barcodeBuffer = '';
        let lastKeyTime = 0;

        // Handle keypress for barcode scanner
        input.addEventListener('keypress', function(e) {
            const currentTime = new Date().getTime();
            
            // Reset buffer if there's a delay between keystrokes
            if (currentTime - lastKeyTime > 100) {
                barcodeBuffer = '';
            }
            
            lastKeyTime = currentTime;
            barcodeBuffer += e.key;

            // Clear existing timeout
            if (timeoutId) clearTimeout(timeoutId);

            // Process barcode after brief delay
            timeoutId = setTimeout(() => {
                if (barcodeBuffer) {
                    Livewire.emit('createAbsensi', barcodeBuffer);
                    barcodeBuffer = '';
                    input.value = '';
                }
            }, TIMEOUT_MS);
        });

        // Prevent form submission
        input.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
            }
        });

        // Keep focus on input
        input.focus();
        document.addEventListener('click', () => input.focus());
        
        // Handle successful scan
        Livewire.on('barcodeScanComplete', () => {
            input.value = '';
            input.focus();
            // Play success sound (optional)
            const audio = new Audio('/assets/sounds/beep.mp3');
            audio.play().catch(() => {}); // Ignore if sound fails
        });

        // Handle failed scan
        Livewire.on('barcodeScanFailed', () => {
            input.value = '';
            input.focus();
        });

        // Automatically focus on page load
        window.addEventListener('load', () => input.focus());
    }
});
</script>
@endpushonce
