<div class="px-4 py-3 bg-white border-t filament-tables-footer">
    <div class="space-y-4">
        <div class="p-4 bg-gray-50 rounded-lg">
            <h3 class="text-lg font-medium text-gray-900">Scan Barcode</h3>
            <div class="mt-4">
                <input type="text"
                       id="barcode-input"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500"
                       placeholder="Scan barcode atau ketik manual"
                       autofocus>
            </div>
            <div class="mt-4">
                @livewire('scan-barcode-form')
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let timeoutId;
    const TIMEOUT_MS = 100;

    document.getElementById('barcode-input').addEventListener('input', function(e) {
        const input = this;

        if (timeoutId) {
            clearTimeout(timeoutId);
        }

        timeoutId = setTimeout(() => {
            const barcode = input.value.trim();

            if (barcode) {
                Livewire.emit('createAbsensi', barcode);
                input.value = '';
                input.focus();
            }
        }, TIMEOUT_MS);
    });

    // Auto focus ke input saat halaman dimuat
    window.addEventListener('load', function() {
        document.getElementById('barcode-input').focus();
    });

    // Tangani event setelah scan selesai
    Livewire.on('barcodeScanComplete', () => {
        document.getElementById('barcode-input').focus();
        // Refresh table setelah scan berhasil
        Livewire.emit('refreshTable');
    });

    // Prevent form submission on enter
    document.getElementById('barcode-input').addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
        }
    });
</script>
@endpush
