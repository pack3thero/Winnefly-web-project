<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                ->required()
                ->maxLength(255),

            Select::make('category_id')
                ->label('Category')
                ->relationship('category', 'name')
                ->required(),

            Textarea::make('description')
                ->nullable(),

            TextInput::make('price')
                ->numeric()
                ->required(),

            TextInput::make('stock')
                ->numeric()
                ->required(),

            FileUpload::make('image')
                ->image()
                ->disk('public')
                ->directory('products')
                ->visibility('public'),
            ]);
    }
}
