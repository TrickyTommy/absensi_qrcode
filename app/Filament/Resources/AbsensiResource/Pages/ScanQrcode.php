<?php

namespace App\Filament\Resources\AbsensiResource\Pages;

use App\Models\Siswa;
use App\Models\Absensi;
use Filament\Resources\Pages\Page;
use App\Filament\Resources\AbsensiResource;
use Illuminate\Support\Facades\DB;
use Filament\Notifications\Notification;

class ScanQrcode extends Page
{
    protected static string $resource = AbsensiResource::class;

    protected static string $view = 'filament.resources.absensi-resource.pages.scan-qrcode';

    public static function getUrl(array $parameters = [], bool $isAbsolute = true): string
    {
        return route('filament.resources.absensis.scan', $parameters, $isAbsolute);
    }

    public static function getRouteName(): string
    {
        return 'filament.resources.absensis.scan';
    }

    public function createAbsensi($nis)
    {
        $siswa = Siswa::where('nis', $nis)->first();
        
        if (!$siswa) {
            Notification::make()
                ->title('Error')
                ->body('Siswa tidak ditemukan')
                ->danger()
                ->send();
            
            return;
        }

        // Check if student already has attendance for today
        $existingAbsensi = Absensi::where('siswa_id', $siswa->id)
            ->whereDate('tanggal', today())
            ->first();

        if ($existingAbsensi) {
            Notification::make()
                ->title('Info')
                ->body('Siswa sudah absen hari ini')
                ->warning()
                ->send();
            
            return;
        }

        try {
            DB::beginTransaction();

            Absensi::create([
                'siswa_id' => $siswa->id,
                'tanggal' => today(),
                'jam_masuk' => now(),
                'status' => 'hadir',
            ]);

            DB::commit();

            Notification::make()
                ->title('Success')
                ->body('Absensi berhasil dicatat')
                ->success()
                ->send();

        } catch (\Exception $e) {
            DB::rollBack();
            
            Notification::make()
                ->title('Error')
                ->body('Gagal mencatat absensi')
                ->danger()
                ->send();
        }
    }
}
