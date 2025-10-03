<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;                // <-- correct import
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = \Modules\Product\App\Models\Product::class;


    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Shop Management';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->required()->maxLength(255),
            Forms\Components\TextInput::make('slug')->required()->maxLength(255),
            Forms\Components\Textarea::make('description')->rows(4)->cols(50),
            Forms\Components\TextInput::make('price')->required()->numeric(),
            Forms\Components\TextInput::make('old_price')->numeric()->nullable(),
            Forms\Components\TextInput::make('stock')->numeric()->default(0),
            Forms\Components\TextInput::make('sku')->maxLength(100)->nullable(),

            Forms\Components\Select::make('category_id')
                ->label('Category')
                ->relationship('category', 'name')
                ->searchable()
                ->required(),

            Forms\Components\FileUpload::make('image')
                ->image()
                ->directory('products')
                ->nullable(),

            Forms\Components\Toggle::make('is_featured')->label('Featured')->default(false),
            Forms\Components\Toggle::make('status')->label('Active')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('category.name')->label('Category'),
                Tables\Columns\TextColumn::make('price')->money('usd'),
                Tables\Columns\IconColumn::make('is_featured')->boolean(),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        // make sure this references ProductResource\Pages
        return [
            'index'  => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit'   => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
