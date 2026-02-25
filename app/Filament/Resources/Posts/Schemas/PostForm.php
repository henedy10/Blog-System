<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title'),
                Textarea::make('description')
                    ->columnSpanFull(),

                Select::make('status')
                ->options([
                    'accepted' => 'Accepted',
                    'pending'  => 'Pending',
                    'rejected' => 'Rejected',
                ])
                ->required()
                ->default('pending'),
            ]);
    }
}
