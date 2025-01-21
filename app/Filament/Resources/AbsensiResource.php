<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Siswa;
use App\Models\Absensi;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Carbon;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\AbsensiResource\Pages;

class AbsensiResource extends Resource
{
    protected static ?string $model = Absensi::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    protected static ?string $navigationLabel = 'Absensi';

    protected static ?string $pluralModelLabel = 'Absensi';

    protected static ?string $modelLabel = 'Absensi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('nis')
                            ->label('Scan QR Code / Input NIS')
                            ->required()
                            ->maxLength(255)
                            ->afterStateUpdated(function ($state, callable $set) {
                                $siswa = Siswa::where('nis', $state)->first();
                                if ($siswa) {
                                    $set('siswa_id', $siswa->id);
                                    $set('tanggal', now()->setTimezone('Asia/Jakarta')->toDateString());
                                    $set('jam_masuk', Carbon::now()->setTimezone('Asia/Jakarta')->format('H:i:s'));
                                }
                            })
                            ->dehydrated(false),
                        Select::make('siswa_id')
                            ->label('Siswa')
                            ->options(Siswa::all()->pluck('nama', 'id'))
                            ->required()
                            ->searchable(),
                        DatePicker::make('tanggal')
                            ->default(now())
                            ->required(),
                        TimePicker::make('jam_masuk')
                            ->default(now())
                            ->required(),
                        Select::make('status')
                            ->label('Status Kehadiran')
                            ->options([
                                'hadir' => 'Hadir',
                                'sakit' => 'Sakit',
                                'izin' => 'Izin',
                                'alpha' => 'Alpha',
                            ])
                            ->default('hadir')
                            ->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('siswa.nis')
                    ->label('NIS')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('siswa.nama')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('tanggal')
                    ->date()
                    ->sortable(),
                TextColumn::make('jam_masuk')
                    ->time()
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status Kehadiran')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAbsensis::route('/'),
            'create' => Pages\CreateAbsensi::route('/create'),
            'edit' => Pages\EditAbsensi::route('/{record}/edit'),
            'scan' => Pages\ScanQrcode::route('/scan'),
            'scan-qrcode' => Pages\ScanQrcode::route('/scan-qrcode'),
        ];
    }
}
