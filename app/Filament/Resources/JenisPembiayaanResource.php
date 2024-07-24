<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JenisPembiayaanResource\Pages;
use App\Filament\Resources\JenisPembiayaanResource\RelationManagers;
use App\Models\JenisPembiayaan;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JenisPembiayaanResource extends Resource
{
    protected static ?string $model = JenisPembiayaan::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-trending-up';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('akad'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListJenisPembiayaans::route('/'),
            'create' => Pages\CreateJenisPembiayaan::route('/create'),
            'edit' => Pages\EditJenisPembiayaan::route('/{record}/edit'),
        ];
    }
}
