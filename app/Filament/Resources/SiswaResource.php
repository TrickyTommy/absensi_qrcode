<?php

namespace App\Filament\Resources;

use App\Models\Siswa;
use BaconQrCode\Writer;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use BaconQrCode\Renderer\ImageRenderer;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Collection;
use App\Filament\Resources\SiswaResource\Pages;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use Illuminate\Http\Request;
use App\Models\Student;

class SiswaResource extends Resource
{
    protected static ?string $model = Siswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationLabel = 'Data Siswa';

    protected static ?string $modelLabel = 'Siswa';

    protected static ?string $pluralModelLabel = 'Data Siswa';

    protected static ?int $navigationSort = 1;

    protected static ?string $createButtonLabel = 'Tambah Siswa';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nis')
                ->label('NIS')
                ->required()
                ->unique(table: 'siswas', ignoreRecord: true)
                ->rules(['required', 'string', 'max:255'])
                ->validationAttribute('NIS')
                ->placeholder('Masukkan NIS')
                ->afterStateUpdated(function (string $state, $set) {
                    if (Siswa::where('nis', $state)->exists()) {
                        $set('nis', '');
                        Notification::make()
                            ->title('NIS sudah digunakan!')
                            ->danger()
                            ->send();
                    }
                }),

                TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                Select::make('kelas')
                    ->options([
                        'X' => 'X',
                        'XI' => 'XI',
                        'XII' => 'XII',
                    ])
                    ->required(),
                Select::make('jurusan')
                    ->options([
                        'RPL' => 'Rekayasa Perangkat Lunak',
                        'TKJ' => 'Teknik Komputer dan Jaringan',
                        'AKT' => 'Akuntansi'
                    ])
                    ->required(),
                Select::make('jenis_kelamin')
                    ->required()
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nis')
                    ->label('NIS')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('NIS berhasil disalin')
                    ->icon('heroicon-o-identification'),
                TextColumn::make('nama')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable()
                    ->weight('medium')
                    ->icon('heroicon-o-user'),
                TextColumn::make('kelas')
                    ->label('Kelas')
                    ->formatStateUsing(fn (string $state): string => "Kelas {$state}")
                    ->searchable()
                    ->sortable()
                    ->icon('heroicon-o-academic-cap'),
                TextColumn::make('jurusan')
                    ->label('Jurusan')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'RPL' => 'Rekayasa Perangkat Lunak',
                        'TKJ' => 'Teknik Komputer dan Jaringan',
                        'AKT' => 'Akuntansi',
                        default => $state,
                    })
                    ->searchable()
                    ->sortable()
                    ->icon('heroicon-o-cog'),
                TextColumn::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                        default => $state,
                    })
                    ->searchable()
                    ->sortable()
                    ->icon('heroicon-o-users'),
                ViewColumn::make('qr_code')
                    ->label('QR Code')
                    ->view('filament.resources.siswa-resource.tables.columns.qr-code')
                    ->alignCenter(),
            ])
            ->defaultSort('nama', 'asc')
            ->filters([
                SelectFilter::make('kelas')
                    ->options([
                        'X' => 'Kelas X',
                        'XI' => 'Kelas XI',
                        'XII' => 'Kelas XII',
                    ])
                    ->label('Filter Kelas'),
                SelectFilter::make('jurusan')
                    ->options([
                        'RPL' => 'Rekayasa Perangkat Lunak',
                        'TKJ' => 'Teknik Komputer dan Jaringan',
                        'AKT' => 'Akuntansi'
                    ])
                    ->label('Filter Jurusan'),
                SelectFilter::make('jenis_kelamin')
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ])
                    ->label('Filter Jenis Kelamin'),
            ])
            ->actions([
                EditAction::make()
                    ->icon('heroicon-o-pencil'),
                DeleteAction::make()
                    ->icon('heroicon-o-trash'),
                \Filament\Tables\Actions\Action::make('print')
                    ->label('Print Kartu')
                    ->icon('heroicon-o-printer')
                    ->url(fn (Siswa $record): string => route('siswa.print-card', $record))
                    ->openUrlInNewTab()
            ])
            //hapus data terpilih

            ->bulkActions([
                BulkAction::make('delete')
                    ->label('Hapus Data Terpilih')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->action(fn (Collection $records) => $records->each->delete())
                    ->requiresConfirmation()
                    ->deselectRecordsAfterCompletion(),
                BulkAction::make('printCards')
                    ->label('Print Kartu')
                    ->icon('heroicon-o-printer')
                    ->action(function (Collection $records) {
                        $studentIds = $records->pluck('id')->toArray();
                        return redirect()->route('siswa.bulk-print', ['student_ids' => $studentIds]);
                    })
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
            'index' => Pages\ListSiswas::route('/'),
            'create' => Pages\CreateSiswa::route('/create'),
            'edit' => Pages\EditSiswa::route('/{record}/edit'),
        ];
    }
}
