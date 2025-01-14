<?php

namespace App\Filament\Resources\AbsensiResource\Pages;

use App\Filament\Resources\AbsensiResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAbsensi extends CreateRecord
{
    protected static string $resource = AbsensiResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function mount(): void
    {
        parent::mount();

        $nis = request()->query('nis');
        if ($nis) {
            $siswa = \App\Models\Siswa::where('nis', $nis)->first();
            if ($siswa) {
                $this->form->fill([
                    'nis' => $nis,
                    'siswa_id' => $siswa->id,
                    'tanggal' => now()->toDateString(),
                    'jam_masuk' => now()->toTimeString(),
                ]);
            }
        }
    }
}
