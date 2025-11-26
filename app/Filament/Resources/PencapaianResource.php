<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PencapaianResource\Pages;
use App\Models\Pencapaian;
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

class PencapaianResource extends Resource
{
    protected static ?string $model = Pencapaian::class;

    protected static ?string $navigationIcon = 'heroicon-o-trophy';

    protected static ?string $navigationLabel = 'Pencapaian';

    protected static ?string $navigationGroup = 'Pengaturan';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Pencapaian')
                    ->description('Detail prestasi dan penghargaan sekolah')
                    ->icon('heroicon-o-trophy')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('metric')
                                    ->label('Jenis Pencapaian')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Contoh: Jumlah Siswa, Akreditasi, Prestasi Akademik')
                                    ->helperText('Jenis pencapaian yang akan ditampilkan')
                                    ->columnSpan(1),
                                TextInput::make('value')
                                    ->label('Nilai/Angka')
                                    ->required()
                                    ->placeholder('Contoh: 1000, A, Juara 1')
                                    ->helperText('Nilai atau angka pencapaian')
                                    ->columnSpan(1),
                            ]),
                        Grid::make(1)
                            ->schema([
                                TextInput::make('order_column')
                                    ->label('Urutan Tampilan')
                                    ->required()
                                    ->numeric()
                                    ->default(1)
                                    ->minValue(1)
                                    ->placeholder('1')
                                    ->helperText('Urutan tampilan di website (angka kecil akan tampil lebih dulu)')
                                    ->columnSpan(1),
                            ]),
                    ]),

                Section::make('Icon & Visual')
                    ->description('Upload icon untuk pencapaian')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('icons')
                            ->label('Icon Pencapaian')
                            ->collection('icons')
                            ->image()
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->maxSize(2048)
                            ->helperText('Upload icon pencapaian (maksimal 2MB, format: JPG, PNG, WebP)')
                            ->directory('pencapaian/icons')
                            ->visibility('public'),
                    ]),

                Section::make('Contoh Pencapaian')
                    ->description('Panduan untuk jenis pencapaian yang umum')
                    ->icon('heroicon-o-information-circle')
                    ->collapsed()
                    ->schema([
                        Textarea::make('examples')
                            ->label('Contoh Pencapaian Sekolah')
                            ->default("Jumlah Siswa: 1200\nAkreditasi Sekolah: A\nPrestasi Akademik: Juara 1 Olimpiade Matematika\nFasilitas: 25 Ruang Kelas\nTenaga Pengajar: 45 Guru Bersertifikat\nProgram Unggulan: 8 Ekstrakurikuler\nKerjasama Industri: 15 Perusahaan\nBeasiswa: 25 Siswa Penerima\nLulusan Kuliah: 95%\nPenghargaan: Sekolah Adiwiyata")
                            ->rows(10)
                            ->disabled()
                            ->helperText('Copy dan sesuaikan contoh di atas untuk kebutuhan sekolah Anda')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('icons')
                    ->label('Icon')
                    ->collection('icons')
                    ->circular()
                    ->size(50)
                    ->defaultImageUrl('/images/default-achievement.png'),
                TextColumn::make('metric')
                    ->label('Jenis Pencapaian')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->icon('heroicon-o-trophy')
                    ->color('primary'),
                TextColumn::make('value')
                    ->label('Nilai')
                    ->searchable()
                    ->badge()
                    ->color('success'),
                TextColumn::make('order_column')
                    ->label('Urutan')
                    ->sortable()
                    ->badge()
                    ->color('info')
                    ->icon('heroicon-o-bars-3'),
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
            ->defaultSort('order_column', 'asc')
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
                    ->modalHeading('Hapus Pencapaian')
                    ->modalDescription('Apakah Anda yakin ingin menghapus data pencapaian ini?')
                    ->modalSubmitActionLabel('Ya, Hapus'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus Terpilih')
                        ->icon('heroicon-o-trash')
                        ->requiresConfirmation()
                        ->modalHeading('Hapus Pencapaian Terpilih')
                        ->modalDescription('Apakah Anda yakin ingin menghapus data pencapaian yang dipilih?')
                        ->modalSubmitActionLabel('Ya, Hapus Semua'),
                ]),
            ])
            ->emptyStateHeading('Belum ada data pencapaian')
            ->emptyStateDescription('Tambahkan pencapaian pertama untuk menampilkan prestasi sekolah.')
            ->emptyStateIcon('heroicon-o-trophy')
            ->striped()
            ->paginated([10, 25, 50, 100])
            ->poll('30s');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePencapaians::route('/'),
        ];
    }
}
