<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'All'      => Tab::make(),
            'Users'    => Tab::make()
                                ->modifyQueryUsing(fn (Builder $query) => $query->where('role', 'user')),
            'Creators' => Tab::make()
                                ->modifyQueryUsing(fn (Builder $query) => $query->where('role', 'creator'))
        ];
    }
}
