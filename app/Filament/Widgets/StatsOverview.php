<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Unique Posts', Post::query()->count()),
            Stat::make('Unique Creators', User::where('role','creator')->count()),
            Stat::make('Unique Users', User::where('role','user')->count()),
        ];
    }
}
