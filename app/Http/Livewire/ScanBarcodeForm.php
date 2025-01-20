<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Absensi;
use App\Models\Siswa;
use Carbon\Carbon;

class ScanBarcodeForm extends Component
{
    public $barcode;
    public $message;
    public $status;

    protected $listeners = ['createAbsensi'];

    public function createAbsensi($barcode)
    {
        try {
            $siswa = Siswa::where('nis', $barcode)->first();

            if (!$siswa) {
                $this->status = 'error';
                $this->message = 'Siswa tidak ditemukan!';
                return;
            }

            // Check if student already attended today
            $existingAbsensi = Absensi::where('siswa_id', $siswa->id)
                ->whereDate('tanggal', now())
                ->first();

            if ($existingAbsensi) {
                $this->status = 'error';
                $this->message = "{$siswa->nama} sudah absen hari ini!";
                return;
            }

            // Create new attendance record
            Absensi::create([
                'siswa_id' => $siswa->id,
                'tanggal' => now()->setTimezone('Asia/Jakarta')->toDateString(),
                'jam_masuk' => Carbon::now()->setTimezone('Asia/Jakarta')->format('H:i:s'),
                'status' => 'hadir',
                'keterangan' => 'Absen via barcode scanner'
            ]);

            $this->status = 'success';
            $this->message = "Berhasil mencatat kehadiran {$siswa->nama}";

            $this->emit('barcodeScanComplete');

        } catch (\Exception $e) {
            $this->status = 'error';
            $this->message = 'Terjadi kesalahan: ' . $e->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.scan-barcode-form');
    }
}
