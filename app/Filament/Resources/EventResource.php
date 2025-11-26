<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Models\Event;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationLabel = 'Event';

    protected static ?string $navigationGroup = 'Fasilitas & Kegiatan';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Event')
                    ->description('Detail utama acara sekolah')
                    ->icon('heroicon-o-calendar-days')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title')
                                    ->label('Judul Event')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Masukkan judul event yang menarik')
                                    ->columnSpan(1),
                                TextInput::make('location')
                                    ->label('Lokasi')
                                    ->maxLength(255)
                                    ->placeholder('Tempat pelaksanaan event')
                                    ->columnSpan(1),
                            ]),
                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->required()
                            ->rows(4)
                            ->placeholder('Jelaskan detail event ini, tujuan, peserta, dll.')
                            ->columnSpanFull(),
                    ]),

                Section::make('Waktu & Tanggal')
                    ->description('Jadwal pelaksanaan event')
                    ->icon('heroicon-o-clock')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                DatePicker::make('event_date')
                                    ->label('Tanggal Event')
                                    ->required()
                                    ->displayFormat('d/m/Y')
                                    ->placeholder('Pilih tanggal'),
                                TimePicker::make('event_time')
                                    ->label('Waktu Mulai')
                                    ->placeholder('Pilih waktu mulai (opsional)'),
                            ]),
                    ]),

                Section::make('Media & Dokumentasi')
                    ->description('Upload gambar dan dokumentasi event')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('images')
                            ->label('Gambar Event')
                            ->collection('images')
                            ->multiple()
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->maxSize(2048)
                            ->helperText('Upload gambar event dari berbagai sudut (maksimal 2MB per gambar, format: JPG, PNG, WebP)')
                            ->directory('events/gallery')
                            ->visibility('public')
                            ->reorderable()
                            ->downloadable(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('images')
                    ->label('Galeri')
                    ->collection('images')
                    ->circular(false)
                    ->size(60)
                    ->limit(3)
                    ->defaultImageUrl('/images/default-event.png'),
                TextColumn::make('title')
                    ->label('Judul Event')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->icon('heroicon-o-calendar-days')
                    ->color('primary'),
                TextColumn::make('event_date')
                    ->label('Tanggal')
                    ->date('d/m/Y')
                    ->sortable()
                    ->badge()
                    ->color('info'),
                TextColumn::make('location')
                    ->label('Lokasi')
                    ->searchable()
                    ->icon('heroicon-o-map-pin')
                    ->placeholder('Lokasi belum ditentukan'),
                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(80)
                    ->tooltip(function ($record): ?string {
                        return strlen($record->description) > 80 ? $record->description : null;
                    })
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Diubah')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('event_date', 'desc')
            ->filters([
                Tables\Filters\Filter::make('upcoming')
                    ->label('Event Mendatang')
                    ->query(fn ($query) => $query->where('event_date', '>=', now())),
                Tables\Filters\Filter::make('past')
                    ->label('Event Lampau')
                    ->query(fn ($query) => $query->where('event_date', '<', now())),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Lihat')
                    ->icon('heroicon-o-eye'),
                Tables\Actions\EditAction::make()
                    ->label('Edit')
                    ->icon('heroicon-o-pencil'),
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus')
                    ->icon('heroicon-o-trash')
                    ->requiresConfirmation()
                    ->modalHeading('Hapus Event')
                    ->modalDescription('Apakah Anda yakin ingin menghapus event ini?')
                    ->modalSubmitActionLabel('Ya, Hapus'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus Terpilih')
                        ->icon('heroicon-o-trash')
                        ->requiresConfirmation()
                        ->modalHeading('Hapus Event Terpilih')
                        ->modalDescription('Apakah Anda yakin ingin menghapus event yang dipilih?')
                        ->modalSubmitActionLabel('Ya, Hapus Semua'),
                ]),
            ])
            ->emptyStateHeading('Belum ada data event')
            ->emptyStateDescription('Tambahkan event pertama untuk mengelola kegiatan sekolah.')
            ->emptyStateIcon('heroicon-o-calendar-days')
            ->striped()
            ->paginated([10, 25, 50, 100])
            ->poll('30s');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageEvents::route('/'),
        ];
    }
}
