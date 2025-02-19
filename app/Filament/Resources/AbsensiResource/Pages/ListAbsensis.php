<?php

namespace App\Filament\Resources\AbsensiResource\Pages;

use App\Filament\Resources\AbsensiResource;
use App\Filament\Widgets\ScanBarcodeWidget; // Add this import
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAbsensis extends ListRecords
{
    protected static string $resource = AbsensiResource::class;

    protected $listeners = ['refreshTable' => '$refresh'];

    protected function getHeaderWidgets(): array
    {
        return [
            ScanBarcodeWidget::class
        ];
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
