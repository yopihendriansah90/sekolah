<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiswaResource\Pages;
use App\Models\Siswa;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SiswaResource extends Resource
{
    protected static ?string $model = Siswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationLabel = 'Siswa';

    protected static ?string $navigationGroup = 'Akademik';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Pribadi')
                    ->description('Data identitas siswa')
                    ->icon('heroicon-o-user')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nama Lengkap')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Masukkan nama lengkap siswa')
                                    ->columnSpan(1),
                                TextInput::make('nis')
                                    ->label('NIS')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Nomor Induk Siswa')
                                    ->helperText('NIS sesuai data akademik siswa')
                                    ->columnSpan(1),
                            ]),
                    ]),

                Section::make('Informasi Akademik')
                    ->description('Data kelas dan jurusan siswa')
                    ->icon('heroicon-o-academic-cap')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('class')
                                    ->label('Kelas')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Contoh: X IPA 1, XI IPS 2')
                                    ->helperText('Kelas dan jurusan siswa saat ini')
                                    ->columnSpan(1),
                                Select::make('jurusan_id')
                                    ->label('Jurusan')
                                    ->relationship('jurusan', 'name')
                                    ->required()
                                    ->placeholder('Pilih jurusan siswa')
                                    ->helperText('Jurusan yang dipilih siswa')
                                    ->columnSpan(1),
                            ]),
                    ]),

                Section::make('Kontak & Media')
                    ->description('Informasi kontak dan foto profil siswa')
                    ->icon('heroicon-o-device-phone-mobile')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('email')
                                    ->label('Email')
                                    ->email()
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('siswa@sekolah.com')
                                    ->helperText('Email resmi siswa untuk komunikasi')
                                    ->columnSpan(1),
                                TextInput::make('phone')
                                    ->label('Nomor Telepon')
                                    ->tel()
                                    ->maxLength(255)
                                    ->placeholder('+62 812-3456-7890')
                                    ->helperText('Nomor telepon siswa atau orang tua')
                                    ->columnSpan(1),
                            ]),
                        SpatieMediaLibraryFileUpload::make('photos')
                            ->label('Foto Profil')
                            ->collection('photos')
                            ->multiple()
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '1:1',
                                '4:3',
                                '3:4',
                            ])
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->maxSize(2048)
                            ->helperText('Upload foto profil siswa (maksimal 2MB, format: JPG, PNG, WebP)')
                            ->directory('siswa/photos')
                            ->visibility('public'),
                    ]),

                Section::make('Prestasi & Penghargaan')
                    ->description('Data prestasi dan penghargaan siswa')
                    ->icon('heroicon-o-trophy')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('achievement_title')
                                    ->label('Judul Prestasi')
                                    ->maxLength(255)
                                    ->placeholder('Juara 1 Lomba Matematika')
                                    ->helperText('Judul/nama prestasi yang diraih')
                                    ->columnSpan(1),
                                Select::make('achievement_category')
                                    ->label('Kategori Prestasi')
                                    ->options([
                                        'akademik' => 'Akademik',
                                        'olahraga' => 'Olahraga',
                                        'seni' => 'Seni & Budaya',
                                        'teknologi' => 'Teknologi',
                                        'bahasa' => 'Bahasa',
                                        'sains' => 'Sains',
                                        'sosial' => 'Sosial & Humaniora',
                                        'lainnya' => 'Lainnya',
                                    ])
                                    ->placeholder('Pilih kategori prestasi')
                                    ->helperText('Kategori bidang prestasi')
                                    ->columnSpan(1),
                            ]),
                        TextInput::make('competition_name')
                            ->label('Nama Kejuaraan/Lomba')
                            ->maxLength(255)
                            ->placeholder('Olimpiade Matematika Tingkat Kabupaten')
                            ->helperText('Nama event/kejuaraan/lomba yang diikuti'),
                        Grid::make(2)
                            ->schema([
                                Select::make('achievement_level')
                                    ->label('Tingkat Kejuaraan')
                                    ->options([
                                        'sekolah' => 'Sekolah',
                                        'kecamatan' => 'Kecamatan',
                                        'kabupaten' => 'Kabupaten/Kota',
                                        'provinsi' => 'Provinsi',
                                        'nasional' => 'Nasional',
                                        'internasional' => 'Internasional',
                                    ])
                                    ->placeholder('Pilih tingkat kejuaraan')
                                    ->helperText('Tingkat kompetisi yang diikuti')
                                    ->columnSpan(1),
                                TextInput::make('achievement_year')
                                    ->label('Tahun Prestasi')
                                    ->numeric()
                                    ->minValue(2000)
                                    ->maxValue(date('Y') + 1)
                                    ->placeholder(date('Y'))
                                    ->helperText('Tahun meraih prestasi')
                                    ->columnSpan(1),
                            ]),
                        \Filament\Forms\Components\Textarea::make('achievement_description')
                            ->label('Deskripsi Prestasi')
                            ->rows(3)
                            ->maxLength(1000)
                            ->placeholder('Jelaskan detail prestasi yang diraih, proses, dan pencapaian...')
                            ->helperText('Deskripsi lengkap tentang prestasi yang diraih'),
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
                    ->defaultImageUrl('/images/default-student.png'),
                TextColumn::make('name')
                    ->label('Nama Siswa')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->icon('heroicon-o-user')
                    ->color('primary'),
                TextColumn::make('nis')
                    ->label('NIS')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('NIS berhasil disalin')
                    ->icon('heroicon-o-identification'),
                TextColumn::make('class')
                    ->label('Kelas')
                    ->searchable()
                    ->badge()
                    ->color('info'),
                TextColumn::make('jurusan.name')
                    ->label('Jurusan')
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
                TextColumn::make('achievement_title')
                    ->label('Prestasi')
                    ->searchable()
                    ->placeholder('Belum ada prestasi')
                    ->icon('heroicon-o-trophy')
                    ->color('warning')
                    ->limit(30),
                TextColumn::make('achievement_level')
                    ->label('Tingkat')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'sekolah' => 'gray',
                        'kecamatan' => 'green',
                        'kabupaten' => 'blue',
                        'provinsi' => 'purple',
                        'nasional' => 'orange',
                        'internasional' => 'red',
                        default => 'gray',
                    })
                    ->placeholder('Belum ada'),
                TextColumn::make('achievement_year')
                    ->label('Tahun')
                    ->sortable()
                    ->placeholder('Belum ada'),
                TextColumn::make('achievement_category')
                    ->label('Kategori')
                    ->badge()
                    ->color('success')
                    ->placeholder('Belum ada'),
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
                Tables\Filters\SelectFilter::make('jurusan_id')
                    ->label('Jurusan')
                    ->relationship('jurusan', 'name')
                    ->placeholder('Semua Jurusan'),
                Tables\Filters\SelectFilter::make('class')
                    ->label('Kelas')
                    ->options(function () {
                        return Siswa::distinct()->pluck('class', 'class')->filter();
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
                    ->modalHeading('Hapus Data Siswa')
                    ->modalDescription('Apakah Anda yakin ingin menghapus data siswa ini? Tindakan ini tidak dapat dibatalkan.')
                    ->modalSubmitActionLabel('Ya, Hapus'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus Terpilih')
                        ->icon('heroicon-o-trash')
                        ->requiresConfirmation()
                        ->modalHeading('Hapus Data Siswa Terpilih')
                        ->modalDescription('Apakah Anda yakin ingin menghapus data siswa yang dipilih? Tindakan ini tidak dapat dibatalkan.')
                        ->modalSubmitActionLabel('Ya, Hapus Semua'),
                ]),
            ])
            ->emptyStateHeading('Belum ada data siswa')
            ->emptyStateDescription('Tambahkan data siswa pertama untuk mengelola siswa sekolah.')
            ->emptyStateIcon('heroicon-o-academic-cap')
            ->striped()
            ->paginated([10, 25, 50, 100])
            ->poll('30s');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSiswas::route('/'),
        ];
    }
}
