<?php

namespace App\Filament\Resources\AbsensiResource\Pages;

use App\Filament\Resources\AbsensiResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\View\View;

class ListAbsensis extends ListRecords
{
    protected static string $resource = AbsensiResource::class;

    protected $listeners = ['refreshTable' => '$refresh'];

    protected function getHeaderWidgets(): array
    {
        return [
            // Widget akan ditambahkan nanti
        ];
    }

    protected function getTableContentFooter(): ?View
    {
        return view('filament.resources.absensi-resource.components.scan-barcode-footer');
    }

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('scan')
                ->label('Scan QR Code by Camera')
                ->icon('heroicon-o-camera')
                ->url(static::$resource::getUrl('scan'))
        ];
    }
}
