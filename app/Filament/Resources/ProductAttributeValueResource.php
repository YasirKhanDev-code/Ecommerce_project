<?php

namespace App\Filament\Resources;

use Modules\Product\App\Models\ProductAttributeValue;

use Filament\Resources\Resource;
use Filament\Forms;
use Filament\Tables;
use App\Filament\Resources\ProductAttributeValueResource\Pages;

class ProductAttributeValueResource extends Resource
{
    protected static ?string $model = ProductAttributeValue::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationLabel = 'Product Attribute Values';
    protected static ?string $pluralModelLabel = 'Product Attribute Values';

    // ===== Form =====
    public static function form(\Filament\Forms\Form $form): \Filament\Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->label('Product')
                    ->relationship('product', 'name')
                    ->required(),

                Forms\Components\Select::make('attribute_value_id')
                    ->label('Attribute Value')
                    ->relationship('attributeValue', 'value')
                    ->required(),
            ]);
    }

    // ===== Table =====
    public static function table(\Filament\Tables\Table $table): \Filament\Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.name')->label('Product'),
                Tables\Columns\TextColumn::make('attributeValue.value')->label('Attribute Value'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    // ===== Pages =====
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductAttributeValues::route('/'),
            'create' => Pages\CreateProductAttributeValue::route('/create'),
            'edit' => Pages\EditProductAttributeValue::route('/{record}/edit'),
        ];
    }
}
