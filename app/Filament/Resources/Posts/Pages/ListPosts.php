<?php

namespace App\Filament\Resources\Posts\Pages;

use App\Filament\Resources\Posts\PostResource;
use App\Models\Post;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all'      => Tab::make(),
            'Accepted' => Tab::make()->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'accepted')),
            'Pending'  => Tab::make()->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'pending')),
            'Rejected' => Tab::make()->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'rejected'))
        ];
    }
}
