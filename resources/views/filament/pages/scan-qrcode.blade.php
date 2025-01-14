<x-filament::page>
    <div class="space-y-4">
        <div id="reader"></div>
        <div id="result"></div>
    </div>

    @push('scripts')
        <script src="https://unpkg.com/html5-qrcode"></script>
        <script>
            function onScanSuccess(decodedText, decodedResult) {
                document.getElementById('result').innerHTML = `
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <p class="text-lg font-semibold">NIS Terdeteksi: ${decodedText}</p>
                            <a href="/admin/absensis/create?nis=${decodedText}" class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                Input Absensi
                            </a>
                        </div>
                    </div>
                `;
                html5QrcodeScanner.clear();
            }

            function onScanFailure(error) {
                // handle scan failure, usually better to ignore and keep scanning.
                // console.warn(`Code scan error = ${error}`);
            }

            let html5QrcodeScanner = new Html5QrcodeScanner(
                "reader", { 
                    fps: 10,
                    qrbox: { width: 250, height: 250 }
                }
            );
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        </script>
    @endpush
</x-filament::page>
