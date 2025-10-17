<?php

namespace App\Filament\Resources;

// Pages
use App\Filament\Resources\ReviewResource\Pages\ListReviews;
use App\Filament\Resources\ReviewResource\Pages\CreateReview;
use App\Filament\Resources\ReviewResource\Pages\EditReview;

// Filament core
use Filament\Resources\Resource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;

// Your model
use Modules\Product\App\Models\Review;
class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\Select::make('product_id')
                ->relationship('product', 'name')
                ->required(),
            Forms\Components\Select::make('user_id')
                ->relationship('user', 'name')
                ->required(),
            Forms\Components\Select::make('rating')
    ->options([
        1 => '★',
        2 => '★★',
        3 => '★★★',
        4 => '★★★★',
        5 => '★★★★★',
    ])
    ->required(),
            Forms\Components\Textarea::make('comment'),
        ]);
}


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.name')->label('Product'),
                Tables\Columns\TextColumn::make('user.name')->label('User'),
                Tables\Columns\TextColumn::make('rating'),
                Tables\Columns\TextColumn::make('comment')->limit(50),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
{
    return [
        'index' => ListReviews::route('/'),
        'create' => CreateReview::route('/create'),
        'edit' => EditReview::route('/{record}/edit'),
    ];
}

}
