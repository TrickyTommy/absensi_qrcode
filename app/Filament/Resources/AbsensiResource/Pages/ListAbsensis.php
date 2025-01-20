<?php

namespace App\Filament\Resources\AbsensiResource\Pages;

use App\Filament\Resources\AbsensiResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAbsensis extends ListRecords
{
    protected static string $resource = AbsensiResource::class;

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
