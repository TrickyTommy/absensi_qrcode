<x-filament::page>
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="text-center p-6 bg-white rounded-xl shadow-sm">
            <h2 class="text-2xl font-bold text-gray-900">Sistem Absensi QR Code</h2>
            <p class="mt-2 text-gray-600">Scan QR Code siswa untuk mencatat kehadiran</p>
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
                        Scanner QR Code
                    </h3>
                </div>
                <div class="p-6">
                    <div id="reader" class="overflow-hidden rounded-lg"></div>
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
                        <div class="text-center text-gray-500">
                            <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <p class="text-lg">Siap untuk memindai QR Code</p>
                            <p class="mt-2 text-sm">Arahkan kamera ke QR Code siswa</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Instructions Section -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="p-6 bg-primary-600">
                <h3 class="text-lg font-semibold text-white flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Petunjuk Penggunaan
                </h3>
            </div>
            <div class="p-6">
                <div class="grid md:grid-cols-3 gap-4">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <span class="flex items-center justify-center w-8 h-8 rounded-full bg-primary-100 text-primary-600">1</span>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">Izinkan Kamera</h4>
                            <p class="mt-1 text-sm text-gray-500">Berikan izin akses kamera saat diminta</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <span class="flex items-center justify-center w-8 h-8 rounded-full bg-primary-100 text-primary-600">2</span>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">Arahkan QR Code</h4>
                            <p class="mt-1 text-sm text-gray-500">Posisikan QR Code siswa di depan kamera</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <span class="flex items-center justify-center w-8 h-8 rounded-full bg-primary-100 text-primary-600">3</span>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">Proses Otomatis</h4>
                            <p class="mt-1 text-sm text-gray-500">Sistem akan otomatis mencatat kehadiran</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <!-- Button to access barcode scanner -->
        <div class="text-center mt-6">
            <a href="{{ \App\Filament\Resources\AbsensiResource::getUrl('scan-barcode') }}" class="inline-block px-6 py-3 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors duration-200">
                Scan Barcode with Device
            </a>
        </div> --}}
    </div>

    @push('scripts')
        <script src="https://unpkg.com/html5-qrcode"></script>
        <script>
            function onScanSuccess(decodedText, decodedResult) {
                document.getElementById('result').innerHTML = `
                    <div class="text-center">
                        <div class="animate-pulse inline-flex items-center justify-center w-16 h-16 rounded-full bg-primary-100 text-primary-600 mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div class="space-y-2">
                            <p class="text-lg font-medium text-gray-900">NIS Terdeteksi: ${decodedText}</p>
                            <p class="text-sm text-gray-500">Memproses absensi...</p>
                        </div>
                    </div>
                `;

                // Call the createAbsensi Livewire method
                @this.createAbsensi(decodedText);

                // Clear the scanner after successful scan
                html5QrcodeScanner.clear();

                // Reset scanner after 3 seconds
                setTimeout(() => {
                    document.getElementById('result').innerHTML = `
                        <div class="text-center text-gray-500">
                            <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <p class="text-lg">Siap untuk memindai QR Code</p>
                            <p class="mt-2 text-sm">Arahkan kamera ke QR Code siswa</p>
                        </div>
                    `;
                    html5QrcodeScanner = new Html5QrcodeScanner(
                        "reader",
                        {
                            fps: 10,
                            qrbox: { width: 250, height: 250 },
                            aspectRatio: 1.0
                        }
                    );
                    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
                }, 3000);
            }

            function onScanFailure(error) {
                // handle scan failure, usually better to ignore and keep scanning.
                // console.warn(`Code scan error = ${error}`);
            }

            let html5QrcodeScanner = new Html5QrcodeScanner(
                "reader",
                {
                    fps: 10,
                    qrbox: { width: 250, height: 250 },
                    aspectRatio: 1.0
                }
            );
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        </script>

        <style>
            #reader {
                width: 100% !important;
            }
            #reader * {
                border-radius: 0.5rem;
            }
            #reader video {
                border-radius: 0.5rem !important;
            }
            #html5-qrcode-button-camera-permission {
                @apply px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors duration-200;
            }
            #html5-qrcode-button-camera-start, #html5-qrcode-button-camera-stop {
                @apply px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors duration-200;
            }
        </style>
    @endpush
</x-filament::page>
