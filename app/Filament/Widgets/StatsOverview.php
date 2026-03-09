<?php

namespace App\Filament\Widgets;

use App\Models\
{
    Post,
    User
};
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        // Post Statics
        $PostsThisMonth = Post::whereMonth('created_at',Carbon::now())->count();
        $PostsLastMonth = Post::whereMonth('created_at',Carbon::now()->subMonth())->count();
        for($i=6;$i>=0;$i--){
            $PostsChart[6-$i] = Post::whereMonth('created_at',Carbon::now()->subMonth($i))->count();
        }

        //Creator Statics
        $CreatorsThisMonth = User::where('role','creator')->whereMonth('created_at',Carbon::now())->count();
        $CreatorsLastMonth = User::where('role','creator')->whereMonth('created_at',Carbon::now()->subMonth())->count();
        for($i=6;$i>=0;$i--){
            $CreatorsChart[6-$i] = User::where('role','creator')->whereMonth('created_at',Carbon::now()->subMonth($i))->count();
        }

        //Creator Statics
        $UsersThisMonth = User::where('role','user')->whereMonth('created_at',Carbon::now())->count();
        $UsersLastMonth = User::where('role','user')->whereMonth('created_at',Carbon::now()->subMonth())->count();
        for($i=6;$i>=0;$i--){
            $UsersChart[6-$i] = User::where('role','user')->whereMonth('created_at',Carbon::now()->subMonth($i))->count();
        }

        return [
            Stat::make('Posts Count', Post::query()->count())
                ->description($PostsLastMonth-$PostsThisMonth == 0 ? 'No Change' : abs($PostsLastMonth-$PostsThisMonth) . ($PostsThisMonth >= $PostsLastMonth ? ' increase' : ' decrease'))
                ->descriptionIcon($PostsLastMonth-$PostsThisMonth == 0 ? 'heroicon-m-minus' : ($PostsThisMonth > $PostsLastMonth ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down'))
                ->chart($PostsChart)
                ->color($PostsLastMonth-$PostsThisMonth == 0 ? 'gray' : ($PostsThisMonth > $PostsLastMonth ? 'success' : 'danger')),

            Stat::make('Creators Count', User::where('role','creator')->count())
                    ->description($CreatorsLastMonth-$CreatorsThisMonth == 0 ? 'No Change' : abs($CreatorsLastMonth-$CreatorsThisMonth) . ($CreatorsThisMonth >= $CreatorsLastMonth ? ' increase' : ' decrease'))
                    ->descriptionIcon($CreatorsLastMonth-$CreatorsThisMonth == 0 ? 'heroicon-m-minus' : ($CreatorsThisMonth > $CreatorsLastMonth ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down'))
                    ->chart($CreatorsChart)
                    ->color($CreatorsLastMonth-$CreatorsThisMonth == 0 ? 'gray' : ($CreatorsThisMonth > $CreatorsLastMonth ? 'success' : 'danger')),

            Stat::make('Users Count', User::where('role','user')->count())
                    ->description($UsersLastMonth-$UsersThisMonth == 0 ? 'No Change' : abs($UsersLastMonth-$UsersThisMonth) . ($UsersThisMonth >= $UsersLastMonth ? ' increase' : ' decrease'))
                    ->descriptionIcon($UsersLastMonth-$UsersThisMonth == 0 ? 'heroicon-m-minus' : ($UsersThisMonth > $UsersLastMonth ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down'))
                    ->chart($UsersChart)
                    ->color($UsersLastMonth-$UsersThisMonth == 0 ? 'gray' : ($UsersThisMonth > $UsersLastMonth ? 'success' : 'danger')),
        ];
    }

    protected function getHeading(): ?string
    {
        return 'Analytics';
    }

    protected function getDescription(): ?string
    {
        return 'An overview of some analytics.';
    }
}
