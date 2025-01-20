<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use App\Http\Livewire\ScanBarcodeForm;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Livewire::component('scan-barcode-form', ScanBarcodeForm::class);

        \Filament\Facades\Filament::registerRenderHook(
            'filament.resources.siswa-resource.tables.bulk-actions.print-cards',
            fn () => view('filament.resources.siswa-resource.tables.bulk-actions.print-cards')
        );
    }
}
