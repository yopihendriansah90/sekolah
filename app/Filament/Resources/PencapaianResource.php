<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PencapaianResource\Pages;
use App\Models\Pencapaian;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
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
                TextInput::make('metric')
                    ->required()
                    ->maxLength(255),
                TextInput::make('value')
                    ->required()
                    ->numeric(),
                TextInput::make('order_column')
                    ->required()
                    ->numeric(),
                SpatieMediaLibraryFileUpload::make('icons')
                    ->collection('icons')
                    ->multiple()
                    ->image(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('metric'),
                TextColumn::make('value'),
                TextColumn::make('order_column'),
                SpatieMediaLibraryImageColumn::make('icons')
                    ->collection('icons'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePencapaians::route('/'),
        ];
    }
}
