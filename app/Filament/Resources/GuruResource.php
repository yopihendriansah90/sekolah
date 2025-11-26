<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GuruResource\Pages;
use App\Models\Guru;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class GuruResource extends Resource
{
    protected static ?string $model = Guru::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Guru';

    protected static ?string $navigationGroup = 'Akademik';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Pribadi')
                    ->description('Data identitas guru')
                    ->icon('heroicon-o-user')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nama Lengkap')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Masukkan nama lengkap guru')
                                    ->columnSpan(1),
                                TextInput::make('nip')
                                    ->label('NIP')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Nomor Induk Pegawai')
                                    ->helperText('NIP guru sesuai data kepegawaian')
                                    ->columnSpan(1),
                            ]),
                    ]),

                Section::make('Informasi Akademik')
                    ->description('Data keahlian dan mata pelajaran')
                    ->icon('heroicon-o-academic-cap')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('subject')
                                    ->label('Mata Pelajaran')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Contoh: Matematika, Bahasa Indonesia')
                                    ->helperText('Mata pelajaran yang diampu guru')
                                    ->columnSpanFull(),
                            ]),
                    ]),

                Section::make('Kontak & Media')
                    ->description('Informasi kontak dan foto profil')
                    ->icon('heroicon-o-device-phone-mobile')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('email')
                                    ->label('Email')
                                    ->email()
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('guru@sekolah.com')
                                    ->helperText('Email resmi guru untuk komunikasi')
                                    ->columnSpan(1),
                                TextInput::make('phone')
                                    ->label('Nomor Telepon')
                                    ->tel()
                                    ->maxLength(255)
                                    ->placeholder('+62 812-3456-7890')
                                    ->helperText('Nomor telepon aktif guru')
                                    ->columnSpan(1),
                            ]),
                        SpatieMediaLibraryFileUpload::make('photos')
                            ->label('Foto Profil')
                            ->collection('photos')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '1:1',
                                '4:3',
                                '3:4',
                            ])
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->maxSize(2048)
                            ->helperText('Upload foto profil guru (maksimal 2MB, format: JPG, PNG, WebP)')
                            ->directory('gurus/photos')
                            ->visibility('public'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('photos')
                    ->label('Foto')
                    ->collection('photos')
                    ->circular()
                    ->size(50)
                    ->defaultImageUrl('/images/default-avatar.png'),
                TextColumn::make('name')
                    ->label('Nama Guru')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->icon('heroicon-o-user')
                    ->color('primary'),
                TextColumn::make('nip')
                    ->label('NIP')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('NIP berhasil disalin')
                    ->icon('heroicon-o-identification'),
                TextColumn::make('subject')
                    ->label('Mata Pelajaran')
                    ->searchable()
                    ->badge()
                    ->color('success'),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->icon('heroicon-o-envelope')
                    ->copyable()
                    ->copyMessage('Email berhasil disalin'),
                TextColumn::make('phone')
                    ->label('Telepon')
                    ->icon('heroicon-o-device-phone-mobile')
                    ->placeholder('Tidak ada nomor telepon'),
                TextColumn::make('created_at')
                    ->label('Bergabung')
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
                Tables\Filters\SelectFilter::make('subject')
                    ->label('Mata Pelajaran')
                    ->options(function () {
                        return Guru::distinct()->pluck('subject', 'subject')->filter();
                    }),
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
                    ->modalHeading('Hapus Data Guru')
                    ->modalDescription('Apakah Anda yakin ingin menghapus data guru ini? Tindakan ini tidak dapat dibatalkan.')
                    ->modalSubmitActionLabel('Ya, Hapus'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus Terpilih')
                        ->icon('heroicon-o-trash')
                        ->requiresConfirmation()
                        ->modalHeading('Hapus Data Guru Terpilih')
                        ->modalDescription('Apakah Anda yakin ingin menghapus data guru yang dipilih? Tindakan ini tidak dapat dibatalkan.')
                        ->modalSubmitActionLabel('Ya, Hapus Semua'),
                ]),
            ])
            ->emptyStateHeading('Belum ada data guru')
            ->emptyStateDescription('Tambahkan data guru pertama untuk mengelola tenaga pengajar sekolah.')
            ->emptyStateIcon('heroicon-o-user-group')
            ->striped()
            ->paginated([10, 25, 50, 100])
            ->poll('30s');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageGurus::route('/'),
        ];
    }
}
