<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PostInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Details')
                    ->inlineLabel()
                    ->schema([
                        TextEntry::make('title'),
                        TextEntry::make('status')
                            ->label('status')
                            ->badge()
                            ->colors([
                                'success' => 'accepted',
                                'warning' => 'pending',
                                'danger'  => 'rejected'
                            ]),
                        TextEntry::make('description')
                            ->label('description'),
                        TextEntry::make('updated_at')
                            ->label('updated At'),
                        TextEntry::make('created_at')
                            ->label('created At'),
                    ])
                    ->columnSpanFull()
            ]);

    }
}
