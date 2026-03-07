<?php

namespace App\Filament\Resources\Posts\Schemas;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Get;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->disabled(),
                Textarea::make('description')
                    ->disabled()
                    ->columnSpanFull(),
                TextInput::make('message')
                    ->visible(function(Get $get){
                        $status = $get('status');
                        return $status === 'rejected' ? true : false;
                    })
                    ->placeholder('Message for rejection reason'),
                Select::make('status')
                    ->options([
                        'accepted' => 'Accepted',
                        'pending'  => 'Pending',
                        'rejected' => 'Rejected',
                    ])
                    ->required()
                    ->live()
                    ->default('pending'),
            ]);
    }
}
