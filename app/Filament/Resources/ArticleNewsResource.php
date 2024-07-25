<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\ArticleNews;
use Filament\Resources\Resource;
use Filament\Infolists\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ArticleNewsResource\Pages;
use App\Filament\Resources\ArticleNewsResource\RelationManagers;

class ArticleNewsResource extends Resource
{
    protected static ?string $model = ArticleNews::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Form $form): Form
    {
       
        return $form
            ->schema([

                FileUpload::make('thumbnail')
                    ->required()
                    ->image()
                    ->columnSpan([
                        'sm' => 3,
                        'xl' => 3,
                        '2xl' => 3,
                    ]),

                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan([
                        'sm' => 3,
                        'xl' => 3,
                        '2xl' => 3,
                    ]),
                    

                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('author_id')
                    ->relationship('author', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('is_featured')
                    ->options([
                        'featured'=> 'Featured', 
                        'not_featured' => 'Not Featured'
                        ])
                    ->required(),
                Select::make('is_featured')
                    ->options([
                        'featured'=> 'Featured', 
                        'not_featured' => 'Not Featured'
                        ])
                    ->required(),
                
                RichEditor::make('content')
                    ->toolbarButtons([
                        'attachFiles',
                        'blockquote',
                        'bold',
                        'bulletList',
                        'codeBlock',
                        'h2',
                        'h3',
                        'italic',
                        'link',
                        'orderedList',
                        'redo',
                        'strike',
                        'underline',
                        'undo',
                    ])
                    ->required()
                    ->columnSpan([
                        'sm' => 3,
                        'xl' => 3,
                        '2xl' => 3,
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('is_featured')
                    ->badge()
                    ->color(fn (string $state) : string => match ($state){
                        'featured' => 'success',
                        'not_featured' => 'danger',
                    }),

                ImageColumn::make('thumbnail'),
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
            'index' => Pages\ListArticleNews::route('/'),
            'create' => Pages\CreateArticleNews::route('/create'),
            'edit' => Pages\EditArticleNews::route('/{record}/edit'),
        ];
    }
}
