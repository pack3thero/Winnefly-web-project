<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->numeric(),
                TextInput::make('invoice_id'),
                TextInput::make('external_id')
                    ->required(),
                TextInput::make('customer_name')
                    ->required(),
                TextInput::make('customer_email')
                    ->email()
                    ->required(),
                TextInput::make('customer_phone')
                    ->tel()
                    ->required(),
                Textarea::make('address')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('total_price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                TextInput::make('payment_method')
                    ->required()
                    ->default('xendit'),
                TextInput::make('status')
                    ->required()
                    ->default('PENDING'),
                Textarea::make('invoice_url')
                    ->columnSpanFull(),
            ]);
    }
}
