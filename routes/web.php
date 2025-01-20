<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/siswa/{siswa}/print-card', function (App\Models\Siswa $siswa) {
    $renderer = new \BaconQrCode\Renderer\ImageRenderer(
        new \BaconQrCode\Renderer\RendererStyle\RendererStyle(400),
        new \BaconQrCode\Renderer\Image\SvgImageBackEnd()
    );
    $writer = new \BaconQrCode\Writer($renderer);
    $qrCode = $writer->writeString($siswa->nis);

    return view('student-card', [
        'siswa' => $siswa,
        'qrCode' => $qrCode
    ]);
})->name('siswa.print-card');

Route::get('/siswa/bulk-print', [SiswaController::class, 'bulkPrint'])->name('siswa.bulk-print');
