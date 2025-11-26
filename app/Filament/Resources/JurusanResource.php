<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JurusanResource\Pages;
use App\Models\Jurusan;
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

class JurusanResource extends Resource
{
    protected static ?string $model = Jurusan::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    protected static ?string $navigationLabel = 'Jurusan';

    protected static ?string $navigationGroup = 'Akademik';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Jurusan')
                    ->description('Detail utama program studi')
                    ->icon('heroicon-o-building-library')
                    ->schema([
                        Grid::make(1)
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nama Jurusan')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Contoh: Teknik Informatika, Akuntansi')
                                    ->helperText('Nama lengkap jurusan sesuai kurikulum sekolah')
                                    ->columnSpan(1),
                            ]),
                        Textarea::make('description')
                            ->label('Deskripsi Jurusan')
                            ->required()
                            ->rows(4)
                            ->placeholder('Jelaskan tentang jurusan ini, prospek karir, mata pelajaran utama, dll.')
                            ->helperText('Berikan deskripsi yang informatif tentang jurusan untuk membantu siswa memahami pilihan mereka')
                            ->columnSpanFull(),
                    ]),

                Section::make('Galeri & Dokumentasi')
                    ->description('Upload gambar dan dokumentasi jurusan')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('images')
                            ->label('Galeri Jurusan')
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
                            ->helperText('Upload gambar fasilitas, kegiatan, atau dokumentasi jurusan (maksimal 2MB per gambar, format: JPG, PNG, WebP)')
                            ->directory('jurusan/gallery')
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
                    ->defaultImageUrl('/images/default-department.png'),
                TextColumn::make('name')
                    ->label('Nama Jurusan')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->icon('heroicon-o-building-library')
                    ->color('primary'),
                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->searchable()
                    ->limit(80)
                    ->tooltip(function ($record): ?string {
                        return strlen($record->description) > 80 ? $record->description : null;
                    }),
                TextColumn::make('siswas_count')
                    ->label('Jumlah Siswa')
                    ->counts('siswas')
                    ->badge()
                    ->color('info')
                    ->icon('heroicon-o-users'),
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
                    ->modalHeading('Hapus Jurusan')
                    ->modalDescription('Apakah Anda yakin ingin menghapus jurusan ini? Semua data siswa yang terkait akan tetap ada.')
                    ->modalSubmitActionLabel('Ya, Hapus'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus Terpilih')
                        ->icon('heroicon-o-trash')
                        ->requiresConfirmation()
                        ->modalHeading('Hapus Jurusan Terpilih')
                        ->modalDescription('Apakah Anda yakin ingin menghapus jurusan yang dipilih? Data siswa yang terkait akan tetap ada.')
                        ->modalSubmitActionLabel('Ya, Hapus Semua'),
                ]),
            ])
            ->emptyStateHeading('Belum ada data jurusan')
            ->emptyStateDescription('Tambahkan jurusan pertama untuk mengatur program studi sekolah.')
            ->emptyStateIcon('heroicon-o-building-library')
            ->striped()
            ->paginated([10, 25, 50, 100])
            ->poll('30s');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageJurusans::route('/'),
        ];
    }
}
