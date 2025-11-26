<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Kategori;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Postingan';

    protected static ?string $navigationGroup = 'Konten';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Postingan')
                    ->description('Detail utama artikel')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Judul Postingan')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Masukkan judul artikel yang menarik')
                                    ->columnSpan(1),
                                Forms\Components\Select::make('category')
                                    ->label('Kategori')
                                    ->options(Kategori::pluck('name', 'name'))
                                    ->required()
                                    ->placeholder('Pilih kategori artikel')
                                    ->columnSpan(1),
                            ]),
                        Forms\Components\TextInput::make('slug')
                            ->hidden()
                            ->dehydrated()
                            ->required()
                            ->maxLength(255),
                    ]),

                Section::make('Konten & Media')
                    ->description('Isi artikel dan gambar pendukung')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        Forms\Components\SpatieMediaLibraryFileUpload::make('cover')
                            ->label('Gambar Cover')
                            ->collection('cover')
                            ->image()
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->maxSize(2048)
                            ->helperText('Upload gambar cover untuk artikel (maksimal 2MB)'),
                        Forms\Components\RichEditor::make('body')
                            ->label('Isi Artikel')
                            ->required()

                            ->placeholder('Tulis isi artikel di sini... Klik tombol gambar di toolbar untuk menambahkan gambar ke artikel.')
                            ->helperText('Gunakan tombol gambar di toolbar untuk upload dan sisipkan gambar langsung ke dalam artikel.')
                            ->columnSpanFull(),
                    ]),

                Section::make('Publikasi & Penulis')
                    ->description('Pengaturan publikasi artikel')
                    ->icon('heroicon-o-clock')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                Forms\Components\Toggle::make('is_published')
                                    ->label('Terbitkan Sekarang')
                                    ->helperText('Aktifkan untuk mempublikasikan artikel'),
                                Forms\Components\DateTimePicker::make('published_at')
                                    ->label('Jadwal Publikasi')
                                    ->displayFormat('d/m/Y H:i')
                                    ->placeholder('Pilih waktu publikasi'),
                                Forms\Components\Select::make('author_id')
                                    ->label('Penulis')
                                    ->relationship('author', 'name')
                                    ->required()
                                    ->placeholder('Pilih penulis artikel'),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('cover')
                    ->label('Cover')
                    ->collection('cover')
                    ->circular()
                    ->size(50)
                    ->defaultImageUrl('/images/placeholder-post.png'),
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->limit(50)
                    ->tooltip(function ($record): ?string {
                        return strlen($record->title) > 50 ? $record->title : null;
                    }),
                Tables\Columns\TextColumn::make('category')
                    ->label('Kategori')
                    ->searchable()
                    ->badge()
                    ->color('primary'),
                Tables\Columns\TextColumn::make('is_published')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state ? 'Published' : 'Draft')
                    ->color(fn ($state) => $state ? 'success' : 'warning'),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Diterbitkan')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->placeholder('Belum diterbitkan')
                    ->icon('heroicon-o-clock'),
                Tables\Columns\TextColumn::make('author.name')
                    ->label('Penulis')
                    ->sortable()
                    ->searchable()
                    ->icon('heroicon-o-user'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diubah')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('is_published')
                    ->label('Status Publikasi')
                    ->options([
                        '1' => 'Published',
                        '0' => 'Draft',
                    ]),
                Tables\Filters\SelectFilter::make('category')
                    ->label('Kategori')
                    ->options(Kategori::pluck('name', 'name')),
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
                    ->modalHeading('Hapus Postingan')
                    ->modalDescription('Apakah Anda yakin ingin menghapus postingan ini? Tindakan ini tidak dapat dibatalkan.')
                    ->modalSubmitActionLabel('Ya, Hapus'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus Terpilih')
                        ->icon('heroicon-o-trash')
                        ->requiresConfirmation()
                        ->modalHeading('Hapus Postingan Terpilih')
                        ->modalDescription('Apakah Anda yakin ingin menghapus postingan yang dipilih? Tindakan ini tidak dapat dibatalkan.')
                        ->modalSubmitActionLabel('Ya, Hapus Semua'),
                ]),
            ])
            ->emptyStateHeading('Belum ada postingan')
            ->emptyStateDescription('Buat postingan pertama untuk memulai mengelola konten sekolah.')
            ->emptyStateIcon('heroicon-o-document-text')
            ->striped()
            ->paginated([10, 25, 50, 100])
            ->poll('30s');
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
