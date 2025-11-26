<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FasilitasResource\Pages;
use App\Models\Fasilitas;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FasilitasResource extends Resource
{
    protected static ?string $model = Fasilitas::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?string $navigationLabel = 'Fasilitas';

    protected static ?string $navigationGroup = 'Fasilitas & Kegiatan';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Fasilitas')
                    ->description('Detail utama fasilitas sekolah')
                    ->icon('heroicon-o-building-office')
                    ->schema([
                        Grid::make(1)
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nama Fasilitas')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Contoh: Laboratorium Komputer, Lapangan Basket')
                                    ->helperText('Nama lengkap fasilitas sesuai kondisi sebenarnya')
                                    ->columnSpan(1),
                            ]),
                        Textarea::make('description')
                            ->label('Deskripsi Fasilitas')
                            ->required()
                            ->rows(4)
                            ->placeholder('Jelaskan tentang fasilitas ini, kondisi, kapasitas, fasilitas pendukung, dll.')
                            ->helperText('Berikan deskripsi yang informatif tentang fasilitas untuk memberikan gambaran yang jelas')
                            ->columnSpanFull(),
                    ]),

                Section::make('Galeri & Dokumentasi')
                    ->description('Upload gambar dan dokumentasi fasilitas')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('images')
                            ->label('Galeri Fasilitas')
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
                            ->helperText('Upload gambar fasilitas dari berbagai sudut (maksimal 2MB per gambar, format: JPG, PNG, WebP)')
                            ->directory('fasilitas/gallery')
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
                    ->defaultImageUrl('/images/default-facility.png'),
                TextColumn::make('name')
                    ->label('Nama Fasilitas')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->icon('heroicon-o-building-office')
                    ->color('primary'),
                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->searchable()
                    ->limit(100)
                    ->tooltip(function ($record): ?string {
                        return strlen($record->description) > 100 ? $record->description : null;
                    }),
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
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
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
                    ->modalHeading('Hapus Fasilitas')
                    ->modalDescription('Apakah Anda yakin ingin menghapus data fasilitas ini?')
                    ->modalSubmitActionLabel('Ya, Hapus'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus Terpilih')
                        ->icon('heroicon-o-trash')
                        ->requiresConfirmation()
                        ->modalHeading('Hapus Fasilitas Terpilih')
                        ->modalDescription('Apakah Anda yakin ingin menghapus data fasilitas yang dipilih?')
                        ->modalSubmitActionLabel('Ya, Hapus Semua'),
                ]),
            ])
            ->emptyStateHeading('Belum ada data fasilitas')
            ->emptyStateDescription('Tambahkan data fasilitas pertama untuk mengelola sarana dan prasarana sekolah.')
            ->emptyStateIcon('heroicon-o-building-office')
            ->striped()
            ->paginated([10, 25, 50, 100])
            ->poll('30s');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageFasilitas::route('/'),
        ];
    }
}
