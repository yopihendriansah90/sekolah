<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'Pengaturan';

    protected static ?string $navigationGroup = 'Pengaturan';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Pengaturan Website Sekolah')
                    ->description('Konfigurasi informasi dasar sekolah untuk website')
                    ->icon('heroicon-o-building-office')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('key')
                                    ->label('Kunci Pengaturan')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Contoh: school_name, school_address')
                                    ->helperText('Gunakan nama yang deskriptif dan konsisten')
                                    ->columnSpan(1),
                                TextInput::make('value')
                                    ->label('Nilai Pengaturan')
                                    ->required()
                                    ->placeholder('Masukkan nilai pengaturan')
                                    ->helperText('Nilai yang akan ditampilkan di website')
                                    ->columnSpan(1),
                            ]),
                        Textarea::make('description')
                            ->label('Deskripsi (Opsional)')
                            ->rows(2)
                            ->placeholder('Jelaskan fungsi pengaturan ini')
                            ->helperText('Bantu admin lain memahami tujuan pengaturan ini')
                            ->columnSpanFull(),
                    ]),

                Section::make('Contoh Pengaturan Umum')
                    ->description('Panduan untuk pengaturan yang sering digunakan')
                    ->icon('heroicon-o-information-circle')
                    ->collapsed()
                    ->schema([
                        Textarea::make('examples')
                            ->label('Contoh Pengaturan')
                            ->default("school_name: Nama Sekolah\nschool_address: Alamat Lengkap Sekolah\nschool_phone: +62 21 1234567\nschool_email: info@sekolah.com\nschool_website: https://sekolah.com\nschool_description: Deskripsi singkat sekolah\nschool_vision: Visi sekolah\nschool_mission: Misi sekolah\nschool_history: Sejarah sekolah\nsocial_facebook: URL Facebook\nsocial_instagram: URL Instagram\nsocial_youtube: URL YouTube")
                            ->rows(12)
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
                TextColumn::make('key')
                    ->label('Kunci Pengaturan')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->icon('heroicon-o-key')
                    ->color('primary')
                    ->copyable()
                    ->copyMessage('Kunci berhasil disalin'),
                TextColumn::make('value')
                    ->label('Nilai')
                    ->searchable()
                    ->limit(50)
                    ->tooltip(function ($record): ?string {
                        return strlen($record->value) > 50 ? $record->value : null;
                    })
                    ->placeholder('Belum ada nilai'),
                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Diubah')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\Filter::make('recent')
                    ->label('Pengaturan Terbaru')
                    ->query(fn ($query) => $query->where('created_at', '>=', now()->subDays(7))),
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
                    ->modalHeading('Hapus Pengaturan')
                    ->modalDescription('Apakah Anda yakin ingin menghapus pengaturan ini? Tindakan ini dapat mempengaruhi fungsi website.')
                    ->modalSubmitActionLabel('Ya, Hapus'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus Terpilih')
                        ->icon('heroicon-o-trash')
                        ->requiresConfirmation()
                        ->modalHeading('Hapus Pengaturan Terpilih')
                        ->modalDescription('Apakah Anda yakin ingin menghapus pengaturan yang dipilih? Tindakan ini dapat mempengaruhi fungsi website.')
                        ->modalSubmitActionLabel('Ya, Hapus Semua'),
                ]),
            ])
            ->emptyStateHeading('Belum ada pengaturan')
            ->emptyStateDescription('Tambahkan pengaturan pertama untuk mengkonfigurasi website sekolah.')
            ->emptyStateIcon('heroicon-o-cog-6-tooth')
            ->striped()
            ->paginated([10, 25, 50, 100])
            ->poll('30s');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSettings::route('/'),
        ];
    }
}
