<x-filament::page>
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="text-center p-6 bg-white rounded-xl shadow-sm">
            <h2 class="text-2xl font-bold text-gray-900">Sistem Absensi Barcode</h2>
            <p class="mt-2 text-gray-600">Scan Barcode siswa untuk mencatat kehadiran</p>
        </div>

        <!-- Main Content -->
        <div class="grid md:grid-cols-2 gap-6">
            <!-- Scanner Section -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="p-6 bg-primary-600">
                    <h3 class="text-lg font-semibold text-white flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                        </svg>
                        Scanner Barcode
                    </h3>
                </div>
                <div class="p-6">
                    <input type="text"
                           id="barcode-input"
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500"
                           placeholder="Scan barcode atau ketik manual"
                           autofocus>
                </div>
            </div>

            <!-- Result Section -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="p-6 bg-primary-600">
                    <h3 class="text-lg font-semibold text-white flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                        Hasil Scan
                    </h3>
                </div>
                <div class="p-6">
                    <div id="result">
                        @livewire('scan-barcode-form')
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        let timeoutId;
        const TIMEOUT_MS = 100; // Waktu tunggu dalam milidetik

        document.getElementById('barcode-input').addEventListener('input', function(e) {
            const input = this;

            // Clear existing timeout
            if (timeoutId) {
                clearTimeout(timeoutId);
            }

            // Set new timeout
            timeoutId = setTimeout(() => {
                const barcode = input.value.trim();

                if (barcode) {
                    // Panggil method Livewire untuk menyimpan absensi
                    Livewire.emit('createAbsensi', barcode);

                    // Reset input dan fokus kembali
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
        });

        // Prevent form submission on enter
        document.getElementById('barcode-input').addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
            }
        });
    </script>
    @endpush
</x-filament::page>
