<?php

namespace App\Filament\Resources\AbsensiResource\Pages;

use App\Filament\Resources\AbsensiResource;
use Filament\Resources\Pages\Page;

class ScanBarcode extends Page
{
    protected static string $resource = AbsensiResource::class;

    protected static string $view = 'filament.resources.absensi-resource.pages.scan-barcode';

    protected static ?string $title = 'Scan Barcode';

    protected static ?string $navigationLabel = 'Scan Barcode';

    protected static bool $shouldRegisterNavigation = false;

    public static function getUrl(array $parameters = [], bool $isAbsolute = true): string
    {
        return route('filament.resources.absensi-resource.scan-barcode', [], $isAbsolute);
    }
}
