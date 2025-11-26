<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KategoriResource\Pages;
use App\Models\Kategori;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class KategoriResource extends Resource
{
    protected static ?string $model = Kategori::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $navigationLabel = 'Kategori';

    protected static ?string $navigationGroup = 'Konten';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Kategori')
                    ->description('Detail kategori untuk mengorganisir postingan')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Kategori')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Masukkan nama kategori')
                            ->helperText('Slug akan dibuat otomatis dari nama kategori'),
                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->rows(3)
                            ->placeholder('Jelaskan kategori ini (opsional)')
                            ->helperText('Deskripsi membantu user memahami isi kategori'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Kategori')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->icon('heroicon-o-tag')
                    ->color('primary'),
                TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Slug berhasil disalin')
                    ->icon('heroicon-o-link'),
                TextColumn::make('posts_count')
                    ->label('Jumlah Postingan')
                    ->counts('posts')
                    ->badge()
                    ->color(fn ($state) => $state > 0 ? 'success' : 'gray')
                    ->sortable(),
                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(60)
                    ->tooltip(function ($record): ?string {
                        return strlen($record->description) > 60 ? $record->description : null;
                    })
                    ->placeholder('Tidak ada deskripsi'),
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
                Tables\Filters\SelectFilter::make('posts_count')
                    ->label('Status')
                    ->options([
                        'empty' => 'Tidak ada postingan',
                        'has_posts' => 'Ada postingan',
                    ])
                    ->query(function ($query, $data) {
                        if ($data['value'] === 'empty') {
                            return $query->has('posts', '=', 0);
                        } elseif ($data['value'] === 'has_posts') {
                            return $query->has('posts', '>', 0);
                        }

                        return $query;
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Lihat'),
                Tables\Actions\EditAction::make()
                    ->label('Edit'),
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus')
                    ->requiresConfirmation()
                    ->modalHeading('Hapus Kategori')
                    ->modalDescription('Apakah Anda yakin ingin menghapus kategori ini? Postingan yang menggunakan kategori ini tidak akan terpengaruh.')
                    ->modalSubmitActionLabel('Ya, Hapus'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus Terpilih')
                        ->requiresConfirmation()
                        ->modalHeading('Hapus Kategori Terpilih')
                        ->modalDescription('Apakah Anda yakin ingin menghapus kategori yang dipilih? Postingan yang menggunakan kategori ini tidak akan terpengaruh.')
                        ->modalSubmitActionLabel('Ya, Hapus Semua'),
                ]),
            ])
            ->emptyStateHeading('Belum ada kategori')
            ->emptyStateDescription('Buat kategori pertama untuk mengorganisir postingan Anda.')
            ->emptyStateIcon('heroicon-o-tag');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageKategoris::route('/'),
        ];
    }
}
